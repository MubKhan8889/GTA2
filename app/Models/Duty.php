<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    // For retrieving apprentices associated with each duty
    public function apprentices()
    {
        return $this->hasMany(ApprenticeDuty::class, 'duty_id', 'id');
    }

    protected $table = 'Duty';

    protected $primaryKey = 'duty_id';

    public $timestamps = false;

    protected $fillable = [
        'duty_id',
        'apprenticeship_id',
        'name',
        'duration'
    ];

    protected $casts = [
        'duty_id' => 'integer', 
        'apprenticeship_id' => 'integer',
        'name' => 'string',
        'duration' => 'integer',
    ];

    public function apprentice()
    {
        return $this->hasMany(ApprenticeDuty::class, 'duty_id', 'duty_id');
    }
}