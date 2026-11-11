<div>
    @include('components.site-header')
    <main class="detail-page section-shell">
        <a class="detail-back" href="{{ route('home') }}#journal"><span aria-hidden="true">←</span> BACK TO JOURNAL</a>
        <article class="article-detail">
            <header class="article-header">
                <div class="section-label"><span>FIELD NOTE</span> / {{ $entry['category'] }}</div>
                <h1>{{ $entry['title'] }}</h1>
                <p class="article-excerpt">{{ $entry['excerpt'] }}</p>
                <div class="article-byline"><span>AHMAD IBNU ZAINI</span><span>{{ $entry['published_at'] ?? 'UNDATED NOTE' }}</span></div>
            </header>
            <div class="article-cover {{ $entry['cover'] }}">
                <span class="journal-cover-mark">{{ $entry['cover'] === 'journal-learning' ? 'LEARN' : 'PROCESS' }}</span>
                <span class="journal-cover-index">IBNU. / NOTES</span>
            </div>
            <div class="article-body">
                @foreach ($entry['body'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
            <div class="article-endnote">
                <span class="status-dot"></span>
                <span>ALWAYS LEARNING. ALWAYS BUILDING. ALWAYS GROWING.</span>
            </div>
        </article>
        <a class="detail-back detail-back-bottom" href="{{ route('home') }}#journal"><span aria-hidden="true">←</span> MORE NOTES</a>
    </main>
    <footer class="site-footer section-shell">
        <div class="footer-top"><a class="wordmark" href="{{ route('home') }}#home">IBNU<span>.</span></a><span>Designed & built with curiosity.</span><a class="back-top" href="#top">BACK TO TOP ↑</a></div>
        <div class="footer-bottom"><span>© {{ now()->year }} AHMAD IBNU ZAINI</span><span>ALWAYS LEARNING. ALWAYS BUILDING. ALWAYS GROWING.</span><span>MADE IN INDONESIA</span></div>
    </footer>
</div>
