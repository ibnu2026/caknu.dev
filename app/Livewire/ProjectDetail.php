<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ProjectDetail extends Component
{
    #[Locked]
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        abort_unless($this->project(), 404);
    }

    public function render(): View
    {
        $project = $this->project();

        return view('livewire.project-detail', [
            'project' => $project,
        ])->layout('layouts.app')
            ->title($project['name'].' — Ibnu')
            ->layoutData(['description' => $project['description']]);
    }

    private function project(): ?array
    {
        foreach (config('portfolio.projects', []) as $project) {
            if ($project['slug'] === $this->slug) {
                return $project;
            }
        }

        return null;
    }
}
