@extends('layouts/appadmin')

@section('content')

<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/pracownicy') }}" class="btn text-white mt-2">WRÓĆ</a></br>
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

      $idemployee = $_GET['idemployee'];
      $employees = DB::table('employee')->where('id_employee', $idemployee)->get();
      foreach ($employees as $employee) {
      }

      ?>

      <!-- -->

      <div class="card-body">
        <form action="/updateemployee" method="post" class="form-group" style="width:70%; margin-left:15%;">

          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

          <input type="hidden" name="id_employee" value=" <?php echo $idemployee ?> ">
          <input type="hidden" name="id_user" value=" <?php echo $employee->id_user; ?> ">
          <div class="card">


            <div class="card-body">
              <label>Email:</label>
              <input type="text" class="form-control" name="email" value="<?php echo $employee->email; ?>">

              <label>Hasło:</label>
              <input type="text" class="form-control" placeholder="Jeśli nie jest zmieniane - zostawić puste pole " name="password">
            </div>
          </div> </br>

          <label class="form-group">Imię:</label>
          <input type="text" class="form-control" name="name" value="<?php echo $employee->name; ?>">
          <label>Nazwisko:</label>
          <input type="text" class="form-control" name="surname" value="<?php echo $employee->surname; ?>">
          <label>Telefon:</label>
          <input type="text" class="form-control" name="phone" value="<?php echo $employee->phone; ?>">


          <label>Ulica:</label>
          <input type="text" class="form-control" name="street" value="<?php echo $employee->street; ?>">

          <label>Kod pocztowy:</label>
          <input type="text" class="form-control" name="zip_code" value="<?php echo $employee->zip_code; ?>">
          <label>Miasto:</label>
          <input type="text" class="form-control" name="city" value="<?php echo $employee->city; ?>"> <br />






          <button type="submit" value="Edytuj profil pracownika" class="btn btn-primary">Edytuj profil pracownika</button>
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