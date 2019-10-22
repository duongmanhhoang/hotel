<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Role extends Model
{
    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const MEMBER = 4;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
