<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ApprenticeDuty extends Model
{
    use HasFactory;

    protected $table = 'Apprentice_Duties';
    protected $primaryKey = 'apprentice_duty_id';
    public $timestamps = false;

    protected $fillable = [
        'apprentice_id',
        'duty_id',
        'completed_date',
        'due_date'
    ];

    protected function casts(): array
    {
        return [
            'completed_date' => 'date',
            'due_date' => 'date',
        ];
    }

    public function duty()
    {
        return $this->belongsTo(Duty::class, 'duty_id', 'duty_id');
    }

    public function getStatusAttribute()
    {
        if ($this->completed_date) {
            return 'Completed';
        }

        if ($this->due_date && Carbon::now()->gt($this->due_date)) {
            return 'Overdue';
        }

        return 'In Progress';
    }

}
