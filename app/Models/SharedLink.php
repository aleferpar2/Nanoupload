<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SharedLink extends Model
{
    use HasFactory;

    protected $fillable = ['file_id', 'link', 'expires_at'];

    public function file()
    {
        return $this->belongsTo(Fichero::class);
    }
    //
}
