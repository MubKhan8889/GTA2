<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    /**
     * Table associated with model
     * 
     * @var string
     */
    protected $table = 'DutyRAG';

    /**
     * Primary key of table
     * 
     * @var string
     */
    protected $primaryKey = 'duty_rag_id';

    /**
     * Should the model be timestamped
     * 
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'duty_id',
        'apprentice_id',
        'finish_date'
    ];

    protected function casts(): array
    {
        return [
            'duty_id' => 'number',
            'apprentice_id' => 'number',
            'finish_date' => 'date',
        ];
    }
}