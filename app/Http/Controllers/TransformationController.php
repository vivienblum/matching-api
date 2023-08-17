<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransformationRequest;
use App\Models\Collection;
use App\Models\Transformation;
use App\Services\Transformer;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;

class TransformationController extends Controller
{
    private Transformer $transformer;

    public function __construct(Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function index()
    {
        $data = Transformation::get();

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    public function store(StoreTransformationRequest $request)
    {
        if ($request->hasFile('image')) {
            $collection = Collection::find($request->get('collection_id'));
            $collectionName = str_replace(' ', '-', trim($collection->name));
            $extension = $request->image->extension();
            $time = time();

            $imageName = "{$collectionName}-{$time}.{$extension}";
            $directory = "transformations/collections/{$collectionName}";

            $path = Storage::disk('s3')->putFileAs($directory, $request->image, $imageName);
            $url = Storage::url($path);

            $transformation = Transformation::create([
                'image_url' => $url,
                'collection_id' => $request->get('collection_id'),
            ]);

            $this->transformer->transform($transformation, 'ab');
        }

        return new JsonResponse($transformation->toArray(), JsonResponse::HTTP_CREATED);
    }

    public function show(Transformation $transformation)
    {
        return new JsonResponse($transformation->toArray(), JsonResponse::HTTP_OK);
    }
}
