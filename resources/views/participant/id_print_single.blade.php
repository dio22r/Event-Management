<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KP4 - Amplop - Print Code </title>
    <style>
        .container {
            display: flex;
        }

        .warper-amplop {
            position: relative;
        }

        .qrcode-img {
            position: absolute;
            top: 270px;
            left: 118px;
            width: 115px;
        }

        .logo-img {
            position: absolute;
            width: 12px;
            transform: rotate(-90deg);
            top: 172px;
            left: 301px;
        }

        .amplop-label {
            position: absolute;
            bottom: 40px;
            font-size: 20px;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        .amplop-label-type {
            position: absolute;
            top: 90px;
            font-size: 20px;
            font-weight: bold;
            width: 100%;
            text-align: center;
            font-family: sans-serif;
        }

        .amplop-label-id {
            position: absolute;
            bottom: -4px;
            font-size: 10px;
            width: 100%;
            text-align: center;
            font-family: sans-serif;
        }

        .amplop-label-ket {
            position: absolute;
            bottom: 15px;
            font-size: 15px;
            width: 100%;
            text-align: center;
            font-family: sans-serif;
        }
    </style>
</head>

<body onload="window.print()">
    <!--  -->

    <div class="container" style="justify-content: {{ $align }}">
        <div class="warper-amplop">
            <img class="amplop-img" width="350px" src="{{ url("/assets/img/template-idcard/".$participant->mh_participant_type->template) }}" />
            <img class="qrcode-img" width="147px" src="{{ $qrcode->render(url("/idcard/".$participant->key)) }}" alt="QR Code" />
            <p class="amplop-label">{{ $participant->name }}</p>
            <?php if ($participant->mh_participant_type->id == 2) { ?>
                <p class="amplop-label-type">{{ strtoupper($participant->custom_title) }}</p>
            <?php } ?>
        </div>
    </div>

</body>

</html>
