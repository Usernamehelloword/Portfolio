<?php

namespace App\Console\Commands;

use App\Models\Experience;
use App\Models\NavLink;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\SkillGroup;
use App\Models\Social;
use App\Models\Stat;
use App\Services\PortfolioService;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Console\Command;

class PortfolioReseed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'portfolio:reseed {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset all portfolio content in the database back to the config/portfolio.php defaults';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (! $this->option('force') && ! $this->confirm('This deletes ALL current content edits and restores the defaults from config/portfolio.php. Continue?')) {
            $this->info('Cancelled.');

            return self::SUCCESS;
        }

        // Delete children first so foreign keys stay happy.
        Skill::query()->delete();
        SkillGroup::query()->delete();
        Project::query()->delete();
        Experience::query()->delete();
        Service::query()->delete();
        NavLink::query()->delete();
        Social::query()->delete();
        Stat::query()->delete();
        SiteSetting::query()->delete();

        $this->call(PortfolioSeeder::class);

        PortfolioService::flush();

        $this->info('Portfolio content has been reset to defaults.');

        return self::SUCCESS;
    }
}
