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
                <a href="product/${item.slug}-${item.product_id}">
                  <img src="${item.thumb}" alt="${item.title}">
                </a>
                <button onclick="deleteCart(${
                  item.cart_item_id
                })" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="item-content">
              
                <h3 class="item-title"><a href="product/${item.slug}-${
    item.product_id
  }">${item.title}</a></h3>

                <aside class="variants">
                    
             
                  <label>
                        <span class="title-variant fw-bold ">Phân loại: </span>
                        <span class="sub-variant">${
                          item.attribute_values
                        }</span>
                  </label>
                
                    <div class="sub-variants">
                    </div>

                </aside>
                <div class="item-price">
                    ${formatCurrency(item.price)}
                </div>
                <div class="pro-qty item-quantity">
                    <button type="button" onclick="updateQuantityCart(${
                      item.cart_item_id
                    }, 'minus')" class="dec qtybtn">-</button>
                    <input type="text" class="quantity-input" value="${
                      item.quantity
                    }">
                    <button type="button" onclick="updateQuantityCart(${
                      item.cart_item_id
                    }, 'plus') "class="inc qtybtn">+</button>
                </div>
            </div>
        </li>
    `;
};

const cartHtmlMain = (item) => {
  return `
    <tr>
                                <td class="product-remove">
                                    <button onclick="deleteCart(${
                                      item.cart_item_id
                                    })" class="remove-wishlist"><i class="fal fa-times"></i>
                                    </button>
                                </td>
                                <td class="product-thumbnail">
                                    <a href="product/${item.slug}-${
    item.product_id
  }">
                                        <img src="${item.thumb}" alt="${
    item.title
  }">
                                    </a>
                                </td>
                                <td class="product-title">
                                    <a href="product/${item.slug}-${
    item.product_id
  }">${item.title}</a>
                                    <div class="product-variant">
                                        <span class="title-variant">Phân loại: </span>
                                        <span class="sub-variant">${
                                          item.attribute_values
                                        }</span>
                                    </div>
                                </td>
                                <td class="product-price">
                                     ${formatCurrency(item.price)}
                                <td class="product-quantity">
                                    <div class="pro-qty item-quantity">
                                        <button onclick="updateQuantityCart(${
                                          item.cart_item_id
                                        }, 'minus')" class="dec qtybtn">-</button>
                                        <input type="text" class="quantity-input" value="${
                                          item.quantity
                                        }">
                                        <button onclick="updateQuantityCart(${
                                          item.cart_item_id
                                        }, 'plus')" class="inc qtybtn">+</button>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    ${formatCurrency(
                                      item.price * item.quantity,
                                    )}
                                </td>
                            </tr>
  `;
};

// fetch
const getData = async () => {
  try {
    const response = await fetch('cart/getAllCartApi');

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        updateHtmlCart(data.data);
      }
    } else {
      throw new Error('Request failed');
    }
  } catch (error) {
    console.log(error);
  }
};
getData();

const addCart = async () => {
  try {
    let data = [];
    //kiem tra da chon bien the chua
    if (!$('#product_variant_id').val()) {
      return showToast('error', 'Vui lòng lựa chọn phân loại.');
    }

    const formData = new FormData($('#formProduct').get(0));
    const response = await fetch(`cart/addCartApi`, {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      data = await response.json();
    }
    //Neu chua co tai khoan phai login
    if (data.code == 300) {
      window.location.href = 'login';
      return;
    }
    if (data.code == 200) {
      showToast('success', data.message);
    }
    if (data.code == 400) {
      showToast('error', data.message);
    }
    getData();
  } catch (error) {
    console.log(error);
  }
};

const updateQuantityCart = async (id, action) => {
  try {
    const response = await fetch(`cart/updateQuantityApi/${id}/${action}`, {
      method: 'GET',
    });
    if (response.ok) {
      const data = await response.json();

      if (data.code == 200) {
        getData();
      }

      if (data.code == 400) {
        showToast('error', data.message);
      }
    }
  } catch (error) {
    console.log(error);
  }
};

const deleteCart = async (id) => {
  try {
    const response = await fetch(`cart/deleteCartApi/${id}`, {
      method: 'DELETE',
    });

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        getData();
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    } else {
      console.log('Error deleting cart:', response.status);
    }
  } catch (error) {
    console.error('An error occurred:', error);
  }
};

const updateHtmlCart = (data) => {
  let cartList = $('#cartList');
  let cartMain = $('#cart_main');

  cartList.empty();
  cartMain.empty();

  if (data.length > 0) {
    let totalAmout = 0;

    data.forEach(function (item) {
      //cart modal
      cartList.append(itemCartHtml(item));
      //cart main
      cartMain.append(cartHtmlMain(item));
      totalAmout = item.totalPrice;
    });

    $('#subtotal-amount').html(formatCurrency(totalAmout));
    $('#shopping-cart-quantity').html(data.length);

    //Cart Mian
    $('#order-subtotal').html(formatCurrency(totalAmout));
    $('#order-total-amount').html(formatCurrency(totalAmout));
  } else {
    cartList.append(notCartHtml());
    $('#subtotal-amount').html(formatCurrency(0));
    $('#not-cart-main').append(notCartHtml());

    //Cart main
    $('#order-subtotal').html(formatCurrency(0));
    $('#order-total-amount').html(formatCurrency(0));
  }
};

const updateProductCoupon = async (totalPrice) => {
  const couponCodeEle = $('#coupon_code');
  const order_coupon_amount = $('.order-coupon-amount');
  const order_total_amount = $('.order-total-amount');
  const couponCodeVal = couponCodeEle.val();
  if (!couponCodeVal) {
    return showToast('error', 'Vui lòng không để trống mã giảm giá.');
  }

  try {
    const response = await fetch(
      `coupon/applyCouponApi/${couponCodeVal}/${totalPrice}`,
      {
        method: 'GET',
      },
    );

    if (response.ok) {
      const data = await response.json();
      if (data.code == 200) {
        order_coupon_amount.text(
          '-' + formatCurrency(totalPrice - data.data.totalPrice),
        );
        order_total_amount.text(formatCurrency(data.data.totalPrice));
        return showToast('success', data.message);
      }

      if (data.code == 400) {
        return showToast('error', data.message);
      }
    } else {
      console.log('Error deleting cart:', response.status);
    }
  } catch (error) {
    console.error('An error occurred:', error);
  }
};
