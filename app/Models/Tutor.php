<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutors';

    protected $primaryKey = 'tutor_id';

    public $timestamps = false;

    protected $fillable = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
