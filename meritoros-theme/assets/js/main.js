/**
 * Meritoros Theme — Main JS
 * Initializes Lucide icons, mobile menu, and case studies carousel.
 */

document.addEventListener('DOMContentLoaded', () => {

    // ----------------------------------------------------------------
    // Lucide icons
    // ----------------------------------------------------------------
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // ----------------------------------------------------------------
    // Mobile menu toggle
    // ----------------------------------------------------------------
    const mobileBtn  = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    const mobileBackdrop = document.getElementById('mobile-backdrop');

    const closeMobileMenu = () => {
        if (!mobileMenu) return;
        mobileMenu.classList.add('hidden');
        if (mobileBackdrop) mobileBackdrop.classList.add('hidden');
        mobileBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    };

    const openMobileMenu = () => {
        if (!mobileMenu) return;
        mobileMenu.classList.remove('hidden');
        if (mobileBackdrop) mobileBackdrop.classList.remove('hidden');
        mobileBtn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    };

    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            if (mobileMenu.classList.contains('hidden')) {
                openMobileMenu();
            } else {
                closeMobileMenu();
            }
        });
    }

    // ----------------------------------------------------------------
    // Case Studies Carousel
    // ----------------------------------------------------------------
    const csViewport = document.getElementById('cs-viewport');
    const track      = document.getElementById('cs-track');
    const dotsWrap   = document.getElementById('cs-dots');
    const prevBtn    = document.getElementById('cs-prev');
    const nextBtn    = document.getElementById('cs-next');

    if (csViewport && track) {

    const slides = track.querySelectorAll('.cs-slide');
    const dots   = dotsWrap ? dotsWrap.querySelectorAll('.cs-dot') : [];
    const total  = slides.length;

    if (total > 0) {

    let current = 0;
    let timer   = null;
    const counterEl = document.getElementById('cs-counter');

    const setSlideWidths = () => {
        const w = csViewport.offsetWidth;
        slides.forEach(slide => {
            slide.style.width    = w + 'px';
            slide.style.minWidth = w + 'px';
        });
    };
    const goTo = (index) => {
        current = ((index % total) + total) % total;
        track.style.transform = `translateX(-${current * csViewport.offsetWidth}px)`;
        if (counterEl) counterEl.textContent = `${current + 1} / ${total}`;

        dots.forEach((dot, i) => {
            const active = i === current;
            dot.classList.toggle('bg-[#48c279]',      active);
            dot.classList.toggle('w-8',                active);
            dot.classList.toggle('ring-2',             active);
            dot.classList.toggle('ring-[#48c279]/25',  active);
            dot.classList.toggle('bg-slate-200',      !active);
            dot.classList.toggle('w-2',               !active);
            dot.setAttribute('aria-current', active ? 'true' : 'false');
        });
    };

    const resetTimer = () => {
        clearInterval(timer);
        timer = setInterval(() => goTo(current + 1), 6000);
    };

    if (prevBtn) prevBtn.addEventListener('click', () => { goTo(current - 1); resetTimer(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { goTo(current + 1); resetTimer(); });

    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            goTo(parseInt(dot.dataset.index, 10));
            resetTimer();
        });
    });

    // Swipe
    let touchStartX = 0;
    track.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend',   (e) => {
        const diff = touchStartX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 50) { goTo(diff > 0 ? current + 1 : current - 1); resetTimer(); }
    }, { passive: true });

    // Resize
    let resizeRaf;
    window.addEventListener('resize', () => {
        cancelAnimationFrame(resizeRaf);
        resizeRaf = requestAnimationFrame(() => {
            setSlideWidths();
            track.style.transform = `translateX(-${current * csViewport.offsetWidth}px)`;
        });
    });

    requestAnimationFrame(() => { setSlideWidths(); goTo(0); });
    resetTimer();

    } // total > 0

    } // end carousel guard

    // ----------------------------------------------------------------
    // Case Studies: Video Modal
    // ----------------------------------------------------------------
    const vidModal    = document.getElementById('cs-vid-modal');
    const vidBackdrop = document.getElementById('cs-vid-backdrop');
    const vidClose    = document.getElementById('cs-vid-close');
    const vidIframe   = document.getElementById('cs-vid-iframe');
    const vidEmbedWrap= document.getElementById('cs-vid-embed-wrap');
    const vidFile     = document.getElementById('cs-vid-file');
    const vidFileWrap = document.getElementById('cs-vid-file-wrap');

    const openVidModal = (src, type) => {
        if (!vidModal) return;
        vidModal.classList.remove('hidden');
        vidModal.classList.add('flex');
        if (type === 'file') {
            vidEmbedWrap.classList.add('hidden');
            vidFileWrap.classList.remove('hidden');
            vidFile.src = src;
        } else {
            vidFileWrap.classList.add('hidden');
            vidEmbedWrap.classList.remove('hidden');
            vidIframe.src = src;
        }
    };

    const closeVidModal = () => {
        if (!vidModal) return;
        vidModal.classList.add('hidden');
        vidModal.classList.remove('flex');
        if (vidIframe) vidIframe.src = '';
        if (vidFile)   { vidFile.pause(); vidFile.src = ''; }
    };

    document.querySelectorAll('.cs-play-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            openVidModal(btn.dataset.src, btn.dataset.type);
        });
    });

    if (vidClose)    vidClose.addEventListener('click',    closeVidModal);
    if (vidBackdrop) vidBackdrop.addEventListener('click', closeVidModal);
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeVidModal(); });

    // ----------------------------------------------------------------
    // Contact page: "Obszar wsparcia" custom dropdown
    // ----------------------------------------------------------------
    const obszarWrapper = document.getElementById('obszar-wrapper');
    const obszarBtn     = document.getElementById('obszar-btn');
    const obszarList    = document.getElementById('obszar-list');
    const obszarLabel   = document.getElementById('obszar-label');
    const obszarChevron = document.getElementById('obszar-chevron');
    const obszarInput   = document.getElementById('obszar-input');

    if (obszarBtn && obszarList) {
        obszarBtn.addEventListener('click', () => {
            const isOpen = !obszarList.classList.contains('hidden');
            obszarList.classList.toggle('hidden', isOpen);
            obszarChevron.style.transform = isOpen ? '' : 'rotate(180deg)';
            obszarBtn.setAttribute('aria-expanded', String(!isOpen));
        });

        document.querySelectorAll('.obszar-opt').forEach(opt => {
            opt.addEventListener('click', () => {
                const val = opt.dataset.value;
                obszarLabel.textContent = val;
                obszarLabel.classList.remove('text-slate-400');
                obszarLabel.classList.add('text-slate-800');
                if (obszarInput) obszarInput.value = val;
                obszarList.classList.add('hidden');
                obszarChevron.style.transform = '';
                obszarBtn.setAttribute('aria-expanded', 'false');
            });
        });

        document.addEventListener('click', e => {
            if (obszarWrapper && !obszarWrapper.contains(e.target)) {
                obszarList.classList.add('hidden');
                obszarChevron.style.transform = '';
                obszarBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ----------------------------------------------------------------
    // Mobile menu: accordion for submenus
    // ----------------------------------------------------------------
    document.querySelectorAll('.mobile-acc-btn').forEach(accBtn => {
        accBtn.addEventListener('click', function () {
            const body = this.nextElementSibling;
            const icon = this.querySelector('.mobile-acc-icon');
            if (!body) return;
            body.classList.toggle('hidden');
            if (icon) icon.style.transform = body.classList.contains('hidden') ? '' : 'rotate(180deg)';
        });
    });

    // ----------------------------------------------------------------
    // Mobile menu: language dropdown
    // ----------------------------------------------------------------
    const mobileLangBtn  = document.getElementById('mobile-lang-btn');
    const mobileLangDd   = document.getElementById('mobile-lang-dd');
    const mobileLangIcon = document.getElementById('mobile-lang-icon');
    if (mobileLangBtn && mobileLangDd) {
        mobileLangBtn.addEventListener('click', function () {
            mobileLangDd.classList.toggle('hidden');
            const open = !mobileLangDd.classList.contains('hidden');
            mobileLangBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (mobileLangIcon) mobileLangIcon.style.transform = open ? 'rotate(180deg)' : '';
        });
    }

    // Mobile menu: close on close button / backdrop click
    // ----------------------------------------------------------------
    const mobileClose = document.getElementById('mobile-close');

    if (mobileClose)    mobileClose.addEventListener('click',    closeMobileMenu);
    if (mobileBackdrop) mobileBackdrop.addEventListener('click', closeMobileMenu);

    // ----------------------------------------------------------------
    // CF7 textarea: licznik znaków
    // ----------------------------------------------------------------
    document.querySelectorAll('.wpcf7-textarea[maxlength]').forEach(ta => {
        const wrap    = ta.closest('.wpcf7-form-control-wrap');
        if (!wrap) return;
        const next    = wrap.nextElementSibling;
        const counter = next ? next.querySelector('.cf7-char-counter') : null;
        if (!counter) return;
        const max = parseInt(ta.getAttribute('maxlength'), 10);
        ta.addEventListener('input', () => {
            counter.textContent = ta.value.length + ' / ' + max;
        });
    });

    // ----------------------------------------------------------------
    // Smooth scroll z offsetem dla fixed headera
    // ----------------------------------------------------------------
    const getHeaderOffset = () => {
        const header = document.getElementById('mer-header');
        return header ? header.getBoundingClientRect().height + 24 : 96;
    };

    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
            const hash = this.getAttribute('href');
            if (!hash || hash === '#') return;
            const target = document.querySelector(hash);
            if (!target) return;
            e.preventDefault();
            const top = target.getBoundingClientRect().top + window.scrollY - getHeaderOffset();
            window.scrollTo({ top, behavior: 'smooth' });
            history.replaceState(null, '', hash);
        });
    });

    // Obsługa kotwicy w URL przy załadowaniu strony
    if (window.location.hash) {
        const target = document.querySelector(window.location.hash);
        if (target) {
            setTimeout(() => {
                const top = target.getBoundingClientRect().top + window.scrollY - getHeaderOffset();
                window.scrollTo({ top, behavior: 'smooth' });
            }, 100);
        }
    }

});
