<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .wrapper {
            border: 2px solid #000;
            overflow: hidden;
        }

        .wrapper div {
            min-height: 200px;
            padding: 10px;
        }

        #one {
            background-color: gray;
            float: left;
            margin-right: 20px;
            width: 140px;
            border-right: 2px solid #000;
        }

        #two {
            background-color: white;
            overflow: hidden;
            margin: 10px;
            border: 2px dashed #ccc;
            min-height: 170px;
        }

        @media screen and (max-width: 400px) {
            #one {
                float: none;
                margin-right: 0;
                width: auto;
                border: 0;
                border-bottom: 2px solid #000;
            }
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <div id="one">one</div>
        <div id="two">two</div>
    </div>

</body>

</html>
