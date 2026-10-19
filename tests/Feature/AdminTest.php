<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\NavLink;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SkillGroup;
use App\Models\Stat;
use App\Models\User;
use App\Services\PortfolioService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
    }

    protected function actingAsAdmin(): self
    {
        return $this->actingAs($this->user);
    }

    public function test_guest_is_redirected_away_from_the_admin_panel(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/settings')->assertRedirect('/admin/login');
        $this->get('/admin/projects')->assertRedirect('/admin/login');
    }

    public function test_login_page_renders(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('KIMLAY.')
            ->assertSee('Log in');
    }

    public function test_valid_credentials_log_the_user_into_the_panel(): void
    {
        $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();
    }

    public function test_invalid_credentials_are_rejected(): void
    {
        $this->from('/admin/login')->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_dashboard_shows_content_counts(): void
    {
        Project::create([
            'name' => 'Alpha', 'description' => 'A project', 'image' => 'projects/a.svg',
        ]);
        ContactMessage::create([
            'name' => 'Ada', 'email' => 'ada@example.com', 'subject' => 'Hi',
            'message' => 'Hello there, this is a longer message body.',
        ]);

        $this->actingAsAdmin()
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Projects')
            ->assertSee('Unread messages')
            ->assertSee('Latest messages')
            ->assertSee('Ada');
    }

    public function test_site_settings_can_be_updated_and_appear_on_the_website(): void
    {
        SiteSetting::create(['logo' => 'KIMLAY.']);

        $this->actingAsAdmin()
            ->put(route('admin.settings.update'), [
                'logo' => 'NEWLOGO',
                'role' => 'Backend Engineer',
                'tagline' => 'Building APIs with Laravel.',
                'availability' => 'Open to work',
                'hero_greeting' => "Hi, I'm",
                'hero_name' => 'Kimlay',
                'hero_chips' => 'PHP, MySQL, Laravel',
                'about_tag' => 'About',
                'about_heading' => 'All about me',
                'about_badge_value' => '5+',
                'about_badge_label' => 'Years coding',
                'about_paragraphs' => "Paragraph one.\nParagraph two.",
                'contact_heading' => 'Get in touch',
                'contact_description' => 'Say hello.',
                'contact_email' => 'hello@kimlay.dev',
                'contact_phone' => '+855 12 345 678',
                'contact_phone_href' => '+85512345678',
                'contact_location' => 'Phnom Penh',
                'footer_tagline' => 'Fresh tagline.',
                'footer_copyright' => '© 2026 NEWLOGO.',
            ])
            ->assertRedirect();

        PortfolioService::flush();

        $response = $this->get(route('home'));
        $response->assertOk();
        $response->assertSee('NEWLOGO');
        $response->assertSee('Backend Engineer');
        $response->assertSee('All about me');
        $response->assertSee('Paragraph one.');
        $response->assertSee('Paragraph two.');
    }

    public function test_projects_can_be_created_listed_and_deleted(): void
    {
        $this->actingAsAdmin()
            ->post(route('admin.projects.store'), [
                'name' => 'New Project',
                'description' => 'A brand new project description.',
                'technologies' => 'Laravel, MySQL',
            ])
            ->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseHas('projects', ['name' => 'New Project']);
        PortfolioService::flush();

        $this->get(route('home'))->assertSee('New Project');

        $project = Project::where('name', 'New Project')->firstOrFail();

        $this->actingAsAdmin()->delete(route('admin.projects.destroy', $project))->assertRedirect();
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_stats_can_be_managed(): void
    {
        $this->actingAsAdmin()
            ->post(route('admin.stats.store'), [
                'value' => 42,
                'suffix' => '+',
                'label' => 'Side Projects',
            ])
            ->assertRedirect(route('admin.stats.index'));

        $this->assertDatabaseHas('stats', ['label' => 'Side Projects']);

        $stat = Stat::firstOrFail();

        $this->actingAsAdmin()
            ->put(route('admin.stats.update', $stat), [
                'value' => 99,
                'suffix' => '%',
                'label' => 'Enthusiasm',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('stats', ['id' => $stat->id, 'value' => 99]);
    }

    public function test_messages_can_be_read_and_toggled(): void
    {
        $message = ContactMessage::create([
            'name' => 'Bob', 'email' => 'bob@example.com', 'subject' => 'Hello',
            'message' => 'A message from Bob about a project.',
        ]);

        $this->actingAsAdmin()->get(route('admin.messages.show', $message))->assertOk();

        $this->assertTrue($message->fresh()->is_read);

        $this->actingAsAdmin()->patch(route('admin.messages.toggle', $message))->assertRedirect();
        $this->assertFalse($message->fresh()->is_read);
    }

    public function test_skills_and_services_render_from_database(): void
    {
        $group = SkillGroup::create(['category' => 'Backend', 'icon' => 'server', 'blurb' => 'APIs']);
        $group->skills()->create([
            'name' => 'Laravel', 'abbr' => 'LA', 'level' => 90, 'color' => '#ff2d20',
        ]);

        Service::create([
            'icon' => 'code', 'title' => 'API Design',
            'description' => 'Build clean REST APIs.',
        ]);

        PortfolioService::flush();

        $response = $this->get(route('home'));
        $response->assertOk();
        $response->assertSee('Backend');
        $response->assertSee('Laravel');
        $response->assertSee('API Design');
    }

    public function test_nav_links_can_be_managed(): void
    {
        $this->actingAsAdmin()
            ->post(route('admin.nav-links.store'), [
                'label' => 'Blog',
                'href' => '#blog',
            ])
            ->assertRedirect(route('admin.nav-links.index'));

        $this->assertDatabaseHas('nav_links', ['label' => 'Blog']);

        $link = NavLink::firstOrFail();
        $this->actingAsAdmin()->delete(route('admin.nav-links.destroy', $link))->assertRedirect();
        $this->assertDatabaseMissing('nav_links', ['id' => $link->id]);
    }

    public function test_socials_can_be_managed(): void
    {
        $this->actingAsAdmin()
            ->post(route('admin.socials.store'), [
                'label' => 'Twitter',
                'icon' => 'github',
                'href' => 'https://twitter.com/kimlay',
            ])
            ->assertRedirect(route('admin.socials.index'));

        $this->assertDatabaseHas('socials', ['label' => 'Twitter']);
    }

    public function test_logout_logs_the_user_out(): void
    {
        $this->actingAsAdmin()
            ->post('/admin/logout')
            ->assertRedirect('/admin/login');

        $this->assertGuest();
    }
}
