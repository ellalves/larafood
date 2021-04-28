<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\CategoryResource;

class CategoryApiController extends ApiController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
       $this->categoryService = $categoryService;
    }

    public function CategoriesByTenant($uuid)
    {
        try {
            $categories = $this->categoryService->getCategoriesByUuid($uuid);
        
            return  $this->successResponse(CategoryResource::collection($categories));
        } catch (\Exception $e) {
            //throw $th;

            return $this->errorResponse($e->getMessage());
        }
    }
}
