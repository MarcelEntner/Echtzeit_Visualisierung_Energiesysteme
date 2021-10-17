<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only  Bootstrape-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title> <!-- Platzhalter für den Title , Title steht in der Variable title-->
</head>
<body>
    @section('header')

        <div class="w-100" style="background-color:red">
            <h1>Header</h1>
        </div>
    
    @show
    

    
    @section('content')
    <div class="w-100" style="background-color:green">
        <h1>Content</h1>
   </div>

    @show



   @section('footer')

    <div class="w-100" style="background-color:blue">
         <h1>Footer</h1>
    </div>

   @show


    
    <!-- JavaScript Bundle with Popper Bootstrap -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>