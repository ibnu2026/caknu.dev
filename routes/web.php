<?php

use App\Livewire\JournalEntry;
use App\Livewire\PortfolioPage;
use App\Livewire\ProjectDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', PortfolioPage::class)->name('home');
Route::get('/projects/{slug}', ProjectDetail::class)->name('projects.show');
Route::get('/journal/{slug}', JournalEntry::class)->name('journal.show');
