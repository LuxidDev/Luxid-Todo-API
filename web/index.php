<?php
// Luxid Framework - Web Entry Point

require_once __DIR__ . '/../vendor/autoload.php';

use Luxid\Foundation\Application;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Load configuration
$config = require_once __DIR__ . '/../config/config.php';

// Create application instance
$app = new Application(dirname(__DIR__), $config);

// Load routes
require_once __DIR__ . '/../routes/api.php';

// Run the application
$app->run();
