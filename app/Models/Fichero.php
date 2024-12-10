<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fichero extends Model
{
    public function size(){
        return Storage::size($this->path);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'path', 'user_id'];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}

