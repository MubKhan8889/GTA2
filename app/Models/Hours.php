<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hours extends Model
{
    use HasFactory;

    protected $table = 'OTJHours';
    protected $primaryKey = 'otj_hours_id';

    public $timestamps = false;

    protected $fillable = [
        'otj_hours_id',
        'apprentice_id',
        'month',
        'date',
        'training_centre',
        'employer_training',
        'specialist_training',
        'vle_training',
    ];

    public function apprentice()
    {
        $this->belongsTo(Apprentice::class, 'apprentice_id', 'apprentice_id');
    }
}
