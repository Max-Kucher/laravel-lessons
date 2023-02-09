@if ($paginator->hasPages())
    <div class="product_pagination">
        <ul>
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true"><a href="javascript:void(0)">{{ $element }}</a></li>
                @elseif (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            @php($class = 'active')
                        @else
                            @php($class = '')
                        @endif

                        <li class="{{ $class }}">
                            <a href="{{ $url }}">{{ $page }}.</a></li>
                    @endforeach
                @endif
            @endforeach
        </ul>
    </div>
@endif
