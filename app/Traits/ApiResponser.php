<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiResponser {

	/**
	 * Data Response
	 * @param $data
	 * @return JsonResponse
	 */
	public function dataResponse($data): JsonResponse
	{
		return response()->json(['content' => $data], Response::HTTP_OK);
	}

	/**
	 * Success Response
	 * @param string $message
	 * @param int $code
	 * @return JsonResponse
	 */
	public function successResponse($data, $message = null, $code = Response::HTTP_OK): JsonResponse
	{
		return response()->json([
			'status'=> 'success', 
			'message' => $message, 
			'data' => $data
		], $code);
	}

	/**
	 * Error Response
	 * @param $message
	 * @param int $code
	 * @return JsonResponse
	 *
	 */
	public function errorResponse($message = null, $code = Response::HTTP_BAD_REQUEST): JsonResponse
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}
}