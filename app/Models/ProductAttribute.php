<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeObject()
    {
        return $this->belongsTo(AttributeObject::class);
    }
}
