<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\ReplyController;
use App\Http\Controllers\Api\StripeController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\MicroBlogController;
use App\Http\Controllers\Api\DealActivityController;
use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\Api\MicroBlogReportController;
use App\Http\Controllers\Api\ReportingReasonsController;
use App\Http\Controllers\Api\Auth\DealOwnerAuthController;
use App\Http\Controllers\Api\MicroBlogFavouriteController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

##### AUTH #####
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/store/student-email/{id}', [AuthController::class, 'storeStudentEmail']);
Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/verify-student-email', [AuthController::class, 'verifyStudentEmail']);
Route::post('/user/resend-otp-code', [AuthController::class, 'resendOTPCode']);
Route::post('/user/forgot-password', [AuthController::class, 'sendPasswordResetLinkEmail']);
Route::post('/user/password-reset', [AuthController::class, 'resetPassword']);
Route::post('/user/verify/inbound/email/{id}', [AuthController::class, 'verifyInboundEmail']);
Route::get('/get-student-email-by-id/{id}', [AuthController::class, 'getStudentEmailById']);

Route::post('/admin/register', [AdminAuthController::class, 'register']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/do/register', [DealOwnerAuthController::class, 'register']);
Route::post('/do/login', [DealOwnerAuthController::class, 'login']);

##### DEALS #####
Route::get('/deals', [DealController::class, 'index']);
Route::get('/do/deals/{id}', [DealController::class, 'show']);
Route::get('/user/deals/{id}', [DealController::class, 'showWithFavourite']);

##### CATEGORIES #####
Route::get('/admin/categories', [CategoryController::class, 'index']);
Route::get('/admin/categories/{id}', [CategoryController::class, 'show']);

##### MICRO BLOG #####
Route::get('/micro-blog', [MicroBlogController::class, 'index']);

##### REPORTING REASONS #####
Route::get('/reporting-reason', [ReportingReasonsController::class, 'index']);

##### User #####
Route::middleware(['auth:sanctum', 'type.user'])->group(function() {
    ##### USER #####
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::post('/user/update/{id}', [AuthController::class, 'update']);

    ##### FAVOURITES #####
    Route::get('/favourites', [FavouriteController::class, 'index']);
    Route::get('/favourites/{id}', [FavouriteController::class, 'show']);
    Route::post('/favourites', [FavouriteController::class, 'store']);
    Route::post('/favourites/update/{id}', [FavouriteController::class, 'update']);
    Route::delete('/favourites/{id}', [FavouriteController::class, 'destroy']);
    
    ##### DEALS #####

    
    ##### MICRO BLOG #####
    Route::get('/micro-blog/{id}', [MicroBlogController::class, 'show']);
    Route::get('/my-micro-blogs', [MicroBlogController::class, 'showMyMicroBlogs']);
    Route::post('/micro-blog', [MicroBlogController::class, 'store']);
    Route::post('/micro-blog/update/{id}', [MicroBlogController::class, 'update']);
    Route::delete('/micro-blog/{id}', [MicroBlogController::class, 'destroy']);
    
    ##### MICRO BLOG FAVOURITES #####
    Route::get('/micro-blog/favourites', [MicroBlogFavouriteController::class, 'index']);
    Route::post('/micro-blog/favourites', [MicroBlogFavouriteController::class, 'store']);
    Route::delete('/micro-blog/favourites/{id}', [MicroBlogFavouriteController::class, 'destroy']);

    ##### MICRO BLOG COMMENTS #####
    Route::get('/comments/{micro_blog_id}', [CommentController::class, 'index']);
    Route::get('/comments/get/{id}', [CommentController::class, 'show']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/comments/update/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    ##### MICRO BLOG REPLIES #####
    Route::get('/replies/{parent_comment_id}', [ReplyController::class, 'index']);
    Route::get('/replies/get/{id}', [ReplyController::class, 'show']);
    Route::post('/replies', [ReplyController::class, 'store']);
    Route::post('/replies/update/{id}', [ReplyController::class, 'update']);
    Route::delete('/replies/{id}', [ReplyController::class, 'destroy']);

    ##### DEAL ACTIVITY #####
    // This is to record user engagement with deals
    // Route::get('/deal-activity', [DealActivityController::class, 'index']);
    Route::post('/deal-activity', [DealActivityController::class, 'store']);

    ##### MICRO BLOG REPORTS #####
    Route::post('/report-community-deal', [MicroBlogReportController::class, 'store']);

});


##### Deal owner #####
Route::middleware(['auth:sanctum', 'type.deal_owner'])->group(function() {
    ##### DEAL OWNER #####
    Route::get('/do', function (Request $request) { return $request->user(); });

    ##### DEALS #####
    Route::get('/do/deals', [DealController::class, 'indexDO']);
    Route::post('/do/deals', [DealController::class, 'store']);
    Route::post('/do/deals/update/{id}', [DealController::class, 'update']);
    Route::delete('/do/deals/{id}', [DealController::class, 'destroy']);

    ##### DEAL ACTIVITY #####
    // This is to record user engagement with deals
    Route::get('/deal-activity', [DealActivityController::class, 'index']);
    Route::get('/do/deal-activity/{id}', [DealActivityController::class, 'show']);

    ##### PAYMENTS #####
    // Route::post('/do/checkout', [StripeController::class, 'checkout']);
    // Route::post('/do/payment-intent', [StripeController::class, 'makePaymentIntent']);
    // Route::post('/do/save-card-details', [StripeController::class, 'saveCardDetails']);
    // Route::post('/webhook', [StripeController::class, 'webhook']);

    Route::post('/do/create-setup-intent', [StripeController::class, 'createSetupIntent']);
    Route::post('/do/card-saved', [StripeController::class, 'cardSaved']);
    Route::post('/do/retrieve-saved-cards', [StripeController::class, 'retrieveSavedCards']);
    Route::post('/do/charge-saved-card', [StripeController::class, 'chargeSavedCard']);
    Route::get('/do/payments', [PaymentController::class, 'index']);
    
    
    ##### DEAL OWNER API #####
    Route::post('/do/transaction/{unique_deal_id}', [StripeController::class, 'chargeHalfDiscountOnCheckout']);

});

##### Admin #####
Route::middleware(['auth:sanctum', 'type.admin'])->group(function() {
    ##### ADMIN #####
    Route::get('/admin', function (Request $request) { return $request->user(); });

    ##### DEALS #####
    Route::get('/admin/deals', [DealController::class, 'indexAdmin']);
    Route::post('/admin/deals', [DealController::class, 'storeDealByAdmin']);
    Route::post('/admin/deals/update/{id}', [DealController::class, 'update']);
    Route::post('/admin/deals/approve/{id}', [DealController::class, 'approve']);
    Route::post('/admin/deals/reject/{id}', [DealController::class, 'reject']);
    Route::delete('/admin/deals/{id}', [DealController::class, 'destroy']);
    // Route::delete('/do/deals/{id}', [DealController::class, 'destroy']);

    ##### AFFILIATE LINKS #####
    Route::get('/admin/affiliate-links', [DealController::class, 'indexAffiliate']);
    Route::post('/admin/affiliate-links', [DealController::class, 'storeAffiliate']);

    ##### CATEGORIES #####
    Route::post('/admin/categories', [CategoryController::class, 'store']);
    Route::post('/admin/categories/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);

    ##### REPORTING REASONS #####
    // Route::get('/admin/reporting-reason', [ReportingReasonsController::class, 'index']);
    Route::get('/admin/reporting-reason/{id}', [ReportingReasonsController::class, 'show']);
    Route::post('/admin/reporting-reason', [ReportingReasonsController::class, 'store']);
    Route::post('/admin/reporting-reason/update/{id}', [ReportingReasonsController::class, 'update']);
    Route::delete('/admin/reporting-reason/{id}', [ReportingReasonsController::class, 'destroy']);

    ##### MICRO BLOGS #####
    Route::delete('/admin/micro-blog/{id}', [MicroBlogController::class, 'destroy']);

    ##### MICRO BLOG REPORTS #####
    Route::get('/admin/report-community-deal', [MicroBlogReportController::class, 'index']);
    Route::get('/admin/report-community-deal/{id}', [MicroBlogReportController::class, 'show']);
    // Route::post('/admin/report-community-deal', [MicroBlogReportController::class, 'store']);
    Route::post('/admin/report-community-deal/update/{id}', [MicroBlogReportController::class, 'update']);
    Route::delete('/admin/report-community-deal/{id}', [MicroBlogReportController::class, 'destroy']);
});