<?php

Route::get('/', 'HomeController@index');

//FOLDERS
Route::resource('folders', 'FoldersController', ['except' => ['destroy', 'create']]);
Route::post('/folders/users/{id}', 'FoldersController@assign_folder');
Route::post('foldersAll', 'FoldersController@foldersAll');

//FILES
Route::get('/files/recent', 'FilesController@recent');
Route::post('copy-items', 'FileCopyController@copy');
Route::post('/files/users/{id}', 'FilesController@assign_file');
Route::put('files/updateAll', 'FilesController@updateAll');
Route::resource('files', 'FilesController', ['except' => ['destroy', 'create']]);

//DOWNLOAD
Route::post('create-download', 'ItemsDownloadController@createDownload');
Route::get('download-zip/{fileName}', 'ItemsDownloadController@downloadZip');
Route::get('download-file/{id}', 'ItemsDownloadController@downloadFile');

//PAYMENTS
Route::post('payments/upgrade', 'PaymentsController@upgrade');
Route::post('payments/unsubscribe', 'PaymentsController@unsubscribe');
Route::get('payments/plans', 'PaymentsController@getPlans');
Route::post('payments/swap-plan', 'PaymentsController@swapPlan');
Route::post('payments/resume', 'PaymentsController@resumeSubscription');
Route::post('payments/add-new-card', 'PaymentsController@addNewCard');
Route::get('payments/invoices', 'PaymentsController@getInvoices');
Route::get('payments/download-invoice/{id}', 'PaymentsController@downloadInvoice');

//MOVE
Route::post('move-items', 'ItemsMoveController@move');
Route::get('test', 'ItemsMoveController@test');

//DELETE
Route::post('delete-items', 'DeleteItemsController@delete');

//TRASH
Route::get('user-trash', 'TrashController@getUserTrash');
Route::post('trash/restore', 'TrashController@restore');
Route::post('trash/put', 'TrashController@put');

//SEND LINKS VIA EMAIL
Route::post('send-links', 'SendLinksController@send');

//USERS
Route::get('users/space-usage', 'UsersController@getSpaceUsage');
Route::resource('users', 'UsersController', ['only' => ['update', 'index', 'destroy']]);
Route::get('users/lists', 'ChatController@lists');
Route::get('permission/users', 'UsersController@permission');
Route::post('users/{id}', 'UsersController@update');
Route::post('users', 'UsersController@destroyAll');
Route::post('users/{id}/avatar', 'AvatarController@change');
Route::delete('users/{id}/avatar', 'AvatarController@remove');

// Locations
Route::resource('locations', 'LocationsController');
Route::post('locations/update/{id}', 'LocationsController@update');
Route::post('delete/locations', 'LocationsController@destroyAll');

//Roles
Route::resource('roles', 'RolesController');
Route::post('roles/{id}', 'RolesController@update');
Route::post('delete/roles', 'RolesController@destroyAll');
Route::get('roles/lists', 'RolesController@lists');

//Chat
Route::resource('chat', 'ChatController');
Route::post('chat/{id}', 'ChatController@update');
Route::get('chat/lists', 'ChatController@lists');
Route::get('message/lists', 'ChatController@messages');
Route::post('delete/chat', 'ChatController@destroyAll');

//STATS
Route::get('stats', 'StatsController@analytics');

//Settings
Route::post('settings', 'SettingsController@updateSettings');
Route::get('settings', 'SettingsController@getAllSettings');
Route::get('settings/ini/max_upload_size', ['uses' => 'SettingsController@serverMaxUploadSize']);

//ACTIVITY
Route::resource('activity', 'ActivityController', ['only' => ['store', 'index', 'destroy']]);

//SEARCH
Route::get('search/{query}', 'SearchController@findFoldersAndPhotos');

//SOCIAL AUTHENTICATION
Route::get('auth/social/{provider}', 'SocialAuthController@connectToProvider');
Route::get('auth/social/{provider}/login', 'SocialAuthController@loginCallback');
Route::post('auth/social/request-email-callback', 'SocialAuthController@requestEmailCallback');
Route::post('auth/social/connect-accounts', 'SocialAuthController@connectAccounts');

//LABELS
Route::post('labels/attach', 'LabelsController@attach');
Route::post('labels/detach', 'LabelsController@detach');
Route::get('labels/{label}', 'LabelsController@getItemsLabeled');

//shareable (folder or photo)
Route::post('shareable-password/add', 'ShareableController@addPassword');
Route::post('shareable-password/remove', 'ShareableController@removePassword');
Route::post('shareable-password/check', 'ShareableController@checkPassword');
Route::post('shareable/preview', 'ShareableController@show');

Route::post('password/change', 'Auth\PasswordChangeController@change');

Route::controllers([
	'auth' => 'AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('user-file/{shareId}', 'UserFileController@show');

if (IS_DEMO) {
    Route::get('delete-old-accounts', 'OldAccountsDeleteController@delete');
}