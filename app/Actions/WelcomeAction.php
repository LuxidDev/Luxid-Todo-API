<?php
namespace App\Actions;

use App\Actions\LuxidAction;

class WelcomeAction extends LuxidAction
{
    public function index()
    {
        return $this->nova('welcome', [
            'title' => 'Welcome to Luxid Framework',
            'version' => '0.1.0',
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
