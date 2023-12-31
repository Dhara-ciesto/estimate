<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TermsAndConditionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ScentTypeController;
use App\Http\Controllers\FragranceToneController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  Route::get('/clear', function () {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        \Artisan::call('view:clear');
        return "Cleared!";
    });
Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::post('/postdata', [SubmissionController::class, 'store'])->name('submission.store');
    Route::post('/get-states', [SubmissionController::class, 'getStates'])->name('submission.getStates');
    Route::post('/get-cities', [SubmissionController::class, 'getCities'])->name('submission.getCities');

    Route::post('/submitdata', [IndexController::class, 'store'])->name('profile.store');
    Route::get('privacy-policy', [IndexController::class, 'privacyPolicy'])->name('privacy_policy');
    Route::get('payment-plan', [IndexController::class, 'paymentPlan'])->name('payment_plan');
    Route::get('terms-and-conditions', [IndexController::class, 'termsAndConditions'])->name('terms_and_conditions');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('dashboard', [SubmissionController::class, 'SubmissionDashboard'])->name('submission.dashboard');
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
    //product brands routes
    Route::get('product/brands', [ProductBrandController::class, 'index'])->name('product.brands.index');
    Route::get('product/brands/create', [ProductBrandController::class, 'create'])->name('product.brands.create');
    Route::post('product/brands/store', [ProductBrandController::class, 'store'])->name('product.brands.store');
    Route::get('product/brands/edit/{id}', [ProductBrandController::class, 'edit'])->name('product.brands.edit');
    Route::post('product/brands/edit/{id}', [ProductBrandController::class, 'update'])->name('product.brands.update');
    Route::get('product/brands/delete/{id}', [ProductBrandController::class, 'destroy'])->name('product.brands.destroy');
    Route::get('product/brands-server-side', [ProductBrandController::class, 'logsServerSideOwn'])->name('product.brands.server_side');
    Route::post('product/brands-changeStatus/{id}', [ProductBrandController::class, 'changeStatus'])->name('product.brands.change_status');

    //units routes
    Route::get('unit', [UnitController::class, 'index'])->name('unit.index');
    Route::get('unit/create', [UnitController::class, 'create'])->name('unit.create');
    Route::post('unit/store', [UnitController::class, 'store'])->name('unit.store');
    Route::get('unit/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
    Route::post('unit/edit/{id}', [UnitController::class, 'update'])->name('unit.update');
    Route::get('unit/delete/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');
    Route::get('unit-server-side', [UnitController::class, 'logsServerSideOwn'])->name('unit.server_side');

    //scent types routes
    Route::get('scent_types', [ScentTypeController::class, 'index'])->name('scent_types.index');
    Route::get('scent_types/create', [ScentTypeController::class, 'create'])->name('scent_types.create');
    Route::post('scent_types/store', [ScentTypeController::class, 'store'])->name('scent_types.store');
    Route::get('scent_types/edit/{id}', [ScentTypeController::class, 'edit'])->name('scent_types.edit');
    Route::post('scent_types/edit/{id}', [ScentTypeController::class, 'update'])->name('scent_types.update');
    Route::get('scent_types/delete/{id}', [ScentTypeController::class, 'destroy'])->name('scent_types.destroy');
    Route::get('scent_types-server-side', [ScentTypeController::class, 'logsServerSideOwn'])->name('scent_types.server_side');

    //Fragrence Tone routes
    Route::get('fragrance_tone', [FragranceToneController::class, 'index'])->name('fragrance_tone.index');
    Route::get('fragrance_tone/create', [FragranceToneController::class, 'create'])->name('fragrance_tone.create');
    Route::post('fragrance_tone/store', [FragranceToneController::class, 'store'])->name('fragrance_tone.store');
    Route::get('fragrance_tone/edit/{id}', [FragranceToneController::class, 'edit'])->name('fragrance_tone.edit');
    Route::post('fragrance_tone/edit/{id}', [FragranceToneController::class, 'update'])->name('fragrance_tone.update');
    Route::get('fragrance_tone/delete/{id}', [FragranceToneController::class, 'destroy'])->name('fragrance_tone.destroy');
    Route::get('fragrance_tone-server-side', [FragranceToneController::class, 'logsServerSideOwn'])->name('fragrance_tone.server_side');

     //scent types routes
     Route::get('product', [ProductController::class, 'index'])->name('product.index');
     Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
     Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
     Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
     Route::post('product/edit/{id}', [ProductController::class, 'update'])->name('product.update');
     Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
     Route::get('product-server-side', [ProductController::class, 'logsServerSideOwn'])->name('product.server_side');
     Route::post('product/changeStatus/{id}', [ProductController::class, 'changeStatus'])->name('product.change_status');
     Route::get('product/selected/delete', [ProductController::class, 'destroySelected'])->name('product.destroy.selected');
     Route::get('product/view/{id}', [ProductController::class, 'show'])->name('product.show');

     //Fragrence Tone routes
    Route::get('campaign', [CampaignController::class, 'index'])->name('campaign.index');
    Route::get('campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
    Route::post('campaign/store', [CampaignController::class, 'store'])->name('campaign.store');
    Route::get('campaign/edit/{id}', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::post('campaign/edit/{id}', [CampaignController::class, 'update'])->name('campaign.update');
    Route::get('campaign/delete/{id}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
    Route::get('campaign-server-side', [CampaignController::class, 'logsServerSideOwn'])->name('campaign.server_side');

     //scent types routes
     Route::get('order', [OrderController::class, 'index'])->name('order.index');
     Route::get('order/create', [OrderController::class, 'create'])->name('order.create');
     Route::post('order/store', [OrderController::class, 'store'])->name('order.store');
     Route::get('order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
     Route::post('order/edit/{id}', [OrderController::class, 'update'])->name('order.update');
     Route::get('order/delete/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
     Route::get('order-server-side', [OrderController::class, 'logsServerSideOwn'])->name('order.server_side');
     Route::post('order/changeStatus/{id}', [OrderController::class, 'changeStatus'])->name('order.change_status');
     Route::get('order/selected/delete', [OrderController::class, 'destroySelected'])->name('order.destroy.selected');
     Route::get('order/view/{id}', [OrderController::class, 'show'])->name('order.show');
     Route::get('order/print/{id}', [OrderController::class, 'print'])->name('order.print');


    // Route::get('client', [ClientController::class, 'index'])->name('client.index');
    // Route::get('client/create', [ClientController::class, 'create'])->name('client.create');
    // Route::post('client/create', [ClientController::class, 'store'])->name('client.store');
    // Route::get('client-server-side', [ClientController::class, 'logsServerSideOwn'])->name('client.server_side');
    // Route::get('client/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    // Route::post('client/edit/{id}', [ClientController::class, 'update'])->name('client.update');
    // Route::get('client/delete/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

    // Route::get('manager', [ManagerController::class, 'index'])->name('manager.index');
    // Route::get('manager/create', [ManagerController::class, 'create'])->name('manager.create');
    // Route::post('manager/create', [ManagerController::class, 'store'])->name('manager.store');
    // Route::get('manager-server-side', [ManagerController::class, 'logsServerSideOwn'])->name('manager.server_side');
    // Route::get('manager/edit/{id}', [ManagerController::class, 'edit'])->name('manager.edit');
    // Route::post('manager/edit/{id}', [ManagerController::class, 'update'])->name('manager.update');
    // Route::get('manager/delete/{id}', [ManagerController::class, 'destroy'])->name('manager.destroy');


    // Route::get('submitted-candidates', [DashboardController::class, 'profile_listing'])->name('profile_listing');
    // // Route::get('dashboard', [DashboardController::class, 'profile_listing'])->name('profile_listing');
    // Route::get('server-side', [DashboardController::class, 'submissionAjax'])->name('submission-server-side');
    // Route::get('submission/view/{id}', [DashboardController::class, 'show'])->name('admin.submission.view');
    // Route::get('submission/edit/{id}', [SubmissionController::class, 'edit'])->name('admin.submission.edit');
    // Route::post('submission/edit/{id}', [SubmissionController::class, 'update'])->name('admin.submission.edit');
    // Route::get('submission/delete/{id}', [DashboardController::class, 'destroy'])->name('admin.submission.destroy');
    // Route::get('submission/exports', [SubmissionController::class, 'export'])->name('submission.export');
    // Route::get('submission/zip-download/{id}', [SubmissionController::class, 'zipDownload'])->name('submission.zip-download');

    Route::get('server-side-old', [IndexController::class, 'logsServerSideOwn'])->name('bt-server-side');
    Route::get('view/{id}', [IndexController::class, 'show'])->name('profile_view');
    Route::get('dashboard-data/exports', [IndexController::class, 'export'])->name('dashboard.export');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

    //Update User Details
    Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

    // user controller
    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('users/create', [UserController::class, 'store'])->name('user.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('users/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('users-server-side', [UserController::class, 'logsServerSideOwn'])->name('user.server_side');
    Route::get('users/exports', [UserController::class, 'export'])->name('user.export');
    Route::get('users/change-password', [UserController::class, 'changePassword'])->name('user.change_password');
    Route::post('users/change-password', [UserController::class, 'changePasswordStore'])->name('user.change_password.store');
    // // Privacy Policy
    // Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy');
    // Route::post('privacy-policy', [PrivacyPolicyController::class, 'store'])->name('privacy-policy');
    // // Terms and Conditions
    // Route::get('terms-and-condition', [TermsAndConditionController::class, 'index'])->name('terms-and-condition');
    // Route::post('terms-and-condition', [TermsAndConditionController::class, 'store'])->name('terms-and-condition');

    // Route::get('submission', [SubmissionController::class, 'index'])->name('submission.index');
    // Route::get('submission-by-company-ajax', [SubmissionController::class, 'submissionByCompanyAjax'])->name('submission.submissionByCompanyAjax');
    // Route::get('submission-by-recruiter-ajax', [SubmissionController::class, 'submissionByRecruiterAjax'])->name('submission.submissionByRecruiterAjax');

    // // City
    // Route::get('city', [CityController::class, 'index'])->name('city.index');
    // Route::get('city/create', [CityController::class, 'create'])->name('city.create');
    // Route::post('city/create', [CityController::class, 'store'])->name('city.store');
    // Route::get('city-server-side', [CityController::class, 'logsServerSideOwn'])->name('city.server_side');
    // Route::get('city/edit/{id}', [CityController::class, 'edit'])->name('city.edit');
    // Route::post('city/edit/{id}', [CityController::class, 'update'])->name('city.update');
    // Route::get('city/delete/{id}', [CityController::class, 'destroy'])->name('city.destroy');

    // // Area
    // Route::get('area', [AreaController::class, 'index'])->name('area.index');
    // Route::get('area/create', [AreaController::class, 'create'])->name('area.create');
    // Route::post('area/create', [AreaController::class, 'store'])->name('area.store');
    // Route::get('area-server-side', [AreaController::class, 'logsServerSideOwn'])->name('area.server_side');
    // Route::get('area/edit/{id}', [AreaController::class, 'edit'])->name('area.edit');
    // Route::post('area/edit/{id}', [AreaController::class, 'update'])->name('area.update');
    // Route::get('area/delete/{id}', [AreaController::class, 'destroy'])->name('area.destroy');
    Route::get('/sendMessage', [App\Http\Controllers\api\AuthController::class, 'sendMessage'])->name('sendMessage');

    // Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('sendmail', [App\Http\Controllers\EmailController::class, 'sendEmail']);
    Route::any('emailconfig', [App\Http\Controllers\EmailController::class, 'emailConfig'])->name('email.config');

});
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

