@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-9">


            <div class="card mt-2">

                <div class="pink-bg text-center card-header">
                    <img src="/logo.png" height="100" alt="weterynarz">





                </div>

                <div class="card-body">

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />
                    <div class="text-center">
                          <a href="mapa.png"><img src="/mapa.png" height="200" alt="weterynarz"></a><br />
     
                      


                    </div>
                    <div class="text-center">
                        ✉ Nadbystrzycka 38D 20-618 Lublin</br>
                        ☏ Rejestracja 509-830-663 </br>
                    </div>
                    <!--  <a href="{{ url('/specjalisci') }}" class="btn text-white mt-2">Poznaj naszych specjalistów </a> <br />
                    <a href="{{ url('/register') }}" class="btn text-white mt-2">Jesteś tu pierwszy raz? Załóż konto </a> <br /> -->

                </div>

            </div>










        </div>
        <div class="col-3">


            <div class="text-center card mt-2  ">

                <div class="card-body text-center">
                    Chcesz wybrać odpowiedniego weterynarza dla swojego zwierzęcia? <br>
                    <a href="{{ url('/specjalisci') }}" class="btn text-white mt-2">Poznaj naszych specjalistów!</a> <br />


                </div>

            </div>


            <div class="text-center card  mt-5">
                <div class="card-header pink-bg text-white">
                    Zadowoleni pacjenci:
                </div>
                <div class="card-body text-center">
                    <img src="/kot.jpg" height=90vw alt="weterynarz">
                    <div class="font-italic ">
                        Kotek Dynio
                    </div>

                </div>





            </div>

        </div>
    </div>

    @endsection