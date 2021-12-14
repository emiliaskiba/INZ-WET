@extends('layouts/appadmin')

@section('content')

<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/weterynarze') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <!-- Dodawanie wizyt -->

  </div>


  <div class="col text-center">

    <div class="card">
      <div class="card-header">
        <h5>Edycja</h5>
      </div>
      <?php

      $idvet = $_GET['idvet'];
      $vets = DB::table('vet')->where('id_vet', $idvet)->get();
      foreach ($vets as $vet) {
      }

      ?>

      <!-- -->

      <div class="card-body">
        <form action="/updatevet" method="post" class="form-group" style="width:70%; margin-left:15%;">

          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

          <input type="hidden" name="id_vet" value=" <?php echo $idvet ?> ">
          <label class="form-group">Imię:</label>
          <input type="text" class="form-control" name="name" value="<?php echo $vet->name; ?>">
          <label>Nazwisko:</label>
          <input type="text" class="form-control" name="surname" value="<?php echo $vet->surname; ?>">
          <label>Nr licencji:</label>
          <input type="text" class="form-control" name="license" value="<?php echo $vet->license; ?>">



          <label>Biografia:</label>

          <textarea rows="5" cols="60" class="form-control" name="biography"><?php echo $vet->biography; ?></textarea><br>

          <br>
          <button type="submit" value="Edytuj profil weterynarza" class="btn btn-primary">Edytuj profil weterynarza</button>
        </form>



      </div>



    </div>

    <div class="card mt-2 mb-2">
      <div class="card-header">
        <h5>Specjalizacje</h5>
      </div>

      <div class="card-body">
        <?php
        $vetspecializations = DB::table('vet_specialization')->where('id_vet', $idvet)->join('specialization', 'vet_specialization.id_specialization', '=', 'specialization.id_specialization')->get();
        ?>
        <div class="row">
          <?php
          foreach ($vetspecializations as $vetspecialization) {
          ?>
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <?php
                  echo 'Specjalizacja: ', $vetspecialization->name;


                  ?>
                  <form action="/deletevetspecialization" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id_vet" value="<?php echo $idvet ?>">
                    <input type="hidden" name="id_specialization" value="<?php echo $vetspecialization->id_specialization ?>">
                    <button type="submit" value="archiwizuj" class="btn w-75 text-white">Usuń</button>
                  </form>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>

    <div class="card mt-2 mb-2">
      <div class="card-header">
        <h5>Akcje</h5>
      </div>
      <div class="card-body">
        <form action="/archiwizujwet" method="POST">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <input type="hidden" name="id_vet" value="<?php echo $vet->id_vet ?>">
          <button type="submit" value="archiwizuj" class="btn w-75 text-white">Archiwizuj</button>
        </form>
        <?php
        ?>


        </form>
      </div>
    </div>

  </div>
</div>

</div>
</div>

@endsection