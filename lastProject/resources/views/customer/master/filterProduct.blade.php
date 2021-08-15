@foreach ($data as $item)
    @if (Auth::check())
        <?php $exits = $wish->checkexits($item->id, Auth::user()->id); ?>
    @else
        <?php $exits = 0; ?>
    @endif
    <div class="col-sm-4 col-xs-12 item">
        <div class="wrapper">
            <div class="pro-img">
                <img src="{{ url('uploads') }}/{{ $item->image }}" alt="product" class="img-responsive" />
            </div>
            <div class="contain-wrapper">
                <div class="tit">{{ $item->name }}</div>
                @if ($item->sale_price > 0)
                    <div class="price">
                        <div class="new-price">${{ $item->sale_price }}</div>
                        <div class="old-price"><del>${{ $item->price }}</del></div>
                    </div>
                @else
                    <div class="price">
                        <div class="new-price">${{ $item->price }}</div>
                    </div>
                @endif
                <div class="btn-part"> <a onclick="addtoCart({{ $item->id }})" style="cursor: pointer"
                        class="cart-btn">buy now</a>
                    <i class="icon-basket-supermarket"></i>
                </div>
            </div>
            <div class="wrapper-box-hover">
                <div class="text">
                    <ul>
                        @if (Auth::check())
                            <li><a onclick="addtowish({{ $item->id }})"><i id="heart{{ $item->id }}"
                                        style="color: {{ $exits == 1 ? 'red' : 'white' }}" class="icon-heart"></i></a>
                            </li>
                        @else
                            <li><a href="{{ route('login', 'page=store') }}"><i id="heart{{ $item->id }}"
                                        style="color: {{ $exits == 1 ? 'red' : 'white' }}"
                                        class="icon-heart"></i></a></li>
                        @endif
                        <li><a href="{{ route('productdetail', $item->id) }}"><i class="icon-view"></i></a></li>
                        @if (Auth::check())
                            @if ($item->status == 0)
                                <li><a onclick="addtoCart({{ $item->id }})" style="cursor: pointer"><i
                                            class="icon-basket-supermarket"></i></a></li>
                            @else
                                <li><a onclick="soldout()" style="cursor: pointer"><i
                                            class="icon-basket-supermarket"></i></a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login', 'page=store') }}" style="cursor: pointer"><i
                                        class="icon-basket-supermarket"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            @if ($item->status == 0)
                @if ($item->sale_price > 0)
                    <div class="sale">sale</div>
                @endif
                @if ($item->id == $new->id)
                    <div class="new">new</div>
                @endif
            @else
                <div class="sale">Sold</div>
            @endif
        </div>
    </div>
@endforeach
<div class="col-sm-12 col-xs-12">
    <nav aria-label="Page navigation example">
        @if ($data->lastPage() > 1)
            <ul class="pagination">
                @if ($data->onFirstPage())
                    <li class="hidden-md"></li>
                @else
                    <li class="page-item indicator left"><a class="page-link" href="{{ $data->previousPageUrl() }}"
                            rel="prev"><i class="icon-right-arrow"></i></a>
                    </li>
                @endif
                @for ($i = 1; $i <= $data->lastPage(); $i++)
                    <li class="page-item ">
                        <a class="page-link  {{ $i == $data->currentPage() ? 'active' : '' }}"
                            href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($data->hasMorePages())
                    <li class="page-item indicator right"><a class="page-link" href="{{ $data->nextPageUrl() }}"
                            rel="next"><i class="icon-right-arrow"></i></a>
                    </li>
                @else
                    <li class="d-none"></li>
                @endif
            </ul>
        @endif
    </nav>
</div>
