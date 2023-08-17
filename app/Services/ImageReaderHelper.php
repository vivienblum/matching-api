<?php

namespace App\Services;

use BrianMcdo\ImagePalette\ImagePalette;

class ImageReaderHelper
{
    public function getDominants(string $url): ?array
    {
        $palette = new ImagePalette($url, 1);

        return $palette->getColors();
    }

    public function getDominant(string $url): ?array
    {
        $colors = $this->getDominants($url);

        return [
            'red' => optional($colors[0])->r,
            'green' => optional($colors[0])->g,
            'blue' => optional($colors[0])->b,
        ];
    }

    public function getAverage(string $url): array
    {
        $colors = $this->getDominants($url);

        $red = 0;
        $green = 0;
        $blue = 0;
        foreach ($colors as $color) {
            $red += $color->r;
            $green += $color->g;
            $blue += $color->b;
        }

        return [
            'red' => (int) ($red / count($colors)),
            'green' => (int) ($green / count($colors)),
            'blue' => (int) ($blue / count($colors)),
        ];
    }

    public function getBasicAverage(string $url): array
    {
        [$width, $height] = getimagesize($url);

        $extension = substr(strrchr($url, '.'), 1);

        switch ($extension) {
            case 'jpg':
                $image = imagecreatefromjpeg($url);
                break;
            case 'png':
                $image = imagecreatefrompng($url);
                break;
        }

        if (!$image) {
            throw new Exception("Image type: {$extension} not valid (jpg, png)");
        }

        $red = 0;
        $green = 0;
        $blue = 0;
        $nbPixels = 0;
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($image, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $alpha = ($rgb & 0x7F000000) >> 24;
                if ($alpha === 127) {
                    continue;
                }

                $red += $r;
                $green += $g;
                $blue += $b;
                $nbPixels++;
            }
        }

        return [
            'red' => (int) ($red / $nbPixels),
            'green' => (int) ($green / $nbPixels),
            'blue' => (int) ($blue / $nbPixels),
        ];
    }
}
