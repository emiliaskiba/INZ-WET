@extends('layouts/appadmin')

@section('content')



<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/home') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">
      <div class="card">
        <div class="card-header">
          <h5>Lista weterynarzy: </h5>
        </div>
        <table class="table table-striped  table-sm">

          <?php

          $vets = DB::table('vet')->where('archive', NULL)->get();

          ?>

          <thead>
            <tr>

              <th scope="col">Imię </th>
              <th scope="col">Nazwisko </th>
              <th scope="col">Nr licencji</th>
              <th scope="col">Biografia</th>
              <th scope="col">Specjalizacja</th>
              <th scope="col">Edycja</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($vets as $vet) {
            ?>
              <tr>
                <td>
                  <?php
                  echo $vet->name; ?>
                </td>
                <td>
                  <?php
                  echo $vet->surname;
                  ?>
                </td>

                <td>
                  <?php
                  echo $vet->license;
                  ?>
                </td>
                <td>
                  <button class="btn text-white" onclick="alert('<?php echo $vet->biography; ?>')">Wyświetl</button>
                </td>
                <td>
                  <?php
                  $vetspecializations = DB::table('vet_specialization')->where('id_vet', $vet->id_vet)->get();

                  foreach ($vetspecializations as $vetspecialization) {
                    $specializations = DB::table('specialization')->where('id_specialization', $vetspecialization->id_specialization)->get();
                    foreach ($specializations as $specialization) {
                      echo $specialization->name, "<br/>";
                    }
                  }
                  ?>
                </td>


                <td>
                  <form action="/edycjaweterynarza" method="get" class="form-group" style="width:70%; margin-left:15%;">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="idvet" value="<?php echo $vet->id_vet ?>">
                    <button type="submit" value="Edytuj profil weterynarza" class="btn text-white">-</button>
                  </form>
                </td>

              </tr>
            <?php
            }


            ?>
          </tbody>
        </table>
      </div>

      <div class="card mt-2">
        <div class="card-header">
          <h5>Lista archiwizowanych weterynarzy: </h5>
        </div>
        <table class="table table-striped  table-sm">

          <?php

          $vets = DB::table('vet')->where('archive',1)->get();

          ?>

          <thead>
            <tr>

              <th scope="col">Imię </th>
              <th scope="col">Nazwisko </th>
              <th scope="col">Nr licencji</th>
              <th scope="col">Biografia</th>
              <th scope="col">Specjalizacja</th>
              <th scope="col">Przywróć</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($vets as $vet) {
            ?>
              <tr>
                <td>
                  <?php
                  echo $vet->name; ?>
                </td>
                <td>
                  <?php
                  echo $vet->surname;
                  ?>
                </td>

                <td>
                  <?php
                  echo $vet->license;
                  ?>
                </td>
                <td>
                  <button class="btn text-white" onclick="alert('<?php echo $vet->biography; ?>')">Wyświetl</button>
                </td>
                <td>
                  <?php
                  $vetspecializations = DB::table('vet_specialization')->where('id_vet', $vet->id_vet)->get();

                  foreach ($vetspecializations as $vetspecialization) {
                    $specializations = DB::table('specialization')->where('id_specialization', $vetspecialization->id_specialization)->get();
                    foreach ($specializations as $specialization) {
                      echo $specialization->name, "<br/>";
                    }
                  }
                  ?>
                </td>


                <td>
                  <form action="/odarchiwizujwet" method="POST" class="form-group" style="width:70%; margin-left:15%;">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="idvet" value="<?php echo $vet->id_vet ?>">
                    <button type="submit" value="Odarchiwizuj weterynarza" class="btn text-white">+</button>
                  </form>
                </td>

              </tr>
            <?php
            }


            ?>
          </tbody>
        </table>
      </div>


    </div>

    <div class="col text-center">

      <div class="card">
        <div class="card-header">
          <h5>Utwórz profil weterynarza</h5>
        </div>

        <div class="card-body">
          <form action="/createvet" method="post" class="form-group" style="width:70%; margin-left:15%;">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label class="form-group">Imię:</label>
            <input type="text" class="form-control" name="name">
            <label>Nazwisko:</label>
            <input type="text" class="form-control" name="surname">
            <label>Nr licencji:</label>
            <input type="text" class="form-control" name="license">

            <label>Biografia:</label>

            <textarea rows="5" cols="60" class="form-control" name="biography"></textarea><br>

            <br>
            <button type="submit" value="Utwórz profil weterynarza" class="btn btn-primary">Utwórz profil weterynarza</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col text-center ">
      <div class="card">
        <div class="card-header">
          <h5>Dodaj specjalizacje lekarzowi</h5>
        </div>
<?php
$vets = DB::table('vet')->where('archive', NULL)->get(); 
?>
        <div class="card-body">
          <form action="/insertvetspecialization" method="post" class="form-group" style="width:70%; margin-left:15%;">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="row">
              <div class="col">
                <label for="id_vet">Weterynarz: </label></br>
                <select id="id_vet" name="id_vet">
                  <?php foreach ($vets as $vet) {
                  ?>
                    <option value="<?php echo $vet->id_vet ?>"><?php echo $vet->name, ' ', $vet->surname ?></option>


                  <?php  }  ?>
                </select></br></br>


                <label for="id_specialization">Specjalizacja: </label></br>
                <select id="id_specialization" name="id_specialization">
                  <?php $specializations = DB::table('specialization')->get();
                  foreach ($specializations as $specialization) {
                  ?>
                    <option value="<?php echo $specialization->id_specialization ?>"><?php echo $specialization->name; ?></option>


                  <?php  }  ?>
                </select>
                <button type="submit" value="Dodaj" class="btn btn-primary mt-4">Dodaj</button>
          </form>
        </div>
      </div>
    </div>

  </div>



  <div class="card mt-3">
    <div class="card-header">
      <h5>Dodaj specjalizację</h5>
    </div>

    <div class="card-body">
      <form action="/createspecialization" method="post" class="form-group" style="width:70%; margin-left:15%;">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <input type="text" class="form-control text-center" placeholder="Nowa specjalizacja" name="name">
        <br>
        <button type="submit" value="Dodaj" class="btn btn-primary">Dodaj</button>
      </form>
      <br /><b>Istniejące specjalizacje:</b> <br /><br />
      <?php

      $specializations = DB::table('specialization')->get();
      foreach ($specializations as $specialization) {
        echo $specialization->name; ?> <br />
         <form action="/deletespecialization" method="POST" class="form-group" style="width:70%; margin-left:15%;">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id_specialization" value="<?php echo $specialization->id_specialization ?>">
                    <button type="submit" value="delete" class="btn text-white">Usuń Specjalizację</button>
                  </form>
      <?php };  ?>
    </div>


  </div>

</div>



</div>




</div>


</div>


@endsection