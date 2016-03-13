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
            $productList = self::getProductList($shopId);
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
            $products = Product::orderBy('name')->get();
            $unitList = Unit::lists('name');
            foreach($products as $product) {
                $product->unitName = $product->unit->name;
            }
            return response()->json(array(
                'success'       => 'true',
                'productsNames' => $productsNames,
                'unitList'      => $unitList,
                'products'      => $products));
        } else {
            return redirect('/');
        }
    }

    public function newProduct(Request $request)
    {
        $user = Auth::user();
        $newProductData = $request->input('newProduct');
        $product = null;
        if($newProductData['newStockProduct'] == false){
            $product = ProductDetails::where('shop_id', '=', $newProductData['shopId'])
                ->where('product_id', '=', $newProductData['productId'])
                ->first();
        }

        if($user && $product === null) {
            if($newProductData['newUnit'] == true){
                $newUnit = Unit::firstOrCreate([
                    'name' => $newProductData['unit'],
                    'code' => $newProductData['newUnitCode']
                ]);
            }

            if($newProductData['newStockProduct']) {
                $newStockProduct = Product::firstOrCreate([
                    'name'      => $newProductData['name'],
                    'unit_id'   => ($newProductData['newUnit'] == true) ? $newUnit->id : $newProductData['unitId']
                ]);
            } else {
                $stockProduct           = Product::find($newProductData['productId']);
                dd($newProductData['productId']);
                $stockProduct->unitName = $stockProduct->unit->name;
            }

            $newProduct = ProductDetails::firstOrCreate([
                'shop_id'       => $newProductData['shopId'],
                'product_id'    => ($newProductData['newStockProduct'] == true) ? $newStockProduct->id : $newProductData['productId'],
                'single_price'  => $newProductData['singlePrice']
            ]);

            $newProduct->unitName   = $newProduct->product->unit->name;
            $newProduct->name       = $newProduct->product->name;
            $productList            = self::getProductList($newProductData['shopId']);

            return response()->json(array(
                'success'       => true,
                'message'       => 'Speichern erfolgreich',
                'newProduct'    => $newProduct,
                'productList'   => $productList
            ));
        }else{
            return response()->json(array(
                'success'       => false,
                'message'       => 'Produkt schon für diesen Markt vorhanden.'
            ));
        }
    }


    private function getProductList($shopId){
        $products = Shop::find($shopId)->products;
        $productList = array();
        foreach ($products as $product) {
            array_push($productList, array(
                'id'            => $product->id,
                'name'          => $product->product->name,
                'unit'          => $product->product->unit->name,
                'single_price'  => $product->single_price));
        }
        return $productList;
    }
}