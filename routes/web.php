<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Contacts;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::resource('posts', PostController::class);
// Route::get('/post/{id}', [PostController::class, 'index']);


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/sample/{name}/', function ($name) {
//     // return view('sample');
//     return "Hello " . $name;
// });

// Route::get('/sample/post/example' , array('as' => 'sample.page', function(){
//     return route('sample.page');
// }));

// Route::get('/find', function(){

//     $posts = Contacts::find(1);

//     return $posts;
//     // foreach($posts as $post){
//     //     echo $post->name;
//     // }
// });

Route::get('/display', function(){
    return Contacts::all();
});

Route::get('/displaytrash', function(){

    // $contacts = Contacts::withTrashed()->get();

    $contacts = Contacts::onlyTrashed()->where('id', 1)->get();
    return $contacts;
});

Route::get('/restore', function(){

    $contacts = Contacts::withTrashed()->restore();

    return $contacts;
});

Route::get('/forcedelete', function(){

    $contacts = Contacts::withTrashed()->where('id', 6)->forceDelete();

    return $contacts;
});

Route::get('/insert', function(){
    DB::insert('insert into contacts(name, contact_number) values(?, ?)', ['ongbak', 'asdqweqwe']);
});

Route::get('/findwhere/{id}', function($id){
    $post = Contacts::where('id', $id)->orderBy('id', 'desc')->take(1)->get();

    return $post;
});

Route::get('/basicinsert', function(){

    $contact = Contacts::find(2);

    $contact->name = 'muzan';
    $contact->contact_number = '123123213';

    $contact->save();

    return Contacts::all();
});

Route::get('/update', function(){
    return Contacts::where('name', 'Bogart')
        ->where('id', 3)
        ->update(['name' => 'boss kenshin', 'contact_number' => '09123123']);
});

Route::get('/delete/{id}', function($id){
    $contact = Contacts::find($id);

    return $contact->delete();
});

Route::get('/softdelete', function(){
    $contact = Contacts::find(1);

    return $contact->delete();
});