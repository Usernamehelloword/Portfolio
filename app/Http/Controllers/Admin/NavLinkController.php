<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavLink;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NavLinkController extends Controller
{
    /**
     * Display a listing of the navigation links.
     */
    public function index(): View
    {
        return view('admin.nav-links.index', [
            'links' => NavLink::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new link.
     */
    public function create(): View
    {
        return view('admin.nav-links.create', ['link' => new NavLink]);
    }

    /**
     * Store a newly created link.
     */
    public function store(Request $request): RedirectResponse
    {
        NavLink::create($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.nav-links.index')->with('status', 'Navigation link added.');
    }

    /**
     * Show the form for editing a link.
     */
    public function edit(NavLink $nav_link): View
    {
        return view('admin.nav-links.edit', ['link' => $nav_link]);
    }

    /**
     * Update the link.
     */
    public function update(Request $request, NavLink $nav_link): RedirectResponse
    {
        $nav_link->update($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.nav-links.index')->with('status', 'Navigation link updated.');
    }

    /**
     * Remove the link.
     */
    public function destroy(NavLink $nav_link): RedirectResponse
    {
        $nav_link->delete();
        PortfolioService::flush();

        return redirect()->route('admin.nav-links.index')->with('status', 'Navigation link deleted.');
    }

    /**
     * Validate and collect nav link data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'href' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['sort_order' => 0];
    }
}
