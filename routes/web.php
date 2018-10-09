<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// We are using a Middleware that doesn't require configuration
// https://github.com/vluzrmos/lumen-cors
//$router->group(['middleware' => []], function () use ($router) {
//    $router->post('/users/login', ['uses' => 'UsersController@getToken']);
//});
//
$router->group(['middleware' => [], 'prefix' => 'api/v1'], function () use ($router) {
    // Projects
    $router->get('/projects', ['uses' => 'ProjectsController@getAll']);
    $router->get('/projects/{id}', ['uses' => 'ProjectsController@getProject']);
    $router->post('/projects', ['uses' => 'ProjectsController@createProject']);
    $router->put('/projects/{id}', ['uses' => 'ProjectsController@updateProject']);
    $router->delete('/projects/{id}', ['uses' => 'ProjectsController@deleteProject']);
// Issues
    $router->get('/issues', ['uses' => 'IssuesController@getAll']);
    $router->get('/issues/{id}', ['uses' => 'IssuesController@getIssue']);
    $router->post('/issues', ['uses' => 'IssuesController@createIssue']);
    $router->put('/issues/{id}', ['uses' => 'IssuesController@updateIssue']);
    $router->delete('/issues/{id}', ['uses' => 'IssuesController@deleteIssue']);
// Users
    $router->get('/users', ['uses' => 'UsersController@getAll']);
    $router->get('/users/{id}', ['uses' => 'UsersController@getUser']);
    $router->post('/users', ['uses' => 'UsersController@createUser']);
    $router->put('/users/{id}', ['uses' => 'UsersController@updateUser']);
    $router->put('/users/{id}/status', ['uses' => 'UsersController@updateUserStatus']);
    $router->delete('/users/{id}', ['uses' => 'UsersController@deleteUser']);
});