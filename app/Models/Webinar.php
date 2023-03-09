<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Webinar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['thumbnail_storage'];

    public function getThumbnailStorageAttribute()
    {
        return $this->thumbnail ? url(Storage::url($this->thumbnail)) : null;
    }

    public function mentors(){
        return $this->belongsToMany(Mentor::class, 'webinar_has_mentors', 'webinar_id', 'mentor_id')
                ->withTimestamps();
    }

    public function categories(){
        return $this->belongsToMany(WebinarCategory::class, 'webinar_has_categories', 'webinar_id', 'category_id')
                ->withTimestamps();
    }

    public function participants(){
        return $this->hasMany(WebinarParticipant::class, 'webinar_id');
    }
}
