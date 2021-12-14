@extends('layouts/appclient')

@section('content')

<?php
$mytime = Carbon\Carbon::now();
//$mytime->toDateString()
?>
<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/home') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row justify-content-center ">

    <div class="col text-center ">

      <?php
      $visits = DB::table('visit')->get();
      $vets = DB::table('vet')->where('archive', null)->get();


      ?>
      <div class="card text-center">
        <div class="card-header">

          <h5>Zarezerwuj wizytę</h5>
          <?php
          foreach ($visits as $visit) {
          }

          ?>
        </div>

        <div class=" card-body text-center mx-auto ">


          <form action="/rezerwacja" method="get" class="form-group mx-auto">
            <div class=" mx-auto">






              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <label for="dateform" class ="mr-2">Data:</label>

              <input type="date" id="dateform" name="dateform" value="<?php echo $mytime->toDateString() ?>" min="<?php echo $mytime->toDateString() ?>">
<br/>
              <label for="vetform" class ="mr-1">Weterynarz: </label>

              <select id="vetform" name="vetform">
                <?php foreach ($vets as $vet) {
                ?>
                  <option value="<?php echo $vet->id_vet ?>"><?php echo $vet->name, ' ', $vet->surname ?></option>


                <?php  }  ?>
              </select>
<br/>
              <button class="btn text-white" type="submit" value="Pokaż wizyty" >Wybierz</button>



            </div>

          </form>


          <?php

          ?>


        </div>


      </div>



    </div>
    <!-- koniec rzędu -->
  </div>




  @endsection