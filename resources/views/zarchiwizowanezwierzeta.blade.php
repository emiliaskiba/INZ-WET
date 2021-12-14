@extends('layouts/appclient')

@section('content')

<?php
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
    <a href="{{ url('/zwierzetaklienta') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">


      <!-- Wizyty weterynarza -->
      <?php

      $animals = DB::table('animal')->where('archive', 1)->where('id_owner', $idowner)->get();
      $control = 0;

      ?>


      <div class="card">
        <div class="card-header">

          <h5>Zarchiwizowane zwierzęta</h5>
        </div>

        <div class="card-body">
          <div class="row">
            <?php
            foreach ($animals as $animal) {
              $control = $control + 1;
            ?>




              <div class="col-4 ">


                <table class="table table-striped table-bordered  ">
                  <tr>
                    <td colspan="2">
                      <img src="https://bahmansport.com/media/com_store/images/empty.png" class="img-fluid" alt="Responsive image">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Imię</b>
                    </td>
                    <td>
                      <?php echo  $animal->name ?><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Gatunek</b>
                    </td>
                    <td>
                      <?php echo $animal->species ?> <br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b> Rasa</b>
                    </td>
                    <td>
                      <?php echo $animal->breed ?><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Płeć</b>
                    </td>
                    <td>
                      <?php echo  $animal->sex ?><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b> Data urodzenia</b>
                    </td>
                    <td>
                      <?php echo  $animal->date_of_birth ?><br>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <form action="/odarchiwizujzwierze" method="POST">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="id_animal" value="<?php echo $animal->id_animal ?>">
                        <button type="submit" value="Odarchiwizuj zwierze" class="btn text-white">Przywróć zwierzę </button>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <button class="btn text-white ">Zobacz historię leczenia</button>
                    </td>
                  </tr>
                </table>




              </div>
            <?php } ?>
          </div>
        </div>




        <?php
        if ($control == 0) {
          echo "Nie zarchiwizowałeś/aś żadnych zwierząt.";
        }
        ?>
        <br/>
        <br/>


      </div>


    </div>
    <!-- koniec rzędu -->
  </div>


</div>


@endsection