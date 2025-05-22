<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;

use Illuminate\Support\Facades\Route;

//////////////////// admin routes //////////////////////////

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('GuestAdmin');
Route::post('/admin-login', [AdminController::class, 'Login'])->name('admin.login');
Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('Admin');
Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('Admin');



////////////////////// slider_routes /////////////////////////

Route::get('/add-slider', [AdminController::class, 'add_Slider'])->name('admin.add_slider')->middleware('Admin');
Route::post('/add-slider-post',[AdminController::class,'add_Slider_Post'])->name('admin.add_slider_post')->middleware('Admin');
Route::get('/edit-slider/{id}', [AdminController::class, 'edit_Slider'])->name('admin.edit_slider')->middleware('Admin');
Route::post('/update-slider', [AdminController::class, 'update_Slider'])->name('admin.update_slider')->middleware('Admin');
Route::get('/delete-slider/{id}',[AdminController::class,'delete_Slider'])->name('admin.delete_slider')->middleware('Admin');



/////////////////////// fontend routes /////////////////////////

Route::get('/',[UserController::class,'home'])->name('home');


 
////////////////////// trainer_routes /////////////////////////
Route::prefix('trainer')->group(function () {
    Route::get('/', [AdminController::class, 'trainerList'])->name('admin.trainer.list')->middleware('Admin');
    Route::get('/add', [AdminController::class, 'addTrainer'])->name('admin.trainer.add')->middleware('Admin');
    Route::post('/store', [AdminController::class, 'storeTrainer'])->name('admin.trainer.store')->middleware('Admin');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.trainer.edit')->middleware('Admin'); // Changed editTrainer to edit
    Route::post('/update/{id}', [AdminController::class, 'updateTrainer'])->name('admin.trainer.update')->middleware('Admin');
    Route::get('/delete/{id}', [AdminController::class, 'deleteTrainer'])->name('admin.trainer.delete')->middleware('Admin');
});


/////////////////////// branch ////////////////////////////////
// Branch routes
Route::get('admin/branch', [AdminController::class, 'branchIndex'])->name('branch.index');
Route::get('admin/branch/create', [AdminController::class, 'branchCreate'])->name('branch.create');
Route::post('admin/branch', [AdminController::class, 'branchStore'])->name('branch.store');
Route::get('admin/branch/{id}/edit', [AdminController::class, 'branchEdit'])->name('branch.edit');
Route::put('admin/branch/{id}', [AdminController::class, 'branchUpdate'])->name('branch.update');
Route::prefix('branch')->group(function () {
    // ... other branch routes ...
    Route::delete('/{id}', [AdminController::class, 'destroy'])
         ->name('branch.destroy');
});

// Sub Branch routes
Route::get('admin/sub-branch', [AdminController::class, 'subBranchIndex'])->name('sub_branch.index');
Route::get('admin/sub-branch/create', [AdminController::class, 'subBranchCreate'])->name('sub_branch.create');
Route::post('admin/sub-branch', [AdminController::class, 'subBranchStore'])->name('sub_branch.store');
Route::get('admin/sub-branch/{id}/edit', [AdminController::class, 'subBranchEdit'])->name('sub_branch.edit');
Route::put('admin/sub-branch/{id}', [AdminController::class, 'subBranchUpdate'])->name('sub_branch.update');
Route::delete('admin/sub-branch/{id}', [AdminController::class, 'subBranchDestroy'])->name('sub_branch.destroy');
// Add this to your routes/web.php
Route::post('/sub-branch/reset-ids', [AdminController::class, 'resetSubBranchIds'])
     ->name('sub_branch.reset_ids');
///////////////////////////////Gallery routes///////////////////////////////////////////
Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery.index')->middleware('Admin');
    Route::get('/create', [GalleryController::class, 'create'])->name('admin.gallery.create')->middleware('Admin');
    Route::post('/store', [GalleryController::class, 'store'])->name('admin.gallery.store')->middleware('Admin');
    Route::get('/edit/{id}', [GalleryController::class, 'edit'])->name('admin.gallery.edit')->middleware('Admin');
    Route::put('/update/{id}', [GalleryController::class, 'update'])->name('admin.gallery.update')->middleware('Admin');
    Route::delete('/delete/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy')->middleware('Admin');
Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery.index');
Route::get('/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

});
