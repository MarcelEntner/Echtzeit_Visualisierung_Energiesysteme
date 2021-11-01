@extends('layouts.layout')
@section('title','Energiesysteme')
@section('head')
@endsection
@section('content')


<div class="Energiesysteme">

    <div class="Karte" >

      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d21297.206605903528!2d15.1610548!3d48.145897399999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sde!2sat!4v1635412680266!5m2!1sde!2sat" 
      width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="GoogleMaps"></iframe>
    </div>


    <div class="Liste" >

      <h3 style="padding:5%"> <b>Energiesysteme </b></h3>
      <input type="search" id="suche" placeholder="Suche...">

      <!-- -->
      
      

      <table>
          <tr class="ListeHeader"> 
            <td> Bezeichnung </td>
            <td> Katastralgemeinde </td>
            <td> Postleitzahl </td>
            
          </tr>

                <!-- SQL Abfrage wieviele ES es gibt -> Schleife dementsprechend oft durchlaufen lassen-->
              <!-- for ()... -->

             

        
      </table>
      
      <button type="button" id="button">Add ES!</button>

    





    </div>

  

</div>


<script>
  // HTML-Button über JavaScript eine Funktion zuweisen
  
  // Funktion beim laden der Seite aufrufen
  window.addEventListener("load", function() {
  
   // Überprüfen ob die ID (Button) auf der Seite vorhanden ist (Optional).
   if (document.getElementById("button") != null) {
  
    // Der ID den Event-Handler 'click' hinzufügen,
    // als Event die Funktion 'test' aufrufen.
    document.getElementById("button").addEventListener("click", test);
   }
  });
  


  function test() {
 
  var MeinFenster = window.open("addes", "ES hinzufügen", "width=1000,height=400,left=100,top=300"); 
  
  MeinFenster.focus();
  }
  </script>
  




      
  
  @endsection
@section('foooter')