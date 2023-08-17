<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransformationRequest;
use App\Http\Requests\UpdateTransformationRequest;
use App\Models\Transformation;
use Symfony\Component\HttpFoundation\JsonResponse;

class TransformationController extends Controller
{
    public function index()
    {
        $data = Transformation::get();

        return new JsonResponse($data, JsonResponse::HTTP_OK);
    }

    public function store(StoreTransformationRequest $request)
    {
        $transformation = new Transformation();
        // TODO store file in AWS
        // Create transformation

        return new JsonResponse($transformation->toArray(), JsonResponse::HTTP_CREATED);
    }

    public function show(Transformation $transformation)
    {
        return new JsonResponse($transformation->toArray(), JsonResponse::HTTP_OK);
    }
}
