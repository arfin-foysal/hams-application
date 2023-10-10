<?php


use App\Http\Controllers\Api\AboutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NewsAndEventController;
use App\Http\Controllers\Api\ProductController;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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




//auth and open api
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/client-login', [AuthController::class, 'clientLogin']);
// Route::post('/auth/client-register', [AuthController::class, 'createUser']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('/main-menu-list', [CommonController::class, 'mainMenuList']);
        Route::post('/save-or-update-main-menu', [CommonController::class, 'saveOrUpdateMainMenu']);
        Route::delete('/delete-main-menu/{id}', [CommonController::class, 'deleteMainMenu']);
        Route::get('/sub-menu-list/{id}', [CommonController::class, 'subMenuList']);
        Route::post('/save-or-update-sub-menu', [CommonController::class, 'subMenuCreateOrUpdate']);
        Route::delete('/delete-sub-menu/{id}', [CommonController::class, 'deleteSubMenu']);
        Route::get('/menu-section-list/{id}', [CommonController::class, 'menuSectionList']);
        Route::post('/save-or-update-menu-section', [CommonController::class, 'saveOrUpdateMenuSection']);
        Route::get('/submenu-by-menu/{id}', [CommonController::class, 'subMenuByMenu']);
        Route::post('/password-change', [AuthController::class, 'passwordChange']);
        Route::post('/save-or-update-common-info', [CommonController::class, 'saveOrUpdateCommonInfo']);
        Route::get('/common-info', [CommonController::class, 'commonInfo']);
        Route::Post('/save-or-update-slider', [HomeController::class, 'saveOrUpdateSlider']);
        Route::get('/slider-list', [HomeController::class, 'sliderList']);
        Route::get('/slider-feature-section', [HomeController::class, 'sliderSectionFeature']);
        Route::post('/slider-feature-save-or-update', [HomeController::class, 'sliderSectionFeatureSaveOrUpdate']);
        Route::get('/our-service-list', [HomeController::class, 'ourServiceList']);
        Route::post('/our-service-save-or-update', [HomeController::class, 'ourServiceSaveOrUpdate']);
        Route::delete('/delete-slider/{id}', [HomeController::class, 'deleteSlider']);
        Route::get('/about-section', [HomeController::class, 'aboutSection']);
        Route::post('about-save-or-update', [HomeController::class, 'aboutSaveOrUpdate']);
        Route::get('/product-section', [HomeController::class, 'productSection']);
        Route::post('/product-section-update', [HomeController::class, 'productSectionSaveOrUpdate']);
        Route::get('/achievement-list', [HomeController::class, 'achievementList']);
        Route::post('/achievement-save-or-update', [HomeController::class, 'achievementSaveOrUpdate']);
        Route::delete('/delete-achievement/{id}', [HomeController::class, 'deleteAchievement']);
        Route::get('/virtually-section', [HomeController::class, 'virtualSection']);
        Route::post('/virtually-save-or-update', [HomeController::class, 'virtualSectionSaveOrUpdate']);
        Route::get('/client-list', [HomeController::class, 'ourClientList']);
        Route::post('/client-save-or-update', [HomeController::class, 'ourClientSaveOrUpdate']);
        Route::get('/sustainability-section', [HomeController::class, 'sustainabilitySection']);
        Route::post('/sustainability-save-or-update', [HomeController::class, 'sustainabilitySaveOrUpdate']);
        Route::get('/sustainability-feature-list', [HomeController::class, 'sustainabilityFeatureList']);
        Route::post('/sustainability-feature-save-or-update', [HomeController::class, 'sustainabilityFeatureSaveOrUpdate']);
        Route::get('certification-section', [HomeController::class, 'certificationSection']);
        Route::post('certification-Section-update', [HomeController::class, 'certificationSectionUpdate']);
        Route::get('/certification-list', [HomeController::class, 'certificationList']);
        Route::post('/certification-save-or-update', [HomeController::class, 'certificationSaveOrUpdate']);
       
        //about us
        Route::get('/who-we-are-section', [AboutController::class, 'whoWeAreSection']);
        Route::post('/who-we-are-section-update', [AboutController::class, 'whoWeAreSectionUpdate']);
        Route::get('/process-section', [AboutController::class, 'processSection']);
        Route::post('/process-section-update', [AboutController::class, 'processSectionUpdate']);
        Route::get('/process-section-feature-list', [AboutController::class, 'processSectionFeatureList']);
        Route::post('/process-section-feature-create-or-update', [AboutController::class, 'processSectionFeatureCreateOrUpdate']);
        Route::get('/journey-section', [AboutController::class, 'journeySection']);
        Route::post('/journey-section-update', [AboutController::class, 'journeySectionUpdate']);
        Route::get('/journey-section-timeline-list', [AboutController::class, 'journeySectionTimelineList']);
        Route::post('/journey-section-timeline-create-or-update', [AboutController::class, 'journeySectionTimelineCreateOrUpdate']);
        Route::get('/quality-section', [AboutController::class, 'qualitySection']);
        Route::post('/quality-section-update', [AboutController::class, 'qualitySectionUpdate']);
        Route::get('/quality-section-feature-list', [AboutController::class, 'qualitySectionFeatureList']);
        Route::post('/quality-section-feature-create-or-update', [AboutController::class, 'qualitySectionFeatureCreateOrUpdate']);
        Route::get('/client-section', [AboutController::class, 'clientSection']);
        Route::post('/client-section-update', [AboutController::class, 'clientSectionUpdate']);
        Route::get('/elevating-section', [AboutController::class, 'elevatingSection']);
        Route::post('/elevating-section-update', [AboutController::class, 'elevatingSectionUpdate']);
        Route::get('/elevating-section-feature-list', [AboutController::class, 'elevatingSectionFeatureList']);
        Route::post('/elevating-section-feature-create-or-update', [AboutController::class, 'elevatingSectionFeatureCreateOrUpdate']);
        Route::get('customer-support-section', [AboutController::class, 'customerSupportSection']);
        Route::post('customer-support-section-update', [AboutController::class, 'customerSupportSectionUpdate']);
        //product 

        Route::get('/product-category-list', [ProductController::class, 'productCategory']);
        Route::post('/product-category-save-or-update', [ProductController::class, 'productCategorySaveOrUpdate']);
        Route::get('/product-list', [ProductController::class, 'productList']);
        Route::post('/product-save-or-update', [ProductController::class, 'saveOrUpdateProduct']);

        //news And event
        Route::get('/news-and-event-list', [NewsAndEventController::class, 'newsAndEventList']);
        Route::post('/news-and-event-save-or-update', [NewsAndEventController::class, 'saveOrUpdateNewsAndEvent']);
        Route::get('category-list', [NewsAndEventController::class, 'categoryList']);
        Route::post('category-save-or-update', [NewsAndEventController::class, 'saveOrUpdateCategory']);
    });
});

