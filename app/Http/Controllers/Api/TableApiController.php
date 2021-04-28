<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TableService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;

class TableApiController extends Controller
{
    protected $tableService;
    
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function tablesByTenant($uuid)
    {
        try {
            $table = $this->tableService->getTableByTenantUuid($uuid);
            return TableResource::collection($table);
        } catch (\Throwable $e) {
            //throw $th;
            return $this->errorResponse($e->getMessage());
        }

    }
}
