<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use Flash;
use DataTables;
use Exception;

class UserController extends Controller
{
    // get all user data
    public function index(Request $request)
    {
    	if ($request->ajax()){
            $data = User::where('role','=','user')->orderby('id','desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $url = url('/').'/users/show/'.$row->id;
                        $url = "<div class='actions-a'><a class='btn btn-info btn-sm' onclick='view_user_modal(".$row->id.")' title='View'><i class='material-icons fas fa-eye'></i></a><a onclick='edit_user_modal(".$row->id.")' class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'></i></a><a onclick='DeleteData(".$row->id.")' class='btn btn-danger btn-sm' title='Delete'><i class='fa fa-trash'></i></a></div>";
                        return $url;
                    })

                    ->addColumn('image', function($row){
                        $image = '<img src="'.$row->image.'" class="img-fluid img-radius">';
                        return $image;
                    })
                    ->rawColumns(['actions','image'])
                    ->make(true);
        }
        $title =  'User account';
        return view('users.index',compact('title'));
    }

    // add or edit user
    public function store(UserRequest $request)
    {
        try{
            $post_data = $request->all();
            $post_data['role'] = 'user';
            $post_data['username'] = '';
            if(@$post_data['image']){
                $img = FileUploadHelper($post_data['image'],'profile');
                $post_data['image'] = $img;
            }
            unset($post_data['confirm_password']);
            User::updateOrCreate(['id'=>$post_data['id']],$post_data);
            return response()->json(['status' => true, 'message' => 'User successfully updated!']);
        } catch(Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    // get edit user details
    public function show($id)
    {
        try {
            $user = User::find($id);
            if(empty($user)){
                return response()->json(['status' => false, 'message'=>"Invalid user details"]);
            }
            return response()->json(['status' => true, 'message'=>"Success.",'data'=>$user]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    // Single user delete
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (empty($user)) {
                return response()->json(['status' => false, 'message' => 'User not found']);
            }
            $user->delete();
            return response()->json(['status' => true, 'message' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    // multiple user delete
    public function MultipleUserDelete(Request $request)
    {
        try {
            User::whereIn('id',$request->ids)->delete();
            return response()->json(['status' => true, 'message'=>"Users Deleted successfully."]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong!','errorMessage'=>$e->getMessage()]);
        }
    }

    // Check email dublicate
    public function CheckEmailDublicate(Request $request)
    {
        try {
            echo (User::where('email','=',$request->email)->where('id','!=',$request->id)->count()>0) ? 'false' : 'true';
        } catch (\Exception $e) {
            echo 'true';
        }
    }

    // Check username dublicate
    public function CheckUsernameDublicate(Request $request)
    {
        try {
            echo (User::where('username','=',$request->username)->where('id','!=',$request->id)->count()>0) ? 'false' : 'true';
        } catch (\Exception $e) {
            echo 'true';
        }
    }
}
