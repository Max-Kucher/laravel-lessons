@foreach($products as $product)
    <!-- Product -->
    <div class="product">

        @if(count($product->images))
            @php
                $img = "/images/{$product->images[0]->img}"
            @endphp
        @else
            @php
                $img = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/450px-No_image_available.svg.png';
            @endphp
        @endif

        <div class="product_image"><img src="{{ $img }}" alt=""></div>
        <div class="product_extra product_new"><a href="{{ route('showCategory', [$product->category->alias]) }}">{{ $product->category->category }}</a></div>
        <div class="product_content">
            <div class="product_title"><a href="{{ route('showProduct', [$product->category->alias, $product->id]) }}">{{ $product->product }}</a></div>
            <div class="product_price">${{ $product->price }}</div>
        </div>
    </div>
@endforeach
