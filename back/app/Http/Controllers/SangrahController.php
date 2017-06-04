<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sangrah;
use App\Http\Requests\SangrahRequest;

class SangrahController extends Controller
{
    public function index()
    {

    $items = Sangrah::with('category', 'god')->paginate(5);
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

    public function store(SangrahRequest $request)
    {
        $create = Sangrah::create($request->all());

        return response()->json($create);
    }

    public function update(SangrahRequest $request, $id)
    {
        $edit = Sangrah::find($id)->update($request->all());

        return response()->json($edit);
    }

    public function destroy($id)
    {
        $delete = Sangrah::find($id)->delete();

        return response()->json($delete);
    }
}
