<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//podstrony

Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//dodawanie pracownika
Route::get('/insertemployee', [App\Http\Controllers\EmployeeController::class, 'insertform'])->name('insertemployee');
Route::post('/createemployee', [App\Http\Controllers\EmployeeController::class, 'insert'])->name('createemployee');

//dodawanie klienta
Route::get('/insertowner', [App\Http\Controllers\OwnerController::class, 'insertform'])->name('insertowner');
Route::post('/createowner', [App\Http\Controllers\OwnerController::class, 'insert'])->name('createowner');

//dodawanie wizyty
Route::get('/insertvisit', [App\Http\Controllers\VisitController::class, 'insertform'])->name('insertvisit');
Route::post('/createvisit', [App\Http\Controllers\VisitController::class, 'insert'])->name('createvisit');

//dodawanie weterynarza
Route::get('/insertvet', [App\Http\Controllers\VetController::class, 'insertform'])->name('insertvet');
Route::post('/createvet', [App\Http\Controllers\VetController::class, 'insert'])->name('createvet');

//dodawanie specjalizacji

Route::post('/createspecialization', [App\Http\Controllers\SpecializationController::class, 'insert'])->name('createspecialization');
Route::post('/deletespecialization', [App\Http\Controllers\SpecializationController::class, 'deletespecialization'])->name('deletespecialization');
//dodawanie specjalizacji weterynarzowi

Route::post('/insertvetspecialization', [App\Http\Controllers\SpecializationController::class, 'insertvetspecialization'])->name('insertvetspecialization');

Route::post('/deletevetspecialization', [App\Http\Controllers\SpecializationController::class, 'deletevetspecialization'])->name('deletevetspecialization');

//wybieranie weterynarza
Route::post('/vetvisit', [App\Http\Controllers\VetController::class, 'vetvisit'])->name('vetvisit');
//potwierdzanie wizyty
Route::post('/confirmvisit', [App\Http\Controllers\VisitController::class, 'confirmvisit'])->name('confirmvisit');
//Wyświetlanie wizyt weterynarza
Route::get('/wizytyweterynarza', function () {
    return view('wizytyweterynarza');
});
//specjalisci weterynarze

Route::get('/specjalisci', function () {
    return view('specjalisci');
});
//nowy klient

Route::get('/nowyklient', function () {
    return view('nowyklient');
});

Route::post('/newowner', [App\Http\Controllers\OwnerController::class, 'newowner'])->name('newowner');
//specjalisci z wybrana specjalizacja

Route::post('/showspecialists', [App\Http\Controllers\SpecializationController::class, 'showspecialists'])->name('showspecialists');



//edycja weterynarza

Route::get('/edycjaweterynarza', function () {
    return view('edycjaweterynarza');
});
Route::post('/updatevet', [App\Http\Controllers\VetController::class, 'update'])->name('updatevet');
Route::post('/archiwizujwet', [App\Http\Controllers\VetController::class, 'archiwizujwet'])->name('archiwizujwet');
Route::post('/odarchiwizujwet', [App\Http\Controllers\VetController::class, 'odarchiwizujwet'])->name('odarchiwizujwet');
//edycja pracownika

Route::get('/edycjapracownika', function () {
    return view('edycjapracownika');
});
Route::post('/updateemployee', [App\Http\Controllers\EmployeeController::class, 'update'])->name('updateemployee');

//edycja klienta pracownik i admin

Route::get('/edycjaklienta', function () {
    return view('edycjaklienta');
});
Route::post('/updateowner', [App\Http\Controllers\OwnerController::class, 'update'])->name('updateowner');

//edycja klienta klient

Route::get('/edycjadanychklient', function () {
    return view('edycjadanychklient');
});
Route::post('/updateownerclient', [App\Http\Controllers\OwnerController::class, 'updateclient'])->name('updateownerclient');


//wizyty pracownika
Route::get('/wizytypracownika', function () {
    return view('wizytypracownika');
});

//wizyty klienta

Route::get('/wizytyklienta', function () {
    return view('wizytyklienta');
});
Route::get('/wszystkiewizytyklienta', function () {
    return view('wszystkiewizytyklienta');
});

//rezerwacja

Route::get('/rezerwacjaform', function () {
    return view('rezerwacjaform');
});
Route::get('/rezerwacja', function () {
    return view('rezerwacja');
});
Route::get('/rezerwacjautworz', function () {
    return view('rezerwacjautworz');
});

Route::get('/wizytaedycja', function () {
    return view('wizytaedycja');
});

Route::post('/uzupelnijwizyte', [App\Http\Controllers\VisitController::class, 'uzupelnijwizyte'])->name('uzupelnijwizyte');

Route::post('/reservationcreate', [App\Http\Controllers\VisitController::class, 'reservationcreate'])->name('reservationcreate');

//zwierzeta klienta

Route::get('/zwierzetaklienta', function () {
    return view('zwierzetaklienta');
});
Route::get('/zarchiwizowanezwierzeta', function () {
    return view('zarchiwizowanezwierzeta');
});

Route::get('/zwierzeta', function () {
    return view('zwierzeta');
});

//edycja zwierzecia

Route::get('/edycjazwierze', function () {
    return view('edycjazwierze');
});
Route::post('/updateanimal', [App\Http\Controllers\AnimalController::class, 'updateanimal'])->name('updateanimal');

//dodanie zwierzecia

Route::get('/dodaniezwierze', function () {
    return view('dodaniezwierze');
});
Route::post('/createanimal', [App\Http\Controllers\AnimalController::class, 'createanimal'])->name('createanimal');

//usuniecie i archwiwizacja zwierzecia
Route::post('/usunzwierze', [App\Http\Controllers\AnimalController::class, 'usunzwierze'])->name('usunzwierze');
Route::post('/archiwizujzwierze', [App\Http\Controllers\AnimalController::class, 'archiwizujzwierze'])->name('archiwizujzwierze');
Route::post('/odarchiwizujzwierze', [App\Http\Controllers\AnimalController::class, 'odarchiwizujzwierze'])->name('odarchiwizujzwierze');

//historia leczenia

Route::get('/historialeczenia', function () {
    return view('historialeczenia');
});

Route::get('/historiawizyty', function () {
    return view('historiawizyty');
});
Route::get('/edytujwizyteklient', function () {
    return view('edytujwizyteklient');
});
Route::post('/edytujwizyte', [App\Http\Controllers\VisitController::class, 'edytujwizyte'])->name('edytujwizyte');
Route::post('/odwolajwizyteklient', [App\Http\Controllers\VisitController::class, 'odwolajwizyteklient'])->name('odwolajwizyteklient');


Route::post('/historialeczeniaid', [App\Http\Controllers\AnimalController::class, 'historialeczeniaid'])->name('historialeczeniaid');
//inne

Route::get('/bazatest', function () {
    return view('bazatest');
});

Route::get('/klienci', function () {
    return view('klienci');
});

Route::get('/pracownicy', function () {
    return view('pracownicy');
});
Route::get('/wizyty', function () {
    return view('wizyty');
});
Route::get('/weterynarze', function () {
    return view('weterynarze');
});

Route::get('/mypage'
    . '', function () {
    return view('mypage');
})->name('mypage');

//baza danych funkcja

Route::get('bazatest', function () {

    $petani = DB::table('vet')->get();
    return view('bazatest', ['vet' => $petani]);
});
