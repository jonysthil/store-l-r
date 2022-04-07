<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    public function index() {
        try {
            $products = Product::getAll();
            if($products->isEmpty()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            DB::commit();
            return response()->json(['message' => 'success', 'products' => $products], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }

    }

    public function create() {}

    public function store(Request $request) {
        try {
            $data = array(
                'prod_status' => $request->status,
                'prod_name' => $request->name,
                'prod_type' => $request->type,
                'prod_property' => $request->property,
                'prod_source' => $request->source,
                'prod_vehicle_make' => $request->vehicle_make,
                'prod_scale' => $request->scale
            );
            $product = Product::insertData($data);
            DB::commit();
            return response()->json(['message' => 'Producto registrado con éxito', 'product' => $product], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function show($id) {
        try {
            $product = Product::getData($id);
            if(!$product->exists()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            DB::commit();
            return response()->json(['message' => 'success', 'products' => $product], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function edit(Product $product) {}

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $product = Product::getData($id);
            if(!$product->exists()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            $data = array(
                'prod_status' => $request->status,
                'prod_name' => $request->name,
                'prod_type' => $request->type,
                'prod_property' => $request->property,
                'prod_source' => $request->source,
                'prod_vehicle_make' => $request->vehicle_make,
                'prod_scale' => $request->scale
            );
            Product::updateData($id, $data);
            DB::commit();
            return response()->json(['message' => 'Producto actualizado con éxito'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $product = Product::getData($id);
            if(!$product->exists()) { DB::rollBack(); return response()->json(['message' => 'No existen registros'], 400); }
            Product::deleteData($id);
            DB::commit();
            return response()->json(['message' => 'Producto eliminado con éxito'], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
