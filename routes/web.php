<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'showRegisterForm')->name('register');
    Route::post('register', 'register');
});
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login/prosesForm', [LoginController::class, 'login'])->name('login.prosesForm');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
// Home route with 'auth' middleware and role check (Laratrust)
Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

// Grouping Management User routes under 'management/users'
Route::prefix('management/users')
    ->middleware('auth')
    ->as('management.users.') // Set a name prefix for all routes in this group
    ->group(function () {
        // User Management Dashboard
        Route::get('/', [UserController::class, 'index'])
            ->name('index'); // 'management.users.index'

        // Fetching user data for DataTables
        Route::get('/data', [UserController::class, 'getUsersData'])
            ->name('data'); // 'management.users.data'

        // Store user data (create/update)
        Route::post('/store', [UserController::class, 'store'])
            ->name('store'); // 'management.users.store'

        // Edit user data by ID
        Route::get('/{id}/edit', [UserController::class, 'edit'])
            ->name('edit'); // 'management.users.edit'

        // Delete user data by ID
        Route::delete('/{id}', [UserController::class, 'destroy'])
            ->name('destroy'); // 'management.users.destroy'

        // Change user password
        Route::post('/change-password', [UserController::class, 'changePassword'])
            ->name('changePassword'); // 'management.users.changePassword'

        // User profile
        Route::get('/profile', [UserController::class, 'profile'])
            ->name('profile'); // 'management.users.profile'
    });

Route::prefix('students')
    ->middleware('auth')
    ->as('students.') // Set a name prefix for all routes in this group
    ->group(function () {
        // User Management Dashboard
        Route::get('/', [StudentController::class, 'index'])
            ->name('index'); // 'management.users.index'

        // Fetching user data for DataTables
        Route::get('/data', [StudentController::class, 'data'])
            ->name('data'); // 'management.users.data'

        // Store user data (create/update)
        Route::post('/store', [StudentController::class, 'store'])
            ->name('store'); // 'management.users.store'

        Route::post('/update', [StudentController::class, 'update'])
            ->name('update'); // 'management.users.store'

        // Edit user data by ID
        Route::get('/{id}/edit', [StudentController::class, 'edit'])
            ->name('edit'); // 'management.users.edit'

        // Delete user data by ID
        Route::delete('/{id}', [StudentController::class, 'destroy'])
            ->name('destroy'); // 'management.users.destroy'

        // Change user password

    });

Route::prefix('teachers')
    ->middleware('auth')
    ->as('teachers.') // Set a name prefix for all routes in this group
    ->group(function () {
        // Teacher Management Dashboard
        Route::get('/', [TeacherController::class, 'index'])
            ->name('index'); // 'teachers.index'

        // Fetching teacher data for DataTables
        Route::get('/data', [TeacherController::class, 'data'])
            ->name('data'); // 'teachers.data'

        // Store teacher data (create/update)
        Route::post('/store', [TeacherController::class, 'store'])
            ->name('store'); // 'teachers.store'

        Route::post('/update', [TeacherController::class, 'update'])
            ->name('update'); // 'teachers.update'

        // Edit teacher data by ID
        Route::get('/{id}/edit', [TeacherController::class, 'edit'])
            ->name('edit'); // 'teachers.edit'

        // Delete teacher data by ID
        Route::delete('/{id}', [TeacherController::class, 'destroy'])
            ->name('destroy'); // 'teachers.destroy'

        // Change teacher password or any additional routes you need
    });

Route::prefix('kelas')
    ->middleware('auth')
    ->as('kelas.') // Set a name prefix for all routes in this group
    ->group(function () {
        // Teacher Management Dashboard
        Route::get('/', [KelasController::class, 'index'])
            ->name('index'); // 'teachers.index'

        // Fetching teacher data for DataTables
        Route::get('/data', [KelasController::class, 'data'])
            ->name('data'); // 'teachers.data'

        // Store teacher data (create/update)
        Route::post('/store', [KelasController::class, 'store'])
            ->name('store'); // 'teachers.store'

        Route::post('/update', [KelasController::class, 'update'])
            ->name('update'); // 'teachers.update'

        // Edit teacher data by ID
        Route::get('/{id}/edit', [KelasController::class, 'edit'])
            ->name('edit'); // 'teachers.edit'

        Route::get('/show', [KelasController::class, 'show'])
            ->name('show'); // 'teachers.edit'

        // Delete teacher data by ID
        Route::delete('/{id}', [KelasController::class, 'destroy'])
            ->name('destroy'); // 'teachers.destroy'

        // Change teacher password or any additional routes you need
    });
// Role management routes

Route::prefix('roles')
    ->middleware('auth')
    ->as('roles.')
    ->group(function () {
        // Fetch roles data
        Route::get('/getRoles', [RoleController::class, 'getRoles'])->name('getRoles');
        Route::get('/data', [RoleController::class, 'data'])->name('data');

        // Standard CRUD routes for Roles
        Route::resource('/', RoleController::class)->parameters(['' => 'role'])->except(['show']);
    });

Route::prefix('schoolprofile')
    ->middleware('auth')
    ->as('schoolprofile.')
    ->group(function () {
        Route::get('/index', [SekolahController::class, 'showProfile'])->name('index');

        // Use the same route for storing and updating
        Route::post('/save', [SekolahController::class, 'save'])->name('save');
        Route::get('/get', [SekolahController::class, 'getProfile'])->name('getProfile');

    });



Route::prefix('permissions')
    ->middleware(['auth'])  // Middleware to ensure the user is authenticated
    ->as('permissions.')    // Route name prefix for easier reference
    ->group(function () {
        Route::resource('/', PermissionController::class)->except(['show'])->parameters(['' => 'permission']);

        // Additional route for DataTables AJAX request
        Route::get('/data', [PermissionController::class, 'data'])->name('data');
    });


Route::prefix('suppliers')
    ->middleware(['auth']) // Ensure user authentication
    ->as('suppliers.')     // Route name prefix for suppliers
    ->group(function () {
        // Route for importing suppliers via CSV/XLSX
        Route::post('/import', [UserController::class, 'import'])->name('import');
    });

Route::post('/upload', [UploadController::class, 'upload']);




// Profile Picture management routes
Route::post('/upload-profile-picture', [ProfileController::class, 'uploadProfilePicture']);
Route::post('/remove-profile-picture', [ProfileController::class, 'removePicture'])
    ->name('remove.profile.picture');

// Verify Superadmin password route
Route::post('/verify-superadmin-password', [UserController::class, 'verifySuperadminPassword'])
    ->name('management.verifySuperadminPassword');