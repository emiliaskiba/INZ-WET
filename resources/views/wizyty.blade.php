@extends('layouts/appadmin')

@section('content')
<?php
$mytime = Carbon\Carbon::now();
$tomorrow = Carbon\Carbon::now()->addDay();
?>
<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/home') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">

      <!-- wizyty do zatwierdzenia dzisiaj -->
      <div class="card">
        <div class="card-header">
          <h5>Wizyty do zatwierdzenia DZISIAJ </h5>
        </div>
        <div class="card-body">
          <table class="table table-striped  table-sm">
            <?php
            $visits = DB::table('visit')->where('date', $mytime->toDateString())->where('reservation', 1)->where('confirmation', NULL)->orderBy('date', 'asc')->join('owner', 'visit.id_owner', '=', 'owner.id_owner')->get();
            $vets = DB::table('vet')->where('archive', null)->get();

            ?>

            <thead>
              <tr>

                <th scope="col">Id wizyty </th>
                <th scope="col">Weterynarz </th>
                <th scope="col">Klient</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Typ wizyty</th>
                <th scope="col">Potwierdź</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($visits as $visit) {
              ?>
                <tr>
                  <td>
                    <?php
                    echo $visit->id_visit; ?>
                  </td>
                  <td>
                    <?php
                    $vets = DB::table('vet')->where('id_vet', $visit->id_vet)->get();
                    foreach($vets as $vet){
                    echo $vet->name, ' ', $vet->surname;
                    }

                    ?>
                  </td>

                  <td>
                    <?php
                    echo $visit->name, ' ';
                    echo $visit->surname;
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
                    <form action="/confirmvisit" method="post" class="form-group" style="width:70%; margin-left:15%;">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                      <button type="submit" value="Zatwierdź" class="btn text-white">Zatwierdź</button>
                    </form>

                  <?php } ?>
            </tbody>
          </table>
        </div>

      </div>



      <!-- Wizyty do zatwierdzenia -->

      <div class="card mt-4">
        <div class="card-header">
          <h5>Wizyty do zatwierdzenia</h5>
        </div>
        <div class="card-body">
          <table class="table table-striped  table-sm">
            <?php
            $visits = DB::table('visit')->where('reservation', 1)->where('confirmation', NULL)->orderBy('date', 'asc')->join('owner', 'visit.id_owner', '=', 'owner.id_owner')->get();
            $vets = DB::table('vet')->get()->where('archive', null);

            ?>

            <thead>
              <tr>

                <th scope="col">Id wizyty </th>
                <th scope="col">Weterynarz </th>
                <th scope="col">Klient</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Typ wizyty</th>
                <th scope="col">Potwierdź</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($visits as $visit) {
              ?>
                <tr>
                  <td>
                    <?php
                    echo $visit->id_visit; ?>
                  </td>
                  <td>
                    <?php
                    $vets = DB::table('vet')->where('id_vet', $visit->id_vet)->get();
                    foreach($vets as $vet){
                    echo $vet->name, ' ', $vet->surname;
                    }
                    ?>
                  </td>

                  <td>
                    <?php
                    echo $visit->name, ' ', $visit->surname;
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
                    <form action="/confirmvisit" method="post" class="form-group" style="width:70%; margin-left:15%;">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                      <button type="submit" value="Zatwierdź" class="btn text-white">Zatwierdź</button>
                    </form>

                  <?php } ?>
            </tbody>
          </table>
        </div>

      </div>
      <!-- Wizyty wszystkie -->

      <div class="col text-center mt-3 ">


      </div>

      <!-- koniec rzędu -->


      <!-- Dodawanie wizyt -->

    </div>


    <div class="col text-center">

      <div class="card">
        <div class="card-header">
          <h5>Dodaj wizytę</h5>
        </div>

        <div class="card-body">
          <form action="/createvisit" method="post" class="form-group" style="width:70%; margin-left:15%;">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <?php
            //$vets = DB::table('vet') -> get();
            ?>
            <!--weterynarz-->

            <label for="id_vet">Weterynarz: </label></br>
            <select id="id_vet" name="id_vet">
              <?php foreach ($vets as $vet) {
              ?>
                <option value="<?php echo $vet->id_vet ?>"><?php echo $vet->name, ' ', $vet->surname ?></option>


              <?php  }  ?>
            </select>

            <!--weterynarz koniec-->

            <hr>
            <!--typ wizyty-->
            <label>Typ wizyty:</label> <br>
            <input type="radio" id="1" name="id_type" value="1">
            <label for="1">Wizyta kontrolna</label><br>
            <input type="radio" id="2" name="id_type" value="2">
            <label for="2">Wizyta kontrolna + badanie</label><br>
            <input type="radio" id="3" name="id_type" value="3">
            <label for="3">Zabieg</label> <br />
            <hr>
            <!--typ wizyty koniec-->

            <label>Data:</label>
            <input type="date" class="form-control" name="date">


            <label for="time">Godzina: </label></br>
            <select id="time" name="time">
              <option value="10.00">10.00</option>
              <option value="10.30">10.30</option>
              <option value="11.00">11.00</option>
              <option value="11.30">11.30</option>
              <option value="12.00">12.00</option>
              <option value="12.30">12.30</option>
              <option value="13.00">13.00</option>
              <option value="13.30">13.30</option>
              <option value="14.00">14.00</option>
              <option value="14.30">14.30</option>
              <option value="15.00">15.00</option>
              <option value="15.30">15.30</option>
              <option value="16.00">16.00</option>
              <option value="16.30">16.30</option>
              <option value="17.00">17.00</option>
              <option value="17.30">17.30</option>
            </select>


            <br>
            <button type="submit" value="Dodaj wizytę" class="btn btn-primary mt-2">Dodaj wizytę</button>


          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-header">
          <h5>Wizyty weterynarza</h5>
        </div>
        <div class="card-body">

          <form action="/wizytyweterynarza" method="get" class="form-group" style="width:70%; margin-left:15%;">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label for="id_vet">Weterynarz: </label></br>
            <select id="id_vet" name="id_vet">
              <?php foreach ($vets as $vet) {
              ?>
                <option value="<?php echo $vet->id_vet ?>"><?php echo $vet->name, ' ', $vet->surname ?></option>


              <?php  }  ?>
            </select>
            <br />


            <button type="submit" value="Pokaż wizyty weterynarza" class="btn text-white mt-2">Pokaż</button>
          </form>


          <table class="table table-striped  table-sm">



          </table>
        </div>
      </div>

    </div>
  </div>

</div>
</div>

@endsection