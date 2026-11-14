import './bootstrap';

const root = document.documentElement;
const themeButton = document.querySelector('.theme-toggle');
const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('.main-nav');

const bootScreen = document.querySelector('#boot-screen');
const bootRunButton = document.querySelector('#boot-run');
const bootTerminal = document.querySelector('#boot-terminal');
const bootOutput = document.querySelector('#boot-output');
const bootProgress = document.querySelector('#boot-progress');
const bootTerminalState = document.querySelector('#boot-terminal-state');
const bootStorageWarning = document.querySelector('#boot-storage-warning');
const bootStorageKey = 'ibnu-portfolio-run';

if (bootScreen && bootRunButton && bootTerminal && bootOutput && bootProgress && bootTerminalState) {
    let hasRun = false;

    try {
        hasRun = window.localStorage.getItem(bootStorageKey) === 'true';
    } catch (error) {
        console.error('Could not read the portfolio startup state from browser storage.', error);
        bootStorageWarning?.removeAttribute('hidden');
    }

    if (hasRun) {
        bootScreen.remove();
    } else {
        const startupLines = [
            '$ python manage.py runserver',
            '✓ Python environment checked',
            '$ php artisan serve',
            '✓ Laravel portfolio loaded',
            '$ npm run build',
            '✓ React-inspired interface ready',
        ];
        const delay = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 0 : 360;

        document.body.classList.add('is-booting');
        bootRunButton.focus();

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Tab' && bootScreen.isConnected) {
                event.preventDefault();
                (bootTerminal.hidden ? bootRunButton : bootTerminal).focus();
            }
        });

        bootRunButton.addEventListener('click', () => {
            bootRunButton.hidden = true;
            bootTerminal.hidden = false;
            bootTerminal.setAttribute('tabindex', '-1');
            bootTerminal.focus();
            bootTerminalState.textContent = 'RUNNING';
            bootOutput.replaceChildren();

            try {
                window.localStorage.setItem(bootStorageKey, 'true');
            } catch (error) {
                console.error('Could not save the portfolio startup state to browser storage.', error);
                bootStorageWarning?.removeAttribute('hidden');
            }

            startupLines.forEach((text, index) => {
                window.setTimeout(() => {
                    const line = document.createElement('p');
                    line.className = 'boot-output-line';
                    line.textContent = text;
                    bootOutput.append(line);
                    bootProgress.style.width = `${Math.round(((index + 1) / startupLines.length) * 100)}%`;

                    if (index === startupLines.length - 1) {
                        line.classList.add('is-success');
                        bootTerminalState.textContent = 'READY';
                        window.setTimeout(() => {
                            bootScreen.classList.add('is-closing');
                            window.setTimeout(() => {
                                bootScreen.remove();
                                document.body.classList.remove('is-booting');
                            }, delay ? 450 : 0);
                        }, delay ? 500 : 0);
                    }
                }, delay * (index + 1));
            });
        });
    }
}

let storedTheme = null;
try {
    storedTheme = window.localStorage.getItem('ibnu-theme');
} catch (error) {
    console.error('Could not read the theme preference from browser storage.', error);
}

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
