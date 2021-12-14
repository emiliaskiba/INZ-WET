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

<div class="container">

  <div class="row mb-3">
    <a href="{{ url('/wizytyklienta') }}" class="btn text-white mt-2">WRÓĆ</a></br>

  </div>


  <div class="row">

    <div class="col text-center ">


      <!-- Wizyty weterynarza -->
      <?php

      $visits = DB::table('visit')->where('id_owner', $idowner)->where('date', '<', $mytime->toDateString())->orderBy('date', 'asc')->get();


      ?>

     
      <div class="card">
        <div class="card-header">

          <h5>Historia wizyt</h5>
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
                <th scope="col">Szczegóły</th>
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

                    <form action="/historiawizyty" method="get" class="form-group" style="width:70%; margin-left:15%;">
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                          <button type="submit" value="historia wizyty" class="btn text-white">Pokaż</button>
                        </form>

                    </td>
                <?php }
              } ?>
            </tbody>
          </table>


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