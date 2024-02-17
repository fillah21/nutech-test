<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index() {
        return view('profil.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,png|file'
        ]);

        try {
            $user = User::find($id);

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $image_extention = $image->getClientOriginalExtension();
                $image_name = time() . "." . $image_extention;

                if($user->image != "profil/Frame 98700.png") {
                    Storage::delete($user->image);
                }
    
                try {
                    $user->image = $request->file('image')->store('profil');
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
