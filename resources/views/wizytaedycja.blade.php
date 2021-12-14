@extends('layouts/appemployee')

@section('content')

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
      }

      $animals = DB::table('animal')->where('id_animal', $visit->id_animal)->get();
      foreach ($animals as $animal) {
      };
      ?>

      <div class="card">
        <div class="card-header">

          <h5> Uzupełnij wizytę </h5>
        </div>

        <div class="card-body">
          <div class="row">

            <div class="col ">

              <form action="/uzupelnijwizyte" method="POST" class="form-group" style="width:70%; margin-left:15%;">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">


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
                      <b>Klient</b>
                    </td>
                    <td>
                      <?php $owners = DB::table('owner')->where('id_owner', $visit->id_owner)->get();
                      foreach ($owners as $owner) {
                        echo $owner->name, ' ', $owner->surname;
                      } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Zwierzę</b>
                    </td>
                    <td>
                      <?php
                      $animals = DB::table('animal')->where('id_animal', $visit->id_animal)->get();
                      foreach ($animals as $animal) {
                      ?> <table class=" table-bordered mx-auto ">
                          <tr>
                            <td><b> Imię </b></td>
                            <td><?php echo $animal->name; ?> </td>
                          </tr>
                          <tr>
                            <td><b>Gatunek </b></td>
                            <td> <?php echo $animal->species; ?> </td>
                          </tr>
                          <tr>
                            <td><b> Rasa</b> </td>
                            <td> <?php echo $animal->breed; ?> </td>
                          </tr>
                          <tr>
                            <td><b>Płeć</b></td>
                            <td> <?php echo $animal->sex; ?></td>
                          </tr>
                          <tr>
                            <td><b>Data urodzenia</b></td>
                            <td><?php echo $animal->date_of_birth; ?></td>
                          </tr>
                        </table>
                      <?php
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

                  <td colspan="2">
                    <b>Wiadomość od klienta</b>
                  </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <div class="card">
                        <?php echo $visit->message; ?>
                      </div>
                    </td>
                  </tr>


                </table>

                <table class="table  table-bordered">
                  <tr>
                    <td colspan="2" class="card-header">
                      <b>Informacje podczas wizyty</b>

                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">

                      <?php
                      $historycontrol = 0;
                      $history = DB::table('history')->where('id_visit', $visit->id_visit)->get();
                      foreach ($history as $visithistory) {
                        $historycontrol = 1;
                      }
                      ?>
                      <b>Opis wizyty</b>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <textarea rows="6" cols="100" class="form-control" name="description"><?php if ($historycontrol = 1) foreach ($history as $visithistory) {
                                                                                              echo $visithistory->description;
                                                                                            } ?></textarea><br>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <b>Zalecenia</b>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <textarea rows="6" cols="100" class="form-control" name="orders"><?php if ($historycontrol = 1) foreach ($history as $visithistory) {
                                                                                          echo $visithistory->orders;
                                                                                        } ?></textarea><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Cena</b>
                    </td>
                    <td>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">

                        </div>
                      
                        <input type="text" name="price" class="form-control" value ="<?php if ($visit->price != NULL) echo $visit->price; ?>"
                        aria-label="Amount">
                        <div class="input-group-append">
                          <span class="input-group-text">ZŁ</span>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <b>Kod dostępu do recepty</b>
                    </td>
                    <td>
                      <input type="text" name="access_code" class="form-control" value =" <?php if ($historycontrol = 1) foreach ($history as $visithistory) {
                                                                                          $prescriptions = DB::table('prescription')->where('id_prescription', $visithistory->id_prescription)->get();
                                                                                          foreach ($prescriptions as $prescription) { echo $prescription->access_code; } } ?>">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Kod recepty</b>
                    </td>
                    <td>
                      <input type="text" name="code" class="form-control" value =" <?php if ($historycontrol = 1) foreach ($history as $visithistory) {
                                                                                          $prescriptions = DB::table('prescription')->where('id_prescription', $visithistory->id_prescription)->get();
                                                                                          foreach ($prescriptions as $prescription) { echo $prescription->code; } } ?>">
                    </td>
                  </tr>
                </table>

                <button type="submit" value="Uzupełnij" class="btn btn-primary mt-2">Zapisz</button>
              </form>



            </div>

          </div>
        </div>

      </div>
    </div>


  </div>

</div>
<!-- koniec rzędu -->



@endsection