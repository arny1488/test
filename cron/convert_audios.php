<?php

// System initialisation
require_once __DIR__ . '/../system/init.php';

$data = DB::query("SELECT * FROM content_files WHERE status = 1 AND mime LIKE 'audio/%' LIMIT 25");

foreach ($data as $row) {

    $dest = DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']);

    if (PHP_OS_FAMILY === 'Linux') {
        $filename = File::basename($dest);
        $directory = File::path($dest);

        // Check if file is used by another process
        $result = exec("lsof +D $directory | grep -c -i $filename");

        if ($result != "0") {
            continue;
        }
    }

    if (File::exists($dest . '.mp3') && (File::mime($dest . '.mp3', false) === 'audio/mpeg')) {
        // 2 = converted
        DB::update('content_files', ['status' => 2], ['id' => $row['id']]);

        $_tmp = DASHBOARD_DIR . TEMP_DIR . UPLOAD_DIR . '/' . md5(microtime(true)) . '.png';

        if (PHP_OS_FAMILY === 'Linux') {
            system("audiowaveform -i $dest.mp3 -o $dest.mp3.dat -b 8", $rv);
            echo "audiowaveform -i $dest.mp3 -o $dest.mp3.dat -b 8 <br>" . PHP_EOL;
            system("audiowaveform -i $dest.mp3 -o $_tmp -w 1280 -h 720 -z 1024 --border-color 00000000 --background-color 262626 --waveform-color 8A88FF --no-axis-labels", $rv);
            echo "audiowaveform -i $dest.mp3 -o $_tmp -w 1280 -h 720 -z 1024 --border-color 00000000 --background-color 262626 --waveform-color 8A88FF --no-axis-labels <br>" . PHP_EOL;
        }

        if (PHP_OS_FAMILY === 'Windows') {
            system("c:/audiowaveform/audiowaveform.exe -i $dest.mp3 -o $dest.mp3.dat -b 8", $rv);
            echo "c:/audiowaveform/audiowaveform.exe -i $dest.mp3 -o $dest.mp3.dat -b 8 <br>" . PHP_EOL;
            system("c:/audiowaveform/audiowaveform.exe -i $dest.mp3 -o $_tmp -w 1280 -h 720 -z 1024 --border-color 00000000 --background-color 262626 --waveform-color 8A88FF --no-axis-labels", $rv);
            echo "c:/audiowaveform/audiowaveform.exe -i $dest.mp3 -o $_tmp -w 1280 -h 720 -z 1024 --border-color 00000000 --background-color 262626 --waveform-color 8A88FF --no-axis-labels <br>" . PHP_EOL;
        }

        TM4RENT\Thumbnail::generate($_tmp, $dest . '_150.jpg', 150, 150, 'inside', true);
        TM4RENT\Thumbnail::generate($_tmp, $dest . '_360.jpg', 360, 360, 'inside', true);
        TM4RENT\Thumbnail::generate($_tmp, $dest . '_720.jpg', 720, 540, 'inside', true);
        TM4RENT\Thumbnail::generate($_tmp, $dest . '_1280.jpg', 1280, 1280, 'inside', false);

        if (File::exists($_tmp)) {
            File::delete($_tmp);
        }
    }
}

if ($row = DB::row("SELECT * FROM content_files WHERE status = 0 AND mime LIKE 'audio/%' LIMIT 1")) {
    $src = DASHBOARD_DIR . '/uploads/content/' . $row['content_id'] . '/' . $row['filename'] . '.file';
    $watermark = DASHBOARD_DIR . '/assets/audio/watermark.wav';
    $dest = DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']) . '.mp3';

    Dir::create(File::path($dest));

    if (File::exists($dest)) {
        File::delete($dest);
    }

    // 1 = converting
    DB::update('content_files', ['status' => 1], ['id' => $row['id']]);

    if (PHP_OS_FAMILY === 'Windows') {
        system('c:/ffmpeg/bin/ffmpeg.exe -i ' . $src . ' -stream_loop -1 -i ' . $watermark . ' -filter_complex amix=inputs=2:duration=first -vn -ar 44100 -ac 2 -b:a 192k ' . $dest . " > NUL &", $rv);
        echo 'c:/ffmpeg/bin/ffmpeg.exe -i ' . $src . ' -stream_loop -1 -i ' . $watermark . ' -filter_complex amix=inputs=2:duration=first -vn -ar 44100 -ac 2 -b:a 192k ' . $dest . " > NUL & <br>" . PHP_EOL;
    } else {
        system('ffmpeg -i ' . $src . ' -stream_loop -1 -i ' . $watermark . ' -filter_complex amix=inputs=2:duration=first -vn -ar 44100 -ac 2 -b:a 192k ' . $dest . " > /dev/null &", $rv);
        echo 'ffmpeg -i ' . $src . ' -stream_loop -1 -i ' . $watermark . ' -filter_complex amix=inputs=2:duration=first -vn -ar 44100 -ac 2 -b:a 192k ' . $dest . " > /dev/null & <br>" . PHP_EOL;
    }
}