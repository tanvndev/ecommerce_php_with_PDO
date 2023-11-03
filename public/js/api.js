const formatCurrency = (amount) => {
  var formattedAmount = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  }).format(amount);
  return formattedAmount;
};
function calculateOriginalPrice(price, discount) {
  if (discount < 0 || discount > 100) {
    return '0đ';
  }

  const originalPrice = price / (1 - discount / 100);
  return new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  }).format(originalPrice);
}

const renderStars = (number) => {
  const filledStars = Math.round(number);
  const starArray = [];

  for (let index = 0; index < 5; index++) {
    if (index < filledStars) {
      starArray.push('<i class="fas fa-star"></i>');
    } else {
      starArray.push('<i class="far fa-star"></i>');
    }
  }
  return starArray.join(' ');
};

const showToast = (type, message, timer = 1500) => {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: timer,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: type,
    title: message,
  });
};

const showAlert = (title, type, timer = 3000) => {
  Swal.fire({
    title: title,
    text: 'Vấn đề bạn đang gặp là gì vui lòng liên hệ chúng tôi.',
    icon: type,
    showCancelButton: false,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Đi tới gmail',
    timer: timer,
    timerProgressBar: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.open('http://gmail.com/', '_blank');
      return;
    }
    window.location.href = 'account/login';
  });
};

// cart
const notCartHtml = () => {
  return `<div class="text-center">
            <img class="img-fluid" src="https://www.maytinhtrangbom.vn/client/theme/image/emptycart.webp" alt="Chưa có sản phẩm img">
            <p class="fs-4">Chưa có sản phẩm.</p>
          </div>`;
};
const itemCartHtml = (item) => {
  return `
        <li class="cart-item">
            <div class="item-img">
                <a href="product/productDetail/${item.prod_id}">
                    <img src="public/images/product/thumb/${item.thumb}" alt="${
    item.title
  }">
                </a>
                <button onclick="deleteCart(${
                  item.id
                })" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="item-content">
              
                <h3 class="item-title"><a href="product/productDetail/${
                  item.prod_id
                }">${item.title}</a></h3>

                <aside class="variants">
                    
                ${
                  item.color &&
                  `<label>
                        <span class="title-variant">Màu: </span>
                        <span class="sub-variant">${item.color}</span>
                    </label>`
                }
                    <div class="sub-variants">
                    </div>

                </aside>
                <div class="item-price">
                    ${formatCurrency(item.price)}
                </div>
                <div class="pro-qty item-quantity">
                    <button type="button" onclick="updateQuantityCart(${
                      item.id
                    }, 'minus')" class="dec qtybtn">-</button>
                    <input type="text" class="quantity-input" value="${
                      item.quantity
                    }">
                    <button type="button" onclick="updateQuantityCart(${
                      item.id
                    }, 'plus') "class="inc qtybtn">+</button>
                </div>
            </div>
        </li>
    `;
};

// fetch
const getData = () => {
  try {
    fetch('cart/getAllCart')
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        updateHtmlCart(data);
      });
  } catch (error) {
    console.log(error);
  }
};
getData();

const addCart = (id) => {
  try {
    const formData = new FormData($('#formProduct').get(0));
    fetch(`cart/addCart/${id}`, {
      method: 'POST',
      body: formData,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        if (data == 'Failed') {
          window.location = 'account/login';
          return;
        }

        showToast('success', data.success);
        getData();
      });
  } catch (error) {
    console.log(error);
  }
};

const updateQuantityCart = (id, action) => {
  try {
    fetch(`cart/updateQuantity/${id}/${action}`, {
      method: 'GET',
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        getData();
      });
  } catch (error) {
    console.log(error);
  }
};

const deleteCart = (id) => {
  try {
    fetch(`cart/deleteCart/${id}`, {
      method: 'DELETE',
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        getData();
      });
  } catch (error) {
    console.log(error);
  }
};

