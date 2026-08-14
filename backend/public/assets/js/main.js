/* ===================================================
   main.js — Desa Munggur Website JavaScript
   =================================================== */

document.addEventListener('DOMContentLoaded', function () {

  // ===== NAVBAR SCROLL EFFECT =====
  const navbar = document.getElementById('main-navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 10) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  }

  // ===== HAMBURGER MOBILE MENU =====
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  if (hamburgerBtn && mobileMenu) {
    hamburgerBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
    });
  }

  // ===== NAVBAR DROPDOWNS — Click to open/close dynamically =====
  const dropdowns = document.querySelectorAll('.nav-dropdown');
  dropdowns.forEach(dropdown => {
    const toggleBtn = dropdown.querySelector('.nav-dropdown-toggle');
    if (toggleBtn) {
      toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        
        // Close other dropdowns
        dropdowns.forEach(other => {
          if (other !== dropdown) {
            other.classList.remove('open');
          }
        });
        
        // Toggle current dropdown
        dropdown.classList.toggle('open');
      });
    }
  });

  // Close all dropdowns when clicking anywhere outside
  document.addEventListener('click', (e) => {
    dropdowns.forEach(dropdown => {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('open');
      }
    });
  });

  // Close all dropdowns when pressing Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      dropdowns.forEach(dropdown => {
        dropdown.classList.remove('open');
      });
    }
  });

  // ===== HERO SLIDER =====
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');
  const prevBtn = document.getElementById('slider-prev');
  const nextBtn = document.getElementById('slider-next');

  if (slides.length > 0) {
    let currentSlide = 0;
    let sliderTimer = null;

    function goToSlide(index) {
      slides[currentSlide].classList.remove('active');
      dots[currentSlide].classList.remove('active');
      currentSlide = (index + slides.length) % slides.length;
      slides[currentSlide].classList.add('active');
      dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
      goToSlide(currentSlide + 1);
    }

    function prevSlide() {
      goToSlide(currentSlide - 1);
    }

    function startAutoPlay() {
      sliderTimer = setInterval(nextSlide, 4500);
    }

    function resetAutoPlay() {
      clearInterval(sliderTimer);
      startAutoPlay();
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        nextSlide();
        resetAutoPlay();
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        prevSlide();
        resetAutoPlay();
      });
    }

    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        goToSlide(i);
        resetAutoPlay();
      });
    });

    // Start autoplay
    startAutoPlay();

    // Pause on hover
    const heroSection = document.getElementById('hero-section');
    if (heroSection) {
      heroSection.addEventListener('mouseenter', () => clearInterval(sliderTimer));
      heroSection.addEventListener('mouseleave', startAutoPlay);
    }

    // Touch/swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    const sliderWrapper = document.getElementById('hero-section');
    if (sliderWrapper) {
      sliderWrapper.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].clientX;
      }, { passive: true });
      sliderWrapper.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].clientX;
        if (touchStartX - touchEndX > 50) { nextSlide(); resetAutoPlay(); }
        if (touchEndX - touchStartX > 50) { prevSlide(); resetAutoPlay(); }
      }, { passive: true });
    }
  }

  // ===== CATEGORY CARD HOVER ANIMATION =====
  const categoryCards = document.querySelectorAll('.category-card');
  categoryCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transition = 'all 0.22s ease';
    });
  });

  // ===== CATEGORY HORIZONTAL SCROLL VIA NAVIGATION BUTTONS =====
  const catPrevBtn = document.getElementById('cat-prev-btn');
  const catNextBtn = document.getElementById('cat-next-btn');
  const categoriesGrid = document.getElementById('categories-grid');

  if (categoriesGrid && catPrevBtn && catNextBtn) {
    const scrollAmount = 200; // Ukuran scroll sekali klik
    catPrevBtn.addEventListener('click', () => {
      categoriesGrid.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });
    catNextBtn.addEventListener('click', () => {
      categoriesGrid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
  }


  // ===== STAT COUNTER ANIMATION =====
  function animateCounter(el, target, suffix = '') {
    const duration = 1200;
    const start = performance.now();
    const startVal = 0;

    function update(timestamp) {
      const elapsed = timestamp - start;
      const progress = Math.min(elapsed / duration, 1);
      // Ease out
      const eased = 1 - Math.pow(1 - progress, 3);
      const current = Math.floor(startVal + (target - startVal) * eased);
      el.textContent = current.toLocaleString('id-ID') + suffix;
      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        el.textContent = target.toLocaleString('id-ID') + suffix;
      }
    }
    requestAnimationFrame(update);
  }

  // Intersection Observer for stat cards
  const statNumbers = document.querySelectorAll('.stat-number');
  if (statNumbers.length > 0) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const rawText = el.dataset.value || el.textContent.replace(/\./g, '').replace(/,/g, '');
          const numericValue = parseInt(rawText, 10);
          if (!isNaN(numericValue)) {
            el.dataset.value = numericValue;
            animateCounter(el, numericValue);
          }
          observer.unobserve(el);
        }
      });
    }, { threshold: 0.3 });

    statNumbers.forEach(el => observer.observe(el));
  }

  // ===== ACTIVE NAV LINK =====
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll('.nav-link');
  navLinks.forEach(link => {
    link.classList.remove('active');
    const linkPath = new URL(link.href, window.location.origin).pathname;
    if (linkPath === currentPath || (currentPath.endsWith('/') && linkPath.includes('index'))) {
      link.classList.add('active');
    }
  });

  // ===== SMOOTH REVEAL ON SCROLL =====
  const revealEls = document.querySelectorAll('.category-card, .stat-card, .profil-content p, .umkm-card, .komoditas-card');
  if (revealEls.length > 0) {
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }, i * 40);
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    revealEls.forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(16px)';
      el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
      revealObserver.observe(el);
    });
  }

  // ===== DYNAMIC LOGIN/LOGOUT HEADER BUTTON =====
  const isLoggedIn = !!localStorage.getItem("admin_token");
  if (isLoggedIn) {
    // Select all login buttons/links (desktop header, mobile header, and footer)
    const loginLinks = document.querySelectorAll('a.btn-login, a.mobile-login, a[href$="/login"], a[href$="login.html"]');
    loginLinks.forEach(link => {
      if (link) {
        link.textContent = 'Keluar (Logout)';
        link.addEventListener('click', function(e) {
          e.preventDefault();
          localStorage.removeItem("admin_token");
          window.location.href = '/login';
        });
      }
    });

    // Ubah link "My Account" di footer menjadi "Panel Admin"
    const adminLinks = document.querySelectorAll('a[href$="/admin"], a[href$="admin.html"]');
    adminLinks.forEach(link => {
      if (link) {
        link.textContent = 'Panel Admin';
      }
    });
  }

});
