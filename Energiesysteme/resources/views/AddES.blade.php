

  <h1> ADD ES </h1>


  <form action="{{ route('EnSys.store') }}" method="POST">
    @csrf
    <label for="Bezeichnung">Bezeichnung</label>
    <input name="Bezeichnung">
    <br>
    <label for="Katastralgemeinden">Katastralgemeinden</label>
    <input name="Katastralgemeinden">
    <br>
    <label for="Postleitzahl">Postleitzahl</label>
    <input name="Postleitzahl">
    
    

<input type="submit" value="ES Erstellen">

    </form>

