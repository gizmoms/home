<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\ProductDetails;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Unit;

class ProductController extends Controller {
    public function getList(Request $request)
    {
        $user = Auth::user();
        if($user){
            $shopId = json_decode($request->input('shopId'));
            $products = Shop::find($shopId)->products;
            $productList = array();
            foreach ($products as $product) {
                array_push($productList, array('id' => $product->id, 'name' => $product->product->name, 'unit' => $product->product->unit->name, 'single_price' => $product->single_price));
            }
            return response()->json(array('success' => true, 'productList' => $productList));
        } else {
            return redirect('/');
        }

    }

    public function getProductsNames()
    {
        $user = Auth::user();

        if($user){
            $productsNames = Product::lists('name');
            $products = Product::get();
            $unitList = Unit::lists('name');
            foreach($products as $product) {
                $product->unitName = $product->unit->name;
            }
            return response()->json(array('success => true', 'productsNames' => $productsNames, 'unitList' => $unitList, 'products' => $products));
        } else {
            return redirect('/');
        }
    }
}