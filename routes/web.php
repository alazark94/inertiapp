<?php /** @noinspection PhpUndefinedMethodInspection */

use App\Models\User;
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

Route::get('/', function () {
    return inertia('Home');
});
Route::get('/users', function () {
    return inertia('Users', [
        'users' => User::when(request('search'), function ($query, $search) {
            $query->where('name', 'like', "%$search%");
        })
            ->paginate(10)
            ->withQueryString()
            ->through(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ];
            }),
        'filters' => request()->only(['search'])
    ]);
});
Route::get('/settings', function () {
    return inertia('Settings');
});

Route::post('/logout', function () {
    dd('Logging the user out!');
});
