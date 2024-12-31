<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>
  <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    table, td, div, h1, p {font-family: Arial, sans-serif;}
  </style>
</head>
<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
          <td align="center" style="padding:0;">
            <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
              <tr>
                <td align="center" style="padding:40px 0 30px 0;background:#CCC;">
                  @if($general_setting->site_logo)
                  <a href="{{url('/')}}"><img src="{{url('logo', $general_setting->site_logo)}}" width="200" style="height:auto;display:block;"></a>
                  @else
                  <a href="{{url('/')}}">
                    <h1 class="d-inline">{{$general_setting->site_title}}</h1>
                  </a>
                  @endif
                </td>
              </tr>
              <tr>
                <td style="padding:36px 30px 42px 30px;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                    <tr>
                      <td style="padding:0 0 36px 0;color:#153643;">

                        <h1>Sale Details</h1>
                        <p><strong>Reference: </strong>{{$sale_data['reference_no']}}</p>
                        <p>
                            <strong>Sale Status: </strong>
                            @if($sale_data['sale_status']==1){{'Completed'}}
                            @elseif($sale_data['sale_status']==2){{'Pending'}}
                            @endif
                        </p>
                        <p>
                            <strong>Payment Status: </strong>
                            @if($sale_data['payment_status']==1){{'Pending'}}
                            @elseif($sale_data['payment_status']==2){{'Due'}}
                            @elseif($sale_data['payment_status']==3){{'Partial'}}
                            @else{{'Paid'}}@endif
                        </p>
                        <h3>Order Table</h3>
                        <table style="border-collapse: collapse; width: 100%;">
                            <thead>
                                <th style="border: 1px solid #ccc; padding: 5px">#</th>
                                <th style="border: 1px solid #ccc; padding: 5px">Product</th>
                                <th style="border: 1px solid #ccc; padding: 5px">Download Link</th>
                                <th style="border: 1px solid #ccc; padding: 5px">Qty</th>
                                <th style="border: 1px solid #ccc; padding: 5px">Unit Price</th>
                                <th style="border: 1px solid #ccc; padding: 5px">SubTotal</th>
                            </thead>
                            <tbody>
                                @foreach($sale_data['products'] as $key=>$product)
                                <tr>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$key+1}}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$product}}</td>
                                    @if($sale_data['file'][$key])
                                        <td style="border: 1px solid #ccc; padding: 5px"><a href="{{ $sale_data['file'][$key] }}">Download</a></td>
                                    @else
                                        <td style="border: 1px solid #ccc; padding: 5px">N/A</td>
                                    @endif
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$sale_data['qty'][$key].' '.$sale_data['unit'][$key]}}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{number_format((float)($sale_data['total'][$key] / $sale_data['qty'][$key]), $general_setting->decimal, '.', '')}}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$sale_data['total'][$key]}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" style="border: 1px solid #ccc; padding: 5px"><strong>Total </strong></td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$sale_data['total_qty']}}</td>
                                    <td style="border: 1px solid #ccc; padding: 5px"></td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$sale_data['total_price']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border: 1px solid #ccc; padding: 5px"><strong>Order Tax </strong> </td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$sale_data['order_tax'].'('.$sale_data['order_tax_rate'].'%)'}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border: 1px solid #ccc; padding: 5px"><strong>Order discount </strong> </td>
                                    <td style="border: 1px solid #ccc; padding: 5px">
                                        @if($sale_data['order_discount']){{$sale_data['order_discount']}}
                                        @else 0 @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border: 1px solid #ccc; padding: 5px"><strong>Shipping Cost</strong> </td>
                                    <td style="border: 1px solid #ccc; padding: 5px">
                                        @if($sale_data['shipping_cost']){{$sale_data['shipping_cost']}}
                                        @else 0 @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border: 1px solid #ccc; padding: 5px"><strong>Grand Total</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{$sale_data['grand_total']}}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border: 1px solid #ccc; padding: 5px"><strong>Paid Amount</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 5px">
                                        @if($sale_data['paid_amount']){{$sale_data['paid_amount']}}
                                        @else 0 @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="border: 1px solid #ccc; padding: 5px"><strong>Due</strong></td>
                                    <td style="border: 1px solid #ccc; padding: 5px">{{number_format((float)($sale_data['grand_total'] - $sale_data['paid_amount']), $general_setting->decimal, '.', '')}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <p>Thank You</p>
                    </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:30px;background:#333;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                <tr>
                  <td style="padding:0;width:50%;" align="center">
                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                      &copy; {{$general_setting->site_title}} {{date('Y')}}<br/>
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>