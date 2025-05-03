<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicData extends Controller
{
    public function testt()
    {
        return response()->json(['message' => 'Hello World!!']);
    }
}
