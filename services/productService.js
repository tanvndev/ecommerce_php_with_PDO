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

const modalCart = () => {
  return `
   <div class="modal fade theme-modal" id="modalUpdate" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content py-3">
                    <div class="modal-header border-0 d-block text-center">
                        <h5 class="modal-title w-100 mb-5 fs-1">Cập nhật lớp học</h5>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form action="admin/updateSubject" method="POST" enctype="multipart/form-data">
                        <div class="modal-body add-wrap-admin">
                            <div class="form-input">
                            <input type="hidden" name="id" value="" />
                                <div class="mb-5 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Mã môn học</label>
                                    <div class="col-sm-9">
                                        <input value="" name="subject_code" class="form-control input-text" type="text" placeholder="Mã lớp học">
                                    </div>
                                </div>

                                <div class="mb-5 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Tên môn học</label>
                                    <div class="col-sm-9">
                                        <input value="" name="description" class="form-control input-text" type="text" placeholder="Tên lớp học">
                                    </div>
                                </div>

                                <div class="mb-5 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Ảnh</label>
                                    <div class="col-sm-9">
                                        <input name="image" class="form-control input-file" type="file">
                                    </div>
                                </div>

                                <div class="mb-5 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Lớp học</label>
                                    <div class="col-sm-9">
                                        <select style="padding: 0 20px" class="select-custom" name="class_id" id="select-custom2">
                                        <option class="">--  Chọn lớp học --</option>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <div class="ms-3">
                                <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ bỏ</button>
                            </div>
                            <div>
                                <button id="btn_ele" type="submit" class="btn btn-custom btn-yes fw-bold">Cập nhật <span class="spin"><i class="fas fa-spinner"></i></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  
  `;
};

const addCartModal = () => {
  $('#modalUpdate').remove();
  $('body').append(modalCart());
  $('#modalUpdate').modal('show');
};
