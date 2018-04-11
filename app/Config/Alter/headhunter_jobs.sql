-- ----------------------------
-- Table structure for `headhunter_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `headhunter_jobs`;
CREATE TABLE `headhunter_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` varchar(255) NOT NULL,
  `company_id` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `salary_start` bigint(20) NOT NULL,
  `salary_end` bigint(20) NOT NULL,
  `region` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `job_category` varchar(255) NOT NULL,
  `responsibility` text NOT NULL,
  `number_of_keep` bigint(20) NOT NULL,
  `number_of_applicant` bigint(20) NOT NULL,
  `deactivate` tinyint(10) NOT NULL,
  `domestic_abroad` tinyint(10) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
