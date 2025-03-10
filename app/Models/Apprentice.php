<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;

    protected $table = 'Apprentice';

    protected $primaryKey = 'apprentice_id';

    public $timestamps = false;

    protected $fillable = [
        'id', // User ID (Foreign Key)
        'apprenticeship_id',
        'uln',
        'cohort',
        'status',
        'start_date',
        'exp_finish_date',
        'finish_date',
        'release_day',
    ];

    public function scopeActive($query)
    {
        return $query->whereNull('archived_at');
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }


    public function apprenticeship()
    {
        return $this->belongsTo(Apprenticeship::class, 'apprenticeship_id');
    }
}
