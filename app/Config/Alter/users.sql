-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `jobseeker_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `specialize_major` varchar(255) DEFAULT NULL,
  `university_name` varchar(255) DEFAULT NULL,
  `degree_level` varchar(255) DEFAULT NULL,
  `email_token_expires` date DEFAULT NULL,
   `password_token` varchar(255) DEFAULT NULL,
  `other_qulification` varchar(255) DEFAULT NULL,
  `language_skill_level` varchar(255) DEFAULT NULL,
  `language_skill` varchar(255) DEFAULT NULL,
  `interest` varchar(255) DEFAULT NULL,
  `computing_skill` varchar(255) DEFAULT NULL,
  `other_skill` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `job_description_comment` varchar(255) DEFAULT NULL,
  `job_position` varchar(255) DEFAULT NULL,
  `expected_income` bigint(20) DEFAULT NULL,
  `working_location` varchar(255) DEFAULT NULL,
  `contract_type` varchar(30) DEFAULT NULL,
  `withdraw` tinyint(1) DEFAULT NULL,
  `non_disclosure` tinyint(1) DEFAULT NULL,
  `applied_job_id` varchar(255) DEFAULT NULL,
  `favourite_job` varchar(255) DEFAULT NULL,
  `cv` tinyint(1) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `deleted` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;