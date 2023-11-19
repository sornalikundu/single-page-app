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

        $i = Session::has('id') ? Session::get('id') + 1 : 1;
        $user_data = new \stdClass();
        $user_data->id = $i;
        $user_data->fname = $request->fname;
        $user_data->address = $request->address;
        $user_data->gender = $request->gender;
        $user_data->img_path = '';

        $filename = $_FILES['fileToUpload']['name'];
        if ($filename) {
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

        $var = Session::get('user_data');
        return $var;
    }

    public function listData(Request $request)
    {
        $user_data = Session::get('user_data');
        return view('listPage', compact('user_data'));
    }
}
