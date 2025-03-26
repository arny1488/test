<?php

// System initialisation
require_once __DIR__ . '/../system/init.php';

$data = DB::query("SELECT * FROM content_files WHERE status = 1 AND mime LIKE 'video/%' LIMIT 25");

foreach ($data as $row) {
    $dest = DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '.mp4';

    if (PHP_OS_FAMILY === 'Linux') {
        $filename = File::basename($dest);
        $directory = File::path($dest);

        // Check if file is used by another process
        $result = exec("lsof +D $directory | grep -c -i $filename");

        if ($result != "0") {
            continue;
        }
    }

    if (File::exists($dest) && (File::mime($dest, false) === 'video/mp4')) {
        // 2 = converted
        DB::update('content_files', ['status' => 2], ['id' => $row['id']]);
    }
}

if ($row = DB::row("SELECT * FROM content_files WHERE status = 0 AND mime LIKE 'video/%' LIMIT 1")) {

    $src = DASHBOARD_DIR . '/uploads/content/' . $row['content_id'] . '/' . $row['filename'] . '.file';
    $dest = DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']);
    $watermark_img = DASHBOARD_DIR . '/assets/images/watermark-mix.png';
    $watermark_audio = DASHBOARD_DIR . '/assets/audio/watermark.wav';

    Dir::create(File::path($dest));

    // Thumbnail
    File::delete($dest . '*.jpg');

    $_tmp = DASHBOARD_DIR . TEMP_DIR . UPLOAD_DIR . '/' . md5(microtime(true)) . '.png';

    if (PHP_OS_FAMILY === 'Windows') {
        system('c:/ffmpeg/bin/ffmpeg.exe -ss 0.5 -i ' . $src . ' -vframes 1 ' . $_tmp . " ", $rv);
    } else {
        system('ffmpeg -ss 0.5 -i ' . $src . ' -vframes 1 ' . $_tmp . " ", $rv);
    }

    TM4RENT\Thumbnail::generate($_tmp, $dest . '_150.jpg', 150, 150, 'inside', true);
    TM4RENT\Thumbnail::generate($_tmp, $dest . '_360.jpg', 360, 360, 'inside', true);
    TM4RENT\Thumbnail::generate($_tmp, $dest . '_720.jpg', 720, 540, 'inside', true);
    TM4RENT\Thumbnail::generate($_tmp, $dest . '_1280.jpg', 1280, 1280, 'inside', false, $watermark_img);

    if (File::exists($_tmp)) {
        File::delete($_tmp);
    }
    // /Thumbnail

    Dir::create(File::path($dest));

    if (File::exists($dest)) {
        File::delete($dest);
    }

    // 1 = converting
    DB::update('content_files', ['status' => 1], ['id' => $row['id']]);

    if (PHP_OS_FAMILY === 'Windows') {
        system(
            'c:/ffmpeg/bin/ffmpeg.exe -i ' . $src . ' -i ' . $watermark_img . ' -map_metadata -1 -vcodec libx264 -profile:v main -level 4.2 -preset veryfast -crf 24 -x264-params ref=4 -c:a aac -b:a 128k -filter_complex "[0]scale=-1:720[0v];[0v][1]overlay=(main_w-overlay_w)/2:(main_h-overlay_h)/2" ' . $dest . ".mp4 > NUL &",
            $rv
        );
    } else {
        system(
            'ffmpeg -i ' . $src . ' -i ' . $watermark_img . ' -map_metadata -1 -vcodec libx264 -profile:v main -level 4.2 -preset veryfast -crf 24 -x264-params ref=4 -c:a aac -b:a 128k -filter_complex "[0]scale=-1:720[0v];[0v][1]overlay=(main_w-overlay_w)/2:(main_h-overlay_h)/2" ' . $dest . ".mp4 > /dev/null &",
            $rv
        );
    }
}