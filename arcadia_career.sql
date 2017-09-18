-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2017 at 10:42 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arcadia_career`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidate_id` int(5) NOT NULL,
  `fullname` varchar(250) CHARACTER SET utf8 COLLATE utf8_german2_ci DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `image` varchar(120) DEFAULT NULL,
  `marital` tinyint(4) DEFAULT NULL,
  `nationality_id` int(3) DEFAULT NULL,
  `visa_status` varchar(120) DEFAULT NULL,
  `spoken_language_id` int(3) DEFAULT NULL,
  `place_of_residence` varchar(250) DEFAULT NULL,
  `expected_salary` varchar(64) DEFAULT NULL,
  `education_level` varchar(200) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `employment_status` varchar(100) DEFAULT NULL,
  `work_time` varchar(100) DEFAULT NULL,
  `category_id` int(3) DEFAULT NULL,
  `last_job_id` int(2) DEFAULT NULL,
  `parttime_id` int(5) DEFAULT NULL,
  `cv` varchar(250) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `slug` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `fullname`, `age`, `image`, `marital`, `nationality_id`, `visa_status`, `spoken_language_id`, `place_of_residence`, `expected_salary`, `education_level`, `contact_number`, `employment_status`, `work_time`, `category_id`, `last_job_id`, `parttime_id`, `cv`, `time`, `status`, `slug`) VALUES
(27, 'Nguyễn Minh Thànhh', 277, '', 0, 1, 'pr', 1, 'Vietnamm', '{"amount":"10000","unit":"sgd"}', 'poly', '016528800977', 'unemployed', 'parttime', 4, 3, 24, NULL, 1504066738, 1, 'nguyen-minh-thanhh'),
(28, 'Nguyễn Minh Toàn', 27, '', 0, 10, 'wp', 3, 'Laos', '{"amount":"8888","unit":"sgd"}', 'secondary', '0988888888', 'student', 'parttime', 4, 6, 27, NULL, 1504078636, 1, 'nguyen-minh-toan'),
(29, 'Ngô Thanh Liêm', 28, '', 1, 3, 'spass', 2, 'Vietnam', '{"amount":"9999","unit":"usd"}', 'poly', '0989999999', 'student', 'parttime', 4, 7, 28, NULL, 1504078884, 1, 'ngo-thanh-liem'),
(30, 'Nguyễn Tiến Thành', 30, '/uploads/candidates/logo_arcadia-234a6ee536.png', 0, 1, 'spass', 3, 'Vietnam', '{"amount":"8797","unit":"sgd"}', 'poly', '01652880097', 'housewife', 'parttime', 4, 8, 29, NULL, 1504079242, 1, 'nguyen-tien-thanh'),
(32, 'Nguyễn Đức Trung', 30, '/uploads/candidates/logo_arcadia-d347df3d73.png', 0, 9, 'spass', 2, 'Vietnam', '{"amount":"1000","unit":"usd"}', 'tertiary', '098888888', 'employed', 'parttime', 4, 9, 30, 'uploads/candidates/cv/nguyen-duc-trung-1504153588.pdf', 1504153588, 1, 'nguyen-duc-trung'),
(33, 'Phạm Gia Long', 32, '/uploads/candidates/logo_arcadia-435c53251d.png', 0, 2, 'wp', 3, 'Vietnam', '{"amount":"1000","unit":"usd"}', 'jc', '0988888888', 'housewife', 'parttime', 4, 11, 31, 'uploads/candidates/cv/pham-gia-long-1504155316.pdf', 1504155316, 1, 'pham-gia-long'),
(34, 'Nguyễn Minh Ngọc', 25, '/uploads/candidates/logo_arcadia-15826f19ea.png', 0, 2, 'wp', 3, 'Vietnam', '{"amount":"2000","unit":"sgd"}', 'secondary', '098888888', 'employed', 'parttime', 5, 10, 32, 'uploads/candidates/cv/nguyen-minh-ngoc-1504156000.pdf', 1504156000, 1, 'nguyen-minh-ngoc'),
(35, 'Hoàng Hoài Nam', 30, '/uploads/candidates/logo_arcadia-11e2ad6bf9.png', 0, 9, 'spass', 2, 'Vietnam', '{"amount":"1000","unit":"usd"}', 'tertiary', '09888888888', 'employed', '0', 4, 12, 33, 'uploads/candidates/cv/hoang-hoai-nam-1504166316.pdf', 1504166316, 1, 'hoang-hoai-nam'),
(36, 'Nguyễn Giai Ngọc', 43, '/uploads/candidates/logo_arcadia-068bcdad6a.png', 1, 3, 'spass', 3, 'Vietnam', '{"amount":"234234","unit":"sgd"}', 'poly', '0988888888', 'student', 'parttime', 5, 13, 34, 'uploads/candidates/cv/nguyen-giai-ngoc-1504168556.pdf', 1504168556, 1, 'nguyen-giai-ngoc');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(5) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `company_tel` varchar(40) DEFAULT NULL,
  `company_site` varchar(150) DEFAULT NULL,
  `company_size` varchar(50) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `logo`, `company_address`, `company_tel`, `company_site`, `company_size`, `time`, `status`, `slug`) VALUES
