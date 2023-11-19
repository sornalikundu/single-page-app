<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SinglePageController extends Controller
{
    //
    public function index()
    {
        return view('singlePage');
    }

    public function addUser(Request $request)
    {
        $path = public_path() . '/uploads';
        if (!File::exists($path)) {
            // path does not exist
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        // edit user start
        $edit_user_id = $request->edit_user_id;
        if (isset($edit_user_id)) {
            $all_user = Session::get('user_data');
            if ($all_user) {
                // $edit_user = $all_user[$edit_user_id];

                $user_data = new \stdClass();
                $user_data->id = $edit_user_id;
                $user_data->fname = $request->fname;
                $user_data->address = $request->address;
                $user_data->gender = $request->gender;
                $user_data->img_path = "";
                $filename = $_FILES['fileToUpload']['name'];
                if($filename){
                    if(file_exists($all_user[$edit_user_id]->img_path)){
                        unlink($all_user[$edit_user_id]->img_path); // delete previous img
                    }
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $img = "newfile_" . time() . rand(5, 15) . "." . $ext;
    
                    // $targetFile = 'uploads/' . basename($_FILES["fileToUpload"]["name"]);
                    $targetFile = 'uploads/' . $img;
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                        // file was successfully uploaded
                        $user_data->img_path = $targetFile;
                    }
                } else {
                    $user_data->img_path = $all_user[$edit_user_id]->img_path;
                }
                Session::put('user_data.' . $edit_user_id, $user_data);
            }
        } else {
            $i = Session::has('id') ? Session::get('id') + 1 : 1;
            $user_data = new \stdClass();
            $user_data->id = $i;
            $user_data->fname = $request->fname;
            $user_data->address = $request->address;
            $user_data->gender = $request->gender;
            $user_data->img_path = '';

            $filename = $_FILES['fileToUpload']['name'];
            if($filename){
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $img = "newfile_" . time() . rand(5, 15) . "." . $ext;
                $targetFile = 'uploads/' . $img;
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                    // file was successfully uploaded
                    $user_data->img_path = $targetFile;
                }
            }

            $all_user = Session::has('user_data') ? Session::get('user_data') : [];
            $all_user[$i] = $user_data;
            // return $all_user; die;
            Session::put('user_data', $all_user);
            Session::put('id', $i);
        }

        $var = Session::get('user_data');
        return $var;
    }

    public function listData(Request $request)
    {
        $user_data = Session::get('user_data');
        return view('listPage', compact('user_data'));
    }

    public function deleteUser(Request $request)
    {
        $user_id = $request->id;
        $all_user = Session::get('user_data');
        if(file_exists($all_user[$user_id]->img_path)){
            unlink($all_user[$user_id]->img_path);
        }
        unset($all_user[$user_id]);
        Session::put('user_data', $all_user);
    }

    public function viewUser(Request $request)
    {
        $user_id = $request->id;
        $all_user = Session::get('user_data');
        $view_user = $all_user[$user_id];
        return view('modalPage', compact('view_user'));
    }

    public function editUser(Request $request)
    {
        $edit_user = null;
        $user_id = $request->id;
        $all_user = Session::get('user_data');
        $edit_user = $all_user[$user_id];
        return $edit_user;
    }
}
