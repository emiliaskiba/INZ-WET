@extends('layouts/appclient')

@section('content')

<?php
$id_owner = $_GET['id_owner'];
$owners = DB::table('owner')->where('id_owner', $id_owner)->get();
foreach ($owners as $owner) {

?>

@if(session()->has('message'))
<div class=" text-center alert alert-danger mt-1 mb-2">
  {{ session()->get('message') }}
</div>
 @endif



<div class="container">

 <div class="row mb-5">
    <a href="{{ url('/klienci') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">


      <!-- Wizyty weterynarza -->
      <?php

      $animals = DB::table('animal')->where('archive', 0)->where('id_owner', $id_owner)->get();
      $control = 0;

      ?>


      <div class="card">
        <div class="card-header">

          <h5>Zwierzęta klienta <?php echo $owner->name,' ', $owner->surname;?></h5>
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
                      <form action="/edycjazwierze" method="get">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="id_animal" value="<?php echo $animal->id_animal ?>">
                        <button type="submit" value="Edytuj zwierze" class="btn text-white">Edytuj </button>
                      </form>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                    <form action="/historialeczenia" method="get">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="id_animal" value="<?php echo $animal->id_animal ?>">
                        <button type="submit" value="historia leczenia zwierze" class="btn text-white">Historia leczenia </button>
                      </form>
                    </td>
                  </tr>

                 
                </table>




              </div>
            <?php } ?>
          </div>
        </div>

      </div>
    </div>


    <?php
    if ($control == 0) {
      echo "Klient nie ma dodanych żadnych zwierząt.";
    }
    ?>


    <a href="{{ url('/dodaniezwierze') }}" class="btn text-white mt-2">Dodaj nowe zwierze</a></br>
    <a href="{{ url('/zarchiwizowanezwierzeta') }}" class="btn text-white mt-2">Twoje zarchiwizowane zwierzęta</a></br>


  </div>


</div>
<!-- koniec rzędu -->
</div>


</div>
<?php }
?>

@endsection