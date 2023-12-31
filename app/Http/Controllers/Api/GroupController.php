<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Group::where('shop_id', Auth::user()->shop_id)->get();

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
            'title' => 'required'
        ]);

        $data = new Group();

        $data->shop_id = Auth::user()->shop_id;
        $data->title = $request['title'];

        $data->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Group::find($id);

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
        $data = Group::find($id);

        if ($data->shop_id == Auth::user()->shop_id) {
            $data->delete();
        } else {
            return response()->json([
                'message' => 'เฉพาะสิทธิ์เจ้าของร้านเท่านั้น'
            ]);
        }
    }
}
