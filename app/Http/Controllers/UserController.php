<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use File;

class UserController extends Controller
{
    public function index() {
        return view('profil.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png'
        ]);

        try {
            $user = User::find($id);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $image_extention = $image->getClientOriginalExtension();
                $image_name = time() . "." . $image_extention;

                if($user->image != "Frame 98700.png") {
                    $path = 'image/profil/';
                    File::delete($path. $user->image);
                }
    
                try {
                    $image->move(public_path('/image/profil'), $image_name);
                    $user->image = $image_name;
                } catch (\Throwable $th) {
                    throw $th;
                    Alert::error('Gagal', 'Image Gagal Diupload!'); 
                }
            } else {
                $user->image = $user->image;
            }

            $user->save();

            Alert::success('Berhasil', 'Foto Profil Berhasil Diperbaharui!');
        } catch (\Throwable $th) {
            throw $th;
            Alert::error('Gagal', 'Foto Profil Gagal Diperbaharui!');
        }

        return redirect('/profil');
    }
}
