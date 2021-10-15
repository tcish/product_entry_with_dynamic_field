CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `product_property` (
  `product_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `property_value` varchar(255) NOT NULL DEFAULT 'nothing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;