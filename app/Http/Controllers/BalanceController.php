<?php

namespace App\Http\Controllers;

use App\Http\Resources\BalanceResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function total(): JsonResponse
    {
        return response()->json(['data' => ['total' => 430, 'incomes' => 1000, 'bills' => 570]]);
    }
}
