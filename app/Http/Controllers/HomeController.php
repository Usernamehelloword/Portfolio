<?php

namespace App\Http\Controllers;

use App\Services\PortfolioService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the single-page portfolio.
     */
    public function index(): View
    {
        return view('home', [
            'portfolio' => app(PortfolioService::class)->content(),
        ]);
    }
}
