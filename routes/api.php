<?php

use App\Models\Fal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('user', function (Request $request) {
    $user = User::where('mobile', '=', $request['mobile'])->first();

    if ($user === null) {
        $user = User::create(['mobile' => $request['mobile'], 'name' => $request['name'],]);
    }

    return response()->json(['data' => $user]);
});


Route::put('user', function (Request $request) {
    $user = User::where('mobile', '=', $request['mobile'])->first();

    if ($user !== null) {
        $user = $user->fill(['variant' => $request['variant'], 'gender' => $request['gender']])->save();
    }

    return response()->json(['data' => $user]);
});


Route::post('fal/user', function (Request $request) {
    $user = Fal::updateOrCreate(
        ['mobile' => $request->mobile],
        [
            'mobile' => $request?->mobile,
            'name' => $request?->name,
        ]
    );
    return response()->json(['data' => $user]);
});
