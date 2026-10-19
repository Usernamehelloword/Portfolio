<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_stores_a_contact_message_and_redirects_back_to_the_form(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Jane Tester',
            'email' => 'jane@example.com',
            'subject' => 'Project inquiry',
            'message' => 'Hello Kimlay, I would like to discuss a project with you.',
        ]);

        $response->assertRedirect(route('home').'#contact');
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'jane@example.com',
            'subject' => 'Project inquiry',
        ]);
    }

    public function test_rejects_invalid_contact_submissions(): void
    {
        $response = $this->from(route('home'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'subject' => '',
            'message' => 'short',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
        $this->assertSame(0, ContactMessage::count());
    }

    public function test_renders_the_portfolio_homepage_with_all_key_sections(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('KIMLAY.');
        $response->assertSee('Full-Stack Developer');
        $response->assertSee('Featured Work');
        $response->assertSee('ShopLayo');
        $response->assertSee('What I Can Do');
        $response->assertSee("Let's build something great together.");
    }
}
