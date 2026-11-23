<div>
    <div class="boot-screen" id="boot-screen" role="dialog" aria-modal="true" aria-label="Portfolio start screen">
        <button class="boot-run-button" id="boot-run" type="button" aria-label="Run portfolio">
            <svg class="boot-play-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5.5v13L19 12 8 5.5Z"></path></svg>
            <span>RUN</span>
        </button>
        <span class="boot-cursor" aria-hidden="true">
            <svg viewBox="0 0 24 28"><path d="M3 2.5v19l5.2-5 3.5 7 3.1-1.6-3.6-6.8 7.4.2L3 2.5Z"></path></svg>
        </span>
        <div class="boot-terminal-screen" id="boot-terminal" aria-label="Simulated portfolio startup terminal" hidden>
            <div class="boot-terminal-bar">
                <span><i class="boot-terminal-indicator"></i> ibnu@portfolio:~</span>
                <span class="boot-terminal-state" id="boot-terminal-state">SIMULATED STARTUP</span>
            </div>
            <div class="boot-terminal-body">
                <p class="boot-terminal-title">PORTFOLIO <span>BOOT SEQUENCE</span></p>
                <div class="boot-output" id="boot-output" role="log" aria-live="polite" aria-relevant="additions"></div>
                <div class="boot-progress" aria-hidden="true"><span id="boot-progress"></span></div>
                <p class="boot-terminal-footer">SIMULATED STARTUP / PHP · LARAVEL · REACT</p>
            </div>
        </div>
    </div>

    @include('components.site-header')

    <main>
        <section class="hero section-shell" id="home">
            <div class="hero-grid">
                <div class="hero-copy">
                    <h1>Building Ideas.<br><span>Creating</span><br>Possibilities<span class="blue-dot">.</span></h1>
                    <p class="hero-description">Hi, I’m Ibnu — an Information Technology student and aspiring developer exploring the intersection of technology, creativity, and innovation.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="#projects">Explore my work <span aria-hidden="true">↘</span></a>
                        <a class="button button-quiet" href="#contact">Get in touch <span aria-hidden="true">↗</span></a>
                    </div>
                </div>

                <div class="hero-art">
                    <img class="hero-portrait" src="{{ asset('images/saya-portrait-cutout.png') }}" alt="Foto Ahmad Ibnu Zaini">
                    <div class="art-coordinate">INDONESIA<br>ALWAYS EXPLORING</div>
                    <div class="art-grain"></div>
                    <div class="art-caption">
                        <span class="caption-label">CURRENTLY EXPLORING</span>
                        <strong><span class="typing-text">Software Developer</span><span class="typing-cursor">_</span></strong>
                        <span class="caption-location">Information Technology Student <i></i></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="intro-section section-shell" id="about">
            <div class="intro-grid">
                <h2>A little<br>about <em>me.</em></h2>
                <div class="intro-copy">
                    <p class="large-copy">I enjoy learning, experimenting, and exploring how technology can solve real-world problems.</p>
                    <p>My journey in Information Technology has introduced me to software development, artificial intelligence, the Internet of Things, system design, and digital innovation.</p>
                    <p>Every project is an opportunity to learn something new. I don’t just want to build applications; I want to create solutions with purpose and impact.</p>
                    <a class="text-link" href="#journey">A little more about my journey <span aria-hidden="true">↘</span></a>
                </div>
            </div>
            <div class="about-details">
                <div class="detail-block">
                    <span class="detail-label">EDUCATION</span>
                    <strong>Universitas Annuqayah</strong>
                    <span>Teknologi Informasi</span>
                </div>
                <div class="detail-block">
                    <span class="detail-label">BASED IN</span>
                    <strong>Indonesia</strong>
                    <span>Always open to new perspectives</span>
                </div>
                <div class="detail-block detail-interests">
                    <span class="detail-label">THINGS ON MY MIND</span>
                    <div class="interest-list">
                        <span>Software Development</span><span>Artificial Intelligence</span><span>IoT</span><span>UI/UX Design</span><span>Research</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="skills-section section-shell">
            <div class="section-heading">
                <div>
                    <h2>A growing<br>toolkit<span class="blue-dot">.</span></h2>
                </div>
                <p>Not a checklist of expertise — just the tools and ideas I’m spending time with, one project at a time.</p>
            </div>
            <div class="skills-grid">
                @foreach ($skillGroups as $category => $skills)
                    <article class="skill-group">
                        <div class="skill-group-heading"><span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $category }}</h3></div>
                        <div class="skill-list">
                            @foreach ($skills as $skill)
                                <span class="skill-pill"><i aria-hidden="true">{{ strtoupper(substr($skill, 0, 1)) }}</i>{{ $skill }}@if ($skillLevels[$skill] ?? null)<small>{{ $skillLevels[$skill] }}</small>@endif</span>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="projects-section section-shell" id="projects">
            <div class="section-heading projects-heading">
                <div>
                    <h2>Things I’ve<br>built<span class="blue-dot">.</span></h2>
                </div>
                <p>Small steps, real questions, and a lot of learning along the way.</p>
            </div>
            <div class="projects-grid">
                @foreach ($projects as $project)
                    <article class="project-card {{ $project['class'] }}">
                        <div class="project-info">
                            <div>
                                <span class="project-category">{{ $project['category'] }}</span>
                                <h3>{{ $project['name'] }}</h3>
                                <p>{{ $project['description'] }}</p>
                            </div>
                            <div class="project-meta">
                                <div class="tag-list">@foreach ($project['stack'] as $technology)<span>{{ $technology }}</span>@endforeach</div>
                                <div class="project-links">
                                    <a class="project-detail-link" href="{{ route('projects.show', $project['slug']) }}">View details <span aria-hidden="true">↗</span></a>
                                    @if ($project['github_url'])
                                        <a href="{{ $project['github_url'] }}" target="_blank" rel="noopener noreferrer">GitHub</a>
                                    @elseif ($project['github_private'] ?? false)
                                        <span class="coming-soon">Private repository</span>
                                    @endif
                                    @if ($project['demo_url'])
                                        <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener noreferrer">{{ $project['demo_label'] ?? 'Live demo' }}</a>
                                    @endif
                                    @if (! $project['github_url'] && ! ($project['github_private'] ?? false) && ! $project['demo_url'])
                                        <span class="coming-soon">Repository & demo links not added</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="projects-note"><span class="status-dot"></span> More experiments are taking shape. Check back soon.</div>
        </section>

        <section class="research-section section-shell" id="research">
            <div class="section-heading">
                <div>
                    <h2>Researching<br>what’s possible<span class="blue-dot">.</span></h2>
                </div>
                <p>Following questions that connect language, intelligent systems, and the world beyond the screen.</p>
            </div>
            <article class="research-feature">
                <div class="research-content">
                    <div class="research-status"><span class="status-dot"></span> EXPLORATION PHASE</div>
                    <h3>SAKA <span>— Offline Speech AI<br>for Smart Irrigation</span></h3>
                    <p>Exploring how offline speech recognition and IoT sensing might support more accessible, responsive agricultural monitoring.</p>
                    <div class="research-objectives">
                        <span class="detail-label">RESEARCH OBJECTIVES</span>
                        <ul>
                            <li>Explore speech-based interaction for offline irrigation monitoring.</li>
                            <li>Study Indonesian speech recognition approaches and transfer learning.</li>
                            <li>Investigate how model optimization and IoT sensing could fit the system.</li>
                        </ul>
                    </div>
                    <div class="research-topics"><span>Speech Recognition</span><span>Indonesian Speech</span><span>Transfer Learning</span><span>Fine-Tuning</span><span>Model Quantization</span><span>IoT</span><span>Smart Agriculture</span></div>
                    <div class="research-foot"><span>DOCUMENTATION & PUBLICATIONS</span><span>Not published yet <i aria-hidden="true">↗</i></span></div>
                </div>
            </article>
        </section>

        <div class="journey-scroll-track">
            <section class="journey-section section-shell" id="journey" data-journey-step="0">
                <div class="journey-title">
                    <h2>My journey<br>so far<span class="blue-dot">.</span></h2>
                    <p>No shortcuts, no finished story. Just the next thing to learn.</p>
                </div>
                <div class="journey-list" aria-live="polite" aria-label="Journey steps">
                    @foreach ($journey as $item)
                        <article class="journey-item" data-journey-step="{{ $loop->iteration }}">
                            <span class="journey-date">{{ $item['date'] }}</span>
                            <span class="journey-node" aria-hidden="true"></span>
                            <div><h3>{{ $item['title'] }}</h3><p>{{ $item['text'] }}</p></div>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>

        <section class="achievements-section section-shell" id="achievements">
            <div class="section-heading">
                <div>
                    <h2>Milestones<br>& recognition<span class="blue-dot">.</span></h2>
                </div>
                <p>A growing collection of certificates and milestones from my learning journey.</p>
            </div>
            <div class="achievement-empty">
                <div class="achievement-empty-copy">
                    <div class="detail-label">COLLECTION IN PROGRESS</div>
                    <h3>More milestones are on the way.</h3>
                    <p>Certificates and achievements will be added here as they are ready to share.</p>
                </div>
            </div>
        </section>

        <section class="journal-section section-shell" id="journal">
            <div class="section-heading">
                <div>
                    <h2>Thoughts, notes<br>& discoveries<span class="blue-dot">.</span></h2>
                </div>
                <p>A space for what I’m learning — from code and research to books, films, and the little things in between.</p>
            </div>
            <div class="journal-grid">
                @foreach ($journalEntries as $entry)
                    <article class="journal-card">
                        <div class="journal-card-content">
                            <div class="journal-card-meta"><span>{{ $entry['category'] }}</span><span>{{ $entry['published_at'] ?? 'UNDATED NOTE' }}</span></div>
                            <h3><a href="{{ route('journal.show', $entry['slug']) }}">{{ $entry['title'] }}</a></h3>
                            <p>{{ $entry['excerpt'] }}</p>
                            <a class="text-link" href="{{ route('journal.show', $entry['slug']) }}">Read note <span aria-hidden="true">↗</span></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="quote-section section-shell">
            <div class="quote-decoration" aria-hidden="true">“</div>
            <div class="section-label"><span>PERSONAL PHILOSOPHY</span></div>
            <blockquote>“Pelan-pelan, tetapi terus berjalan. Sebab setiap proses selalu punya sesuatu untuk diajarkan.”</blockquote>
            <div class="quote-attribution"><span></span> A NOTE TO MYSELF</div>
        </section>

        <section class="contact-section section-shell" id="contact">
            <div class="contact-intro">
                <div class="section-label"><span>LET’S CONNECT</span></div>
                <h2>Have an idea?<br>Let’s build<br><em>something.</em></h2>
                <p>I’m always interested in exploring new ideas, collaborating on meaningful projects, and connecting with people who love creating things.</p>
                <div class="contact-socials">
                    <span>FIND ME ELSEWHERE</span>
                    <div>
                        @foreach (['GitHub' => 'github_url', 'CodePen' => 'codepen_url', 'LinkedIn' => 'linkedin_url', 'Instagram' => 'instagram_url'] as $label => $key)
                            @if ($contactDetails[$key])
                                <a href="{{ $contactDetails[$key] }}" target="_blank" rel="noopener noreferrer">{{ $label }} <small>OPEN PROFILE ↗</small></a>
                            @else
                                <span>{{ $label }} <small>LINK NOT ADDED</small></span>
                            @endif
                        @endforeach
                    </div>
                    <div class="contact-email">
                        @if ($contactDetails['email'])
                            <a href="mailto:{{ $contactDetails['email'] }}">{{ $contactDetails['email'] }}</a>
                        @else
                            <span>Email <small>ADDRESS NOT ADDED</small></span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="contact-form-wrap">
                @if (session()->has('contact-sent'))
                    <div class="form-success" role="status">{{ session('contact-sent') }}</div>
                @endif
                <form wire:submit="submitContact">
                    <div class="form-row">
                        <label for="contact-name">Your name</label>
                        <input id="contact-name" type="text" wire:model="name" autocomplete="name" placeholder="How should I call you?">
                        @error('name') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-row">
                        <label for="contact-email">Email address</label>
                        <input id="contact-email" type="email" wire:model="email" autocomplete="email" placeholder="you@example.com">
                        @error('email') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-row">
                        <label for="contact-subject">Subject</label>
                        <input id="contact-subject" type="text" wire:model="subject" placeholder="What’s on your mind?">
                        @error('subject') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-row">
                        <label for="contact-message">Your message</label>
                        <textarea id="contact-message" wire:model="message" rows="4" placeholder="Tell me a little about it..."></textarea>
                        @error('message') <span class="field-error">{{ $message }}</span> @enderror
                    </div>
                    <button class="button button-primary submit-button" type="submit">
                        <span wire:loading.remove wire:target="submitContact">Send message <span aria-hidden="true">↗</span></span>
                        <span wire:loading wire:target="submitContact">Sending…</span>
                    </button>
                    <p class="form-privacy">Your message is stored privately so Ibnu can follow up. Contact details will be added here soon.</p>
                </form>
            </div>
        </section>
    </main>

    <footer class="site-footer section-shell">
        <div class="footer-top"><a class="wordmark" href="#home">IBNU<span>.</span></a><span>Designed & built with curiosity.</span><a class="back-top" href="#top">BACK TO TOP ↑</a></div>
        <nav class="footer-nav" aria-label="Footer navigation"><a href="#home">Home</a><a href="#about">About</a><a href="#projects">Projects</a><a href="#research">Research</a><a href="#achievements">Achievements</a><a href="#journal">Journal</a><a href="#contact">Contact</a></nav>
        <div class="footer-bottom"><span>© {{ now()->year }} AHMAD IBNU ZAINI</span><span>ALWAYS LEARNING. ALWAYS BUILDING. ALWAYS GROWING.</span><span>MADE IN INDONESIA</span></div>
    </footer>
</div>
