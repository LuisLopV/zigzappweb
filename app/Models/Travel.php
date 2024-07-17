<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    protected $table = 'travels';
    protected $fillable = [
        'location', 'destination', 'price', 'payment_method_id', 'travel_status_id', 'passenger_id','amount',  'driver_id'
    ];

    public function status()
    {
        return $this->belongsTo(TravelStatus::class, 'travel_status_id');
    }

    public function passenger()
    {
        return $this->belongsTo(Profile::class, 'passenger_id');
    }

    public function driver()
    {
        return $this->belongsTo(Profile::class, 'driver_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function accept($driverId)
    {
        $this->driver_id = $driverId;
        $this->travel_status_id = 2; // 2 represents "En curso"
        $this->save();
    }

    public function complete()
    {
        $this->travel_status_id = 3; // 3 represents "Terminado"
        $this->save();
    }

    public function pays()
    {
    return $this->hasMany(Pay::class, 'travels_id');
    }

    public function rating()
    {
    return $this->hasOne(Rating::class, 'travels_id');
    }

}
