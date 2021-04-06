<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{ $orderDetails['id'] }}</h3>
    		    <br>
				<span class="pull-right">
					@php
						echo DNS1D::getBarcodeHTML($orderDetails['id'], 'C39');
					@endphp
				</span>
			</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
                    {{ data_get($userDetails,'name') }}<br>
                    @if (!empty(data_get($userDetails,'address')))
                    {{ data_get($userDetails,'address') }},@endif
                    @if (!empty(data_get($userDetails,'city')))
                    {{ data_get($userDetails,'city') }},@endif
                    @if (!empty(data_get($userDetails,'state')))
                    {{ data_get($userDetails,'state') }} <br>@endif
                    @if (!empty(data_get($userDetails,'pincode')))
                    {{ data_get($userDetails,'pincode') }},@endif
                    @if (!empty(data_get($userDetails,'country')))
                    {{ data_get($userDetails,'country') }} <br>@endif
                    @if (!empty(data_get($userDetails,'mobile')))
                    {{ data_get($userDetails,'mobile') }} <br>@endif

                </address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    				{{ data_get($orderDetails,'name') }}<br>
                    {{ data_get($orderDetails,'address') }},
                    {{ data_get($orderDetails,'city') }},
                    {{ data_get($orderDetails,'state') }} <br>
                    {{ data_get($orderDetails,'country') }},
                    {{ data_get($orderDetails,'pincode') }} <br>
                    {{ data_get($orderDetails,'mobile') }} <br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
                        {{ data_get($orderDetails,'payment_method') }}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
                        {{  date('F j, Y, g:i a',strtotime($orderDetails['created_at'] )) }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							@php
                                    $subTotal = 0;
                                @endphp
                                @foreach ($orderDetails['order_products'] as $product)
                                <tr>
    								<td>
                                        Name:{{ data_get($product,'product_name') }} <br>
                                        Code:{{ data_get($product,'product_code') }} <br>
                                        Size:{{ data_get($product,'product_size') }} <br>
                                        Color:{{ data_get($product,'product_color') }} <br>
										@php
										echo DNS1D::getBarcodeHTML(data_get($product,'product_code'), 'C39');
										@endphp
										<br>
                                    </td>
    								<td class="text-center">${{ data_get($product,'product_price') }}</td>
    								<td class="text-center">{{ data_get($product,'product_qty') }}</td>
    								<td class="text-right">${{ data_get($product,'product_price') * data_get($product,'product_qty') }}</td>
    							</tr>
                                @php
                                $subTotal = $subTotal + data_get($product,'product_price') * data_get($product,'product_qty');
                                @endphp
                                @endforeach
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$ {{ $subTotal }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$0</td>
    							</tr>
                                @if (data_get($orderDetails,'coupon_amount') > 0)
                                <tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Discount</strong></td>
    								<td class="no-line text-right">${{ data_get($orderDetails,'coupon_amount') }}</td>
    							</tr>
                                @endif
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">${{ data_get($orderDetails,'grand_total') }}</td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
