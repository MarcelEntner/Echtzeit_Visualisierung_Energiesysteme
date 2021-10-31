@extends('layouts.layout')
@section('title','Energiesysteme')
@section('head')
@endsection
@section('content')




<div class="dropdown">
    <button class="dropbtn">Wählen Sie ein Energiesystem aus</button>
    <div class="dropdown-content">
      <a href="#">MicroGridLab</a>
      <a href="#">Feuerwehr</a>
    </div>
  </div>


  <form action="{{ route('EtBs.store') }}" method="POST">
    @csrf
    <label for="Leistung">Leistung</label>
    <input name="Leistung">
    <br>
    <label for="Energie">Energie</label>
    <input name="Energie">
    <br>
    <label for="Speicherkap">Speicherkapazität</label>
    <input name="Speicherkap">

<input type="submit" value="ET Erstellen">

    </form>

    
    <table>
      <tr>
          <td>ID</td>
          <td>Leistung</td>
          <td>Energie</td>
          <td>Speichkap</td>
      </tr>
      @foreach ($data as $d)
      <tr>
          <td>{{ $d -> id }}</td>
          <td>{{ $d -> Leistung }}</td>
          <td>{{ $d -> Energie }}</td>
          <td>{{ $d -> Speicherkap }}</td>
      </tr>
          
      @endforeach
  </table>


@endsection
@section('foooter')