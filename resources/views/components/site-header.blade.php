<div id="top" aria-hidden="true"></div>
<header class="site-header">
    <a class="wordmark" href="{{ route('home') }}#home" aria-label="Ibnu, back to home">IBNU<span>.</span></a>
    <button class="menu-toggle" type="button" aria-label="Open navigation" aria-expanded="false" aria-controls="primary-nav">
        <span></span><span></span>
    </button>
    <nav class="main-nav" id="primary-nav" aria-label="Main navigation">
        <a href="{{ route('home') }}#home">Home</a>
        <a href="{{ route('home') }}#about">About</a>
        <a href="{{ route('home') }}#projects">Projects</a>
        <a href="{{ route('home') }}#research">Research</a>
        <a href="{{ route('home') }}#achievements">Achievements</a>
        <a href="{{ route('home') }}#journal">Journal</a>
        <a href="{{ route('home') }}#contact">Contact</a>
        <button class="theme-toggle" type="button" aria-label="Switch to light theme">
            <svg class="icon-sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"></path></svg>
            <svg class="icon-moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.2 15.4A8.5 8.5 0 0 1 8.6 3.8 8.5 8.5 0 1 0 20.2 15.4Z"></path></svg>
        </button>
        <a class="nav-cta" href="{{ route('home') }}#contact">Let’s talk <span aria-hidden="true">↗</span></a>
    </nav>
</header>
