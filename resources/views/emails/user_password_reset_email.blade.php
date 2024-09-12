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
            .btn {
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
        <h3>Hello</h3>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <a class="btn" href={{"https://whizdeals.ca/reset-password/".$token}}>Reset Password</a>
        <p>This password reset link will expire in 60 minutes.</p>
        <p>If you did not request a password reset, no further action is required.</p>
        <p>Regards,</p>
        <p>WhizDeals</p>
        <hr/>
        <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href={{"https://whizdeals.ca/reset-password/".$token}}>https://whizdeals.ca/reset-password/{{$token}}</a></p>
    </body>
</html>