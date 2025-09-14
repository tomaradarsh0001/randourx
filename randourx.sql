-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2025 at 10:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `randourx`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `flag`, `name`, `phonecode`, `status`) VALUES
(1, 'AF', NULL, 'Afghanistan', 93, 'Deleted'),
(2, 'AL', NULL, 'Albania', 355, 'Deleted'),
(3, 'DZ', NULL, 'Algeria', 213, 'Deleted'),
(4, 'AS', NULL, 'American Samoa', 1684, 'Deleted'),
(5, 'AD', NULL, 'Andorra', 376, 'Deleted'),
(6, 'AO', NULL, 'Angola', 244, 'Deleted'),
(7, 'AI', NULL, 'Anguilla', 1264, 'Deleted'),
(8, 'AQ', NULL, 'Antarctica', 0, 'Deleted'),
(9, 'AG', NULL, 'Antigua And Barbuda', 1268, 'Deleted'),
(10, 'AR', NULL, 'Argentina', 54, 'Deleted'),
(11, 'AM', NULL, 'Armenia', 374, 'Deleted'),
(12, 'AW', NULL, 'Aruba', 297, 'Deleted'),
(13, 'AU', NULL, 'Australia', 61, 'Active'),
(14, 'AT', NULL, 'Austria', 43, 'Deleted'),
(15, 'AZ', NULL, 'Azerbaijan', 994, 'Deleted'),
(16, 'BS', NULL, 'Bahamas The', 1242, 'Deleted'),
(17, 'BH', NULL, 'Bahrain', 973, 'Deleted'),
(18, 'BD', NULL, 'Bangladesh', 880, 'Active'),
(19, 'BB', NULL, 'Barbados', 1246, 'Deleted'),
(20, 'BY', NULL, 'Belarus', 375, 'Deleted'),
(21, 'BE', NULL, 'Belgium', 32, 'Deleted'),
(22, 'BZ', NULL, 'Belize', 501, 'Deleted'),
(23, 'BJ', NULL, 'Benin', 229, 'Deleted'),
(24, 'BM', NULL, 'Bermuda', 1441, 'Deleted'),
(25, 'BT', NULL, 'Bhutan', 975, 'Deleted'),
(26, 'BO', NULL, 'Bolivia', 591, 'Deleted'),
(27, 'BA', NULL, 'Bosnia and Herzegovina', 387, 'Deleted'),
(28, 'BW', NULL, 'Botswana', 267, 'Deleted'),
(29, 'BV', NULL, 'Bouvet Island', 0, 'Deleted'),
(30, 'BR', NULL, 'Brazil', 55, 'Deleted'),
(31, 'IO', NULL, 'British Indian Ocean Territory', 246, 'Deleted'),
(32, 'BN', NULL, 'Brunei', 673, 'Deleted'),
(33, 'BG', NULL, 'Bulgaria', 359, 'Deleted'),
(34, 'BF', NULL, 'Burkina Faso', 226, 'Deleted'),
(35, 'BI', NULL, 'Burundi', 257, 'Deleted'),
(36, 'KH', NULL, 'Cambodia', 855, 'Active'),
(37, 'CM', NULL, 'Cameroon', 237, 'Deleted'),
(38, 'CA', NULL, 'Canada', 1, 'Active'),
(39, 'CV', NULL, 'Cape Verde', 238, 'Deleted'),
(40, 'KY', NULL, 'Cayman Islands', 1345, 'Deleted'),
(41, 'CF', NULL, 'Central African Republic', 236, 'Deleted'),
(42, 'TD', NULL, 'Chad', 235, 'Deleted'),
(43, 'CL', NULL, 'Chile', 56, 'Active'),
(44, 'CN', NULL, 'China', 86, 'Active'),
(46, 'CC', NULL, 'Cocos (Keeling) Islands', 672, 'Deleted'),
(47, 'CO', NULL, 'Colombia', 57, 'Active'),
(48, 'KM', NULL, 'Comoros', 269, 'Deleted'),
(49, 'CG', NULL, 'Republic Of The Congo', 242, 'Deleted'),
(50, 'CD', NULL, 'Democratic Republic Of The Congo', 242, 'Deleted'),
(51, 'CK', NULL, 'Cook Islands', 682, 'Deleted'),
(52, 'CR', NULL, 'Costa Rica', 506, 'Deleted'),
(53, 'CI', NULL, 'Cote D\'Ivoire (Ivory Coast)', 225, 'Deleted'),
(54, 'HR', NULL, 'Croatia (Hrvatska)', 385, 'Deleted'),
(55, 'CU', NULL, 'Cuba', 53, 'Deleted'),
(56, 'CY', NULL, 'Cyprus', 357, 'Deleted'),
(57, 'CZ', NULL, 'Czech Republic', 420, 'Deleted'),
(58, 'DK', NULL, 'Denmark', 45, 'Deleted'),
(59, 'DJ', NULL, 'Djibouti', 253, 'Deleted'),
(60, 'DM', NULL, 'Dominica', 1767, 'Deleted'),
(61, 'DO', NULL, 'Dominican Republic', 1809, 'Deleted'),
(62, 'TP', NULL, 'East Timor', 670, 'Deleted'),
(63, 'EC', NULL, 'Ecuador', 593, 'Deleted'),
(64, 'EG', NULL, 'Egypt', 20, 'Active'),
(65, 'SV', NULL, 'El Salvador', 503, 'Deleted'),
(66, 'GQ', NULL, 'Equatorial Guinea', 240, 'Deleted'),
(67, 'ER', NULL, 'Eritrea', 291, 'Deleted'),
(68, 'EE', NULL, 'Estonia', 372, 'Deleted'),
(69, 'ET', NULL, 'Ethiopia', 251, 'Deleted'),
(71, 'FK', NULL, 'Falkland Islands', 500, 'Deleted'),
(72, 'FO', NULL, 'Faroe Islands', 298, 'Deleted'),
(73, 'FJ', NULL, 'Fiji Islands', 679, 'Deleted'),
(74, 'FI', NULL, 'Finland', 358, 'Deleted'),
(75, 'FR', NULL, 'France', 33, 'Active'),
(76, 'GF', NULL, 'French Guiana', 594, 'Deleted'),
(77, 'PF', NULL, 'French Polynesia', 689, 'Deleted'),
(78, 'TF', NULL, 'French Southern Territories', 0, 'Deleted'),
(79, 'GA', NULL, 'Gabon', 241, 'Deleted'),
(80, 'GM', NULL, 'Gambia The', 220, 'Deleted'),
(81, 'GE', NULL, 'Georgia', 995, 'Deleted'),
(82, 'DE', NULL, 'Germany', 49, 'Active'),
(83, 'GH', NULL, 'Ghana', 233, 'Active'),
(84, 'GI', NULL, 'Gibraltar', 350, 'Deleted'),
(85, 'GR', NULL, 'Greece', 30, 'Active'),
(86, 'GL', NULL, 'Greenland', 299, 'Deleted'),
(87, 'GD', NULL, 'Grenada', 1473, 'Deleted'),
(88, 'GP', NULL, 'Guadeloupe', 590, 'Deleted'),
(89, 'GU', NULL, 'Guam', 1671, 'Deleted'),
(90, 'GT', NULL, 'Guatemala', 502, 'Deleted'),
(91, 'XU', NULL, 'Guernsey and Alderney', 44, 'Deleted'),
(92, 'GN', NULL, 'Guinea', 224, 'Deleted'),
(93, 'GW', NULL, 'Guinea-Bissau', 245, 'Deleted'),
(94, 'GY', NULL, 'Guyana', 592, 'Deleted'),
(95, 'HT', NULL, 'Haiti', 509, 'Deleted'),
(96, 'HM', NULL, 'Heard and McDonald Islands', 0, 'Deleted'),
(97, 'HN', NULL, 'Honduras', 504, 'Deleted'),
(98, 'HK', NULL, 'Hong Kong S.A.R.', 852, 'Active'),
(99, 'HU', NULL, 'Hungary', 36, 'Active'),
(100, 'IS', NULL, 'Iceland', 354, 'Active'),
(101, 'IN', NULL, 'India', 91, 'Active'),
(102, 'ID', NULL, 'Indonesia', 62, 'Deleted'),
(103, 'IR', NULL, 'Iran', 98, 'Deleted'),
(104, 'IQ', NULL, 'Iraq', 964, 'Deleted'),
(105, 'IE', NULL, 'Ireland', 353, 'Active'),
(106, 'IL', NULL, 'Israel', 972, 'Active'),
(107, 'IT', NULL, 'Italy', 39, 'Active'),
(108, 'JM', NULL, 'Jamaica', 1876, 'Deleted'),
(109, 'JP', NULL, 'Japan', 81, 'Deleted'),
(110, 'XJ', NULL, 'Jersey', 44, 'Deleted'),
(111, 'JO', NULL, 'Jordan', 962, 'Deleted'),
(112, 'KZ', NULL, 'Kazakhstan', 7, 'Deleted'),
(113, 'KE', NULL, 'Kenya', 254, 'Deleted'),
(114, 'KI', NULL, 'Kiribati', 686, 'Deleted'),
(115, 'KP', NULL, 'Korea North', 850, 'Deleted'),
(116, 'KR', NULL, 'Korea South', 82, 'Deleted'),
(117, 'KW', NULL, 'Kuwait', 965, 'Active'),
(118, 'KG', NULL, 'Kyrgyzstan', 996, 'Deleted'),
(119, 'LA', NULL, 'Laos', 856, 'Deleted'),
(120, 'LV', NULL, 'Latvia', 371, 'Deleted'),
(121, 'LB', NULL, 'Lebanon', 961, 'Deleted'),
(122, 'LS', NULL, 'Lesotho', 266, 'Deleted'),
(123, 'LR', NULL, 'Liberia', 231, 'Deleted'),
(124, 'LY', NULL, 'Libya', 218, 'Deleted'),
(125, 'LI', NULL, 'Liechtenstein', 423, 'Deleted'),
(126, 'LT', NULL, 'Lithuania', 370, 'Deleted'),
(127, 'LU', NULL, 'Luxembourg', 352, 'Deleted'),
(128, 'MO', NULL, 'Macau S.A.R.', 853, 'Deleted'),
(129, 'MK', NULL, 'Macedonia', 389, 'Deleted'),
(130, 'MG', NULL, 'Madagascar', 261, 'Deleted'),
(131, 'MW', NULL, 'Malawi', 265, 'Deleted'),
(132, 'MY', NULL, 'Malaysia', 60, 'Active'),
(133, 'MV', NULL, 'Maldives', 960, 'Deleted'),
(134, 'ML', NULL, 'Mali', 223, 'Deleted'),
(135, 'MT', NULL, 'Malta', 356, 'Deleted'),
(136, 'XM', NULL, 'Man (Isle of)', 44, 'Deleted'),
(137, 'MH', NULL, 'Marshall Islands', 692, 'Deleted'),
(138, 'MQ', NULL, 'Martinique', 596, 'Deleted'),
(139, 'MR', NULL, 'Mauritania', 222, 'Active'),
(140, 'MU', NULL, 'Mauritius', 230, 'Active'),
(141, 'YT', NULL, 'Mayotte', 269, 'Active'),
(142, 'MX', NULL, 'Mexico', 52, 'Active'),
(143, 'FM', NULL, 'Micronesia', 691, 'Active'),
(144, 'MD', NULL, 'Moldova', 373, 'Active'),
(145, 'MC', NULL, 'Monaco', 377, 'Active'),
(146, 'MN', NULL, 'Mongolia', 976, 'Active'),
(147, 'MS', NULL, 'Montserrat', 1664, 'Active'),
(148, 'MA', NULL, 'Morocco', 212, 'Active'),
(149, 'MZ', NULL, 'Mozambique', 258, 'Active'),
(150, 'MM', NULL, 'Myanmar', 95, 'Active'),
(151, 'NA', NULL, 'Namibia', 264, 'Active'),
(152, 'NR', NULL, 'Nauru', 674, 'Active'),
(153, 'NP', NULL, 'Nepal', 977, 'Active'),
(154, 'AN', NULL, 'Netherlands Antilles', 599, 'Active'),
(155, 'NL', NULL, 'Netherlands The', 31, 'Active'),
(156, 'NC', NULL, 'New Caledonia', 687, 'Active'),
(157, 'NZ', NULL, 'New Zealand', 64, 'Active'),
(158, 'NI', NULL, 'Nicaragua', 505, 'Active'),
(159, 'NE', NULL, 'Niger', 227, 'Active'),
(160, 'NG', NULL, 'Nigeria', 234, 'Active'),
(161, 'NU', NULL, 'Niue', 683, 'Active'),
(162, 'NF', NULL, 'Norfolk Island', 672, 'Active'),
(163, 'MP', NULL, 'Northern Mariana Islands', 1670, 'Active'),
(164, 'NO', NULL, 'Norway', 47, 'Active'),
(165, 'OM', NULL, 'Oman', 968, 'Active'),
(166, 'PK', NULL, 'Pakistan', 92, 'Active'),
(167, 'PW', NULL, 'Palau', 680, 'Active'),
(168, 'PS', NULL, 'Palestinian Territory Occupied', 970, 'Active'),
(169, 'PA', NULL, 'Panama', 507, 'Active'),
(170, 'PG', NULL, 'Papua new Guinea', 675, 'Active'),
(171, 'PY', NULL, 'Paraguay', 595, 'Active'),
(172, 'PE', NULL, 'Peru', 51, 'Active'),
(173, 'PH', NULL, 'Philippines', 63, 'Active'),
(174, 'PN', NULL, 'Pitcairn Island', 0, 'Active'),
(175, 'PL', NULL, 'Poland', 48, 'Active'),
(176, 'PT', NULL, 'Portugal', 351, 'Active'),
(177, 'PR', NULL, 'Puerto Rico', 1787, 'Active'),
(178, 'QA', NULL, 'Qatar', 974, 'Active'),
(179, 'RE', NULL, 'Reunion', 262, 'Active'),
(180, 'RO', NULL, 'Romania', 40, 'Active'),
(181, 'RU', NULL, 'Russia', 70, 'Active'),
(182, 'RW', NULL, 'Rwanda', 250, 'Active'),
(183, 'SH', NULL, 'Saint Helena', 290, 'Active'),
(184, 'KN', NULL, 'Saint Kitts And Nevis', 1869, 'Active'),
(185, 'LC', NULL, 'Saint Lucia', 1758, 'Active'),
(186, 'PM', NULL, 'Saint Pierre and Miquelon', 508, 'Active'),
(187, 'VC', NULL, 'Saint Vincent And The Grenadines', 1784, 'Active'),
(188, 'WS', NULL, 'Samoa', 684, 'Active'),
(189, 'SM', NULL, 'San Marino', 378, 'Active'),
(190, 'ST', NULL, 'Sao Tome and Principe', 239, 'Active'),
(191, 'SA', NULL, 'Saudi Arabia', 966, 'Active'),
(192, 'SN', NULL, 'Senegal', 221, 'Active'),
(193, 'RS', NULL, 'Serbia', 381, 'Active'),
(194, 'SC', NULL, 'Seychelles', 248, 'Active'),
(195, 'SL', NULL, 'Sierra Leone', 232, 'Active'),
(196, 'SG', NULL, 'Singapore', 65, 'Active'),
(197, 'SK', NULL, 'Slovakia', 421, 'Active'),
(198, 'SI', NULL, 'Slovenia', 386, 'Active'),
(199, 'XG', NULL, 'Smaller Territories of the UK', 44, 'Active'),
(200, 'SB', NULL, 'Solomon Islands', 677, 'Active'),
(201, 'SO', NULL, 'Somalia', 252, 'Active'),
(202, 'ZA', NULL, 'South Africa', 27, 'Active'),
(203, 'GS', NULL, 'South Georgia', 0, 'Active'),
(204, 'SS', NULL, 'South Sudan', 211, 'Active'),
(205, 'ES', NULL, 'Spain', 34, 'Active'),
(206, 'LK', NULL, 'Sri Lanka', 94, 'Active'),
(207, 'SD', NULL, 'Sudan', 249, 'Active'),
(208, 'SR', NULL, 'Suriname', 597, 'Active'),
(209, 'SJ', NULL, 'Svalbard And Jan Mayen Islands', 47, 'Active'),
(210, 'SZ', NULL, 'Swaziland', 268, 'Active'),
(211, 'SE', NULL, 'Sweden', 46, 'Active'),
(212, 'CH', NULL, 'Switzerland', 41, 'Active'),
(213, 'SY', NULL, 'Syria', 963, 'Active'),
(214, 'TW', NULL, 'Taiwan', 886, 'Active'),
(215, 'TJ', NULL, 'Tajikistan', 992, 'Active'),
(216, 'TZ', NULL, 'Tanzania', 255, 'Active'),
(217, 'TH', NULL, 'Thailand', 66, 'Active'),
(218, 'TG', NULL, 'Togo', 228, 'Active'),
(219, 'TK', NULL, 'Tokelau', 690, 'Active'),
(220, 'TO', NULL, 'Tonga', 676, 'Active'),
(221, 'TT', NULL, 'Trinidad And Tobago', 1868, 'Active'),
(222, 'TN', NULL, 'Tunisia', 216, 'Active'),
(223, 'TR', NULL, 'Turkey', 90, 'Active'),
(224, 'TM', NULL, 'Turkmenistan', 7370, 'Active'),
(225, 'TC', NULL, 'Turks And Caicos Islands', 1649, 'Active'),
(226, 'TV', NULL, 'Tuvalu', 688, 'Active'),
(227, 'UG', NULL, 'Uganda', 256, 'Active'),
(228, 'UA', NULL, 'Ukraine', 380, 'Active'),
(229, 'AE', NULL, 'United Arab Emirates', 971, 'Active'),
(230, 'GB', NULL, 'United Kingdom', 44, 'Active'),
(231, 'US', NULL, 'United States', 1, 'Active'),
(232, 'UM', NULL, 'United States Minor Outlying Islands', 1, 'Active'),
(233, 'UY', NULL, 'Uruguay', 598, 'Active'),
(234, 'UZ', NULL, 'Uzbekistan', 998, 'Active'),
(235, 'VU', NULL, 'Vanuatu', 678, 'Active'),
(236, 'VA', NULL, 'Vatican City State (Holy See)', 39, 'Active'),
(237, 'VE', NULL, 'Venezuela', 58, 'Active'),
(238, 'VN', NULL, 'Vietnam', 84, 'Active'),
(239, 'VG', NULL, 'Virgin Islands (British)', 1284, 'Active'),
(240, 'VI', NULL, 'Virgin Islands (US)', 1340, 'Active'),
(241, 'WF', NULL, 'Wallis And Futuna Islands', 681, 'Active'),
(242, 'EH', NULL, 'Western Sahara', 212, 'Active'),
(243, 'YE', NULL, 'Yemen', 967, 'Active'),
(244, 'YU', NULL, 'Yugoslavia', 38, 'Active'),
(245, 'ZM', NULL, 'Zambia', 260, 'Active'),
(246, 'ZW', NULL, 'Zimbabwe', 263, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `country_codes`
--

CREATE TABLE `country_codes` (
  `id` int(11) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_code_name_in_short` varchar(10) NOT NULL,
  `country_code_with_plus` varchar(10) NOT NULL,
  `country_flag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country_codes`
--

INSERT INTO `country_codes` (`id`, `country_code`, `country_name`, `country_code_name_in_short`, `country_code_with_plus`, `country_flag`) VALUES
(1, '+93', 'Afghanistan', 'AF', '+93', 'https://flagcdn.com/w40/af.png'),
(2, '+355', 'Albania', 'AL', '+355', 'https://flagcdn.com/w40/al.png'),
(3, '+213', 'Algeria', 'DZ', '+213', 'https://flagcdn.com/w40/dz.png'),
(4, '+1-684', 'American Samoa', 'AS', '+1-684', 'https://flagcdn.com/w40/as.png'),
(5, '+376', 'Andorra', 'AD', '+376', 'https://flagcdn.com/w40/ad.png'),
(6, '+244', 'Angola', 'AO', '+244', 'https://flagcdn.com/w40/ao.png'),
(7, '+1-264', 'Anguilla', 'AI', '+1-264', 'https://flagcdn.com/w40/ai.png'),
(8, '+672', 'Antarctica', 'AQ', '+672', 'https://flagcdn.com/w40/aq.png'),
(9, '+1-268', 'Antigua and Barbuda', 'AG', '+1-268', 'https://flagcdn.com/w40/ag.png'),
(10, '+54', 'Argentina', 'AR', '+54', 'https://flagcdn.com/w40/ar.png'),
(11, '+374', 'Armenia', 'AM', '+374', 'https://flagcdn.com/w40/am.png'),
(12, '+297', 'Aruba', 'AW', '+297', 'https://flagcdn.com/w40/aw.png'),
(13, '+61', 'Australia', 'AU', '+61', 'https://flagcdn.com/w40/au.png'),
(14, '+43', 'Austria', 'AT', '+43', 'https://flagcdn.com/w40/at.png'),
(15, '+994', 'Azerbaijan', 'AZ', '+994', 'https://flagcdn.com/w40/az.png'),
(16, '+1-242', 'Bahamas', 'BS', '+1-242', 'https://flagcdn.com/w40/bs.png'),
(17, '+973', 'Bahrain', 'BH', '+973', 'https://flagcdn.com/w40/bh.png'),
(18, '+880', 'Bangladesh', 'BD', '+880', 'https://flagcdn.com/w40/bd.png'),
(19, '+1-246', 'Barbados', 'BB', '+1-246', 'https://flagcdn.com/w40/bb.png'),
(20, '+375', 'Belarus', 'BY', '+375', 'https://flagcdn.com/w40/by.png'),
(21, '+32', 'Belgium', 'BE', '+32', 'https://flagcdn.com/w40/be.png'),
(22, '+501', 'Belize', 'BZ', '+501', 'https://flagcdn.com/w40/bz.png'),
(23, '+229', 'Benin', 'BJ', '+229', 'https://flagcdn.com/w40/bj.png'),
(24, '+1-441', 'Bermuda', 'BM', '+1-441', 'https://flagcdn.com/w40/bm.png'),
(25, '+975', 'Bhutan', 'BT', '+975', 'https://flagcdn.com/w40/bt.png'),
(26, '+591', 'Bolivia', 'BO', '+591', 'https://flagcdn.com/w40/bo.png'),
(27, '+387', 'Bosnia and Herzegovina', 'BA', '+387', 'https://flagcdn.com/w40/ba.png'),
(28, '+267', 'Botswana', 'BW', '+267', 'https://flagcdn.com/w40/bw.png'),
(29, '+55', 'Brazil', 'BR', '+55', 'https://flagcdn.com/w40/br.png'),
(30, '+246', 'British Indian Ocean Territory', 'IO', '+246', 'https://flagcdn.com/w40/io.png'),
(31, '+673', 'Brunei', 'BN', '+673', 'https://flagcdn.com/w40/bn.png'),
(32, '+359', 'Bulgaria', 'BG', '+359', 'https://flagcdn.com/w40/bg.png'),
(33, '+226', 'Burkina Faso', 'BF', '+226', 'https://flagcdn.com/w40/bf.png'),
(34, '+257', 'Burundi', 'BI', '+257', 'https://flagcdn.com/w40/bi.png'),
(35, '+855', 'Cambodia', 'KH', '+855', 'https://flagcdn.com/w40/kh.png'),
(36, '+237', 'Cameroon', 'CM', '+237', 'https://flagcdn.com/w40/cm.png'),
(37, '+1', 'Canada', 'CA', '+1', 'https://flagcdn.com/w40/ca.png'),
(38, '+238', 'Cape Verde', 'CV', '+238', 'https://flagcdn.com/w40/cv.png'),
(39, '+1-345', 'Cayman Islands', 'KY', '+1-345', 'https://flagcdn.com/w40/ky.png'),
(40, '+236', 'Central African Republic', 'CF', '+236', 'https://flagcdn.com/w40/cf.png'),
(41, '+235', 'Chad', 'TD', '+235', 'https://flagcdn.com/w40/td.png'),
(42, '+56', 'Chile', 'CL', '+56', 'https://flagcdn.com/w40/cl.png'),
(43, '+86', 'China', 'CN', '+86', 'https://flagcdn.com/w40/cn.png'),
(44, '+57', 'Colombia', 'CO', '+57', 'https://flagcdn.com/w40/co.png'),
(45, '+269', 'Comoros', 'KM', '+269', 'https://flagcdn.com/w40/km.png'),
(46, '+243', 'Congo (DRC)', 'CD', '+243', 'https://flagcdn.com/w40/cd.png'),
(47, '+242', 'Congo (Republic)', 'CG', '+242', 'https://flagcdn.com/w40/cg.png'),
(48, '+682', 'Cook Islands', 'CK', '+682', 'https://flagcdn.com/w40/ck.png'),
(49, '+506', 'Costa Rica', 'CR', '+506', 'https://flagcdn.com/w40/cr.png'),
(50, '+385', 'Croatia', 'HR', '+385', 'https://flagcdn.com/w40/hr.png'),
(51, '+53', 'Cuba', 'CU', '+53', 'https://flagcdn.com/w40/cu.png'),
(52, '+599', 'Curaçao', 'CW', '+599', 'https://flagcdn.com/w40/cw.png'),
(53, '+357', 'Cyprus', 'CY', '+357', 'https://flagcdn.com/w40/cy.png'),
(54, '+420', 'Czech Republic', 'CZ', '+420', 'https://flagcdn.com/w40/cz.png'),
(55, '+45', 'Denmark', 'DK', '+45', 'https://flagcdn.com/w40/dk.png'),
(56, '+253', 'Djibouti', 'DJ', '+253', 'https://flagcdn.com/w40/dj.png'),
(57, '+1-767', 'Dominica', 'DM', '+1-767', 'https://flagcdn.com/w40/dm.png'),
(58, '+1-809', 'Dominican Republic', 'DO', '+1-809', 'https://flagcdn.com/w40/do.png'),
(59, '+20', 'Egypt', 'EG', '+20', 'https://flagcdn.com/w40/eg.png'),
(60, '+503', 'El Salvador', 'SV', '+503', 'https://flagcdn.com/w40/sv.png'),
(61, '+240', 'Equatorial Guinea', 'GQ', '+240', 'https://flagcdn.com/w40/gq.png'),
(62, '+291', 'Eritrea', 'ER', '+291', 'https://flagcdn.com/w40/er.png'),
(63, '+372', 'Estonia', 'EE', '+372', 'https://flagcdn.com/w40/ee.png'),
(64, '+251', 'Ethiopia', 'ET', '+251', 'https://flagcdn.com/w40/et.png'),
(65, '+500', 'Falkland Islands', 'FK', '+500', 'https://flagcdn.com/w40/fk.png'),
(66, '+298', 'Faroe Islands', 'FO', '+298', 'https://flagcdn.com/w40/fo.png'),
(67, '+679', 'Fiji', 'FJ', '+679', 'https://flagcdn.com/w40/fj.png'),
(68, '+358', 'Finland', 'FI', '+358', 'https://flagcdn.com/w40/fi.png'),
(69, '+33', 'France', 'FR', '+33', 'https://flagcdn.com/w40/fr.png'),
(70, '+594', 'French Guiana', 'GF', '+594', 'https://flagcdn.com/w40/gf.png'),
(71, '+689', 'French Polynesia', 'PF', '+689', 'https://flagcdn.com/w40/pf.png'),
(72, '+241', 'Gabon', 'GA', '+241', 'https://flagcdn.com/w40/ga.png'),
(73, '+220', 'Gambia', 'GM', '+220', 'https://flagcdn.com/w40/gm.png'),
(74, '+995', 'Georgia', 'GE', '+995', 'https://flagcdn.com/w40/ge.png'),
(75, '+49', 'Germany', 'DE', '+49', 'https://flagcdn.com/w40/de.png'),
(76, '+233', 'Ghana', 'GH', '+233', 'https://flagcdn.com/w40/gh.png'),
(77, '+350', 'Gibraltar', 'GI', '+350', 'https://flagcdn.com/w40/gi.png'),
(78, '+30', 'Greece', 'GR', '+30', 'https://flagcdn.com/w40/gr.png'),
(79, '+299', 'Greenland', 'GL', '+299', 'https://flagcdn.com/w40/gl.png'),
(80, '+1-473', 'Grenada', 'GD', '+1-473', 'https://flagcdn.com/w40/gd.png'),
(81, '+590', 'Guadeloupe', 'GP', '+590', 'https://flagcdn.com/w40/gp.png'),
(82, '+1-671', 'Guam', 'GU', '+1-671', 'https://flagcdn.com/w40/gu.png'),
(83, '+502', 'Guatemala', 'GT', '+502', 'https://flagcdn.com/w40/gt.png'),
(84, '+44-1481', 'Guernsey', 'GG', '+44-1481', 'https://flagcdn.com/w40/gg.png'),
(85, '+224', 'Guinea', 'GN', '+224', 'https://flagcdn.com/w40/gn.png'),
(86, '+245', 'Guinea-Bissau', 'GW', '+245', 'https://flagcdn.com/w40/gw.png'),
(87, '+592', 'Guyana', 'GY', '+592', 'https://flagcdn.com/w40/gy.png'),
(88, '+509', 'Haiti', 'HT', '+509', 'https://flagcdn.com/w40/ht.png'),
(89, '+504', 'Honduras', 'HN', '+504', 'https://flagcdn.com/w40/hn.png'),
(90, '+852', 'Hong Kong', 'HK', '+852', 'https://flagcdn.com/w40/hk.png'),
(91, '+36', 'Hungary', 'HU', '+36', 'https://flagcdn.com/w40/hu.png'),
(92, '+354', 'Iceland', 'IS', '+354', 'https://flagcdn.com/w40/is.png'),
(93, '+91', 'India', 'IN', '+91', 'https://flagcdn.com/w40/in.png'),
(94, '+62', 'Indonesia', 'ID', '+62', 'https://flagcdn.com/w40/id.png'),
(95, '+98', 'Iran', 'IR', '+98', 'https://flagcdn.com/w40/ir.png'),
(96, '+964', 'Iraq', 'IQ', '+964', 'https://flagcdn.com/w40/iq.png'),
(97, '+353', 'Ireland', 'IE', '+353', 'https://flagcdn.com/w40/ie.png'),
(98, '+44-1624', 'Isle of Man', 'IM', '+44-1624', 'https://flagcdn.com/w40/im.png'),
(99, '+972', 'Israel', 'IL', '+972', 'https://flagcdn.com/w40/il.png'),
(100, '+39', 'Italy', 'IT', '+39', 'https://flagcdn.com/w40/it.png'),
(101, '+1-876', 'Jamaica', 'JM', '+1-876', 'https://flagcdn.com/w40/jm.png'),
(102, '+81', 'Japan', 'JP', '+81', 'https://flagcdn.com/w40/jp.png'),
(103, '+44-1534', 'Jersey', 'JE', '+44-1534', 'https://flagcdn.com/w40/je.png'),
(104, '+962', 'Jordan', 'JO', '+962', 'https://flagcdn.com/w40/jo.png'),
(105, '+7', 'Kazakhstan', 'KZ', '+7', 'https://flagcdn.com/w40/kz.png'),
(106, '+254', 'Kenya', 'KE', '+254', 'https://flagcdn.com/w40/ke.png'),
(107, '+686', 'Kiribati', 'KI', '+686', 'https://flagcdn.com/w40/ki.png'),
(108, '+383', 'Kosovo', 'XK', '+383', 'https://flagcdn.com/w40/xk.png'),
(109, '+965', 'Kuwait', 'KW', '+965', 'https://flagcdn.com/w40/kw.png'),
(110, '+996', 'Kyrgyzstan', 'KG', '+996', 'https://flagcdn.com/w40/kg.png'),
(111, '+856', 'Laos', 'LA', '+856', 'https://flagcdn.com/w40/la.png'),
(112, '+371', 'Latvia', 'LV', '+371', 'https://flagcdn.com/w40/lv.png'),
(113, '+961', 'Lebanon', 'LB', '+961', 'https://flagcdn.com/w40/lb.png'),
(114, '+266', 'Lesotho', 'LS', '+266', 'https://flagcdn.com/w40/ls.png'),
(115, '+231', 'Liberia', 'LR', '+231', 'https://flagcdn.com/w40/lr.png'),
(116, '+218', 'Libya', 'LY', '+218', 'https://flagcdn.com/w40/ly.png'),
(117, '+423', 'Liechtenstein', 'LI', '+423', 'https://flagcdn.com/w40/li.png'),
(118, '+370', 'Lithuania', 'LT', '+370', 'https://flagcdn.com/w40/lt.png'),
(119, '+352', 'Luxembourg', 'LU', '+352', 'https://flagcdn.com/w40/lu.png'),
(120, '+853', 'Macau', 'MO', '+853', 'https://flagcdn.com/w40/mo.png'),
(121, '+389', 'North Macedonia', 'MK', '+389', 'https://flagcdn.com/w40/mk.png'),
(122, '+261', 'Madagascar', 'MG', '+261', 'https://flagcdn.com/w40/mg.png'),
(123, '+265', 'Malawi', 'MW', '+265', 'https://flagcdn.com/w40/mw.png'),
(124, '+60', 'Malaysia', 'MY', '+60', 'https://flagcdn.com/w40/my.png'),
(125, '+960', 'Maldives', 'MV', '+960', 'https://flagcdn.com/w40/mv.png'),
(126, '+223', 'Mali', 'ML', '+223', 'https://flagcdn.com/w40/ml.png'),
(127, '+356', 'Malta', 'MT', '+356', 'https://flagcdn.com/w40/mt.png'),
(128, '+692', 'Marshall Islands', 'MH', '+692', 'https://flagcdn.com/w40/mh.png'),
(129, '+596', 'Martinique', 'MQ', '+596', 'https://flagcdn.com/w40/mq.png'),
(130, '+222', 'Mauritania', 'MR', '+222', 'https://flagcdn.com/w40/mr.png'),
(131, '+230', 'Mauritius', 'MU', '+230', 'https://flagcdn.com/w40/mu.png'),
(132, '+52', 'Mexico', 'MX', '+52', 'https://flagcdn.com/w40/mx.png'),
(133, '+691', 'Micronesia', 'FM', '+691', 'https://flagcdn.com/w40/fm.png'),
(134, '+373', 'Moldova', 'MD', '+373', 'https://flagcdn.com/w40/md.png'),
(135, '+377', 'Monaco', 'MC', '+377', 'https://flagcdn.com/w40/mc.png'),
(136, '+976', 'Mongolia', 'MN', '+976', 'https://flagcdn.com/w40/mn.png'),
(137, '+382', 'Montenegro', 'ME', '+382', 'https://flagcdn.com/w40/me.png'),
(138, '+1-664', 'Montserrat', 'MS', '+1-664', 'https://flagcdn.com/w40/ms.png'),
(139, '+212', 'Morocco', 'MA', '+212', 'https://flagcdn.com/w40/ma.png'),
(140, '+258', 'Mozambique', 'MZ', '+258', 'https://flagcdn.com/w40/mz.png'),
(141, '+95', 'Myanmar', 'MM', '+95', 'https://flagcdn.com/w40/mm.png'),
(142, '+264', 'Namibia', 'NA', '+264', 'https://flagcdn.com/w40/na.png'),
(143, '+674', 'Nauru', 'NR', '+674', 'https://flagcdn.com/w40/nr.png'),
(144, '+977', 'Nepal', 'NP', '+977', 'https://flagcdn.com/w40/np.png'),
(145, '+31', 'Netherlands', 'NL', '+31', 'https://flagcdn.com/w40/nl.png'),
(146, '+687', 'New Caledonia', 'NC', '+687', 'https://flagcdn.com/w40/nc.png'),
(147, '+64', 'New Zealand', 'NZ', '+64', 'https://flagcdn.com/w40/nz.png'),
(148, '+505', 'Nicaragua', 'NI', '+505', 'https://flagcdn.com/w40/ni.png'),
(149, '+227', 'Niger', 'NE', '+227', 'https://flagcdn.com/w40/ne.png'),
(150, '+234', 'Nigeria', 'NG', '+234', 'https://flagcdn.com/w40/ng.png'),
(151, '+683', 'Niue', 'NU', '+683', 'https://flagcdn.com/w40/nu.png'),
(152, '+850', 'North Korea', 'KP', '+850', 'https://flagcdn.com/w40/kp.png'),
(153, '+47', 'Norway', 'NO', '+47', 'https://flagcdn.com/w40/no.png'),
(154, '+968', 'Oman', 'OM', '+968', 'https://flagcdn.com/w40/om.png'),
(155, '+92', 'Pakistan', 'PK', '+92', 'https://flagcdn.com/w40/pk.png'),
(156, '+680', 'Palau', 'PW', '+680', 'https://flagcdn.com/w40/pw.png'),
(157, '+507', 'Panama', 'PA', '+507', 'https://flagcdn.com/w40/pa.png'),
(158, '+595', 'Paraguay', 'PY', '+595', 'https://flagcdn.com/w40/py.png'),
(159, '+51', 'Peru', 'PE', '+51', 'https://flagcdn.com/w40/pe.png'),
(160, '+63', 'Philippines', 'PH', '+63', 'https://flagcdn.com/w40/ph.png'),
(161, '+48', 'Poland', 'PL', '+48', 'https://flagcdn.com/w40/pl.png'),
(162, '+351', 'Portugal', 'PT', '+351', 'https://flagcdn.com/w40/pt.png'),
(163, '+974', 'Qatar', 'QA', '+974', 'https://flagcdn.com/w40/qa.png'),
(164, '+40', 'Romania', 'RO', '+40', 'https://flagcdn.com/w40/ro.png'),
(165, '+7', 'Russia', 'RU', '+7', 'https://flagcdn.com/w40/ru.png'),
(166, '+250', 'Rwanda', 'RW', '+250', 'https://flagcdn.com/w40/rw.png'),
(167, '+966', 'Saudi Arabia', 'SA', '+966', 'https://flagcdn.com/w40/sa.png'),
(168, '+221', 'Senegal', 'SN', '+221', 'https://flagcdn.com/w40/sn.png'),
(169, '+381', 'Serbia', 'RS', '+381', 'https://flagcdn.com/w40/rs.png'),
(170, '+248', 'Seychelles', 'SC', '+248', 'https://flagcdn.com/w40/sc.png'),
(171, '+232', 'Sierra Leone', 'SL', '+232', 'https://flagcdn.com/w40/sl.png'),
(172, '+65', 'Singapore', 'SG', '+65', 'https://flagcdn.com/w40/sg.png'),
(173, '+421', 'Slovakia', 'SK', '+421', 'https://flagcdn.com/w40/sk.png'),
(174, '+386', 'Slovenia', 'SI', '+386', 'https://flagcdn.com/w40/si.png'),
(175, '+677', 'Solomon Islands', 'SB', '+677', 'https://flagcdn.com/w40/sb.png'),
(176, '+27', 'South Africa', 'ZA', '+27', 'https://flagcdn.com/w40/za.png'),
(177, '+82', 'South Korea', 'KR', '+82', 'https://flagcdn.com/w40/kr.png'),
(178, '+211', 'South Sudan', 'SS', '+211', 'https://flagcdn.com/w40/ss.png'),
(179, '+34', 'Spain', 'ES', '+34', 'https://flagcdn.com/w40/es.png'),
(180, '+94', 'Sri Lanka', 'LK', '+94', 'https://flagcdn.com/w40/lk.png'),
(181, '+249', 'Sudan', 'SD', '+249', 'https://flagcdn.com/w40/sd.png'),
(182, '+597', 'Suriname', 'SR', '+597', 'https://flagcdn.com/w40/sr.png'),
(183, '+268', 'Eswatini', 'SZ', '+268', 'https://flagcdn.com/w40/sz.png'),
(184, '+46', 'Sweden', 'SE', '+46', 'https://flagcdn.com/w40/se.png'),
(185, '+41', 'Switzerland', 'CH', '+41', 'https://flagcdn.com/w40/ch.png'),
(186, '+963', 'Syria', 'SY', '+963', 'https://flagcdn.com/w40/sy.png'),
(187, '+992', 'Tajikistan', 'TJ', '+992', 'https://flagcdn.com/w40/tj.png'),
(188, '+255', 'Tanzania', 'TZ', '+255', 'https://flagcdn.com/w40/tz.png'),
(189, '+66', 'Thailand', 'TH', '+66', 'https://flagcdn.com/w40/th.png'),
(190, '+228', 'Togo', 'TG', '+228', 'https://flagcdn.com/w40/tg.png'),
(191, '+676', 'Tonga', 'TO', '+676', 'https://flagcdn.com/w40/to.png'),
(192, '+216', 'Tunisia', 'TN', '+216', 'https://flagcdn.com/w40/tn.png'),
(193, '+90', 'Turkey', 'TR', '+90', 'https://flagcdn.com/w40/tr.png'),
(194, '+993', 'Turkmenistan', 'TM', '+993', 'https://flagcdn.com/w40/tm.png'),
(195, '+688', 'Tuvalu', 'TV', '+688', 'https://flagcdn.com/w40/tv.png'),
(196, '+256', 'Uganda', 'UG', '+256', 'https://flagcdn.com/w40/ug.png'),
(197, '+380', 'Ukraine', 'UA', '+380', 'https://flagcdn.com/w40/ua.png'),
(198, '+971', 'United Arab Emirates', 'AE', '+971', 'https://flagcdn.com/w40/ae.png'),
(199, '+44', 'United Kingdom', 'GB', '+44', 'https://flagcdn.com/w40/gb.png'),
(200, '+1', 'United States', 'US', '+1', 'https://flagcdn.com/w40/us.png'),
(201, '+598', 'Uruguay', 'UY', '+598', 'https://flagcdn.com/w40/uy.png'),
(202, '+998', 'Uzbekistan', 'UZ', '+998', 'https://flagcdn.com/w40/uz.png'),
(203, '+678', 'Vanuatu', 'VU', '+678', 'https://flagcdn.com/w40/vu.png'),
(204, '+58', 'Venezuela', 'VE', '+58', 'https://flagcdn.com/w40/ve.png'),
(205, '+84', 'Vietnam', 'VN', '+84', 'https://flagcdn.com/w40/vn.png'),
(206, '+967', 'Yemen', 'YE', '+967', 'https://flagcdn.com/w40/ye.png'),
(207, '+260', 'Zambia', 'ZM', '+260', 'https://flagcdn.com/w40/zm.png'),
(208, '+263', 'Zimbabwe', 'ZW', '+263', 'https://flagcdn.com/w40/zw.png');

-- --------------------------------------------------------

--
-- Table structure for table `downlines`
--

CREATE TABLE `downlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ancestor_id` bigint(20) UNSIGNED NOT NULL,
  `descendant_id` bigint(20) UNSIGNED NOT NULL,
  `depth` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `downlines`
--

INSERT INTO `downlines` (`id`, `ancestor_id`, `descendant_id`, `depth`, `created_at`, `updated_at`) VALUES
(1, 11, 11, 0, '2025-09-14 08:06:09', '2025-09-14 08:06:09'),
(2, 12, 12, 0, '2025-09-14 08:07:40', '2025-09-14 08:07:40'),
(3, 11, 12, 1, '2025-09-14 08:07:40', '2025-09-14 08:07:40'),
(4, 13, 13, 0, '2025-09-14 08:08:52', '2025-09-14 08:08:52'),
(5, 12, 13, 1, '2025-09-14 08:08:52', '2025-09-14 08:08:52'),
(6, 11, 13, 2, '2025-09-14 08:08:52', '2025-09-14 08:08:52'),
(7, 14, 14, 0, '2025-09-14 08:11:57', '2025-09-14 08:11:57'),
(8, 13, 14, 1, '2025-09-14 08:11:57', '2025-09-14 08:11:57'),
(9, 12, 14, 2, '2025-09-14 08:11:57', '2025-09-14 08:11:57'),
(10, 11, 14, 3, '2025-09-14 08:11:57', '2025-09-14 08:11:57'),
(11, 15, 15, 0, '2025-09-14 14:16:31', '2025-09-14 14:16:31'),
(12, 11, 15, 1, '2025-09-14 14:16:31', '2025-09-14 14:16:31'),
(13, 16, 16, 0, '2025-09-14 14:18:34', '2025-09-14 14:18:34'),
(14, 15, 16, 1, '2025-09-14 14:18:34', '2025-09-14 14:18:34'),
(15, 11, 16, 2, '2025-09-14 14:18:34', '2025-09-14 14:18:34'),
(16, 17, 17, 0, '2025-09-14 14:19:18', '2025-09-14 14:19:18'),
(17, 16, 17, 1, '2025-09-14 14:19:18', '2025-09-14 14:19:18'),
(18, 15, 17, 2, '2025-09-14 14:19:18', '2025-09-14 14:19:18'),
(19, 11, 17, 3, '2025-09-14 14:19:18', '2025-09-14 14:19:18'),
(20, 18, 18, 0, '2025-09-14 14:49:45', '2025-09-14 14:49:45'),
(21, 11, 18, 1, '2025-09-14 14:49:45', '2025-09-14 14:49:45'),
(22, 19, 19, 0, '2025-09-14 14:50:38', '2025-09-14 14:50:38'),
(23, 18, 19, 1, '2025-09-14 14:50:38', '2025-09-14 14:50:38'),
(24, 11, 19, 2, '2025-09-14 14:50:38', '2025-09-14 14:50:38'),
(25, 20, 20, 0, '2025-09-14 14:51:33', '2025-09-14 14:51:33'),
(26, 19, 20, 1, '2025-09-14 14:51:33', '2025-09-14 14:51:33'),
(27, 18, 20, 2, '2025-09-14 14:51:33', '2025-09-14 14:51:33'),
(28, 11, 20, 3, '2025-09-14 14:51:33', '2025-09-14 14:51:33'),
(29, 21, 21, 0, '2025-09-14 14:52:16', '2025-09-14 14:52:16'),
(30, 20, 21, 1, '2025-09-14 14:52:16', '2025-09-14 14:52:16'),
(31, 19, 21, 2, '2025-09-14 14:52:16', '2025-09-14 14:52:16'),
(32, 18, 21, 3, '2025-09-14 14:52:16', '2025-09-14 14:52:16'),
(33, 11, 21, 4, '2025-09-14 14:52:16', '2025-09-14 14:52:16'),
(34, 22, 22, 0, '2025-09-14 14:53:36', '2025-09-14 14:53:36'),
(35, 21, 22, 1, '2025-09-14 14:53:36', '2025-09-14 14:53:36'),
(36, 20, 22, 2, '2025-09-14 14:53:36', '2025-09-14 14:53:36'),
(37, 19, 22, 3, '2025-09-14 14:53:36', '2025-09-14 14:53:36'),
(38, 18, 22, 4, '2025-09-14 14:53:36', '2025-09-14 14:53:36'),
(39, 11, 22, 5, '2025-09-14 14:53:36', '2025-09-14 14:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_12_184043_add_wallets_and_incomes_to_users_table', 2),
(6, '2025_09_12_185327_add_is_admin_to_users_table', 3),
(9, '2025_09_12_220956_create_roi_rates_table', 4),
(10, '2025_09_13_121204_create_roi_incomes_table', 5),
(11, '2025_09_13_125400_create_user_purchases_table', 6),
(12, '2025_09_14_132618_add_sponsor_id_to_users_table', 7),
(13, '2025_09_14_133018_create_downlines_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roi_incomes`
--

CREATE TABLE `roi_incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `from_admin` tinyint(1) NOT NULL DEFAULT 1,
  `wallet_value` decimal(15,2) NOT NULL,
  `roi_bonus` decimal(15,2) NOT NULL,
  `timing` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roi_incomes`
--

INSERT INTO `roi_incomes` (`id`, `user_id`, `from_admin`, `wallet_value`, `roi_bonus`, `timing`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 100.00, 1.84, '2025-09-13 12:13:43', '2025-09-13 06:43:43', '2025-09-13 06:43:43'),
(2, 5, 1, 100.00, 2.25, '2025-09-13 12:16:11', '2025-09-13 06:46:11', '2025-09-13 06:46:11'),
(3, 6, 1, 70.00, 1.58, '2025-09-13 12:16:11', '2025-09-13 06:46:11', '2025-09-13 06:46:11'),
(4, 5, 1, 100.00, 2.25, '2025-09-13 12:23:50', '2025-09-13 06:53:50', '2025-09-13 06:53:50'),
(5, 6, 1, 70.00, 1.58, '2025-09-13 12:23:50', '2025-09-13 06:53:50', '2025-09-13 06:53:50'),
(6, 5, 1, 200.00, 4.50, '2025-09-13 13:30:24', '2025-09-13 08:00:24', '2025-09-13 08:00:24'),
(7, 6, 1, 70.00, 1.58, '2025-09-13 13:30:25', '2025-09-13 08:00:25', '2025-09-13 08:00:25'),
(8, 5, 1, 200.00, 4.00, '2025-09-13 13:31:34', '2025-09-13 08:01:34', '2025-09-13 08:01:34'),
(9, 6, 1, 70.00, 1.40, '2025-09-13 13:31:34', '2025-09-13 08:01:34', '2025-09-13 08:01:34'),
(10, 7, 1, 340.00, 6.80, '2025-09-13 13:31:34', '2025-09-13 08:01:34', '2025-09-13 08:01:34'),
(11, 8, 1, 100.00, 2.00, '2025-09-13 13:31:34', '2025-09-13 08:01:34', '2025-09-13 08:01:34'),
(12, 9, 1, 210.00, 4.20, '2025-09-13 13:31:34', '2025-09-13 08:01:34', '2025-09-13 08:01:34'),
(13, 5, 1, 200.00, 4.00, '2025-09-13 13:31:38', '2025-09-13 08:01:38', '2025-09-13 08:01:38'),
(14, 6, 1, 70.00, 1.40, '2025-09-13 13:31:38', '2025-09-13 08:01:38', '2025-09-13 08:01:38'),
(15, 7, 1, 340.00, 6.80, '2025-09-13 13:31:38', '2025-09-13 08:01:38', '2025-09-13 08:01:38'),
(16, 8, 1, 100.00, 2.00, '2025-09-13 13:31:39', '2025-09-13 08:01:39', '2025-09-13 08:01:39'),
(17, 9, 1, 210.00, 4.20, '2025-09-13 13:31:39', '2025-09-13 08:01:39', '2025-09-13 08:01:39'),
(18, 5, 1, 200.00, 4.00, '2025-09-13 13:31:42', '2025-09-13 08:01:42', '2025-09-13 08:01:42'),
(19, 6, 1, 70.00, 1.40, '2025-09-13 13:31:42', '2025-09-13 08:01:42', '2025-09-13 08:01:42'),
(20, 7, 1, 340.00, 6.80, '2025-09-13 13:31:42', '2025-09-13 08:01:42', '2025-09-13 08:01:42'),
(21, 8, 1, 100.00, 2.00, '2025-09-13 13:31:42', '2025-09-13 08:01:42', '2025-09-13 08:01:42'),
(22, 9, 1, 210.00, 4.20, '2025-09-13 13:31:42', '2025-09-13 08:01:42', '2025-09-13 08:01:42'),
(23, 5, 1, 200.00, 4.00, '2025-09-13 13:31:45', '2025-09-13 08:01:45', '2025-09-13 08:01:45'),
(24, 6, 1, 70.00, 1.40, '2025-09-13 13:31:45', '2025-09-13 08:01:45', '2025-09-13 08:01:45'),
(25, 7, 1, 340.00, 6.80, '2025-09-13 13:31:45', '2025-09-13 08:01:45', '2025-09-13 08:01:45'),
(26, 8, 1, 100.00, 2.00, '2025-09-13 13:31:45', '2025-09-13 08:01:45', '2025-09-13 08:01:45'),
(27, 9, 1, 210.00, 4.20, '2025-09-13 13:31:45', '2025-09-13 08:01:45', '2025-09-13 08:01:45'),
(28, 5, 1, 200.00, 6.80, '2025-09-13 13:31:58', '2025-09-13 08:01:58', '2025-09-13 08:01:58'),
(29, 6, 1, 70.00, 2.38, '2025-09-13 13:31:58', '2025-09-13 08:01:58', '2025-09-13 08:01:58'),
(30, 7, 1, 340.00, 11.56, '2025-09-13 13:31:58', '2025-09-13 08:01:58', '2025-09-13 08:01:58'),
(31, 8, 1, 100.00, 3.40, '2025-09-13 13:31:58', '2025-09-13 08:01:58', '2025-09-13 08:01:58'),
(32, 9, 1, 210.00, 7.14, '2025-09-13 13:31:58', '2025-09-13 08:01:58', '2025-09-13 08:01:58'),
(33, 5, 1, 200.00, 6.80, '2025-09-13 13:32:01', '2025-09-13 08:02:01', '2025-09-13 08:02:01'),
(34, 6, 1, 70.00, 2.38, '2025-09-13 13:32:01', '2025-09-13 08:02:01', '2025-09-13 08:02:01'),
(35, 7, 1, 340.00, 11.56, '2025-09-13 13:32:01', '2025-09-13 08:02:01', '2025-09-13 08:02:01'),
(36, 8, 1, 100.00, 3.40, '2025-09-13 13:32:01', '2025-09-13 08:02:01', '2025-09-13 08:02:01'),
(37, 9, 1, 210.00, 7.14, '2025-09-13 13:32:02', '2025-09-13 08:02:02', '2025-09-13 08:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `roi_rates`
--

CREATE TABLE `roi_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roi_rates`
--

INSERT INTO `roi_rates` (`id`, `rate`, `created_at`, `updated_at`) VALUES
(1, 3.40, '2025-09-13 04:30:00', '2025-09-13 08:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sponsor_username` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wallet1` decimal(15,2) NOT NULL DEFAULT 0.00,
  `wallet2` decimal(15,2) NOT NULL DEFAULT 0.00,
  `wallet3` decimal(15,2) NOT NULL DEFAULT 0.00,
  `wallet4` decimal(15,2) NOT NULL DEFAULT 0.00,
  `income1` decimal(15,2) NOT NULL DEFAULT 0.00,
  `income2` decimal(15,2) NOT NULL DEFAULT 0.00,
  `income3` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sponsor_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sponsor_username`, `username`, `full_name`, `country_code`, `mobile`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`, `wallet1`, `wallet2`, `wallet3`, `wallet4`, `income1`, `income2`, `income3`, `sponsor_id`) VALUES
(4, 'RX62384', 'RX54851', 'Harsh', '+91', '9911550920', 'harsh@gmail.com', NULL, '$2y$12$OIbpeo.3BKCORvrG81iOGe927iHP2xXQDV8KOrsbR8QBhHo3wYlcO', 0, NULL, '2025-09-12 23:09:34', '2025-09-12 23:09:34', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL),
(5, 'RX54851', 'RX33169', 'Adarsh Tomar', '+91', '7011864373', 'adarsh@gmail.com', NULL, '$2y$12$YF0QQr2cFzke/UhSkdzuduBFxzVWaIsSR7w8j9z5TFLgCAgv22Y7a', 1, NULL, '2025-09-12 23:21:19', '2025-09-13 08:02:01', 90.00, 51.44, 200.00, 0.00, 36.35, 0.00, 0.00, NULL),
(6, 'RX33169', 'RX17404', 'Rahul', '+91', '8882824199', 'rahul@gmail.com', NULL, '$2y$12$.iKJiQQY4fHHBL3aN6hageXka6F63Q2WnTwlt1kNZJbj9dhCJD6oq', 0, NULL, '2025-09-13 06:45:04', '2025-09-13 08:02:01', 0.00, 15.10, 70.00, 0.00, 13.52, 0.00, 0.00, NULL),
(7, 'RX17404', 'RX12620', 'Yogesh kapadia', '+91', '7053152217', 'kapadia.yogesh@gmail.com', NULL, '$2y$12$nNu8QzYn8s4ugoelM8fhJeAhSH3GNN8qKxcKncFArNY/XIrHlMQQe', 0, NULL, '2025-09-13 07:56:41', '2025-09-13 08:17:45', 120.00, 50.32, 340.00, 0.00, 50.32, 0.00, 0.00, NULL),
(8, 'RX17404', 'RX67943', 'Vishu', '+91', '84476756754', 'vishu@gmail.com', NULL, '$2y$12$EmYgpSiQV76AVAUz7oMBs.LvJvqUmqIYtF1nqzGJaDJsqRbJLq8my', 0, NULL, '2025-09-13 07:57:55', '2025-09-13 08:02:01', 0.00, 14.80, 100.00, 0.00, 14.80, 0.00, 0.00, NULL),
(9, 'RX67943', 'RX26290', 'Kamal', '+91', '23432432432', 'kamal@gmail.com', NULL, '$2y$12$5s0lM3jRZSBQ7.9CyyBzeuAmwc1nprMDptV4b48UKT6yapiyNMRo.', 0, NULL, '2025-09-13 07:58:31', '2025-09-14 00:23:38', 78.00, 31.08, 210.00, 0.00, 31.08, 0.00, 0.00, NULL),
(11, 'RX26290', 'RX16008', 'Abhishek', '+91', '12345678', 'abhishek@gmail.com', NULL, '$2y$12$3HiJ3mzSkjh8eASX49nTzOGhJfVWGs98fCQ8c2Ny8v9OLPjxOl7KC', 0, NULL, '2025-09-14 08:06:09', '2025-09-14 08:06:09', 15.00, 0.00, 34.00, 0.00, 0.00, 0.00, 0.00, NULL),
(12, 'RX16008', 'RX48807', 'Bharat', '+91', '213456788', 'bharat@gmail.com', NULL, '$2y$12$yqPyA5qi09cstTCmR2qjeO.fnh9SiEShWD2Fbe6mdo2bsJUBipxsa', 0, NULL, '2025-09-14 08:07:40', '2025-09-14 08:07:40', 10.00, 0.00, 24.00, 0.00, 0.00, 0.00, 0.00, NULL),
(13, 'RX48807', 'RX57732', 'Chirag', '+91', '3214567898', 'chirag@gmail.com', NULL, '$2y$12$1mTX/bd41F9MUM7wpkLtSO/k2Rmz/GKyEWdOl2Lswkzle5Ya/U6xS', 0, NULL, '2025-09-14 08:08:51', '2025-09-14 08:08:51', 50.00, 0.00, 30.00, 0.00, 0.00, 0.00, 0.00, NULL),
(14, 'RX57732', 'RX23129', 'Devender', '+91', '5437534875', 'devender@gmail.com', NULL, '$2y$12$6xa2hpcP8mSv7sTQFVONOOSdqnI2hSGfPYR.TfuV8kDRe6jZY9MNy', 0, NULL, '2025-09-14 08:11:57', '2025-09-14 08:11:57', 35.00, 0.00, 12.00, 0.00, 0.00, 0.00, 0.00, NULL),
(15, 'RX16008', 'RX55895', 'Bahadur', '+91', '453534534', 'bahadur@gmail.com', NULL, '$2y$12$Ixuvpu9fXbQyojiuWyJw7ukx9SajoRnWMAvvELkhSz4tX0m2NEnAS', 0, NULL, '2025-09-14 14:16:31', '2025-09-14 14:16:31', 0.00, 0.00, 54.00, 0.00, 0.00, 0.00, 0.00, NULL),
(16, 'RX55895', 'RX35712', 'Chetan', '+91', '35635343453', 'chetan@gmail.com', NULL, '$2y$12$qtyzV4mFLAc7ARPiuVCtCu4R2dZJC9N9o1jPApLkFs.2TBl3zoP3C', 0, NULL, '2025-09-14 14:18:34', '2025-09-14 14:18:34', 0.00, 0.00, 28.00, 0.00, 0.00, 0.00, 0.00, NULL),
(17, 'RX35712', 'RX80281', 'Dharmesh', '+91', '4645645645', 'dharmesh@gmail.com', NULL, '$2y$12$2UGv17UPwWXUfGo7PP2kUeZ.L.FWLCVuEr8PHiMRBKmPKsBI4c7GC', 0, NULL, '2025-09-14 14:19:17', '2025-09-14 14:19:17', 0.00, 0.00, 11.00, 0.00, 0.00, 0.00, 0.00, NULL),
(18, 'RX16008', 'RX89984', 'Bunny', '+91', '43834354343', 'bunny@gmail.com', NULL, '$2y$12$55wiccFO2t6iHGjMUMJxMeWdGFlFvr0IVuvV/.TO/xd/08tzgPgq2', 0, NULL, '2025-09-14 14:49:45', '2025-09-14 14:49:45', 0.00, 0.00, 23.00, 0.00, 0.00, 0.00, 0.00, NULL),
(19, 'RX89984', 'RX25873', 'Chang', '+91', '5432423324', 'chang@gmail.com', NULL, '$2y$12$QbtsYNspFP5EhBuBziUREOn8/OcSWhIQOPkrDz6awcl2FpHASvhPe', 0, NULL, '2025-09-14 14:50:37', '2025-09-14 14:50:37', 0.00, 0.00, 65.00, 0.00, 0.00, 0.00, 0.00, NULL),
(20, 'RX25873', 'RX25458', 'Dennis', '+91', '53453453434', 'dennis@gmail.com', NULL, '$2y$12$OT1NxSzwUR61Q6.tf7i/WelCrxLqKIeFFXeuTdEU4ZFKpVYyw9nla', 0, NULL, '2025-09-14 14:51:33', '2025-09-14 14:51:33', 0.00, 0.00, 16.00, 0.00, 0.00, 0.00, 0.00, NULL),
(21, 'RX25458', 'RX25056', 'Eren', '+91', '534534534', 'eren@gmail.com', NULL, '$2y$12$udIsrDvgER.dPovCu.H0n.COM3IXedftutReIou/VEW/PXllp/kiW', 0, NULL, '2025-09-14 14:52:15', '2025-09-14 14:52:15', 0.00, 0.00, 21.00, 0.00, 0.00, 0.00, 0.00, NULL),
(22, 'RX25056', 'RX20290', 'Finn', '+91', '534534534346', 'finn@gmail.com', NULL, '$2y$12$EWHs3PYyp4OV1UIdYqE3XuLmDK.BGNce7FWAIiL/EUL3aL2N/2sTm', 0, NULL, '2025-09-14 14:53:35', '2025-09-14 14:53:35', 0.00, 0.00, 26.00, 0.00, 0.00, 0.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_purchases`
--

CREATE TABLE `user_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_value` decimal(15,2) NOT NULL,
  `purchased_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_purchases`
--

INSERT INTO `user_purchases` (`id`, `user_id`, `purchase_value`, `purchased_at`, `created_at`, `updated_at`) VALUES
(1, 5, 100.00, '2025-09-13 07:30:07', '2025-09-13 07:30:07', '2025-09-13 07:30:07'),
(2, 9, 210.00, '2025-09-13 08:00:46', '2025-09-13 08:00:46', '2025-09-13 08:00:46'),
(3, 8, 100.00, '2025-09-13 08:01:08', '2025-09-13 08:01:08', '2025-09-13 08:01:08'),
(4, 7, 340.00, '2025-09-13 08:01:27', '2025-09-13 08:01:27', '2025-09-13 08:01:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `downlines`
--
ALTER TABLE `downlines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `downlines_ancestor_id_foreign` (`ancestor_id`),
  ADD KEY `downlines_descendant_id_foreign` (`descendant_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roi_incomes`
--
ALTER TABLE `roi_incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roi_incomes_user_id_foreign` (`user_id`);

--
-- Indexes for table `roi_rates`
--
ALTER TABLE `roi_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roi_rates_rate_index` (`rate`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_sponsor_id_foreign` (`sponsor_id`);

--
-- Indexes for table `user_purchases`
--
ALTER TABLE `user_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_purchases_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `downlines`
--
ALTER TABLE `downlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roi_incomes`
--
ALTER TABLE `roi_incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `roi_rates`
--
ALTER TABLE `roi_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_purchases`
--
ALTER TABLE `user_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downlines`
--
ALTER TABLE `downlines`
  ADD CONSTRAINT `downlines_ancestor_id_foreign` FOREIGN KEY (`ancestor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `downlines_descendant_id_foreign` FOREIGN KEY (`descendant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roi_incomes`
--
ALTER TABLE `roi_incomes`
  ADD CONSTRAINT `roi_incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_sponsor_id_foreign` FOREIGN KEY (`sponsor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_purchases`
--
ALTER TABLE `user_purchases`
  ADD CONSTRAINT `user_purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
