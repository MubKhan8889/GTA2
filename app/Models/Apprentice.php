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
        'account_id',
        'apprenticeship_id',
        'uln',
        'cohort',
        'status',
        'start_date',
        'exp_finish_date',
        'finish_date',
        'release_day',
    ];

        public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'account_id');
    }

}
