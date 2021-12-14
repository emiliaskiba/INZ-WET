@extends('layouts/appclient')

@section('content')
@if(Auth::check())
<?php
$mytime = Carbon\Carbon::now();
$id = Auth::user()->id;
$owners = DB::table('owner')->where('id_user', $id)->get();
foreach ($owners as $owner) {
  $idowner = $owner->id_owner;
}
?>

<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/zwierzetaklienta') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">


      <!-- Wizyty weterynarza -->
      <?php

      $animals = DB::table('animal')->where('id_owner', $idowner)->get();
      $control = 0;

      ?>


      <div class="card">
        <div class="card-header">

          <h5>Dodaj zwierze</h5>
        </div>

        <div class="card-body">

          <form action="/createanimal" method="post" class="form-group" style="width:70%; margin-left:15%;">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id_owner" value="<?php echo $idowner; ?>">

            <table class="table table-sm table-bordered  ">
              <tr>
                </td>
                <td>
                  Imię:</td>
                <td>
                  <input type="text" name="name" class="form-control">
                </td>
              </tr>
              <tr>
                <td>Gatunek:</td>
                <td>

                  <input type="text" name="species" class="form-control">
                </td>
              </tr>
              <tr>
                <td>Rasa:</td>
                <td>
                  <input type="text" name="breed" class="form-control">
                </td>
              </tr>
              <tr>
                <td>Płeć:</td>
                <td>
                  <select id="sex" name="sex" class="form-control">
                    <option value="-">---</option>
                    <option value="M">♂</option>
                    <option value="F">♀</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Data urodzenia:</td>
                <td>
                  <input type="date" name="date_of_birth" max="<?php echo $mytime->toDateString() ?>" class="form-control">

                </td>
              </tr>
              <tr>
                <td>Zdjęcie</td>
                <td>
                  <input id="formFileSm" type="file" accept=".png, .jpg"  />
                </td>

              </tr>
              <tr>
                <td colspan="2">
                  <button type="submit" value="Dodaj zwierzę" class="btn btn-primary">Dodaj zwierzę</button>
                </td>

              </tr>
            </table>
          </form>
        </div>

      </div>
    </div>








  </div>


</div>
<!-- koniec rzędu -->
</div>


</div>

@else

<div class = "text-center ">
  Nie masz uprawnień do wyświetlenia tej strony!
</div>

@endif


@endsection