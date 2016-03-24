<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Shop;
use App\Models\Country;
use App\Models\Address;

class ShopController extends Controller {

    private function getShopList()
    {
        $shops = Shop::get();
        $shopList = array();
        foreach ($shops as $shop) {
            array_push($shopList, array(
                'id' => $shop->id,
                'name' => $shop->name));
        }
        return $shopList;
    }

    public function getList()
    {
        $user = Auth::user();

        if($user){
            $shopList = $this::getShopList();
            return response()->json(array(
                'success' => true,
                'shopList' => $shopList));
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
            return response()->json(array(
                'success' => true,
                'countryList' => $countryList)
            );
        } else {
            return response()->json(array('success' => false));
        }
    }

    public function getCityList()
    {
        $user = Auth::user();

        if($user) {
            $cities = Address::get();
            $cityList = array();
            foreach($cities as $city) {
                array_push($cityList, array(
                    'id'    => $city->id,
                    'name'  => $city->city
                ));
            }
            return response()->json(array(
                'success' => true,
                'cityList' => $cityList)
            );
        } else {
            return response()->json(array('success' => false));
        }
    }

    public function newShop(Request $request)
    {
        $user = Auth::user();

        $newShopData = $request->input('newShop');

        if($user) {
            $addressExist = Address::where('city', 'like', $newShopData['city'])->exists();

            if(false == $addressExist){
                $newAddress = Address::firstOrCreate([
                    'city'          => $newShopData['city'],
                    'country_id'    => $newShopData['countryId']
                ]);
            } elseif(true == $addressExist){
                $address = Address::where('city', 'like', $newShopData['city'])->first();
            }

            $newShop = Shop::firstOrCreate([
                'name'          => $newShopData['name'],
                'address_id'    => ($addressExist == false) ? $newAddress->id : $address->id
            ]);
            $shopList = $this::getShopList();
            return response()->json(array(
                'success' => true,
                'message' => 'Speichern erfolgreich',
                'newShop' => $newShop,
                'shopList' => $shopList)
            );
        } else {
            return response()->json(array(
                'success' => false,
                'message' => 'Um einen neuen Markt anzulegen muss du eingeloggt sein.')
            );
        }
    }
}