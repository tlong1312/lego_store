<?php
$profileOld = $profile_old ?? [];
$profileFullname = $profileOld['fullname'] ?? ($user['fullname'] ?? '');
$profilePhone = $profileOld['phone'] ?? ($user['phone'] ?? '');
$profileAddress = $profileOld['address'] ?? ($user['address'] ?? '');
$profileProvince = $profileOld['province'] ?? ($user['province'] ?? '');
$profileWard = $profileOld['ward'] ?? ($user['ward'] ?? '');
?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Tài Khoản Của Tôi</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <span>Thông tin cá nhân</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="mk-profile-wrap">
            <h4 class="mk-profile-title">Trang Thông Tin Khách Hàng</h4>
            <p class="mk-profile-subtitle">Bạn có thể cập nhật thông tin tài khoản và đổi mật khẩu tại đây.</p>

            <div class="row">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="mk-profile-card">
                        <h5>Thông Tin Cá Nhân</h5>
                        <hr class="mk-divider">

                        <form id="profileForm" action="index.php?controller=auth&action=updateProfile" method="POST" novalidate>
                            <div class="form-group">
                                <label class="mk-input-label">Tên tài khoản</label>
                                <input type="text" class="form-control mk-input" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                                <div class="mk-inline-note">Tên tài khoản không được phép thay đổi.</div>
                            </div>

                            <div class="form-group">
                                <label class="mk-input-label">Họ và tên</label>
                                <input id="profile_fullname" type="text" name="fullname" class="form-control mk-input"
                                    value="<?= htmlspecialchars($profileFullname) ?>" required>
                                <?php if (!empty($profile_errors['fullname'])): ?>
                                    <div class="mk-error"><?= htmlspecialchars($profile_errors['fullname']) ?></div>
                                <?php endif; ?>
                                <div id="profile_fullname_error" class="mk-error mk-js-error"></div>
                            </div>

                            <div class="form-group">
                                <label class="mk-input-label">Số điện thoại</label>
                                <input id="profile_phone" type="text" name="phone" class="form-control mk-input"
                                    value="<?= htmlspecialchars($profilePhone) ?>" placeholder="VD: 0912345678" required>
                                <?php if (!empty($profile_errors['phone'])): ?>
                                    <div class="mk-error"><?= htmlspecialchars($profile_errors['phone']) ?></div>
                                <?php endif; ?>
                                <div id="profile_phone_error" class="mk-error mk-js-error"></div>
                            </div>

                            <?php if (!empty($supports_region)): ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mk-input-label">Tỉnh/Thành</label>
                                            <select id="province" name="province_code" class="form-control mk-input mk-select" required>
                                                <option value="">Chọn Tỉnh/Thành</option>
                                            </select>
                                            <input type="hidden" id="province_name" name="province_name" value="<?= htmlspecialchars($profileProvince) ?>">
                                            <?php if (!empty($profile_errors['province'])): ?>
                                                <div class="mk-error"><?= htmlspecialchars($profile_errors['province']) ?></div>
                                            <?php endif; ?>
                                            <div id="profile_province_error" class="mk-error mk-js-error"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mk-input-label">Phường/Xã</label>
                                            <select id="ward" name="ward_code" class="form-control mk-input mk-select" required>
                                                <option value="">Chọn Phường/Xã</option>
                                            </select>
                                            <input type="hidden" id="ward_name" name="ward_name" value="<?= htmlspecialchars($profileWard) ?>">
                                            <input type="hidden" id="ward_has_options" name="ward_has_options" value="0">
                                            <?php if (!empty($profile_errors['ward'])): ?>
                                                <div class="mk-error"><?= htmlspecialchars($profile_errors['ward']) ?></div>
                                            <?php endif; ?>
                                            <div id="profile_ward_error" class="mk-error mk-js-error"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label class="mk-input-label">Địa chỉ chi tiết</label>
                                <textarea id="profile_address" name="address" class="form-control mk-textarea" rows="3" required><?= htmlspecialchars($profileAddress) ?></textarea>
                                <?php if (!empty($profile_errors['address'])): ?>
                                    <div class="mk-error"><?= htmlspecialchars($profile_errors['address']) ?></div>
                                <?php endif; ?>
                                <div id="profile_address_error" class="mk-error mk-js-error"></div>
                            </div>

                            <button type="submit" class="mk-btn-primary">Lưu Thông Tin</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="mk-profile-card">
                        <h5>Đổi Mật Khẩu</h5>
                        <hr class="mk-divider">

                        <form id="passwordForm" action="index.php?controller=auth&action=changePassword" method="POST" novalidate>
                            <div class="form-group">
                                <label class="mk-input-label">Mật khẩu hiện tại</label>
                                <input id="old_password" type="password" name="old_password" class="form-control mk-input" required>
                                <?php if (!empty($password_errors['old_password'])): ?>
                                    <div class="mk-error"><?= htmlspecialchars($password_errors['old_password']) ?></div>
                                <?php endif; ?>
                                <div id="old_password_error" class="mk-error mk-js-error"></div>
                            </div>

                            <div class="form-group">
                                <label class="mk-input-label">Mật khẩu mới</label>
                                <input id="new_password" type="password" name="new_password" class="form-control mk-input" required>
                                <?php if (!empty($password_errors['new_password'])): ?>
                                    <div class="mk-error"><?= htmlspecialchars($password_errors['new_password']) ?></div>
                                <?php endif; ?>
                                <div id="new_password_error" class="mk-error mk-js-error"></div>
                            </div>

                            <div class="form-group">
                                <label class="mk-input-label">Xác nhận mật khẩu mới</label>
                                <input id="confirm_password" type="password" name="confirm_password" class="form-control mk-input" required>
                                <?php if (!empty($password_errors['confirm_password'])): ?>
                                    <div class="mk-error"><?= htmlspecialchars($password_errors['confirm_password']) ?></div>
                                <?php endif; ?>
                                <div id="confirm_password_error" class="mk-error mk-js-error"></div>
                            </div>

                            <button type="submit" class="mk-btn-primary">Cập Nhật Mật Khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const profileForm = document.getElementById('profileForm');
    const passwordForm = document.getElementById('passwordForm');

    const fullnameInput = document.getElementById('profile_fullname');
    const phoneInput = document.getElementById('profile_phone');
    const addressInput = document.getElementById('profile_address');
    const provinceSelect = document.getElementById('province');
    const wardSelect = document.getElementById('ward');
    const provinceNameInput = document.getElementById('province_name');
    const wardNameInput = document.getElementById('ward_name');
    const wardHasOptionsInput = document.getElementById('ward_has_options');
    let activeProvinceCode = '';
    let wardLoadRequestId = 0;

    function disableNiceSelectForRegion() {
        if (!window.jQuery || !window.jQuery.fn || !window.jQuery.fn.niceSelect) {
            return;
        }

        const $province = window.jQuery('#province');
        const $ward = window.jQuery('#ward');

        if ($province.length && $province.next('.nice-select').length) {
            $province.niceSelect('destroy');
        }

        if ($ward.length && $ward.next('.nice-select').length) {
            $ward.niceSelect('destroy');
        }
    }

    disableNiceSelectForRegion();

    const oldPasswordInput = document.getElementById('old_password');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    function setError(inputEl, errorEl, message) {
        if (!inputEl || !errorEl) {
            return;
        }
        inputEl.classList.add('is-invalid');
        errorEl.textContent = message;

        if (inputEl.tagName === 'SELECT' && inputEl.nextElementSibling && inputEl.nextElementSibling.classList.contains('nice-select')) {
            inputEl.nextElementSibling.classList.add('mk-invalid-select');
        }
    }

    function clearError(inputEl, errorEl) {
        if (!inputEl || !errorEl) {
            return;
        }
        inputEl.classList.remove('is-invalid');
        errorEl.textContent = '';

        if (inputEl.tagName === 'SELECT' && inputEl.nextElementSibling && inputEl.nextElementSibling.classList.contains('nice-select')) {
            inputEl.nextElementSibling.classList.remove('mk-invalid-select');
        }
    }

    function updateNiceSelect(selectId) {
        if (selectId === 'province' || selectId === 'ward') {
            return;
        }

        if (!window.jQuery || !window.jQuery.fn || !window.jQuery.fn.niceSelect) {
            return;
        }

        const $select = window.jQuery('#' + selectId);
        if (!$select.length) {
            return;
        }

        if ($select.next('.nice-select').length) {
            $select.niceSelect('update');
        }
    }

    function setWardLoadingState(isLoading, message) {
        if (!wardSelect) {
            return;
        }

        if (isLoading) {
            wardSelect.disabled = true;
            wardSelect.innerHTML = '<option value="">Đang tải Phường/Xã...</option>';
        } else {
            wardSelect.disabled = false;
            if (message) {
                const hasOptions = wardSelect.options.length > 1;
                if (!hasOptions) {
                    wardSelect.innerHTML = '<option value="">' + message + '</option>';
                }
            }
        }

        updateNiceSelect('ward');
    }

    function syncRegionHiddenNames() {
        if (provinceSelect && provinceNameInput) {
            const provinceText = provinceSelect.options[provinceSelect.selectedIndex]
                ? provinceSelect.options[provinceSelect.selectedIndex].text
                : '';
            provinceNameInput.value = provinceSelect.value ? provinceText : '';
        }

        if (wardSelect && wardNameInput) {
            const wardText = wardSelect.options[wardSelect.selectedIndex]
                ? wardSelect.options[wardSelect.selectedIndex].text
                : '';
            wardNameInput.value = wardSelect.value ? wardText : '';
        }
    }

    function onProvinceChanged(provinceCode, provinceText, selectedWardName) {
        if (!provinceSelect) {
            return;
        }

        const safeProvinceCode = String(provinceCode || '').trim();
        const safeProvinceText = String(provinceText || '').trim();
        const safeSelectedWardName = String(selectedWardName || '').trim();

        provinceNameInput.value = safeProvinceCode ? safeProvinceText : '';
        wardNameInput.value = '';
        activeProvinceCode = safeProvinceCode;

        if (wardHasOptionsInput) {
            wardHasOptionsInput.value = '0';
        }

        if (wardSelect) {
            wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
            updateNiceSelect('ward');
        }

        if (safeProvinceCode) {
            loadWards(safeProvinceCode, safeSelectedWardName);
        }
    }

    if (fullnameInput) {
        fullnameInput.addEventListener('input', function () {
            clearError(fullnameInput, document.getElementById('profile_fullname_error'));
        });
    }

    if (phoneInput) {
        phoneInput.addEventListener('input', function () {
            clearError(phoneInput, document.getElementById('profile_phone_error'));
        });
    }

    if (addressInput) {
        addressInput.addEventListener('input', function () {
            clearError(addressInput, document.getElementById('profile_address_error'));
        });
    }

    if (provinceSelect) {
        provinceSelect.addEventListener('change', function () {
            clearError(provinceSelect, document.getElementById('profile_province_error'));
            const selectedText = this.options[this.selectedIndex] ? this.options[this.selectedIndex].text : '';
            onProvinceChanged(this.value, selectedText, '');
        });
    }

    if (wardSelect) {
        wardSelect.addEventListener('change', function () {
            clearError(wardSelect, document.getElementById('profile_ward_error'));
            const selectedText = this.options[this.selectedIndex] ? this.options[this.selectedIndex].text : '';
            wardNameInput.value = this.value ? selectedText : '';
        });
    }

    if (oldPasswordInput) {
        oldPasswordInput.addEventListener('input', function () {
            clearError(oldPasswordInput, document.getElementById('old_password_error'));
        });
    }

    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function () {
            clearError(newPasswordInput, document.getElementById('new_password_error'));
        });
    }

    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function () {
            clearError(confirmPasswordInput, document.getElementById('confirm_password_error'));
        });
    }

    function validateProfileForm() {
        let isValid = true;
        const phoneRegex = /^(0[35789][0-9]{8})$/;

        clearError(fullnameInput, document.getElementById('profile_fullname_error'));
        clearError(phoneInput, document.getElementById('profile_phone_error'));
        clearError(addressInput, document.getElementById('profile_address_error'));

        if (fullnameInput && fullnameInput.value.trim() === '') {
            setError(fullnameInput, document.getElementById('profile_fullname_error'), 'Vui lòng nhập họ và tên.');
            isValid = false;
        }

        if (phoneInput && phoneInput.value.trim() === '') {
            setError(phoneInput, document.getElementById('profile_phone_error'), 'Vui lòng nhập số điện thoại.');
            isValid = false;
        } else if (phoneInput && !phoneRegex.test(phoneInput.value.trim())) {
            setError(phoneInput, document.getElementById('profile_phone_error'), 'Số điện thoại phải gồm 10 số (Bắt đầu bằng 03, 05, 07, 08, 09).');
            isValid = false;
        }

        if (addressInput && addressInput.value.trim() === '') {
            setError(addressInput, document.getElementById('profile_address_error'), 'Vui lòng nhập địa chỉ chi tiết.');
            isValid = false;
        }

        if (provinceSelect) {
            clearError(provinceSelect, document.getElementById('profile_province_error'));
            if (!provinceSelect.value) {
                setError(provinceSelect, document.getElementById('profile_province_error'), 'Vui lòng chọn Tỉnh/Thành.');
                isValid = false;
            }
        }

        const shouldRequireWard = wardSelect
            && !wardSelect.disabled
            && wardHasOptionsInput
            && wardHasOptionsInput.value === '1';

        if (shouldRequireWard) {
            clearError(wardSelect, document.getElementById('profile_ward_error'));
            if (!wardSelect.value) {
                setError(wardSelect, document.getElementById('profile_ward_error'), 'Vui lòng chọn Phường/Xã.');
                isValid = false;
            }
        }

        return isValid;
    }

    function validatePasswordForm() {
        let isValid = true;

        clearError(oldPasswordInput, document.getElementById('old_password_error'));
        clearError(newPasswordInput, document.getElementById('new_password_error'));
        clearError(confirmPasswordInput, document.getElementById('confirm_password_error'));

        if (oldPasswordInput && oldPasswordInput.value === '') {
            setError(oldPasswordInput, document.getElementById('old_password_error'), 'Vui lòng nhập mật khẩu hiện tại.');
            isValid = false;
        }

        if (newPasswordInput && newPasswordInput.value.length < 6) {
            setError(newPasswordInput, document.getElementById('new_password_error'), 'Mật khẩu mới phải có ít nhất 6 ký tự.');
            isValid = false;
        }

        if (oldPasswordInput && newPasswordInput && oldPasswordInput.value !== '' && oldPasswordInput.value === newPasswordInput.value) {
            setError(newPasswordInput, document.getElementById('new_password_error'), 'Mật khẩu mới phải khác mật khẩu hiện tại.');
            isValid = false;
        }

        if (confirmPasswordInput && newPasswordInput && confirmPasswordInput.value !== newPasswordInput.value) {
            setError(confirmPasswordInput, document.getElementById('confirm_password_error'), 'Mật khẩu xác nhận không khớp.');
            isValid = false;
        }

        return isValid;
    }

    if (profileForm) {
        profileForm.addEventListener('submit', function (e) {
            syncRegionHiddenNames();
            if (!validateProfileForm()) {
                e.preventDefault();
            }
        });
    }

    if (passwordForm) {
        passwordForm.addEventListener('submit', function (e) {
            if (!validatePasswordForm()) {
                e.preventDefault();
            }
        });
    }

    function loadWards(provinceCode, selectedWardName) {
        if (!wardSelect) {
            return;
        }

        const requestId = ++wardLoadRequestId;
        const expectedProvinceCode = String(provinceCode || '').trim();

        setWardLoadingState(true);

        fetch(`https://provinces.open-api.vn/api/v2/p/${provinceCode}?depth=2`)
            .then(response => response.json())
            .then(data => {
                const currentSelectedProvince = provinceSelect ? String(provinceSelect.value || '').trim() : '';
                if (
                    requestId !== wardLoadRequestId
                    || expectedProvinceCode !== activeProvinceCode
                    || expectedProvinceCode !== currentSelectedProvince
                ) {
                    return;
                }

                wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                const wards = Array.isArray(data.wards) ? data.wards : [];

                if (wards.length > 0) {
                    if (wardHasOptionsInput) {
                        wardHasOptionsInput.value = '1';
                    }
                    wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.code;
                        option.text = ward.name;
                        wardSelect.add(option);
                    });
                } else if (wardHasOptionsInput) {
                    wardHasOptionsInput.value = '0';
                }

                if (selectedWardName) {
                    const matchedWard = Array.from(wardSelect.options).find(option => option.text === selectedWardName);
                    if (matchedWard) {
                        wardSelect.value = matchedWard.value;
                        wardNameInput.value = selectedWardName;
                    }
                }

                // Always show a concrete ward in UI: use saved ward, otherwise choose first ward.
                if (wards.length > 0 && !wardSelect.value) {
                    wardSelect.value = String(wards[0].code);
                    wardNameInput.value = String(wards[0].name);
                }

                setWardLoadingState(false, wards.length > 0 ? 'Chọn Phường/Xã' : 'Không có dữ liệu Phường/Xã');
            })
            .catch(() => {
                const currentSelectedProvince = provinceSelect ? String(provinceSelect.value || '').trim() : '';
                if (
                    requestId !== wardLoadRequestId
                    || expectedProvinceCode !== activeProvinceCode
                    || expectedProvinceCode !== currentSelectedProvince
                ) {
                    return;
                }

                wardSelect.innerHTML = '<option value="">Không tải được Phường/Xã</option>';
                wardNameInput.value = '';
                if (wardHasOptionsInput) {
                    wardHasOptionsInput.value = '0';
                }
                setWardLoadingState(false, 'Không tải được Phường/Xã');
            });
    }

    if (provinceSelect) {
        const currentProvinceName = (provinceNameInput.value || '').trim();
        const currentWardName = (wardNameInput.value || '').trim();

        fetch('https://provinces.open-api.vn/api/v2/p/')
            .then(response => response.json())
            .then(data => {
                provinceSelect.innerHTML = '<option value="">Chọn Tỉnh/Thành</option>';
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.code;
                    option.text = province.name;
                    provinceSelect.add(option);
                });

                if (currentProvinceName) {
                    const matchedProvince = Array.from(provinceSelect.options).find(option => option.text === currentProvinceName);
                    if (matchedProvince) {
                        provinceSelect.value = matchedProvince.value;
                        onProvinceChanged(matchedProvince.value, currentProvinceName, currentWardName);
                    } else {
                        provinceNameInput.value = '';
                        wardNameInput.value = '';
                        activeProvinceCode = '';
                    }
                }

                updateNiceSelect('province');
            })
            .catch(() => {
                if (provinceSelect) {
                    provinceSelect.innerHTML = '<option value="">Không tải được Tỉnh/Thành</option>';
                }
                updateNiceSelect('province');
            });
    }
});
</script>
