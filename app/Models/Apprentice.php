<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Relationship: Apprentice belongs to a User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'id'); // Apprentice.id → User.id
    }

    /**
     * Relationship: Apprentice belongs to an Apprenticeship
     */
    public function apprenticeship(): BelongsTo
    {
        return $this->belongsTo(Apprenticeship::class, 'apprenticeship_id');
    }

    /**
     * Relationship: Apprentice has many Duties (via pivot table)
     */
    public function duties(): BelongsToMany
    {
        return $this->belongsToMany(Duty::class, 'Apprentice_Duties', 'apprentice_id', 'duty_id')
                    ->withPivot('completed_date', 'due_date');
    }
}
