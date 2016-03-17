<?php namespace App\Http\Controllers;

use Faker\Provider\es_AR\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

use App\Models\Shop;
use App\Models\Country;

class ShopController extends Controller {
    public function getList()
    {
        $user = Auth::user();

        if($user){
            $shops = Shop::get();
            $shopList = array();
            foreach ($shops as $shop) {
                array_push($shopList, array('id' => $shop->id, 'name' => $shop->name));
            }
            return response()->json(array('success' => true, 'shopList' => $shopList));
        }

    }

    public function getCountryList()
    {
        $user = Auth::user();

        if($user){
            $countries = Country::get();
            $countryList = array();
            foreach ($countries as $country) {
                array_push($countryList, array(
                    'id'    => $country->id,
                    'name'  => $country->name
                ));
            }
            return response()->json(array('success' => true, 'countryList' => $countryList));
        } else {
            return response()->json(array('success' => false));
        }
    }

    public function getCitiyList()
    {
        $user = Auth::user();

        if($user) {
            $cities = Address::get();
            $cityList = array();
            foreach($cities as $city) {

                array_push($cityList, array(
                    'id'    => $city->id,
                    'name'  => $city->name
                ));
            }
            return response()->json(array('success' => true, 'cityList' => $cityList));
        } else {
            return response()->json(array('success' => false));
        }
    }

    public function newShop(Request $request)
    {
        $user = Auth::user();

        if($user) {
            dd($request);
        }  else {
            return response()->json(array('success' => false, 'message' => 'Um einen neuen Markt anzulegen muss du eingeloggt sein.'));
        }
    }
}