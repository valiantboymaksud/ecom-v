<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\AttributeObject;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $service;

    public function __construct() {
        $this->service = new ProductService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()
        ->with('attributes.attributeObject')
        ->when(request()->filled('status'), fn($q)=>$q->where('status', request('status')))
        ->when(request()->filled('price'), fn($q)=>$q->whereBetween('price', explode('-', request('price'))))
        ->paginate(25);

        $view = view('partials.product', compact('products'))->render();

        return response()->json([
            'status'    => 1,
            'data'      => $view,
            'message'   => 'Success'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        try {
            DB::transaction(function() use($request){

                $this->service->store($request);
                $this->service->attributes();

            });

            return response()->json([
                'status'        => 1,
                'data'          => $this->service->product,
                'message'       => 'Success',
            ]);
            
        } catch (\Throwable $th) {

            return response()->json([
                'status'        => 0,
                'data'          => $th->getMessage(),
                'message'       => 'Error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            DB::transaction(function() use($product){

                $this->service->update($product);

            });

            return response()->json([
                'status'        => 1,
                'data'          => $this->service->product,
                'message'       => 'Success',
            ]);
            
        } catch (\Throwable $th) {

            return response()->json([
                'status'        => 0,
                'data'          => $th->getMessage(),
                'message'       => 'Error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (count($product->attributes ?? []) > 0) {
                $product->attributes()->delete();
            }
            $product->delete();
            return response()->json([
                'status'    => 1,
                'data'      => 'Success',
                'message'   => 'Success'    ,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => 0,
                'data'      => $th->getMessage(),
                'message'   => 'Error',
            ]);
        }
    }



    public function attributeObject(Request $request)
    {
        return AttributeObject::where('attribute_id', $request->attribute_id)->get();
    }
}
