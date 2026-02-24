<?php

use App\Livewire\Auth\Dashboard;
use App\Livewire\Auth\Pages\Create;
use App\Livewire\Auth\Pages\Delete;
use App\Livewire\Auth\Pages\Edit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);

Route::get('/mail', function () {
    return view('emails.post-form');
});

Route::get('/auth/dashboard', Dashboard::class);

Route::get('auth/pages', \App\Livewire\Auth\Pages\Pages::class)->middleware('auth');
Route::get('auth/pages/create', Create::class)->middleware('auth');
Route::get('auth/pages/edit/{id}', Edit::class)->middleware('auth');
Route::get('auth/pages/delete/{id}', Delete::class)->middleware('auth');

Route::get('auth/menu', \App\Livewire\Auth\Menu\Menu::class)->middleware('auth');
Route::get('auth/menu/create', \App\Livewire\Auth\Menu\Create::class)->middleware('auth');
Route::get('auth/menu/edit/{id}', \App\Livewire\Auth\Menu\Edit::class)->middleware('auth');
Route::get('auth/menu/delete/{id}', \App\Livewire\Auth\Menu\Delete::class)->middleware('auth');

Route::get('auth/impressions', \App\Livewire\Auth\Impression\Impression::class)->middleware('auth');
Route::get('auth/impressions/create', \App\Livewire\Auth\Impression\Create::class)->middleware('auth');
Route::get('auth/impressions/edit/{id}', \App\Livewire\Auth\Impression\Edit::class)->middleware('auth');
Route::get('auth/impressions/delete/{id}', \App\Livewire\Auth\Impression\Delete::class)->middleware('auth');

Route::get('auth/footer', \App\Livewire\Auth\Footer\Footer::class)->middleware('auth');

Route::get('auth/magazine', \App\Livewire\Auth\Magazine\Magazine::class)->middleware('auth');
Route::get('auth/settings', \App\Livewire\Auth\Setting\Setting::class)->middleware('auth');
//configurator kleuren
Route::get('auth/configurator/colorCategories', \App\Livewire\Auth\Configurator\ColorCategory\ColorCategory::class)->middleware('auth');
Route::get('auth/configurator/colorCategories/create', \App\Livewire\Auth\Configurator\ColorCategory\Create::class)->middleware('auth');
Route::get('auth/configurator/colorCategories/edit/{id}', \App\Livewire\Auth\Configurator\ColorCategory\Edit::class)->middleware('auth');
Route::get('auth/configurator/colorCategories/delete/{id}', \App\Livewire\Auth\Configurator\ColorCategory\Delete::class)->middleware('auth');

Route::get('auth/configurator/colorCategories/{id}/color', \App\Livewire\Auth\Configurator\ColorCategory\Color\Color::class)->middleware('auth');
Route::get('auth/configurator/colorCategories/{id}/color/create', \App\Livewire\Auth\Configurator\ColorCategory\Color\Create::class)->middleware('auth');
Route::get('auth/configurator/colorCategories/{id}/color/edit/{slug}', \App\Livewire\Auth\Configurator\ColorCategory\Color\Edit::class)->middleware('auth');
Route::get('auth/configurator/colorCategories/{id}/color/delete/{slug}', \App\Livewire\Auth\Configurator\ColorCategory\Color\Delete::class)->middleware('auth');


Route::get('auth/reviews', \App\Livewire\Auth\Review\Review::class)->middleware('auth');
Route::get('auth/reviews/create', \App\Livewire\Auth\Review\Create::class)->middleware('auth');
Route::get('auth/reviews/edit/{id}', \App\Livewire\Auth\Review\Edit::class)->middleware('auth');
Route::get('auth/reviews/delete/{id}', \App\Livewire\Auth\Review\Delete::class)->middleware('auth');


Route::get('auth/account', \App\Livewire\Auth\Account\Account::class)->middleware('auth');



route::get('impressions', function() {
    return view('livewire.frontend.blockcomponents.impressions');
});

route::get('reviews', function() {
    return view('livewire.frontend.blockcomponents.reviews');
});

route::get('contactForm', function() {
    return view('livewire.frontend.components.contact');
});

route::get('{slug?}', \App\Livewire\FrontEnd\Pagebuilder::class);