const updateHtmlCart = (data) => {
  var $cartList = $('#cartList');
  $cartList.empty();
  if (data.length > 0) {
    let totalAmout = 0;
    let count = 0;
    data.forEach(function (item) {
      count++;
      var cartItemHTML = itemCartHtml(item);
      $cartList.append(cartItemHTML);
      totalAmout += item.totalPrice;
    });

    $('#subtotal-amount').html(formatCurrency(totalAmout));
    $('#shopping-cart-quantity').html(count);
  } else {
    $cartList.append(notCartHtml());
    $('#subtotal-amount').html(formatCurrency(0));
  }
};

// ratings

const itemCommentHtml = (item) => {
  return `
    <li class="comment-item">
        <div class="comment-body">
            <div class="product-comment">
                <div class="comment-img">
                    <img src="public/images/users/${
                      item.avatar ? item.avatar : 'userDefault.webp'
                    }" alt="${item.fullname} + image">
                </div>
                <div class="comment-inner">
                    <div class="commenter">
                        <div class="title">
                            ${item.fullname}
                            <span class="comment-date">${item.create_at}</span>
                        </div>
                        <span class="commenter-rating">
                            ${renderStars(item.star)}
                        </span>
                    </div>
                    <div class="comment-text">
                        <span class="mb-0">“${item.comment}”</span>
                    </div>
                </div>
            </div>
        </div>
    </li>
    `;
};

const addRatingProd = () => {
  try {
    const formData = new FormData($('#formRatings').get(0));
    fetch(`product/addRatingProd`, {
      method: 'POST',
      body: formData,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        if (data == 'Failed') {
          window.location = 'account/login';
          return;
        }
        if (data.success) {
          showToast('success', data.success);
          getDataRatingProd();
          return;
        }
        if (data.error) {
          showToast('warning', data.error, 2000);
          return;
        }
      });
  } catch (error) {
    console.log(error);
  }
};

const getDataRatingProd = () => {
  const currentURL = window.location.href;
  const match = currentURL.match(/\/(\d+)$/);
  if (match) {
    //lấy ra id
    const id = match[1];
    try {
      fetch('product/getAllRatingsProd/' + id)
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          updateHtmlRatingProd(data);
        });
    } catch (error) {
      console.log(error);
    }
  }
};
getDataRatingProd();

const notCommentHtml = () =>
  `<div class="not-comment">
      <img src="public/images/others/notComment.webp" alt="imageDefault">
          <small>Chưa có đánh giá.</small>
   </div>`;

const updateHtmlRatingProd = (data) => {
  var $commentList = $('#comment-list');
  $commentList.empty();
  if (data.length > 0) {
    data.forEach(function (item) {
      var commentItemHTML = itemCommentHtml(item);
      $commentList.append(commentItemHTML);
    });
  } else {
    $commentList.append(notCommentHtml());
  }
};

//account

let timeoutId;

