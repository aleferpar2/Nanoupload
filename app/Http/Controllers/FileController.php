<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichero;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FileController extends Controller
{
    use AuthorizesRequests;

    public function search(Request $request)
{
    $query = $request->input('query');
    $files = Fichero::where('name', 'LIKE', "%$query%")->get();

    return view('files.index', compact('files'));
}
public function delete(Fichero $file)
{
    $this->authorize('delete', $file);
    $file->delete();
    return redirect()->back()->with('success', 'Archivo eliminado correctamente.');
}
public function restore($id)
{
    $file = Fichero::onlyTrashed()->findOrFail($id);
    $file->restore();
    return redirect()->back()->with('success', 'Archivo restaurado correctamente.');
}
public function update(Fichero $file)
{
    $this->authorize('update', $file);
    $file->delete();
    return redirect()->back()->with('success', 'Archivo actulizado correctamente.');
}
public function view(Fichero $file)
{
    $this->authorize('view', $file);
    $file->delete();
    return redirect()->back()->with('success', 'Archivo visto correctamente.');
}
}

