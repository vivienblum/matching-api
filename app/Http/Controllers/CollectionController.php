<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Models\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;

class CollectionController extends Controller
{
    public function index()
    {
        $data = Collection::get();

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    public function store(StoreCollectionRequest $request)
    {
        $collection = Collection::create($request->only([
            'name',
            'available',
            'delta',
            'has_popularity',
        ]));

        return new JsonResponse($collection->toArray(), JsonResponse::HTTP_CREATED);
    }

    public function show(Collection $collection)
    {
        return new JsonResponse($collection->toArray(), JsonResponse::HTTP_OK);
    }

    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $collection->update($request->only([
            'name',
            'available',
            'delta',
            'has_popularity',
        ]));

        return new JsonResponse($collection->toArray(), JsonResponse::HTTP_OK);
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
