@extends('layouts/appclient')

@section('content')

<?php
$mytime = Carbon\Carbon::now();
$vetform = $_GET['vetform'];
$dateform = $_GET['dateform'];

//$mytime->toDateString()
?>
<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/rezerwacjaform') }}" class="btn text-white mt-2">Wróć</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">

      <?php
      $visits = DB::table('visit')->get();
      $vetformvets = DB::table('vet')->where('id_vet', $vetform)->get();
      foreach ($vetformvets as $vetformvet) {
      }

      ?>



      <div class="card">
        <div class="card-header">

          <h5>Wizyty dostępne w dniu: <?php echo $dateform ?><br /> u weterynarza: <?php echo $vetformvet->name, ' ', $vetformvet->surname ?> </h5>
          
        </div>
        <div class="card-body">
        <?php
          $control = 0;
          $visitsday = DB::table('visit')->where('reservation', NULL)->where('date', $dateform)->where('id_vet', $vetform)->orderBy('time', 'asc')->get();
          foreach ($visitsday as $visitday) {
            $control = $control+1;
            $idvet = $visitday->id_vet;
            $vets = DB::table('vet')->where('id_vet', $vetform)->get();

            foreach ($vets as $vet) { ?>
              <div class="card">
                <div class="card-body">
                  <?php
                  echo 'Weterynarz: ', $vet->name, ' ', $vet->surname, '<br/>';
                  echo 'Godzina: ', $visitday->time, '<br/>';
                  echo 'Data: ', $visitday->date, '<br/>';
                  $idtype = $visitday->id_type;
                  $visittypes = DB::table('visit_type')->where('id_visit_type', $idtype)->get();
                  foreach ($visittypes as $visittype) {
                    echo 'Typ wizyty: ', $visittype->name, '<br/>';
                  }

                  ?>
                  <br />
                  <form action="/rezerwacjautworz" method="get" class="form-group align-items-center">
                   <div class="form-row align-items-center">
                   <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                   <input type="hidden" name="idvisit" value="<?php echo $visitday->id_visit ?>">
                   <button type="submit" class ="btn btn-pink text-white w-50 mx-auto"value="Rezerwuj">Zarezerwuj</button>
                  </form>
                </div>
              </div>
          <?php
            }
          }
          if ($control == 0){
            echo 'Przykro nam, nie ma dostępnych wizyt u tego weterynarza w wybranym dniu.';
          }

          ?>
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