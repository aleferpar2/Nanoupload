<?php

namespace App\Http\Controllers;

use App\Models\Fichero;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
        ]);

        Folder::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Carpeta creada con éxito.');
    }
    public function index($folderId = null)
{
    $currentFolder = $folderId ? Folder::findOrFail($folderId) : null;

    $folders = Folder::where('parent_id', $folderId)->where('user_id', Auth::user()->id)->get();
    $files = Fichero::where('folder_id', $folderId)->where('user_id', Auth::user()->id)->get();

    return view('folders.index', compact('currentFolder', 'folders', 'files'));
}

}
