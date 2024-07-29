<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Auth extends Model
{
    use HasFactory;
    use HasApiTokens;


    protected $table = 'users';
    protected $quarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function taskinuser()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }
}
