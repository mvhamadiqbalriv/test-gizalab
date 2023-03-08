<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Mentor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['photo_storage'];

    public function getPhotoStorageAttribute()
    {
        return $this->photo ? url(Storage::url($this->photo)) : null;
    }
}
