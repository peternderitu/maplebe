<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Verify student email</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap");
            body {
                font-family: "Lato", sans-serif;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            a {
                padding: 10px 100px;
                background-color: #f81542;
                color: #fff!important;
                font-weight: 500;
                border: none;
                border-radius: 10px;
                text-decoration: none;
            }
            .otp {
                font-size: 24px;
                font-weight: 700;
                background-color: #d3d3d6;
                padding: 10px 20px;
                border-radius: 10px;
                letter-spacing: 3px;
            }
            h2 {
                margin: 0;
                color: #540202;
                font-weight: 800;
            }
        </style>
    </head>
    <body>
        <img src="{{ asset('images/mark_email_read.png') }}" alt="email" />
        <h3>Please verify your email</h3>
        <p>Confirm your student email using the otp value below to get amazing deals and offers!</p>
        <h2>OTP Code</h2>
        <p class="otp">{{$otpValue}}</p>
        <a href={{"https://whizdeals.ca/confirm-student-email/".$userId}}>Confirm student email</a>
        <p>This OTP code expires in 10 minutes</p>
    </body>
</html>