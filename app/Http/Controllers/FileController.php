<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Account;
use App\Models\User;
use App\Http\Requests\FileRequest;

class FileController extends Controller
{
    public function file() {
        $user = auth()->user();
        return view('accounts.file', ['user' => $user]);
    }

    public function upload(FileRequest $request) {
        $user = auth()->user();

        if (!file_exists(public_path('storage'))) {
            mkdir(public_path('storage'));
        }

        if (!file_exists(public_path('storage/userFiles'))) {
            mkdir(public_path('storage/userFiles'));
        }

        if($request->txt != null) {
            $request->txt->move(public_path('storage/userFiles'), 'userTxt'.$user->id.'.txt');
        }
        if($request->image != null){
            $request->image->move(public_path('storage/userFiles'), 'userImage'.$user->id.'.png');
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
