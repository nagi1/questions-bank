<?php

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


Route::get('ilos', function(){
    return view('main.ilos');
})->name('ilos');


Route::get('generator', 'ExamController@generator')->name('generator');


Route::post('generate_store', 'ExamController@generate_store')->name('generate.store');
Route::get('generate', 'ExamController@generate')->name('generate');

Route::post('other_generate_store', 'ExamController@generate_store')->name('other.generate.store');
Route::get('other_generate', 'ExamController@other_generate')->name('other.generate');


Route::get('ExamReport', 'ExamController@examReport')->name('exam.report');
Route::get('downloadExam', 'ExamController@download_exam')->name('exam.download');
Route::get('downloadOther', 'ExamController@download_other')->name('other.download');



Auth::routes();


Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index');

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
);

Route::resource('questionTypes', 'Question_typeController');

Route::resource('subjects', 'SubjectsController');

Route::resource('topics', 'TopicController');

Route::resource('exams', 'ExamController');

Route::resource('questions', 'QuestionController');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');
