<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
       $items = Category::latest()->paginate(5);
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

    public function store(CategoryRequest $request)
    {
        $create = Category::create($request->all());

        return response()->json($create);
    }

    public function update(CategoryRequest $request, $id)
    {
        $edit = Category::find($id)->update($request->all());

        return response()->json($edit);
    }

    public function destroy($id)
    {
        $delete = Category::find($id)->delete();

        return response()->json($delete);
    }
    public function fetchCategoriesList()
    {
       $items = Category::all();

       return response()->json($items);
    }

}
