<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ResumeController;

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

Route::get('/', [HomeController::class, 'HomeIndex'])->middleware('LoginCheck');

Route::get('/visitor', [VisitorController::class, 'VisitorIndex'])->middleware('LoginCheck');

//admin panel service management routing. 
Route::get('/service', [ServiceController::class, 'ServiceIndex'])->middleware('LoginCheck');
Route::get('/getServicesData', [ServiceController::class, 'getServicesData'])->middleware('LoginCheck');
Route::post('/ServiceDelete', [ServiceController::class, 'ServiceDelete'])->middleware('LoginCheck');
Route::post('/getServicesDetails', [ServiceController::class, 'getServicesDetails'])->middleware('LoginCheck');
Route::post('/ServiceUpdate', [ServiceController::class, 'ServiceUpdate'])->middleware('LoginCheck');  
Route::post('/ServiceAdd', [ServiceController::class, 'ServiceAdd'])->middleware('LoginCheck'); 

//admin panel courses management routing. 
Route::get('/courses', [CoursesController::class, 'CoursesIndex'])->middleware('LoginCheck');
Route::get('/getCoursesData', [CoursesController::class, 'getCoursesData'])->middleware('LoginCheck');
Route::post('/CoursesDelete', [CoursesController::class, 'CoursesDelete'])->middleware('LoginCheck');
Route::post('/getCoursesDetails', [CoursesController::class, 'getCoursesDetails'])->middleware('LoginCheck');
Route::post('/CoursesUpdate', [CoursesController::class, 'CoursesUpdate'])->middleware('LoginCheck');  
Route::post('/CoursesAdd', [CoursesController::class, 'CoursesAdd'])->middleware('LoginCheck'); 

//admin panel projects management routing. 
Route::get('/projects', [ProjectsController::class, 'ProjectsIndex'])->middleware('LoginCheck');
Route::get('/getProjectData', [ProjectsController::class, 'getProjectData'])->middleware('LoginCheck');
Route::post('/ProjectDelete', [ProjectsController::class, 'ProjectDelete'])->middleware('LoginCheck');
Route::post('/ProjectDetails', [ProjectsController::class, 'getProjectDetails'])->middleware('LoginCheck');
Route::post('/ProjectUpdate', [ProjectsController::class, 'ProjectUpdate'])->middleware('LoginCheck'); 
Route::post('/ProjectAdd', [ProjectsController::class, 'ProjectAdd'])->middleware('LoginCheck'); 

//admin panel contact management routing. 
Route::get('/Contact', [ContactController::class, 'ContactIndex'])->middleware('LoginCheck');
Route::get('/getContactData', [ContactController::class, 'getContactData'])->middleware('LoginCheck');
Route::post('/ContactDelete', [ContactController::class, 'ContactDelete'])->middleware('LoginCheck');

//admin panel Review  management routing. 
Route::get('/Review', [ReviewController::class, 'ReviewIndex'])->middleware('LoginCheck');
Route::get('/getReviewData', [ReviewController::class, 'getReviewData'])->middleware('LoginCheck');
Route::post('/ReviewDelete', [ReviewController::class, 'ReviewDelete'])->middleware('LoginCheck');
Route::post('/ReviewAdd', [ReviewController::class, 'ReviewAdd'])->middleware('LoginCheck');
Route::post('/ReviewDetails', [ReviewController::class, 'getReviewDetails'])->middleware('LoginCheck');
Route::post('/ReviewUpdate', [ReviewController::class, 'ReviewUpdate'])->middleware('LoginCheck');



Route::get('/Login', [LoginController::class, 'LoginIndex']);
Route::post('/onLogin', [LoginController::class, 'onLogin']);
Route::get('/Logout', [LoginController::class, 'onLogout']);


Route::get('/Photo', [PhotoController::class, 'PhotoIndex'])->middleware('LoginCheck');
Route::post('/PhotoUpload', [PhotoController::class, 'PhotoUpload'])->middleware('LoginCheck');
Route::get('/PhotoJSON', [PhotoController::class, 'PhotoJSON'])->middleware('LoginCheck');
Route::get('/PhotoJSONByID/{id}', [PhotoController::class, 'PhotoJSONByID'])->middleware('LoginCheck');
Route::post('/PhotoDelete', [PhotoController::class, 'PhotoDelete'])->middleware('LoginCheck');

//Resume router...
Route::get('/Resume', [ResumeController::class, 'Resume'])->middleware('LoginCheck');







