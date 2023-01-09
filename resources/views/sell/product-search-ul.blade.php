@foreach ($products as $product)
<li class="ul-clickable" data-id="{{ $product->id }}" data-unit-price="{{ $product->selling_price }}">{{ $product->name.'['.$product->selling_price.'Tk/unit]' }}</li>
@endforeach
