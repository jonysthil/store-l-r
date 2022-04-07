<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller {
    public function index() {
        try {
            $categories = Category::getAll();
            if($categories->isEmpty()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            DB::commit();
            return response()->json(['message' => 'success', 'categories' => $categories], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }

    }

    public function create() {}

    public function store(Request $request) {
        try {
            $data = array(
                'cat_name' => $request->name,
            );
            $category = Category::insertData($data);
            DB::commit();
            return response()->json(['message' => 'Categoria registrada con éxito', 'category' => $category], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show($id) {
        try {
            $category = Category::getData($id);
            if(!$category->exists()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            DB::commit();
            return response()->json(['message' => 'success', 'category' => $category], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function edit(Category $categories) {}

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $category = Category::getData($id);
            if(!$category->exists()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            $data = array(
                'cat_name' => $request->name
            );
            Category::updateData($id, $data);
            DB::commit();
            return response()->json(['message' => 'Categoria actualizada con éxito'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $category = Category::getData($id);
            if(!$category->exists()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            Category::deleteData($id);
            DB::commit();
            return response()->json(['message' => 'Categoria eliminada con éxito'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
