<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SkillGroup;

trait PortfolioSeederPart2
{
    /**
     * Seed skill groups with their nested skills.
     *
     * @param  array<string, mixed>  $portfolio
     */
    protected function seedSkills(array $portfolio): void
    {
        $this->seedWhenEmpty('Skill groups & skills', SkillGroup::class, function () use ($portfolio) {
            foreach ($portfolio['skills'] as $groupIndex => $group) {
                $skillGroup = SkillGroup::create([
                    'category' => $group['category'],
                    'icon' => $group['icon'],
                    'blurb' => $group['blurb'],
                    'sort_order' => $groupIndex,
                ]);

                foreach ($group['items'] as $itemIndex => $item) {
                    Skill::create([
                        'skill_group_id' => $skillGroup->id,
                        'name' => $item['name'],
                        'abbr' => $item['abbr'],
                        'level' => $item['level'],
                        'color' => $item['color'],
                        'sort_order' => $itemIndex,
                    ]);
                }
            }
        });
    }

    /**
     * Seed projects.
     *
     * @param  array<string, mixed>  $portfolio
     */
    protected function seedProjects(array $portfolio): void
    {
        $this->seedWhenEmpty('Projects', Project::class, function () use ($portfolio) {
            foreach ($portfolio['projects'] as $index => $project) {
                Project::create([
                    'name' => $project['name'],
                    'description' => $project['description'],
                    'image' => $project['image'],
                    'technologies' => implode(', ', $project['technologies']),
                    'github' => $project['github'],
                    'demo' => $project['demo'],
                    'sort_order' => $index,
                ]);
            }
        });
    }

    /**
     * Seed experience timeline entries.
     *
     * @param  array<string, mixed>  $portfolio
     */
    protected function seedExperiences(array $portfolio): void
    {
        $this->seedWhenEmpty('Experience entries', Experience::class, function () use ($portfolio) {
            foreach ($portfolio['experience'] as $index => $item) {
                Experience::create([
                    'period' => $item['period'],
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'is_current' => (bool) $item['current'],
                    'sort_order' => $index,
                ]);
            }
        });
    }

    /**
     * Seed services.
     *
     * @param  array<string, mixed>  $portfolio
     */
    protected function seedServices(array $portfolio): void
    {
        $this->seedWhenEmpty('Services', Service::class, function () use ($portfolio) {
            foreach ($portfolio['services'] as $index => $service) {
                Service::create([
                    'icon' => $service['icon'],
                    'title' => $service['title'],
                    'description' => $service['description'],
                    'sort_order' => $index,
                ]);
            }
        });
    }
}
