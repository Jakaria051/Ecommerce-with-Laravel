
<html>
<body>
    <table style="width: 700px;">
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <img src="{{ asset('images/front_images/logo1.png') }}" >
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Hello {{ $name }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Your Order #{{ $order_id }} status has been updated to {{ $order_status }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        @if (!empty($courier_name) && !empty($tracking_number))
        <tr><td>Your Courier Name is {{ $courier_name }} And Tracking Number is : {{ $tracking_number }}</td></tr>
        @endif
        <tr><td>&nbsp;</td></tr>

        <tr><td>Your order details are as below :</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table style="width: 95%;" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                    <tr bgcolor="#cccccc">
                        <td>Product Name</td>
                        <td>Code</td>
                        <td>Size</td>
                        <td>Color</td>
                        <td>Quantity</td>
                        <td>Price</td>
                    </tr>
                    @foreach ($orderDetails['order_products'] as $order)
                    <tr>
                        <td>{{ data_get($order,'product_name') }}</td>
                        <td>{{ data_get($order,'product_code') }}</td>
                        <td>{{ data_get($order,'product_size') }}</td>
                        <td>{{ data_get($order,'product_color') }}</td>
                        <td>{{ data_get($order,'product_qty') }}</td>
                        <td>${{ data_get($order,'product_price') }}</td>
                    </tr>

                    @endforeach
                    <tr>
                        <td colspan="5" align="right">Shipping Charges</td>
                        <td>$ {{ $orderDetails['shipping_charges'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Coupon Discount</td>
                        <td>$ @if ($orderDetails['coupon_amount'] > 0)
                            {{ $orderDetails['coupon_amount'] }}
                            @else
                            0
                        @endif</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Grand Total</td>
                        <td>$ {{ $orderDetails['grand_total'] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td><Strong>Delivery Address:</Strong></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ data_get($orderDetails,'name') }}</td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td>{{ data_get($orderDetails,'address') }}</td>
                    </tr>

                    <tr>
                        <td>City</td>
                        <td>{{ data_get($orderDetails,'city') }}</td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>{{ data_get($orderDetails,'state') }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ data_get($orderDetails,'country') }}</td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td>{{ data_get($orderDetails,'pincode') }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ data_get($orderDetails,'mobile') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>For any enquiries,you can contact us at <a href="jakariacse35@gmail.com">jakariacse35@gmail.com</a></td></tr>

        <tr><td>&nbsp;</td></tr>
        <tr><td>Regards,<br> Team E-commerce</td></tr>
        <tr><td>&nbsp;</td></tr>

    </table>
</body>
</html>
{{-- @php
    die;
@endphp --}}
