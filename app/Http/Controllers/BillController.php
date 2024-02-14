<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {

        $restaurant = Bill::all();

        return response()->json($restaurant, 200);
    }

    public function show($id)
    {

        $restaurant = Bill::find($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return response()->json($restaurant, 200);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $restaurant = Bill::create($data);

        return response()->json($restaurant, 201);
    }

    public function update(Request $request, $id)
    {

        $restaurant = Bill::find($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        $data = $request->all();
        $restaurant->update($data);

        return response()->json($restaurant, 200);
    }

    public function destroy($id)
    {

        $restaurant = Bill::find($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        $restaurant->delete();

        return response()->json(['message' => 'Resource deleted'], 200);
    }
}
