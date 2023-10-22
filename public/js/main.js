(function (window, document, $, undefined) {
  ('use strict');

  // initial
  var initial = {
    i: function (e) {
      initial.s();
      initial.methods();
    },

    s: function (e) {
      (this._window = $(window)),
        (this._document = $(document)),
        (this._body = $('body')),
        (this._html = $('html'));
    },

    methods: function (e) {
      initial.w();
      initial.headerIconToggle();
      initial.quantityRanger();
      initial.slickActivation();
      initial.sideOffcanvasToggle('.shopping-cart-btn', '#cart-dropdown');
      initial.sideOffcanvasToggle(
        '.popup-close, .closeMask',
        '#offer-popup-modal',
      );
      initial.stickyHeaderMenu();
      initial.salActivation();
      initial.magnificPopupActivation();
      initial.colorVariantActive();
      initial.sizeVariantActive();
      initial.counterUpActivation();
      initial.scrollSmoth();
      initial.selectedStarComment();
      initial.addAllLazyLoading();
      initial.showMyAccountDropdown();
      initial.niceSelectActive();
    },

    w: function (e) {
      this._window.on('load', initial.l).on('scroll', initial.res);
    },

    niceSelectActive: function () {
      $('.niceSelect').niceSelect();
    },

    showMyAccountDropdown: function () {
      $('.my-account .action-link').click(function () {
        $(this).toggleClass('active');
        $('.my-account-dropdown').toggleClass('show');
      });
    },

    addAllLazyLoading: function () {
      $('img').each(function () {
        $(this).attr('loading', 'lazy');
      });
    },
    selectedStarComment: function () {
      $('.comment-respond .star').hover(
        function () {
          $(this).addClass('hovered');
          $(this).prevAll().addClass('hovered');
        },
        function () {
          $('.comment-respond .star').removeClass('hovered');
        },
      );

      $('.comment-respond .star').click(function () {
        var rating = $(this).data('rating');
        $('#currentRating').val(rating);
        $('.comment-respond .star').removeClass('selected');
        $(this).addClass('selected');
        $(this).prevAll().addClass('selected');
      });
    },

    counterUpActivation: function () {
      var _counter = $('.count');
      if (_counter.length) {
        _counter.counterUp({
          delay: 10,
          time: 1000,
          triggerOnce: true,
        });
      }
    },

    scrollSmoth: function (e) {
      $(document).on('click', '.smoth-animation', function (event) {
        event.preventDefault();
        $('html, body').animate(
          {
            scrollTop: $($.attr(this, 'href')).offset().top,
          },
          200,
        );
      });
    },

    headerIconToggle: function () {
      $('.my-account > a').on('click', function (e) {
        $(this).toggleClass('open').siblings().toggleClass('open');
      });
    },

    quantityRanger: function () {
      $('.quantity-btn').on('click', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
          var newVal = parseFloat(oldValue) + 1;
        } else {
          if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
          } else {
            newVal = 1;
          }
        }
        $button.parent().find('input').val(newVal);
      });
    },

    slickActivation: function (e) {
      $('.category').slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 7,
        arrows: true,
        dots: false,
        autoplay: false,
        speed: 1000,
        prevArrow:
          '<button class="slide-arrow prev-arrow"><i class="fal fa-long-arrow-left"></i></button>',
        nextArrow:
          '<button class="slide-arrow next-arrow"><i class="fal fa-long-arrow-right"></i></button>',
        responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 6,
              slidesToScroll: 6,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
            },
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
            },
          },
          {
            breakpoint: 479,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
            },
          },
          {
            breakpoint: 400,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });

      $('.product-thumb-small').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        focusOnSelect: true,
        vertical: true,
        speed: 800,
        draggable: false,
        swipe: false,
        asNavFor: '.product-thumb-large',
        responsive: [
          {
            breakpoint: 992,
            settings: {
              vertical: false,
            },
          },
        ],
      });

      $('.product-thumb-large').slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        speed: 800,
        draggable: false,
        swipe: false,
        asNavFor: '.product-thumb-small',
      });

      $('#quick-view-modal').on('shown.bs.modal', function (event) {
        $('.slick-slider').slick('setPosition');
      });

      $('.slide-banner-thumb').slick({
        infinite: true,
        slidesToShow: 3,
        centerPadding: '0',
        arrows: false,
        dots: true,
        speed: 1500,
        autoplay: false,
        centerMode: true,
        responsive: [
          {
            breakpoint: 575,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    },

    sideOffcanvasToggle: function (selectbtn, openElement) {
      $('body').on('click', selectbtn, function (e) {
        e.preventDefault();

        var $this = $(this),
          wrapp = $this.parents('body'),
          wrapMask = $('<div / >').addClass('closeMask'),
          cartDropdown = $(openElement);

        if (!cartDropdown.hasClass('show')) {
          wrapp.addClass('show');
          cartDropdown.addClass('show');
          cartDropdown.parent().append(wrapMask);
          wrapp.css({
            overflow: 'hidden',
          });
        } else {
          removeSideMenu();
        }

        function removeSideMenu() {
          wrapp.removeAttr('style');
          wrapp.removeClass('show').find('.closeMask').remove();
          cartDropdown.removeClass('show');
        }

        $('.cart-close, .closeMask').on('click', function () {
          removeSideMenu();
        });
      });
    },

    stickyHeaderMenu: function () {
      $(window).on('scroll', function () {
        // Sticky Class Add
        var menu = $('.header-navbar');
        var topHeaderH = $('.topbar').outerHeight() || 0;

        if ($(window).scrollTop() > topHeaderH) {
          menu.addClass('navbar-fixed');
        } else {
          menu.removeClass('navbar-fixed');
        }
      });
    },

    salActivation: function () {
      sal({
        threshold: 0.3,
        once: true,
      });
    },

    magnificPopupActivation: function () {
      if ($('.zoom-gallery').length) {
        $('.zoom-gallery').each(function () {
          $(this).magnificPopup({
            delegate: 'a.popup-zoom',
            type: 'image',
            gallery: {
              enabled: true,
            },
          });
        });
      }
    },

    colorVariantActive: function () {
      const colorVariant = $('.color-variant');

      function updateColorValue() {
        const value = colorVariant.find('.active').text();
        $('#colorProduct').val(value);
      }

      colorVariant.on('click', 'li', function () {
        $(this).addClass('active').siblings().removeClass('active');
        updateColorValue();
      });

      updateColorValue();
    },
    sizeVariantActive: function () {
      const sizeVariant = $('.size-variant');

      function updateSizeValue() {
        const value = sizeVariant.find('.active').text();
        $('#sizeProduct').val(value);
      }

      sizeVariant.on('click', 'li', function () {
        $(this).addClass('active').siblings().removeClass('active');
        updateSizeValue();
      });

      updateSizeValue();
    },
  };
  initial.i();
})(window, document, jQuery);
