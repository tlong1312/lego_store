<?php 
// Đoạn code "thông minh" tự nhận diện đang Thêm hay Sửa
$isEdit = isset($category); 
$actionUrl = $isEdit ? "index.php?controller=AdminCategory&action=update" : "index.php?controller=AdminCategory&action=store";
$title = $isEdit ? "Chỉnh Sửa Danh Mục" : "Thêm Danh Mục Mới";
$btnText = $isEdit ? "Cập Nhật" : "Lưu Danh Mục";
?>

<div class="row mt-4">
    <div class="col-xl-6 col-lg-8 col-md-10 mx-auto"> 
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= $title ?></h5>
                <a href="index.php?controller=AdminCategory&action=index" class="btn btn-sm btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Quay lại
                </a>
            </div>
            
            <div class="card-body">
                <form action="<?= $actionUrl ?>" method="POST">
                    
                    <?php if ($isEdit): ?>
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">
                    <?php endif; ?>

                    <div class="mb-4">
                        <label class="form-label fw-bold" for="name">Tên Danh Mục <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="name" 
                               name="name" 
                               placeholder="VD: Lego Star Wars, Lego City..." 
                               value="<?= $isEdit ? htmlspecialchars($category['name']) : '' ?>" 
                               required autofocus />
                        <div class="form-text">Tên danh mục nên ngắn gọn và dễ hiểu.</div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> <?= $btnText ?>
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>