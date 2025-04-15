-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 11, 2025 lúc 09:59 AM
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
-- Cơ sở dữ liệu: `webbandoan24`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `mactdh` int(255) NOT NULL,
  `madh` int(255) NOT NULL,
  `masp` int(255) NOT NULL,
  `soluong` int(255) NOT NULL,
  `giabanle` int(255) NOT NULL,
  `tongtien` int(11) GENERATED ALWAYS AS (`soluong` * `giabanle`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`mactdh`, `madh`, `masp`, `soluong`, `giabanle`) VALUES
(1, 1, 3, 1, 50),
(2, 2, 2, 3, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `madh` int(255) NOT NULL,
  `makh` int(255) NOT NULL,
  `ngaytao` timestamp NOT NULL DEFAULT current_timestamp(),
  `tongtien` int(255) NOT NULL,
  `trangthai` enum('Chưa xác nhận','Đã xác nhận','Đã giao thành công','Đã hủy đơn') DEFAULT 'Chưa xác nhận',
  `tinh_thanhpho` varchar(255) NOT NULL,
  `quan_huyen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`madh`, `makh`, `ngaytao`, `tongtien`, `trangthai`, `tinh_thanhpho`, `quan_huyen`) VALUES
(1, 2, '2025-03-21', 50, 'Đã hủy đơn', 'Thành phố Hà Nội', 'Quận Ba Đình'),
(2, 22, '2025-04-01', 200, 'Chưa xác nhận', 'Thành phố Hà Nội', 'Quận Cầu Giấy');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `magiohang` int(11) NOT NULL,
  `makh` int(11) NOT NULL,
  `masp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `dongia` int(255) NOT NULL,
  `tongtien` int(255) GENERATED ALWAYS AS (`soluong` * `dongia`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`magiohang`, `makh`, `masp`, `soluong`, `dongia`) VALUES
(10, 12, 6, 1, 40),
(11, 12, 6, 1, 40),
(12, 12, 12, 1, 30),
(13, 12, 2, 2, 20),
(14, 12, 2, 1, 20),
(15, 12, 2, 1, 20),
(16, 12, 2, 1, 20),
(17, 12, 2, 1, 20),
(18, 12, 3, 1, 50),
(19, 12, 3, 1, 50),
(20, 12, 3, 1, 50),
(21, 13, 1, 1, 50),
(22, 13, 2, 1, 20),
(23, 13, 1, 1, 50),
(24, 13, 3, 1, 50),
(25, 13, 1, 1, 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `makh` int(11) NOT NULL,
  `tenkh` varchar(100) NOT NULL,
  `matkhau` varchar(20) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `sodienthoai` varchar(20) NOT NULL,
  `trangthai` enum('Locked','Active') NOT NULL DEFAULT 'Active',
  `ngaytao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`makh`, `tenkh`, `matkhau`,`diachi`, `sodienthoai`, `tinhtrang`, `Ngaytao`) VALUES
(12, 'nhan', 'nhan1234','quan tan phu', '0775177636', 'Mở', '2025-04-10 10:48:14'),
(13, 'KK', '12345','12345', '12345', 'Mở', '2025-04-10 10:48:14'),


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `maloai` varchar(255) NOT NULL,
  `tenloai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`maloai`, `tenloai`) VALUES
('L001', 'Món chay'),
('L002', 'Món mặn'),
('L003', 'Món lẩu'),
('L004', 'Món ăn vặt'),
('L005', 'Món tráng miệng'),
('L006', 'Nước uống'),
('L007', 'Hải sản');


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Price` int(255) NOT NULL,
  `Describtion` varchar(255) NOT NULL,
  `Type` enum('món chay','món mặn','món lẩu','món ăn vặt','món tráng miệng','nước uống','hải sản') NOT NULL,
  `Visible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ID`, `Name`, `Image`, `Price`, `Describtion`, `Type`) VALUES
(1, 'Phở bò', 'assets\\img\\products\\phobo.jpg', 50, 'Hương vị tinh túy của Việt Nam, với nước dùng đậm đà từ xương bò hầm kỹ, kết hợp cùng bánh phở mềm, thịt bò tái chín vừa tới và các loại rau thơm tạo nên một món ăn sáng hoàn hảo.', 'món mặn', 1),
(2, 'Bánh mì', 'assets\\img\\products\\banhmi.webp', 20, 'Một trong những món ăn đường phố ngon nhất thế giới, với vỏ bánh giòn rụm, nhân đầy đặn từ pate, thịt nguội, trứng, kèm theo rau thơm và nước sốt đậm đà.', 'món mặn'),
(3, 'Bún chả Hà Nội', 'assets\\img\\products\\buncha.jpg', 50, 'Thịt nướng thơm lừng, được ăn kèm với bún tươi, rau sống và nước mắm chua ngọt, tạo nên sự cân bằng hoàn hảo giữa vị ngọt, chua, mặn, cay.', 'món mặn'),
(4, 'Bánh xèo Miền Tây', 'assets\\img\\products\\banhxeo.jpg', 30, ' Lớp vỏ giòn rụm, nhân đầy đặn từ tôm, thịt và giá đỗ, ăn kèm rau sống và chấm nước mắm chua ngọt, tạo nên hương vị khó quên.', 'món mặn'),
(5, 'Gỏi cuốn', 'assets\\img\\products\\goicuon.jpg', 30, 'Món ăn thanh mát, với tôm, thịt, bún và rau cuốn trong bánh tráng, chấm kèm nước chấm bơ đậu phộng béo bùi.', 'món mặn'),
(6, 'Cao lầu', 'assets\\img\\products\\caolau.jpg', 40, 'Đặc sản Hội An với sợi mì dai, thịt xá xíu đậm đà, rau sống tươi ngon và nước dùng đặc biệt.', 'món mặn'),
(7, 'Bún bò Huế', 'assets\\img\\products\\bunbohue.jpg', 50, ' Nước dùng cay nồng, đậm đà với sả, thịt bò, chả cua, ăn kèm rau thơm và bún to.', 'món mặn'),
(8, 'Hủ tiếu', 'assets\\img\\products\\hutieu.jpg', 30, 'Món ăn miền Nam với nước dùng ngọt thanh từ xương, sợi hủ tiếu dai mềm, ăn kèm tôm, thịt và rau sống.', 'món mặn'),
(9, 'Chả cá Lã Vọng', 'assets\\img\\products\\chaca.jpg', 40, ' Cá lăng nướng nghệ, ăn kèm bún, rau thì là và mắm tôm, tạo nên hương vị độc đáo.', 'món mặn'),
(10, 'Mì Quảng', 'assets\\img\\products\\miquang.jpg', 40, 'Món mì đặc trưng của Quảng Nam với sợi mì vàng, thịt tôm, trứng cút, nước dùng ít nhưng đậm vị.', 'món mặn'),
(11, 'Cơm tấm', 'assets\\img\\products\\comtam.jpeg', 50, ' Món ăn bình dân nhưng đầy đủ dinh dưỡng với sườn nướng, bì, chả trứng, ăn kèm nước mắm pha.', 'món mặn'),
(12, 'Bánh bột lọc Huế', 'assets\\img\\products\\banhbotloc.webp', 30, 'Lớp bột dẻo dai, nhân tôm thịt đậm đà, chấm nước mắm cay tạo nên món ăn vặt hấp dẫn.', 'món mặn'),
(13, 'Bánh cuốn', 'assets\\img\\products\\banhcuonv2.jpg', 30, 'Lớp bánh mỏng dai, nhân thịt băm và mộc nhĩ thơm ngon, ăn kèm nước mắm tỏi ớt và chả lụa, tạo nên bữa sáng tinh tế.', 'món mặn'),
(14, 'Bánh ít', 'assets\\img\\products\\banhit.webp', 10, 'Nhỏ nhắn nhưng đầy hương vị, vỏ bánh dẻo kết hợp nhân đậu xanh hoặc nhân dừa bùi béo.', 'món tráng miệng'),
(15, 'Gà nướng cơm lam', 'assets\\img\\products\\ganuongcomlam.jpg', 120, 'Gà nướng vàng giòn, ăn kèm cơm lam dẻo thơm của vùng Tây Nguyên.', 'món mặn'),
(16, 'Bún cá Nha Trang', 'assets\\img\\products\\buncanhatrang.jpg', 60, 'Nước dùng thanh ngọt từ cá biển, kết hợp với bún tươi và rau sống.', 'hải sản'),
(17, 'Bánh tráng cuốn thịt heo', 'assets\\img\\products\\banhtrangcuonthitheo.jpg', 75, 'Thịt heo mềm thơm, ăn kèm rau sống và chấm mắm nêm đậm đà.', 'món mặn'),
(18, 'Bún sứa Nha Trang', 'assets\\img\\products\\bunsuanhatrang.jpg', 70, 'Sứa giòn sần sật, nước dùng ngọt thanh tạo nên hương vị đặc trưng.', 'hải sản'),
(19, 'Bánh ép Huế', 'assets/img/products/1743773390_banhephue.jpeg', 20, 'Bánh ép giòn rụm, nhân pate, trứng và thịt đầy đặn.', 'món ăn vặt'),
(20, 'Cháo lươn Nghệ An', 'assets\\img\\products\\chaoluonnghean.jpg', 55, 'Cháo lươn thơm ngon, cay nồng đặc trưng của xứ Nghệ.', 'hải sản'),
(21, 'Mực nhồi thịt nướng', 'assets\\img\\products\\mucnhoithitnuong.jpg', 90, 'Mực tươi nhồi thịt, nướng thơm lừng, chấm muối ớt xanh.', 'hải sản'),
(22, 'Cá bống kho tộ', 'assets\\img\\products\\cabongkhoto.jpg', 65, 'Cá bống kho với nước màu dừa, thịt cá mềm ngọt.', 'hải sản'),
(23, 'Hến xào xúc bánh tráng', 'assets\\img\\products\\henxaoxucbanhtrang.jpg', 50, 'Hến xào đậm vị, ăn kèm bánh tráng nướng giòn.', 'món mặn'),
(24, 'Bánh đập hến xào', 'assets\\img\\products\\banhdaphenxao.jpg', 45, 'Bánh đập giòn tan kết hợp với hến xào thơm ngon.', 'món mặn'),
(25, 'Cá lóc nướng trui', 'assets\\img\\products\\calocnuongtrui.jpg', 110, 'Cá lóc nướng nguyên con, ăn kèm rau sống và bún.', 'hải sản'),
(26, 'Lẩu mắm miền Tây', 'assets\\img\\products\\laumam.jpg', 180, 'Lẩu mắm đậm đà, ăn kèm rau đồng quê và bún tươi.', 'hải sản'),
(27, 'Bánh tét lá cẩm', 'assets\\img\\products\\banhtetlacam.jpg', 50, 'Bánh tét dẻo thơm, nhân đậu xanh và thịt ba rọi.', 'món tráng miệng'),
(28, 'Gỏi gà măng cụt', 'assets\\img\\products\\goigamangcut.jpg', 90, 'Gà ta xé phay, trộn cùng măng cụt giòn ngọt.', 'món mặn'),
(29, 'Bánh xèo Nam Bộ', 'assets\\img\\products\\banhxeonambo.jpg', 70, 'Bánh xèo vàng giòn, nhân đầy tôm, thịt và giá.', 'món mặn'),
(30, 'Gỏi củ hủ dừa', 'assets\\img\\products\\goicuhudua.jpg', 65, 'Củ hủ dừa giòn ngọt, trộn cùng tôm thịt và rau thơm.', 'món mặn'),
(31, 'Bò lá lốt', 'assets\\img\\products\\bolalot.jpg', 75, 'Thịt bò băm nhuyễn cuốn lá lốt, nướng thơm lừng.', 'món mặn'),
(32, 'Bún nước lèo Sóc Trăng', 'assets\\img\\products\\bunnuocleo.jpg', 70, 'Bún nước lèo Sóc Trăng đặc trưng với mắm cá linh và cá lóc.', 'món mặn'),
(33, 'Cháo cá lóc rau đắng', 'assets\\img\\products\\chaocalocraudang.jpg', 60, 'Cháo cá lóc nóng hổi ăn cùng rau đắng.', 'hải sản'),
(34, 'Cơm nị cà púa', 'assets\\img\\products\\comnica-pua.jpg', 85, 'Món cơm kiểu Chăm, hương vị đậm đà của gia vị.', 'món chay'),
(35, 'Chuột đồng nướng lu', 'assets\\img\\products\\chuotdongnuong.jpg', 95, 'Chuột đồng nướng giòn, chấm muối tiêu chanh.', 'món mặn'),
(36, 'Bánh tằm bì', 'assets\\img\\products\\banhtambi.jpg', 45, 'Bánh tằm bì dẻo thơm, ăn kèm nước cốt dừa béo ngậy.', 'món tráng miệng'),
(37, 'Hủ tiếu Mỹ Tho', 'assets\\img\\products\\hutieumytho.jpg', 60, 'Hủ tiếu dai ngon, nước dùng trong thanh.', 'món mặn'),
(38, 'Bánh canh Trảng Bàng', 'assets\\img\\products\\banhcanhtrangbang.jpg', 65, 'Sợi bánh canh dai, nước dùng ngọt thanh, ăn kèm thịt heo.', 'món mặn'),
(39, 'Vịt quay Lạng Sơn', 'assets\\img\\products\\vitquaylangson.jpg', 150, 'Vịt quay da giòn, ướp gia vị đặc trưng của vùng Lạng Sơn.', 'món mặn'),
(40, 'Nem nướng Nha Trang', 'assets\\img\\products\\nemnuongnhatrang.jpg', 80, 'Nem nướng thơm lừng, ăn kèm rau sống và nước chấm đặc biệt.', 'món mặn'),
(41, 'Xôi xéo Hà Nội', 'assets\\img\\products\\xoixeohanoi.jpg', 30, 'Xôi nếp dẻo, kết hợp đậu xanh nghiền và hành phi giòn.', 'món tráng miệng'),
(42, 'Bánh gai Hải Dương', 'assets\\img\\products\\banhgaiaidduong.jpg', 25, 'Bánh gai dẻo thơm, nhân đậu xanh béo ngậy.', 'món tráng miệng'),
(43, 'Bánh tro', 'assets\\img\\products\\banhtro.jpg', 20, 'Bánh tro mềm, ăn kèm mật mía ngọt thanh.', 'món tráng miệng'),
(44, 'Chả mực Hạ Long', 'assets\\img\\products\\chamuchalong.jpg', 120, 'Chả mực giòn dai, chấm kèm tương ớt cay nồng.', 'món mặn'),
(45, 'Bánh dày giò', 'assets\\img\\products\\banhdaygio.jpg', 35, 'Bánh dày dẻo dai, ăn kèm giò lụa mềm mịn.', 'món ăn vặt'),
(46, 'Ốc hương nướng bơ tỏi', 'assets\\img\\products\\ochuongnuong.jpg', 110, 'Ốc hương nướng thơm lừng với bơ tỏi béo ngậy.', 'hải sản'),
(47, 'Lẩu cua đồng', 'assets\\img\\products\\laucuadong.jpg', 180, 'Lẩu cua đồng thơm ngon, nước dùng đậm đà từ gạch cua.', 'món lẩu'),
(48, 'Bún riêu cua', 'assets\\img\\products\\bunrieucua.jpg', 65, 'Bún riêu cua nước dùng chua ngọt, ăn kèm rau sống.', 'hải sản'),
(49, 'Bánh bông lan trứng muối', 'assets\\img\\products\\banhbonglantrungmuoi.jpg', 55, 'Bánh mềm mịn, trứng muối mằn mặn, phô mai béo ngậy.', 'món tráng miệng'),
(50, 'Bánh da lợn', 'assets\\img\\products\\banhdalon.jpg', 30, 'Bánh da lợn nhiều lớp, dẻo thơm từ lá dứa và đậu xanh.', 'món tráng miệng'),
(51, 'Bò kho', 'assets\\img\\products\\bokho.jpg', 90, 'Bò kho đậm đà, ăn kèm bánh mì hoặc bún.', 'món mặn'),
(52, 'Xôi gấc', 'assets\\img\\products\\xoigac.jpg', 35, 'Xôi gấc có màu đỏ cam rực rỡ, dẻo thơm.', 'món tráng miệng'),
(53, 'Gà hấp lá chanh', 'assets\\img\\products\\gahaplachanh.jpg', 120, 'Gà hấp thơm lừng lá chanh, thịt mềm ngọt.', 'món mặn'),
(54, 'Canh chua cá lóc', 'assets\\img\\products\\canhchuacaloc.jpg', 75, 'Canh chua thanh mát, cá lóc ngọt thịt, ăn kèm cơm.', 'hải sản'),
(55, 'Tôm rang me', 'assets\\img\\products\\tomrangme.jpg', 85, 'Tôm rang me chua ngọt, ăn kèm cơm trắng hoặc bánh mì.', 'hải sản'),
(56, 'Bánh khọt', 'assets\\img\\products\\banhkhot.jpg', 50, 'Bánh khọt giòn rụm, nhân tôm tươi, chấm nước mắm ngon.', 'món ăn vặt'),
(57, 'Súp cua', 'assets\\img\\products\\supcua.jpg', 70, 'Súp cua thơm ngon, bổ dưỡng với trứng bắc thảo.', 'món ăn vặt'),
(58, 'Nem chua Thanh Hóa', 'assets\\img\\products\\nemchua.jpg', 60, 'Nem chua lên men tự nhiên, chua nhẹ, cay nhẹ.', 'món ăn vặt'),
(59, 'Bánh giò', 'assets\\img\\products\\banhgio.jpg', 40, 'Bánh giò mềm, nhân thịt băm đậm vị, ăn nóng ngon hơn.', 'món ăn vặt'),
(60, 'Cút lộn xào me', 'assets\\img\\products\\cutlonxaome.jpg', 55, 'Trứng cút lộn xào với me chua ngọt, ăn kèm rau răm.', 'món ăn vặt'),
(61, 'Cà phê sữa đá ', 'assets\\img\\products\\caphe.jpg', 30, 'Cà phê sữa đá là một trong những thức uống mang đậm bản sắc Việt Nam. Hương vị đậm đà của cà phê phin hòa quyện với vị ngọt béo của sữa đặc, tạo nên một thức uống vừa mạnh mẽ, vừa ngọt ngào. Uống một ly vào buổi sáng giúp tỉnh táo cả ngày!', 'nước uống'),
(62, 'Trà đá ', 'assets\\img\\products\\trada.jpg', 5, ' Trà đá là thức uống phổ biến ở mọi quán ăn vỉa hè tại Việt Nam. Nó có vị thanh mát, giúp giải nhiệt và không chứa quá nhiều đường hay chất béo, rất tốt cho sức khỏe.', 'nước uống'),
(63, 'Nước sâm', 'assets\\img\\products\\nuocsam.jpg', 10, 'Nước sâm có vị ngọt thanh tự nhiên, thơm nhẹ từ các loại thảo mộc. Đây là thức uống giải nhiệt cực tốt, thường được người miền Nam ưa chuộng, đặc biệt vào những ngày nắng nóng.', 'nước uống'),
(64, 'Nước mía', 'assets\\img\\products\\nuocmia.png', 10, 'Nước mía có vị ngọt tự nhiên, mát lạnh, giúp giải khát nhanh chóng. Thêm một chút tắc hoặc quất sẽ tạo vị chua nhẹ, cân bằng hương vị.', 'nước uống'),
(65, 'Sinh tố bơ', 'assets\\img\\products\\sinhtobo.jpg', 25, 'Sinh tố bơ có độ béo mịn đặc trưng, vị ngọt nhẹ và mùi thơm hấp dẫn. Đây là món sinh tố bổ dưỡng, tốt cho da và sức khỏe.', 'nước uống'),
(66, 'Bún riêu chay ', 'assets\\img\\products\\bunrieuchay.jpg', 30, 'Nước dùng thanh ngọt từ cà chua, đậu hũ và nấm tạo nên vị chua nhẹ, thơm ngon. Món này vẫn giữ được hương vị đặc trưng của bún riêu truyền thống nhưng nhẹ nhàng hơn, thích hợp cho những ai muốn ăn thanh đạm.', 'món chay'),
(67, 'Hủ tiếu chay', 'assets\\img\\products\\hutieuchay.jpg', 30, 'Nước dùng từ rau củ rất ngọt tự nhiên, kết hợp với nấm, tàu hũ ki và sợi hủ tiếu dai ngon. Món này không chỉ thơm ngon mà còn rất bổ dưỡng.', 'món chay'),
(68, 'Cơm tấm chay ', 'assets\\img\\products\\comtamchay.png', 30, ' Món cơm tấm chay có đầy đủ các thành phần như chả chay, bì chay, nước mắm chay pha vừa miệng. Mặc dù không có thịt nhưng vẫn giữ được hương vị thơm ngon, hấp dẫn.\r\n\r\n', 'món chay'),
(69, 'Lẩu nấm chay ', 'assets\\img\\products\\launamchay.jpg', 150, 'Lẩu nấm chay có nước dùng thanh nhẹ, kết hợp với nhiều loại nấm tươi ngon và rau xanh, tạo nên một bữa ăn đầy dinh dưỡng. Đây là lựa chọn tuyệt vời cho những ai thích món ăn lành mạnh.', 'món chay'),
(70, 'Gỏi cuốn chay ', 'assets\\img\\products\\goicuonchay.jpg', 10, 'Gỏi cuốn chay gồm rau sống, bún, đậu hũ cuốn trong bánh tráng, chấm cùng nước tương đậm đà. Món ăn này thanh đạm nhưng vẫn rất ngon miệng.', 'món chay');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`mactdh`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madh`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`magiohang`),
  ADD KEY `makh` (`makh`),
  ADD KEY `masp` (`masp`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makh`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`maloai`);
  
--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `mactdh` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madh` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `magiohang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `makh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`makh`) REFERENCES `khachhang` (`makh`) ON DELETE CASCADE,
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`masp`) REFERENCES `sanpham` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
