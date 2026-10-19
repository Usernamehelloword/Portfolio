<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index(): View
    {
        return view('admin.dashboard', [
            'projectCount' => Project::count(),
            'serviceCount' => Service::count(),
            'skillCount' => Skill::count(),
            'unreadCount' => ContactMessage::where('is_read', false)->count(),
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