(1, 'Arcadia Communication', '/uploads/companies/logo_arcadia-440bcbe45a.png', 'Singapore', '8888888888', 'http://www.arcadiacomm.com', 'asdasdasd', 1503909000, 1, 'arcadia-communication'),
(2, 'Arcadia VietNam', '/uploads/companies/logo_arcadia-3d98b79ac6.png', 'VG Building 235 Nguyễn Trãi', '9999999999', 'http://www.arcadiacomm.com.vn', 'áđâsđâs', 1503909778, 1, 'arcadia-vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `easyii_admins`
--

CREATE TABLE `easyii_admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `auth_key` varchar(128) NOT NULL,
  `access_token` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_article_categories`
--

CREATE TABLE `easyii_article_categories` (
  `category_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_article_categories`
--

INSERT INTO `easyii_article_categories` (`category_id`, `title`, `image`, `order_num`, `slug`, `tree`, `lft`, `rgt`, `depth`, `status`) VALUES
(1, 'Articles category 1', NULL, 2, 'articles-category-1', 1, 1, 2, 0, 1),
(2, 'Articles category 2', NULL, 1, 'articles-category-2', 2, 1, 6, 0, 1),
(3, 'Subcategory 1', NULL, 1, 'subcategory-1', 2, 2, 3, 1, 1),
(4, 'Subcategory 1', NULL, 1, 'subcategory-1-2', 2, 4, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_article_items`
--

CREATE TABLE `easyii_article_items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `short` varchar(1024) DEFAULT NULL,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_article_items`
--

INSERT INTO `easyii_article_items` (`item_id`, `category_id`, `title`, `image`, `short`, `text`, `slug`, `time`, `views`, `status`) VALUES
(1, 1, 'First article title', '/uploads/article/article-1.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti', '<p><strong>Sed ut perspiciatis</strong>, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.&nbsp;</p><ul><li>item 1</li><li>item 2</li><li>item 3</li></ul><p>ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?</p>', 'first-article-title', 1503896762, 0, 1),
(2, 1, 'Second article title', '/uploads/article/article-2.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><ol> <li>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </li><li>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</li></ol>', 'second-article-title', 1503810362, 0, 1),
(3, 1, 'Third article title', '/uploads/article/article-3.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>', 'third-article-title', 1503723962, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_carousel`
--

CREATE TABLE `easyii_carousel` (
  `carousel_id` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `text` text,
  `order_num` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_carousel`
--

INSERT INTO `easyii_carousel` (`carousel_id`, `image`, `link`, `title`, `text`, `order_num`, `status`) VALUES
(1, '/uploads/carousel/1.jpg', '', 'Ut enim ad minim veniam, quis nostrud exercitation', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', 1, 1),
(2, '/uploads/carousel/2.jpg', '', 'Sed do eiusmod tempor incididunt ut labore et', 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.', 2, 1),
(3, '/uploads/carousel/3.jpg', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_catalog_categories`
--

CREATE TABLE `easyii_catalog_categories` (
  `category_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `fields` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `job_description` text,
  `job_requirements` text,
  `company_id` int(5) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_catalog_categories`
--

INSERT INTO `easyii_catalog_categories` (`category_id`, `title`, `image`, `fields`, `slug`, `tree`, `lft`, `rgt`, `depth`, `order_num`, `status`, `job_description`, `job_requirements`, `company_id`, `time`) VALUES
(4, 'IT', '', '[]', 'it', 4, 1, 2, 0, 1, 1, 'About infomation technology', '2 years of experience in the IT field', 2, 1503911081),
(5, 'Nurse', '', '[]', 'nurse', 5, 1, 2, 0, 2, 1, 'Nursing', '2 years of experience', 2, 1504080144);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_catalog_items`
--

CREATE TABLE `easyii_catalog_items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `description` text,
  `available` int(11) DEFAULT '1',
  `price` float DEFAULT '0',
  `discount` int(11) DEFAULT '0',
  `data` text NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_catalog_item_data`
--

CREATE TABLE `easyii_catalog_item_data` (
  `data_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `value` varchar(1024) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_faq`
--

CREATE TABLE `easyii_faq` (
  `faq_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `order_num` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_faq`
--

INSERT INTO `easyii_faq` (`faq_id`, `question`, `answer`, `order_num`, `status`) VALUES
(1, 'Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?', 'But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure', 1, 1),
(2, 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum?', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta <a href="http://easyiicms.com/">sunt explicabo</a>.', 2, 1),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 't enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_feedback`
--

CREATE TABLE `easyii_feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `text` text NOT NULL,
  `answer_subject` varchar(128) DEFAULT NULL,
  `answer_text` text,
  `time` int(11) DEFAULT '0',
  `ip` varchar(16) NOT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_files`
--

CREATE TABLE `easyii_files` (
  `file_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `file` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `downloads` int(11) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `order_num` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_files`
--

INSERT INTO `easyii_files` (`file_id`, `title`, `file`, `size`, `slug`, `downloads`, `time`, `order_num`) VALUES
(1, 'Price list', '/uploads/files/example.csv', 104, 'price-list', 0, 1503896766, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_gallery_categories`
--

CREATE TABLE `easyii_gallery_categories` (
  `category_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `tree` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `order_num` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_gallery_categories`
--

INSERT INTO `easyii_gallery_categories` (`category_id`, `title`, `image`, `slug`, `tree`, `lft`, `rgt`, `depth`, `order_num`, `status`) VALUES
(1, 'Album 1', '/uploads/gallery/album-1.jpg', 'album-1', 1, 1, 2, 0, 2, 1),
(2, 'Album 2', '/uploads/gallery/album-2.jpg', 'album-2', 2, 1, 2, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_guestbook`
--

CREATE TABLE `easyii_guestbook` (
  `guestbook_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `text` text NOT NULL,
  `answer` text,
  `email` varchar(128) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  `ip` varchar(16) NOT NULL,
  `new` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_guestbook`
--

INSERT INTO `easyii_guestbook` (`guestbook_id`, `name`, `title`, `text`, `answer`, `email`, `time`, `ip`, `new`, `status`) VALUES
(1, 'First user', '', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.', NULL, NULL, 1503896763, '::1', 1, 1),
(2, 'Second user', '', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', NULL, 1503896764, '::1', 0, 1),
(3, 'Third user', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, NULL, 1503896765, '::1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_loginform`
--

CREATE TABLE `easyii_loginform` (
  `log_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `user_agent` varchar(1024) NOT NULL,
  `time` int(11) DEFAULT '0',
  `success` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_loginform`
--

INSERT INTO `easyii_loginform` (`log_id`, `username`, `password`, `ip`, `user_agent`, `time`, `success`) VALUES
(1, 'root', '******', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1503896762, 1),
(2, 'root', '******', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1503905699, 1),
(3, 'root', '******', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1503974515, 1),
(4, 'root', '******', '192.168.1.109', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0', 1504082199, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_migration`
--

CREATE TABLE `easyii_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_migration`
--

INSERT INTO `easyii_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1503896759),
('m000000_000000_install', 1503896761);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_modules`
--

CREATE TABLE `easyii_modules` (
  `module_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `class` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `icon` varchar(32) NOT NULL,
  `settings` text NOT NULL,
  `notice` int(11) DEFAULT '0',
  `order_num` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_modules`
--

INSERT INTO `easyii_modules` (`module_id`, `name`, `class`, `title`, `icon`, `settings`, `notice`, `order_num`, `status`) VALUES
(1, 'article', 'yii\\easyii\\modules\\article\\ArticleModule', 'Articles', 'pencil', '{"categoryThumb":true,"articleThumb":true,"enablePhotos":true,"enableShort":true,"shortMaxLength":255,"enableTags":true,"itemsInFolder":false}', 0, 65, 0),
(2, 'carousel', 'yii\\easyii\\modules\\carousel\\CarouselModule', 'Carousel', 'picture', '{"enableTitle":true,"enableText":true}', 0, 40, 0),
(3, 'catalog', 'yii\\easyii\\modules\\catalog\\CatalogModule', 'Job Categories', 'list-alt', '{"categoryThumb":true,"itemsInFolder":false,"itemThumb":true,"itemPhotos":true,"itemDescription":true,"itemSale":true}', 0, 100, 1),
(4, 'faq', 'yii\\easyii\\modules\\faq\\FaqModule', 'FAQ', 'question-sign', '[]', 0, 45, 1),
(5, 'feedback', 'yii\\easyii\\modules\\feedback\\FeedbackModule', 'Feedback', 'earphone', '{"mailAdminOnNewFeedback":true,"subjectOnNewFeedback":"New feedback","templateOnNewFeedback":"@easyii\\/modules\\/feedback\\/mail\\/en\\/new_feedback","answerTemplate":"@easyii\\/modules\\/feedback\\/mail\\/en\\/answer","answerSubject":"Answer on your feedback message","answerHeader":"Hello,","answerFooter":"Best regards.","enableTitle":false,"enablePhone":true,"enableCaptcha":false}', 0, 60, 1),
(6, 'file', 'yii\\easyii\\modules\\file\\FileModule', 'Files', 'floppy-disk', '[]', 0, 30, 1),
(7, 'gallery', 'yii\\easyii\\modules\\gallery\\GalleryModule', 'Photo Gallery', 'camera', '{"categoryThumb":true,"itemsInFolder":false}', 0, 90, 0),
(8, 'guestbook', 'yii\\easyii\\modules\\guestbook\\GuestbookModule', 'Guestbook', 'book', '{"enableTitle":false,"enableEmail":true,"preModerate":false,"enableCaptcha":false,"mailAdminOnNewPost":true,"subjectOnNewPost":"New message in the guestbook.","templateOnNewPost":"@easyii\\/modules\\/guestbook\\/mail\\/en\\/new_post","frontendGuestbookRoute":"\\/guestbook","subjectNotifyUser":"Your post in the guestbook answered","templateNotifyUser":"@easyii\\/modules\\/guestbook\\/mail\\/en\\/notify_user"}', 2, 80, 0),
(9, 'news', 'yii\\easyii\\modules\\news\\NewsModule', 'News', 'bullhorn', '{"enableThumb":true,"enablePhotos":true,"enableShort":true,"shortMaxLength":256,"enableTags":true}', 0, 70, 1),
(10, 'page', 'yii\\easyii\\modules\\page\\PageModule', 'Pages', 'file', '[]', 0, 50, 0),
(11, 'shopcart', 'yii\\easyii\\modules\\shopcart\\ShopcartModule', 'Orders', 'shopping-cart', '{"mailAdminOnNewOrder":true,"subjectOnNewOrder":"New order","templateOnNewOrder":"@easyii\\/modules\\/shopcart\\/mail\\/en\\/new_order","subjectNotifyUser":"Your order status changed","templateNotifyUser":"@easyii\\/modules\\/shopcart\\/mail\\/en\\/notify_user","frontendShopcartRoute":"\\/shopcart\\/order","enablePhone":true,"enableEmail":true}', 0, 120, 0),
(12, 'subscribe', 'yii\\easyii\\modules\\subscribe\\SubscribeModule', 'E-mail subscribe', 'envelope', '[]', 0, 10, 1),
(13, 'text', 'yii\\easyii\\modules\\text\\TextModule', 'Text blocks', 'font', '[]', 0, 20, 1),
(14, 'companies', 'app\\modules\\companies\\CompaniesModule', 'Companies', 'home', '{"enableThumb":true,"enablePhotos":true,"enableShort":true,"shortMaxLength":256,"enableTags":true}', 0, 121, 1),
(15, 'nationals', 'app\\modules\\nationals\\NationalsModule', 'Nationals', 'globe', '[]', 0, 122, 1),
(16, 'spokenlanguages', 'app\\modules\\spokenlanguages\\SpokenlanguagesModule', 'Spoken language', 'globe', '[]', 0, 123, 1),
(17, 'candidates', 'app\\modules\\candidates\\CandidatesModule', 'Candidates', 'user', '[]', 0, 124, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_news`
--

CREATE TABLE `easyii_news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `short` varchar(1024) DEFAULT NULL,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_news`
--

INSERT INTO `easyii_news` (`news_id`, `title`, `image`, `short`, `text`, `slug`, `time`, `views`, `status`) VALUES
(1, 'First news title', '/uploads/news/news-1.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti', '<p><strong>Sed ut perspiciatis</strong>, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.&nbsp;</p><ul><li>item 1</li><li>item 2</li><li>item 3</li></ul><p>ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?</p>', 'first-news-title', 1503896762, 0, 1),
(2, 'Second news title', '/uploads/news/news-2.jpg', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><ol> <li>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </li><li>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</li></ol>', 'second-news-title', 1503810362, 0, 1),
(3, 'Third news title', '/uploads/news/news-3.jpg', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt molliti', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>', 'third-news-title', 1503723962, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_pages`
--

CREATE TABLE `easyii_pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_pages`
--

INSERT INTO `easyii_pages` (`page_id`, `title`, `text`, `slug`) VALUES
(1, 'Index', '<p><strong>All elements are live-editable, switch on Live Edit button to see this feature.</strong>&nbsp;</p><p>Dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.&nbsp;Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'page-index'),
(2, 'Shop', '', 'page-shop'),
(3, 'Shop search', '', 'page-shop-search'),
(4, 'Shopping cart', '', 'page-shopcart'),
(5, 'Order created', '<p>Your order successfully created. Our manager will contact you as soon as possible.</p>', 'page-shopcart-success'),
(6, 'News', '', 'page-news'),
(7, 'Articles', '', 'page-articles'),
(8, 'Gallery', '', 'page-gallery'),
(9, 'Guestbook', '', 'page-guestbook'),
(10, 'FAQ', '', 'page-faq'),
(11, 'Contact', '<p><strong>Address</strong>: Dominican republic, Santo Domingo, Some street 123</p><p><strong>ZIP</strong>: 123456</p><p><strong>Phone</strong>: +1 234 56-78</p><p><strong>E-mail</strong>: demo@example.com</p>', 'page-contact');

-- --------------------------------------------------------

--
-- Table structure for table `easyii_photos`
--

CREATE TABLE `easyii_photos` (
  `photo_id` int(11) NOT NULL,
  `class` varchar(128) NOT NULL,
  `item_id` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `order_num` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_photos`
--

INSERT INTO `easyii_photos` (`photo_id`, `class`, `item_id`, `image`, `description`, `order_num`) VALUES
(11, 'yii\\easyii\\modules\\news\\models\\News', 1, '/uploads/photos/news-1-1.jpg', '', 11),
(12, 'yii\\easyii\\modules\\news\\models\\News', 1, '/uploads/photos/news-1-2.jpg', '', 12),
(13, 'yii\\easyii\\modules\\news\\models\\News', 1, '/uploads/photos/news-1-3.jpg', '', 13),
(14, 'yii\\easyii\\modules\\news\\models\\News', 1, '/uploads/photos/news-1-4.jpg', '', 14),
(15, 'yii\\easyii\\modules\\article\\models\\Item', 1, '/uploads/photos/article-1-1.jpg', '', 15),
(16, 'yii\\easyii\\modules\\article\\models\\Item', 1, '/uploads/photos/article-1-2.jpg', '', 16),
(17, 'yii\\easyii\\modules\\article\\models\\Item', 1, '/uploads/photos/article-1-3.jpg', '', 17),
(18, 'yii\\easyii\\modules\\article\\models\\Item', 1, '/uploads/photos/news-1-4.jpg', '', 18),
(19, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-9.jpg', '', 19),
(20, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-8.jpg', '', 20),
(21, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-7.jpg', '', 21),
(22, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-6.jpg', '', 22),
(23, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-5.jpg', '', 23),
(24, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-4.jpg', '', 24),
(25, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-3.jpg', '', 25),
(26, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-2.jpg', '', 26),
(27, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, '/uploads/photos/album-1-1.jpg', '', 27);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_seotext`
--

CREATE TABLE `easyii_seotext` (
  `seotext_id` int(11) NOT NULL,
  `class` varchar(128) NOT NULL,
  `item_id` int(11) NOT NULL,
  `h1` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `keywords` varchar(128) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_seotext`
--

INSERT INTO `easyii_seotext` (`seotext_id`, `class`, `item_id`, `h1`, `title`, `keywords`, `description`) VALUES
(1, 'yii\\easyii\\modules\\page\\models\\Page', 1, '', 'EasyiiCMS demo', '', 'yii2, easyii, admin'),
(2, 'yii\\easyii\\modules\\page\\models\\Page', 2, 'Shop categories', 'Extended shop title', '', ''),
(3, 'yii\\easyii\\modules\\page\\models\\Page', 3, 'Shop search results', 'Extended shop search title', '', ''),
(4, 'yii\\easyii\\modules\\page\\models\\Page', 4, 'Shopping cart H1', 'Extended shopping cart title', '', ''),
(5, 'yii\\easyii\\modules\\page\\models\\Page', 5, 'Success', 'Extended order success title', '', ''),
(6, 'yii\\easyii\\modules\\page\\models\\Page', 6, 'News H1', 'Extended news title', '', ''),
(7, 'yii\\easyii\\modules\\page\\models\\Page', 7, 'Articles H1', 'Extended articles title', '', ''),
(8, 'yii\\easyii\\modules\\page\\models\\Page', 8, 'Photo gallery', 'Extended gallery title', '', ''),
(9, 'yii\\easyii\\modules\\page\\models\\Page', 9, 'Guestbook H1', 'Extended guestbook title', '', ''),
(10, 'yii\\easyii\\modules\\page\\models\\Page', 10, 'Frequently Asked Question', 'Extended faq title', '', ''),
(11, 'yii\\easyii\\modules\\page\\models\\Page', 11, 'Contact us', 'Extended contact title', '', ''),
(17, 'yii\\easyii\\modules\\news\\models\\News', 1, 'First news H1', '', '', ''),
(18, 'yii\\easyii\\modules\\news\\models\\News', 2, 'Second news H1', '', '', ''),
(19, 'yii\\easyii\\modules\\news\\models\\News', 3, 'Third news H1', '', '', ''),
(20, 'yii\\easyii\\modules\\article\\models\\Category', 1, 'Articles category 1 H1', 'Extended category 1 title', '', ''),
(21, 'yii\\easyii\\modules\\article\\models\\Category', 3, 'Subcategory 1 H1', 'Extended subcategory 1 title', '', ''),
(22, 'yii\\easyii\\modules\\article\\models\\Category', 4, 'Subcategory 2 H1', 'Extended subcategory 2 title', '', ''),
(23, 'yii\\easyii\\modules\\article\\models\\Item', 1, 'First article H1', '', '', ''),
(24, 'yii\\easyii\\modules\\article\\models\\Item', 2, 'Second article H1', '', '', ''),
(25, 'yii\\easyii\\modules\\article\\models\\Item', 3, 'Third article H1', '', '', ''),
(26, 'yii\\easyii\\modules\\gallery\\models\\Category', 1, 'Album 1 H1', 'Extended Album 1 title', '', ''),
(27, 'yii\\easyii\\modules\\gallery\\models\\Category', 2, 'Album 2 H1', 'Extended Album 2 title', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `easyii_settings`
--

CREATE TABLE `easyii_settings` (
  `setting_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `title` varchar(128) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `visibility` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_settings`
--

INSERT INTO `easyii_settings` (`setting_id`, `name`, `title`, `value`, `visibility`) VALUES
(1, 'easyii_version', 'EasyiiCMS version', '0.9', 0),
(2, 'recaptcha_key', 'ReCaptcha key', '', 1),
(3, 'password_salt', 'Password salt', 'fPPP-xnNBPY6jlinGMiDNY3wsyrtHD0L', 0),
(4, 'root_auth_key', 'Root authorization key', 'fxbYc63-SRR9vnpo_URnisbb2_ReiGNL', 0),
(5, 'root_password', 'Root password', '983da6492c214c15fb78acacca860f4996bb8143', 1),
(6, 'auth_time', 'Auth time', '86400', 1),
(7, 'robot_email', 'Robot E-mail', '', 1),
(8, 'admin_email', 'Admin E-mail', 'arcadia2252017@gmail.com', 2),
(9, 'recaptcha_secret', 'ReCaptcha secret', '', 1),
(10, 'toolbar_position', 'Frontend toolbar position ("top" or "bottom")', 'top', 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_shopcart_goods`
--

CREATE TABLE `easyii_shopcart_goods` (
  `good_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `options` varchar(255) NOT NULL,
  `price` float DEFAULT '0',
  `discount` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_shopcart_orders`
--

CREATE TABLE `easyii_shopcart_orders` (
  `order_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `remark` varchar(1024) NOT NULL,
  `access_token` varchar(32) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `time` int(11) DEFAULT '0',
  `new` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_subscribe_history`
--

CREATE TABLE `easyii_subscribe_history` (
  `history_id` int(11) NOT NULL,
  `subject` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `sent` int(11) DEFAULT '0',
  `time` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_subscribe_subscribers`
--

CREATE TABLE `easyii_subscribe_subscribers` (
  `subscriber_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `time` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `easyii_tags`
--

CREATE TABLE `easyii_tags` (
  `tag_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_tags`
--

INSERT INTO `easyii_tags` (`tag_id`, `name`, `frequency`) VALUES
(1, 'php', 2),
(2, 'yii2', 3),
(3, 'jquery', 3),
(4, 'html', 1),
(5, 'css', 1),
(6, 'bootstrap', 1),
(7, 'ajax', 1);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_tags_assign`
--

CREATE TABLE `easyii_tags_assign` (
  `class` varchar(128) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_tags_assign`
--

INSERT INTO `easyii_tags_assign` (`class`, `item_id`, `tag_id`) VALUES
('yii\\easyii\\modules\\news\\models\\News', 1, 1),
('yii\\easyii\\modules\\news\\models\\News', 1, 2),
('yii\\easyii\\modules\\news\\models\\News', 1, 3),
('yii\\easyii\\modules\\news\\models\\News', 2, 2),
('yii\\easyii\\modules\\news\\models\\News', 2, 3),
('yii\\easyii\\modules\\news\\models\\News', 2, 4),
('yii\\easyii\\modules\\article\\models\\Item', 1, 1),
('yii\\easyii\\modules\\article\\models\\Item', 1, 5),
('yii\\easyii\\modules\\article\\models\\Item', 1, 6),
('yii\\easyii\\modules\\article\\models\\Item', 2, 2),
('yii\\easyii\\modules\\article\\models\\Item', 2, 3),
('yii\\easyii\\modules\\article\\models\\Item', 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `easyii_texts`
--

CREATE TABLE `easyii_texts` (
  `text_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easyii_texts`
--

INSERT INTO `easyii_texts` (`text_id`, `text`, `slug`) VALUES
(1, 'Welcome on EasyiiCMS demo website', 'index-welcome-title');

-- --------------------------------------------------------

--
-- Table structure for table `last_current_jobs`
--

CREATE TABLE `last_current_jobs` (
  `lastjob_id` int(5) NOT NULL,
  `candidate_id` int(5) DEFAULT NULL,
  `year_join` int(4) DEFAULT NULL,
  `year_left` int(4) DEFAULT NULL,
  `work_at` varchar(250) DEFAULT NULL,
  `work_as_id` int(5) DEFAULT NULL,
  `salary` varchar(64) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `last_current_jobs`
--

INSERT INTO `last_current_jobs` (`lastjob_id`, `candidate_id`, `year_join`, `year_left`, `work_at`, `work_as_id`, `salary`, `time`, `status`) VALUES
(3, 27, 2008, 2016, 'Arcadia communicationn', 4, '{"amount":"2000","unit":"sgd"}', 1504066738, 1),
(6, 28, 2007, 2017, 'BSS Groupp', 4, '{"amount":"88888","unit":"sgd"}', 1504078636, 1),
(7, 29, 2008, 2010, 'BSS Group', 4, '{"amount":"98989","unit":"sgd"}', 1504079114, 1),
(8, 30, 2007, 2017, 'BSS Group', 4, '{"amount":"56546","unit":"sgd"}', 1504079289, 1),
(9, 32, 2008, 2016, 'Arcadia communication', 4, '{"amount":"1000","unit":"sgd"}', 1504153588, 1),
(10, 34, 2008, 2010, 'Arcadia communication', 5, '{"amount":"2000","unit":"sgd"}', 1504156000, 1),
(11, 33, 2008, 2009, 'Arcadia communication', 4, '{"amount":"1000","unit":"sgd"}', 1504156208, 1),
(12, 35, 2008, 2016, 'Arcadia communication', 4, '{"amount":"1500","unit":"usd"}', 1504166316, 1),
(13, 36, 2009, 2010, 'Arcadia communication', 5, '{"amount":"55757","unit":"sgd"}', 1504168556, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nationals`
--

CREATE TABLE `nationals` (
  `national_id` int(4) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `country_code` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nationals`
--

INSERT INTO `nationals` (`national_id`, `title`, `country_code`, `time`, `slug`, `status`) VALUES
(1, 'Singapore', '65', 1503974623, 'singapore', 1),
(2, 'Malaysia', '60', 1503974728, 'malaysia', 1),
(3, 'Indonesia', '62', 1503974745, 'indonesia', 1),
(4, 'Philippines', '63', 1503974760, 'philippines', 1),
(5, 'Thailand', '66', 1503974782, 'thailand', 1),
(6, 'India', '91', 1503974795, 'india', 1),
(7, 'China', '86', 1503974815, 'china', 1),
(8, 'Hong Kong', '852', 1503974830, 'hong-kong', 1),
(9, 'Vietnam', '84', 1503974863, 'vietnam', 1),
(10, 'Laos', '856', 1503974875, 'laos', 1),
(11, 'Cambodia', '855', 1503974880, 'cambodia', 1),
(12, 'Japan', '81', 1503974887, 'japan', 1),
(13, 'South Korea', '82', 1503974899, 'south-korea', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parttime`
--

CREATE TABLE `parttime` (
  `parttime_id` int(5) NOT NULL,
  `candidate_id` int(5) DEFAULT NULL,
  `work_period` varchar(100) DEFAULT NULL,
  `number_hours` int(3) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `end_date` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parttime`
--

INSERT INTO `parttime` (`parttime_id`, `candidate_id`, `work_period`, `number_hours`, `start_date`, `end_date`, `status`) VALUES
(24, 27, 'weekday_night', 6, 1502143200, 1506722400, 1),
(27, 28, 'weekend_day', 4, 1503266400, 1504908000, 1),
(28, 29, 'weekend_day', 3, 1501624800, 1508709600, 1),
(29, 30, 'weekday_night', 1, 1503007200, 1503007200, 1),
(30, 32, 'weekday_day', 4, 1507240800, 1509141600, 1),
(31, 33, 'weekday_night', 3, 1504908000, 1507327200, 1),
(32, 34, 'weekend_day', 4, 1504130400, 1504908000, 1),
(33, 35, '', NULL, 1504130400, 1504130400, 1),
(34, 36, 'weekend_day', 3, 1504130400, 1504908000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `spoken_languages`
--

CREATE TABLE `spoken_languages` (
  `language_id` int(3) NOT NULL,
  `language_name` varchar(250) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spoken_languages`
--

INSERT INTO `spoken_languages` (`language_id`, `language_name`, `time`, `slug`, `status`) VALUES
(1, 'English', 1503975719, 'english', 1),
(2, 'Vietnamese', 1503975703, 'vietnamese', 1),
(3, 'Chinese', 1503975695, 'chinese', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `easyii_admins`
--
ALTER TABLE `easyii_admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `access_token` (`access_token`);

--
-- Indexes for table `easyii_article_categories`
--
ALTER TABLE `easyii_article_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_article_items`
--
ALTER TABLE `easyii_article_items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_carousel`
--
ALTER TABLE `easyii_carousel`
  ADD PRIMARY KEY (`carousel_id`);

--
-- Indexes for table `easyii_catalog_categories`
--
ALTER TABLE `easyii_catalog_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_catalog_items`
--
ALTER TABLE `easyii_catalog_items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_catalog_item_data`
--
ALTER TABLE `easyii_catalog_item_data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `item_id_name` (`item_id`,`name`),
  ADD KEY `value` (`value`(300));

--
-- Indexes for table `easyii_faq`
--
ALTER TABLE `easyii_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `easyii_feedback`
--
ALTER TABLE `easyii_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `easyii_files`
--
ALTER TABLE `easyii_files`
  ADD PRIMARY KEY (`file_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_gallery_categories`
--
ALTER TABLE `easyii_gallery_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_guestbook`
--
ALTER TABLE `easyii_guestbook`
  ADD PRIMARY KEY (`guestbook_id`);

--
-- Indexes for table `easyii_loginform`
--
ALTER TABLE `easyii_loginform`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `easyii_migration`
--
ALTER TABLE `easyii_migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `easyii_modules`
--
ALTER TABLE `easyii_modules`
  ADD PRIMARY KEY (`module_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `easyii_news`
--
ALTER TABLE `easyii_news`
  ADD PRIMARY KEY (`news_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_pages`
--
ALTER TABLE `easyii_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `easyii_photos`
--
ALTER TABLE `easyii_photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `model_item` (`class`,`item_id`);

--
-- Indexes for table `easyii_seotext`
--
ALTER TABLE `easyii_seotext`
  ADD PRIMARY KEY (`seotext_id`),
  ADD UNIQUE KEY `model_item` (`class`,`item_id`);

--
-- Indexes for table `easyii_settings`
--
ALTER TABLE `easyii_settings`
  ADD PRIMARY KEY (`setting_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `easyii_shopcart_goods`
--
ALTER TABLE `easyii_shopcart_goods`
  ADD PRIMARY KEY (`good_id`);

--
-- Indexes for table `easyii_shopcart_orders`
--
ALTER TABLE `easyii_shopcart_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `easyii_subscribe_history`
--
ALTER TABLE `easyii_subscribe_history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `easyii_subscribe_subscribers`
--
ALTER TABLE `easyii_subscribe_subscribers`
  ADD PRIMARY KEY (`subscriber_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `easyii_tags`
--
ALTER TABLE `easyii_tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `easyii_tags_assign`
--
ALTER TABLE `easyii_tags_assign`
  ADD KEY `class` (`class`),
  ADD KEY `item_tag` (`item_id`,`tag_id`);

--
-- Indexes for table `easyii_texts`
--
ALTER TABLE `easyii_texts`
  ADD PRIMARY KEY (`text_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `last_current_jobs`
--
ALTER TABLE `last_current_jobs`
  ADD PRIMARY KEY (`lastjob_id`);

--
-- Indexes for table `nationals`
--
ALTER TABLE `nationals`
  ADD PRIMARY KEY (`national_id`);

--
-- Indexes for table `parttime`
--
ALTER TABLE `parttime`
  ADD PRIMARY KEY (`parttime_id`);

--
-- Indexes for table `spoken_languages`
--
ALTER TABLE `spoken_languages`
  ADD PRIMARY KEY (`language_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `easyii_admins`
--
ALTER TABLE `easyii_admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `easyii_article_categories`
--
ALTER TABLE `easyii_article_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `easyii_article_items`
--
ALTER TABLE `easyii_article_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `easyii_carousel`
--
ALTER TABLE `easyii_carousel`
  MODIFY `carousel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `easyii_catalog_categories`
--
ALTER TABLE `easyii_catalog_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `easyii_catalog_items`
--
ALTER TABLE `easyii_catalog_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `easyii_catalog_item_data`
--
ALTER TABLE `easyii_catalog_item_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `easyii_faq`
--
ALTER TABLE `easyii_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `easyii_feedback`
--
ALTER TABLE `easyii_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `easyii_files`
--
ALTER TABLE `easyii_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `easyii_gallery_categories`
--
ALTER TABLE `easyii_gallery_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `easyii_guestbook`
--
ALTER TABLE `easyii_guestbook`
  MODIFY `guestbook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `easyii_loginform`
--
ALTER TABLE `easyii_loginform`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `easyii_modules`
--
ALTER TABLE `easyii_modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `easyii_news`
--
ALTER TABLE `easyii_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `easyii_pages`
--
ALTER TABLE `easyii_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `easyii_photos`
--
ALTER TABLE `easyii_photos`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `easyii_seotext`
--
ALTER TABLE `easyii_seotext`
  MODIFY `seotext_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `easyii_settings`
--
ALTER TABLE `easyii_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `easyii_shopcart_goods`
--
ALTER TABLE `easyii_shopcart_goods`
  MODIFY `good_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `easyii_shopcart_orders`
--
ALTER TABLE `easyii_shopcart_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `easyii_subscribe_history`
--
ALTER TABLE `easyii_subscribe_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `easyii_subscribe_subscribers`
--
ALTER TABLE `easyii_subscribe_subscribers`
  MODIFY `subscriber_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `easyii_tags`
--
ALTER TABLE `easyii_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `easyii_texts`
--
ALTER TABLE `easyii_texts`
  MODIFY `text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `last_current_jobs`
--
ALTER TABLE `last_current_jobs`
  MODIFY `lastjob_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `nationals`
--
ALTER TABLE `nationals`
  MODIFY `national_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `parttime`
--
ALTER TABLE `parttime`
  MODIFY `parttime_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `spoken_languages`
--
ALTER TABLE `spoken_languages`
  MODIFY `language_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
