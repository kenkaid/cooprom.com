<?php

use App\Http\Controllers\Front\Home\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CulturalSectorController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\TravelController;
use App\Http\Controllers\Admin\VisaApplicationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\VisaGuideController;
use App\Http\Controllers\Admin\LegalConsultationController;
use App\Http\Controllers\Admin\SolidarityFundController;
use App\Http\Controllers\Admin\HealthInsuranceController;
use App\Http\Controllers\Admin\RetirementController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Front\Page\GalleryController;
use App\Http\Controllers\Front\Page\ContactController;
use App\Http\Controllers\Front\EventController as FrontEventController;
use App\Http\Controllers\Front\Auth\RegisterController;
use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Front\Auth\ForgotPasswordController;
use App\Http\Controllers\Front\Auth\ResetPasswordController;
use App\Http\Controllers\Front\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Front\Member\ProductionController as MemberProductionController;
use App\Http\Controllers\Front\Member\TravelController as MemberTravelController;
use App\Http\Controllers\Front\Member\ContractController as MemberContractController;
use App\Http\Controllers\Front\Member\ProfileController as MemberProfileController;
use App\Http\Controllers\Front\Member\NotificationController as MemberNotificationController;
use App\Http\Controllers\Front\Member\AppointmentController as MemberAppointmentController;
use App\Http\Controllers\Front\Member\LegalConsultationController as MemberLegalConsultationController;
use App\Http\Controllers\Front\Member\SocialAssistanceController as MemberSocialAssistanceController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\EventController as AdminEventController;


Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Événements
Route::get('/evenements', [FrontEventController::class, 'index'])->name('events.index');
Route::get('/evenements/{slug}', [FrontEventController::class, 'show'])->name('events.show');
Route::get('/evenements/{slug}/pass', [FrontEventController::class, 'downloadPass'])->name('events.download-pass')->middleware('auth');
Route::post('/evenements/{slug}/inscription', [FrontEventController::class, 'register'])->name('events.register')->middleware('auth');

