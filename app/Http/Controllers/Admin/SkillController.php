<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillGroup;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Show the form for creating a skill inside a group.
     */
    public function create(SkillGroup $skill_group): View
    {
        return view('admin.skills.create', [
            'group' => $skill_group,
            'skill' => new Skill,
        ]);
    }

    /**
     * Store a newly created skill in the group.
     */
    public function store(Request $request, SkillGroup $skill_group): RedirectResponse
    {
        $skill_group->skills()->create($this->validated($request));
        PortfolioService::flush();

        return redirect()->route('admin.skill-groups.edit', $skill_group)->with('status', 'Skill added.');
    }

    /**
     * Show the form for editing a skill.
     */
    public function edit(SkillGroup $skill_group, Skill $skill): View
    {
        return view('admin.skills.edit', [
            'group' => $skill_group,
            'skill' => $skill,
        ]);
    }

    /**
     * Update the skill.
     */
    public function update(Request $request, SkillGroup $skill_group, Skill $skill): RedirectResponse
    {
        $skill->update($this->validated($request) + ['skill_group_id' => $skill_group->id]);
        PortfolioService::flush();

        return redirect()->route('admin.skill-groups.edit', $skill_group)->with('status', 'Skill updated.');
    }

    /**
     * Remove the skill.
     */
    public function destroy(SkillGroup $skill_group, Skill $skill): RedirectResponse
    {
        $skill->delete();
        PortfolioService::flush();

        return redirect()->route('admin.skill-groups.edit', $skill_group)->with('status', 'Skill deleted.');
    }

    /**
     * Validate and collect skill data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'abbr' => ['required', 'string', 'max:10'],
            'level' => ['required', 'integer', 'min:0', 'max:100'],
            'color' => ['required', 'string', 'regex:/^#[0-9a-fA-F]{3,8}$/'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['sort_order' => 0];
    }
}
