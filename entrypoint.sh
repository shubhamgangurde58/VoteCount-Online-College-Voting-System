#!/bin/bash

# Run migrations
php artisan migrate --force

# Create admin if not exists (optional safety check)
php artisan tinker --execute="if (!App\Models\Admin::where('username', 'admin')->exists()) { App\Models\Admin::create(['username' => 'admin', 'password' => Hash::make('password')]); }"

# Start Apache
apache2-foreground