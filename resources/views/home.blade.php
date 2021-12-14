@extends('layouts/app')

@section('content')

<?php
$id = Auth::user()->id;
$owners = DB::table('owner')->get();
$ifexists = 0;
foreach ($owners as $owner) {

    if (($owner->id_user) == $id) {

        $ifexists = 1;
    }
}
?>
@if( $ifexists == 0 && Auth::user()->Id_type == 3 )

<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/nowyklient') }}" class="btn text-white mt-2">UZUPEŁNIJ INFORMACJE </a></br>
        </div>
        <div class="card-body text-center">
            Drogi kliencie. Kliknij w przycisk powyżej i uzupełnij swoje informacje aby móc w pełni korzystać z naszych
            usług.
        </div>
    </div>
    @endif
</div>

@if(Auth::user()->Id_type == 3 && $ifexists == 1)
<div class="container">

    <div class=" card card-header text-center">
        <h1>
            <?php
            echo Auth::user()->name
            ?>
            !
        </h1>
        Cieszymy się, że wybrałeś/aś nasze usługi.
    </div>

    <div class="row mt-3">
        <div class="col-7">



            <div class="card">
                <div class="card-header text-center">
                    {{ __('Panel użytkownika') }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="card-title mb-10">
                        <div class="d-flex justify-content-start">

                            <div class="ml-auto">
                                <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <div class="tab-content ml-1" id="myTabContent">
                                <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">


                                    <?php

                                    $owners = DB::table('owner')->where('id_user', $id)->get();
                                    foreach ($owners as $owner) {
                                    ?>

                                        <div class="row">
                                            <div class="col-sm-3  col-6">
                                                <label style="font-weight:bold;">Z nami od</label>
                                            </div>
                                            <div class=" col-6">
                                                {{Auth::user()->created_at}}
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3  col-5">
                                                <label style="font-weight:bold;">Email&nbsp;&nbsp;&nbsp; </label>
                                            </div>
                                            <div class=" col-6">
                                                {{Auth::user()->email}}
                                            </div>
                                        </div>
                                        <hr />


                                        <!--  <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Status</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                @if (Auth::user()->email_verified_at == NULL) Niezweryfikowany @else Zweryfikowany @endif
                                            </div> 
                                        </div>
                                        <hr /> -->


                                        <div class="row ">
                                            <div class="col-sm-3  col-5">
                                                <label style="font-weight:bold;">Imię</label>
                                            </div>
                                            <div class="col-6">
                                                <?php echo $owner->name; ?>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-3 col-5">
                                                <label style="font-weight:bold;">Nazwisko</label>
                                            </div>
                                            <div class=" col-6">
                                                <?php echo $owner->surname; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3  col-5">
                                                <label style="font-weight:bold;">Nr telefonu</label>
                                            </div>
                                            <div class=" col-6">
                                                <?php echo $owner->phone; ?>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- edycja -->
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="{{ url('/edycjadanychklient') }}" class="btn text-white mt-2">Edytuj swoje
                                                    dane</a></br>
                                            </div>
                                        </div>

                                        <!-- edycja koniec -->
                                    <?php };
                                    ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>




        </div>
        <div class="col-5">
            <div class="row ">


                <div class="text-center container-fluid  ">
                    <div class="card ">
                        <div class="card-header">
                            MENU
                        </div>
                        <div class="card-body">


                            <a href="{{ url('/rezerwacjaform') }}" class="btn text-white mt-2 form-control">ZAREZERWUJ
                                WIZYTĘ</a></br>
                            <a href="{{ url('/wizytyklienta') }}" class="btn text-white mt-2 ">TWOJE WIZYTY</a>
                            </br>
                            <a href="{{ url('/zwierzetaklienta') }}" class="btn text-white mt-2">TWOJE ZWIERZĘTA </a>
                            </br>


                        </div>
                    </div>







                </div>


            </div>
        </div>
    </div>

</div>
<br /><br />
@endif

@if( Auth::user()->Id_type == 1)

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="p-6 ">
            <div class=" justify-center pt-8">
                <div class="text-center mt-4">
                    <div class="card">
                        <div class="card-header">
                            PANEL ADMIN
                        </div>
                        <div class="card-body">


                            <a href="{{ url('/pracownicy') }}" class="btn text-white mt-2">PRACOWNICY</a></br>
                            <a href="{{ url('/weterynarze') }}" class="btn text-white mt-2">PROFILE WETERYNARZY</a>
                            </br>
                            <a href="{{ url('/klienci') }}" class="btn text-white mt-2">KLIENCI</a> </br>
                            <a href="{{ url('/wizyty') }}" class="btn text-white mt-2">WIZYTY</a></br>

                        </div>
                    </div>







                </div>
            </div>
        </div>
    </div>

</div>

@endif


@if(Auth::user()->Id_type == 2)

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="p-6 ">
            <div class=" justify-center pt-8">
                <div class="text-center mt-4">
                    <div class="card">
                        <div class="card-header">
                            PANEL PRACOWNIK
                        </div>
                        <div class="card-body">



                            <a href="{{ url('/klienci') }}" class="btn text-white mt-2">KLIENCI</a> </br>
                            <a href="{{ url('/wizytypracownika') }}" class="btn text-white mt-2">TWOJE WIZYTY</a></br>

                        </div>
                    </div>







                </div>
            </div>
        </div>
    </div>

</div>
@endif

@endsection