<?php

Route::get('storage-link', function () {
    // Check if the symbolic link already exists
    if (file_exists(public_path('storage'))) {
        return 'The public storage is already linked.';
    }

    // Check if the 'symlink' function is available on this system
    if (! function_exists('symlink')) {
        return 'The symlink function is not available on this system.';
    }

    try {
        // Create the symbolic link between 'storage/app/public' and 'public/storage'
        symlink(storage_path('app/public'), public_path('storage'));

        return 'The public storage directory has been successfully linked.';
    } catch (Exception $e) {
        return 'An error occurred while creating the symbolic link: ' . $e->getMessage();
    }
});
