<?php

namespace TM4RENT;

use Dir;
use File;
use Loader;

class Thumbnail
{

    public static function generate(string $source, string $destination, int $width = 150, int $height = 150, string $fit = 'inside', bool $fill = false, string $watermark = null, string $fallback = DASHBOARD_DIR . '/assets/images/thumb_file.jpg'): string
    {
        Loader::addDirectory(DASHBOARD_DIR . '/libraries/ImageProcessing/');

        if ($_src = File::getContents($source)) {
            try {
                Dir::create(File::path($destination));

                $_watermark = null;

                if ($watermark) {
                    $_watermark = \WideImage\WideImage::load(DASHBOARD_DIR . '/assets/images/watermark-mix.png');
                }

                if ($fill) {
                    $img_thumb = \WideImage\WideImage::loadFromString($_src);
                    $img_thumb_combine = \WideImage\WideImage::loadFromString($_src);

                    $thumb = $img_thumb
                        ->autoCrop(10, 8)
                        ->resize($width, $height, $fit)
                        ->crop('center', 'middle', $width, $height)
                        ->asString('jpeg');

                    if ($_watermark) {
                        $img_thumb_combine
                            ->resize(1, 1, 'fill')
                            ->resize($width, $height, 'fill')
                            ->merge(\WideImage\WideImage::loadFromString($thumb), 'center', 'middle', 100)
                            ->merge($_watermark, 'center', 'middle', 100)
                            ->saveToFile($destination, 80);
                    } else {
                        $img_thumb_combine
                            ->resize(1, 1, 'fill')
                            ->resize($width, $height, 'fill')
                            ->merge(\WideImage\WideImage::loadFromString($thumb), 'center', 'middle', 100)
                            ->saveToFile($destination, 80);
                    }

                } else {
                    $thumb = \WideImage\WideImage::loadFromString($_src);

                    if ($_watermark) {
                        $thumb
                            ->autoCrop(10, 8)
                            ->resize($width, $height, $fit)
                            ->crop('center', 'middle', $width, $height)
                            ->merge($_watermark, 'center', 'middle', 100)
                            ->saveToFile($destination, 80);
                    } else {
                        $thumb
                            ->autoCrop(10, 8)
                            ->resize($width, $height, $fit)
                            ->crop('center', 'middle', $width, $height)
                            ->saveToFile($destination, 80);
                    }

                }

                return $destination;
            } catch (\Exception $e) {
            }
        }

        return $fallback;
    }

}