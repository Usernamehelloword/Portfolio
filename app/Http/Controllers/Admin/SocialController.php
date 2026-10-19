<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialController extends Controller
{
    /**
     * Icons supported by the social partial.
     */
    public const ICONS = ['github', 'linkedin', 'instagram', 'facebook'];

    /**
     * Display a listing of the social links.
     */
    public function index(): View
    {
        return view('admin.socials.index', [
            'socials' => Social::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new social link.
     */
    public function create(): View
    {
        return view('admin.socials.create', [
            'social' => new Social,
            'icons' => self::ICONS,
        ]);
    }

    /**
     * Store a newly created social link.
     */
    public function store(Request $request): RedirectResponse
    {
        Social::create($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.socials.index')->with('status', 'Social link added.');
    }

    /**
     * Show the form for editing a social link.
     */
    public function edit(Social $social): View
    {
        return view('admin.socials.edit', [
            'social' => $social,
            'icons' => self::ICONS,
        ]);
    }

    /**
     * Update the social link.
     */
    public function update(Request $request, Social $social): RedirectResponse
    {
        $social->update($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.socials.index')->with('status', 'Social link updated.');
    }

    /**
     * Remove the social link.
     */
    public function destroy(Social $social): RedirectResponse
    {
        $social->delete();
        PortfolioService::flush();

        return redirect()->route('admin.socials.index')->with('status', 'Social link deleted.');
    }

    /**
     * Validate and collect social link data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:100'],
            'icon' => ['required', 'string', 'in:'.implode(',', self::ICONS)],
            'href' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['sort_order' => 0];
    }
}
