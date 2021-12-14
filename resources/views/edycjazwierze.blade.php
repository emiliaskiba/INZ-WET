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

@if(session()->has('message'))
<div class=" text-center alert alert-danger mt-1 mb-2">
  {{ session()->get('message') }}
</div>
 @endif

 @if(session()->has('id_animal'))
 <?php $id_animal = session()->get('id_animal'); ?>
 
 @else

 <?php $id_animal = $_GET['id_animal'];
 ?>
 @endif
 
<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/zwierzetaklienta') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">


      <!-- Wizyty weterynarza -->
      <?php

      $animals = DB::table('animal')->where('id_animal', $id_animal)->get();

      ?>


      <div class="card">
        <div class="card-header">

          <h5>Edytuj informacje o zwierzęciu</h5>
        </div>

        <div class="card-body">
          <?php foreach ($animals as $animal) {
          ?>
            <form action="/updateanimal" method="post" class="form-group" style="width:70%; margin-left:15%;">
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
              <input type="hidden" name="id_owner" value="<?php echo $idowner; ?>">
              <input type="hidden" name="id_animal" value="<?php echo $id_animal; ?>">
              <table class="table table-sm table-bordered  ">
                <tr>
                  </td>
                  <td>
                    Imię:</td>
                  <td>
                    <input type="text" name="name" value="<?php echo $animal->name ?>" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td>Gatunek:</td>
                  <td>

                    <input type="text" name="species" value="<?php echo $animal->species ?>" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td>Rasa:</td>
                  <td>
                    <input type="text" name="breed" value="<?php echo $animal->breed ?>" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td>Płeć :</td>
                  <td>
                    <input type="radio" id="M" name="sex" value="M" <?php if ($animal->sex == 'M') {
                                                                      ?> checked
                                                                   <?php } ?>><label for="M">♂</label><br />
                    <input type="radio" id="F" name="sex" value="F"><label for="F" <?php if ($animal->sex == 'F') {?>
                                                                                      checked
                                                                                      <?php } ?>>♀</label>
                  </td>
                </tr>
                <tr>
                  <td>Data urodzenia:</td>
                  <td>
                    <input type="date" name="date_of_birth" max="<?php echo $mytime->toDateString() ?>" value="<?php echo $animal->date_of_birth ?> " class="form-control">

                  </td>
                </tr>
                <tr>
                  <td>Zdjęcie</td>
                  <td>
                    <input id="formFileSm" type="file" accept=".png, .jpg" />
                  </td>

                </tr>
                <tr>
                  <td colspan="2">
                    <button type="submit" value="Dodaj zwierzę" class="btn btn-primary">Edytuj</button>
                  </td>


                </tr>
              </table>
            </form>


            <table class=" mx-auto table table-sm table-bordered w-50 ">
              <tr>
                <td>
                  <form action="/usunzwierze" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id_animal" value="<?php echo $animal->id_animal ?>">
                    <button type="submit" value="Edytuj zwierze" class="btn text-white">Usuń zwierzę </button>
                  </form>
                </td>
                <td>
                  Usunięcie jest możliwe, jeżeli zwierzę nie odbyło żadnej wizyty.
                </td>

              </tr>
              <tr>
                <td>
                  <form action="/archiwizujzwierze" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id_animal" value="<?php echo $animal->id_animal ?>">
                    <button type="submit" value="Edytuj zwierze" class="btn text-white">Archiwizuj zwierzę </button>
                  </form>
                </td>
                <td>
                  Jeżeli zwierzę zmarło lub nie chcesz aby korzystało więcej z naszych usług.
                </td>
              </tr>
            </table>
          <?php  }
          ?>




        </div>
      </div>








    </div>


  </div>
  <!-- koniec rzędu -->
</div>


</div>


@endsection