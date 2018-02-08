<?php
Route::get('lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return \Redirect::back();
})->where([
    'lang' => 'en|es|fr|zh|pt|nl||ru|ja|de',
])->name('lang');



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {

    Route::get('langs/{lang}', 'langs\langssystem\langsController@index')
        ->where([
            'lang' => '[0-9a-z\-]+',
        ])
        ->name('langs');

    Route::post('translate/{lang}', 'langs\langssystem\langsController@translate')
        ->where([
            'lang' => '[0-9a-z\-]+',
        ])
        ->name('translate');
    Route::post('add', 'langs\langssystem\langsController@add')->name('translate.add');

    // Languages - URL: /admin/languages
    Route::resource('languages', 'langs\langssystem\LanguagesController');
    // Languages - URL: /admin/languages/create
    Route::post('languages/store', 'langs\langssystem\LanguagesController@store')->name('languages.store');

    Route::post('controlurislang', 'langs\langssystem\LanguagesController@controlurislang')->name('controlurislang');

});



