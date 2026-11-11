<div>
    @include('components.site-header')

    <main>
        <section class="hero section-shell" id="home">
            <div class="hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow"><span class="status-dot"></span> Curious by nature. Building as I learn.</p>
                    <h1>Building Ideas.<br><span>Creating</span><br>Possibilities<span class="blue-dot">.</span></h1>
                    <p class="hero-description">Hi, I’m Ibnu — an Information Technology student and aspiring developer exploring the intersection of technology, creativity, and innovation.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="#projects">Explore my work <span aria-hidden="true">↘</span></a>
                        <a class="button button-quiet" href="#contact">Get in touch <span aria-hidden="true">↗</span></a>
                    </div>
                    <div class="hero-footnote">
                        <span>AHMAD IBNU ZAINI</span>
                        <span class="footnote-divider"></span>
                        <span>INDONESIA · {{ now()->format('Y') }}</span>
                    </div>
                </div>

                <div class="hero-art">
                    <img class="hero-portrait" src="{{ asset('images/saya-portrait-cutout.png') }}" alt="Foto Ahmad Ibnu Zaini">
                    <div class="art-coordinate">INDONESIA<br>ALWAYS EXPLORING</div>
                    <div class="art-index">FIG. 01 — A WORK IN PROGRESS</div>
                    <div class="art-grain"></div>
                    <div class="art-caption">
                        <span class="caption-label">CURRENTLY EXPLORING</span>
                        <strong><span class="typing-text">Software Developer</span><span class="typing-cursor">_</span></strong>
                        <span class="caption-location">Information Technology Student <i></i></span>
                    </div>
                </div>
            </div>
            <div class="hero-bottom">
                <span>SCROLL TO EXPLORE</span>
                <span class="scroll-line"></span>
                <span>01 / 06</span>
            </div>
        </section>

        <section class="intro-section section-shell" id="about">
            <div class="section-label"><span>01</span> A LITTLE ABOUT ME</div>
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
                <div class="about-mark" aria-hidden="true">A<span>.</span></div>
            </div>
            <div class="values-strip" aria-label="Personal values">
                <span>WHAT KEEPS ME MOVING</span>
                <strong>Curiosity</strong><i></i><strong>Creativity</strong><i></i><strong>Progress</strong>
            </div>
        </section>

        <section class="skills-section section-shell">
            <div class="section-heading">
                <div>
                    <div class="section-label"><span>02</span> TOOLS I’M LEARNING WITH</div>
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
                    <div class="section-label"><span>03</span> SELECTED WORK</div>
                    <h2>Things I’ve<br>built<span class="blue-dot">.</span></h2>
                </div>
                <p>Small steps, real questions, and a lot of learning along the way.</p>
            </div>
            <div class="projects-grid">
                @foreach ($projects as $project)
                    <article class="project-card {{ $project['class'] }}">
                        <div class="project-visual">
                            <span class="visual-index">PROJECT / {{ $project['number'] }}</span>
                            @if ($project['class'] === 'project-saka')
                                <div class="saka-visual" aria-hidden="true">
                                    <div class="saka-sun"></div><div class="saka-field field-one"></div><div class="saka-field field-two"></div><div class="saka-field field-three"></div>
                                    <div class="saka-device"><span class="device-led"></span><span class="device-wave">〰</span><small>SAKA / 01</small></div>
                                    <div class="saka-label">SMART<br>AGRICULTURE</div>
                                </div>
                            @elseif ($project['class'] === 'project-library')
                                <div class="library-visual" aria-hidden="true">
                                    <div class="library-window"><div class="window-top"><i></i><i></i><i></i><span>latee / library</span></div><div class="window-body"><div class="window-sidebar"><b></b><i></i><i></i><i></i></div><div class="window-content"><span class="window-overline">OVERVIEW</span><b>Good morning.</b><div class="window-stats"><i></i><i></i><i></i></div><div class="window-table"><i></i><i></i><i></i><i></i></div></div></div></div>
                                    <div class="library-stamp">A<br><span>LATĒE</span></div>
                                </div>
                            @elseif ($project['class'] === 'project-sevent')
                                <div class="sevent-visual" aria-hidden="true">
                                    <div class="sevent-screen">
                                        <div class="sevent-topline"><span>SEVENT</span><i>GAME HUB</i></div>
                                        <div class="sevent-headline">PICK YOUR<br><b>NEXT GAME</b></div>
                                        <div class="sevent-game-grid"><i>♟<small>CHESS</small></i><i>▦<small>SUDOKU</small></i><i>✦<small>SHADOW SIGNAL</small></i></div>
                                    </div>
                                    <div class="sevent-orbit sevent-orbit-one"></div><div class="sevent-orbit sevent-orbit-two"></div>
                                </div>
                            @else
                                <div class="eljawie-visual" aria-hidden="true">
                                    <div class="community-board">
                                        <div class="community-topline"><span class="community-mark">EJ</span><span>EL-JAWIE <i>COMMUNITY</i></span><b>MEMBER SPACE / 01</b></div>
                                        <div class="community-headline">RUANG BERTUMBUH<br><em>BERSAMA.</em></div>
                                        <div class="community-stories">
                                            <div><small>01 / KARYA</small><b>Member stories</b><i></i></div>
                                            <div><small>02 / KEGIATAN</small><b>Community life</b><i></i></div>
                                            <div><small>03 / WAWASAN</small><b>Shared ideas</b><i></i></div>
                                        </div>
                                    </div>
                                    <span class="community-orbit community-orbit-one"></span><span class="community-orbit community-orbit-two"></span>
                                </div>
                            @endif
                            <span class="project-counter">{{ $project['number'] }} <b>—</b> {{ str_pad((string) count($projects), 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
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
                                        <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener noreferrer">Live demo</a>
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
                    <div class="section-label"><span>04</span> RESEARCH & EXPLORATION</div>
                    <h2>Researching<br>what’s possible<span class="blue-dot">.</span></h2>
                </div>
                <p>Following questions that connect language, intelligent systems, and the world beyond the screen.</p>
            </div>
            <article class="research-feature">
                <div class="research-index"><span>RESEARCH FOCUS</span><b>R / 01</b><div class="research-orbit"><i></i><i></i><i></i></div></div>
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
            <div class="research-bottom"><span>01 — AN ONGOING LEARNING THREAD</span><span>Progress: exploration & experimentation</span></div>
        </section>

        <section class="journey-section section-shell" id="journey">
            <div class="journey-title">
                <div class="section-label"><span>05</span> EXPERIENCE & JOURNEY</div>
                <h2>My journey<br>so far<span class="blue-dot">.</span></h2>
                <p>No shortcuts, no finished story. Just the next thing to learn.</p>
            </div>
            <div class="journey-list">
                @foreach ($journey as $item)
                    <article class="journey-item">
                        <span class="journey-date">{{ $item['date'] }}</span>
                        <span class="journey-node"></span>
                        <div><h3>{{ $item['title'] }}</h3><p>{{ $item['text'] }}</p></div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="journal-section section-shell" id="journal">
            <div class="section-heading">
                <div>
                    <div class="section-label"><span>06</span> JOURNAL / NOTES</div>
                    <h2>Thoughts, notes<br>& discoveries<span class="blue-dot">.</span></h2>
                </div>
                <p>A space for what I’m learning — from code and research to books, films, and the little things in between.</p>
            </div>
            <div class="journal-grid">
                @foreach ($journalEntries as $entry)
                    <article class="journal-card">
                        <a class="journal-cover {{ $entry['cover'] }}" href="{{ route('journal.show', $entry['slug']) }}" aria-label="Read {{ $entry['title'] }}">
                            <span class="visual-index">FIELD NOTE / {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="journal-cover-mark">{{ $loop->iteration === 1 ? 'LEARN' : 'PROCESS' }}</span>
                            <span class="journal-cover-index">IBNU. / NOTES</span>
                        </a>
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
                        @foreach (['GitHub' => 'github_url', 'LinkedIn' => 'linkedin_url', 'Instagram' => 'instagram_url'] as $label => $key)
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
                <div class="form-heading"><span>01 — SEND A MESSAGE</span><span class="form-asterisk">*</span></div>
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
        <nav class="footer-nav" aria-label="Footer navigation"><a href="#home">Home</a><a href="#about">About</a><a href="#projects">Projects</a><a href="#research">Research</a><a href="#journal">Journal</a><a href="#contact">Contact</a></nav>
        <div class="footer-bottom"><span>© {{ now()->year }} AHMAD IBNU ZAINI</span><span>ALWAYS LEARNING. ALWAYS BUILDING. ALWAYS GROWING.</span><span>MADE IN INDONESIA</span></div>
    </footer>
</div>
