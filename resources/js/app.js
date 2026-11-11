import './bootstrap';

const root = document.documentElement;
const themeButton = document.querySelector('.theme-toggle');
const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('.main-nav');

const storedTheme = window.localStorage.getItem('ibnu-theme');
if (storedTheme === 'light' || storedTheme === 'dark') {
    root.dataset.theme = storedTheme;
}

function updateThemeLabel() {
    themeButton?.setAttribute(
        'aria-label',
        root.dataset.theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme',
    );
}

updateThemeLabel();

themeButton?.addEventListener('click', () => {
    root.dataset.theme = root.dataset.theme === 'dark' ? 'light' : 'dark';
    window.localStorage.setItem('ibnu-theme', root.dataset.theme);
    updateThemeLabel();
});

menuButton?.addEventListener('click', () => {
    const isOpen = menuButton.getAttribute('aria-expanded') === 'true';
    menuButton.setAttribute('aria-expanded', String(!isOpen));
    menuButton.setAttribute('aria-label', isOpen ? 'Open navigation' : 'Close navigation');
    navigation?.classList.toggle('is-open', !isOpen);
});

navigation?.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', () => {
        menuButton?.setAttribute('aria-expanded', 'false');
        menuButton?.setAttribute('aria-label', 'Open navigation');
        navigation.classList.remove('is-open');
    });
});

const roleElement = document.querySelector('.typing-text');
const roles = ['Software Developer', 'Technology Enthusiast', 'Research Explorer', 'Creative Thinker'];

if (roleElement && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    let roleIndex = 0;
    let characterIndex = roles[0].length;
    let deleting = true;

    const typeRole = () => {
        const role = roles[roleIndex];
        characterIndex += deleting ? -1 : 1;
        roleElement.textContent = role.slice(0, characterIndex);

        if (characterIndex === 0) {
            deleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
            window.setTimeout(typeRole, 350);
            return;
        }

        if (characterIndex === roles[roleIndex].length) {
            deleting = true;
            window.setTimeout(typeRole, 1900);
            return;
        }

        window.setTimeout(typeRole, deleting ? 38 : 65);
    };

    window.setTimeout(typeRole, 1900);
}

const revealTargets = document.querySelectorAll('main > section:not(.hero)');
if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });

    revealTargets.forEach((section) => {
        section.setAttribute('data-reveal', '');
        revealObserver.observe(section);
    });
} else {
    revealTargets.forEach((section) => section.classList.add('is-visible'));
}
