<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMetadata extends Model
{
    use SoftDeletes;

    protected $table = 'users_metadata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'profession', 'primary_language', 'years_of_experience', 'current_company',
    ];


    public function user()
    {
        return $this->hasOne(User::class);
    }
}
