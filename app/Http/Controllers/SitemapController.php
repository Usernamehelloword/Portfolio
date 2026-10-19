<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Experience;
use App\Models\SkillGroup;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $canonical = config('portfolio.canonical_url', url('/'));

        $urls = [
            ['loc' => $canonical, 'changefreq' => 'weekly', 'priority' => '1.0'],
        ];

        $dynamicRoutes = [
            ['uri' => '/', 'changefreq' => 'weekly', 'priority' => '1.0'],
            ['uri' => '/#about', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['uri' => '/#skills', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['uri' => '/#projects', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['uri' => '/#experience', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['uri' => '/#services', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['uri' => '/#contact', 'changefreq' => 'monthly', 'priority' => '0.8'],
        ];

        foreach ($dynamicRoutes as $route) {
            $urls[] = [
                'loc' => rtrim($canonical, '/') . $route['uri'],
                'changefreq' => $route['changefreq'],
                'priority' => $route['priority'],
            ];
        }

        $projects = Project::orderBy('sort_order')->orderBy('id')->get();
        foreach ($projects as $project) {
            $urls[] = [
                'loc' => rtrim($canonical, '/') . '/#projects',
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        $services = Service::orderBy('sort_order')->orderBy('id')->get();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => rtrim($canonical, '/') . '/#services',
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ];
        }

        $content = response()->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');

        return $content;
    }
}
