<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    use HasFactory;

    protected $fillable = ['apprentice_id', 'apprenticeship_id', 'months'];

    public function apprenticeship()
    {
        return $this->belongsTo(Apprenticeship::class);
    }

    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class);
    }
}
