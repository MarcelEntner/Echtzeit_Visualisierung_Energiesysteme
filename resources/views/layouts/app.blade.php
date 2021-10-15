<html lang="en">
<head>

   

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">



    <title>MicroGridLab - @yield('title')</title>
    <!-- yield Platzhalter -->      
</head>

<body>
    

    <!-- section Bereich -->      
    @section('sidebar')
        This is the master sidebar.
    @show
    <!-- anzeigen auch wenn es von einer anderen Seite überschrieben wird -->      


    <div class="container">
        @yield('content')
        <!-- ganzer Content Platzhalter -->      
    </div>

</body>

</html>