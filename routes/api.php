<?php

use App\Actions\WelcomeAction;
use App\Actions\TodoAction;
use App\Actions\HealthCheckerAction;

route('welcome')
    ->get('/')
    ->uses(WelcomeAction::class, 'index')
    ->open();

// CRUD Routes
route('todos.index')
    ->get('/api/todos')
    ->uses(TodoAction::class, 'index')
    ->open();

route('todos.show')
    ->get('/api/todos/{id}')
    ->uses(TodoAction::class, 'show')
    ->open();

route('todos.store')
    ->post('/api/todos')
    ->uses(TodoAction::class, 'store')
    ->open();

route('todos.update')
    ->put('/api/todos/{id}')
    ->uses(TodoAction::class, 'update')
    ->open();

route('todos.destroy')
    ->delete('/api/todos/{id}')
    ->uses(TodoAction::class, 'destroy')
    ->open();

route('todos.bulk-update')
    ->patch('/api/todos/bulk-status')
    ->uses(TodoAction::class, 'bulkUpdateStatus')
    ->open();

route('health')
    ->get('/api/health')
    ->uses(HealthCheckerAction::class, 'index')
    ->open();
