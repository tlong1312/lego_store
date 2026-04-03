<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Quản Trị Hệ Thống | LEGO Store</title>

    <meta name="description" content="Trang đăng nhập dành cho Quản trị viên" />

    <link rel="icon" type="image/x-icon" href="public/admin/assets/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="public/admin/assets/vendor/fonts/boxicons.css" />

    <link rel="stylesheet" href="public/admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="public/admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="public/admin/assets/css/demo.css" />

    <link rel="stylesheet" href="public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="public/admin/assets/vendor/css/pages/page-auth.css" />

    <script src="public/admin/assets/vendor/js/helpers.js"></script>
    <script src="public/admin/assets/js/config.js"></script>

    <style>
      body {
        background-color: #f9f9f8 !important;
      }
      
      .page-header-top {
        background-color: #f3f2ef;
        padding: 30px 50px;
        margin-bottom: -50px; 
      }
      .page-header-top h3 {
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
        font-size: 1.5rem;
      }
      .page-header-top .breadcrumb-text {
        font-size: 0.9rem;
        color: #777;
      }
      .page-header-top .breadcrumb-text a {
        color: #777;
        text-decoration: none;
      }

      .auth-custom-card {
        border: none;
        border-radius: 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        padding: 40px 30px;
      }

      .user-avatar-circle {
        width: 65px;
        height: 65px;
        background-color: #111;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
      }
      .user-avatar-circle i {
        color: #fff;
        font-size: 32px;
      }

      .form-title {
        text-align: center;
        font-weight: 800;
        letter-spacing: 1.5px;
        margin-bottom: 5px;
        color: #111;
      }
      .form-subtitle {
        text-align: center;
        color: #888;
        font-size: 0.95rem;
        margin-bottom: 30px;
      }

      .form-control, .input-group-text {
        border-radius: 0;
        border-color: #ddd;
        padding: 0.6rem 1rem;
      }
      .form-control:focus {
        border-color: #111;
        box-shadow: none;
      }
      .form-label {
        font-weight: 600;
        color: #444;
      }

      .btn-black {
        background-color: #111;
        color: #fff;
        border-radius: 0;
        padding: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        border: none;
        transition: 0.3s;
      }
      .btn-black:hover {
        background-color: #333;
        color: #fff;
      }
      
      .form-check-input {
        border-radius: 0 !important;
      }
    </style>
  </head>

  <body>
    <div class="page-header-top">
        <div class="container-xxl">
            <h3>Hệ Thống Quản Trị</h3>
            <div class="breadcrumb-text">
                <span class="text-muted"><i class="bx bx-shield me-1"></i>Khu vực dành riêng cho Quản trị viên</span>
            </div>
        </div>
    </div>

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          
          <div class="card auth-custom-card">
            <div class="card-body p-0">
              
              <div class="user-avatar-circle">
                <i class="bx bx-shield-quarter"></i> </div>
              
              <h4 class="form-title">LEGO ADMIN</h4>
              <p class="form-subtitle">Đăng nhập để vào Bảng điều khiển</p>

              <form id="formAuthentication" class="mb-3" action="index.php?controller=auth&action=processLogin" method="POST">
                
                <div class="mb-4">
                  <label for="email" class="form-label">Tài khoản Admin <span class="text-danger">*</span></label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email-username"
                    placeholder="admin@legostore.com"
                    autofocus
                    required
                  />
                </div>
                
                <div class="mb-4 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Mật khẩu <span class="text-danger">*</span></label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember_me" />
                    <label class="form-check-label text-muted" style="font-size: 0.9rem;" for="remember-me"> Ghi nhớ phiên đăng nhập </label>
                  </div>
                </div>

                <div class="mb-1">
                  <button class="btn btn-black d-grid w-100" type="submit">ĐĂNG NHẬP VÀO HỆ THỐNG</button>
                </div>
              </form>
              
              <div class="text-center mt-4">
                  <a href="index.php" class="text-muted" style="font-size: 0.85rem; text-decoration: none;">
                    <i class="bx bx-left-arrow-alt align-middle me-1"></i> Quay lại trang cửa hàng
                  </a>
              </div>

            </div>
          </div>
          
        </div>
      </div>
    </div>

    <script src="public/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="public/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="public/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="public/admin/assets/vendor/js/menu.js"></script>
    <script src="public/admin/assets/js/main.js"></script>
  </body>
</html>