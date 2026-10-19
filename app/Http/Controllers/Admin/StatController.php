<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatController extends Controller
{
    /**
     * Display a listing of the about-page stats.
     */
    public function index(): View
    {
        return view('admin.stats.index', [
            'stats' => Stat::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new stat.
     */
    public function create(): View
    {
        return view('admin.stats.create', ['stat' => new Stat]);
    }

    /**
     * Store a newly created stat.
     */
    public function store(Request $request): RedirectResponse
    {
        Stat::create($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.stats.index')->with('status', 'Stat added.');
    }

    /**
     * Show the form for editing a stat.
     */
    public function edit(Stat $stat): View
    {
        return view('admin.stats.edit', ['stat' => $stat]);
    }

    /**
     * Update the stat.
     */
    public function update(Request $request, Stat $stat): RedirectResponse
    {
        $stat->update($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.stats.index')->with('status', 'Stat updated.');
    }

    /**
     * Remove the stat.
     */
    public function destroy(Stat $stat): RedirectResponse
    {
        $stat->delete();
        PortfolioService::flush();

        return redirect()->route('admin.stats.index')->with('status', 'Stat deleted.');
    }

    /**
     * Validate and collect stat data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'value' => ['required', 'integer', 'min:0', 'max:999999'],
            'suffix' => ['nullable', 'string', 'max:10'],
            'label' => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['sort_order' => 0, 'suffix' => ''];
    }
}
