<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

Route::get('/', [PostController::class, 'index'])->name('index');

Route::get('/search', [JobController::class, 'index'])->name('job.index');


//! Job seeker----------------------------------------------------------------------------------------------------------
Route::get('job-seeker/login', [LoginController::class, 'showJobSeekerLoginForm'])->name('login');
Route::post('job-seeker/login', [LoginController::class, 'jobSeekerLogin'])->name('jobseeker.loginNow');
Route::get('job-seeker/registration', [RegisterController::class,'showJobSeekerRegisterForm'])->name('jobseeker.registration');
Route::post('job-seeker/registration', [RegisterController::class,'createJobSeeker'])->name('jobseeker.register');

Route::get('job-seeker/overview', [JobSeekerController::class,'index'])->name('jobseeker.overview');
Route::get('job-seeker/cv', [JobSeekerController::class,'showCV'])->name('jobseeker.cv');
Route::get('job-seeker/password', [JobSeekerController::class,'changePasswordView'])->name('jobseeker.change.password');
Route::put('job-seeker/password', [JobSeekerController::class,'changePassword'])->name('jobseeker.change.password');
Route::get('job-seeker/saved-jobs', [JobSeekerController::class,'showCV'])->name('jobseeker.saved-job');
Route::get('job-seeker/deativate', [JobSeekerController::class,'deactive'])->name('jobseeker.deativate');
Route::delete('job-seeker/delete', [JobSeekerController::class,'deleteAccount'])->name('jobseeker.account.delete');
// Route::get('job-seeker/logout', [JobSeekerController::class,'index'])->name('jobseeker.logout');

//! Company--------------------------------------------------------------------------------------------------------------
Route::get('company/login', [LoginController::class, 'showCompanyLoginForm'])->name('company.login');
Route::post('company/login', [LoginController::class, 'companyLogin'])->name('company.loginNow');
Route::get('company/registration', [RegisterController::class,'showCompanyRegisterForm'])->name('company.registration');
Route::post('company/registration', [RegisterController::class,'createCompany'])->name('company.register');

Route::get('company/dashboard', [CompanyController::class,'overview'])->name('company.dashboard');
Route::get('company/overview', [CompanyController::class,'overview'])->name('company.overview');
Route::get('company/password', [CompanyController::class,'changePasswordView'])->name('company.change.password');
Route::put('company/password', [CompanyController::class,'changePassword'])->name('company.change.password');
Route::get('company/info', [CompanyController::class,'infoView'])->name('company.info');
Route::put('company/{id}', [CompanyController::class, 'update'])->name('company.update');
Route::get('company/upload', [CompanyController::class,'uploadView'])->name('company.upload');


//! Job-----------------------------------------------------------------------------------------------------------------

Route::get('logout/{guard}', function ($guard) {
        
        if($guard == 'jobseeker'){
                Auth::guard('jobseeker')-> logout();
                return redirect()->route('index');
        }
        if($guard == 'company'){
                Auth::guard('company')-> logout();
                return redirect()->route('index');
        }

});

