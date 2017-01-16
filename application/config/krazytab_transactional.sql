SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `tbl_constaraint_transaction_mode` (
  `transaction_mode_pk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_constraint_menu_classification` (
  `classification_type_pk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_customer` (
  `customer_id_pk_fk` varchar(75) NOT NULL,
  `alternate_email_id` varchar(50) DEFAULT NULL,
  `email_verification_date` date DEFAULT NULL,
  `mobile_verification_date` date DEFAULT NULL,
  `creation_date` date NOT NULL,
  `last_login_date` date NOT NULL,
  `last_order_date` date DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `alternate_email_verification_date` date DEFAULT NULL,
  `total_purchase` mediumint(9) NOT NULL DEFAULT '0',
  `favourite_cuisine` varchar(50) DEFAULT NULL,
  `sex` enum('M','F','O') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `last_synched` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_display_restaurant_menu_cuisine` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `cuisine_pk2` varchar(20) NOT NULL,
  `sequence_pk3` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_display_restaurant_menu_item` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `menu_item_pk2_fk2` varchar(30) NOT NULL,
  `sequence_pk3` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_display_restaurant_menu_sub_category_1` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `sub_category_pk2` varchar(30) NOT NULL,
  `sequence_pk3` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_display_restaurant_menu_sub_category_2` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `subcategory_2_pk2` varchar(30) NOT NULL,
  `sequence_pk3` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_item_rating` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `order_id_pk_fk` varchar(50) NOT NULL,
  `customer_id_pk_fk` varchar(75) NOT NULL,
  `order_item_pk_fk` varchar(50) NOT NULL,
  `transation_time` datetime NOT NULL,
  `rating_given` enum('0','1','2','3','4','5') DEFAULT NULL,
  `comments_given` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_menu_classification` (
  `menu_item_pk_fk` varchar(50) NOT NULL,
  `classification_type_fk` varchar(30) NOT NULL,
  `classification_value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='this table is used to store minute classification detail of the item';

CREATE TABLE IF NOT EXISTS `tbl_detail_menu_item` (
  `menu_item_pk_fk` varchar(50) NOT NULL,
  `total_selling_price` bigint(20) NOT NULL DEFAULT '0',
  `total_serving_restaurant` int(11) NOT NULL DEFAULT '0',
  `last_synched` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_newsletter` (
  `customer_id_pk1_fk` varchar(75) NOT NULL,
  `subscription_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table to store subscription of newsletter';

CREATE TABLE IF NOT EXISTS `tbl_detail_order` (
  `order_id_pk1_fk` varchar(50) NOT NULL,
  `item_pk2_fk` varchar(50) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `raw_cost` int(11) NOT NULL,
  `plate_size` enum('small','medium','large') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_detail_order` (`order_id_pk1_fk`, `item_pk2_fk`, `quantity`, `raw_cost`, `plate_size`) VALUES
('ABC1234', 'ChickenTikka', 1, 12, 'large'),
('ABC1234', 'DahiKebab', 13, 130, 'medium');

CREATE TABLE IF NOT EXISTS `tbl_detail_order_delivery` (
  `order_id_pk1_fk` varchar(50) NOT NULL,
  `restaurant_id_pk2_fk` varchar(75) NOT NULL,
  `order_status` enum('NEW','PROCESSING','COMPLETE') DEFAULT NULL,
  `restaurant_intimation_time` datetime DEFAULT NULL,
  `restaurant_delivery_time` datetime DEFAULT NULL,
  `customer_delivery_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_order_invoice` (
  `invoice_no_pk` varchar(50) NOT NULL,
  `customer_id_fk` varchar(75) NOT NULL,
  `order_id_fk` varchar(50) NOT NULL,
  `total_raw_cost` decimal(7,2) NOT NULL DEFAULT '0.00',
  `total_discount` decimal(7,2) NOT NULL DEFAULT '0.00',
  `total_tax` decimal(7,2) NOT NULL DEFAULT '0.00',
  `billed_amount` decimal(7,2) NOT NULL,
  `invoice_date` datetime NOT NULL,
  `invoice_detail` varchar(2000) NOT NULL,
  `cash_back_amount` int(11) NOT NULL,
  `cash_back_code_fk` varchar(50) DEFAULT NULL,
  `invoice_status` enum('INIT','PROCESSING','PARTIAL DONE','FAIL','EMAILED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_detail_order_invoice` (`invoice_no_pk`, `customer_id_fk`, `order_id_fk`, `total_raw_cost`, `total_discount`, `total_tax`, `billed_amount`, `invoice_date`, `invoice_detail`, `cash_back_amount`, `cash_back_code_fk`, `invoice_status`) VALUES
('INV123321', '1234567', 'ORD123321', 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '', 0, NULL, ''),
('INV1234', '1234567', 'ABC1234', 120.00, 10.00, 13.00, 123.00, '2016-06-22 06:19:00', 'adcbcakhbcakbcakbckacbkadvckakadcb', 0, NULL, 'PROCESSING');

CREATE TABLE IF NOT EXISTS `tbl_detail_order_tax` (
  `invoice_no_pk1_fk` varchar(50) NOT NULL,
  `tax_name_pk2_fk` varchar(30) NOT NULL,
  `tax_amount` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_detail_order_tax` (`invoice_no_pk1_fk`, `tax_name_pk2_fk`, `tax_amount`) VALUES
('INV1234', 'cess', 120.00),
('INV1234', 'sbcess', 0.00),
('INV1234', 'serviceTax', 100.00);

CREATE TABLE IF NOT EXISTS `tbl_detail_otp` (
  `mobile_number` decimal(13,0) NOT NULL,
  `otp` int(8) NOT NULL,
  `generation_time` datetime NOT NULL,
  `status` enum('USED','UNUSED') NOT NULL DEFAULT 'UNUSED',
  `email_id` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_pricing_quote` (
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email_id` varchar(50) NOT NULL,
  `mobile_no` decimal(13,0) NOT NULL,
  `address` varchar(75) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip_code` int(8) NOT NULL,
  `website_name` varchar(50) DEFAULT NULL,
  `billing_system_exist` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `queries` varchar(250) DEFAULT NULL,
  `transaction_time` datetime NOT NULL,
  `communicated` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `Unique_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_detail_pricing_quote` (`first_name`, `last_name`, `email_id`, `mobile_no`, `address`, `city`, `state`, `zip_code`, `website_name`, `billing_system_exist`, `queries`, `transaction_time`, `communicated`, `Unique_id`) VALUES
('a', '', 'a@a.com', 1, '1', '1', ' ', 1, '', 'NO', '', '2016-05-08 01:45:33', 'NO', '1572efcadaf05b193911232'),
('a', '', 'a@a.com', 1, '1', '1', ' ', 1, '', 'NO', '', '2016-05-08 01:45:36', 'NO', '1572efcb057aed252962334'),
('Vipul Singh', 'Singh', 'vipul26singh@yahoo.com', 9717077728, 'fgngn', 'dgbdgbd', ' ', 12345, '', 'NO', '', '2016-05-08 00:24:49', 'NO', '9717077728572ee9c133aa7861400247'),
('Vipul', 'Singh', 'vipul26singh@yahoo.com', 9717077728, 'D-710 New Para Colony', 'Lucknow', 'Uttar Pradesh (UP)', 226017, 'krazytable.in', 'NO', 'This is just for testing', '2016-05-08 00:57:05', 'NO', '9717077728572ef151224d8345692902'),
('KrazyTable', 'Singh', 'team@krazytable.in', 9717077728, 'New para colony', 'lucknow', 'Uttar Pradesh (UP)', 226017, '', 'NO', '', '2016-05-15 03:20:03', 'NO', '971707772857384d53c3631670115819'),
('abc', 'xyz', 'vikas.singh1188@gmail.com', 9971700854, 'A-105', 'Sahibabad', 'Uttar Pradesh (UP)', 123456, 'krazytable.in', 'NO', 'I want a system that can manage 25 table autonomously. From order to billing.\r\nThanks,', '2016-05-08 01:09:19', 'NO', '9971700854572ef42fcdaa2246312081');

CREATE TABLE IF NOT EXISTS `tbl_detail_restaurant_holiday` (
  `restaurant_id_fk` varchar(75) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_restaurant_item_side` (
  `restaurant_id_pk1_fk` varchar(75) NOT NULL,
  `menu_item_pk2_fk` varchar(50) NOT NULL,
  `side_name` varchar(20) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `price` tinyint(4) DEFAULT NULL,
  `quantity` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='It stores the detail of sides served with item of restaurant';

CREATE TABLE IF NOT EXISTS `tbl_detail_restaurant_menu_item` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `menu_item_pk_fk` varchar(50) NOT NULL,
  `total_sale_price` bigint(20) NOT NULL,
  `total_order_placed` bigint(20) NOT NULL,
  `last_synched` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_restaurant_rating` (
  `restaurant_id_pk1_fk` varchar(75) NOT NULL,
  `order_id_pk2_fk` varchar(50) NOT NULL,
  `customer_id_fk` varchar(75) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `rating_given` enum('0','1','2','3','4','5') DEFAULT NULL,
  `comments_given` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_restaurant_server` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `ip_address` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_password_modification_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_restaurant_table` (
  `restaurant_id_fk` varchar(75) NOT NULL,
  `table_no` smallint(6) NOT NULL,
  `tablet_mac` varchar(64) DEFAULT NULL,
  `booking_allowed` enum('YES','NO') NOT NULL DEFAULT 'NO' COMMENT 'YES if specified table to be considered for booking purpose'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store detail of mac and table of restaurant';

CREATE TABLE IF NOT EXISTS `tbl_detail_session` (
  `session_id` varchar(100) NOT NULL,
  `login_id` varchar(35) DEFAULT NULL,
  `ip_address` varchar(35) DEFAULT NULL,
  `browser` varchar(25) DEFAULT NULL,
  `login_time` datetime NOT NULL,
  `mobile_number` decimal(13,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_detail_transaction` (
  `transactin_id_pk` varchar(100) NOT NULL,
  `invoice_no_fk` varchar(50) NOT NULL,
  `transaction_type_code_fk` varchar(75) NOT NULL,
  `date` datetime NOT NULL,
  `customer_id_fk` varchar(75) NOT NULL,
  `customer_account_no` varchar(50) DEFAULT NULL COMMENT 'Null in case of cash mode'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_hist_customer_mobile` (
  `mobile_number_pk` decimal(13,0) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='To handle fraud by changing mobile number again and again';

CREATE TABLE IF NOT EXISTS `tbl_map_customer_address` (
  `customer_id_pk_fk` varchar(75) NOT NULL,
  `address_id_pk_fk` varchar(75) NOT NULL,
  `address_nick_name` varchar(20) NOT NULL COMMENT 'To be displayed on GUI'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='map  address with customer';

CREATE TABLE IF NOT EXISTS `tbl_map_employee_address` (
  `employee_id_fk` varchar(75) NOT NULL,
  `address_id_fk` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_map_employee_role` (
  `employee_id_pk1_fk` varchar(75) NOT NULL,
  `role_id_pk2_fk` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_map_permission_roles` (
  `role_id_pk1_fk` varchar(75) NOT NULL,
  `permission_id_pk2_fk` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_map_restaurant_discount` (
  `restaurant_id_pk1_fk` varchar(75) NOT NULL,
  `discount_id_pk2_fk` varchar(75) NOT NULL,
  `sequence_number` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_map_tax_restaurant` (
  `restaurant_id_pk1_fk` varchar(75) NOT NULL,
  `tax_id_pk2_fk` varchar(75) NOT NULL,
  `sequence_number` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_map_transaction_mode_cash_back` (
  `transaction_type_code_pk2_fk` varchar(75) NOT NULL,
  `cash_back_code_pk1_fk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_mast_address` (
  `address_id_pk` varchar(75) NOT NULL,
  `address_line_1` varchar(100) NOT NULL,
  `address_line_2` varchar(100) DEFAULT NULL,
  `address_line_3` varchar(100) DEFAULT NULL,
  `landmark` varchar(30) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='master detail for addressp[';

CREATE TABLE IF NOT EXISTS `tbl_mast_cash_back` (
  `cash_back_code_pk` varchar(50) NOT NULL,
  `amount` decimal(6,2) NOT NULL,
  `type` enum('Percent','Fixed') NOT NULL DEFAULT 'Fixed',
  `description` varchar(100) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `minimum_purchase_amount` decimal(6,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='It store master detail of the cash back';

CREATE TABLE IF NOT EXISTS `tbl_mast_customer` (
  `first_name` varchar(15) NOT NULL,
  `middle_name` varchar(15) DEFAULT NULL,
  `surname` varchar(15) DEFAULT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `mobile_number_uk` decimal(13,0) NOT NULL,
  `customer_id_pk` varchar(75) NOT NULL,
  `last_password_modification_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Login details and master data of customer';

INSERT INTO `tbl_mast_customer` (`first_name`, `middle_name`, `surname`, `user_name`, `password`, `email_id`, `mobile_number_uk`, `customer_id_pk`, `last_password_modification_date`) VALUES
('Vipul', NULL, 'Singh', 'vipul_singh', 'vipul', 'vipul.singh@krazytable.in', 9717077728, '1234567', NULL);

CREATE TABLE IF NOT EXISTS `tbl_mast_discount` (
  `discount_id_pk` varchar(75) NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `amount` mediumint(9) NOT NULL,
  `type` enum('Percent','Fixed') NOT NULL DEFAULT 'Percent',
  `description` varchar(100) NOT NULL,
  `minimum_purchase_amount` decimal(6,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_mast_employee` (
  `employee_id_pk` varchar(75) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `midddle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile_number` decimal(13,0) NOT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `designation` varchar(20) NOT NULL,
  `creation_date` datetime NOT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `restaurant_id_fk` varchar(75) NOT NULL,
  `last_password_change_time` datetime DEFAULT NULL,
  `creation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_mast_menu_item` (
  `menu_item_pk` varchar(50) NOT NULL,
  `cuisine` varchar(20) NOT NULL,
  `veg_status` enum('VEG','NON-VEG') NOT NULL DEFAULT 'NON-VEG',
  `sub_category` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_mast_menu_item` (`menu_item_pk`, `cuisine`, `veg_status`, `sub_category`) VALUES
('chicken', 'indian', 'NON-VEG', 'soup'),
('ChickenTandoori', 'indian', 'NON-VEG', 'starter'),
('ChickenTikka', '', 'NON-VEG', 'maincourse'),
('DahiKebab', 'indian', 'VEG', 'starter'),
('lentil', 'indian', 'VEG', 'soup'),
('PaneerTikka', 'indian', 'VEG', 'maincourse'),
('pasta12132', '', 'VEG', 'salad'),
('tomato', 'indian', 'VEG', 'soup'),
('VegSalad', '', 'VEG', 'salad');

CREATE TABLE IF NOT EXISTS `tbl_mast_objects` (
  `object_id_pk` varchar(75) NOT NULL,
  `object_name` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_mast_operations` (
  `operation_id_pk` varchar(75) NOT NULL,
  `operation_name` varchar(30) NOT NULL,
  `can_create` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `can_read` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `can_update` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `can_delete` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_mast_order` (
  `order_id_pk` varchar(50) NOT NULL,
  `customer_id_fk` varchar(75) NOT NULL,
  `order_status` enum('NEW','PROCESSING','COMPLETE') DEFAULT NULL,
  `order_type` enum('Table Booking','Table Pooling','Table Order','Home Delivery','Food Pooling') DEFAULT NULL,
  `booking_time` datetime NOT NULL,
  `requirement_time` datetime DEFAULT NULL,
  `delivery_time` datetime DEFAULT NULL,
  `table_no_fk` smallint(6) DEFAULT NULL,
  `restaurant_id_fk` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_mast_order` (`order_id_pk`, `customer_id_fk`, `order_status`, `order_type`, `booking_time`, `requirement_time`, `delivery_time`, `table_no_fk`, `restaurant_id_fk`) VALUES
('ABC1234', '1234567', 'NEW', 'Table Booking', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'Restkrazytableu67hte'),
('ORD123321', '1234567', 'COMPLETE', 'Table Booking', '2016-06-21 00:00:00', NULL, NULL, NULL, 'Restkrazytableu67hte');

CREATE TABLE IF NOT EXISTS `tbl_mast_permissions` (
  `permission_id_pk` varchar(75) NOT NULL,
  `object_id_fk` varchar(75) NOT NULL,
  `operation_id_fk` varchar(75) NOT NULL,
  `permission_name` varchar(30) NOT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_mast_restaurant` (
  `chain_restaurant_id_fk` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `opening_time` time DEFAULT NULL,
  `closing_time` time DEFAULT NULL,
  `latitude` decimal(6,6) DEFAULT NULL,
  `longitude` decimal(6,6) DEFAULT NULL,
  `tie_up_date` datetime NOT NULL,
  `home_delivery_option` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `type` enum('INDIVIDUAL','CHAIN','HEADQUARTER') DEFAULT NULL,
  `address_line_1` varchar(50) NOT NULL,
  `address_line_2` varchar(50) NOT NULL,
  `address_line_3` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) NOT NULL,
  `registered_mobile_number` decimal(13,0) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `restaurant_email_id` varchar(75) NOT NULL,
  `restaurant_unique_id_pk` varchar(75) NOT NULL,
  `pin_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='It sore master detail of restaurant';

INSERT INTO `tbl_mast_restaurant` (`chain_restaurant_id_fk`, `name`, `opening_time`, `closing_time`, `latitude`, `longitude`, `tie_up_date`, `home_delivery_option`, `type`, `address_line_1`, `address_line_2`, `address_line_3`, `city`, `state`, `country`, `registered_mobile_number`, `username`, `password`, `restaurant_email_id`, `restaurant_unique_id_pk`, `pin_code`) VALUES
(NULL, 'krazytable', NULL, NULL, NULL, NULL, '2016-05-04 00:00:00', 'NO', 'INDIVIDUAL', '', '', '', '', '', '', 9717077728, 'vipul', 'Vipul@123', '', 'Restkrazytableu67hte', NULL);

CREATE TABLE IF NOT EXISTS `tbl_mast_restaurant_menu_item` (
  `restaurant_id_pk1_fk` varchar(75) NOT NULL,
  `menu_item_pk2_fk` varchar(50) NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `full_plate_price` mediumint(9) NOT NULL,
  `half_plate_price` mediumint(9) DEFAULT NULL,
  `cuisine` varchar(20) DEFAULT NULL,
  `sub_category_1` varchar(30) DEFAULT NULL,
  `sub_category_2` varchar(30) DEFAULT NULL,
  `veg_status` enum('VEG','NON-VEG') NOT NULL DEFAULT 'NON-VEG',
  `display_content` varchar(500) DEFAULT NULL,
  `availability` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `preparation_time` tinyint(4) NOT NULL COMMENT 'preparation time in minutes',
  `small_plate_price` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`, `menu_item_pk2_fk`, `display_name`, `full_plate_price`, `half_plate_price`, `cuisine`, `sub_category_1`, `sub_category_2`, `veg_status`, `display_content`, `availability`, `preparation_time`, `small_plate_price`) VALUES
('Restkrazytableu67hte', 'chicken', 'chicken Soup', 140, 80, NULL, 'soup', NULL, 'NON-VEG', 'Strain the broth. Pick the meat off of the bones and chop the carrots, celery and onion. Season the broth with salt, pepper and chicken bouillon to taste, if desired. Return the chicken, carrots, cele', 'YES', 15, NULL),
('Restkrazytableu67hte', 'ChickenTandoori', 'Chicken Tandoori', 170, NULL, NULL, 'starter', NULL, 'NON-VEG', 'A popular Indian dish consisting of chicken marinated in a mixture of yogurt and spices traditionally cooked in high temperatures in a tandoor (clay oven) and also can be prepared on a traditional barbecue grill', 'YES', 20, NULL),
('Restkrazytableu67hte', 'ChickenTikka', 'Nawabi Chicken Tikka', 220, 130, 'indian', 'maincourse', NULL, 'NON-VEG', 'hunks of chicken marinated in spices and yogurt, that is then baked in a tandoor oven, and served in a masala (spice mix) sauce.', 'YES', 25, NULL),
('Restkrazytableu67hte', 'DahiKebab', 'Dahi K kebab', 140, NULL, NULL, 'starter', NULL, 'VEG', 'Dahi kabab is a special recipe belonging to awadh. Savoring taste of hung curd having light spices and served with green coriander or mint chutney', 'YES', 13, NULL),
('Restkrazytableu67hte', 'lentil', 'Lentil Soup', 95, 50, NULL, 'soup', NULL, 'VEG', 'Lentils are coupled with vegetables for this family-friendly lentil soup. Topped with spinach and a splash of vinegar, this is the perfect weekday dinner soup.', 'YES', 5, NULL),
('Restkrazytableu67hte', 'PaneerTikka', 'Panner Tikka Masala', 180, 100, NULL, 'maincourse', NULL, 'VEG', 'The burnt taste of paneer marinated in curd and spices gives it a delighting flavor. It is a paneer tikka prepared with delicious spicy gravy.', 'YES', 18, 70),
('Restkrazytableu67hte', 'pasta12132', 'Pasta Salad', 120, NULL, NULL, 'salad', NULL, 'VEG', 'Italian Confetti Pasta Salad. Tomatoes and basil, fresh from the garden, are tossed with olives, bell peppers, rotini pasta, then dressed with a creamy, piquant blend of mayonnaise, red wine vinegar a', 'YES', 15, NULL),
('Restkrazytableu67hte', 'tomato', 'Creamy Tomato Soup', 70, 40, NULL, 'soup', NULL, 'NON-VEG', 'A creamy soup delight, the Cream of tomato soup is an all time favorite hot soup recipe with the rich taste of fresh plum tomatoes and a dash of cream added as topping.', 'YES', 4, NULL),
('Restkrazytableu67hte', 'VegSalad', 'Vegetable Salad', 80, NULL, NULL, 'salad', NULL, 'VEG', 'This refreshing salad uses a variety of fresh vegetables tossed a pomegranate and herb dressing.', 'YES', 8, NULL);

CREATE TABLE IF NOT EXISTS `tbl_mast_roles` (
  `role_id_pk` varchar(75) NOT NULL,
  `role_name` varchar(30) NOT NULL,
  `role_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_mast_tax` (
  `display_name` varchar(30) NOT NULL,
  `amount` mediumint(9) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` enum('Percent','Fixed') NOT NULL DEFAULT 'Percent',
  `tax_id_pk` varchar(75) NOT NULL DEFAULT '100000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_mast_tax` (`display_name`, `amount`, `description`, `type`, `tax_id_pk`) VALUES
('cess', 3, 'cess', 'Percent', 'TXID12'),
('serviceTax', 12, 'serviceTax', 'Percent', 'TXID1234'),
('sbcess', 13, 'sbcess', 'Fixed', 'TXID20');

CREATE TABLE IF NOT EXISTS `tbl_mast_transaction_mode` (
  `transaction_type_code_pk` varchar(75) NOT NULL,
  `mode_fk` varchar(20) NOT NULL COMMENT 'It include payment method like Debit card, wallets, ',
  `gateway` varchar(30) NOT NULL COMMENT 'SBI, PAYTM etc'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tbl_summary_item_rating` (
  `menu_item_pk1_fk` varchar(50) NOT NULL,
  `restaurant_id_pk2_fk` varchar(75) NOT NULL,
  `average_rating` float(4,2) NOT NULL,
  `total_rater` int(11) NOT NULL,
  `rated_1` int(11) NOT NULL,
  `rated_2` int(11) NOT NULL,
  `rated_3` int(11) NOT NULL,
  `rated_4` int(11) NOT NULL,
  `rated_5` int(11) NOT NULL,
  `last_synched` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_summary_item_rating` (`menu_item_pk1_fk`, `restaurant_id_pk2_fk`, `average_rating`, `total_rater`, `rated_1`, `rated_2`, `rated_3`, `rated_4`, `rated_5`, `last_synched`) VALUES
('chicken', 'Restkrazytableu67hte', 3.50, 0, 4, 2, 15, 7, 2, NULL),
('ChickenTandoori', 'Restkrazytableu67hte', 0.00, 0, 0, 0, 0, 0, 0, NULL),
('ChickenTikka', 'Restkrazytableu67hte', 4.70, 0, 0, 0, 0, 0, 0, NULL),
('DahiKebab', 'Restkrazytableu67hte', 2.70, 0, 0, 0, 0, 0, 0, NULL),
('lentil', 'Restkrazytableu67hte', 4.20, 1, 1, 11, 1, 111, 1, NULL),
('PaneerTikka', 'Restkrazytableu67hte', 4.20, 0, 0, 0, 0, 0, 0, NULL),
('pasta12132', 'Restkrazytableu67hte', 4.20, 1, 0, 0, 0, 0, 0, NULL),
('tomato', 'Restkrazytableu67hte', 4.00, 14, 1, 11, 11, 1, 1, NULL),
('VegSalad', 'Restkrazytableu67hte', 3.80, 0, 0, 0, 0, 0, 0, NULL);

CREATE TABLE IF NOT EXISTS `tbl_summary_restaurant_rating` (
  `restaurant_id_pk_fk` varchar(75) NOT NULL,
  `average_rating` decimal(2,2) NOT NULL,
  `total_rater` int(11) NOT NULL,
  `rated_1` int(11) NOT NULL,
  `rated_2` int(11) NOT NULL,
  `rated_3` int(11) NOT NULL,
  `rated_4` int(11) NOT NULL,
  `rated_5` int(11) NOT NULL,
  `last_synched` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `tbl_constaraint_transaction_mode`
  ADD PRIMARY KEY (`transaction_mode_pk`);

ALTER TABLE `tbl_constraint_menu_classification`
  ADD PRIMARY KEY (`classification_type_pk`);

ALTER TABLE `tbl_detail_customer`
  ADD PRIMARY KEY (`customer_id_pk_fk`),
  ADD KEY `alternate_email_id` (`alternate_email_id`),
  ADD KEY `creation_date` (`creation_date`),
  ADD KEY `last_order_date` (`last_order_date`),
  ADD KEY `date_of_birth` (`date_of_birth`),
  ADD KEY `last_synched` (`last_synched`);

ALTER TABLE `tbl_detail_display_restaurant_menu_cuisine`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`,`cuisine_pk2`,`sequence_pk3`),
  ADD KEY `tbl_detail_display_restaurant_menu_cuisine_ibfk_2` (`cuisine_pk2`);

ALTER TABLE `tbl_detail_display_restaurant_menu_item`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`,`menu_item_pk2_fk2`,`sequence_pk3`);

ALTER TABLE `tbl_detail_display_restaurant_menu_sub_category_1`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`,`sub_category_pk2`,`sequence_pk3`);

ALTER TABLE `tbl_detail_display_restaurant_menu_sub_category_2`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`,`subcategory_2_pk2`,`sequence_pk3`);

ALTER TABLE `tbl_detail_item_rating`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`,`order_id_pk_fk`,`customer_id_pk_fk`,`order_item_pk_fk`),
  ADD KEY `transation_time` (`transation_time`),
  ADD KEY `order_id_pk_fk` (`order_id_pk_fk`),
  ADD KEY `customer_id_pk_fk` (`customer_id_pk_fk`),
  ADD KEY `order_item_pk_fk` (`order_item_pk_fk`);

ALTER TABLE `tbl_detail_menu_classification`
  ADD PRIMARY KEY (`menu_item_pk_fk`,`classification_type_fk`,`classification_value`),
  ADD KEY `classification_type` (`classification_type_fk`);

ALTER TABLE `tbl_detail_menu_item`
  ADD PRIMARY KEY (`menu_item_pk_fk`),
  ADD KEY `last_synched` (`last_synched`);

ALTER TABLE `tbl_detail_newsletter`
  ADD PRIMARY KEY (`customer_id_pk1_fk`,`subscription_date`);

ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`order_id_pk1_fk`,`item_pk2_fk`,`plate_size`),
  ADD KEY `item_pk2_fk` (`item_pk2_fk`);

ALTER TABLE `tbl_detail_order_delivery`
  ADD PRIMARY KEY (`order_id_pk1_fk`,`restaurant_id_pk2_fk`),
  ADD KEY `restaurant_intimation_time` (`restaurant_intimation_time`),
  ADD KEY `restaurant_delivery_time` (`restaurant_delivery_time`),
  ADD KEY `customer_delivery_time` (`customer_delivery_time`),
  ADD KEY `tbl_detail_order_delivery_ibfk_2` (`restaurant_id_pk2_fk`);

ALTER TABLE `tbl_detail_order_invoice`
  ADD PRIMARY KEY (`invoice_no_pk`),
  ADD UNIQUE KEY `order_id_fk` (`order_id_fk`),
  ADD UNIQUE KEY `invoice_no_pk` (`invoice_no_pk`),
  ADD KEY `customer_mobile_no_fk` (`customer_id_fk`),
  ADD KEY `generation_time` (`invoice_date`),
  ADD KEY `cash_back_code_fk` (`cash_back_code_fk`);

ALTER TABLE `tbl_detail_order_tax`
  ADD PRIMARY KEY (`invoice_no_pk1_fk`,`tax_name_pk2_fk`),
  ADD KEY `tbl_detail_order_tax_ibfk_2` (`tax_name_pk2_fk`);

ALTER TABLE `tbl_detail_otp`
  ADD KEY `mobile_number` (`mobile_number`),
  ADD KEY `generation_time` (`generation_time`),
  ADD KEY `email_id` (`email_id`),
  ADD KEY `otp` (`otp`),
  ADD KEY `otp_2` (`otp`);

ALTER TABLE `tbl_detail_pricing_quote`
  ADD PRIMARY KEY (`Unique_id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `email_id` (`email_id`),
  ADD KEY `mobile_no` (`mobile_no`),
  ADD KEY `transaction_time` (`transaction_time`);

ALTER TABLE `tbl_detail_restaurant_holiday`
  ADD UNIQUE KEY `restaurant_id_pk_fk_2` (`restaurant_id_fk`,`date`),
  ADD KEY `date` (`date`);

ALTER TABLE `tbl_detail_restaurant_item_side`
  ADD PRIMARY KEY (`menu_item_pk2_fk`,`restaurant_id_pk1_fk`,`side_name`),
  ADD KEY `restaunrat_id_pk1_fk_fk_idx` (`restaurant_id_pk1_fk`),
  ADD KEY `restaunrat_id_pk1_fk_fk` (`restaurant_id_pk1_fk`,`menu_item_pk2_fk`);

ALTER TABLE `tbl_detail_restaurant_menu_item`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`,`menu_item_pk_fk`),
  ADD KEY `menu_item_pk_fk` (`menu_item_pk_fk`),
  ADD KEY `last_synched` (`last_synched`);

ALTER TABLE `tbl_detail_restaurant_rating`
  ADD PRIMARY KEY (`restaurant_id_pk1_fk`,`order_id_pk2_fk`),
  ADD KEY `customer_id_fk` (`customer_id_fk`),
  ADD KEY `transaction_time` (`transaction_time`),
  ADD KEY `order_id_pk2_fk` (`order_id_pk2_fk`);

ALTER TABLE `tbl_detail_restaurant_server`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`),
  ADD UNIQUE KEY `ip_address` (`ip_address`),
  ADD KEY `password_modification_date` (`last_password_modification_date`),
  ADD KEY `last_login_date` (`last_login_date`);

ALTER TABLE `tbl_detail_restaurant_table`
  ADD UNIQUE KEY `restaurant_id` (`table_no`,`restaurant_id_fk`),
  ADD UNIQUE KEY `tablet_mac` (`tablet_mac`),
  ADD KEY `restaurant_id_fk` (`restaurant_id_fk`);

ALTER TABLE `tbl_detail_session`
  ADD KEY `session_id` (`session_id`),
  ADD KEY `login_time` (`login_time`),
  ADD KEY `mobile_number` (`mobile_number`);

ALTER TABLE `tbl_detail_transaction`
  ADD PRIMARY KEY (`transactin_id_pk`),
  ADD KEY `customer_id_fk` (`customer_id_fk`),
  ADD KEY `date` (`date`),
  ADD KEY `transaction_type_code_fk` (`transaction_type_code_fk`),
  ADD KEY `invoice_no_fk` (`invoice_no_fk`);

ALTER TABLE `tbl_hist_customer_mobile`
  ADD PRIMARY KEY (`mobile_number_pk`),
  ADD KEY `transaction_date` (`transaction_date`);

ALTER TABLE `tbl_map_customer_address`
  ADD PRIMARY KEY (`customer_id_pk_fk`,`address_id_pk_fk`),
  ADD KEY `address_id_pk_fk` (`address_id_pk_fk`);

ALTER TABLE `tbl_map_employee_address`
  ADD PRIMARY KEY (`employee_id_fk`,`address_id_fk`),
  ADD KEY `address_id_fk` (`address_id_fk`);

ALTER TABLE `tbl_map_employee_role`
  ADD PRIMARY KEY (`employee_id_pk1_fk`,`role_id_pk2_fk`),
  ADD KEY `role_id_pk2_fk` (`role_id_pk2_fk`);

ALTER TABLE `tbl_map_permission_roles`
  ADD PRIMARY KEY (`role_id_pk1_fk`,`permission_id_pk2_fk`),
  ADD KEY `permission_id_pk2_fk` (`permission_id_pk2_fk`);

ALTER TABLE `tbl_map_restaurant_discount`
  ADD PRIMARY KEY (`restaurant_id_pk1_fk`,`discount_id_pk2_fk`),
  ADD UNIQUE KEY `restaurant_id_pk1_fk` (`restaurant_id_pk1_fk`,`sequence_number`),
  ADD KEY `discount_id_pk2_fk` (`discount_id_pk2_fk`);

ALTER TABLE `tbl_map_tax_restaurant`
  ADD PRIMARY KEY (`restaurant_id_pk1_fk`,`tax_id_pk2_fk`),
  ADD UNIQUE KEY `restaurant_id_pk1_fk` (`restaurant_id_pk1_fk`,`sequence_number`),
  ADD KEY `tax_id_pk2_fk` (`tax_id_pk2_fk`);

ALTER TABLE `tbl_map_transaction_mode_cash_back`
  ADD PRIMARY KEY (`transaction_type_code_pk2_fk`,`cash_back_code_pk1_fk`),
  ADD KEY `cash_back_code_pk1_fk` (`cash_back_code_pk1_fk`);

ALTER TABLE `tbl_mast_address`
  ADD PRIMARY KEY (`address_id_pk`),
  ADD UNIQUE KEY `uindx_address` (`city`,`state`,`country`,`address_line_1`,`address_line_2`,`address_line_3`,`landmark`);

ALTER TABLE `tbl_mast_cash_back`
  ADD PRIMARY KEY (`cash_back_code_pk`),
  ADD KEY `minimum_purchase_amount` (`minimum_purchase_amount`);

ALTER TABLE `tbl_mast_customer`
  ADD PRIMARY KEY (`customer_id_pk`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number_uk`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

ALTER TABLE `tbl_mast_discount`
  ADD PRIMARY KEY (`discount_id_pk`),
  ADD UNIQUE KEY `display_name` (`display_name`,`amount`),
  ADD KEY `minimum_purchase_amount` (`minimum_purchase_amount`);

ALTER TABLE `tbl_mast_employee`
  ADD PRIMARY KEY (`employee_id_pk`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email_id` (`email_id`),
  ADD KEY `designation` (`designation`),
  ADD KEY `restaurant_id_fk` (`restaurant_id_fk`),
  ADD KEY `mobile_number` (`mobile_number`),
  ADD KEY `last_password_change_time` (`last_password_change_time`);

ALTER TABLE `tbl_mast_menu_item`
  ADD PRIMARY KEY (`menu_item_pk`);

ALTER TABLE `tbl_mast_objects`
  ADD PRIMARY KEY (`object_id_pk`),
  ADD UNIQUE KEY `object_name` (`object_name`);

ALTER TABLE `tbl_mast_operations`
  ADD PRIMARY KEY (`operation_id_pk`),
  ADD UNIQUE KEY `operation_name` (`operation_name`);

ALTER TABLE `tbl_mast_order`
  ADD PRIMARY KEY (`order_id_pk`),
  ADD UNIQUE KEY `customer_id_fk` (`customer_id_fk`,`booking_time`),
  ADD UNIQUE KEY `customer_id_fk_2` (`customer_id_fk`,`booking_time`),
  ADD KEY `customer_mobile_number_fk` (`customer_id_fk`),
  ADD KEY `booking_time` (`booking_time`),
  ADD KEY `requirement_time` (`requirement_time`),
  ADD KEY `delivery_time` (`delivery_time`),
  ADD KEY `table_no_fk` (`table_no_fk`),
  ADD KEY `restaurant_id_fk` (`restaurant_id_fk`);

ALTER TABLE `tbl_mast_permissions`
  ADD PRIMARY KEY (`permission_id_pk`),
  ADD KEY `object_id_fk` (`object_id_fk`),
  ADD KEY `operation_id_fk` (`operation_id_fk`);

ALTER TABLE `tbl_mast_restaurant`
  ADD PRIMARY KEY (`restaurant_unique_id_pk`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `restaurant_email_id` (`restaurant_email_id`),
  ADD KEY `indx_lat_long` (`latitude`,`longitude`),
  ADD KEY `tie_up_date` (`tie_up_date`),
  ADD KEY `uindx_name_lat_long` (`name`,`latitude`,`longitude`),
  ADD KEY `indx_chain_id` (`chain_restaurant_id_fk`),
  ADD KEY `registered_mobile_number` (`registered_mobile_number`);

ALTER TABLE `tbl_mast_restaurant_menu_item`
  ADD PRIMARY KEY (`restaurant_id_pk1_fk`,`menu_item_pk2_fk`),
  ADD KEY `full_plate_price` (`full_plate_price`),
  ADD KEY `cuisine` (`cuisine`),
  ADD KEY `sub_category_1` (`sub_category_1`),
  ADD KEY `sub_category_2` (`sub_category_2`),
  ADD KEY `veg_status` (`veg_status`),
  ADD KEY `tbl_mast_restaurant_menu_item_ibfk_2` (`menu_item_pk2_fk`);

ALTER TABLE `tbl_mast_roles`
  ADD PRIMARY KEY (`role_id_pk`),
  ADD UNIQUE KEY `role_name` (`role_name`);

ALTER TABLE `tbl_mast_tax`
  ADD PRIMARY KEY (`tax_id_pk`),
  ADD UNIQUE KEY `display_name` (`display_name`,`amount`);

ALTER TABLE `tbl_mast_transaction_mode`
  ADD PRIMARY KEY (`transaction_type_code_pk`),
  ADD UNIQUE KEY `mode_fk` (`mode_fk`,`gateway`);

ALTER TABLE `tbl_summary_item_rating`
  ADD PRIMARY KEY (`menu_item_pk1_fk`,`restaurant_id_pk2_fk`),
  ADD KEY `last_modified_date` (`last_synched`),
  ADD KEY `average_rating` (`average_rating`),
  ADD KEY `total_raters` (`total_rater`),
  ADD KEY `total_raters_2` (`total_rater`),
  ADD KEY `fk_menu_rating_restaurant_constraint` (`restaurant_id_pk2_fk`,`menu_item_pk1_fk`);

ALTER TABLE `tbl_summary_restaurant_rating`
  ADD PRIMARY KEY (`restaurant_id_pk_fk`),
  ADD KEY `average_rating` (`average_rating`),
  ADD KEY `total_rater` (`total_rater`),
  ADD KEY `last_modified_time` (`last_synched`);


ALTER TABLE `tbl_detail_customer`
  ADD CONSTRAINT `tbl_detail_customer_ibfk_1` FOREIGN KEY (`customer_id_pk_fk`) REFERENCES `tbl_mast_customer` (`customer_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_display_restaurant_menu_cuisine`
  ADD CONSTRAINT `tbl_detail_display_restaurant_menu_cuisine_ibfk_1` FOREIGN KEY (`restaurant_id_pk_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_display_restaurant_menu_item`
  ADD CONSTRAINT `fk_tbl_detail_display_restaurant_menu_item_1` FOREIGN KEY (`restaurant_id_pk_fk`, `menu_item_pk2_fk2`) REFERENCES `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`, `menu_item_pk2_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_display_restaurant_menu_sub_category_1`
  ADD CONSTRAINT `tbl_detail_display_restaurant_menu_sub_category_1_ibfk_1` FOREIGN KEY (`restaurant_id_pk_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_display_restaurant_menu_sub_category_2`
  ADD CONSTRAINT `tbl_detail_display_restaurant_menu_sub_category_2_ibfk_1` FOREIGN KEY (`restaurant_id_pk_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_item_rating`
  ADD CONSTRAINT `tbl_detail_item_rating_ibfk_6` FOREIGN KEY (`order_id_pk_fk`) REFERENCES `tbl_mast_order` (`order_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_item_rating_ibfk_7` FOREIGN KEY (`customer_id_pk_fk`) REFERENCES `tbl_mast_customer` (`customer_id_pk`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_item_rating_ibfk_8` FOREIGN KEY (`order_item_pk_fk`) REFERENCES `tbl_detail_order` (`item_pk2_fk`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_detail_item_rating_ibfk_9` FOREIGN KEY (`restaurant_id_pk_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_menu_classification`
  ADD CONSTRAINT `tbl_detail_menu_classification_ibfk_1` FOREIGN KEY (`menu_item_pk_fk`) REFERENCES `tbl_mast_menu_item` (`menu_item_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_menu_classification_ibfk_2` FOREIGN KEY (`classification_type_fk`) REFERENCES `tbl_constraint_menu_classification` (`classification_type_pk`);

ALTER TABLE `tbl_detail_menu_item`
  ADD CONSTRAINT `tbl_detail_menu_item_ibfk_1` FOREIGN KEY (`menu_item_pk_fk`) REFERENCES `tbl_mast_menu_item` (`menu_item_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_newsletter`
  ADD CONSTRAINT `tbl_detail_newsletter_ibfk_1` FOREIGN KEY (`customer_id_pk1_fk`) REFERENCES `tbl_mast_customer` (`customer_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `tbl_detail_order_ibfk_2` FOREIGN KEY (`item_pk2_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`menu_item_pk2_fk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_detail_order_ibfk_4` FOREIGN KEY (`order_id_pk1_fk`) REFERENCES `tbl_mast_order` (`order_id_pk`) ON DELETE CASCADE;

ALTER TABLE `tbl_detail_order_delivery`
  ADD CONSTRAINT `tbl_detail_order_delivery_ibfk_2` FOREIGN KEY (`restaurant_id_pk2_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_order_delivery_ibfk_3` FOREIGN KEY (`order_id_pk1_fk`) REFERENCES `tbl_mast_order` (`order_id_pk`) ON DELETE CASCADE;

ALTER TABLE `tbl_detail_order_invoice`
  ADD CONSTRAINT `tbl_detail_order_invoice_ibfk_3` FOREIGN KEY (`customer_id_fk`) REFERENCES `tbl_mast_customer` (`customer_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_order_invoice_ibfk_4` FOREIGN KEY (`order_id_fk`) REFERENCES `tbl_mast_order` (`order_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_order_invoice_ibfk_5` FOREIGN KEY (`cash_back_code_fk`) REFERENCES `tbl_mast_cash_back` (`cash_back_code_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `tbl_detail_order_tax`
  ADD CONSTRAINT `tbl_detail_order_tax_ibfk_1` FOREIGN KEY (`invoice_no_pk1_fk`) REFERENCES `tbl_detail_order_invoice` (`invoice_no_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_detail_order_tax_ibfk_2` FOREIGN KEY (`tax_name_pk2_fk`) REFERENCES `tbl_mast_tax` (`display_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `tbl_detail_restaurant_holiday`
  ADD CONSTRAINT `tbl_detail_restaurant_holiday_ibfk_1` FOREIGN KEY (`restaurant_id_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_restaurant_item_side`
  ADD CONSTRAINT `restaunrat_id_pk1_fk_fk` FOREIGN KEY (`restaurant_id_pk1_fk`, `menu_item_pk2_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`, `menu_item_pk2_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_restaurant_menu_item`
  ADD CONSTRAINT `restaurant_menu_item_fk_constrain` FOREIGN KEY (`restaurant_id_pk_fk`, `menu_item_pk_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`, `menu_item_pk2_fk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restaurant_menu_item_fk_constraint` FOREIGN KEY (`restaurant_id_pk_fk`, `menu_item_pk_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`, `menu_item_pk2_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_restaurant_rating`
  ADD CONSTRAINT `tbl_detail_restaurant_rating_ibfk_1` FOREIGN KEY (`restaurant_id_pk1_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_restaurant_rating_ibfk_2` FOREIGN KEY (`order_id_pk2_fk`) REFERENCES `tbl_mast_order` (`order_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_restaurant_rating_ibfk_3` FOREIGN KEY (`customer_id_fk`) REFERENCES `tbl_mast_customer` (`customer_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_restaurant_server`
  ADD CONSTRAINT `tbl_detail_restaurant_server_ibfk_1` FOREIGN KEY (`restaurant_id_pk_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_restaurant_table`
  ADD CONSTRAINT `tbl_detail_restaurant_table_ibfk_1` FOREIGN KEY (`restaurant_id_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_detail_transaction`
  ADD CONSTRAINT `tbl_detail_transaction_ibfk_1` FOREIGN KEY (`invoice_no_fk`) REFERENCES `tbl_detail_order_invoice` (`invoice_no_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_transaction_ibfk_2` FOREIGN KEY (`transaction_type_code_fk`) REFERENCES `tbl_mast_transaction_mode` (`transaction_type_code_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_detail_transaction_ibfk_3` FOREIGN KEY (`customer_id_fk`) REFERENCES `tbl_mast_order` (`customer_id_fk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_map_customer_address`
  ADD CONSTRAINT `tbl_map_customer_address_ibfk_3` FOREIGN KEY (`customer_id_pk_fk`) REFERENCES `tbl_mast_customer` (`customer_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_customer_address_ibfk_4` FOREIGN KEY (`address_id_pk_fk`) REFERENCES `tbl_mast_address` (`address_id_pk`);

ALTER TABLE `tbl_map_employee_address`
  ADD CONSTRAINT `tbl_map_employee_address_ibfk_1` FOREIGN KEY (`employee_id_fk`) REFERENCES `tbl_mast_employee` (`employee_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_employee_address_ibfk_2` FOREIGN KEY (`address_id_fk`) REFERENCES `tbl_mast_address` (`address_id_pk`);

ALTER TABLE `tbl_map_employee_role`
  ADD CONSTRAINT `tbl_map_employee_role_ibfk_1` FOREIGN KEY (`employee_id_pk1_fk`) REFERENCES `tbl_mast_employee` (`employee_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_employee_role_ibfk_2` FOREIGN KEY (`role_id_pk2_fk`) REFERENCES `tbl_mast_roles` (`role_id_pk`) ON UPDATE CASCADE;

ALTER TABLE `tbl_map_permission_roles`
  ADD CONSTRAINT `tbl_map_permission_roles_ibfk_1` FOREIGN KEY (`role_id_pk1_fk`) REFERENCES `tbl_mast_roles` (`role_id_pk`),
  ADD CONSTRAINT `tbl_map_permission_roles_ibfk_2` FOREIGN KEY (`permission_id_pk2_fk`) REFERENCES `tbl_mast_permissions` (`permission_id_pk`);

ALTER TABLE `tbl_map_restaurant_discount`
  ADD CONSTRAINT `tbl_map_restaurant_discount_ibfk_1` FOREIGN KEY (`restaurant_id_pk1_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_restaurant_discount_ibfk_2` FOREIGN KEY (`discount_id_pk2_fk`) REFERENCES `tbl_mast_discount` (`discount_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_map_tax_restaurant`
  ADD CONSTRAINT `tbl_map_tax_restaurant_ibfk_1` FOREIGN KEY (`restaurant_id_pk1_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_tax_restaurant_ibfk_2` FOREIGN KEY (`tax_id_pk2_fk`) REFERENCES `tbl_mast_tax` (`tax_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_map_transaction_mode_cash_back`
  ADD CONSTRAINT `tbl_map_transaction_mode_cash_back_ibfk_1` FOREIGN KEY (`transaction_type_code_pk2_fk`) REFERENCES `tbl_mast_transaction_mode` (`transaction_type_code_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_map_transaction_mode_cash_back_ibfk_2` FOREIGN KEY (`cash_back_code_pk1_fk`) REFERENCES `tbl_mast_cash_back` (`cash_back_code_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_mast_employee`
  ADD CONSTRAINT `tbl_mast_employee_ibfk_1` FOREIGN KEY (`restaurant_id_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_mast_order`
  ADD CONSTRAINT `tbl_mast_order_ibfk_2` FOREIGN KEY (`table_no_fk`) REFERENCES `tbl_detail_restaurant_table` (`table_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_mast_order_ibfk_3` FOREIGN KEY (`customer_id_fk`) REFERENCES `tbl_mast_customer` (`customer_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_mast_order_ibfk_4` FOREIGN KEY (`restaurant_id_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`);

ALTER TABLE `tbl_mast_permissions`
  ADD CONSTRAINT `tbl_mast_permissions_ibfk_1` FOREIGN KEY (`object_id_fk`) REFERENCES `tbl_mast_objects` (`object_id_pk`),
  ADD CONSTRAINT `tbl_mast_permissions_ibfk_2` FOREIGN KEY (`operation_id_fk`) REFERENCES `tbl_mast_operations` (`operation_id_pk`);

ALTER TABLE `tbl_mast_restaurant`
  ADD CONSTRAINT `tbl_mast_restaurant_ibfk_1` FOREIGN KEY (`chain_restaurant_id_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `tbl_mast_restaurant_menu_item`
  ADD CONSTRAINT `tbl_mast_restaurant_menu_item_ibfk_2` FOREIGN KEY (`menu_item_pk2_fk`) REFERENCES `tbl_mast_menu_item` (`menu_item_pk`),
  ADD CONSTRAINT `tbl_mast_restaurant_menu_item_ibfk_3` FOREIGN KEY (`restaurant_id_pk1_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_mast_transaction_mode`
  ADD CONSTRAINT `tbl_mast_transaction_mode_ibfk_1` FOREIGN KEY (`mode_fk`) REFERENCES `tbl_constaraint_transaction_mode` (`transaction_mode_pk`);

ALTER TABLE `tbl_summary_item_rating`
  ADD CONSTRAINT `fk_menu_rating_restaurant_constraint` FOREIGN KEY (`restaurant_id_pk2_fk`, `menu_item_pk1_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`restaurant_id_pk1_fk`, `menu_item_pk2_fk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_summary_item_rating_ibfk_1` FOREIGN KEY (`menu_item_pk1_fk`) REFERENCES `tbl_mast_restaurant_menu_item` (`menu_item_pk2_fk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_summary_item_rating_ibfk_2` FOREIGN KEY (`restaurant_id_pk2_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_summary_restaurant_rating`
  ADD CONSTRAINT `tbl_summary_restaurant_rating_ibfk_1` FOREIGN KEY (`restaurant_id_pk_fk`) REFERENCES `tbl_mast_restaurant` (`restaurant_unique_id_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
