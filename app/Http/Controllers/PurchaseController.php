<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

use App\Models\Product;

class PurchaseController extends Controller {

    public function savePurchase(Request $request)
    {
        dd($request);
        $user = Auth::user();

        if($user){
            $products = Product::get();
            $productList = array();
            foreach ($products as $product) {
                array_push($productList, array('id' => $product->id, 'name' => $product->name, 'unit' => $product->unit->name, 'single_price' => $product->single_price));
            }
            return response()->json(array('success' => true, 'productList' => $productList));
        }

    }
}