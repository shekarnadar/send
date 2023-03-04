<!DOCTYPE html>
<html>
<head>
	 <style type="text/css">
            table.pic-table{
                border-collapse: collapse;
                width: 600px;
                page-break-inside: avoid;

            }
            table.pic-table-product{
                border-collapse: collapse;
                width: 580px;
                border:none;

            }
            
            @font-face {
                font-family: Basawa;
                src: url(/static/fonts/B39MHR.ttf);
            }
            
            .barcode{
                font-family: Basawa;
                font-size: 72px;
            }
            .barcode-inside{
                font-size: 48px;
                text-align: center;
                display: block;
            }
            .heading>td{
                padding: 10px;
            }
            .brand-icon{
                height: 30px;
                vertical-align: middle;
            }
            .loc-code{
                position: absolute;
                right: 5px;
                bottom: 5px;
                font-size: 20px;
            }
            .address-cell{
                padding: 5px;
            }
            .top-head{
                margin-top: 5px;
                margin-bottom: 8px;
            }
            
            .small-head{
                font-weight: bold;
                margin: 16px 0;
            }
            .barcode-head{
                text-align: center;
                margin-bottom: 4px;
                margin-top: 6px;
            }
            .address-cell>h3{
                margin-top: 6px;
                margin-bottom: 6px;
                font-size: 25px;
            }
            .address-cell>p{
                margin: 0 8px;
            }
            .pad-head{
                font-size: 22px;
            }
            .text-center{
                text-align: center;
            }
            .rotate270 {
                -webkit-transform: rotate(270deg);
                -moz-transform: rotate(270deg);
                -o-transform: rotate(270deg);
                -ms-transform: rotate(270deg);
                transform: rotate(270deg);
            }
            .clearfix:after{
                content: "";
                display: table;
                clear: both;
            }
            @media print {
            }
           
            
        </style>
</head>
<body>
	   <table border="1" class="pic-table">

    <tbody>
       
        <tr class="heading" style="text-align: center">

            <td style="font-size: 20px;">
                {{$couriar}}
            </td>
            <td>
                
                    
                
            </td>
        </tr>
        <tr>
            <td colspan="2">
                @php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                @endphp
                <center><br/><img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($redeemedDetail['orders']['tracking_id'], $generatorPNG::TYPE_CODE_128)) }}" width="300" height="100"><h4> {{$redeemedDetail['orders']['tracking_id'] }}</h4></center>
            </td>
        </tr>
        <tr>
            <td>
                PICKRR 
            </td>
            <td>
                
            </td>
        </tr>
        
        <tr>
            <td class="address-cell">
                <h4 class="top-head">Shipping Address :</h4>
                <h3>{{ $redeemedDetail['recipientDetails']['first_name'] .' '. $redeemedDetail['recipientDetails']['last_name'] }}</h3>
                <p class="small-head">
                    Phone:
                    {{$redeemedDetail['recipientDetails']['phone']}}
                </p>
                <p>
                    {{ $redeemedDetail['recipientDetails']['address_line_1'].' '.$redeemedDetail['recipientDetails']['address_line_2'] }},  
                </p>
                <p class="small-head">
                    PINCODE -
                    {{$redeemedDetail['recipientDetails']['postal_code'] }}
                </p>
                

            </td>
            
                <td style="width: 200px;text-align:center;">
                  <b>Sender Name :</b> <br/>{{$sender}}
                   <br/><br/>PREPAID
                </td>
            
        </tr>
        
        
        <tr>
            <td class="address-cell">
                
                    
                       
                
                <p>
                    <span class="small-head">
                        Order ID :
                    </span>
                    <span>
                       {{$redeemedDetail['orders']['order_id'] }}
                    </span>
                </p>

                <p>
                    <span class="small-head">
                        Tracking ID :
                    </span>
                    <span>
                        {{$redeemedDetail['orders']['tracking_id'] }}
                    </span>
                </p>
                <p>
                    <span class="small-head">Order Date :
                    </span>
                    <span>{{$redeemedDetail['orders']['created_at'] }}</span>
                </p>
                
                
            </td>
            <td class="address-cell">
                
                   
                
                <p>
                    <span class="small-head">Product :
                    </span>
                    <span>{{$redeemedDetail['productDetails']['name']}}</span>
                </p>
            </td>
        </tr>
        <tr class="text-center">
		    <td colspan="2" style="padding: 0 20px;padding-bottom: 10px;">
		        
		            <h3 style="margin-top:10px;margin-bottom:5px;"> It's a Gift</h3>
		        
		        <h4 style="margin-top:5px;margin-bottom:5px;font-size16px;">{{$redeemedDetail['clientDetails']['name'] }}</h4>
		    </td>
      </tr>
            
        
        
        
        
    </tbody>
</table>

			 
</body>
</html>
