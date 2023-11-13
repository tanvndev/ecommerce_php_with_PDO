<section class="product-wrap">
    <div class="card">
        <div class="title-header">
            <h5 class="title">Danh sách sản phẩm</h5>
            <div class="right-options">
                <ul>
                    <li>
                        <a class="btn btn-custom" href="admin/add-product"> Thêm sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-custom">
            <table class="theme-table table-responsive" id="table_id">
                <thead class="rounded-3 overflow-hidden  ">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Tồn kho</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Hiển thị</th>
                        <th>Biến thể</th>
                        <th>Thực thi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($prodData as $product) {
                    ?>
                        <tr>
                            <td>
                                <div class=" product-title-name">
                                    <div class="table-image table-image--product">
                                        <img src="<?php echo $product['thumb'] ?>" class="img-fluid" alt="<?php echo $product['title'] ?>">
                                    </div>
                                    <div class="text-truncate text-title"><?php echo $product['title'] ?></div>
                                </div>
                            </td>

                            <?php
                            foreach ($cateData as $cateItem) {
                                if ($cateItem['id'] === $product['cate_id']) {
                            ?>
                                    <td class="td-category"><?php echo $cateItem['name'] ?></td>
                            <?php }
                            } ?>

                            <td><?php echo $product['quantity'] ?></td>

                            <td class="td-price"><?php echo Format::formatCurrency($product['price']) ?></td>


                            <td class=" <?php echo $product['quantity'] >= 1 && $product['status'] ? 'status-success' : 'status-danger' ?>">
                                <span class="fw-medium"><?php echo $product['quantity'] >= 1 && $product['status'] ? 'Đang bán' : 'Dừng bán' ?></span>
                            </td>
                            <td>
                                <label class="switch">
                                    <input onchange="toggleStatusProd(<?= $product['id'] ?>)" name="status" <?= $product['status'] == 1 ? 'checked' : ''  ?> type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </td>

                            <td>
                                <div class="options">
                                    <li class="m-0 ">
                                        <a href="admin/product-variants/<?= $product['id'] ?>">
                                            <i class="view fas fa-eye"></i>
                                        </a>
                                    </li>
                                </div>
                            </td>

                            <td>
                                <ul class="options">
                                    <li class="m-0 ">
                                        <a href="admin/update-product/<?php echo $product['id'] ?>">
                                            <i class="edit fas fa-edit"></i>
                                        </a>
                                    </li>

                                    <li class="m-0 ">
                                        <a onclick="deleteProduct(<?php echo $product['id'] ?>)" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteConfirm">
                                            <i class="delete fas fa-trash-alt"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    function deleteProduct(id) {
        $('#productDel').val(id);
    }
</script>


<div class="modal fade theme-modal" id="deleteConfirm" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content py-3">
            <div class="modal-header border-0  d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Bạn đã chắc chắn chưa?</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 text-center">Nếu thực hiện 'đồng ý' xoá bạn sẽ bị xoá vĩnh viễn không thể khôi phục lại hãy suy nghĩ thật kĩ trước khi xoá.</p>
            </div>
            <div class="modal-footer border-0 ">
                <form action="admin/delete-product" method="post">
                    <input id="productDel" name="id" type="hidden">
                    <button type="submit" class="btn btn-custom btn-yes fw-bold">Đồng ý</button>
                </form>
                <div class="ms-3 ">
                    <button type="button" class="btn btn-custom btn-no fw-bold" data-bs-dismiss="modal">Huỷ</button>
                </div>

            </div>
        </div>
    </div>
</div>