// Auth Front
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Réinitialisation de mot de passe
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Espace Membre
Route::middleware(['auth'])->prefix('mon-espace')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');

    // Productions
    Route::resource('productions', MemberProductionController::class);

    // Voyages & Visas
    Route::get('/voyages', [MemberTravelController::class, 'index'])->name('travels.index');
    Route::get('/voyages/guides', [MemberTravelController::class, 'visaGuides'])->name('travels.guides');
    Route::get('/voyages/guides/{uuid}', [MemberTravelController::class, 'showVisaGuide'])->name('travels.guide_show');
    Route::get('/voyages/demande-visa', [MemberTravelController::class, 'createVisa'])->name('travels.create_visa');
    Route::post('/voyages/demande-visa', [MemberTravelController::class, 'storeVisa'])->name('travels.store_visa');
    Route::get('/voyages/demande-visa/{uuid}/edit', [MemberTravelController::class, 'editVisa'])->name('travels.edit_visa');
    Route::put('/voyages/demande-visa/{uuid}', [MemberTravelController::class, 'updateVisa'])->name('travels.update_visa');
    Route::delete('/voyages/demande-visa/{uuid}', [MemberTravelController::class, 'destroyVisa'])->name('travels.destroy_visa');

    // Contrats
    Route::get('/contrats', [MemberContractController::class, 'index'])->name('contracts.index');
    Route::get('/contrats/{contract}', [MemberContractController::class, 'show'])->name('contracts.show');
    Route::post('/contrats/{contract}/sign', [MemberContractController::class, 'sign'])->name('contracts.sign');
    Route::post('/contrats/{contract}/upload-signed', [MemberContractController::class, 'uploadSigned'])->name('contracts.upload_signed');

    // Profil
    Route::get('/profil', [MemberProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profil', [MemberProfileController::class, 'update'])->name('profile.update');

    // Notifications
    Route::get('/notifications', [MemberNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [MemberNotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-as-read', [MemberNotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

    // Rendez-vous
    Route::get('/rendez-vous', [MemberAppointmentController::class, 'index'])->name('appointments.index');

    // Conseil Juridique
    Route::resource('legal-consultations', MemberLegalConsultationController::class)->only(['index', 'create', 'store', 'show'])->names([
        'index' => 'legal.index',
        'create' => 'legal.create',
        'store' => 'legal.store',
        'show' => 'legal.show',
    ]);

    // Aide Sociale
    Route::get('/aide-sociale', [MemberSocialAssistanceController::class, 'index'])->name('social.index');
    Route::get('/aide-sociale/fonds-solidarite/creer', [MemberSocialAssistanceController::class, 'createSolidarity'])->name('social.solidarity.create');
    Route::post('/aide-sociale/fonds-solidarite', [MemberSocialAssistanceController::class, 'storeSolidarity'])->name('social.solidarity.store');
    Route::get('/aide-sociale/assurances', [MemberSocialAssistanceController::class, 'healthInsurances'])->name('social.health.index');
    Route::get('/aide-sociale/retraite/simulation', [MemberSocialAssistanceController::class, 'retirementSimulation'])->name('social.retirement.create');
    Route::post('/aide-sociale/retraite', [MemberSocialAssistanceController::class, 'storeRetirement'])->name('social.retirement.store');
});

// La Cooprom Routes
Route::prefix('cooprom')->name('cooprom.')->group(function () {
    Route::get('/presentation', function () { return view('front.pages.cooprom.about'); })->name('presentation');
    Route::get('/missions', function () { return view('front.pages.cooprom.missions'); })->name('missions');
    Route::get('/partenaires', function () { return view('front.pages.cooprom.partners'); })->name('partenaires');
    Route::get('/gallery-photos', [GalleryController::class, 'photos'])->name('gallery_photos');
    Route::get('/gallery-videos', [GalleryController::class, 'videos'])->name('gallery_videos');
});

// Services Routes
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/promotion', function () { return view('front.pages.services.promotion'); })->name('promotion');
    Route::get('/production', function () { return view('front.pages.services.production'); })->name('production');
    Route::get('/voyages', function () { return view('front.pages.services.travels'); })->name('travels');
    Route::get('/evenementiel', function () { return view('front.pages.services.events'); })->name('events');
});

// Assistance Routes
Route::prefix('assistance')->name('assistance.')->group(function () {
    Route::get('/visa', function () { return view('front.pages.assistance.visa'); })->name('visa');
    Route::get('/juridique', function () { return view('front.pages.assistance.legal'); })->name('legal');
    Route::get('/social', function () { return view('front.pages.assistance.social'); })->name('social');
});

// Admin Portal (Routes discrètes pour les administrateurs)
Route::prefix('cp-admin-access')->name('admin.')->group(function () {
    Route::get('/login-secret', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-secret', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'role:super-admin|admin|staff'])->group(function () {
        Route::get('/dashboard', function (Illuminate\Http\Request $request) {
            $period = $request->query('period', 'all');
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');

            $queryFilter = function ($query) use ($period, $startDate, $endDate) {
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                } elseif ($period === 'today') {
                    $query->whereDate('created_at', today());
                } elseif ($period === 'week') {
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($period === 'month') {
                    $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                } elseif ($period === 'year') {
                    $query->whereYear('created_at', now()->year);
                }
                return $query;
            };

            $stats = [
                'period' => $period,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'users' => $queryFilter(\App\Models\User::role('adhérent'))->count(),
                'productions' => $queryFilter(\App\Models\Production::query())->count(),
                'events' => $queryFilter(\App\Models\Event::query())->count(),
                'visas' => $queryFilter(\App\Models\VisaApplication::query())->count(),
                'recent_users' => \App\Models\User::role('adhérent')->latest()->take(5)->get(),
                'recent_productions' => \App\Models\Production::with('user')->latest()->take(5)->get(),
                'pending_visas' => \App\Models\VisaApplication::where('status', 'pending')->count(),
                'recent_contracts' => \App\Models\Contract::with('user')->latest()->take(5)->get(),
            ];
            return view('admin.dashboard', compact('stats'));
        })->name('dashboard');

        // Gestion Utilisateurs
        Route::patch('users/{uuid}/roles', [AdminUserController::class, 'updateRoles'])->name('users.update_roles');
        Route::resource('users', AdminUserController::class)->parameters([
            'users' => 'uuid'
        ]);

        // Secteurs Culturels
        Route::resource('cultural-sectors', CulturalSectorController::class)->parameters([
            'cultural-sectors' => 'uuid'
        ]);

        // Contrats
        Route::get('/contracts/templates', [ContractController::class, 'templates'])->name('contracts.templates');
        Route::post('/contracts/templates', [ContractController::class, 'storeTemplate'])->name('contracts.templates.store');
        Route::delete('/contracts/templates/{template}', [ContractController::class, 'destroyTemplate'])->name('contracts.templates.destroy');
        Route::get('/contracts/templates/{template}/download', [ContractController::class, 'downloadTemplate'])->name('contracts.templates.download');
        Route::get('/contracts/related-items/{user}', [ContractController::class, 'getRelatedItems'])->name('contracts.related-items');
        Route::resource('contracts', ContractController::class);

        // Production Artistique
        Route::get('/productions/monitoring', [ProductionController::class, 'monitoring'])->name('productions.monitoring');
        Route::patch('/productions/{production}/status', [ProductionController::class, 'updateStatus'])->name('productions.update-status');
        Route::resource('productions', ProductionController::class)->only(['index', 'show']);

        // Voyages & Mobilité
        Route::resource('travels', TravelController::class)->parameters(['travels' => 'travel']);

        // Demandes de Visa
        Route::get('/visa-applications', [VisaApplicationController::class, 'index'])->name('visa_applications.index');
        Route::get('/visa-applications/{visa_application}', [VisaApplicationController::class, 'show'])->name('visa_applications.show');
        Route::patch('/visa-applications/{visa_application}/status', [VisaApplicationController::class, 'updateStatus'])->name('visa_applications.update_status');

        // Orientation Visa
        Route::resource('visa-guides', VisaGuideController::class)->parameters([
            'visa-guides' => 'visa_guide'
        ]);

        // Conseil Juridique
        Route::resource('legal-consultations', LegalConsultationController::class)->parameters([
            'legal-consultations' => 'legal_consultation'
        ]);

        // Aide Sociale
        Route::resource('solidarity-fund', SolidarityFundController::class);
        Route::resource('health-insurances', HealthInsuranceController::class);
        Route::resource('retirement-simulations', RetirementController::class);

        // Médiathèque
        Route::resource('media-library', MediaLibraryController::class);

        // Partenaires
        Route::resource('partners', PartnerController::class);

        // Messages Contacts
        Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy'])->parameters([
            'contacts' => 'uuid'
        ]);

        // Agenda & Rendez-vous
        Route::get('/appointments/list', [AdminAppointmentController::class, 'listEvents'])->name('appointments.list');
        Route::get('/appointments/related-items/{user}', [AdminAppointmentController::class, 'getRelatedItems'])->name('appointments.related-items');
        Route::resource('appointments', AdminAppointmentController::class);

        // Événements
        Route::resource('events', AdminEventController::class);
        Route::get('events/{event}/participants', [AdminEventController::class, 'participants'])->name('events.participants');
        Route::patch('events/{event}/participants/{user}', [AdminEventController::class, 'updateParticipantStatus'])->name('events.update-participant');

        // Notifications
        Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/{id}/read', [AdminNotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::post('/notifications/mark-all-as-read', [AdminNotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

        // Gestion des Rôles et Permissions
        Route::prefix('configuration')->group(function () {
            Route::resource('roles', RoleController::class)->parameters([
                'roles' => 'role'
            ]);
            Route::resource('permissions', PermissionController::class)->parameters([
                'permissions' => 'permission'
            ]);
        });
    });
});
