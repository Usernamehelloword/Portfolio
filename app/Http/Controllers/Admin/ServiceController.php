<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Icons supported by the icon partial (usable for services).
     */
    public const ICONS = ['code', 'server', 'layout', 'zap', 'tool', 'database'];

    /**
     * Display a listing of the services.
     */
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new service.
     */
    public function create(): View
    {
        return view('admin.services.create', [
            'service' => new Service,
            'icons' => self::ICONS,
        ]);
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request): RedirectResponse
    {
        Service::create($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.services.index')->with('status', 'Service added.');
    }

    /**
     * Show the form for editing a service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', [
            'service' => $service,
            'icons' => self::ICONS,
        ]);
    }

    /**
     * Update the service.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $service->update($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.services.index')->with('status', 'Service updated.');
    }

    /**
     * Remove the service.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();
        PortfolioService::flush();

        return redirect()->route('admin.services.index')->with('status', 'Service deleted.');
    }

    /**
     * Validate and collect service data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'icon' => ['required', 'string', 'in:'.implode(',', self::ICONS)],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['sort_order' => 0];
    }
}
