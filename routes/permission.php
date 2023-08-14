<?php

use App\Http\Controllers\PermissionController;

Route::resource('permissions', PermissionController::class);

// Route::delete('/permissions/group-permissions/{id}', [PermissionController::class, 'destroyGroupPermission'])->name('permissions.destroy.group-permission');
