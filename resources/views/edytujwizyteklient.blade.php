@extends('layouts/appclient')

@section('content')

<?php
$id = Auth::user()->id;
$owners = DB::table('owner')->where('id_user', $id)->get();
foreach ($owners as $owner) {
  $idowner = $owner->id_owner;
}
?>
<?php
$id_visit = $_GET['id_visit'];
?>




<div class="container">


  <div class="row mb-5">
    <a href="{{ url()->previous() }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>

  <div class="row">

    <div class="col text-center ">


      <?php

      /////////

      ////////

      ?>
      <?php
      $visits = DB::table('visit')->where('id_visit', $id_visit)->get();
      foreach ($visits as $visit) {
      }

      $animals = DB::table('animal')->where('id_animal', $visit->id_animal)->get();
      foreach ($animals as $animal) {
      };
      ?>

      <div class="card">
        <div class="card-header">

          <h5> Edytuj wizytę </h5>
        </div>

        <div class="card-body">
          <div class="row">

            <div class="col ">

              <form action="/edytujwizyte" method="POST" class="form-group" style="width:70%; margin-left:15%;">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">


                <table class="table table-striped table-bordered  ">

                  <tr>
                    <td>
                      <b> Data wizyty</b>
                    </td>
                    <td>

                      <?php echo  $visit->date ?><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Godzina wizyty</b>
                    </td>
                    <td>

                      <?php echo  $visit->time ?><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>Weterynarz</b>
                    </td>
                    <td>
                      <?php
                      $vets = DB::table('vet')->where('id_vet', $visit->id_vet)->get();
                      foreach ($vets as $vet) {
                        echo $vet->name, ' ', $vet->surname;
                      } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b> Typ wizyty</b>
                    </td>
                    <td>
                      <?php
                      $visittypes = DB::table('visit_type')->where('id_visit_type', $visit->id_type)->get();
                      foreach ($visittypes as $visittype) {
                        echo $visittype->name;
                      } ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <b>Zwierzę</b>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">

                      <select id="id_animal" name="id_animal">

                        <?php
                        $animals = DB::table('animal')->where('archive', 0)->where('id_owner', $owner->id_owner)->get();
                        foreach ($animals as $animal) {
                        ?>
                          <option value="<?php echo $animal->id_animal ?>"><?php echo $animal->name ?></option>


                        <?php  }  ?>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <b>Wiadomość</b>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <textarea rows="5" cols="60" class="form-control" name="message"><?php echo $visit->message; ?></textarea><br>


                    </td>
                  </tr>


                </table>

                <button type="submit" value="Edytuj" class="btn btn-primary mt-2">Edytuj</button>
              </form>



            </div>

          </div>
        </div>

      </div>
    </div>


  </div>

</div>
<!-- koniec rzędu -->



@endsection