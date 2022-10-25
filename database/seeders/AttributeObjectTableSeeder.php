<?php

namespace Database\Seeders;

use App\Models\AttributeObject;
use Illuminate\Database\Seeder;

class AttributeObjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = [
            ['name'=> 'S',          'attribute_id' => 1],
            ['name'=> 'M',          'attribute_id' => 1],
            ['name'=> 'XL',         'attribute_id' => 1],
            ['name'=> 'Black',      'attribute_id' => 2],
            ['name'=> 'Red',        'attribute_id' => 2],
            ['name'=> 'Orange',     'attribute_id' => 2],
        ];

        foreach ($objects as $key => $object) {
            AttributeObject::insert($object);
        }
    }
}
