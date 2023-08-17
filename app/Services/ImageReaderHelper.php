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
}
