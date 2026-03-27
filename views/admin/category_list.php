<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)"><i class="bx bx-menu bx-sm"></i></a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center w-100">
            <div class="nav-item d-flex align-items-center w-100">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Gõ tên danh mục để tìm nhanh..." value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>" />
            </div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online"><img src="public/admin/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" /></div>
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center pb-0">
        <h5 class="mb-0">Quản Lý Danh Mục (Categories)</h5>
        <a href="index.php?controller=AdminCategory&action=add" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>Thêm Mới
        </a>
    </div>

    <div class="card-body mt-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Tên Danh Mục</th>
                        <th style="width: 120px;" class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $item): ?>
                            <tr class="category-row">
                                <td><strong>#<?= $item['id'] ?></strong></td>
                                <td>
                                    <strong><?= htmlspecialchars($item['name']) ?></strong>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="index.php?controller=AdminCategory&action=edit&id=<?= $item['id'] ?>">
                                                <i class="bx bx-edit-alt me-1"></i> Sửa
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger btn-delete-category" href="javascript:void(0);" data-id="<?= $item['id'] ?>" data-name="<?= htmlspecialchars($item['name']) ?>">
                                                <i class="bx bx-trash me-1"></i> Xóa
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr id="noResultsRow" style="display: none;">
                            <td colspan="3" class="text-center py-4 text-muted">Không tìm thấy danh mục nào phù hợp với từ khóa của bạn.</td>
                        </tr>

                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-4">Chưa có danh mục nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
     
    .swal2-container {
        z-index: 99999 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
         
        const searchInput = document.getElementById('searchInput');
        const categoryRows = document.querySelectorAll('.category-row');
        const noResultsRow = document.getElementById('noResultsRow');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                let hasMatch = false; 

                categoryRows.forEach(row => {
                    const categoryName = row.querySelector('td:nth-child(2) strong').innerText.toLowerCase();

                    if (categoryName.includes(keyword)) {
                        row.style.display = '';
                        hasMatch = true; 
                    } else {
                        row.style.display = 'none';
                    }
                });

                if (noResultsRow) {
                    if (!hasMatch && categoryRows.length > 0) {
                        noResultsRow.style.display = '';
                    } else {
                        noResultsRow.style.display = 'none';
                    }
                }
            });
        }

         
        const deleteButtons = document.querySelectorAll('.btn-delete-category');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); 
                
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');
                
                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: `Bạn muốn xóa danh mục "${categoryName}"? Hành động này không thể hoàn tác!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#696cff',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `index.php?controller=AdminCategory&action=delete&id=${categoryId}`;
                    }
                });
            });
        });

         
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] === 'error_has_products'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại!',
                    text: 'Không thể xóa vì có sản phẩm thuộc danh mục này đang bán', 
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#696cff'
                });
            <?php elseif ($_GET['msg'] === 'delete_success'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Đã xóa danh mục.',
                    showConfirmButton: false, 
                    timer: 1500
                });
            <?php elseif ($_GET['msg'] === 'delete_error'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Có lỗi xảy ra trong quá trình xóa. Vui lòng thử lại.',
                    confirmButtonColor: '#696cff'
                });
            <?php endif; ?>
            
             
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?controller=AdminCategory&action=index";
            window.history.replaceState({path: newUrl}, '', newUrl);
        <?php endif; ?>
    });
</script>