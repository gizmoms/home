<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;

class CategoryController extends Controller {

    public function getCategoryList()
    {
        $user = Auth::user();

        if($user){
            $categories = Category::get();
            $categoryList = array();
            foreach ($categories as $category) {
                array_push($categoryList, array(
                    'id'    => $category->id,
                    'name'  => $category->name
                ));
            }
            $categoryList = json_encode($categoryList);

            return response()->json(array('categoryList' => $categoryList));
        } else {
            $message = 'Sie sind nicht eingeloggt';
            return response()->json(array('success' => false, 'message' => $message));
        }
    }
}