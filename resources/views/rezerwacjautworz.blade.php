@extends('layouts/appclient')

@section('content')

<?php
$id = Auth::user()->id;
$idvisit = $_GET['idvisit'];

$owners = DB::table('owner')->where('id_user', $id)->get();
foreach ($owners as $owner) {
}

?>
<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/rezerwacjaform') }}" class="btn text-white mt-2">Anuluj rezerwację</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">

      <?php
      $visits = DB::table('visit')->where('id_visit', $idvisit)->get();

      foreach ($visits as $visit) {
      ?>
        <div class="card">
          <div class="card-header">
            <h5>Zarezerwuj wizytę</h5>
          </div>

          <div class="card-body">
            <form action="/reservationcreate" method="post" class="form-group" style="width:70%; margin-left:15%;">

              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">



              <label for="id_animal">Zwierze: </label>
              <select id="id_animal" name="id_animal">

                <?php
                $animals = DB::table('animal')->where('archive', 0)->where('id_owner', $owner->id_owner)->get();
                foreach ($animals as $animal) {
                ?>
                  <option value="<?php echo $animal->id_animal ?>"><?php echo $animal->name ?></option>


                <?php  }  ?>
              </select>
              <br /><hr>
              <input type="hidden" name="id_owner" value="<?php echo $owner->id_owner ?>">
              <input type="hidden" name="id_visit" value="<?php echo $idvisit ?>">
              <label>Wiadomość dla weterynarza:</label>
              <textarea rows="5" cols="60" class="form-control" name="message"></textarea><br>

              <button type="submit" value="Rezerwuj" class="btn btn-primary mt-2">Rezerwuj</button>


            </form>
          </div>
        </div>
      <?php
      }

      ?>

    </div>
    <!-- koniec rzędu -->
  </div>


</div>


@endsection