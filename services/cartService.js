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
                <a href="product/${item.prod_id}">
                  <img src="public/images/product/thumb/${item.thumb}" alt="${
    item.title
  }">
                </a>
                <button onclick="deleteCart(${
                  item.id
                })" class="close-btn"><i class="fas fa-times"></i></button>
            </div>
            <div class="item-content">
              
                <h3 class="item-title"><a href="product/${item.prod_id}">${
    item.title
  }</a></h3>

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
const getData = async () => {
  try {
    const response = await fetch('cart/getAllCartApi');

    if (response.ok) {
      const data = await response.json();
      updateHtmlCart(data);
    } else {
      throw new Error('Request failed');
    }
  } catch (error) {
    console.log(error);
  }
};
getData();

const addCart = async (id) => {
  try {
    let data = [];
    const formData = new FormData($('#formProduct').get(0));
    const response = fetch(`cart/addCartApi/${id}`, {
      method: 'POST',
      body: formData,
    });
    if (response.ok) {
      data = await response.json();
    }

    if (data == 'Failed') {
      return (window.location = 'login');
    }

    showToast('success', data.success);
    getData();
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
  let cartList = $('#cartList');

  cartList.empty();
  if (data.length > 0) {
    let totalAmout = 0;

    data.forEach(function (item) {
      var cartItemHTML = itemCartHtml(item);
      cartList.append(cartItemHTML);
      totalAmout += item.totalPrice;
    });

    $('#subtotal-amount').html(formatCurrency(totalAmout));
    $('#shopping-cart-quantity').html(data.length);
  } else {
    cartList.append(notCartHtml());
    $('#subtotal-amount').html(formatCurrency(0));
  }
};
