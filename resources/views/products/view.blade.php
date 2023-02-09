@extends('layouts.main')

@section('title', $product->product)

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
@endsection

@section('custom_scripts')
    <script src="/js/product.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form.ajax-from', function (event) {
                let form_data = new URLSearchParams(Array.from(new FormData(this))).toString();
                let method = this.method.toUpperCase();

                $.ajax({
                    url: '{{ route('checkoutAdd') }}?' + form_data,
                    method: method.length ? method : 'GET',
                    success: function (response) {
                        console.log(response);
                    },
                });

                event.preventDefault();
            });
        });
    </script>
@endsection

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/categories.jpg)"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">Smart Phones<span>.</span></div>
                                <div class="home_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->

    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="details_image">
                        <div class="details_image_large">
                            @if(count($product->images))
                                <img src="/images/{{ $product->images[0]->img }}" alt="{{ $product->product }}">
                            @else
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/450px-No_image_available.svg.png" alt="{{ $product->product }}">
                            @endif
                            <div class="product_extra product_new"><a href="categories.html">New</a></div>
                        </div>

                        @if(count($product->images))
                        <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            @foreach($product->images as $image)
                                @php
                                    if ($loop->first) {
                                        $additional_class = ' active';
                                    } else {
                                        $additional_class = '';
                                    }
                                @endphp


                                <div class="details_image_thumbnail{{ $additional_class }}" data-image="/images/{{ $image->img }}"><img src="/images/{{ $image->img }}" alt="{{ $product->product }}"></div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <form class="ajax-from" action="{{ route("checkoutAdd") }}" method="post">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="details_content">
                        <div class="details_name">{{ $product->product }}</div>

                        @if ($product->old_price !== null && $product->old_price > $product->price)
                            <div class="details_discount">${{ $product->old_price }}</div>
                        @endif

                        <div class="details_price">${{ $product->price }}</div>

                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Availability:</div>
                            <span>
                                @if ($product->in_stock)
                                    In Stock
                                @else
                                    <bdi style="color:#e95a5a">
                                        Out of stock
                                    </bdi>
                                @endif
                            </span>
                        </div>
                        @if (strlen($product->short_description))
                        <div class="details_text">
                            {!! $product->short_description !!}
                        </div>
                        @endif

                        <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span>Qty</span>
                                <input id="quantity_input" type="text" name="amount" pattern="[0-9]*" value="1">
                                <div class="quantity_buttons">
                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="button cart_button"><button type="submit">Add to cart</button></div>
                        </div>

                        <!-- Share -->
                        <div class="details_share">
                            <span>Share:</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        @if (strlen($product->full_description))
                        <div class="description_title">Description</div>
                        @endif
                        <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div>
                    </div>
                    @if (strlen($product->full_description))
                    <div class="description_text">
                        {!! $product->full_description !!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="products_title">Related Products</div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="product_grid">

                        <!-- Product -->
                        <div class="product">
                            <div class="product_image"><img src="/images/product_1.jpg" alt=""></div>
                            <div class="product_extra product_new"><a href="categories.html">New</a></div>
                            <div class="product_content">
                                <div class="product_title"><a href="product.html">Smart Phone</a></div>
                                <div class="product_price">$670</div>
                            </div>
                        </div>

                        <!-- Product -->
                        <div class="product">
                            <div class="product_image"><img src="/images/product_2.jpg" alt=""></div>
                            <div class="product_extra product_sale"><a href="categories.html">Sale</a></div>
                            <div class="product_content">
                                <div class="product_title"><a href="product.html">Smart Phone</a></div>
                                <div class="product_price">$520</div>
                            </div>
                        </div>

                        <!-- Product -->
                        <div class="product">
                            <div class="product_image"><img src="/images/product_3.jpg" alt=""></div>
                            <div class="product_content">
                                <div class="product_title"><a href="product.html">Smart Phone</a></div>
                                <div class="product_price">$710</div>
                            </div>
                        </div>

                        <!-- Product -->
                        <div class="product">
                            <div class="product_image"><img src="/images/product_4.jpg" alt=""></div>
                            <div class="product_content">
                                <div class="product_title"><a href="product.html">Smart Phone</a></div>
                                <div class="product_price">$330</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
