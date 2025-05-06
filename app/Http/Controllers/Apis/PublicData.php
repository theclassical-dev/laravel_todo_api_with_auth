<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\PublicData as ModelPublicData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PublicData extends Controller
{
    public function index()
    {

        //
        $data = ModelPublicData::all();
        return response()->json(['data' => $data]);
    }
}
