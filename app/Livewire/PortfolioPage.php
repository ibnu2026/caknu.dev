<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PortfolioPage extends Component
{
    public string $name = '';

    public string $email = '';

    public string $subject = '';

    public string $message = '';

    public function submitContact(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
        ]);

        ContactMessage::create($validated);

        $this->reset(['name', 'email', 'subject', 'message']);
        session()->flash('contact-sent', 'Pesanmu sudah tersimpan. Terima kasih sudah menghubungi!');
    }

    public function render(): View
    {
        return view('livewire.portfolio-page', [
            'projects' => config('portfolio.projects'),
            'skillGroups' => config('portfolio.skills'),
            'skillLevels' => config('portfolio.skill_levels'),
            'journey' => config('portfolio.journey'),
            'journalEntries' => config('portfolio.journal'),
            'contactDetails' => config('portfolio.contact'),
        ])->title('Ibnu — Always Learning, Always Building');
    }
}
