// change isBlock
const toggleStatusProd = (id) => {
  $.ajax({
    url: 'admin/toggle-product',
    method: 'POST',
    data: {
      id: id,
    },
    dataType: 'json',
    success: function (data) {
      if (data.code == 200) {
        return showToast('success', data.message);
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
};

// change isBlock
const toggleStatusProdRating = (id) => {
  $.ajax({
    url: 'admin/hide-product-rating',
    method: 'POST',
    data: {
      id: id,
    },
    dataType: 'json',
    success: function (data) {
      if (data.code == 200) {
        return showToast('success', data.message);
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
};
// Variant value

const priceHtml = (item) => {
  if (item.discount != 0) {
    return `
          <span class="price-amount">${formatCurrency(item.price)}</span>  
          <span class="price-amount-old">${calculateOriginalPrice(
            item.price,
            item.discount,
          )}</span>
          <span class="text-danger ">${item.discount}%</span>
          `;
  } else {
    return `<span class="price-amount">${formatCurrency(item.price)}</span> `;
  }
};

const getVariant = (id) => {
  const productPrice = $('#product-price');
  $.ajax({
    url: `product/getProductVariant/${id}`,
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      const dataProd = data.data;

      if (data.code == 200) {
        $('#product-stock').text(dataProd.quantity);
        $('#product_variant_id').val(id);
        productPrice.empty();
        productPrice.append(priceHtml(dataProd));
      }

      if (data.code == 400) {
        window.location.href = '/WEB2041_Ecommerce/';
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
};

// product filter

const productFilterHtml = (itemDataProd) => {
  const productLink = `product/${itemDataProd.slug}-${itemDataProd.id}`;
  const thumbSrc = `${itemDataProd.thumb}`;
  const quantity = itemDataProd.quantity;
  const discount = itemDataProd.discount;
  const price = itemDataProd.price;
  const totalRatings = itemDataProd.totalRatings;
  const prodTitle = itemDataProd.title;
  const prodTotalUserRatings = itemDataProd.totalUserRatings;

  return `
    <div class="col-xl-3 mb-5 col-lg-4 col-sm-6 col-12">
        <div class="product-item px-3">
            <div class="thumb">
                <div class="thumb-img">
                    <a class="thumb-link" href="${productLink}">
                        <img src="${thumbSrc}" alt="${prodTitle}">
                    </a>

                    <div class="actions-hover">
                        <ul class="action-list mb-0">
                            <li class="quickview">
                                <a class="btn-action" href="${productLink}"><i class="far fa-eye"></i></a>
                            </li>

                            <li class="select-option">
                                ${
                                  quantity > 0
                                    ? `<a href="${productLink}" class="btn-action-lagre">Lựa chọn phân loại</a>`
                                    : `<a class="btn-action-lagre disabled" href="#">Sản phẩm hết hàng</a>`
                                }
                            </li>

                            <li class="wishlist">
                                <button class="btn-action" type="button" ><i class="far fa-heart"></i></button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="lable-sale">
                    ${
                      discount !== 0
                        ? `<div class="product-badget">Giảm ${discount} %</div>`
                        : ``
                    }
                </div>
            </div>
            <div class="content">
                <div class="inner">
                    <div class="product-rating">
                        <span class="icon">
                            ${renderStars(totalRatings)}
                        </span>
                        <span class="rating-number">(${prodTotalUserRatings})</span>
                    </div>
                    <h5 class="title">
                        <a href="${productLink}">${prodTitle}</a>
                    </h5>
                    <div class="product-price-variant">
                        <span class="price current-price">${formatCurrency(
                          price,
                        )}</span>
                        ${
                          discount
                            ? `<span class="price old-price">${calculateOriginalPrice(
                                price,
                                discount,
                              )}</span>`
                            : ``
                        }
                    </div>
                </div>
            </div>
        </div>
    </div>
  `;
};
const buttonLernMore = () => {
  return ` <div class="col-lg-12 text-center mt--20 ">
                <span onclick="learnMoreProductFilter()" class="btn-custom btn-bg-lighter">Xem thêm</span>
            </div>`;
};

const updateHtmlProductFilter = (data) => {
  const $productFilter = $('#main-product-filter');
  $productFilter.empty();
  if (data.length > 0) {
    data.forEach(function (item) {
      const prodItemHTML = productFilterHtml(item);
      $productFilter.append(prodItemHTML);
    });
    $productFilter.append(buttonLernMore);
  } else {
    $productFilter.append(notCartHtml());
  }
};

// Xu ly lọc sản phẩm
const handleFilterChange = () => {
  filterProduct();
};

$('.product-filter-select').change(handleFilterChange);

const filterProduct = async () => {
  // Get form data
  const formData = new FormData($('#form-prod-category').get(0));

  // Kiem tra co param search hay khong
  const queryParams = new URLSearchParams(window.location.search);
  const search = queryParams.get('search');

  // neu co search se them search vao params
  if (search) {
    formData.append('search', search);
  }

  //Lay param cua form va dua len url
  const queryString = new URLSearchParams(formData).toString();
  const newURL = `http://localhost/WEB2041_Ecommerce/product-category?${queryString}`;
  history.pushState({}, '', newURL);

  try {
    const fetchPromise = await fetch('product-filter', {
      method: 'POST',
      body: formData,
    });
    if (fetchPromise.ok) {
      const response = await fetchPromise.json();
      if (response.code == 200) {
        updateHtmlProductFilter(response.data);
      }
    }
  } catch (error) {
    console.log(error);
  }
};

function learnMoreProductFilter() {
  const valueLimit = $('#limit-product-filter').val();
  $('#limit-product-filter').val(+valueLimit + 8);
  filterProduct();
}

// Print
const printInvoice = (id) => {
  // Gửi yêu cầu AJAX để lấy base64PDFContent
  $.ajax({
    url: 'admin/order/printInvoiceApi/' + id,
    type: 'GET',

    success: function (base64PDFContent) {
      // In trang khi đã nhận được dữ liệu PDF
      // console.log(base64PDFContent);
      printPDF(base64PDFContent);
    },
    error: function (xhr, status, error) {
      console.error('Error:', error);
    },
  });
};
