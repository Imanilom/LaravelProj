<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kalkulatorController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\CabaiController;
use App\Http\Controllers\hasilAdminController;
use App\Http\Controllers\SensorAdminController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\FotoController;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home'])->name('beranda');
	Route::get('beranda', function () {
		return view('beranda');
	})->name('beranda');

	//ADMIN
	Route::middleware(['role:admin'])->group(function () {
		Route::get('/beranda', [adminController::class, 'index']);
		Route::get('/beranda/{user}', [adminController::class, 'beranda'])->name('beranda');
		Route::get('/user-management', [adminController::class, 'show']);

		// ADD USER
		Route::get('/user-management/add', [adminController::class, 'UserForm']);
		Route::post('/user-management/add', [RegisterController::class, 'store'])->name('user');

		// EDIT USER
		Route::get('/user-management/{id}/edit', [adminController::class, 'editUser'])->name('id');

		// REMOVE USER
		Route::delete('/user-management/{id}/remove', [adminController::class, 'destroy'])->name('id');
        
        Route::get('/hasil-admin', [hasilAdminController::class, 'index'])->name('hasil-admin');

	});

	//USER

	Route::get('kalkulator', function () {
		return view('kalkulator/kalkulator');
	})->name('kalkulator');

	Route::get('detail', function () {
		return view('kalkulator/detail');
	})->name('detail');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('uploads', function () {
		return view('upload/index');
	})->name('upload');

	Route::get('hasil', function () {
		return view('kalkulator/hasil');
	});
	Route::get('hasil', function () {
		return view('kalkulator/hasil');
	});

	Route::middleware(['role:user'])->group(function () {
		Route::get('password', [SessionsController::class, 'password'])->name('Ubah Password');
		Route::post('password', [SessionsController::class, 'password_action'])->name('password.action')->name('Ubah Password');
		Route::get('/change-password', [ChangePasswordController::class, 'changePassForm'])->name('password.changeForm');
		Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('password.change');
	});
	// Route::middleware(['role:user'])->group(function() {
	// 	Route::get('kalkulator', function () {
	// 		return view('kalkulator/kalkulator');
	// 	})->name('kalkulator');
	// 	Route::get('detail', function () {
	// 		return view('kalkulator/detail');
	// 	})->name('detail');

	//ADMIN - User Management
	Route::get('/user-management', [adminController::class, 'show'])->middleware('role:admin');
	// ADD USER
	Route::get('/user-management/add', [adminController::class, 'addUserForm'])->middleware('role:admin');
	Route::post('/user-management', [adminController::class, 'addUser'])->middleware('role:admin');

	//
	Route::get('kalkulator', function () {
		return view('kalkulator/kalkulator');
	})->name('kalkulator');

	Route::get('detail', function () {
		return view('kalkulator/detail');
	})->name('detail');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/upload-lahan', [UploadController::class, 'index'])->name('upload-lahan');

	Route::get('upload-drone', function () {
		return view('drone.index');
	})->name('upload-drone');

	Route::get('/drone', [DroneController::class, 'index'])->name('upload-drone');

	Route::delete('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('beranda');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	// Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//     Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// });

//kalkulatorkalkulators
Route::resource('kalkulators', kalkulatorController::class);
Route::get('/kalkulators', [KalkulatorController::class, 'index'])->name('kalkulators');



// Route::get('/admin/hasil-admin', [KalkulatorController::class, 'showForAdmin'])->name('hasil');

Route::resource('cabai', CabaiController::class);

//DetailCOntroller
Route::get('/detail/{id}', [KalkulatorController::class, 'show2']);
Route::get('/sop/{id}', [KalkulatorController::class, 'show3']);





Route::get('hasil', function () {
	return view('kalkulator/hasil');
});

Route::get('/beranda', [HomeController::class, 'home'])->name('beranda');
Route::get('/admin', [adminController::class, 'index'])->name('admin')->middleware('role:admin');

Route::resource('sensor', SensorController::class);
Route::get('/sensor-admin', [SensorAdminController::class, 'index']);
// Tambahkan route ini di web.php
Route::get('/sensor/{id}', [App\Http\Controllers\SensorController::class, 'show'])->name('sensor.show');

Route::get('/sensor-admin/{user}', [SensorAdminController::class, 'show'])->name('sensor-admin.show');




//Upload Gambar lahan
Route::middleware(['auth'])->group(function () {
	Route::get('/uploads/create', [UploadController::class, 'create'])->name('posts.create');
	Route::post('/uploads', [UploadController::class, 'store'])->name('posts.store');
});

Route::resource('uploads', UploadController::class);
Route::get('/uploads', [UploadController::class, 'index'])->name('uploads');


Route::middleware('auth')->group(function () {
	Route::resource('uploads', UploadController::class);
});

Route::middleware(['auth'])->group(function () {
	Route::get('/drones/create', [DroneController::class, 'create'])->name('drones.create');
	Route::post('/drones', [DroneController::class, 'store'])->name('drones.store');
});;

Route::resource('drones', DroneController::class);
Route::get('/drones', [DroneController::class, 'index'])->name('drones');

Route::get('/drone/index', [DroneController::class, 'index'])->name('drones');

Route::get('/drone/create', [DroneController::class, 'index'])->name('createdrones');
Route::middleware('auth')->group(function () {
	Route::resource('drones', DroneController::class);
});
Route::post('/sop/update-status/{id}', [SopController::class, 'updateStatus'])->name('sop.updateStatus');

    Route::get('sop', function () {
		return view('sop');
	})->name('tesSop');

Route::middleware(['auth'])->group(function () {
	Route::get('/petas/create', [PetaController::class, 'create'])->name('petas.create');
	Route::post('/petas', [PetaController::class, 'store'])->name('petas.store');
});;

Route::resource('petas', PetaController::class);
Route::get('/petas', [PetaController::class, 'index'])->name('petas');

Route::get('/peta/index', [PetaController::class, 'index'])->name('petas');

Route::get('/peta/create', [PetaController::class, 'index'])->name('createpetas');
Route::middleware('auth')->group(function () {
	Route::resource('petas', PetaController::class);
});

// lahan
Route::resource('lahan', LahanController::class)->middleware('auth');

// Upload Foto

Route::post('/foto', [FotoController::class, 'store'])->name('foto.store');
Route::get('/fotos/{foto}/edit', [FotoController::class, 'edit'])->name('foto.edit');
Route::delete('/fotos/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');
Route::put('/fotos/{foto}', [FotoController::class, 'update'])->name('foto.update');

// beranda


// Sensor Endpoint

use App\Http\Controllers\SensorDataController;

Route::post('/sensor-data', [SensorDataController::class, 'store']);




