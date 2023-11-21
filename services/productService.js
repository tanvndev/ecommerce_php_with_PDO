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
        console.log(data.data);
      }
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
};
