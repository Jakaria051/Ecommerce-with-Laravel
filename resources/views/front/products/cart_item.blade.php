@php
    use App\Product;
@endphp
<table class="table cart-table table-responsive-xs">
    <thead>
        <tr class="table-head">
            <th scope="col">image</th>
            <th scope="col">product name</th>
            <th scope="col">Unit price</th>
            <th scope="col">quantity</th>
            <th scope="col">Discount</th>
            <th scope="col">Subtotal</th>
        </tr>
    </thead>

    @php
        $total_price = 0;
    @endphp
    @foreach ($userCartItems as $item)
    @php
        $attrPrice = Product::getDiscountAttrPrice($item['product_id'],$item['size']);
    @endphp
    <tbody>
        <tr>
            <td>
                <a href="#"><img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt="product_img"></a>
            </td>
            <td><a href="#">{{ $item['product']['product_name'] }} &nbsp;({{ $item['product']['product_code'] }}) <br>
                Color: {{ $item['product']['product_color'] }} <br>
                Color: {{ data_get($item,'size') }} <br>
            </a>
                <div class="mobile-cart-content row">
                    <div class="col-xs-3">
                        <div class="qty-box">
                            <div class="input-group">
                                <input type="text" name="quantity"  class="form-control input-number"
                                    value="{{ data_get($item,'quantity') }}">
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-3">
                        @if (isset($attrPrice['product_price']) && !empty($attrPrice['product_price']))
                        <h2 >${{ $attrPrice['product_price'] }}</h2>
                        @endif
                    </div>


                    <div class="col-xs-3">
                        <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a>
                        </h2>
                    </div>
                </div>
            </td>
            <td>
                @if (isset($attrPrice['product_price']) && !empty($attrPrice['product_price']))
                <h2 >${{ $attrPrice['product_price'] }}</h2>
                @endif

            </td>
            <td>
                <div class="qty-box">
                    <div class="input-group">
                        <input type="number" name="quantity" id="appendInputButtons" class="form-control input-number"
                            value="{{ data_get($item,'quantity') }}">
                            <button class="btn btnItemUpdate qtyMinus" data-cardid="{{ $item['id'] }}"><i class="ti-minus"></i></button>
                            <button class="btn btnItemUpdate qtyPlus" data-cardid="{{ $item['id'] }}"><i class="ti-plus"></i></button>
                            <button class="btnItemDelete" data-cardid="{{ $item['id'] }}"><a href="#" class="icon"><i class="ti-close"></i></a></button>
                        </div>


                </div>

            </td>
            <td> @if (isset($attrPrice['discount']) && !empty($attrPrice['discount']))
                <h2 >${{ $attrPrice['discount'] }}</h2>
                @endif
            </td>
            <td>
                <h2 class="td-color">{{ $attrPrice['final_price'] * $item['quantity'] }}</h2>
            </td>
        </tr>
    </tbody>
    @php
        $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);
    @endphp
    @endforeach
</table>
<table class="table cart-table table-responsive-md">
    <tfoot>
        <tr>
            <td>Sub total : &nbsp; </td>
            <td>${{ $total_price }}</td>
        </tr>
        <tr>
            <td>Coupon discounts: &nbsp;</td>
            <td class="couponAmount">
                @if (Session::has('couponAmount'))
                ${{ Session::get('couponAmount') }}
                @else
                $0.0
                @endif
            </td>
        </tr>
        <tr>
            <td>Grand Total: &nbsp;
            </td>
            <td>( <span>${{ $total_price }}</span> - <span class="couponAmount">$0</span> ) <br><strong id="grandTotal">${{ $total_price }}</strong></td>
        </tr>
    </tfoot>
</table>
