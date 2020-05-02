CREATE TABLE `cart` (
  'cartid' int(255) primary key auto_increment NOT NULL,
  `products` varchar(255) NOT NULL,
  `quantities` int(255) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `cart` (`products`, `quantities`, `user`) VALUES
('Samsung s9', 1, 'Sukh Kharoud'),
('Iphone X', 2, 'Sim Baidban'),
('Samsung s9', 1, 'Sukh Kharoud'),
('Iphone X', 2, 'Sim Baidban');