
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © <script>document.write(new Date().getFullYear());</script>
                                , made with ❤️ by <strong>Trần Hoàng Long</strong> and <strong>Đặng Tiểu Long</strong>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="public/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="public/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="public/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="public/admin/assets/vendor/js/menu.js"></script>
    <script src="public/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="public/admin/assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        window.addEventListener('pageshow', function (event) {
            if (localStorage.getItem('admin_logged_in') !== 'true') {
                window.location.replace('index.php?controller=auth&action=adminlogin');
                return; 
            }

            var isNavigatingBack = event.persisted || 
                (performance.getEntriesByType("navigation").length > 0 && 
                 performance.getEntriesByType("navigation")[0].type === "back_forward");

            if (isNavigatingBack) {
                window.location.reload();
            }
        });

        localStorage.setItem('admin_logged_in', 'true');
    </script>
</body>
</html>
</body>
</html>