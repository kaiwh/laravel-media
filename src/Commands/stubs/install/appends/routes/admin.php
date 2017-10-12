/*
 *  Media Category
 */
Route::get('media/category', 'MediaCategoryController@index')->name('admin.media.category.index');
Route::get('media/category/create', 'MediaCategoryController@create')->name('admin.media.category.create');
Route::post('media/category/create', 'MediaCategoryController@store')->name('admin.media.category.create');
Route::get('media/category/{id}/edit', 'MediaCategoryController@edit')->name('admin.media.category.edit');
Route::post('media/category/{id}/edit', 'MediaCategoryController@update')->name('admin.media.category.edit');
Route::get('media/category/{id}/destroy', 'MediaCategoryController@destroy')->name('admin.media.category.destroy');
/*
 *  Media
 */
Route::get('media', 'MediaController@index')->name('admin.media.index');
Route::get('media/create', 'MediaController@create')->name('admin.media.create');
Route::post('media/create', 'MediaController@store')->name('admin.media.create');
Route::get('media/{id}/edit', 'MediaController@edit')->name('admin.media.edit');
Route::post('media/{id}/edit', 'MediaController@update')->name('admin.media.edit');
Route::get('media/{id}/destroy', 'MediaController@destroy')->name('admin.media.destroy');
