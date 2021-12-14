@extends('layouts/appclient')

@section('content')
<?php
$id = Auth::user()->id;
$owners = DB::table('owner')->where('id_user', $id) ->get();
foreach ($owners as $owner) {
  $idowner = $owner->id_owner;
}
?>
<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/home') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">


  </div>


  <div class="col text-center">

    <div class="card">
      <div class="card-header">
        <h5>Edycja</h5>
      </div>


      <!-- -->

      <div class="card-body">
        <form action="/updateownerclient" method="post" class="form-group" style="width:70%; margin-left:15%;">

          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

          <input type="hidden" name="id_owner" value=" <?php echo $idowner ?> ">
          <input type="hidden" name="id_user" value=" <?php echo $owner->id_user; ?> ">
          Dane do logowania:</br>
          <hr>
          <label>Email:</label>
          <input type="text" class="form-control" name="email" value="<?php echo $owner->email; ?>">
          <label>Hasło:</label>
          <input type="text" class="form-control" placeholder="jeśli niezmienione prosze zostawić puste" name="password">
          <hr>

          <label class="form-group">Imię:</label>
          <input type="text" class="form-control" name="name" value="<?php echo $owner->name; ?>">
          <label>Nazwisko:</label>
          <input type="text" class="form-control" name="surname" value="<?php echo $owner->surname; ?>">
          <label>Telefon:</label>
          <input type="text" class="form-control" name="phone" value="<?php echo $owner->phone; ?>">

          <button type="submit" value="Edytuj profil klienta" class="btn btn-primary">Edytuj profil</button>
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