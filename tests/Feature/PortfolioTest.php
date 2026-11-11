<?php

namespace Tests\Feature;

use App\Livewire\PortfolioPage;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_portfolio_page_displays_the_featured_projects(): void
    {
        $this->withoutVite();

        $this->get('/')
            ->assertOk()
            ->assertSee('Building Ideas.')
            ->assertSee('<div id="top" aria-hidden="true"></div>', false)
            ->assertSee('href="#top"', false)
            ->assertSee('SAKA')
            ->assertSee('A Latee Library')
            ->assertSee('Sevent')
            ->assertSee('El-Jawie Community')
            ->assertSee('Thoughts, notes');
    }

    public function test_project_detail_pages_are_available_for_featured_projects(): void
    {
        $this->withoutVite();

        $this->get(route('projects.show', 'saka'))
            ->assertOk()
            ->assertSee('Speech AI for Knowledge in Agriculture')
            ->assertSee('WHAT I’M EXPLORING');

        $this->get(route('projects.show', 'sevent'))
            ->assertOk()
            ->assertSee('Sevent Multi-Game Arcade')
            ->assertSee('Supabase');

        $this->get(route('projects.show', 'el-jawie-community'))
            ->assertOk()
            ->assertSee('El-Jawie Community Platform')
            ->assertSee('Bootstrap 5')
            ->assertSee('PRIVATE');

        $this->get(route('projects.show', 'a-latee-library'))
            ->assertOk()
            ->assertSee('https://github.com/ibnu2026/A-Latee-Library');

        $this->get(route('projects.show', 'unknown-project'))->assertNotFound();
    }

    public function test_journal_entries_have_dedicated_detail_pages(): void
    {
        $this->withoutVite();

        $this->get(route('journal.show', 'a-project-is-a-place-to-start-learning'))
            ->assertOk()
            ->assertSee('A project is a place to start learning')
            ->assertSee('UNDATED NOTE');

        $this->get(route('journal.show', 'unknown-entry'))->assertNotFound();
    }

    public function test_a_valid_contact_message_is_saved(): void
    {
        Livewire::test(PortfolioPage::class)
            ->set('name', 'Nadia Example')
            ->set('email', 'nadia@example.org')
            ->set('subject', 'A collaboration idea')
            ->set('message', 'I would love to talk about a meaningful project together.')
            ->call('submitContact')
            ->assertHasNoErrors()
            ->assertSee('Pesanmu sudah tersimpan');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Nadia Example',
            'email' => 'nadia@example.org',
            'subject' => 'A collaboration idea',
        ]);
    }

    public function test_invalid_contact_messages_are_not_saved(): void
    {
        Livewire::test(PortfolioPage::class)
            ->set('name', '')
            ->set('email', 'not-an-email')
            ->set('subject', '')
            ->set('message', 'Too short')
            ->call('submitContact')
            ->assertHasErrors(['name', 'email', 'subject', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }
}
