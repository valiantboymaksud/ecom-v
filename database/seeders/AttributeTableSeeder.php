<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attributes = [
            ['name'  => 'size'],
            ['name'  => 'color'],
        ];

       foreach ($attributes as $key => $attribute) {
            Attribute::insert($attribute);
       }
    }
}
