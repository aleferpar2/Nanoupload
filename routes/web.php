<?php

use App\Models\Fichero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SharedLinkController;
use App\Http\Controllers\FolderController;

Route::get('/', function () {
    $ficheros = Fichero::all();
    return view('welcome', compact('ficheros'));
});
Route::get('/login', function(){
    return view('login');
});
Route::post('/upload', function(Request $request){
    $fichero = new Fichero();
    $fichero->path = $request->file('uploaded_file')->store();
    $fichero->name = $request->file('uploaded_file')->getClientOriginalName();
    $fichero->user_id = Auth::user()->id;
    $fichero->save();
    return redirect('/');
});

//Download
Route::get('/download/{file}', function(Fichero $file){
    return Storage::download($file->path, $file->name);
});

//DELETE
Route::get('/delete/{file}', function(Fichero $file){
    Storage::delete($file->path);
    Fichero::destroy(($file->id));
    return redirect('/');

})->can('delete', 'file');

//LOGIN LOGOUT
Route::post('/login', function(Request $request){
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});
Route::get('/logout', function(Request $request){
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
});
//Buscador
Route::get('/search', [FileController::class, 'search'])->name('files.search');


//Comparticion-SharedLink

Route::post('/files/{file}/share', [SharedLinkController::class, 'create'])->name('files.share');
Route::get('/shared/{link}', [SharedLinkController::class, 'access'])->name('files.access');


//SoftBorrado y restauracion

Route::get('/files/restore/{id}', [FileController::class, 'restore'])->name('files.restore');
Route::get('/files/delete/{file}', [FileController::class, 'delete'])->name('files.delete');

//Carpetas
Route::middleware('auth')->group(function () {
    Route::get('/folders/{folder?}', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'create'])->name('folders.create');
});
