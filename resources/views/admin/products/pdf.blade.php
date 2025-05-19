<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prouct Information</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <style>
        body{
            border-style: double;
        }
        .logo_div{
            display: inline-block;
            width: 600px;
            margin: 50px;
        }
        .date_style{
            margin-left: 370px;
        }
        .product_details{
            width: 600px;
            margin: 50px;
             text-align: center;
        }
        .qr_div{
            text-align: center;
        }
        page{
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            width: 21cm;
            height: 29.7cm;
        }


    </style>
    <body>
        <div class="logo_div">
            <img src="{{$imagePath}}" alt="Logo" style="width: 209px; height: 33px; padding-top: 20px;">
            <strong class="date_style">Date: {{$date}}</strong>
        </div>

        <div class="product_details">
            <div>
                <strong>Product Name: </strong><span>{{$product->name}}</span>
            </div>
            <br>
            <div>
                <strong>Price: </strong><span>{{ number_format($product->price)}}{{ '' }} {{ $product->currency }}</span>
            </div>

        </div> <br>

        <div class="qr_div">
            <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code"><br><br>
            <strong style="text-align: center; padding-top:50px;">Scan</strong>
        </div>
    </body>
</html>
