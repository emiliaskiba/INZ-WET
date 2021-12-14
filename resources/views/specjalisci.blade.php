@extends('layouts/app')

@section('content')

@if(session()->has('specjalizacja'))
<?php $specjalizacja = session()->get('specjalizacja'); ?>
@endif

<div class="container">

  <div class="row mb-5">
    <a href="{{ url('/') }}" class="btn text-white mt-2">WRÓĆ</a></br>
  </div>
  <?php
  $specializations = DB::table('specialization')->get();
  ?>
  <div class="row">

    <div class="col text-center ">
      <div class="card">
        <div class="card-header">
          <form action="/showspecialists" method="POST" class="form-group" style="width:70%; margin-left:15%;">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label for="specialization">Specjalizacja: </label></br>
            <select id="id_specialization" name="id_specialization">
              <option value="">Wszystkie</option>
              <?php foreach ($specializations as $specialization) {
              ?>
                <option value="<?php echo $specialization->id_specialization; ?>"><?php echo $specialization->name ?></option>


              <?php  }  ?>
            </select>
            <br />
            <button class="btn mt-2 w-50 mx-auto text-white " type="submit">Pokaż</button>
          </form>
        </div>
        <?php
        if (isset($specjalizacja)) { { ?>

            @if(session()->has('specjalizacja'))
            <table class="table table-striped w-70 mx-auto ">



              <thead>
                <br>

                <h5> Specjalizacja: <?php
                                    $specializations = DB::table('specialization')->where('id_specialization', $specjalizacja)->get();
                                    foreach ($specializations as $specialization) {
                                      echo $specialization->name;
                                    } ?> </h5>

                <tr>
                  <th scope="col">Imię </th>
                  <th scope="col">Nazwisko </th>
                  <th scope="col">Nr licencji</th>
                  <th scope="col">Biografia</th>
                  <th scope="col">Specjalizacja</th>

                </tr>
                <?php

                $vetspecializations = DB::table('vet_specialization')->where('id_specialization', $specjalizacja)->get();
                foreach ($vetspecializations as $vetspecialization) {
                  $vets = DB::table('vet')->where('archive', NULL)->where('id_vet', $vetspecialization->id_vet)->get();
                  foreach ($vets as $vet) {

                ?>
                    <tr>
                      <td>
                        <?php echo $vet->name; ?>
                      </td>
                      <td>
                        <?php echo $vet->surname; ?>
                      </td>
                      <td>
                        <?php echo $vet->license; ?>
                      </td>
                      <td>
                        <?php echo $vet->biography; ?>
                      </td>
                      <td>
                        <?php
                        $vetspecializations = DB::table('vet_specialization')->where('id_vet', $vet->id_vet)->get();

                        foreach ($vetspecializations as $vetspecialization) {
                          $specializations = DB::table('specialization')->where('id_specialization', $vetspecialization->id_specialization)->get();
                          foreach ($specializations as $specialization) {
                            echo $specialization->name, "<br/>";
                          }
                        }
                        ?>
                      </td>
                    </tr>
                <?php }
                } ?>
              </thead>
              <tbody>
              </tbody>
            </table> @endif
        <?php   }
        } ?>

        @if (!(session()->has('specjalizacja')))
        <table class="table table-striped w-70 mx-auto ">



          <thead>
            <br>
            <tr>
              <th scope="col">Imię </th>
              <th scope="col">Nazwisko </th>
              <th scope="col">Nr licencji</th>
              <th scope="col">Biografia</th>
              <th scope="col">Specjalizacja</th>

            </tr>
            <?php
            $vets = DB::table('vet')->where('archive',null)->get();
            foreach ($vets as $vet) {

            ?>
              <tr>
                <td>
                  <?php echo $vet->name; ?>
                </td>
                <td>
                  <?php echo $vet->surname; ?>
                </td>
                <td>
                  <?php echo $vet->license; ?>
                </td>
                <td>
                  <?php echo $vet->biography; ?>
                </td>
                <td>
                        <?php
                        $vetspecializations = DB::table('vet_specialization')->where('id_vet', $vet->id_vet)->get();

                        foreach ($vetspecializations as $vetspecialization) {
                          $specializations = DB::table('specialization')->where('id_specialization', $vetspecialization->id_specialization)->get();
                          foreach ($specializations as $specialization) {
                            echo $specialization->name, "<br/>";
                          }
                        }
                        ?>
                      </td>
              </tr>
            <?php } ?>
          </thead>
          <tbody>
          </tbody>
        </table>
        @endif

      </div>
    </div>
    
  </div>

</div>
</div>

@endsection