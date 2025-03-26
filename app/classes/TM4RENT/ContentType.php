<?php

namespace TM4RENT;

use Loader, File, Dir;
use WideImage\Exception\Exception;

class ContentType
{

    private ?array $images;

    public function __construct(
        private readonly int $id,
        private int $position,
        private int $parent,
        private ?string $icon,
        private ?string $image,
        private string $name,
        private string $title,
        private ?string $description,
    ) {
        if ($this->image && ($img_decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $this->image)))) {
            Loader::addDirectory(DASHBOARD_DIR . '/libraries/ImageProcessing/');

            try {
                Dir::create(DASHBOARD_DIR . TEMP_DIR . '/cache/content_types');

                $sizes = [
                    '1x1' => ['w' => 720, 'h' => 720],
                    '4x3' => ['w' => 720, 'h' => 540],
                    '16x9' => ['w' => 1280, 'h' => 720],
                ];

                foreach (array_keys($sizes) as $size) {
                    $_file = DASHBOARD_DIR . TEMP_DIR . "/cache/content_types/${id}_${size}.png";
                    if (File::exists($_file)) {
                        $this->images[$size] = TEMP_DIR . "/cache/content_types/${id}_${size}.png?v=" . (int)File::lastChange($_file);
                    } else {
                        $image_src = \WideImage\WideImage::loadFromString($img_decoded);
                        $_img = $image_src->resize($sizes[$size]['w'], $sizes[$size]['h'], 'outside')->crop("center", "middle", $sizes[$size]['w'], $sizes[$size]['h'])->asString('png');
                        $this->images[$size] = 'data:image/png;base64,' . base64_encode($_img);
                        File::putContents($_file, $_img);
                    }
                }
            } catch (Exception $exception) {
                $this->images = null;
            }
        } else {
            $this->images = null;
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'parent' => $this->parent,
            'icon' => $this->icon,
            'image' => $this->image,
            'images' => $this->images,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

}
