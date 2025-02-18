<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $table = 'Account';
    protected $primaryKey = 'account_id';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'email',
        'username',
        'password',
        'role',
    ];

        public function apprentices()
    {
        return $this->hasOne(Apprentice::class, 'account_id', 'account_id');
    }

}
