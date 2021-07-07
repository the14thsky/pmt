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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('auth:sanctum');




Route::group(['middleware' => ['auth:sanctum', 'role:superadmin']], function () {

    Route::resource('users', 'UserController');

    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

    Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

    Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

    Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
    )->name('io_generator_builder_generate_from_file');

    Route::group(['prefix' => 'administration'], function () {
        Route::resource('orgRoles', 'Administration\OrgRoleController', ["as" => 'administration']);
        Route::resource('departments', 'Administration\DepartmentController', ["as" => 'administration']);
        Route::resource('deliverableTemplates', 'Administration\DeliverableTemplateController', ["as" => 'administration']);
        Route::resource('holidays', 'Administration\HolidayController', ["as" => 'administration']);
    });


});


Route::group(['middleware' => ['auth:sanctum', 'role:superadmin,super_sales_admin']], function () {
    Route::group(['prefix' => 'administration'], function () {
        Route::resource('budgetTemplates', 'Administration\BudgetTemplateController', ["as" => 'administration']);
    });
});

Route::group(['middleware' => ['auth:sanctum', 'role:superadmin,super_project_admin,project']], function () {

    Route::group(['prefix' => 'sales'], function () {
        Route::resource('projects', 'Sales\ProjectController', ["as" => 'sales']);
        Route::get('projects/assign/{id}', 'Sales\ProjectController@assign')->name('sales.projects.assign');
        Route::get('projects/milestone/{id}', 'Sales\ProjectController@milestones')->name('sales.projects.milestone');
        Route::post('projects/milestone/update', 'Sales\ProjectController@updateMilestone')->name('sales.projects.milestone.update');
        Route::resource('deliverables', 'Sales\DeliverableController', ["as" => 'sales']);
        Route::get('deliverables/create/{id}', 'Sales\DeliverableController@create')->name('sales.deliverables.customCreate');

    });

});

Route::group(['middleware' => ['auth:sanctum', 'role:superadmin,super_project_admin']], function () {

    Route::group(['prefix' => 'sales'], function () {

        Route::get('projects/assign/{id}', 'Sales\ProjectController@assign')->name('sales.projects.assign');
        Route::post('projects/assignusers/{projId}', 'Sales\ProjectController@assignUsers')->name('sales.projects.assignusers');
    });

});

Route::group(['middleware' => ['auth:sanctum', 'role:superadmin,super_sales_admin,sales']], function () {

    Route::group(['prefix' => 'sales'], function () {
        Route::resource('customers', 'Sales\CustomerController', ["as" => 'sales']);
        Route::resource('opportunities', 'Sales\OpportunityController', ["as" => 'sales']);
        Route::resource('engagements', 'Sales\EngagementController', ["as" => 'sales']);
        Route::get('engagements/create/{id}', 'Sales\EngagementController@create')->name('sales.engagements.customCreate');
    });

});

Route::group(['middleware' => ['auth:sanctum', 'role:superadmin,staff']], function () {

    Route::group(['prefix' => 'sales'], function () {

        Route::get('projects/timecharge/{id}', 'Sales\ProjectController@timecharge')->name('sales.projects.timecharge');
        Route::get('projects', 'Sales\ProjectController@index')->name('sales.projects.index');
    });

});




