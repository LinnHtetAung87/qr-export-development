<?php

use App\Models\User;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\PDF;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubCateoryController;






Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    // Route::get('pdf',function(){
    // $data=[
    // 'product'=>Product::all()
    // ];
    // $pdf=PDF::loadView('admin.products.product-pdf',$data);
    // return $pdf->download('product-pdf.pdf');
    // });
    Route::get('product_pdf/{uuid}',[ProductController::class,'product_pdf'])->name('product_pdf');

    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/generate_pdf/{uuid}',[ProductController::class,'generatePDF'])->name('generate_pdf');

    Route::get('/remove_profile_photo/{user_id}', [ProfileController::class, 'removeProfilePhoto'])->name('remove_profile_photo');


    Route::resource('user',UserController::class);
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::resource('product',ProductController::class);




    Route::get('/remove-external-img/{id}',[ProductController::class,'removeImage'])->name('remove.image');
});