$('#emailLogin').keyup(function () {
  clearTimeout(timeoutId);
  let emailEle = $('#emailLogin');
  let emailVal = emailEle.val();

  timeoutId = setTimeout(function () {
    $.ajax({
      url: 'Ajax/checkIdentificateExisted',
      method: 'POST',
      data: {
        email: emailVal,
      },
      dataType: 'json',
      success: function (data) {
        if (data == 0) {
          emailEle.addClass('is-invalid');
        } else {
          emailEle.removeClass('is-invalid');
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }, 300);
});

$('#passwordLogin').keyup(function () {
  clearTimeout(timeoutId);
  let passEle = $('#passwordLogin');
  let passVal = passEle.val();

  timeoutId = setTimeout(function () {
    $.ajax({
      url: 'Ajax/checkStrongPassword',
      method: 'POST',
      data: {
        password: passVal,
      },
      dataType: 'json',
      success: function (data) {
        if (data == 0) {
          passEle.addClass('is-invalid');
        } else {
          passEle.removeClass('is-invalid');
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  }, 300);
});

$('#re_passwordLogin').keyup(function () {
  clearTimeout(timeoutId);
  let passEle = $('#passwordLogin');
  let passVal = passEle.val();

  let rePassEle = $('#re_passwordLogin');
  let rePassVal = rePassEle.val();

  timeoutId = setTimeout(function () {
    if (passVal !== rePassVal) {
      rePassEle.addClass('is-invalid');
    } else {
      rePassEle.removeClass('is-invalid');
    }
  }, 300);
});

const registerUser = () => {
  try {
    const spin = $('.spin');
    const btnRegister = $('#btn-register');
    const formData = new FormData($('#formRegister').get(0));
    const fetchPromise = fetch(`account/registerApi`, {
      method: 'POST',
      body: formData,
    });

    if (fetchPromise.status === undefined) {
      spin.show();
      btnRegister.addClass('disabled');
    }

    fetchPromise
      .then(function (response) {
        spin.hide();
        btnRegister.removeClass('disabled');
        return response.json();
      })
      .then(function (data) {
        if (data.success) {
          showAlert(data.success, 'success', 2000);
          return;
        }
        if (data.error) {
          showToast('error', data.error, 2000);
          return;
        }
      });
  } catch (error) {
    console.log(error);
  }
};

const forgotPasswordUser = async () => {
  try {
    const spin = $('.spin');
    const btnRegister = $('#btn-register');
    const form = document.getElementById('formForgot');
    const formData = new FormData(form);

    spin.show();
    btnRegister.addClass('disabled');

    const response = await fetch('account/forgotPasswordApi', {
      method: 'POST',
      body: formData,
    });

    spin.hide();
    btnRegister.removeClass('disabled');

    if (response.ok) {
      const data = await response.json();
      if (data.success) {
        showAlert(data.success, 'success', 2000);
      } else if (data.error) {
        showToast('error', data.error, 2000);
      }
    } else {
      showToast('error', data.error, 2000);
    }
  } catch (error) {
    console.log(error);
  }
};

// category

const productCateHtml = (itemDataProd) => {
  const productLink = `product/productDetail/${itemDataProd.id}`;
  const thumbSrc = `public/images/product/thumb/${itemDataProd.thumb}`;
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
                                    ? `<button type="button" onclick="addCart(${itemDataProd.id})" class="btn-action-lagre">Thêm vào giỏ hàng</button>`
                                    : `<a class="btn-action-lagre disabled" href="#">Sản phẩm hết hàng</a>`
                                }
                            </li>

                            <li class="wishlist">
                                <a class="btn-action" href="wishlist"><i class="far fa-heart"></i></a>
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
                <span onclick="learnMoreProdCate(8)" class="btn-custom btn-bg-lighter">Xem thêm</span>
            </div>`;
};

const updateHtmlProdCate = (data) => {
  var $prodCate = $('#main-product');
  $prodCate.empty();
  if (data.length > 0) {
    data.forEach(function (item) {
      var prodCateItemHTML = productCateHtml(item);
      $prodCate.append(prodCateItemHTML);
    });
    $prodCate.append(buttonLernMore);
  } else {
    $prodCate.append(notCartHtml());
  }
};

const filterProdCate = () => {
  const formData = new FormData($('#form-prod-category').get(0));
  try {
    fetch(`product/filterProd/null`, {
      method: 'POST',
      body: formData,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        updateHtmlProdCate(data);
      });
  } catch (error) {
    console.log(error);
  }
};

function learnMoreProdCate(limit) {
  console.log(limit);
  const formData = new FormData($('#form-prod-category').get(0));
  formData.append('limit', limit);
  try {
    fetch(`product/filterProd/null`, {
      method: 'POST',
      body: formData,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        updateHtmlProdCate(data);
      });
  } catch (error) {
    console.log(error);
  }
}

const getDataProdCate = () => {
  const currentURL = window.location.href;
  const parts = currentURL.split('/');
  let params = parts[parts.length - 1];

  let queryParameters = window.location.search;
  if (queryParameters) {
    queryParameters = queryParameters.slice(8);
    params = queryParameters;
  }

  try {
    fetch(`product/filterProd/${params ? params : 'null'}`)
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        updateHtmlProdCate(data);
      });
  } catch (error) {
    console.log(error);
  }
};
getDataProdCate();
