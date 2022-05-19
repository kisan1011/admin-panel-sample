<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function GetCategory(Request $request){
        try{
            $category = Category::get();
            if(count($category)>0){
            	return response()->json(['status' => true, 'message' => 'data fetched successfully!', 'data' => $category]);
            }
            return response()->json(['status' => false, 'message' => 'No category found!']);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }
}
