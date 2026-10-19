<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NavLinkController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SkillGroupController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/* ------------------------------------------------------------------ */
/* Public site */
/* ------------------------------------------------------------------ */

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/* ------------------------------------------------------------------ */
/* Admin authentication */
/* ------------------------------------------------------------------ */

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.attempt');
});

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');

/* ------------------------------------------------------------------ */
/* Admin panel (auth-protected) */
/* ------------------------------------------------------------------ */

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Site settings (all site text + hero/about images)
        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

        // Profile (change name / email / password)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // About stats
        Route::resource('stats', StatController::class)->except('show')->parameters([
            'stats' => 'stat',
        ]);

        // Navbar links
        Route::resource('nav-links', NavLinkController::class)->except('show')->parameters([
            'nav-links' => 'nav_link',
        ]);

        // Social links (footer + hero)
        Route::resource('socials', SocialController::class)->except('show');

        // Skills: groups + nested skills
        Route::resource('skill-groups', SkillGroupController::class)->except('show')->parameters([
            'skill-groups' => 'skill_group',
        ]);
        Route::resource('skill-groups.skills', SkillController::class)
            ->except(['show', 'index'])
            ->parameters([
                'skill-groups' => 'skill_group',
                'skills' => 'skill',
            ]);

        // Projects
        Route::resource('projects', ProjectController::class)->except('show');

        // Experience timeline
        Route::resource('experiences', ExperienceController::class)->except('show')->parameters([
            'experiences' => 'experience',
        ]);

        // Services
        Route::resource('services', ServiceController::class)->except('show');

        // Contact message inbox
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{message}/toggle', [MessageController::class, 'toggle'])->name('messages.toggle');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    });
