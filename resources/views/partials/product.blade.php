@foreach ($products as $product)
<div class="col-sm mb-2">
    <div class="card">
        <div class="card-header">
        {{ $product->name }}
        </div>
    
        <div class="card-body">
            <div class="product-image"><img src="{{ asset($product->image) }}" alt="" width="80" height="100"></div>
            <span>Price: <strong>{{ number_format($product->offer_price ? $product->offer_price : $product->price, 2, '.', '') }}</strong></span>
            <p>
                
                @foreach ($item->product_attributes ?? [] as $attribute)
                    <p>
                        @if (count(optional($item->attributes)->where('attribute_id', $attribute->id) ?? []) > 0)
                            <strong>{{ $attribute->name }}: </strong>
                            @foreach (optional($item->attributes)->where('attribute_id', $attribute->id) ?? [] as $item)
                                <span class="badge bg-info">{{ optional($item->attributeObject)->name }}</span>
                            @endforeach
                            
                        @endif
                    </p>
                @endforeach
            </p>
            <div class="btn-group">
                @if (auth()->user()->role_id == 2 || auth()->user()->role_id == 1)
                    <a class="btn btn-outline-info" href="{{ route('products.edit', $product->id) }}">Edit</a>
                    <button class="btn btn-outline-danger" onclick="delete_item(`{{ $product->id }}`)">Delete</button>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach