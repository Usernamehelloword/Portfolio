<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\UploadsImages;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    use UploadsImages;

    /**
     * Display a listing of the projects.
     */
    public function index(): View
    {
        return view('admin.projects.index', [
            'projects' => Project::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('admin.projects.create', ['project' => new Project]);
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request, 'image', 'projects');
        }

        Project::create($validated);
        PortfolioService::flush();

        return redirect()->route('admin.projects.index')->with('status', 'Project added.');
    }

    /**
     * Show the form for editing a project.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    /**
     * Update the project.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validated($request);
        $validated['image'] = $this->uploadImage($request, 'image', 'projects', $project->image);

        $project->update($validated);
        PortfolioService::flush();

        return redirect()->route('admin.projects.index')->with('status', 'Project updated.');
    }

    /**
     * Remove the project (and its uploaded image).
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteImage($project->image);
        $project->delete();
        PortfolioService::flush();

        return redirect()->route('admin.projects.index')->with('status', 'Project deleted.');
    }

    /**
     * Validate and collect project data.
     *
     * @return array<string, mixed>
     */
    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'min:10', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'technologies' => ['nullable', 'string', 'max:500'],
            'github' => ['nullable', 'string', 'max:255'],
            'demo' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]) + ['sort_order' => 0];
    }
}
