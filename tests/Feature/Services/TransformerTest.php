<?php

namespace Tests\Feature\Services;

use App\Models\Collection;
use App\Models\Transformation;
use App\Services\Transformer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Collection as IlluminateCollection;

class TransformerTest extends TestCase
{
    use DatabaseMigrations;

    private Transformer $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new Transformer();

        $this->collection = Collection::create([
            'name' => 'Test',
            'has_popularity' => false,
            'delta' => 0,
            'available' => true,
        ]);
        $this->red1 = $this->collection->items()->create([
            'name' => 'Red 1',
            'a_red' => 255,
            'a_green' => 0,
            'a_blue' => 0,
        ]);
        $this->red2 = $this->collection->items()->create([
            'name' => 'Red 2',
            'a_red' => 200,
            'a_green' => 50,
            'a_blue' => 50,
        ]);
        $this->red3 = $this->collection->items()->create([
            'name' => 'Red 3',
            'a_red' => 150,
            'a_green' => 75,
            'a_blue' => 75,
        ]);
        $this->red4 = $this->collection->items()->create([
            'name' => 'Red 4',
            'a_red' => 120,
            'a_green' => 90,
            'a_blue' => 90,
        ]);
        $this->green1 = $this->collection->items()->create([
            'name' => 'Green 1',
            'a_red' => 0,
            'a_green' => 255,
            'a_blue' => 0,
        ]);
        $this->green2 = $this->collection->items()->create([
            'name' => 'Green 2',
            'a_red' => 50,
            'a_green' => 200,
            'a_blue' => 50,
        ]);
        $this->green3 = $this->collection->items()->create([
            'name' => 'Green 3',
            'a_red' => 75,
            'a_green' => 150,
            'a_blue' => 75,
        ]);
        $this->green4 = $this->collection->items()->create([
            'name' => 'Green 4',
            'a_red' => 90,
            'a_green' => 120,
            'a_blue' => 90,
        ]);
        $this->blue1 = $this->collection->items()->create([
            'name' => 'Blue 1',
            'a_red' => 0,
            'a_green' => 0,
            'a_blue' => 255,
        ]);
        $this->blue2 = $this->collection->items()->create([
            'name' => 'Blue 2',
            'a_red' => 50,
            'a_green' => 50,
            'a_blue' => 200,
        ]);
        $this->blue3 = $this->collection->items()->create([
            'name' => 'Blue 1',
            'a_red' => 75,
            'a_green' => 75,
            'a_blue' => 150,
        ]);
        $this->blue4 = $this->collection->items()->create([
            'name' => 'Blue 4',
            'a_red' => 90,
            'a_green' => 90,
            'a_blue' => 120,
        ]);
        $this->black1 = $this->collection->items()->create([
            'name' => 'Black 1',
            'a_red' => 0,
            'a_green' => 0,
            'a_blue' => 0,
        ]);
        $this->black2 = $this->collection->items()->create([
            'name' => 'Black 2',
            'a_red' => 50,
            'a_green' => 50,
            'a_blue' => 50,
        ]);
        $this->white1 = $this->collection->items()->create([
            'name' => 'White 1',
            'a_red' => 255,
            'a_green' => 255,
            'a_blue' => 255,
        ]);
        $this->white2 = $this->collection->items()->create([
            'name' => 'White 2',
            'a_red' => 200,
            'a_green' => 200,
            'a_blue' => 200,
        ]);

        $this->items = new IlluminateCollection([
            $this->red1,
            $this->red2,
            $this->red3,
            $this->red4,
            $this->green1,
            $this->green2,
            $this->green3,
            $this->green4,
            $this->blue1,
            $this->blue2,
            $this->blue3,
            $this->blue4,
            $this->black1,
            $this->black2,
            $this->white1,
            $this->white2,
        ]);
    }

    public function testItGetClosestColorForRed(): void
    {
        $color = [
            'red' => 217,
            'green' => 32,
            'blue' => 98,
        ];

        $item = $this->sut->getClosestItem($color, $this->items, 'a');

        $this->assertSame($this->red2->id, $item->id);
    }

    public function testItGetClosestColorForBlue(): void
    {
        $color = [
            'red' => 22,
            'green' => 78,
            'blue' => 190,
        ];

        $item = $this->sut->getClosestItem($color, $this->items, 'a');

        $this->assertSame($this->blue2->id, $item->id);
    }

    public function testItTransformsForLandscapeImage(): void
    {
        $transformation = Transformation::create([
            'image_url' => 'tests/mixtures/big-image-pixelated-landscape.png',
            'collection_id' => $this->collection->id,
        ]);

        $freshTransformation = $this->sut->transform($transformation, 'a');

        $expectedPattern = [
            [
                $this->blue2->id,
                $this->blue2->id,
                $this->blue2->id,
                $this->blue2->id,
                $this->blue2->id,
                $this->blue2->id,
                $this->blue2->id,
                $this->blue2->id,
            ],
            [
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
            ],
            [
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
            ],
            [
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
                $this->white2->id,
                $this->green4->id,
                $this->green4->id,
                $this->green4->id,
            ],
            [
                $this->green1->id,
                $this->green4->id,
                $this->green4->id,
                $this->red2->id,
                $this->red3->id,
                $this->green4->id,
                $this->green1->id,
                $this->green4->id,
            ],
        ];
        $expectedItems = [
            $this->green4->toArray() + ['quantity' => 27],
            $this->blue2->toArray() + ['quantity' => 8],
            $this->green1->toArray() + ['quantity' => 2],
            $this->white2->toArray() + ['quantity' => 1],
            $this->red2->toArray() + ['quantity' => 1],
            $this->red3->toArray() + ['quantity' => 1],
        ];
        $this->assertSame($expectedPattern, $freshTransformation->pattern);
        //$this->assertSame($expectedItems, $freshTransformation->items);
    }

    public function testItTransformsForPortrait(): void
    {
        $transformation = Transformation::create([
            'image_url' => 'tests/mixtures/big-image-pixelated-portrait.png',
            'collection_id' => $this->collection->id,
        ]);

        $freshTransformation = $this->sut->transform($transformation, 'a');

        $expectedPattern = [
            [
                $this->white1->id,
                $this->white1->id,
                $this->white1->id,
                $this->white1->id,
                $this->white1->id,
                $this->white1->id,
            ],
            [
                $this->white1->id,
                $this->white1->id,
                $this->red1->id,
                $this->red2->id,
                $this->black1->id,
                $this->white1->id,
            ],
            [
                $this->white1->id,
                $this->black1->id,
                $this->black1->id,
                $this->black1->id,
                $this->white1->id,
                $this->white1->id,
            ],
            [
                $this->white1->id,
                $this->white1->id,
                $this->red2->id,
                $this->black1->id,
                $this->black1->id,
                $this->white1->id,
            ],
            [
                $this->white1->id,
                $this->white1->id,
                $this->white1->id,
                $this->black1->id,
                $this->white1->id,
                $this->white1->id,
            ],
            [
                $this->white1->id,
                $this->black1->id,
                $this->green3->id,
                $this->red4->id,
                $this->green3->id,
                $this->white1->id,
            ],
            [
                $this->white1->id,
                $this->white1->id,
                $this->green3->id,
                $this->red4->id,
                $this->black1->id,
                $this->white1->id,
            ],
        ];
        $this->assertSame($expectedPattern, $freshTransformation->pattern);
    }
}
