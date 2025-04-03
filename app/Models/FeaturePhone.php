<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturePhone extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function feature_phone()
    {
        return $this->hasMany(FeaturePhoneVariant::class, 'model_id', 'id');
    }

}
