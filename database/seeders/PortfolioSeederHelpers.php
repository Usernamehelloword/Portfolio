<?php

namespace Database\Seeders;

use App\Models\NavLink;
use App\Models\Social;
use App\Models\Stat;
use Illuminate\Database\Eloquent\Model;

/**
 * Shared helpers for PortfolioSeeder — kept in a trait so the seeder class
 * stays small while all seeding logic lives in the Database\Seeders namespace.
 */
trait PortfolioSeederHelpers
{
    /**
     * Run the given seeding callback only when the table is empty.
     *
     * @param  class-string<Model>  $model
     * @param  callable(): void  $callback
     */
    protected function seedWhenEmpty(string $label, string $model, callable $callback): void
    {
        if ($model::query()->exists()) {
            $this->command?->line("  <comment>{$label} already exist — skipped.</comment>");

            return;
        }

        $callback();
        $this->command?->line("  <info>{$label} seeded.</info>");
    }

    /**
     * Seed navbar links.
     *
     * @param  array<string, mixed>  $portfolio
     */
    protected function seedNavLinks(array $portfolio): void
    {
        $this->seedWhenEmpty('Navigation links', NavLink::class, function () use ($portfolio) {
            foreach ($portfolio['nav'] as $index => $item) {
                NavLink::create([
                    'label' => $item['label'],
                    'href' => $item['href'],
                    'sort_order' => $index,
                ]);
            }
        });
    }

    /**
     * Seed about-page stats.
     *
     * @param  array<string, mixed>  $portfolio
     */
    protected function seedStats(array $portfolio): void
    {
        $this->seedWhenEmpty('About stats', Stat::class, function () use ($portfolio) {
            foreach ($portfolio['about']['stats'] as $index => $stat) {
                Stat::create([
                    'value' => $stat['value'],
                    'suffix' => $stat['suffix'],
                    'label' => $stat['label'],
                    'sort_order' => $index,
                ]);
            }
        });
    }

    /**
     * Seed social links.
     *
     * @param  array<string, mixed>  $portfolio
     */
    protected function seedSocials(array $portfolio): void
    {
        $this->seedWhenEmpty('Social links', Social::class, function () use ($portfolio) {
            foreach ($portfolio['socials'] as $index => $social) {
                Social::create([
                    'label' => $social['label'],
                    'icon' => $social['icon'],
                    'href' => $social['href'],
                    'sort_order' => $index,
                ]);
            }
        });
    }
}
