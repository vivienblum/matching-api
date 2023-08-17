<?php

namespace App\Services;

use App\Models\Transformation;
use Exception;

class Transformer
{
    public function fromImageToMatrix(string $url): array
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

        $matrix = [];
        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($image, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $matrix[$y][$x] = [
                    'red' => $r,
                    'green' => $g,
                    'blue' => $b,
                ];
            }
        }

        return $matrix;
    }

    public function reduce(string $url): array
    {
        $matrix = $this->fromImageToMatrix($url);
        //
        $maxHeight = 0;
        $maxWidth = 0;
        [$width, $height] = getimagesize($url);
        for ($y = 0; $y < $height; $y++) {
            $tmpWidth = 1;

            for ($x = 0; $x < $width; $x++) {
                if ($x < $width - 1) {
                    $tmpWidth += $matrix[$y][$x] === $matrix[$y][$x + 1] ? 0 : 1;
                }
            }

            if ($tmpWidth >= $maxWidth) {
                $maxWidth = $tmpWidth;
            }
        }

        for ($x = 0; $x < $width; $x++) {
            $tmpHeight = 1;
            for ($y = 0; $y < $height; $y++) {
                if ($y < $height - 1) {
                    $tmpHeight += $matrix[$y][$x] === $matrix[$y + 1][$x] ? 0 : 1;
                }
            }

            if ($tmpHeight >= $maxHeight) {
                $maxHeight = $tmpHeight;
            }
        }

        $reducedMatrix = [];
        $heightStep = (int) ceil($height/$maxHeight);
        $widthStep = (int) ceil($width/$maxWidth);

        for ($y = $heightStep/2; $y <= $height; $y += $heightStep) {
            $row = [];
            for ($x = $widthStep/2; $x < $width; $x += $widthStep) {
                $row[] = $matrix[$y][$x];
            }

            $reducedMatrix[] = $row;
        }

        return $reducedMatrix;
    }
}
