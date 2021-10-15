@extends('layouts.app')



@section('title', 'Home')


@section('sidebar')
    @parent <!-- nur hinzufügen nicht überschreiben -->
    <p> This is appended to the master sidebar.</p>
@endsection

@section('content')
    <!-- image    <h1> MicroGridLab </h1> -->
 
    <header>
        <img src="/images/logo.png">

        <h1 id="hallo"> MicroGridLab </h1>
        <a> Home </a>
        <a> Energiesysteme </a>
        <a> Galerie </a>
        <a> Log In </a>  
    </header>

   
@endsection


	