<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the experience entries.
     */
    public function index(): View
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new experience entry.
     */
    public function create(): View
    {
        return view('admin.experiences.create', ['experience' => new Experience]);
    }

    /**
     * Store a newly created experience entry.
     */
    public function store(Request $request): RedirectResponse
    {
        Experience::create($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.experiences.index')->with('status', 'Experience entry added.');
    }

    /**
     * Show the form for editing an experience entry.
     */
    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', ['experience' => $experience]);
    }

    /**
     * Update the experience entry.
     */
    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $experience->update($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.experiences.index')->with('status', 'Experience entry updated.');
    }

    /**
     * Remove the experience entry.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();
        PortfolioService::flush();

        return redirect()->route('admin.experiences.index')->with('status', 'Experience entry deleted.');
    }

    /**
     * Validate and collect experience data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'period' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:1000'],
            'is_current' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['is_current' => false, 'sort_order' => 0];
    }
}
