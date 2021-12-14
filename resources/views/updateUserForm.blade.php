@extends('app')

@section('content')

<div class="col-lg-9">
    <br>
    <h2>Edytuj informacje</h2>

    <form class="form-horizontal" method='post' action="{{ route('updateuser', $user)}}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <fieldset>

            <!-- Form Name -->
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-12 control-label" for="textinput">E-mail</label>
                <div class="col-md-12">
                    <input id="email" name="email" class="form-control input-md" required="" value="{{$user->email}}" type="email">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Nazwa użytkownika</label>
                <div class="col-md-12">
                    <input id="name" name="name" class="form-control input-md" required="" value="{{$user->name}}" type="text">
                </div>
            </div>
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-8 control-label" for="save"></label>
                <div class="col-md-12">

                    <button id="save" name="save" class="btn btn-success">Zmień</button>
                    <a href="{{route('mypage')}}" class="btn btn-danger" title="Wroc"> Wróć </a>
                </div>
            </div>
        </fieldset>
    </form>
    <!-- hasło -->

</div>
</div>
</div>
</div>
<br>
@endsection