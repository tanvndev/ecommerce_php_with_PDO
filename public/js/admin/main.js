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
      initial.loaderAjax();

      initial.scrollSmoth();
      initial.addAllLazyLoading();

      initial.sideBarAdmin();
      initial.activeDataTable();
      initial.selectOptionCustomActive();
      initial.CKEditerActive();
      initial.addNewAttribute();
    },

    w: function (e) {
      this._window.on('load', initial.l).on('scroll', initial.res);
    },
    loaderAjax: function () {
      $('#btn_ele').on('click', function () {
        const button = $(this);
        button.addClass('disabled');
        $('.spin').show();
      });
    },
    addNewAttribute: function () {
      $('#add-attribute').click(() => {
        const newAttribute = `
           <div class="mb-5 row align-items-center">
            <label class="form-label-title col-sm-3 mb-0">Biến thể</label>
            <div class="col-sm-9">
                <input name="value" class="form-control input-text" type="text" placeholder="Màu đen, 512GB, ...">
            </div>
           </div>
        `;
        $('#form-attribute').append(newAttribute);
      });
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

      $('.sidebar-list').click(function () {
        $('.sidebar-list').removeClass('active');
        $(this).addClass('active');
      });
    },

    selectOptionCustomActive: function () {
      if (typeof $.fn.select2 === 'function') {
        const selectElements = document.querySelectorAll('.select-custom');

        selectElements.forEach(function (element) {
          $(element).select2({
            width: '100%',
          });
        });
      }
    },

    CKEditerActive: function () {
      if (typeof ClassicEditor === 'function') {
        document.querySelectorAll('.ckEditor').forEach((item) => {
          ClassicEditor.create(item).catch((error) => {
            // console.error(error);
          });
        });
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
          order: [[1, 'desc']],
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
