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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <a class="navbar-brand" href="/home">Navbar</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                      </li>
              
                        
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">Login</a>
                      </li>
                  


                   
                      <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>




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