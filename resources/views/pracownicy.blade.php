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
          Lista pracowników: </br>
        </div>
        <table class="table table-striped  table-sm">

          <?php

          $employees = DB::table('employee')->get();

          ?>

          <thead>
            <tr>

              <th scope="col">Imię </th>
              <th scope="col">Nazwisko </th>
              <th scope="col">Nr telefonu</th>
              <th scope="col">Email</th>
              <th scope="col">Ulica</th>
              <th scope="col">Kod pocztowy</th>
              <th scope="col">Miasto</th>
              <th scope="col">Weterynarz</th>
              <th scope="col">Edycja</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($employees as $employee) {
            ?>
              <tr>
                <td>
                  <?php
                  echo $employee->name; ?>
                </td>
                <td>
                  <?php
                  echo $employee->surname;
                  ?>
                </td>

                <td>
                  <?php
                  echo $employee->phone;
                  ?>
                </td>
                <td>
                  <?php
                  echo $employee->email;
                  ?>
                </td>
                <td>
                  <?php
                  echo $employee->street;
                  ?>
                </td>
                <td>
                  <?php
                  echo $employee->zip_code;
                  ?>
                </td>
                <td>
                  <?php
                  echo $employee->city;
                  ?>
                </td>

                <td>
                  <?php
                  $id_useremp = $employee->id_user;
                  $users = DB::table('users')->where('id', $id_useremp)->get();
                  $if = 0;
                  foreach ($users as $user) {
                    if ($user->Id_vet) $if = 1;
                  }

                  if ($if == 1) echo "TAK";
                  if ($if == 0) echo "NIE";
                  ?>
                </td>

                <td>

                  <form action="/edycjapracownika" method="get" class="form-group" style="width:70%; margin-left:15%;">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="idemployee" value="<?php echo $employee->id_employee ?>">
                    <button type="submit" value="Edytuj profil weterynarza" class="btn text-white">X</button>
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
          <h5>Dodaj pracownika</h5>
        </div>

        <div class="card-body">
          <form action="/createemployee" method="post" class="form-group" style="width:70%; margin-left:15%;">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div>Dane do logowania </div></br>
            <label>Email:</label>
            <input type="text" class="form-control" name="email">
            <label>Hasło:</label>
            <input type="text" class="form-control" name="password">
            <hr>
            <div>Dane pracownika </div></br>
            <label class="form-group">Imię:</label>
            <input type="text" class="form-control" name="name">
            <label>Nazwisko:</label>
            <input type="text" class="form-control" name="surname">
            <label>Nr tel:</label>
            <input type="text" class="form-control" name="phone">

            <label>Ulica:</label>
            <input type="text" class="form-control" name="street">
            <label>Kod pocztowy:</label>
            <input type="text" class="form-control" name="zip_code">
            <label>Miasto:</label>
            <input type="text" class="form-control" name="city">
            <!-- weterynarz -->

            <?php
            $vets = DB::table('vet')->get();
            ?>

<br>
            <label for="id_vet">Weterynarz: </label></br>
              <select id="id_vet" name="id_vet">
              <option value="0">---</option>
                <?php foreach ($vets as $vet) {
                ?>
                  <option value="<?php echo $vet->id_vet ?>"><?php echo $vet->name, ' ', $vet->surname ?></option>


                <?php  }  ?>
              </select>
              <br>
            <!-- koniec weterynarz-->
            <br>
            <button type="submit" value="Dodaj pracownika" class="btn btn-primary">Dodaj pracownika</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div>

@endsection