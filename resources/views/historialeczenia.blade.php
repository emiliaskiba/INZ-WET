@extends('layouts/appclient')

@section('content')

<?php
$id = Auth::user()->id;
$owners = DB::table('owner')->where('id_user', $id)->get();
foreach ($owners as $owner) {
  $idowner = $owner->id_owner;
}
?>
<?php $id_animal = $_GET['id_animal'];
?>




<div class="container">
<!--
<div class="row mb-5">
    <a href="{{ url()->previous() }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>
-->
  <div class="row">

    <div class="col text-center ">


      <?php

      $animals = DB::table('animal')->where('archive', 0)->where('id_animal', $id_animal)->get();


      ?>
      <?php
      foreach ($animals as $animal) {
        $visits = DB::table('visit')->where('confirmation', 1)->where('id_animal', $animal->id_animal)->orderBy('date', 'desc')->get();
      ?>

        <div class="card">
          <div class="card-header">

            <h5>Historia leczenia zwierzęcia <?php echo $animal->name; ?> </h5>
          </div>

          <div class="card-body">
            <div class="row">
              <?php foreach ($visits as $visit) { ?>
                <div class="col-4 ">


                  <table class="table table-striped table-bordered  ">

                    <tr>
                      <td colspan="2">
                        <b>
                          <?php echo  $visit->date ?></b><br>
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
                        <b>Typ wizyty</b>
                      </td>
                      <td>
                        <?php
                        $visittypes = DB::table('visit_type')->where('id_visit_type', $visit->id_type)->get();
                        foreach ($visittypes as $visittype) echo $visittype->name;
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">

                        <form action="/historiawizyty" method="get" class="form-group" style="width:70%; margin-left:15%;">
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <input type="hidden" name="id_visit" value="<?php echo $visit->id_visit ?>">
                          <button type="submit" value="historia wizyty" class="btn text-white">Szczegóły</button>
                        </form>

                      </td>
                    </tr>

                  </table>




                </div>
            <?php }
            } ?>
            </div>
          </div>

        </div>
    </div>



  </div>


</div>
<!-- koniec rzędu -->



@endsection