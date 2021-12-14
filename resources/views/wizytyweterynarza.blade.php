@extends('layouts/appadmin')

@section('content')

<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/wizyty') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">


      <!-- Wizyty weterynarza -->
      <?php
      $idvet = $_GET['id_vet'];
      $visits = DB::table('visit')->where('id_vet', $idvet)->orderBy('date', 'desc')->get();
      $vets = DB::table('vet')->where('id_vet', $idvet)->get();


      ?>
      <div class="card">
        <div class="card-header">

          <h5>Wizyty weterynarza</h5>
          <?php
          foreach ($visits as $visit) {
          }
          foreach ($vets as $vet) {
          }
          echo $vet->name, ' ', $vet->surname;

          ?>
        </div>
        <div class="card-body">
          <table class="table table-striped  table-sm">


            <thead>
              <tr>

                <th scope="col">Klient</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Typ wizyty</th>
                <th scope="col">Zarezerwowana</th>
                <th scope="col">Potwierdzona</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($visits as $visit) {
              ?>
                <tr>


                  <td>
                    <?php
                    $owners = DB::table('owner')->where('id_owner', $visit->id_owner)->get();
                    $ownercontrol =0;
                    foreach($owners as $owner){
                      $ownercontrol = 1;
                    echo $owner->name, ' ', $owner->surname ;
                    }
                    if($ownercontrol == 0 ) echo 'Wizyta niezerezerwowana';

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
                    echo $visit->id_type;
                    ?>
                  </td>

                  <td>
                    <?php if ($visit->reservation == NULL)
                      echo "NIE";
                      else echo "TAK";
                    ?>
                  </td>
                  <td>

                    <?php if ($visit->confirmation == NULL)
                      echo "NIE";
                    else echo "TAK";
                    ?>

                  </td>
                <?php } ?>
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