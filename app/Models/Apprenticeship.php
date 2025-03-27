<?php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Apprenticeship extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'Apprenticeship'; 

    // Define the primary key for the table
    protected $primaryKey = 'apprenticeship_id'; 

    // Disable timestamps (if not using Laravel's automatic timestamp feature)
    public $timestamps = false;

    // Fillable fields for mass assignment
    protected $fillable = [
        'name', 'months',
    ];

    /**
     * Relationship: An Apprenticeship can have many Apprentices
     */
    public function apprentices()
    {
        return $this->hasMany(Apprentice::class, 'apprenticeship_id');
    }

    /**
     * Relationship: An Apprenticeship can have many Tutors (Many-to-many relationship)
     */
    public function tutors()
    {
        // Many-to-many relationship between Apprenticeship and Tutor (User)
        return $this->belongsToMany(User::class, 'apprenticeship_tutors', 'apprenticeship_id', 'tutor_id')
                    ->where('role', 'tutor'); // Assuming 'role' field in the users table to determine if the user is a tutor
    }

    /**
     * Relationship: An Apprenticeship can have many Admins (Many-to-many relationship)
     */
    public function admins()
    {
        // Many-to-many relationship between Apprenticeship and Admin (User)
        return $this->belongsToMany(User::class, 'apprenticeship_admins', 'apprenticeship_id', 'admin_id')
                    ->where('role', 'admin'); // Assuming 'role' field in the users table to determine if the user is an admin
    }
}
