<?php

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/expenses', function() {
return response()->json(Expense::all()->map(function ($expense) {
return [
'title' => $expense->amount . '円 (' . $expense->category . ')',
'start' => $expense->date,
'url' => url('/expenses/' . $expense->id . '/edit'),
];
}));
});