<?php

use App\Router;

$router = new Router();

// Feedback routes
$router->get('/feedbacks', 'FeedbackController@listFeedbacks');
$router->post('/feedbacks/add', 'FeedbackController@addFeedback');
$router->post('/feedbacks/edit', 'FeedbackController@editFeedback');
$router->post('/feedbacks/delete', 'FeedbackController@deleteFeedback');

// User routes
$router->get('/users', 'UserController@listUsers');
$router->post('/users/add', 'UserController@addUser');
$router->post('/users/edit', 'UserController@editUser');
$router->post('/users/delete', 'UserController@deleteUser');

