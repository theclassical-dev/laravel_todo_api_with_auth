<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoR;
use App\Models\Todo as ModelsTodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoCon extends Controller
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

        //convert all dtring to lower case
        $data = array_map('strtolower', $data);

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

    public function updateTodo($id, TodoR $request)
    {

        //
        $data = $request->validated();

        //convert all dtring to lower case
        $data = array_map('strtolower', $data);

        //check
        $todo = $this->user->todo->where('uuid', $id)->first();

        if (!$todo) {
            return response()->json(['message' => 'Data not found']);
        }

        //update
        $todo->update([
            'title' => $data['title'],
            'desc' => $data['desc'],
            'due_date' => $data['due_date'],
        ]);

        return response()->json(['message' => 'successful']);
    }


    public function updateStatus($id)
    {

        //
        $todo = $this->user->todo->where('uuid', $id)->first();
        // return $todo;

        //
        if (!$todo) {
            return response()->json(['message' => 'Data not found']);
        }

        //update
        //0 == undone and still not yet due. 1 == done. '-' == todo is due

        if ($todo->status == 0 || $todo->status == '0' || $todo->status == '-') {
            $todo->update(['status' => 1]);
        } else {
            $todo->update(['status' => 0]);
        }


        return response()->json(['message' => 'successful']);
    }

    public function searchTodo(Request $request)
    {

        $request->validate([
            'search' => 'nullable|string',
        ]);

        //
        $search = $request->get('search');

        // dd($search);

        //
        if (empty($search)) {
            return response()->json([
                'message' => 'enter a key word'
            ]);
        }

        //
        $user_id = $this->user->id;

        //
        $todo = ModelsTodo::where('user_id', $user_id)->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
                ->orWhere('desc', 'like', "%$search%");
        })->get();


        //
        if ($todo->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No record is found.'
            ]);
        }


        return response()->json([
            'success' => true,
            'data' => $todo
        ]);
    }

    public function deleteTodo($id)
    {

        //
        $todo = $this->user->todo->where('uuid', $id)->first();

        //
        if (!$todo) {
            return response()->json(['message' => 'Data not found']);
        }

        //
        $todo->delete($todo);

        return response()->json(['message' => 'successful']);
    }
}
