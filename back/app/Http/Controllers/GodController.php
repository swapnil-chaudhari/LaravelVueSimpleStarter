<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\God;
use App\Http\Requests\GodRequest;

class GodController extends Controller
{
    public function index()
    {
       $items = God::latest()->paginate(5);
       $response = [
           'pagination' => [
               'total' => $items->total(),
               'per_page' => $items->perPage(),
               'current_page' => $items->currentPage(),
               'last_page' => $items->lastPage(),
               'from' => $items->firstItem(),
               'to' => $items->lastItem()
           ],
           'data' => $items
       ];

       return response()->json($response);
    }

    public function store(GodRequest $request)
    {
        $create = God::create($request->all());

        return response()->json($create);
    }

    public function update(GodRequest $request, $id)
    {
        $edit = God::find($id)->update($request->all());

        return response()->json($edit);
    }

    public function destroy($id)
    {
        $delete = God::find($id)->delete();

        return response()->json($delete);
    }
    public function fetchGodsList()
    {
       $items = God::all();

       return response()->json($items);
    }
}
