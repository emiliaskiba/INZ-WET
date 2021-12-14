@extends('layouts/appemployee')

@section('content')

<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/home') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>
  <div class="row">

    <div class="col text-center ">
      <div class="card">
        <div class="card-header">
          <h5> Lista klientów:</h5>
        </div>
        <table class="table table-striped  table-sm">

          <?php

          $owners = DB::table('owner')->get();
          ?>

          <thead>
            <tr>

              <th scope="col">Imię </th>
              <th scope="col">Nazwisko </th>
              <th scope="col">Nr telefonu</th>
              <th scope="col">Email</th>
              <th scope="col">Zwierzęta klienta</th>
              <th scope="col">Edycja</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($owners as $owner) {
            ?>
              <tr>
                <td>
                  <?php
                  echo $owner->name; ?>
                </td>
                <td>
                  <?php
                  echo $owner->surname;
                  ?>
                </td>

                <td>
                  <?php
                  echo $owner->phone;
                  ?>
                </td>
                <td>
                  <?php
                  echo $owner->email;
                  ?>
                </td>



                <td>

                <form action="/zwierzeta" method="get" class="form-group" style="width:70%; margin-left:15%;">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="id_owner" value="<?php echo $owner->id_owner ?>">
                    <button type="submit" value="Edytuj profil klienta" class="btn text-white">Pokaż</button>
                  </form>

                </td>

                <td>

                  <form action="/edycjaklienta" method="get" class="form-group" style="width:70%; margin-left:15%;">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="idowner" value="<?php echo $owner->id_owner ?>">
                    <button type="submit" value="Edytuj profil klienta" class="btn text-white">X</button>
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
          <h5>Utwórz konto klienta</h5>
        </div>

        <div class="card-body">
          <form action="/createowner" method="post" class="form-group" style="width:70%; margin-left:15%;">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div>Dane do logowania </div></br>
            <label>Email:</label>
            <input type="text" class="form-control" name="email">
            <label>Hasło:</label>
            <input type="text" class="form-control" name="password">
            <hr>
            <div>Dane klienta </div></br>
            <label class="form-group">Imię:</label>
            <input type="text" class="form-control" name="name">
            <label>Nazwisko:</label>
            <input type="text" class="form-control" name="surname">
            <label>Nr tel:</label>
            <input type="text" class="form-control" name="phone">
            <br>
            <button type="submit" value="Utwórz konto klienta" class="btn btn-primary">Utwórz konto klienta</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div>

@endsection