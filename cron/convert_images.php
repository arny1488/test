<?php

// System initialisation
require_once __DIR__ . '/../system/init.php';

$data = DB::query("SELECT * FROM content_files WHERE status = 0 AND mime LIKE 'image/%' LIMIT 10");

foreach ($data as $row) {
    // 1 = converting
    DB::update('content_files', ['status' => 1], ['id' => $row['id']]);

    $src = DASHBOARD_DIR . '/uploads/content/' . $row['content_id'] . '/' . $row['filename'] . '.file';
    $dest = DASHBOARD_DIR . '/uploads/converted/' . File::hashPath($row['filename']);
    $watermark = DASHBOARD_DIR . '/assets/images/watermark-mix.png';

    Dir::create(File::path($dest));
    File::delete($dest . '*.jpg');

    TM4RENT\Thumbnail::generate($src, $dest . '_150.jpg', 150, 150, 'inside', true);
    TM4RENT\Thumbnail::generate($src, $dest . '_360.jpg', 360, 360, 'inside', true);
    TM4RENT\Thumbnail::generate($src, $dest . '_720.jpg', 720, 540, 'inside', true);
    TM4RENT\Thumbnail::generate($src, $dest . '_1280.jpg', 1280, 1280, 'inside', false, $watermark);

    if (
        File::exists($dest . '_150.jpg') && (File::mime($dest . '_150.jpg', false) === 'image/jpeg') &&
        File::exists($dest . '_360.jpg') && (File::mime($dest . '_360.jpg', false) === 'image/jpeg') &&
        File::exists($dest . '_720.jpg') && (File::mime($dest . '_720.jpg', false) === 'image/jpeg') &&
        File::exists($dest . '_1280.jpg') && (File::mime($dest . '_1280.jpg', false) === 'image/jpeg')
    ) {
        // 2 = converted
        DB::update('content_files', ['status' => 2], ['id' => $row['id']]);
    } else {
        // 0 = uploaded and not converted
        DB::update('content_files', ['status' => 0], ['id' => $row['id']]);
        File::delete($dest . '*.jpg');
    }
}