Route::prefix('client')->group(function () {
    Route::get('/main-menu-list', [CommonController::class, 'mainMenuList']);
    Route::get('/common-info', [CommonController::class, 'commonInfo']);
    Route::get('home-page', [HomeController::class, 'homePage']);
    Route::get('home-service-by-submenu-id/{id}', [HomeController::class, 'homeServiceBySubmenuId']);
    Route::get('about-page', [AboutController::class, 'aboutPage']);
    Route::get('product-by-client-id/{id}', [AboutController::class, 'productByClientId']);
    Route::get('product-category-list', [ProductController::class, 'productCategory']);
    Route::get('product-by-category-id/{id}', [ProductController::class, 'productByCategoryId']);
    Route::get('product-details/{id}', [ProductController::class, 'productDetails']);
    Route::get('certification-list', [CommonController::class, 'certificationList']);
    Route::get('news-and-event-page', [NewsAndEventController::class, 'newsAndEventPage']);
    Route::get('news-details/{id}', [NewsAndEventController::class, 'newsDetailsPage']);
    Route::get('recent-post', [NewsAndEventController::class, 'recentPost']);
    Route::get('section-and-submenu-by-menu-id/{id}',[CommonController::class,'sectionAndSubMenuByMenuId']);
    Route::post('subscription',[CommonController::class,'subscription']);
});

// test route

Route::any('/test', function (Request $request) {
    return response()->json([
        'status' => true,
        'message' => 'This is test route',
        'data' => []
    ], 200);
});



Route::any('{url}', function () {;
    return response()->json([
        'status' => false,
        'message' => 'Route Not Found! Please Check Your URL',
        'data' => []
    ], 404);
})->where('url', '.*');
