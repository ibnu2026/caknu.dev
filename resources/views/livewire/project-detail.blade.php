<div>
    @include('components.site-header')
    <main class="detail-page section-shell">
        <a class="detail-back" href="{{ route('home') }}#projects"><span aria-hidden="true">←</span> BACK TO PROJECTS</a>
        <article class="project-detail">
            <header class="project-detail-header">
                <div class="section-label"><span>PROJECT / {{ $project['number'] }}</span> · {{ $project['category'] }}</div>
                <h1>{{ $project['name'] }}<span class="blue-dot">.</span></h1>
                <p class="project-detail-subtitle">{{ $project['full_name'] }}</p>
            </header>
            <div class="project-detail-art {{ $project['class'] }}">
                @if ($project['class'] === 'project-saka')
                    <div class="saka-visual" aria-hidden="true"><div class="saka-sun"></div><div class="saka-field field-one"></div><div class="saka-field field-two"></div><div class="saka-field field-three"></div><div class="saka-device"><span class="device-led"></span><span class="device-wave">〰</span><small>SAKA / 01</small></div><div class="saka-label">SMART<br>AGRICULTURE</div></div>
                @elseif ($project['class'] === 'project-library')
                    <div class="library-visual" aria-hidden="true"><div class="library-window"><div class="window-top"><i></i><i></i><i></i><span>latee / library</span></div><div class="window-body"><div class="window-sidebar"><b></b><i></i><i></i><i></i></div><div class="window-content"><span class="window-overline">OVERVIEW</span><b>Good morning.</b><div class="window-stats"><i></i><i></i><i></i></div><div class="window-table"><i></i><i></i><i></i><i></i></div></div></div></div><div class="library-stamp">A<br><span>LATĒE</span></div></div>
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
            </div>
            <div class="project-detail-grid">
                <div class="project-detail-overview">
                    <span class="detail-label">THE IDEA</span>
                    <p>{{ $project['overview'] }}</p>
                    <span class="detail-label">WHAT I’M EXPLORING</span>
                    <ul>
                        @foreach ($project['objectives'] as $objective)
                            <li>{{ $objective }}</li>
                        @endforeach
                    </ul>
                </div>
                <aside class="project-detail-aside">
                    <span class="detail-label">TECHNOLOGIES</span>
                    <div class="tag-list">@foreach ($project['stack'] as $technology)<span>{{ $technology }}</span>@endforeach</div>
                    <div class="project-detail-links">
                        <span class="detail-label">PROJECT LINKS</span>
                        @if ($project['github_url'])
                            <a href="{{ $project['github_url'] }}" target="_blank" rel="noopener noreferrer">GitHub repository ↗</a>
                        @elseif ($project['github_private'] ?? false)
                            <span>GitHub repository <small>PRIVATE</small></span>
                        @else
                            <span>GitHub repository <small>NOT ADDED</small></span>
                        @endif
                        @if ($project['demo_url'])
                            <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener noreferrer">{{ $project['demo_label'] ?? 'Live demo' }} ↗</a>
                        @else
                            <span>Live demo <small>NOT AVAILABLE</small></span>
                        @endif
                    </div>
                </aside>
            </div>
        </article>
        <a class="detail-back detail-back-bottom" href="{{ route('home') }}#projects"><span aria-hidden="true">←</span> MORE PROJECTS</a>
    </main>
    <footer class="site-footer section-shell">
        <div class="footer-top"><a class="wordmark" href="{{ route('home') }}#home">IBNU<span>.</span></a><span>Designed & built with curiosity.</span><a class="back-top" href="#top">BACK TO TOP ↑</a></div>
        <div class="footer-bottom"><span>© {{ now()->year }} AHMAD IBNU ZAINI</span><span>ALWAYS LEARNING. ALWAYS BUILDING. ALWAYS GROWING.</span><span>MADE IN INDONESIA</span></div>
    </footer>
</div>
