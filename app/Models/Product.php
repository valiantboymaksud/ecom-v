<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        if (!App::runningInConsole()) {
            /**
             * Auto create created_by field when create anything through model
             */
            static::creating(function ($model) {
                $model->fill([
                    // 'created_by'    => auth()->id() ?? 1,
                    'slug'          => Str::slug($model->name),
                ]);
            });





            /**
             * Auto update updated_by field when update anything of the model data
             */
            static::updating(function ($model) {
                $model->fill([
                    // 'updated_by' => auth()->id() ?? 1
                ]);
            });
        }
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function product_attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes');
    }

}
