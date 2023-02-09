@extends('layouts.main')

@section('title', $category->category)

@section('custom_styles')
    <link rel="stylesheet" type="text/css" href="/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
@endsection

@section('custom_scripts')
    <script src="/js/categories.js"></script>

    <script>
        $(document).ready(function(){
            $('.product_sorting_btn').click(function () {
                let options = this.getAttribute('data-isotope-option');

                if (options !== undefined && options !== null && options.length) {
                    options = JSON.parse(options);

                    let csrf = document.querySelector('head meta[name="csrf-token"]');

                    if (options.sortBy !== undefined && options.sortBy !== null) {
                        $.ajax({
                            url: '{{ route('showCategory', $category->alias) }}',
                            method: 'GET',
                            data: options,
                            success: function(response) {
                                if (typeof response === 'string') {
                                    let grid = document.querySelector('.product_grid');
                                    grid.innerHTML = response;

                                    let $grid = $(grid);

                                    $grid.isotope('destroy');
                                    $grid.isotope({
                                        itemSelector: '.product',
                                        layoutMode: 'fitRows',
                                        fitRows:
                                            {
                                                gutter: 30
                                            },
                                        animationOptions:
                                            {
                                                duration: 750,
                                                easing: 'linear',
                                                queue: false
                                            }
                                    });
                                }

                                let url = location.protocol + '//' + location.host + location.pathname
                                    + '?soryBy=' + options.sortBy + '&sortOrder=' + options.sortOrder + '&page=' + options.page;

                                history.pushState({}, '', url);
                            },
                            headers: {
                                'X-CSRF-TOKEN': csrf.content,
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            @if ($category->main_image !== null && strlen($category->main_image))
            <div class="home_background" style="background-image:url({{ $category->main_image }})"></div>
            @endif
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{ $category->category }}<span>.</span></div>
                                <div class="home_text">
                                    {!! $category->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Showing <span>{{ $category->products->count() }}</span> results</div>
                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Sort by</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "id", "sortOrder": "asc", "page": {{ $pagination_page }} }'><span>Default</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price", "sortOrder": "asc", "page": {{ $pagination_page }} }'><span>Price: Low to high</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price", "sortOrder": "desc", "page": {{ $pagination_page }} }'><span>Price: High to low</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "product", "sortOrder": "asc", "page": {{ $pagination_page }} }'><span>Name: A to Z</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "product", "sortOrder": "desc", "page": {{ $pagination_page }} }'><span>Name: Z to A</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="product_grid">
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
                    </div>

                    {{ $products->appends(request()->query())->links('common.pagination') }}

                </div>
            </div>
        </div>
    </div>

    <!-- Icon Boxes -->

    <div class="icon_boxes">
        <div class="container">
            <div class="row icon_box_row">

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
                        <div class="icon_box_title">Free Shipping Worldwide</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
                        <div class="icon_box_title">Free Returns</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
                        <div class="icon_box_title">24h Fast Support</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
