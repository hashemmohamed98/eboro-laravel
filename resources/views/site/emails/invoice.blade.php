<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eboro Invoice</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Roboto&display=swap');

        @media(max-width:767px) {
            table{
                width: 100% !important
            }
            table td a img{
                width: 60% !important
            }
        }

    </style>
</head>

<body>
    <table style="table-layout: fixed; width: 100%; padding: 1rem; text-align: center; width: 60%; display: table; margin: 3rem auto;border-radius: 15px; box-shadow: 0 0px 5px 5px #c1c1c16b">
        <tr>
            <td>
                <a href="">
                    <img src="{{asset('public/uploads/setting/'.$share_setting->logo)}}" style="width: 30%;" alt="">
                </a>
            </td>
        </tr>
        <tr>
            <td style="width: 100%">
                <h1 style="color: #BE1A25; text-align: center; font-family: 'Roboto', sans-serif;">Thanks For Your Business</h1>
            </td>
        </tr>
        <tr>
            <td style="width: 100%; text-align: center">
                <h2 style="color: #343a40;text-align: center;
                font-family: 'Roboto', sans-serif; font-weight: bold; margin: 0">Order Summary</h2>
            </td>
        </tr>
        <tr>
            <td>
                <p style="text-align: center;border-bottom: 1px solid #dee2e6; padding-bottom: 1rem;color: rgba(0, 0, 0, .5);
                font-size: 1.3rem;
                font-weight: 600;font-family: 'Nunito', sans-serif; margin: 0">
                The total cost consist of the tax and the shipping charge
            </p>
            </td>
        </tr>
        @foreach($data->content as $item)
        <tr style="text-align: initial !important">
            <td>
                <div style="width: 33.333%; border-bottom: 1px solid #dee2e6;font-family: 'Nunito', sans-serif; float: left">
                    <h4>{{$item->product->name}}</h4>
                </div>
                <div style="width: 33.333%; border-bottom: 1px solid #dee2e6;font-family: 'Nunito', sans-serif; float: left">
                    <h4 style="color: #BE1A25"><span style="color: black">Items:</span> {{$item->qty}}</h4>
                </div>
                <div style="width: 33.333%; border-bottom: 1px solid #dee2e6;font-family: 'Nunito', sans-serif; float: left">
                    <h4 style="color: #BE1A25">{{number_format( (float) $item->product->price, 2, '.', '')}} €</h4>
                </div>
            </td>
        </tr>
        @endforeach
        <tr style="text-align: initial !important">
            <td>
                <div style="width: 67%; border-bottom: 1px solid #dee2e6;font-family: 'Nunito', sans-serif; float: left">
                    <h4>Shipping</h4>
                </div>
                <div style="width: 33%; border-bottom: 1px solid #dee2e6;font-family: 'Nunito', sans-serif; float: left">
                    <h4 style="color: #BE1A25">{{number_format( (float) $data->shipping_price, 2, '.', '')}} €</h4>
                </div>
            </td>
        </tr>
        <tr style="text-align: initial !important">
            <td>
                <div style="width: 67%; border-bottom: 1px solid #dee2e6;font-family: 'Nunito', sans-serif; float: left">
                    <h4 >Total</h4>
                </div>
                <div style="width: 33%; border-bottom: 1px solid #dee2e6;font-family: 'Nunito', sans-serif; float: left">
                    <h4 style="color: #BE1A25">{{number_format( (float) $data->total_price, 2, '.', '')}}  €</h4>
                </div>
            </td>
        </tr>
        <tr style="text-align: initial !important">
            <td>
                <h2 style="font-weight: bold;font-family: 'Roboto', sans-serif;text-align: center">Personal Details</h2>
            </td>
        </tr>
        <tr style="text-align: initial !important">
            <td>
                <div style="width: 67%;font-family: 'Nunito', sans-serif; float: left">
                    <h4>Shipping to</h4>
                </div>
                <div style="width: 33%;font-family: 'Nunito', sans-serif; float: left">
                    <span style="color: #5f5b5b; width:45%; text-align: initial">
                        {{$data->drop_address}}
                    </span>
                </div>
            </td>
        </tr>
        <tr style="text-align: initial !important">
            <td>
                <div style="width: 67%;font-family: 'Nunito', sans-serif; float: left">
                    <h4 >Billing to</h4>
                </div>
                <div style="width: 33%;font-family: 'Nunito', sans-serif; float: left">
                    <span style="color: #5f5b5b; width:45%; text-align: initial">
                        @if($data->payment==0)
                            Cash on delivery
                        @elseif($data->payment==1)
                            pay by debit card
                        @else
                            pay by paypal
                        @endif
                    </span>
                </div>
            </td>
        </tr>
        <tr style="text-align: center;font-family: 'Nunito', sans-serif;">
            <td>
                <p style=" margin: 0">Need Help? <a href="" style="color: #BE1A25" >info@eboro.it</a></p>
            </td>
        </tr>
        <tr style="text-align: center;font-family: 'Nunito', sans-serif;">
            <td>
                <p style="color: #BE1A25;"><a href="{{asset('/privacy')}}" style="color: #BE1A25">Terms Of Service</a> | <a href="{{asset('/privacy')}}" style="color: #BE1A25">Privacy Policey</a></p>
            </td>
        </tr>
        <tr>
            <td>
                <a href=""><img src="{{asset('images/en_badge_web_generic.png')}}" width="120px" alt=""></a>
                <a href=""><img src="{{asset('images/fff.png')}}" width="120px" alt=""></a>
            </td>
        </tr>
    </table>
    </body>
</html>
