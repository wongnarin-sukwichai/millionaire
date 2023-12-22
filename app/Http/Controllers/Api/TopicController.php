<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Topic::where('shop_id', Auth::user()->shop_id)->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'title' => 'required'
        ]);

        $data = new Topic();

        $data->shop_id = Auth::user()->shop_id;
        $data->group_id = $request['id'];
        $data->title = $request['title'];

        $data->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Topic::find($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Topic::find($id);

        if ($data->shop_id == Auth::user()->shop_id) {
            $data->delete();
        } else {
            return response()->json([
                'message' => 'เฉพาะสิทธิ์เจ้าของร้านเท่านั้น'
            ]);
        }
    }
}
