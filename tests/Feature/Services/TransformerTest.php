<?php

namespace Tests\Feature\Services;

use App\Services\Transformer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class TransformerTest extends TestCase
{
    use DatabaseMigrations;

    private Transformer $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new Transformer();
    }

    public function testItTransformsAnImageIntoMatrix(): void
    {
        $matrix = $this->sut->fromImageToMatrix('tests/mixtures/small-image.jpg');

        $expectedMatrix = [
            [
                [
                    'red' => 135,
                    'green' => 137,
                    'blue' => 87,
                ],
                [
                    'red' => 120,
                    'green' => 122,
                    'blue' => 72,
                ],
                [
                    'red' => 114,
                    'green' => 120,
                    'blue' => 74,
                ],
                [
                    'red' => 134,
                    'green' => 140,
                    'blue' => 94,
                ],
            ],
            [
                [
                    'red' => 126,
                    'green' => 128,
                    'blue' => 78,
                ],
                [
                    'red' => 134,
                    'green' => 136,
                    'blue' => 86,
                ],
                [
                    'red' => 76,
                    'green' => 82,
                    'blue' => 36,
                ],
                [
                    'red' => 134,
                    'green' => 140,
                    'blue' => 94,
                ],
            ],
            [
                [
                    'red' => 81,
                    'green' => 59,
                    'blue' => 35,
                ],
                [
                    'red' => 102,
                    'green' => 80,
                    'blue' => 56,
                ],
                [
                    'red' => 84,
                    'green' => 66,
                    'blue' => 46,
                ],
                [
                    'red' => 95,
                    'green' => 77,
                    'blue' => 57,
                ],
            ],
            [
                [
                    'red' => 93,
                    'green' => 71,
                    'blue' => 47,
                ],
                [
                    'red' => 128,
                    'green' => 106,
                    'blue' => 82,
                ],
                [
                    'red' => 117,
                    'green' => 99,
                    'blue' => 79,
                ],
                [
                    'red' => 85,
                    'green' => 67,
                    'blue' => 47,
                ],
            ],
            [
                [
                    'red' => 79,
                    'green' => 55,
                    'blue' => 53,
                ],
                [
                    'red' => 64,
                    'green' => 40,
                    'blue' => 38,
                ],
                [
                    'red' => 35,
                    'green' => 15,
                    'blue' => 17,
                ],
                [
                    'red' => 48,
                    'green' => 28,
                    'blue' => 30,
                ],
            ],
            [
                [
                    'red' => 61,
                    'green' => 37,
                    'blue' => 35,
                ],
                [
                    'red' => 111,
                    'green' => 87,
                    'blue' => 85,
                ],
                [
                    'red' => 55,
                    'green' => 35,
                    'blue' => 37,
                ],
                [
                    'red' => 43,
                    'green' => 23,
                    'blue' => 25,
                ],
            ],
            [
                [
                    'red' => 30,
                    'green' => 15,
                    'blue' => 22,
                ],
                [
                    'red' => 54,
                    'green' => 39,
                    'blue' => 46,
                ],
                [
                    'red' => 31,
                    'green' => 21,
                    'blue' => 32,
                ],
                [
                    'red' => 18,
                    'green' => 8,
                    'blue' => 19,
                ],
            ],
        ];
        $this->assertSame($expectedMatrix, $matrix);
    }

    public function testItReducesTheMatrixForPortrait(): void
    {
        $matrix = $this->sut->reduce('tests/mixtures/big-image-pixelated-portrait.png');

        $expectedMatrix = [
            [
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
            ],
            [
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 224,
                    'green' => 18,
                    'blue' => 28,
                ],
                [
                    'red' => 225,
                    'green' => 21,
                    'blue' => 32,
                ],
                [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 0,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
            ],
            [
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 2,
                ],
                [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 0,
                ],
                [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 0,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
            ],
            [
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 226,
                    'green' => 18,
                    'blue' => 31,
                ],
                [
                    'red' => 0,
                    'green' => 2,
                    'blue' => 1,
                ],
                [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 0,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
            ],
            [
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 2,
                    'green' => 0,
                    'blue' => 1,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
            ],
            [
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 1,
                    'green' => 0,
                    'blue' => 0,
                ],
                [
                    'red' => 100,
                    'green' => 165,
                    'blue' => 61,
                ],
                [
                    'red' => 136,
                    'green' => 196,
                    'blue' => 98,
                ],
                [
                    'red' => 100,
                    'green' => 165,
                    'blue' => 61,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
            ],
            [
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
                [
                    'red' => 100,
                    'green' => 165,
                    'blue' => 63,
                ],
                [
                    'red' => 135,
                    'green' => 195,
                    'blue' => 99,
                ],
                [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 0,
                ],
                [
                    'red' => 255,
                    'green' => 255,
                    'blue' => 255,
                ],
            ],
        ];
        $this->assertSame(7, count($matrix));
        $this->assertSame($expectedMatrix, $matrix);
    }

    public function testItReturnsSameMatrixWhileReducingWhenTheMatrixIsMin(): void
    {
        $matrix = $this->sut->reduce('tests/mixtures/small-image.jpg');

        $expectedMatrix = [
            [
                [
                    'red' => 135,
                    'green' => 137,
                    'blue' => 87,
                ],
                [
                    'red' => 120,
                    'green' => 122,
                    'blue' => 72,
                ],
                [
                    'red' => 114,
                    'green' => 120,
                    'blue' => 74,
                ],
                [
                    'red' => 134,
                    'green' => 140,
                    'blue' => 94,
                ],
            ],
            [
                [
                    'red' => 126,
                    'green' => 128,
                    'blue' => 78,
                ],
                [
                    'red' => 134,
                    'green' => 136,
                    'blue' => 86,
                ],
                [
                    'red' => 76,
                    'green' => 82,
                    'blue' => 36,
                ],
                [
                    'red' => 134,
                    'green' => 140,
                    'blue' => 94,
                ],
            ],
            [
                [
                    'red' => 81,
                    'green' => 59,
                    'blue' => 35,
                ],
                [
                    'red' => 102,
                    'green' => 80,
                    'blue' => 56,
                ],
                [
                    'red' => 84,
                    'green' => 66,
                    'blue' => 46,
                ],
                [
                    'red' => 95,
                    'green' => 77,
                    'blue' => 57,
                ],
            ],
            [
                [
                    'red' => 93,
                    'green' => 71,
                    'blue' => 47,
                ],
                [
                    'red' => 128,
                    'green' => 106,
                    'blue' => 82,
                ],
                [
                    'red' => 117,
                    'green' => 99,
                    'blue' => 79,
                ],
                [
                    'red' => 85,
                    'green' => 67,
                    'blue' => 47,
                ],
            ],
            [
                [
                    'red' => 79,
                    'green' => 55,
                    'blue' => 53,
                ],
                [
                    'red' => 64,
                    'green' => 40,
                    'blue' => 38,
                ],
                [
                    'red' => 35,
                    'green' => 15,
                    'blue' => 17,
                ],
                [
                    'red' => 48,
                    'green' => 28,
                    'blue' => 30,
                ],
            ],
            [
                [
                    'red' => 61,
                    'green' => 37,
                    'blue' => 35,
                ],
                [
                    'red' => 111,
                    'green' => 87,
                    'blue' => 85,
                ],
                [
                    'red' => 55,
                    'green' => 35,
                    'blue' => 37,
                ],
                [
                    'red' => 43,
                    'green' => 23,
                    'blue' => 25,
                ],
            ],
            [
                [
                    'red' => 30,
                    'green' => 15,
                    'blue' => 22,
                ],
                [
                    'red' => 54,
                    'green' => 39,
                    'blue' => 46,
                ],
                [
                    'red' => 31,
                    'green' => 21,
                    'blue' => 32,
                ],
                [
                    'red' => 18,
                    'green' => 8,
                    'blue' => 19,
                ],
            ],
        ];
        $this->assertSame($expectedMatrix, $matrix);
    }

    public function testItReducesTheMatrixForLandscape(): void
    {
        $matrix = $this->sut->reduce('tests/mixtures/big-image-pixelated-landscape.png');

        $expectedMatrix = [
            [
                [
                    'red' => 80,
                    'green' => 109,
                    'blue' => 229,
                ],
                [
                    'red' => 80,
                    'green' => 109,
                    'blue' => 229,
                ],
                [
                    'red' => 82,
                    'green' => 111,
                    'blue' => 231,
                ],
                [
                    'red' => 82,
                    'green' => 111,
                    'blue' => 231,
                ],
                [
                    'red' => 82,
                    'green' => 112,
                    'blue' => 232,
                ],
                [
                    'red' => 82,
                    'green' => 111,
                    'blue' => 231,
                ],
                [
                    'red' => 82,
                    'green' => 112,
                    'blue' => 232,
                ],
                [
                    'red' => 83,
                    'green' => 112,
                    'blue' => 232,
                ],
                [
                    'red' => 84,
                    'green' => 113,
                    'blue' => 233,
                ],
            ],
            [
                [
                    'red' => 100,
                    'green' => 123,
                    'blue' => 249,
                ],
                [
                    'red' => 101,
                    'green' => 130,
                    'blue' => 250,
                ],
                [
                    'red' => 102,
                    'green' => 131,
                    'blue' => 251,
                ],
                [
                    'red' => 102,
                    'green' => 131,
                    'blue' => 251,
                ],
                [
                    'red' => 102,
                    'green' => 131,
                    'blue' => 251,
                ],
                [
                    'red' => 102,
                    'green' => 131,
                    'blue' => 251,
                ],
                [
                    'red' => 102,
                    'green' => 131,
                    'blue' => 251,
                ],
                [
                    'red' => 102,
                    'green' => 131,
                    'blue' => 251,
                ],
                [
                    'red' => 103,
                    'green' => 132,
                    'blue' => 252,
                ],
            ],
            [
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
            ],
            [
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 110,
                    'green' => 136,
                    'blue' => 249,
                ],
                [
                    'red' => 234,
                    'green' => 209,
                    'blue' => 205,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 117,
                    'green' => 130,
                    'blue' => 241,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
            ],
            [
                [
                    'red' => 0,
                    'green' => 167,
                    'blue' => 0,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 204,
                    'green' => 112,
                    'blue' => 64,
                ],
                [
                    'red' => 148,
                    'green' => 67,
                    'blue' => 13,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 107,
                    'green' => 136,
                    'blue' => 254,
                ],
                [
                    'red' => 188,
                    'green' => 255,
                    'blue' => 25,
                ],
                [
                    'red' => 109,
                    'green' => 136,
                    'blue' => 254,
                ],
            ],
        ];
        $this->assertSameSize($expectedMatrix, $matrix);
    }
}
