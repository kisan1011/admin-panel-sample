<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Flash;
use DataTables;
use Exception;
use App\Imports\CategoryImport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = Category::orderby('id','desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $url = url('/').'/users/show/'.$row->id;
                        $url = "<div class='actions-a'><a class='btn btn-info btn-sm' onclick='view_category_modal(".$row->id.")' title='View'><i class='material-icons fas fa-eye'></i></a><a onclick='edit_category_modal(".$row->id.")' class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a><a onclick='DeleteData(".$row->id.")' class='btn btn-danger btn-sm' title='Delete'><i class='fa fa-trash'></i></a></div>";
                        return $url;
                    })

                    ->addColumn('image', function($row){
                        $image = '<img src="'.$row->image.'" class="img-fluid img-radius">';
                        return $image;
                    })
                    ->rawColumns(['actions','image'])
                    ->make(true);
        }
        $title =  'List category';
        return view('category.index',compact('title'));
    }

    public function store(CategoryRequest $request)
    {
        try{
            $post_data = $request->all();
            if(@$post_data['image']){
                $img = FileUploadHelper($post_data['image'],'categories');
                $post_data['image'] = $img;
            }
            Category::updateOrCreate(['id'=>$post_data['id']],$post_data);
            return response()->json(['status' => true, 'message' => 'Category successfully add!']);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::find($id);
            if(empty($category)){
                return response()->json(['status' => false, 'message'=>"Invalid user details"]);    
            }
            return response()->json(['status' => true, 'message'=>"Success.",'data'=>$category]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            if (empty($category)) {
                return response()->json(['status' => false, 'message' => 'Category not found']);
            }
            $category->delete();
            return response()->json(['status' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    // Check email dublicate
    public function CategoryNameDublicate(Request $request)
    {
        try {
            echo (Category::where('name','=',$request->name)->where('id','!=',$request->id)->count()>0) ? 'false' : 'true';
        } catch (\Exception $e) {
            echo 'true';
        }
    }

    // multiple user delete
    public function MultipleCategoryDelete(Request $request)
    {
        try {
            Category::whereIn('id',$request->ids)->delete();
            return response()->json(['status' => true, 'message'=>"Category deleted successfully."]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }


    public function import() 
    {
        try {
            Excel::import(new CategoryImport,request()->file('file'));
            return response()->json(['status' => true, 'message'=>"Excel data successfully imported."]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }
}
