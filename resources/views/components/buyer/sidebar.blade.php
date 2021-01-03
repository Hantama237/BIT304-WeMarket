<div class="col-lg-3">
    <h3></h3>
    <h3>Menu</h3>
    <div class="col-lg-12 box" style="height: 170px;">
        <ul>
            <li><a data-toggle="modal" data-target="#cartModal" href="#">My Cart Detail</a></li>
            <li><a href="{{URL::to("/orders")}}">My Order</a></li>
            {{-- <li><a href="/order/history">My Transaction</a></li> --}}
        </ul>
    </div>
    <h3>Product Cart</h3>
    @php
        $cart = Session::get('cart');
        $totalPrice = 0;
    @endphp
    <div class="col-lg-12 box" style="padding-bottom:10px; margin-bottom:100px;">
        @if($cart!=null)
            @foreach ($cart as $c)
                @php
                    $totalPrice+=$c['price']*$c['ammount'];
                @endphp
                <span>{{strlen($c['name'])>14?substr($c['name'],0,14)."..":$c['name']}} Rp {{number_format($c['price'],0,',','.')}} x{{$c['ammount']}}</span><br>
            @endforeach
        
        
        <div class="" style="text-align:left; margin-top:30px;">
            <span style="display:unset; font-weight:600;">Total: Rp {{number_format($totalPrice,0,',','.')}} &nbsp;</span>
            
        </div>
        <div class="" style="text-align:left; padding-top:5px;">
            {{-- <span style="display:unset; font-weight:600;">Total: Rp 250.000 &nbsp;</span> --}}
            <a data-toggle="modal" data-target="#cartModal" href="#">Detail</a>
            {{-- <button data-toggle="modal" data-target="#cartModal">detail</button> --}}
        </div>
        <div class="" style="text-align:right; padding-top:5px;">
            {{-- <span style="display:unset; font-weight:600;">Total: Rp 250.000 &nbsp;</span> --}}
            <button data-toggle="modal" data-target="#cartModal" style="display:inline-block; width:100%;">Checkout</button>
        </div>
        @else 
        <div>No product in cart</div>
        @endif
        
    </div>
</div>

