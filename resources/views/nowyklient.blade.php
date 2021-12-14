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
          <h5> Nowy kliencie, dzień dobry. Opowiedz nam coś o sobie:</h5>
        </div>




        <div class="card-body">
          <?php

          //  $email = Auth::user()->email;
          // $password = Auth::user()->password;
          ?>


          <form action="/newowner" method="post" class="form-group" style="width:70%; margin-left:15%;">

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <?php
            $id = Auth::user()->id;
            $email = Auth::user()->email;
            $name = Auth::user()->name;
            ?>
            <input type="hidden" name="user_id" value="<?php echo $id ?>">



            <label class="form-group">Email:</label>
            <input type="text" disabled class="form-control" value="<?php echo $email ?>">
            <input type="hidden" class="form-control" value="<?php echo $email ?>" name="email">
            <label class="form-group">Imię:</label>
            <input type="text" class="form-control" value="<?php echo $name ?> " name="name">
            <label>Nazwisko:</label>
            <input type="text" class="form-control" name="surname">
            <label>Nr tel:</label>
            <input type="text" class="form-control" name="phone">
            <br>
            <button type="submit" value="Utwórz konto klienta" class="btn btn-primary">Utwórz konto</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</div>

@endsection