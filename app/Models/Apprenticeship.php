<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprenticeship extends Model
{
    use HasFactory;

    protected $table = 'Apprenticeship';

    protected $primaryKey = 'apprenticeship_id'; 

    public $timestamps = false;

    protected $fillable = [
        'name', 'months'
    ];

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'apprenticeship_id', 'apprenticeship_id');
    }

    public function duties()
    {
        return $this->hasMany(Duty::class, 'apprenticeship_id', 'apprenticeship_id');
    }
}