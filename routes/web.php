<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\ContactLocationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AppointmentSettingController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactPageSeoController;
use App\Http\Controllers\Admin\HomePageSeoController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\SectionHeadingController;
use App\Http\Controllers\ImageUploadController;
use App\Models\Language;

// Глобальное применение middleware setlocale для всех маршрутов
Route::middleware(['setlocale'])->group(function () {

    // Стандартные маршруты (без префикса локали)
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about-us', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    // Маршруты блога
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
        Route::get('/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
    });

    // SEO маршруты
    Route::get('home-page-seo', [HomePageSeoController::class, 'edit'])->name('home-page-seo.edit');
    Route::put('home-page-seo', [HomePageSeoController::class, 'update'])->name('home-page-seo.update');
    Route::get('contact-page-seo', [ContactPageSeoController::class, 'edit'])->name('contact-page-seo.edit');
    Route::put('contact-page-seo', [ContactPageSeoController::class, 'update'])->name('contact-page-seo.update');

    // Загрузка изображений
    Route::post('/image-upload-direct', [ImageUploadController::class, 'uploadDirect'])->name('image.upload.direct');



    // Переключение языка
    Route::get('language/{locale}', function ($locale) {
        $language = Language::where('code', $locale)
                           ->where('active', true)
                           ->first();
        
        if ($language) {
            session(['locale' => $locale]);
        }
        
        return redirect()->back();
    })->name('language.switch');

    // Маршруты для версий с префиксом локали
    Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
        Route::get('/', [PageController::class, 'home'])->name('localized.home');
        Route::get('/about-us', [PageController::class, 'about'])->name('localized.about');
        Route::get('/contact', [ContactController::class, 'index'])->name('localized.contact');
        Route::post('/contact', [ContactController::class, 'submit'])->name('localized.contact.submit');
        
        // Локализованные маршруты блога
        Route::prefix('blog')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('localized.blog.index');
            Route::get('/{slug}', [BlogController::class, 'show'])->name('localized.blog.show');
            Route::get('/category/{slug}', [BlogController::class, 'category'])->name('localized.blog.category');
        });
    });
    
    // Подписка на рассылку
    if (class_exists('App\Http\Controllers\NewsletterController')) {
        Route::post('/newsletter-subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
    }
});

// Админские маршруты
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Управление слайдерами
    Route::resource('sliders', SliderController::class);
    
    // Управление особенностями
    Route::resource('features', FeatureController::class);
    
    // Управление разделом "О нас" (AboutController)
    Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');
    
    // Управление разделом "О нас" (AboutUsController)
    Route::get('aboutus', [AboutUsController::class, 'edit'])->name('aboutus.edit');
    Route::put('aboutus', [AboutUsController::class, 'update'])->name('aboutus.update');
    
    // Управление услугами
    Route::resource('services', ServiceController::class);
    
    // Управление блогом
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    
    // Управление временной шкалой
    Route::resource('timeline', TimelineController::class);
    
    // Управление контактами
    Route::resource('contact-locations', ContactLocationController::class);
    Route::get('contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts');
    Route::get('admin/contacts/{id}', [ContactController::class, 'show'])->name('admin.contacts.show');
    Route::put('admin/contacts/{id}/mark-as-read', [ContactController::class, 'markAsRead'])->name('admin.contacts.mark-as-read');
    Route::delete('admin/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
    
    // Управление настройками
    Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    // Управление командой
    Route::resource('team', TeamController::class)->parameters([
        'team' => 'team'
    ])->except(['show']);
    Route::resource('portfolio', PortfolioController::class)->except(['show']);

    // Настройки встреч
    Route::get('appointment', [AppointmentSettingController::class, 'edit'])->name('appointment.edit');
    Route::put('appointment', [AppointmentSettingController::class, 'update'])->name('appointment.update');

    // SEO для домашней страницы
    Route::get('home-page-seo', [HomePageSeoController::class, 'edit'])->name('home-page-seo.edit');
    Route::put('home-page-seo', [HomePageSeoController::class, 'update'])->name('home-page-seo.update');

    // SEO для страницы контактов
    Route::get('contact-page-seo', [ContactPageSeoController::class, 'edit'])->name('contact-page-seo.edit');
    Route::put('contact-page-seo', [ContactPageSeoController::class, 'update'])->name('contact-page-seo.update');

    // Заголовки разделов
    Route::get('section-headings', [SectionHeadingController::class, 'edit'])->name('section-headings.edit');
    Route::put('section-headings', [SectionHeadingController::class, 'update'])->name('section-headings.update');

    // Панель управления языками
    Route::get('languages/dashboard', [LanguageController::class, 'dashboard'])->name('languages.dashboard');
    
    // Просмотр неполных переводов для типа модели
    Route::get('languages/incomplete/{model}/{language}', [LanguageController::class, 'incompleteTranslations'])->name('languages.incomplete');
    
    // Копирование переводов с языка по умолчанию на целевой язык
    Route::get('languages/copy-from-default/{target_language}', [LanguageController::class, 'copyFromDefault'])->name('languages.copy-from-default');

    // Управление языками
    Route::resource('languages', LanguageController::class);
});

// Аутентификация
require __DIR__.'/auth.php';