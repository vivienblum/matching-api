<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Collection;
use App\Models\Item;
use App\Services\ImageReaderHelper;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemController extends Controller
{
    private ImageReaderHelper $imageReaderHelper;

    public function __construct(ImageReaderHelper $imageReaderHelper)
    {
        $this->imageReaderHelper = $imageReaderHelper;
    }

    public function index(Collection $collection)
    {
        return new JsonResponse($collection->items, JsonResponse::HTTP_OK);
    }

    public function store(StoreItemRequest $request, Collection $collection)
    {
        if ($request->hasFile('image')) {
            $itemName = str_replace(' ', '-', trim($request->get('name')));
            $extension = $request->image->extension();
            $time = time();

            $imageName = "{$itemName}-{$time}.{$extension}";
            $directory = "collections/{$collection->id}/items";

            $path = Storage::disk('s3')->putFileAs($directory, $request->image, $imageName);
            $url = Storage::url($path);

            $dominantColor = $this->imageReaderHelper->getDominant($url);
            $averageColor = $this->imageReaderHelper->getAverage($url);
            $averageBasicColor = $this->imageReaderHelper->getBasicAverage($url);

            $item = $collection->items()->create([
                'name' => $request->get('name'),
                'image_url' => $url,
                'popularity' => $request->get('popularity', 1),
                'a_red' => $averageColor['red'],
                'a_green' => $averageColor['green'],
                'a_blue' => $averageColor['blue'],
                'd_red' => $dominantColor['red'],
                'd_green' => $dominantColor['green'],
                'd_blue' => $dominantColor['blue'],
                'ab_red' => $averageBasicColor['red'],
                'ab_green' => $averageBasicColor['green'],
                'ab_blue' => $averageBasicColor['blue'],
            ]);

            return new JsonResponse($item->toArray(), JsonResponse::HTTP_CREATED);
        }
    }

    public function show(Item $item)
    {
        return new JsonResponse($item->toArray(), JsonResponse::HTTP_OK);
    }

    public function update(UpdateItemRequest $request, Collection $collection, Item $item)
    {
        $item->update([
            'name' => $request->get('name'),
            'popularity' => $request->get('popularity'),
        ]);

        return new JsonResponse($item->toArray(), JsonResponse::HTTP_OK);
    }

    public function destroy(Collection $collection, Item $item)
    {
        $item->delete();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
