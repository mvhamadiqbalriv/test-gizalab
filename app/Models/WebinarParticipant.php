<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarParticipant extends Model
{
    use HasFactory;
    protected $table = 'webinar_has_participants';
    protected $guarded = ['id'];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class, 'webinar_id');
    }
}
