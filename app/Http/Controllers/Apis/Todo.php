<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoR;
use App\Models\Todo as ModelsTodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Todo extends Controller
{

    protected $user;

    public function __construct()
    {

        $this->user = Auth::user();
    }

    public function index()
    {

        //
        $data = ModelsTodo::where('user_id', $this->user->id)->get();

        //
        if (is_null($data)) {
            return response()->json(['data' => null]);
        }

        //
        return response()->json(['data' => $data]);
    }

    public function addTodo(TodoR $request)
    {

        //validate
        $data = $request->validated();

        //instance
        $todo = new ModelsTodo();

        //
        $todo->user_id = $this->user->id;
        $todo->title = $data['title'];
        $todo->desc = $data['desc'];
        $todo->due_date  = $data['due_date'];

        //
        $todo->save();

        //
        return response()->json(['data' => $data]);
    }
}
