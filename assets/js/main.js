/**
 * Hostza front-end behaviour, without jQuery.
 *
 * The plugin calls keep the options they always had; ColorlibUI provides
 * drop-in versions of Owl Carousel, Isotope, Magnific Popup, SlickNav,
 * ScrollUp and AjaxChimp that build the same markup, so the theme's
 * stylesheets apply unchanged. scrollIt is small enough to live here.
 */
(function () {
  'use strict';

  var UI = window.ColorlibUI;
  if (!UI) return;

  // The theme shipped Owl Carousel 2.2.1, whose arrows and dots are <div>s
  // (style.css styles .owl-nav div). Every carousel on the page, the
  // companion's and the editor previews' included, starts after this line.
  if (UI.owl && UI.owl.defaults) UI.owl.defaults.markup = '2.2';

  // TOP Menu Sticky
  window.addEventListener('scroll', function () {
    var scroll = window.pageYOffset;
    var header = document.getElementById('sticky-header');
    if (header) header.classList.toggle('sticky', scroll >= 400);
    UI.fade(document.getElementById('back-top'), 'in', 500);
  }, { passive: true });

  // mobile_menu
  UI.ready(function () {
    UI.slicknav('ul#navigation', {
      prependTo: '.mobile_menu',
      closedSymbol: '+',
      openedSymbol: '-'
    });
  });
  // blog-menu
  // UI.slicknav('ul#blog-menu', {
  //   prependTo: '.blog_menu'
  // });

  // review-active
  UI.owl('.gallery_active', {
    loop: true,
    margin: 30,
    items: 1,
    autoplay: true,
    navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
    nav: true,
    dots: false,
    autoplayHoverPause: true,
    autoplaySpeed: 800,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      767: {
        items: 2,
        nav: true
      },
      992: {
        items: 3
      }
    }
  });

  // about_active
  UI.owl('.about_active', {
    loop: true,
    margin: 0,
    items: 1,
    autoplay: true,
    navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
    nav: true,
    dots: false,
    autoplayHoverPause: true,
    autoplaySpeed: 800,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      767: {
        items: 1,
        nav: false
      },
      992: {
        items: 1
      }
    }
  });

  // review-active
  UI.owl('.testmonial_active', {
    loop: true,
    margin: 0,
    items: 1,
    autoplay: true,
    navText: ['<i class="fa-solid fa-angle-left"></i>', '<i class="fa-solid fa-angle-right"></i>'],
    nav: true,
    dots: false,
    autoplayHoverPause: true,
    autoplaySpeed: 800,
    responsive: {
      0: {
        items: 1,
        dots: false,
        nav: false
      },
      767: {
        items: 1,
        dots: false,
        nav: false
      },
      992: {
        items: 1,
        nav: false
      },
      1200: {
        items: 1,
        nav: false
      },
      1500: {
        items: 1
      }
    }
  });

  // for filter
  UI.ready(function () {
    // init Isotope, only where there is a grid: UI.isotope needs WordPress
    // core Masonry and warns when it is missing, on every page otherwise.
    var grids = document.querySelector('.grid') ? UI.isotope('.grid', {
        itemSelector: '.grid-item',
        percentPosition: true,
        masonry: {
          // use outer width of grid-sizer for columnWidth
          columnWidth: 1
        }
      }) : [];

    // filter items on button click, and move the menu's active class
    UI.toElements('.portfolio-menu').forEach(function (menu) {
      menu.addEventListener('click', function (event) {
        var button = event.target.closest('button');
        if (!button || !menu.contains(button)) return;
        Array.prototype.forEach.call(button.parentNode.children, function (sibling) {
          if (sibling !== button) sibling.classList.remove('active');
        });
        button.classList.add('active');
        event.preventDefault();
        var filterValue = button.getAttribute('data-filter');
        grids.forEach(function (grid) { grid.arrange({ filter: filterValue }); });
      });
    });
  });

  // wow js
  UI.reveal('.wow');

  // counter
  UI.counter('.counter', { time: 10000 });

  /* magnificPopup img view */
  UI.magnific('.popup-image', {
    type: 'image',
    gallery: {
      enabled: true
    }
  });

  /* magnificPopup img view */
  UI.magnific('.img-pop-up', {
    type: 'image',
    gallery: {
      enabled: true
    }
  });

  /* magnificPopup video view */
  UI.magnific('.popup-video', {
    type: 'iframe'
  });

  // scrollIt for smooth scroll
  UI.ready(function () {
    scrollIt({
      upKey: 38,             // key code to navigate to the next section
      downKey: 40,           // key code to navigate to the previous section
      easing: 'linear',      // the easing function for animation (scrollIt never applied it)
      scrollTime: 600,       // how long (in ms) the animation takes
      activeClass: 'active', // class given to the active nav element
      onPageChange: null,    // function(pageIndex) that is called when page is changed
      topOffset: 0           // offset (in px) for fixed top navigation
    });
  });

  // scrollup bottom to top
  // On DOM ready, as before: the companion plugin's own scrollUp call runs
  // earlier and, being first, is the one that applies when it is active.
  UI.ready(function () {
    UI.scrollUp({
      scrollName: 'scrollUp', // Element ID
      topDistance: '4500', // Distance from top before showing element (px)
      topSpeed: 300, // Speed back to top (ms)
      animation: 'fade', // Fade, slide, none
      animationInSpeed: 200, // Animation in speed (ms)
      animationOutSpeed: 200, // Animation out speed (ms)
      scrollText: '<i class="fa-solid fa-angle-double-up"></i>', // Text for element
      activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });
  });

  // blog-page

  //brand-active
  UI.owl('.brand-active', {
    loop: true,
    margin: 30,
    items: 1,
    autoplay: true,
    nav: false,
    dots: false,
    autoplayHoverPause: true,
    autoplaySpeed: 800,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      767: {
        items: 4
      },
      992: {
        items: 7
      }
    }
  });

  // blog-dtails-page

  //project-active
  UI.owl('.project-active', {
    loop: true,
    margin: 30,
    items: 1,
    // autoplay:true,
    navText: ['<i class="Flaticon flaticon-left-arrow"></i>', '<i class="Flaticon flaticon-right-arrow"></i>'],
    nav: true,
    dots: false,
    // autoplayHoverPause: true,
    // autoplaySpeed: 800,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      767: {
        items: 1,
        nav: false
      },
      992: {
        items: 2,
        nav: false
      },
      1200: {
        items: 1
      },
      1501: {
        items: 2
      }
    }
  });

  UI.ready(function () {
    if (document.getElementById('default-select')) {
      UI.enhanceSelects('select');
    }
  });

  //about-pro-active
  UI.owl('.details_active', {
    loop: true,
    margin: 0,
    items: 1,
    // autoplay:true,
    navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
    nav: true,
    dots: false,
    // autoplayHoverPause: true,
    // autoplaySpeed: 800,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      767: {
        items: 1,
        nav: false
      },
      992: {
        items: 1,
        nav: false
      },
      1200: {
        items: 1
      }
    }
  });

  // resitration_Form
  UI.magnific('.popup-with-form', {
    type: 'inline',
    preloader: false,
    focus: '#name',

    // When elemened is focused, some mobile browsers in some cases zoom in
    // It looks not nice, so we disable it:
    callbacks: {
      beforeOpen: function () {
        if (document.documentElement.clientWidth < 700) {
          this.st.focus = false;
        } else {
          this.st.focus = '#name';
        }
      }
    }
  });

  // resitration_Form
  UI.magnific('.dont-hav-acc', {
    type: 'inline',
    preloader: false,
    focus: '#name',

    // When elemened is focused, some mobile browsers in some cases zoom in
    // It looks not nice, so we disable it:
    callbacks: {
      beforeOpen: function () {
        if (document.documentElement.clientWidth < 700) {
          this.st.focus = false;
        } else {
          this.st.focus = '#name';
        }
      }
    }
  });

  //------- Mailchimp js --------//
  UI.ready(function () {
    UI.ajaxChimp('#mc_embed_signup form');
  });

  // Search Toggle
  UI.ready(function () {
    var box = document.getElementById('search_input_box');
    if (box) box.style.display = 'none';
    function toggleSearch() {
      UI.slide(box, 'toggle');
      var input = document.getElementById('search_input');
      if (input) input.focus();
    }
    ['search', 'search_1'].forEach(function (id) {
      var toggle = document.getElementById(id);
      if (toggle) toggle.addEventListener('click', toggleSearch);
    });
    var close = document.getElementById('close_search');
    if (close) {
      close.addEventListener('click', function () {
        UI.slide(box, 'up', 500);
      });
    }
  });

  /**
   * scrollIt.js 1.0.3, the part the theme used: links with data-scroll-nav or
   * data-scroll-goto scroll to the section with that data-scroll-index, the
   * up/down keys step between sections, and the nav link of the section in
   * view gets the active class.
   */
  function scrollIt(settings) {
    var active = 0;
    var animatingUntil = 0;
    var sections = UI.toElements('[data-scroll-index]');
    var lastIndex = sections.length ? sections[sections.length - 1].getAttribute('data-scroll-index') : undefined;

    function navigate(ndx) {
      if (ndx < 0 || ndx > lastIndex) return;
      var section = document.querySelector('[data-scroll-index="' + ndx + '"]');
      if (!section) return;
      animatingUntil = Date.now() + settings.scrollTime;
      UI.scrollToY(UI.offset(section).top + settings.topOffset + 1, settings.scrollTime);
    }

    function updateActive(ndx) {
      if (settings.onPageChange && ndx && (active != ndx)) settings.onPageChange(ndx);
      active = ndx;
      UI.toElements('[data-scroll-nav]').forEach(function (nav) {
        nav.classList.toggle(settings.activeClass, ndx !== undefined && nav.getAttribute('data-scroll-nav') === ndx);
      });
    }

    function watchActive() {
      var winTop = window.pageYOffset;
      var visible = UI.toElements('[data-scroll-index]').filter(function (div) {
        var top = UI.offset(div).top + settings.topOffset;
        return winTop >= top && winTop < top + div.offsetHeight;
      });
      updateActive(visible.length ? visible[0].getAttribute('data-scroll-index') : undefined);
    }

    window.addEventListener('scroll', watchActive, { passive: true });
    watchActive();

    window.addEventListener('keydown', function (e) {
      var key = e.keyCode;
      if (key !== settings.upKey && key !== settings.downKey) return;
      var handled = true;
      if (Date.now() < animatingUntil) {
        // still scrolling: swallow the key
      } else if (key === settings.upKey && active > 0) {
        navigate(parseInt(active, 10) - 1);
      } else if (key === settings.downKey && active < lastIndex) {
        navigate(parseInt(active, 10) + 1);
      } else {
        handled = false;
      }
      if (handled) {
        e.preventDefault();
        e.stopPropagation();
      }
    });

    document.body.addEventListener('click', function (e) {
      var link = e.target.closest('[data-scroll-nav], [data-scroll-goto]');
      if (!link) return;
      e.preventDefault();
      var nav = e.target.closest('[data-scroll-nav]');
      var go = e.target.closest('[data-scroll-goto]');
      navigate(parseInt((nav && nav.getAttribute('data-scroll-nav')) || (go && go.getAttribute('data-scroll-goto')), 10));
    });
  }
}());
