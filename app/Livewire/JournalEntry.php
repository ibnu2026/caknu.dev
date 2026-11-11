<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class JournalEntry extends Component
{
    #[Locked]
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        abort_unless($this->entry(), 404);
    }

    public function render(): View
    {
        $entry = $this->entry();

        return view('livewire.journal-entry', [
            'entry' => $entry,
        ])->layout('layouts.app')
            ->title($entry['title'].' — Ibnu')
            ->layoutData(['description' => $entry['excerpt']]);
    }

    private function entry(): ?array
    {
        foreach (config('portfolio.journal', []) as $entry) {
            if ($entry['slug'] === $this->slug) {
                return $entry;
            }
        }

        return null;
    }
}
