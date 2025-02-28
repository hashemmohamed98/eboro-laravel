<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eboro Verify</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
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

<div style="margin: 1rem 0; text-align: center">
    <a href="">
        <img src="{{asset('public/uploads/setting/'.$share_setting->logo)}}" style="width: 20%;" alt="">
    </a>
</div>
<table style="padding: 1rem; text-align: center;
            width: 60%; display: table; margin: 3rem auto;"
          >
    <tbody style="width: 100%; text-align: center">
        <tr style="width: 100%; text-align: center">
            <td style="text-align: center">
                <img src="{{asset('svg-icons/subscribe.svg')}}" width="300px" height="300px" alt="">
            </td>
        </tr>
        <tr>
            <td style="display: flex; width: 100%; flex-direction: column; justify-content: start; align-items: start;font-family: 'Roboto', sans-serif;">
                <h3>Hi, {{$data['name']}}</h3>
                <p style="color: rgba(0, 0, 0, .7);">  That`s all we can say now. copy the code :  {{$data['verify_code']}}. </p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; margin-bottom: 1rem;font-family: 'Roboto', sans-serif;">
                <a href="" style="background-color:#BE1A25; padding: 8px 25px;display: inline-block;
                border-radius: 5px; color: #fff;margin-bottom: 1rem; text-decoration: none">Verify Email</a>
            </td>
        </tr>
        <tr>
            <td style="text-align: start;font-family: 'Roboto', sans-serif;">
                <p>Or by using this link
                    <a href="" class="text-underline" style="color: #05203D">
                        {{asset('/')}}
                    </a>
                </p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; border-bottom: 1px solid #ccc;font-family: 'Roboto', sans-serif;">
                <p>Need Help? <a href="" style="color: #BE1A25" >info@eboro.it</a></p>
                <p style="color: #BE1A25"><a href="{{asset('/privacy')}}" style="color: #BE1A25">Terms Of Service</a> | <a href="{{asset('/privacy')}}" style="color: #BE1A25">Privacy Policey</a></p>
            </td>
        </tr>
        <tr>
            <td>
                <ul style="list-style: none; display: flex; align-items: center; justify-content: center; margin-top: 1rem">
                    <li style="margin: 5px">
                        <a href="{{$share_setting->facebook}}"  style="background-color: #05203d42;color: #05203D;padding: 6px;
                            border-radius: 50%;
                        ">
                            <i class="fab fa-facebook-f "></i>
                        </a>
                    </li>
                    <li style="margin: 5px">
                        <a href="{{$share_setting->twitter}}"  style="background-color: #05203d42;color: #05203D;padding: 6px;
                            border-radius: 50%;
                        ">
                                <i class="fab fa-twitter "></i>
                            </a>
                    </li>
                    <li style="margin: 5px">
                        <a href="{{$share_setting->linkedin}}"  style="background-color: #05203d42;color: #05203D;padding: 6px;
                            border-radius: 50%;">
                            <i class="fab fa-linkedin-in ">
                                </i>
                            </a>
                    </li>
                    <li style="margin: 5px">
                        <a href="{{$share_setting->youtube}}"  style="background-color: #05203d42;color: #05203D;padding: 6px;
                            border-radius: 50%;
                        ">
                                <i class="fab fa-youtube ">
                                </a>
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <a href=""><img src="{{asset('images/en_badge_web_generic.png')}}" width="120px" alt=""></a>
                <a href=""><img src="{{asset('images/fff.png')}}" width="120px" alt=""></a>
            </td>
        </tr>
    </tbody>
</table>
</body>

</html>
