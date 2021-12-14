@extends('layouts/appclient')

@section('content')

<?php
$mytime = Carbon\Carbon::now();
$id = Auth::user()->id;
$owners = DB::table('owner')->where('id_user', $id)->get();

foreach ($owners as $owner) {
  $idowner = $owner->id_owner;
}
?>


@if(session()->has('message'))
<div class=" text-center alert alert-danger mt-1 mb-2">
  {{ session()->get('message') }}
</div>
 @endif

<div class="container">

  <div class="row mb-3">
    <a href="{{ url('/home') }}" class="btn text-white mt-2">WRÓĆ</a></br>

  </div>


  <div class="row">

    <div class="col text-center ">


      <!-- Wizyty weterynarza -->
      <?php

      $visits = DB::table('visit')->where('id_owner', $idowner)->where('date', '>=', $mytime->toDateString())->orderBy('date', 'asc')->get();


      ?>

      <div class=" mb-3">
        <?php
        echo  "Dzisiaj jest: ", $mytime->toDateString();
        ?>
      </div>
      <div class="card">
        <div class="card-header">

          <h5>Twoje nadchodzące wizyty</h5>
          <?php
          foreach ($visits as $visit) {
          }
         
          ?>
        </div>
        <div class="card-body">
          <table class="table table-striped  table-sm">


            <thead>
              <tr>

                <th scope="col">Twoje zwierze</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Typ wizyty</th>
                <th scope="col">Twoja wiadomość</th>
                <th scope="col">Potwierdzona</th>
                <th scope="col">Szczegóły</th>
                <th scope="col">Edytuj</th>
                <th scope="col">Odwołaj</th>
                
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($visits as $visit) {
                $idanimal = $visit->id_animal;
                $animals = DB::table('animal')->where('id_animal', $idanimal)->get();
                foreach ($animals as $animal) {
              ?>
                  <tr>


                    <td>
                      <?php
                      echo $animal->name;
                      ?>
                    </td>
                    <td>
                      <?php
                      echo $visit->date;
                      ?>
                    </td>
                    <td>
                      <?php
                      echo $visit->time;
                      ?>
                    </td>
                    <td>
                      <?php
                      $idtype = $visit->id_type;
                      $visittypes = DB::table('visit_type')->where('id_visit_type', $idtype)->get();
                      foreach ($visittypes as $visittype) {

                        echo $visittype->name;
                      }
                      ?>
                    </td>

                    <td>

                    <button class="btn w-70 text-white" onclick="alert('<?php echo $visit->message; ?>')">Wyświetl</button>
                 
                    </td>
                    
                    <td>

                      <?php if ($visit->confirmation == NULL)
                        echo "NIE";
                      else echo "TAK";
                      ?>

                    </td>
                    <td>
                      
                    <form action="/historiawizyty" method="get" class="form-group" >
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                          <button type="submit" value="historia wizyty" class="btn text-white">Pokaż</button>
                        </form>
                    </td>
                    <td>
                      <?php
                    if ($visit->confirmation == NULL){
?>
  <form action="/edytujwizyteklient" method="get" class="form-group" >
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                          <button type="submit" value="edytuj wizyte klient" class="btn text-white"> Edytuj</button>
                        </form>
<?php
                    }
                    else echo "Brak możliwości edycji", '<br/>', " wizyta potwierdzona"
?>
                    </td>
                    <td>

                    <form action="/odwolajwizyteklient" method="post" class="form-group" >
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                          <button type="submit" value="odwolaj wizyte klient" class="btn text-white w-50 mx-auto"> X</button>
                        </form>

                    </td>
                <?php }
              } ?>
            </tbody>
          </table>
          <a href="{{ url('/wszystkiewizytyklienta') }}" class="btn w-50 text-white mt-2">Historia Twoich wizyt</a></br>
          <a href="{{ url('/rezerwacjaform') }}" class="btn w-50 text-white mt-2">Zarezerwuj nową wizytę</a></br>

        </div>
      </div>


    </div>
    <!-- koniec rzędu -->
  </div>


</div>
</div>

</div>
</div>

@endsection