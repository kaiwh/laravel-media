/*
 *  Media
 */
$router->get('media', 'MediaController@index')->name('desktop.media');
$router->get('media/{id}', 'MediaController@show')->name('desktop.media.show');
