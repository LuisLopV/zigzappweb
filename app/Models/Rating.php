<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'comment',
        'qualifier_id',
        'qualified_id',
        'travels_id',
    ];

    public function qualifier()
    {
        return $this->belongsTo(Profile::class, 'qualifier_id');
    }

    public function qualified()
    {
        return $this->belongsTo(Profile::class, 'qualified_id');
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travels_id');
    }
}
