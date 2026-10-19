<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkillGroup;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillGroupController extends Controller
{
    /**
     * Icons supported by the icon partial (usable for skill groups).
     */
    public const ICONS = ['layout', 'code', 'server', 'database', 'tool', 'zap'];

    /**
     * Display a listing of the skill groups.
     */
    public function index(): View
    {
        return view('admin.skill-groups.index', [
            'groups' => SkillGroup::withCount('skills')->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new skill group.
     */
    public function create(): View
    {
        return view('admin.skill-groups.create', [
            'group' => new SkillGroup,
            'icons' => self::ICONS,
        ]);
    }

    /**
     * Store a newly created skill group.
     */
    public function store(Request $request): RedirectResponse
    {
        SkillGroup::create($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.skill-groups.index')->with('status', 'Skill group added.');
    }

    /**
     * Show the form for editing a skill group.
     */
    public function edit(SkillGroup $skill_group): View
    {
        return view('admin.skill-groups.edit', [
            'group' => $skill_group,
            'icons' => self::ICONS,
        ]);
    }

    /**
     * Update the skill group.
     */
    public function update(Request $request, SkillGroup $skill_group): RedirectResponse
    {
        $skill_group->update($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.skill-groups.index')->with('status', 'Skill group updated.');
    }

    /**
     * Remove the skill group (and its skills).
     */
    public function destroy(SkillGroup $skill_group): RedirectResponse
    {
        $skill_group->delete();
        PortfolioService::flush();

        return redirect()->route('admin.skill-groups.index')->with('status', 'Skill group deleted.');
    }

    /**
     * Validate and collect skill group data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'category' => ['required', 'string', 'max:100'],
            'icon' => ['required', 'string', 'in:'.implode(',', self::ICONS)],
            'blurb' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['sort_order' => 0];
    }
}
