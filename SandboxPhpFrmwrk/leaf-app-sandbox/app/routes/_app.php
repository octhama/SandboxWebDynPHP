<?php

app()->get('/', function () {
    /**
     * `render(view, [])` is the same as `echo view(view, [])`
     */
    render('index');
});

app()->get('/about', 'MainController@about');

app()->get('/contact', 'MainController@contact');

app()->get('/customer', 'CustomerController@index');

app()->get('/customer/create', 'CustomerController@create');

app()->get('/customer/{id}', 'CustomerController@show');

app()->get('/customer/{id}/edit', 'CustomerController@edit');

app()->post('/customer', 'CustomerController@store');

app()->put('/customer/{id}', 'CustomerController@update');

app()->delete('/customer/{id}', 'CustomerController@destroy');

app()->get('/customer/search', 'CustomerController@search');

app()->get('/customer/sort', 'CustomerController@sort');

app()->get('/customer/filter', 'CustomerController@filter');

app()->get('/customer/{id}/destroy', 'CustomerController@destroy');

app()->get('/customer/{id}/delete', 'CustomerController@destroy');


