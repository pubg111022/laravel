<p class="item-in-cart" id="itemInCart">{{ $quant }} items in your cart</p>
<input type="number" style="display: none" value="{{ $quant }}" id="quantity">
<div class="item-list">
    <?php
    $total = 0;
    $total_price = 0;
    $total_sale = 0;
    ?>
    @foreach ($list as $item)
        <div class="box" id="cartsub{{ $item->proId }}{{ $item->sizeid }}">
            <div class="img-part"> <img style="width: 90px;height: 80px;"
                    src="{{ url('uploads') }}/{{ $item->image }}" alt="product" class="img-responsive"> </div>
            <div class="text-part">
                <a class="product-name" style="width: 100%">{{ $item->name }}</a>
                <div class="quantity-and-price">{{ $item->quantity }} x
                    ${{ $item->sale_price > 0 ? $item->sale_price : $item->price }}</div>
            </div>
            <a style="cursor: pointer" onclick="removeSubCart({{ $item->proId }},{{ $item->sizeid }})" class="clear-btn"><i class="icon-cancel-music"></i></a>
        </div>
        <?php if ($item->sale_price > 0) {
        $total_sale += $item->sale_price * $item->quantity;
        } else {
        $total_price += $item->price * $item->quantity;
        } ?>
    @endforeach
    <?php $total = $total_sale + $total_price; ?>
</div>
<div class="cart-total"> <span id="total">Total: ${{ $total }}</span> </div>
<div class="cart-btm">
    <div class="btn-group"> <a href="{{ route('cart') }}" class="btn cart-view">view
            cart</a>
             {{-- <a href="{{ route('cart') }}" class="btn checkout">checkout</a> </div> --}}
</div>
</div>
