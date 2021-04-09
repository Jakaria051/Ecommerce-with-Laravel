<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>Example 2</title>
            <style>
            @font-face {
                font-family: SourceSansPro;
                src: url(SourceSansPro-Regular.ttf);
              }

              .clearfix:after {
                content: "";
                display: table;
                clear: both;
              }

              a {
                color: #0087C3;
                text-decoration: none;
              }

              body {
                position: relative;
                width: 21cm;
                height: 29.7cm;
                margin: 0 auto;
                color: #555555;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-family: SourceSansPro;
              }

              header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #AAAAAA;
              }

              #logo {
                float: left;
                margin-top: 8px;
              }

              #logo img {
                height: 70px;
              }

              #company {
                float: right;
                text-align: right;
              }


              #details {
                margin-bottom: 50px;
              }

              #client {
                padding-left: 6px;
                border-left: 6px solid #0087C3;
                float: left;
              }

              #client .to {
                color: #777777;
              }

              h2.name {
                font-size: 1.4em;
                font-weight: normal;
                margin: 0;
              }

              #invoice {
                float: right;
                text-align: right;
              }

              #invoice h1 {
                color: #0087C3;
                font-size: 2.4em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 10px 0;
              }

              #invoice .date {
                font-size: 1.1em;
                color: #777777;
              }

              table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
              }

              table th,
              table td {
                padding: 20px;
                background: #EEEEEE;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;
              }

              table th {
                white-space: nowrap;
                font-weight: normal;
              }

              table td {
                text-align: right;
              }

              table td h3{
                color: #57B223;
                font-size: 1.2em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
              }

              table .no {
                color: #FFFFFF;
                font-size: 1.6em;
                background: #57B223;
              }

              table .desc {
                text-align: left;
              }

              table .unit {
                background: #DDDDDD;
              }

              table .qty {
              }

              table .total {
                background: #57B223;
                color: #FFFFFF;
              }

              table td.unit,
              table td.qty,
              table td.total {
                font-size: 1.2em;
              }

              table tbody tr:last-child td {
                border: none;
              }

              table tfoot td {
                padding: 10px 20px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1.2em;
                white-space: nowrap;
                border-top: 1px solid #AAAAAA;
              }

              table tfoot tr:first-child td {
                border-top: none;
              }

              table tfoot tr:last-child td {
                color: #57B223;
                font-size: 1.4em;
                border-top: 1px solid #57B223;

              }

              table tfoot tr td:first-child {
                border: none;
              }

              #thanks{
                font-size: 2em;
                margin-bottom: 50px;
              }

              #notices{
                padding-left: 6px;
                border-left: 6px solid #0087C3;
              }

              #notices .notice {
                font-size: 1.2em;
              }

              footer {
                color: #777777;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #AAAAAA;
                padding: 8px 0;
                text-align: center;
              }

            </style>
          </head>
          <body>
            <header class="clearfix">
              <div id="logo">
                <h2>Order Invoice</h2>
              </div>

            </header>
            <main>
              <div id="details" class="clearfix">
                <div id="client">
                  <div class="to">INVOICE TO:</div>
                  <h2 class="name">'.data_get($orderDetails,'name').'</h2>
                  <div class="address">'.data_get($orderDetails,'address').','.data_get($orderDetails,'city').','.data_get($orderDetails,'state').'</div>
                  <div class="address">'.data_get($orderDetails,'country').'-'.data_get($orderDetails,'pincode').'</div>
                  <div class="email"><a href="mailto:'.data_get($orderDetails,'email').'">'.data_get($orderDetails,'email').'</a></div>
                </div>
                <div style="float:right;">
                  <h1>Order ID '.data_get($orderDetails,'id').'</h1>
                  <div class="date">Order Date :'.date('F j, Y, g:i a',strtotime($orderDetails['created_at'] )).'</div>
                  <div class="date">Order Amount : '.data_get($orderDetails,'grand_total').'</div>
                  <div class="date">Order Status : '.data_get($orderDetails,'order_status').'</div>
                  <div class="date">Payment Method : '.data_get($orderDetails,'payment_method').'</div>


                </div>
              </div>
              <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                  <tr>
                    <th class="unit">Product Code</th>
                    <th class="desc">Size</th>
                    <th class="unit">Color</th>
                    <th class="qty">Price</th>
                    <th class="unit">Qty</th>
                    <th class="total">Total</th>
                  </tr>
                </thead>
                <tbody>';
                    $subTotal = 0;
                    foreach ($orderDetails['order_products'] as $product) {
                    $output .='<tr>
                    <td class="unit">'.data_get($product,'product_code').'</td>
                    <td class="unit">'.data_get($product,'product_size').'</td>
                    <td class="unit">'.data_get($product,'product_color').'</td>
                    <td class="qty">$ '.data_get($product,'product_price').'</td>
                    <td class="unit">'.data_get($product,'product_qty').'</td>
                    <td class="total">$ '.data_get($product,'product_price') * data_get($product,'product_qty').'</td>
                  </tr>';
                  $subTotal = $subTotal + (data_get($product,'product_price') * data_get($product,'product_qty'));
                }

                $output .='</tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>$ '.$subTotal.'</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Shipping Charges</td>
                    <td>$0</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Coupon Discount</td>';
                    if (data_get($orderDetails,'coupon_amount') > 0) {
                    $output .='<td>$ '.data_get($orderDetails,'coupon_amount').'</td>';
                   }else {
                    $output .='<td>$ 0</td>';
                   }
                    $output .='</tr>
                  <tr>
                    <td colspan="2"></td>
                    <td colspan="2">GRAND TOTAL</td>
                    <td>$ '.data_get($orderDetails,'grand_total').'</td>
                  </tr>
                </tfoot>
              </table>
              <div id="thanks">Thank you!</div>
              <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">Thanks for choosing our service.</div>
              </div>
            </main>
            <footer>
              Invoice was created on a computer and is valid without the signature and seal.
            </footer>
          </body>
        </html>
