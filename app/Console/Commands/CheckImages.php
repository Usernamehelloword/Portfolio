<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Console\Command;

/**
 * Scans every image path stored in the database (hero, about and project
 * images), verifies the file exists on disk and reports any broken ones.
 *
 * Usage:
 *   php artisan images:check          — report status of every image
 *   php artisan images:check --fix    — auto-prefix "uploads/" when the file
 *                                       actually lives in public/uploads
 */
class CheckImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:check {--fix : Auto-fix paths that are missing the uploads/ prefix}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check every image stored in the database exists and is reachable';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $rows = $this->allImageRows();
        $fixed = 0;
        $broken = 0;

        $table = [];

        foreach ($rows as $row) {
            [$label, $value] = $row;

            if (blank($value)) {
                $table[] = [$label, $value, 'EMPTY'];
                continue;
            }

            // External URL — nothing to check on disk.
            if (preg_match('#^https?://#', $value)) {
                $table[] = [$label, $value, 'EXTERNAL URL'];

                continue;
            }

            $status = $this->publicExists($value) ? 'OK' : 'MISSING FILE';

            // The file lives in public/uploads but the stored path is missing
            // the "uploads/" prefix, so the rendered URL would 404. Fixable.
            if ($status === 'MISSING FILE' && $this->publicExists('uploads/'.$value)) {
                if ($this->option('fix')) {
                    $this->updatePath($label, 'uploads/'.$value);
                    $table[] = [$label, 'uploads/'.$value, 'FIXED (prefix added)'];
                    $fixed++;
                } else {
                    $table[] = [$label, $value, 'MISSING PREFIX (run --fix)'];
                    $broken++;
                }

                continue;
            }

            if ($status === 'MISSING FILE') {
                $broken++;
            }

            $table[] = [$label, $value, $status];
        }

        $this->table(['Image', 'Path in database', 'Status'], $table);

        $this->newLine();
        $this->info("Checked ".count($rows).' image(s)');
        $this->info("Fixed: {$fixed}");

        if ($broken > 0) {
            $this->warn("Broken: {$broken} — check the paths above or upload new images from the admin panel.");

            return self::FAILURE;
        }

        $this->info('All images exist.');

        return self::SUCCESS;
    }

    /**
     * @return list<array{0: string, 1: string|null}>
     */
    protected function allImageRows(): array
    {
        $rows = [];

        $setting = SiteSetting::query()->first();

        if ($setting) {
            $rows[] = ['Hero image', $setting->hero_image];
            $rows[] = ['About image', $setting->about_image];
        }

        foreach (Project::query()->get() as $project) {
            $rows[] = ["Project: {$project->name}", $project->image];
        }

        return $rows;
    }

    /**
     * Whether the given path resolves to an existing file under public/.
     */
    protected function publicExists(string $path): bool
    {
        return file_exists(public_path(ltrim($path, '/')));
    }

    protected function updatePath(string $label, string $path): void
    {
        $setting = SiteSetting::query()->first();

        if ($label === 'Hero image') {
            $setting->update(['hero_image' => $path]);
        } elseif ($label === 'About image') {
            $setting->update(['about_image' => $path]);
        } elseif (str_starts_with($label, 'Project:')) {
            $name = trim(substr($label, strlen('Project:')));
            Project::query()->where('name', $name)->update(['image' => $path]);
        }
    }
}