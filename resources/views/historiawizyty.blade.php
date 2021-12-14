@extends('layouts/appclient')

@section('content')

<?php
$id = Auth::user()->id;
$owners = DB::table('owner')->where('id_user', $id)->get();
foreach ($owners as $owner) {
  $idowner = $owner->id_owner;
}
?>
<?php
$id_visit = $_GET['id_visit'];
?>




<div class="container">


<div class="row mb-5">
    <a href="{{ url()->previous() }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">


      <?php

      /////////

      ////////

      ?>
      <?php
      $visits = DB::table('visit')->where('id_visit', $id_visit)->get();
      foreach ($visits as $visit) {
      };
      $animals = DB::table('animal')->where('id_animal', $visit->id_animal)->get();
      foreach ($animals as $animal) {
      };
      ?>

      <div class="card">
        <div class="card-header">

          <h5> Szczegóły wizyty </h5>
        </div>

        <div class="card-body">
          <div class="row">

            <div class="col ">


              <table class="table table-striped table-bordered  ">

                <tr>
                  <td>
                    <b> Data wizyty</b>
                  </td>
                  <td>

                    <?php echo  $visit->date ?><br>
                  </td>
                </tr>
                <tr>
                  <td>
                    <b>Godzina wizyty</b>
                  </td>
                  <td>

                    <?php echo  $visit->time ?><br>
                  </td>
                </tr>
                <tr>
                  <td>
                    <b>Weterynarz</b>
                  </td>
                  <td>
                    <?php
                    $vets = DB::table('vet')->where('id_vet', $visit->id_vet)->get();
                    foreach ($vets as $vet) {
                      echo $vet->name, ' ', $vet->surname;
                    } ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    <b> Typ wizyty</b>
                  </td>
                  <td>
                    <?php
                    $visittypes = DB::table('visit_type')->where('id_visit_type', $visit->id_type)->get();
                    foreach ($visittypes as $visittype) {
                      echo $visittype->name;
                    } ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Opis wizyty</b>
                  </td>
                  </tr>
                  <tr>
                  <td colspan="2">

                    <?php
                    $historycontrol = 0;
                    $history = DB::table('history')->where('id_visit', $visit->id_visit)->get();
                    foreach ($history as $visithistory) {
                      $historycontrol = 1;
                    ?>
                      <?php echo $visithistory->description; ?>
                    <?php }
                    if ($historycontrol == 0) {
                      echo "Brak";
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Zalecenia lekarza</b>
                  </td>
                  </tr>
                  <tr>
                  <td colspan="2">
                    <?php
                    $historycontrol = 0;
                    $history = DB::table('history')->where('id_visit', $visit->id_visit)->get();
                    foreach ($history as $visithistory) {
                      $historycontrol = 1;
                    
                    ?>
                      <?php echo $visithistory->orders;}

                      if ($historycontrol == 0) {
                        echo "Brak";
                      }
                      ?>
                </tr>

                <tr>
                  <td colspan="2">
<?php
                  $history = DB::table('history')->where('id_visit', $visit->id_visit)->get();
                    foreach ($history as $visithistory) {
                      $historycontrol = 1;
                      ?>
                    <?php $prescriptions = DB::table('prescription')->where('id_prescription', $visithistory->id_prescription)->get();
                      foreach ($prescriptions as $prescription) {
                        $items = DB::table('item')->where('id_prescription', $prescription->id_prescription)->get();
                    ?>


                      <button class="btn text-white" onclick="alert('<?php echo 'Kod recepty: ', $prescription->code, '\n', 'Kod do odebrania recepty: ', $prescription->access_code, '\n\n', 'Pozycje: \n';
                                                                      foreach ($items as $item) {
                                                                        echo $item->medicament;
                                                                        if ($item->dose != NULL) {
                                                                          echo ', Dawka: ', $item->dose;
                                                                        }
                                                                        echo '\n';
                                                                      }
                                                                      ?>')">Recepta</button>
                  <?Php
                      }
                    } ?>
                  </td>
                </tr>



              </table>




            </div>

          </div>
        </div>

      </div>
    </div>


  </div>


</div>
<!-- koniec rzędu -->



@endsection