-- ----------------------------
-- Table structure for `cmp_headhunter`
-- ----------------------------
DROP TABLE IF EXISTS `cmp_headhunters`;
CREATE TABLE `cmp_headhunters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `headhunter_name` varchar(255) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `company_phone` bigint(20) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `establishment` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `about` text,
  `deactivate` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  `representative_postion` varchar(255) DEFAULT NULL,
  `representative_name` varchar(255) DEFAULT NULL,
  `hp_address` varchar(255) DEFAULT NULL,
  `capital` bigint(20) DEFAULT NULL,
  `number_of_employee` bigint(20) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `deleted` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

