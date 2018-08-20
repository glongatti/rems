-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 20, 2018 at 06:42 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_rems`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `price` float NOT NULL,
  `inputs` varchar(200) NOT NULL,
  `sales_number` int(5) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `inputs`, `sales_number`, `image_url`) VALUES
(9, 'Hot Dog', 20, 'PÃ£o,Salsicha,PurÃª de Batata,Catchup,Mostarda,Maionese,Batata Palha.', 3, 'images/hotdog.png'),
(8, 'Lanche de Carne', 18, 'PÃ£o FrancÃªs,Carne desfiada,Azeitona.', 1, 'images/lanche_carne.jpg'),
(7, 'Lanche Natural de Frango', 15, 'PÃ£o Integral,Alface,Tomate,OrÃ©gano,Salsinha,Frango Desfiado.', 0, 'images/lanche_natural.jpg'),
(10, 'Coca Cola Lata ', 5, 'Coca Cola Lata  350ml', 0, 'images/coca.png'),
(11, 'GuaranÃ¡ Lata', 5, 'GuaranÃ¡ Lata 350ml', 2, 'images/guarana.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `sale_id` int(5) NOT NULL AUTO_INCREMENT,
  `sale_product` varchar(300) NOT NULL,
  `product_amount` int(5) NOT NULL,
  `unit_price` float NOT NULL,
  `sale_date` datetime DEFAULT NULL,
  `sale_value` float NOT NULL,
  PRIMARY KEY (`sale_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `sale_product`, `product_amount`, `unit_price`, `sale_date`, `sale_value`) VALUES
(20, 'Hot Dog', 3, 20, '2018-08-20 18:41:53', 60),
(19, 'Lanche de Carne', 1, 18, '2018-08-20 18:41:46', 18),
(18, 'GuaranÃ¡ Lata', 2, 5, '2018-08-20 18:41:32', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `acess_level` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `acess_level`) VALUES
(1, 'longattigabriel@gmail.com', '12345', '1'),
(5, 'admin@rems.com.br', '123', '2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
