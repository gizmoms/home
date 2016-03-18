<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Tag;


class PurchaseController extends Controller {

    public function savePurchase(Request $request)
    {
        $user = Auth::user();

        $newPurchaseData = $request->input('newPurchase');

        if($user){
            $tags = $newPurchaseData['tags'];
            $products = $newPurchaseData['items'];
            $newPurchaseTagsIds = array();

            $boughtAt = substr($newPurchaseData['bought_at'], 0, (strpos($newPurchaseData['bought_at'],'T')));
            $boughtAtDate = new Carbon($boughtAt);

            $newPurchase = Purchase::firstOrCreate([
                'shop_id'       => $newPurchaseData['shopSelected']['id'],
                'user_id'       => $user->id,
                'bought_at'     => $boughtAtDate->toDateString(),
                'total_amount'  => $newPurchaseData['total']
            ]);

            foreach($tags as $newTag)
            {
                $tag = Tag::firstOrCreate([
                    'name'  => $newTag
                ]);
                array_push($newPurchaseTagsIds, $tag->id);
            }

            $newPurchase->tags()->sync($newPurchaseTagsIds);

            foreach($products as $product)
            {
                PurchaseProduct::firstOrCreate([
                    'purchase_id'   => $newPurchase->id,
                    'product_id'    => $product['productId'],
                    'amount'        => $product['qty'],
                    'single_price'  => $product['single_price']
                ]);
            }
        }

    }
}