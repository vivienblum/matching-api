<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Collection;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemController extends Controller
{
    public function index()
    {
        //
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

            $item = $collection->items()->create([
                'name' => $request->get('name'),
                'image_url' => $url,
                'popularity' => $request->get('popularity'),
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
