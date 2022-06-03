<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '',
    'namespace' => 'Cms\Modules\TodoList\Controllers',
    'middleware' => 'web',
], function() {

    Route::group([
        'middleware' => ['auth', 'cms.verified']
    ], function () {
        Route::get('todoList', 'TodoListController@getAll')->name('todoList.getAll');
        Route::post('todoList', 'TodoListController@store')->name('todoList.store');
        Route::get('todoList/edit/{id}', 'TodoListController@edit')->name('todoList.edit');
        Route::put('todoList/edit/{id}', 'TodoListController@update')->name('todoList.update');
        Route::delete('todoList/delete/{id}', 'TodoListController@delete')->name('todoList.delete');
    });

});
