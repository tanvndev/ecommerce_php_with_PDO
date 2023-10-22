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

      initial.scrollSmoth();
      initial.addAllLazyLoading();

      initial.sideBarAdmin();
      initial.activeDataTable();
      initial.selectOptionCustomActive();
      initial.CKEditerActive();
      initial.priceWithDiscount();
    },

    w: function (e) {
      this._window.on('load', initial.l).on('scroll', initial.res);
    },

    //tan
    sideBarAdmin: function () {
      $('.sidebar-submenu').hide();

      $('.sidebar-list > a').click(function () {
        var submenu = $(this).next('.sidebar-submenu');
        var icon = $(this).find('.according-menu i');
        $('.sidebar-submenu').not(submenu).slideUp();
        $('.sidebar-list > a').removeClass('active');
        submenu.slideToggle();
        icon.toggleClass('fa-angle-down fa-angle-right');

        $(this).addClass('active');
      });
    },

    priceWithDiscount: function () {
      // Giá cũ(G) - (Giá cũ(G) * Số phần trăm giảm giá / 100)
      $('#price, #discount').on('input', function () {
        let discountValue = parseFloat($('#discount').val());
        if (discountValue >= 100) {
          discountValue = 99;
          $('#discount').val(discountValue);
        }

        let price = parseFloat($('#price').val());
        let newPrice = price - (price * discountValue) / 100;
        $('#price_new').val(newPrice);
      });
    },

    selectOptionCustomActive: function () {
      if (typeof $.fn.select2 === 'function') {
        const selectIds = ['#select-custom', '#select-custom2'];

        selectIds.forEach(function (id) {
          $(id).select2({
            width: '100%',
          });
        });
      }
    },

    CKEditerActive: function () {
      if (typeof ClassicEditor === 'function') {
        ClassicEditor.create(document.querySelector('#editor')).catch(
          (error) => {
            // console.error(error);
          },
        );
      }
    },

    activeDataTable: function () {
      if (typeof $.fn.DataTable === 'function') {
        if ($.fn.DataTable.isDataTable('#table_id')) {
          return;
        }
        $('#table_id').DataTable({
          paging: true,
          ordering: true,
          info: false,
          responsive: true,
        });
      }
    },

    addAllLazyLoading: function () {
      $('img').each(function () {
        $(this).attr('loading', 'lazy');
      });
    },

    scrollSmoth: function () {
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
  };
  initial.i();
})(window, document, jQuery);
