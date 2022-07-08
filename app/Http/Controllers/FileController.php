<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Account;
use App\Models\User;

class FileController extends Controller
{
    public function file() {
        $user = auth()->user();
        return view('accounts.file', ['user' => $user]);
    }

    public function upload(Request $request) {
        $user = auth()->user();

        $validade = $request ->validate(
            [
                'txt' => 'mimes:txt',
                'image' => 'image|mimes:png'
            ],
            [

                'txt.mimes' => 'Formato errado!',
                'image.image' => 'Precisa ser uma imagem',
                'image.mimes' => 'Precisa ser um arquivo png',
            ]
        );

        if($request->txt != null) {
            $request->txt->storeAs('public/userFiles', 'userTxt'.$user->id.'.txt');
        }
        if($request->image != null){
            $request->image->storeAs('public/userFiles', 'userImage'.$user->id.'.png');
        }
        
        return redirect('/accounts/file')->with('msg', 'Arquivo(s) enviado(s) com sucesso!');
    }

    public function download($file){
        return response()->download('storage/userFiles/'.$file);
    }

    public function deleteFile($file){
        unlink(public_path('storage/userFiles/'.$file));
        return redirect('/accounts/file')->with('msg', 'Arquivo removido com sucesso!');
    }
}
