<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname', 'secondname', 'firstlastname', 'secondlastname',
        'rh', 'license_photo', 'date_of_birth', 'cell_number', 'user_id', 'role_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function motorcycle()
    {
        return $this->hasOne(Motorcycle::class);
    }
}

