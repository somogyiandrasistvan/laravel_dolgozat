<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTypeController extends Controller
{
    public function index()
    {
        $types = response()->json(ProductType::all());
        return $types;
    }

    public function show($id)
    {
        $type = response()->json(ProductType::find($id));
        return $type;
    }

    public function store(Request $request)
    {
        $type = new ProductType();
        $type->name = $request->name;
        $type->description = $request->description;
        $type->cost = $request->cost;

        $type->save();
    }

    public function update(Request $request, $id)
    {
        $type = ProductType::find($id);
        $type->name = $request->name;
        $type->description = $request->description;
        $type->cost = $request->cost;

        $type->save();
    }

    public function destroy($id)
    {
        ProductType::find($id)->delete();
    }

    public function oneProductType($type_id)
    {
        return ProductType::with('produts')->where('type_id', $type_id)->get();
    }

    public function showOneUserBasket()
    {
        $userId = auth()->id();
        $baskets = DB::table('product_types')
            ->join('products', 'product_types.type_id', '=', 'products.type_id')
            ->join('baskets', 'products.item_id', '=', 'baskets.item_id')
            ->where('baskets.user_id', $userId)
            ->where('name', 'LIKE', "B%")
            ->get();

        return $baskets;
    }
}
