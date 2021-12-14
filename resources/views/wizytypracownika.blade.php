@extends('layouts/appemployee')

@section('content')
<?php
$id = Auth::user()->id;
$vet = Auth::user()->Id_vet;
$mytime = Carbon\Carbon::now();
$tomorrow = Carbon\Carbon::now()->addDay();

?>
<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/home') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">

<!-- DZISIAJ WIZYTY -->

      <div class="card">
        <div class="card-header">
          <h5>Twoje wizyty <br />DZISIAJ
            <?php echo $mytime->toDateString(); ?>
          </h5>
        </div>
        <div class="card-body">
          <table class="table table-striped  table-sm">
            <?php
            $visits = DB::table('visit')->where('id_vet', $vet)->where('confirmation', 1)->where('date', $mytime->toDateString())->orderBy('date', 'asc')->get();

            ?>

            <thead>
              <tr>


                <th scope="col">Klient</th>
                <th scope="col">Zwierze</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Typ wizyty</th>
                <th scope="col">Wiadomość</th>
                <th scope="col">Szczegóły</th>
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
                    foreach ($owners as $owner) {
                      echo $owner->name, ' ', $owner->surname;
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    $animals = DB::table('animal')->where('id_animal', $visit->id_animal)->get();
                    foreach ($animals as $animal) {
                    ?> <button class="btn text-white" onclick="alert('<?php echo 'Imię: ', $animal->name, '\n', 'Gatunek: ', $animal->species, '\n', 'Rasa: ', $animal->breed, '\n', 'Płeć: ', $animal->sex, '\n', 'Data urodzenia: ', $animal->date_of_birth; ?>')">Wyświetl</button>
                    <?php
                    }
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
                    if ($visit->id_type == 1)
                      echo 'Wizyta kontrolna';
                    if ($visit->id_type == 2)
                      echo 'Badanie';
                    if ($visit->id_type == 3)
                      echo 'Zabieg';
                    ?>
                  </td>
                  <td>
                    <button class="btn text-white" onclick="alert('<?php echo $visit->message; ?>')">Wyświetl</button>
                  </td>
                  <td>
                    <form action="/wizytaedycja" method="get">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                      <button type="submit" value="Uzupełnij wizytę" class="btn text-white">Uzupełnij </button>
                    </form>
                  </td>
                <?php } ?>
            </tbody>
          </table>
        </div>

      </div>
      </br>
<!-- wizyty jutro -->
      <div class="card">
        <div class="card-header">
          <h5>Twoje wizyty <br />JUTRO
            <?php echo $tomorrow->toDateString(); ?>
          </h5>
        </div>
        <div class="card-body">
          <table class="table table-striped  table-sm">
            <?php
            $visits = DB::table('visit')->where('id_vet', $vet)->where('confirmation', 1)->where('date', $tomorrow->toDateString())->orderBy('date', 'asc')->get();

            ?>

            <thead>
              <tr>


                <th scope="col">Klient</th>
                <th scope="col">Zwierze</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Typ wizyty</th>
                <th scope="col">Wiadomość</th>
                <th scope="col">Szczegóły</th>
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
                    foreach ($owners as $owner) {
                      echo $owner->name, ' ', $owner->surname;
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    $animals = DB::table('animal')->where('id_animal', $visit->id_animal)->get();
                    foreach ($animals as $animal) {
                    ?> <button class="btn text-white" onclick="alert('<?php echo 'Imię: ', $animal->name, '\n', 'Gatunek: ', $animal->species, '\n', 'Rasa: ', $animal->breed, '\n', 'Płeć: ', $animal->sex, '\n', 'Data urodzenia: ', $animal->date_of_birth; ?>')">Wyświetl</button>
                    <?php
                    }
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
                    if ($visit->id_type == 1)
                      echo 'Wizyta kontrolna';
                    if ($visit->id_type == 2)
                      echo 'Badanie';
                    if ($visit->id_type == 3)
                      echo 'Zabieg';
                    ?>
                  </td>
                  <td>
                    <button class="btn text-white" onclick="alert('<?php echo $visit->message; ?>')">Wyświetl</button>
                  </td>
                  <td>
                    <form action="/wizytaedycja" method="get">
                      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                      <button type="submit" value="Uzupełnij wizytę" class="btn text-white">Uzupełnij </button>
                    </form>
                  </td>
                <?php } ?>
            </tbody>
          </table>
        </div>

      </div>

      

      <!-- Wizyty w przyszłym tygodniu -->

      <div class="card mt-4">
        <div class="card-header">
          <h5>Twoje dalsze wizyty
          </h5>
        </div>
        <div class="card-body">
          <table class="table table-striped  table-sm">
            <?php
            $visits = DB::table('visit')->where('id_vet', $vet)->where('confirmation', 1)->where('date','>', $tomorrow->toDateString())->get();

            ?>

            <thead>
              <tr>


                <th scope="col">Klient</th>
                <th scope="col">Zwierze</th>
                <th scope="col">Data</th>
                <th scope="col">Godzina</th>
                <th scope="col">Typ wizyty</th>
                <th scope="col">Wiadomość</th>
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
                    foreach ($owners as $owner) {
                      echo $owner->name, ' ', $owner->surname;
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    $animals = DB::table('animal')->where('id_animal', $visit->id_animal)->get();
                    foreach ($animals as $animal) {
                    ?> <button class="btn text-white" onclick="alert('<?php echo 'Imię: ', $animal->name, '\n', 'Gatunek: ', $animal->species, '\n', 'Rasa: ', $animal->breed, '\n', 'Płeć: ', $animal->sex, '\n', 'Data urodzenia: ', $animal->date_of_birth; ?>')">Wyświetl</button>
                    <?php
                    }
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
                    if ($visit->id_type == 1)
                      echo 'Wizyta kontrolna';
                    if ($visit->id_type == 2)
                      echo 'Badanie';
                    if ($visit->id_type == 3)
                      echo 'Zabieg';
                    ?>
                  </td>
                  <td>
                    <button class="btn text-white" onclick="alert('<?php echo $visit->message; ?>')">Wyświetl</button>
                  </td>
                  <td>

                  </td>
                <?php } ?>
            </tbody>
          </table>
        </div>

      </div>
      <!-- Wizyty wszystkie -->



    </div>
    <!-- koniec rzędu -->


    <!-- Dodawanie wizyt -->

  </div>



</div>
</div>

@endsection