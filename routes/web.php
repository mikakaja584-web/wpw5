<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

Route::get('/acara17/insert', function () {
    DB::table('users')->insert([
        'name' => 'John Query Builder',
        'email' => 'john-query-builder@example.com',
        'password' => bcrypt('password123')
    ]);

    return 'Data berhasil ditambahkan';
});

Route::get('/acara18/create', function () {
    $user = User::create([
        'name' => 'Eloquent User',
        'email' => 'eloquent@example.com',
        'password' => bcrypt('password123'),
    ]);

    return $user;
});

Route::get('/acara18/save', function () {
    $user = new User();

    $user->name = 'Save User';
    $user->email = 'save-user@example.com';
    $user->password = bcrypt('password123');

    $user->save();

    return $user;
});

Route::get('/acara18/all', function () {
    return User::all();
});

Route::get('/acara18/find', function () {
    return User::find(1);
});

Route::get('/acara18/where', function () {
    return User::where('name', 'Jane Doe')->get();
});

Route::get('/acara18/first-or-fail', function () {
    return User::where('email', 'johndoe@example.com')->firstOrFail();
});

Route::get('/acara18/update', function () {
    $user = User::where('email', 'janedoe@example.com')->first();

    $user->update([
        'name' => 'Jane Updated',
    ]);

    return $user;
});

Route::get('/acara18/save-update', function () {
    $user = User::where('email', 'johndoe@example.com')->first();

    $user->name = 'John Saved';

    $user->save();

    return $user;
});

Route::get('/acara18/delete', function () {
    $user = User::where('email', 'save-user@example.com')->first();

    $user->delete();

    return 'Data berhasil dihapus';
});

Route::get('/acara18/destroy', function () {
    User::destroy(5);

    return 'Data berhasil dihapus dengan destroy()';
});

Route::get('/acara19/where', function () {
    return User::where('name', 'Jane Updated')->get();
});

Route::get('/acara19/or-where', function () {
    return User::where('name', 'Jane Updated')
        ->orWhere('name', 'John Saved')
        ->get();
});

Route::get('/acara19/where-between', function () {
    return User::whereBetween('id', [1, 2])->get();
});

Route::get('/acara19/where-in', function () {
    return User::whereIn('id', [1, 2])->get();
});

Route::get('/acara19/where-null', function () {
    return User::whereNull('email_verified_at')->get();
});

Route::get('/acara19/where-not-null', function () {
    return User::whereNotNull('email_verified_at')->get();
});

Route::get('/acara19/when', function () {
    $name = 'John Saved';

    return User::when($name, function ($query, $name) {
        return $query->where('name', $name);
    })->get();
});

Route::get('/acara19/set-verified', function () {
    $user = User::find(4);

    $user->email_verified_at = now();
    $user->save();

    return $user;
});

Route::get('/acara19/one-to-one', function () {
    $user = User::find(1);

    $user->profile()->create([
        'bio' => 'Mahasiswa Teknik Informatika',
    ]);

    return $user->load('profile');
});

Route::get('/acara19/one-to-many', function () {
    $user = User::find(1);

    $user->posts()->createMany([
        ['title' => 'Belajar Laravel'],
        ['title' => 'Belajar Eloquent'],
    ]);

    return $user->load('posts');
});

Route::get('/acara19/many-to-many', function () {
    $user = User::find(1);

    $role1 = Role::create(['name' => 'Admin']);
    $role2 = Role::create(['name' => 'Editor']);

    $user->roles()->attach([$role1->id, $role2->id]);

    return $user->load('roles');
});

Route::get('/acara19/mutator-accessor', function () {
    $user = User::find(1);

    $user->name = 'Mika Eloquent';
    $user->save();

    return [
        'tersimpan_di_database' => $user->getRawOriginal('name'),
        'saat_diakses' => $user->name,
    ];
});

Route::get('/acara19/soft-delete', function () {
    $user = User::find(4);

    $user->delete();

    return [
        'message' => 'Data berhasil di-soft delete',
        'user' => $user,
    ];
});

Route::get('/acara19/with-trashed', function () {
    return User::withTrashed()->where('id', 4)->get();
});

Route::get('/acara19/only-trashed', function () {
    return User::onlyTrashed()->get();
});

Route::get('/acara19/restore', function () {
    $user = User::withTrashed()->find(4);

    $user->restore();

    return $user;
});

Route::get('/acara19/fillable', function () {
    $user = User::create([
        'name' => 'Fillable User',
        'email' => 'fillable@example.com',
        'password' => bcrypt('password123'),
    ]);

    return $user;
});

Route::get('/acara19/scope', function () {
    return User::active()->get();
});

Route::get('/form', function () {
    return view('form');
});

Route::post('/submit', [FormController::class, 'submitForm']);