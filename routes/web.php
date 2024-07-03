<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Contacts;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\Video;

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
    return Post::all();
});

Route::get('/displaytrash', function(){

    // $posts = Post::withTrashed()->get();

    $posts = Post::onlyTrashed()->get();
    return $posts;
});

Route::get('/restore', function(){

    $posts = Post::withTrashed()->restore();

    return $posts;
});

Route::get('/forcedelete', function(){

    $posts = Post::withTrashed()->where('id', 1)->forceDelete();

    return $posts;
});

Route::get('/insert', function(){
    DB::insert('insert into posts(user_id, title, content) values(?, ?, ?)', ['1', 'asdasd', 'asdqweqwe']);
});

Route::get('/findwhere/{id}', function($id){
    $post = Post::where('id', $id)->orderBy('id', 'desc')->take(1)->get();

    return $post;
});

Route::get('/basicinsert', function(){

    $posts = new Post;

    $posts->title = 'muzan';
    $posts->user_id = '1';
    $posts->content = '123123213';

    $posts->save();

    return Post::all();
});

Route::get('/update', function(){
    return Post::where('id', 2)
        ->update(['title' => 'boss kenshin', 'content' => '09123123']);
});

Route::get('/delete/{id}', function($id){
    $posts = Post::find($id);

    return $posts->delete();
});

Route::get('/softdelete', function(){
    $posts = Post::find(1);

    return $posts->delete();
});

// One to one relationship

Route::get('/user/{id}/post', function($id){

    return User::find($id)->post;
});

Route::get('/post/{id}/user', function($id){

    return Post::find($id)->user;
});

// One to many relationship

Route::get('/posts/{id}', function($id){

    $posts = User::find($id)->posts;

    foreach($posts as $post){
        echo $post->title . '<br>';
    }
});

//Many to many relationship

Route::get('/user/{id}/role', function($id){

    $user = User::find($id);

    foreach($user->roles as $role){
        echo $role->name;
    }
});

Route::get('/user/pivot', function(){

    $user = User::find(1);

    foreach($user->roles as $role){
        echo $role->pivot->created_at;
    }
});

Route::get('/user/country', function(){

    $country = Country::find(2);

    foreach($country->posts as $post){
        return $post->title;
    }
});

Route::get('user/photos', function(){

    $user = User::find(1);

    foreach($user->photos as $photo){
        echo $photo->path . '<br>';
    }
});

Route::get('post/photos', function(){

    $post = Post::find(1);

    foreach($post->photos as $photo){
        echo $photo->path . '<br>';
    }
});

Route::get('/photo/{id}/post', function($id){
    
    $photo = Photo::findOrFail($id);

    return $photo->imageable;
});

// Polymorphic Many to many

Route::get('/post/tag', function(){

    $post = Post::find(1);

    foreach($post->tags as $tag){
        echo $tag->name;
    }
});

Route::get('/video/tag', function(){

    $post = Video::find(2);

    foreach($post->tags as $tag){
        echo $tag->name;
    }
});

Route::get('/tag/post', function(){

    $tag = Tag::find(2);

    foreach($tag->posts as $post){
        echo $post->title;
    }
});
