<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fichero;
use App\Models\SharedLink;
use Carbon\Carbon;

class SharedLinkController extends Controller
{
    public function create(Fichero $file)
    {

        $link = SharedLink::create([
            'file_id' => $file->id,
            'link' => uniqid('share_', true),
            'expires_at' => Carbon::now()->addDays(7) // Expira en 7 días
        ]);

        return response()->json(['link' => url("/shared/{$link->link}")]);
    }
    public function access($link)
    {
        // Buscar el enlace y validar expiración
        $sharedLink = SharedLink::where('link', $link)->firstOrFail();

        if ($sharedLink->expires_at && $sharedLink->expires_at->isPast()) {
            abort(404, 'Este enlace ha expirado.');
        }

        return response()->download(storage_path('app/' . $sharedLink->file->path));
    }
}
