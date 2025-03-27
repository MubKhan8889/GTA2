<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apprentice extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'Apprentice'; 

    // Primary key field
    protected $primaryKey = 'apprentice_id'; 

    // Disable timestamps (if not using Laravel's automatic timestamp feature)
    public $timestamps = false; 

    // Fillable fields for mass assignment
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

    /**
     * Relationship: Apprentice has many Hours
     */
    public function hours(): HasMany
    {
        return $this->hasMany(Hours::class, 'apprentice_id', 'apprentice_id');
    }

    /**
     * Scope: Active apprentices (those not archived)
     */
    public function scopeActive($query)
    {
        return $query->whereNull('archived_at');
    }

    /**
     * Scope: Archived apprentices (those archived)
     */
    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }
}
