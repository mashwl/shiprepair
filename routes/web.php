<?php

use App\Livewire\BlogDetail;
use App\Livewire\ShowBlog;
use App\Livewire\ShowContactPage;
use App\Livewire\ShowFaqPage;
use App\Livewire\ShowHome;
use App\Livewire\ShowServiceDetail;
use App\Livewire\ShowServicePage;
use App\Livewire\ShowTeamPage;
use App\Livewire\StaticPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',ShowHome::class)->name('home');
Route::get('/services',ShowServicePage::class)->name('servicePage');
Route::get('/services/{id}',ShowServiceDetail::class)->name('serviceDetail');
Route::get('/team',ShowTeamPage::class)->name('teamPage');
Route::get('/blog',ShowBlog::class)->name('blog');
Route::get('/blog/{id}',BlogDetail::class)->name('blogDetail');
Route::get('/faq',ShowFaqPage::class)->name('faq');
Route::get('/page/{id}',StaticPage::class)->name('page');
Route::get('/contact',ShowContactPage::class)->name('contact');



