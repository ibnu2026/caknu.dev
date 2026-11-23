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

if (bootScreen && bootRunButton && bootTerminal && bootOutput && bootProgress && bootTerminalState) {
    const startupLines = [
        '$ python manage.py runserver',
        '✓ Python environment checked',
        '$ php artisan serve',
        '✓ Laravel portfolio loaded',
        '$ npm run build',
        '✓ React-inspired interface ready',
    ];
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const delay = prefersReducedMotion ? 0 : 360;
    let hasStarted = false;
    let autoStartTimer;

    document.body.classList.add('is-booting');
    bootRunButton.focus();

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Tab' && bootScreen.isConnected) {
            event.preventDefault();
            (bootTerminal.hidden ? bootRunButton : bootTerminal).focus();
        }
    });

    bootRunButton.addEventListener('click', () => {
        if (hasStarted) {
            return;
        }

        hasStarted = true;
        window.clearTimeout(autoStartTimer);
        bootScreen.classList.remove('is-auto-starting');
        bootRunButton.hidden = true;
        bootTerminal.hidden = false;
        bootTerminal.setAttribute('tabindex', '-1');
        bootTerminal.focus();
        bootTerminalState.textContent = 'RUNNING';
        bootOutput.replaceChildren();

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

    bootScreen.classList.add('is-auto-starting');
    autoStartTimer = window.setTimeout(() => bootRunButton.click(), prefersReducedMotion ? 300 : 1000);
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

const setupJourneyScroll = () => {
    const journeyTrack = document.querySelector('.journey-scroll-track');
    const journeySection = journeyTrack?.querySelector('.journey-section');
    const journeyItems = journeySection ? [...journeySection.querySelectorAll('.journey-item')] : [];
    const milestonesHeading = document.querySelector('#achievements .section-heading');

    if (journeyTrack && journeySection && journeyItems.length && milestonesHeading) {
        let journeyStep = 0;
        let wheelLockedUntil = 0;
        let lastScrollY = window.scrollY;
        let adjustingJourneyScroll = false;
        let journeyIsActive = false;
        let touchStartY = null;
        let touchAction = null;

        journeyTrack.classList.add('is-scroll-stage');
        journeySection.classList.add('is-step-mode');

        const journeyGeometry = () => {
            const rect = journeyTrack.getBoundingClientRect();
            const stickyTop = Number.parseFloat(window.getComputedStyle(journeySection).top) || 0;

            return {
                rect,
                stickyTop,
                pinStart: Math.max(0, window.scrollY + rect.top - stickyTop),
            };
        };

        const isJourneyPinned = ({ rect, stickyTop }) => (
            rect.top >= stickyTop - 1
            && rect.top <= stickyTop + 1
            && rect.bottom >= window.innerHeight - 1
        );

        const setJourneyStep = (step) => {
            const previousStep = journeyStep;
            journeyStep = Math.max(0, Math.min(journeyItems.length, step));
            journeySection.dataset.journeyStep = String(journeyStep);
            const isReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            journeyItems.forEach((item, index) => {
                const isRevealed = index < journeyStep;
                const isCurrent = index === journeyStep - 1;
                const isLeaving = journeyStep < previousStep && index === journeyStep;

                if (isRevealed) {
                    item.classList.remove('is-exiting');
                } else if (isLeaving && !isReducedMotion) {
                    item.classList.add('is-exiting');
                } else if (isLeaving) {
                    item.classList.remove('is-exiting');
                }

                item.classList.toggle('is-revealed', isRevealed);
                item.classList.toggle('is-entering', isRevealed && index >= previousStep);
                item.setAttribute('aria-hidden', String(!isRevealed));

                if (isCurrent) {
                    item.setAttribute('aria-current', 'step');
                } else {
                    item.removeAttribute('aria-current');
                }
            });
        };

        journeyItems.forEach((item) => {
            item.addEventListener('animationend', (event) => {
                if (event.target === item
                    && event.animationName === 'journey-step-out'
                    && !item.classList.contains('is-revealed')) {
                    item.classList.remove('is-exiting');
                }
            });
        });

        const pinJourney = () => {
            adjustingJourneyScroll = true;
            journeyIsActive = true;
            const { pinStart } = journeyGeometry();
            const previousScrollBehavior = root.style.scrollBehavior;
            root.style.scrollBehavior = 'auto';
            window.scrollTo(0, pinStart);
            root.style.scrollBehavior = previousScrollBehavior;

            window.requestAnimationFrame(() => {
                adjustingJourneyScroll = false;
                lastScrollY = window.scrollY;
            });
        };

        const releaseJourneyToMilestones = () => {
            const { stickyTop } = journeyGeometry();
            const target = window.scrollY + milestonesHeading.getBoundingClientRect().top - stickyTop - 20;
            window.scrollTo({
                top: target,
                behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth',
            });
        };

        const lockWheel = (event) => {
            event.preventDefault();
            wheelLockedUntil = performance.now() + 420;
        };

        document.addEventListener('wheel', (event) => {
            if (event.ctrlKey || Math.abs(event.deltaY) < 1) {
                return;
            }

            const direction = event.deltaY > 0 ? 1 : -1;
            const geometry = journeyGeometry();
            const { rect, stickyTop } = geometry;
            const enteringFromAbove = direction > 0
                && rect.top > stickyTop
                && rect.top - event.deltaY <= stickyTop;
            const reenteringFromBelow = direction < 0
                && rect.top < stickyTop - 1
                && rect.bottom < window.innerHeight
                && rect.bottom - event.deltaY >= window.innerHeight;
            const isPinned = isJourneyPinned(geometry);

            if (performance.now() < wheelLockedUntil) {
                if (enteringFromAbove || reenteringFromBelow || isPinned) {
                    event.preventDefault();
                }
                return;
            }

            if (enteringFromAbove || reenteringFromBelow) {
                lockWheel(event);
                pinJourney();
                return;
            }

            if (direction < 0 && journeyStep > 0 && rect.top < stickyTop - 1 && rect.bottom > stickyTop) {
                lockWheel(event);
                pinJourney();
                return;
            }

            if (!isPinned) {
                return;
            }

            if (direction > 0 && journeyStep === journeyItems.length) {
                lockWheel(event);
                releaseJourneyToMilestones();
                return;
            }

            if ((direction > 0 && journeyStep < journeyItems.length)
                || (direction < 0 && journeyStep > 0)) {
                lockWheel(event);
                setJourneyStep(journeyStep + direction);
            }
        }, { passive: false });

        document.addEventListener('keydown', (event) => {
            if (event.altKey || event.ctrlKey || event.metaKey) {
                return;
            }

            const isInteractiveTarget = event.target instanceof Element
                && event.target.closest('a, button, input, textarea, select, [contenteditable="true"]');
            let direction = 0;

            if (['ArrowDown', 'PageDown'].includes(event.key)) {
                direction = 1;
            } else if (['ArrowUp', 'PageUp'].includes(event.key)) {
                direction = -1;
            } else if (event.code === 'Space' && !isInteractiveTarget) {
                direction = event.shiftKey ? -1 : 1;
            }

            if (!direction) {
                return;
            }

            const geometry = journeyGeometry();
            const { rect, stickyTop } = geometry;

            if (direction < 0 && journeyStep > 0 && rect.top < stickyTop - 1 && rect.bottom > stickyTop) {
                event.preventDefault();
                pinJourney();
                return;
            }

            if (isJourneyPinned(geometry)
                && ((direction > 0 && journeyStep < journeyItems.length)
                    || (direction < 0 && journeyStep > 0))) {
                event.preventDefault();
                setJourneyStep(journeyStep + direction);
            } else if (isJourneyPinned(geometry)
                && direction > 0
                && journeyStep === journeyItems.length) {
                event.preventDefault();
                releaseJourneyToMilestones();
            }
        });

        document.addEventListener('touchstart', (event) => {
            if (event.touches.length !== 1) {
                touchStartY = null;
                touchAction = null;
                return;
            }

            touchStartY = event.touches[0].clientY;
            touchAction = null;
        }, { passive: true });

        document.addEventListener('touchmove', (event) => {
            if (touchStartY === null || event.touches.length !== 1) {
                return;
            }

            const deltaY = touchStartY - event.touches[0].clientY;
            if (Math.abs(deltaY) < 24) {
                return;
            }

            const geometry = journeyGeometry();
            const { rect, stickyTop } = geometry;
            const direction = deltaY > 0 ? 1 : -1;

            if (direction > 0 && rect.top > stickyTop && rect.top - deltaY <= stickyTop) {
                touchAction = 'enter';
            } else if (direction < 0 && rect.top < stickyTop - 1) {
                touchAction = 'reenter';
            } else if (isJourneyPinned(geometry)
                && ((direction > 0 && journeyStep < journeyItems.length)
                    || (direction < 0 && journeyStep > 0))) {
                touchAction = 'step';
            } else if (isJourneyPinned(geometry)
                && direction > 0
                && journeyStep === journeyItems.length) {
                touchAction = 'release';
            } else {
                return;
            }

            event.preventDefault();
        }, { passive: false });

        document.addEventListener('touchend', (event) => {
            if (touchStartY === null || !touchAction || !event.changedTouches.length) {
                touchStartY = null;
                touchAction = null;
                return;
            }

            const direction = touchStartY > event.changedTouches[0].clientY ? 1 : -1;
            if (touchAction === 'enter' || touchAction === 'reenter') {
                pinJourney();
            } else if (touchAction === 'release') {
                releaseJourneyToMilestones();
            } else {
                setJourneyStep(journeyStep + direction);
            }

            touchStartY = null;
            touchAction = null;
        }, { passive: true });

        document.addEventListener('touchcancel', () => {
            touchStartY = null;
            touchAction = null;
        }, { passive: true });

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            if (adjustingJourneyScroll) {
                lastScrollY = currentScrollY;
                return;
            }

            const { pinStart } = journeyGeometry();
            const crossedJourneyFromAbove = journeyStep < journeyItems.length
                && lastScrollY <= pinStart + 1
                && currentScrollY > pinStart + 1;
            const crossedJourneyFromBelow = lastScrollY > pinStart + 1
                && currentScrollY <= pinStart + 1;

            if (crossedJourneyFromAbove) {
                pinJourney();
                return;
            }

            if (crossedJourneyFromBelow) {
                if (journeyStep > 0 || !journeyIsActive) {
                    pinJourney();
                    return;
                }

                journeyIsActive = false;
            }

            if (journeyStep === 0 && currentScrollY < pinStart - 1) {
                journeyIsActive = false;
            }

            lastScrollY = currentScrollY;
        }, { passive: true });

        setJourneyStep(0);
    }
};

setupJourneyScroll();

const revealTargets = document.querySelectorAll('main > section:not(.hero), .journey-section, .skills-grid .skill-group, .projects-grid .project-card');
if ('IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { rootMargin: '0px 0px -180px 0px', threshold: 0.08 });

    const hideObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                entry.target.classList.remove('is-visible');
            }
        });
    });

    revealTargets.forEach((target) => {
        target.setAttribute('data-reveal', '');
        revealObserver.observe(target);
        hideObserver.observe(target);
    });
} else {
    revealTargets.forEach((section) => section.classList.add('is-visible'));
}
