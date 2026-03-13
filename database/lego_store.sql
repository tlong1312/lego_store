-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 13, 2026 lúc 01:59 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lego_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import_details`
--

CREATE TABLE `import_details` (
  `id` int(11) NOT NULL,
  `receipt_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `import_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `import_receipts`
--

CREATE TABLE `import_receipts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_cost` double DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `total_money` double DEFAULT 0,
  `payment_method` varchar(50) DEFAULT 'COD',
  `status` varchar(20) DEFAULT 'New',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `piece_count` int(11) DEFAULT NULL,
  `age_range` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `import_price` double DEFAULT 0,
  `profit_margin` double DEFAULT 20,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `theme_id`, `sku`, `name`, `description`, `piece_count`, `age_range`, `image`, `stock_quantity`, `import_price`, `profit_margin`, `status`, `created_at`) VALUES
(1, 1, '42115', 'Lamborghini Sian FKP 37', 'Đối với chủ nghĩa thoát ly thuần túy, không gì có thể đánh bại việc trượt sau tay lái của một chiếc siêu xe thể thao hàng đầu. Giờ đây, bạn có thể tạo lại cảm giác đó và dành thời gian cho cuộc sống hàng ngày với bộ xây dựng LEGO TECHNIC 42115 Siêu Xe Lamborghini Sian FKP 37 ( 3696 Chi tiết) tuyệt đẹp này. Nắm bắt thiết kế có tầm nhìn xa của chiếc xe ban đầu, mô hình tỷ lệ 1: 8 này được trang bị vô số chi tiết chân thực, đưa bạn đến gần hơn bao giờ hết với đồ thật.', 3696, '18+', 'product-1.jpg', 10, 8000000, 20, 1, '2026-02-02 15:54:09'),
(2, 1, '42096', 'Porsche 911 RSR', NULL, 1580, '10+', 'product-2.jpg', 15, 3500000, 25, 1, '2026-02-02 15:54:09'),
(3, 2, '75192', 'Millennium Falcon', NULL, 7541, '16+', 'product-3.jpg', 5, 18000000, 15, 1, '2026-02-02 15:54:09'),
(4, 3, '71043', 'Hogwarts Castle', NULL, 6020, '16+', 'product-4.jpg', 8, 9000000, 20, 1, '2026-02-02 15:54:09'),
(41, 1, '42143', 'Ferrari Daytona SP3', 'Siêu xe Ferrari chi tiết tỷ lệ 1:8', 3778, '18+', 'product-5.jpg', 12, 8500000, 20, 1, '2026-03-12 16:14:02'),
(42, 1, '42125', 'Ferrari 488 GTE', 'Xe đua đường trường', 1677, '18+', 'product-6.jpg', 15, 4500000, 25, 1, '2026-03-12 16:14:02'),
(43, 1, '42127', 'THE BATMAN - BATMOBILE', 'Xe của Batman', 1360, '10+', 'product-7.jpg', 20, 2500000, 25, 1, '2026-03-12 16:14:02'),
(44, 1, '42130', 'BMW M 1000 RR', 'Mô hình xe mô tô BMW', 1920, '18+', 'product-8.jpg', 10, 5500000, 20, 1, '2026-03-12 16:14:02'),
(45, 1, '42110', 'Land Rover Defender', 'Xe địa hình huyền thoại', 2573, '11+', 'product-9.jpg', 5, 4800000, 25, 1, '2026-03-12 16:14:02'),
(46, 1, '42141', 'McLaren Formula 1', 'Xe đua F1 McLaren', 1432, '18+', 'product-10.jpg', 18, 4200000, 25, 1, '2026-03-12 16:14:02'),
(47, 1, '42145', 'Airbus H155 Rescue Helicopter', 'Trực thăng cứu hộ', 2001, '11+', 'product-11.jpg', 6, 5000000, 20, 1, '2026-03-12 16:14:02'),
(48, 2, '75313', 'AT-AT', 'Cỗ máy chiến đấu AT-AT', 6785, '18+', 'product-12.jpg', 4, 19000000, 15, 1, '2026-03-12 16:14:02'),
(49, 2, '75252', 'Imperial Star Destroyer', 'Tàu khu trục không gian', 4784, '16+', 'product-13.jpg', 5, 16000000, 15, 1, '2026-03-12 16:14:02'),
(50, 2, '75308', 'R2-D2', 'Robot R2-D2', 2314, '18+', 'product-14.jpg', 10, 5000000, 20, 1, '2026-03-12 16:14:02'),
(51, 2, '75327', 'Luke Skywalker (Red Five) Helmet', 'Mũ phi công của Luke', 675, '18+', 'product-15.jpg', 25, 1500000, 30, 1, '2026-03-12 16:14:02'),
(52, 2, '75328', 'The Mandalorian N-1 Starfighter Microfighter', 'Phi thuyền của Mandalorian', 584, '18+', 'product-16.jpg', 30, 1500000, 30, 1, '2026-03-12 16:14:02'),
(53, 2, '75330', 'Yoda\'s Jedi Starfighter', 'Thuyền chiến của Jedi', 1000, '18+', 'product-17.jpg', 15, 2200000, 25, 1, '2026-03-12 16:14:02'),
(54, 2, '75329', 'Death Star Trench Run Diorama', 'Cuộc đua rãnh Death Star', 715, '18+', 'product-18.jpg', 20, 1600000, 25, 1, '2026-03-12 16:14:02'),
(55, 2, '75325', 'The Mandalorian N-1 Starfighter', 'Tàu chiến đấu N-1', 412, '9+', 'product-19.jpg', 40, 1400000, 30, 1, '2026-03-12 16:14:02'),
(56, 3, '75978', 'Diagon Alley', 'Hẻm Xéo', 5544, '16+', 'product-20.jpg', 6, 11000000, 20, 1, '2026-03-12 16:14:02'),
(57, 3, '76391', 'Hogwarts Icons - Collectors Edition', 'Các biểu tượng Hogwarts', 3010, '18+', 'product-21.jpg', 8, 6500000, 25, 1, '2026-03-12 16:14:02'),
(58, 3, '76405', 'Hogwarts Express - Collectors Edition', 'Tàu tốc hành Hogwarts', 5129, '18+', 'product-22.jpg', 4, 12000000, 15, 1, '2026-03-12 16:14:02'),
(59, 3, '76389', 'lying Ford Anglia', 'Xe Ford', 1176, '9+', 'product-23.jpg', 15, 3500000, 25, 1, '2026-03-12 16:14:02'),
(60, 3, '76402', 'Hogwarts: Dumbledore Office', 'Văn phòng Dumbledore', 654, '8+', 'product-24.jpg', 20, 2100000, 25, 1, '2026-03-12 16:14:02'),
(61, 3, '76401', 'Hogwarts Courtyard: Sirius Rescue', 'Sân trong Hogwarts', 345, '8+', 'product-25.jpg', 30, 1200000, 30, 1, '2026-03-12 16:14:02'),
(62, 3, '76398', 'Hogwarts Hospital Wing', 'Bệnh xá Hogwarts', 510, '8+', 'product-26.jpg', 25, 1400000, 30, 1, '2026-03-12 16:14:02'),
(63, 3, '76403', 'Hagrid and Harry\'s Motorcycle Ride', 'Xe của Hagrid và Harry', 990, '9+', 'product-27.jpg', 12, 2800000, 25, 1, '2026-03-12 16:14:02'),
(64, 4, '60336', 'Freight Train', 'Tàu chở hàng', 1153, '7+', 'product-28.jpg', 10, 4500000, 20, 1, '2026-03-12 16:14:02'),
(65, 4, '60337', 'Express Passenger Train', 'Tàu chở khách', 764, '7+', 'product-29.jpg', 15, 3800000, 25, 1, '2026-03-12 16:14:02'),
(66, 4, '60316', 'Police Station', 'Trạm cảnh sát', 668, '6+', 'product-30.jpg', 20, 1800000, 30, 1, '2026-03-12 16:14:02'),
(67, 4, '60320', 'Fire Station', 'Trạm cứu hỏa', 540, '6+', 'product-31.jpg', 25, 1600000, 30, 1, '2026-03-12 16:14:02'),
(68, 4, '60312', 'Police Car', 'Xe cảnh sát', 94, '5+', 'product-32.jpg', 50, 300000, 40, 1, '2026-03-12 16:14:02'),
(69, 4, '60324', 'Mobile Crane', 'Cần cẩu di động', 340, '7+', 'product-33.jpg', 30, 1100000, 30, 1, '2026-03-12 16:14:02'),
(70, 4, '60345', 'Farmers Market Van', 'Xe bán nông sản', 310, '5+', 'product-34.jpg', 35, 900000, 35, 1, '2026-03-12 16:14:02'),
(71, 4, '60347', 'Grocery Store', 'Cửa hàng tạp hóa', 404, '6+', 'product-35.jpg', 25, 1500000, 30, 1, '2026-03-12 16:14:02'),
(72, 4, '60314', 'Ice Cream Truck Police Chase', 'Rượt đuổi xe kem', 317, '5+', 'product-36.jpg', 40, 800000, 35, 1, '2026-03-12 16:14:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `themes`
--

INSERT INTO `themes` (`id`, `name`, `description`) VALUES
(1, 'Technic', 'Dòng xe cộ máy móc phức tạp'),
(2, 'Star Wars', 'Mô hình tàu vũ trụ chiến tranh giữa các vì sao'),
(3, 'Harry Potter', 'Thế giới phù thủy Hogwarts'),
(4, 'City', 'Mô hình thành phố, cảnh sát, cứu hỏa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `is_locked` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `address`, `role`, `is_locked`, `created_at`) VALUES
(1, 'Quản Trị Viên', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'Văn phòng Admin', 'admin', 0, '2026-02-02 15:54:09'),
(2, 'Khách Hàng A', 'khach@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '123 Đường LEGO, HCM', 'customer', 0, '2026-02-02 15:54:09'),
(3, 'Đặng Tiểu Long', 'dangtieulong362@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0912345678', 'THPT Lý Thường Kiệt - Thành phố Hồ Chí Minh', 'customer', 0, '2026-03-12 15:46:19'),
(4, 'Đặng Tiểu Long', 'dangtieulong0@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0312345678', 'THPT Lý Thường Kiệt - Thành phố Hồ Chí Minh', 'customer', 0, '2026-03-12 15:49:07');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `import_details`
--
ALTER TABLE `import_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_id` (`receipt_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `import_receipts`
--
ALTER TABLE `import_receipts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `theme_id` (`theme_id`);

--
-- Chỉ mục cho bảng `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `import_details`
--
ALTER TABLE `import_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `import_receipts`
--
ALTER TABLE `import_receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `import_details`
--
ALTER TABLE `import_details`
  ADD CONSTRAINT `import_details_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `import_receipts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `import_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `import_receipts`
--
ALTER TABLE `import_receipts`
  ADD CONSTRAINT `import_receipts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
