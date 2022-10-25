<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeObject extends Model
{
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
