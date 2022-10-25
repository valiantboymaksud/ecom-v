<?php
namespace App\Services;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Traits\FileSaver;

class ProductService
{
    use FileSaver;

    public $product;

    public function store($request)
    {
        $this->product = Product::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'offer_price'   => $request->offer_price ?? 0,
        ]);

        $this->upload_file($request->image, $this->product, 'image', 'products');
    }

    public function update($product)
    {
        $this->product = $product;
        $request = \request();

        $this->product->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'offer_price'   => $request->offer_price ?? 0,
            'status'        => $request->status,
        ]);

        $this->upload_file($request->image, $this->product, 'image', 'products');
        $this->product->refresh();
    }

    public function attributes()
    {
        foreach (request('attribute_ids') ?? [] as  $attribute_id) {
            foreach (request('attribute_object_ids') ?? [] as $id) {
                $this->product->attributes()->create([
                    'attribute_id'          => $attribute_id,
                    'attribute_object_id'   => $id,
                ]);
            }
        }
    }
}