<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_card_photo', 'pdf_secure', 'pdf_mechanical_technician', 'pdf_driving_licence', 'profile_id'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
