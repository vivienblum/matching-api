<?php

namespace Tests\Unit\Services;

use App\Services\ImageReaderHelper;
use PHPUnit\Framework\TestCase;

class ImageReaderHelperTest extends TestCase
{
    private ImageReaderHelper $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new ImageReaderHelper();
    }

    public function testGetAverageColor(): void
    {
        $color = $this->sut->getAverage('tests/mixtures/ping-pong.png');

        $expectedColor = [
            'red' => 151,
            'green' => 99,
            'blue' => 105,
        ];
        $this->assertSame($expectedColor, $color);
    }

    public function testGetDominantColor(): void
    {
        $color = $this->sut->getDominant('tests/mixtures/ping-pong.png');

        $expectedColor = [
            'red' => 204,
            'green' => 102,
            'blue' => 51,
        ];
        $this->assertSame($expectedColor, $color);
    }
}
