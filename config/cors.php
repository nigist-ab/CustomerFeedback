<?php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'], // Allow all paths
    'allowed_methods' => ['*'], // Allow all HTTP methods
    'allowed_origins' => ['http://127.0.0.1:8000', 'http://localhost'], // Add both origins
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];