-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2016 at 09:02 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `registryv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` text NOT NULL,
  `path` text NOT NULL,
  `hash` text NOT NULL,
  `size` bigint(20) NOT NULL,
  `ext` text NOT NULL,
  `mime` text NOT NULL,
  `params` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `settle` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `uid`, `name`, `path`, `hash`, `size`, `ext`, `mime`, `params`, `created_on`, `settle`) VALUES
(7, 1, '111111111111111111111111111.png', 'C:\\wamp\\www\\registryv2/cache/upload/c2d2b332a85ca0c60a02ad9b6a91f9521038.download', 'c2d2b332a85ca0c60a02ad9b6a91f9521038', 2707370, 'png', 'image/png', '', '2016-06-30 20:44:46', 0),
(8, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/7746df69d25258e755ace8d38f1694215872.download', '7746df69d25258e755ace8d38f1694215872', 91683, 'jpg', 'image/jpeg', '', '2016-06-30 20:45:26', 0),
(9, 1, 'Final Form-v3.1.xsn_View 1.pdf', 'C:\\wamp\\www\\registryv2/cache/upload/2e57e2057c436b4c424d7e75639454517827.download', '2e57e2057c436b4c424d7e75639454517827', 282730, 'pdf', 'application/pdf', '', '2016-06-30 20:47:06', 0),
(10, 1, 'shenasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/5a25b35bd5e18f89381269d0e3ef420c5992.download', '5a25b35bd5e18f89381269d0e3ef420c5992', 728676, 'jpg', 'image/jpeg', '', '2016-06-30 20:47:37', 0),
(11, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/19bfdef0202856f1a1f50e20884d68ff6540.download', '19bfdef0202856f1a1f50e20884d68ff6540', 91683, 'jpg', 'image/jpeg', '', '2016-06-30 20:48:17', 0),
(12, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/0ad01919a6d9e58ee41af668c6916d7e6453.download', '0ad01919a6d9e58ee41af668c6916d7e6453', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 07:53:58', 0),
(13, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/18ab563f1a3b242a134a481c4fe15dea8448.download', '18ab563f1a3b242a134a481c4fe15dea8448', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 07:56:50', 0),
(14, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/d78da3ad191c948e13f8b15bbe4e60fb3719.download', 'd78da3ad191c948e13f8b15bbe4e60fb3719', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 07:57:14', 0),
(15, 1, 'shabnam.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/9556235a294a7b2d025903da5bc9b8432889.download', '9556235a294a7b2d025903da5bc9b8432889', 63900, 'jpg', 'image/jpeg', '', '2016-07-01 07:59:12', 0),
(16, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/5808454fd349e63c9c7ea6db5c0ef1d88326.download', '5808454fd349e63c9c7ea6db5c0ef1d88326', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 08:00:17', 0),
(17, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/5abe3bc2470b6961d4100f680f8c8ec67095.download', '5abe3bc2470b6961d4100f680f8c8ec67095', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 08:00:20', 0),
(18, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/cfcef1ecb4eb4b8ef497f0187822a3284593.download', 'cfcef1ecb4eb4b8ef497f0187822a3284593', 2591402, 'zip', 'application/zip', '', '2016-07-01 08:00:23', 0),
(19, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/c30597dfda449a0f96c861e2350a30e08366.download', 'c30597dfda449a0f96c861e2350a30e08366', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 08:04:14', 0),
(20, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/da283a340e923091b53030c37d95337c9734.download', 'da283a340e923091b53030c37d95337c9734', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 08:05:13', 0),
(21, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/4a4558e38354779140edc5fd5c7faecc9205.download', '4a4558e38354779140edc5fd5c7faecc9205', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 08:05:38', 0),
(22, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/78bf1c30554713d1b6d3a524788b3a6f6999.download', '78bf1c30554713d1b6d3a524788b3a6f6999', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 08:06:00', 0),
(23, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/cb6e6eab502ac0237dc5d827a16b128d6521.download', 'cb6e6eab502ac0237dc5d827a16b128d6521', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 08:48:39', 0),
(24, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/da5f7758f3f9f2f4b63dc276cdd4b1b17419.download', 'da5f7758f3f9f2f4b63dc276cdd4b1b17419', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 08:51:18', 0),
(25, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/a07ac8c1c7c96b1e291f78f178ce99a81192.download', 'a07ac8c1c7c96b1e291f78f178ce99a81192', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 08:51:26', 0),
(26, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/6e7b28798f396f0dcd68ba63211d617d6677.download', '6e7b28798f396f0dcd68ba63211d617d6677', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 08:52:17', 0),
(27, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/1ab947e73f94e118c8ee4ae0ae6980ed3249.download', '1ab947e73f94e118c8ee4ae0ae6980ed3249', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 08:52:34', 0),
(28, 1, '2281068961.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/679de74e92c681d53a0f42c97466c0bb4214.download', '679de74e92c681d53a0f42c97466c0bb4214', 335419, 'jpg', 'image/jpeg', '', '2016-07-01 08:53:45', 0),
(29, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/ff0fea676741ebffd4a8b44a409208131706.download', 'ff0fea676741ebffd4a8b44a409208131706', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 08:54:17', 0),
(30, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/c3acca42554c323c49ad8258f8b10db6775.download', 'c3acca42554c323c49ad8258f8b10db6775', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 09:03:15', 0),
(31, 1, 'shabnam.jpg', 'C:\\wamp\\www\\registryv2/files/thumb/32db363aa99ebdd15809bcdda47a01f85678.download', '32db363aa99ebdd15809bcdda47a01f85678', 0, 'jpg', 'image/jpeg', '', '2016-07-01 09:12:33', 0),
(32, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/files/thumb/2cef1eb0ca7ba914b8bd6d1d8e9894fc5109.download', '2cef1eb0ca7ba914b8bd6d1d8e9894fc5109', 0, 'jpg', 'image/jpeg', '', '2016-07-01 09:13:04', 0),
(33, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/files/thumb/17ef1c2463e3769beb2cc9a8205c89663155.download', '17ef1c2463e3769beb2cc9a8205c89663155', 0, 'jpg', 'image/jpeg', '', '2016-07-01 09:13:18', 0),
(34, 1, '2281068961.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/992f8f48c9b27803b6f4db32d623d2828178.download', '992f8f48c9b27803b6f4db32d623d2828178', 335419, 'jpg', 'image/jpeg', '', '2016-07-01 09:15:15', 0),
(35, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/611bdb9d074d9c168bd0b9b986286c532510.download', '611bdb9d074d9c168bd0b9b986286c532510', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 09:15:41', 0),
(36, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/cefd4a635272f959f33d746a8988b9dd4586.download', 'cefd4a635272f959f33d746a8988b9dd4586', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 09:15:45', 0),
(37, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/9d8616d07ddcb9969b0eb465ad0e14ef4409.download', '9d8616d07ddcb9969b0eb465ad0e14ef4409', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:15:48', 0),
(38, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/af679f6de9abe467069a24ce032056579906.download', 'af679f6de9abe467069a24ce032056579906', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:16:46', 0),
(39, 1, 'shenasname 2.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/383f2c051b677292b5530938cd29c7fc8266.download', '383f2c051b677292b5530938cd29c7fc8266', 212839, 'jpg', 'image/jpeg', '', '2016-07-01 09:16:51', 0),
(40, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/99ec6eea2771064ae4082469f628e4189390.download', '99ec6eea2771064ae4082469f628e4189390', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 09:18:30', 0),
(41, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/f30bb22388363c0d93e1a5e2069a2bd53612.download', 'f30bb22388363c0d93e1a5e2069a2bd53612', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:18:33', 0),
(42, 1, 'asasname.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/dc3ac8ccbb88fee204ae599d312b55cc5681.download', 'dc3ac8ccbb88fee204ae599d312b55cc5681', 237955, 'jpg', 'image/jpeg', '', '2016-07-01 09:20:06', 0),
(43, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/b86b145e1759e5171e44055ab77062ab8136.download', 'b86b145e1759e5171e44055ab77062ab8136', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:20:08', 0),
(44, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/b34a2da74d1b252a4153d3a4861378d05658.download', 'b34a2da74d1b252a4153d3a4861378d05658', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:20:20', 0),
(45, 1, '2281068961.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/388bb9876ea02d98497b79e55aaa7f6d4737.download', '388bb9876ea02d98497b79e55aaa7f6d4737', 335419, 'jpg', 'image/jpeg', '', '2016-07-01 09:20:23', 0),
(46, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/5b165f836fe0be9b9f7c1ddb834d48193107.download', '5b165f836fe0be9b9f7c1ddb834d48193107', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:20:33', 0),
(47, 1, '2281068961.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/d750b8858a71a2e58d392320b521593e2898.download', 'd750b8858a71a2e58d392320b521593e2898', 335419, 'jpg', 'image/jpeg', '', '2016-07-01 09:20:35', 0),
(48, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/2b1b35aa0ec5c5d645a1b84b80ead4c28138.download', '2b1b35aa0ec5c5d645a1b84b80ead4c28138', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:20:45', 0),
(49, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/fcde301ea26d52ac83c0c696c59f44f52854.download', 'fcde301ea26d52ac83c0c696c59f44f52854', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 09:20:47', 0),
(50, 1, 'agahi taghirat.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/61a3b64b57e72b8dceb3175d5444312a8834.download', '61a3b64b57e72b8dceb3175d5444312a8834', 322563, 'jpg', 'image/jpeg', '', '2016-07-01 09:20:59', 0),
(51, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/ee3250ca06206a95ae490e52328e9d392446.download', 'ee3250ca06206a95ae490e52328e9d392446', 2591402, 'zip', 'application/zip', '', '2016-07-01 09:21:01', 0),
(52, 1, 'shenasname 2.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/165ce2a92148b7132bca8d892f35a8027913.download', '165ce2a92148b7132bca8d892f35a8027913', 212839, 'jpg', 'image/jpeg', '', '2016-07-01 09:21:52', 0),
(53, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/5d6e1b6c06ee77e3336f5ee9fcb601106329.download', '5d6e1b6c06ee77e3336f5ee9fcb601106329', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 09:49:24', 0),
(54, 1, 'shabnam.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/355fc973fc2fc8824248e7cd192abead5913.download', '355fc973fc2fc8824248e7cd192abead5913', 63900, 'jpg', 'image/jpeg', '', '2016-07-01 10:53:57', 0),
(55, 1, 'shabnam.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/f9af7e535d2cb3c5ccebc903f50d1d8b5255.download', 'f9af7e535d2cb3c5ccebc903f50d1d8b5255', 63900, 'jpg', 'image/jpeg', '', '2016-07-01 11:02:37', 0),
(56, 1, 'karte melli.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/4a70479220fbf9d0fc68ad4ef9b240f44936.download', '4a70479220fbf9d0fc68ad4ef9b240f44936', 114810, 'jpg', 'image/jpeg', '', '2016-07-01 11:03:55', 0),
(60, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/0a19c090248c15259db8203873a8d2d45474.download', '0a19c090248c15259db8203873a8d2d45474', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 11:09:39', 0),
(62, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/317105d41be8a2e9a3569b513651d1d18808.download', '317105d41be8a2e9a3569b513651d1d18808', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 11:13:52', 0),
(63, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/2b74592cfb195d04026a1fbb0a420af22180.download', '2b74592cfb195d04026a1fbb0a420af22180', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 11:14:21', 0),
(66, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/22b48ddbb984b546e8dbca03b5d8b6bd5184.download', '22b48ddbb984b546e8dbca03b5d8b6bd5184', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 11:17:37', 0),
(67, 1, 'shenasname 2.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/1dfd7d57713d797a553a6d4cbe759ebd7230.download', '1dfd7d57713d797a553a6d4cbe759ebd7230', 212839, 'jpg', 'image/jpeg', '', '2016-07-01 11:17:39', 0),
(68, 1, 'personal.pic.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/f1d3c728e9797c677cd3115469c67e666692.download', 'f1d3c728e9797c677cd3115469c67e666692', 91683, 'jpg', 'image/jpeg', '', '2016-07-01 11:19:09', 0),
(69, 1, 'shenasname 2.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/232f6ba8250c2675ee39f9f28f9cd359806.download', '232f6ba8250c2675ee39f9f28f9cd359806', 212839, 'jpg', 'image/jpeg', '', '2016-07-01 11:19:11', 0),
(70, 1, '2281068961-2.jpg', 'C:\\wamp\\www\\registryv2/cache/upload/afbe3ee530280c796f0fbf9f50cbbc647124.download', 'afbe3ee530280c796f0fbf9f50cbbc647124', 43102, 'jpg', 'image/jpeg', '', '2016-07-01 11:20:29', 0),
(71, 1, '2281068961.zip', 'C:\\wamp\\www\\registryv2/cache/upload/2fd129e94b4b837bf9824f1ee2ac0b1b531.download', '2fd129e94b4b837bf9824f1ee2ac0b1b531', 2591402, 'zip', 'application/zip', '', '2016-07-01 11:20:31', 0),
(72, 1, 'Band of Brothers [03] Carentan.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/2dcb6af2232ac8de65769daa0208cdfb7504.download', '2dcb6af2232ac8de65769daa0208cdfb7504', 43586, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 16:13:10', 0),
(73, 1, 'Band of Brothers [04] Replacements.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/758aa9de797fd3d9778ffb4795adfeec8369.download', '758aa9de797fd3d9778ffb4795adfeec8369', 28626, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 19:45:32', 0),
(74, 1, 'Band of Brothers [09] Why We Fight.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/bb55d76634fc6a37574364eaeac2a3aa1039.download', 'bb55d76634fc6a37574364eaeac2a3aa1039', 31391, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:05:22', 0),
(75, 1, 'Band of Brothers [07] The Breaking Point.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/38c3afd087f97240386b472169491df89586.download', '38c3afd087f97240386b472169491df89586', 61670, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:51:03', 0),
(76, 1, 'Band of Brothers [05] Crossroads.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/6e95bf15af5cf037975becb302da9ab73282.download', '6e95bf15af5cf037975becb302da9ab73282', 36499, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:51:06', 0),
(77, 1, 'Band of Brothers [05] Crossroads.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/96d74cffdce4fdac59b3778df8c8f7729805.download', '96d74cffdce4fdac59b3778df8c8f7729805', 36499, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:51:10', 0),
(78, 1, 'Band of Brothers [09] Why We Fight.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/b3edc3b57b4fdcb294556926156216fe8641.download', 'b3edc3b57b4fdcb294556926156216fe8641', 31391, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:51:25', 0),
(79, 1, 'Band of Brothers [09] Why We Fight.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/da7dc93772c2a517eaecc581c3538f2c5458.download', 'da7dc93772c2a517eaecc581c3538f2c5458', 31391, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:52:18', 0),
(80, 1, 'Band of Brothers [05] Crossroads.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/8528a984bd70ebb9abaf7e5a791572032385.download', '8528a984bd70ebb9abaf7e5a791572032385', 36499, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:52:28', 0),
(81, 1, 'Band of Brothers [06] Bastogne.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/4b588b9eaf690d0b5e5954f99f632eda5920.download', '4b588b9eaf690d0b5e5954f99f632eda5920', 37934, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:52:38', 0),
(82, 1, 'Band of Brothers [03] Carentan.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/02b752bd2651157b1c927576ca498423974.download', '02b752bd2651157b1c927576ca498423974', 43586, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:52:51', 0),
(83, 1, 'Band of Brothers [04] Replacements.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/d240b17cd31abc78091ce40232dbcccd5235.download', 'd240b17cd31abc78091ce40232dbcccd5235', 28626, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:53:03', 0),
(84, 1, 'Band of Brothers [03] Carentan.Fa.ANSI.srt', 'C:\\wamp\\www\\registryv2/cache/upload/bf759557b9cf6d5aba326ae0a4186f7c7599.download', 'bf759557b9cf6d5aba326ae0a4186f7c7599', 43586, 'srt', 'text/plain; charset=unknown-8bit', '', '2016-07-01 20:53:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE IF NOT EXISTS `login_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `date`, `status`, `users_id`) VALUES
(1, '2016-05-11 14:02:35', 'failed', 1),
(2, '2016-05-11 14:02:45', 'failed', 1),
(3, '2016-05-11 14:03:19', 'success', 1),
(4, '2016-05-11 14:18:56', 'failed', 1),
(5, '2016-05-11 14:18:57', 'failed', 1),
(6, '2016-05-11 14:19:02', 'success', 1),
(7, '2016-05-11 14:19:40', 'failed', 1),
(8, '2016-05-11 14:19:43', 'failed', 1),
(9, '2016-05-11 14:19:44', 'failed', 1),
(10, '2016-05-11 14:19:45', 'failed', 1),
(11, '2016-05-11 14:19:47', 'failed', 1),
(12, '2016-05-11 14:19:50', 'failed', 1),
(13, '2016-05-11 14:19:54', 'success', 1),
(14, '2016-05-11 14:39:33', 'success', 1),
(15, '2016-05-12 22:18:32', 'success', 2),
(16, '2016-05-12 22:18:42', 'success', 1),
(17, '2016-05-13 13:35:25', 'success', 1),
(18, '2016-05-13 18:04:00', 'failed', 1),
(19, '2016-05-13 18:04:02', 'failed', 1),
(20, '2016-05-13 18:04:03', 'failed', 1),
(21, '2016-05-13 18:04:07', 'success', 1),
(22, '2016-05-14 22:25:10', 'success', 1),
(23, '2016-05-14 22:25:55', 'success', 1),
(24, '2016-05-25 11:33:03', 'success', 1),
(25, '2016-06-07 18:29:39', 'success', 1),
(26, '2016-06-07 18:46:25', 'success', 1),
(27, '2016-06-08 09:33:10', 'success', 1),
(28, '2016-06-08 10:45:13', 'success', 1),
(29, '2016-06-08 10:56:55', 'success', 1),
(30, '2016-06-08 11:15:28', 'failed', 1),
(31, '2016-06-08 11:16:07', 'failed', 1),
(32, '2016-06-08 11:16:09', 'failed', 1),
(33, '2016-06-08 11:16:11', 'failed', 1),
(34, '2016-06-08 11:19:23', 'failed', 1),
(35, '2016-06-08 11:19:27', 'failed', 1),
(36, '2016-06-08 11:19:39', 'success', 1),
(37, '2016-06-08 11:22:09', 'failed', 1),
(38, '2016-06-08 11:22:13', 'failed', 1),
(39, '2016-06-08 11:22:22', 'failed', 1),
(40, '2016-06-08 11:22:31', 'failed', 1),
(41, '2016-06-08 11:25:23', 'failed', 1),
(42, '2016-06-08 11:25:26', 'failed', 1),
(43, '2016-06-08 11:25:37', 'failed', 1),
(44, '2016-06-08 11:26:23', 'failed', 1),
(45, '2016-06-08 11:26:33', 'failed', 1),
(46, '2016-06-08 11:28:49', 'failed', 1),
(47, '2016-06-08 11:28:51', 'failed', 1),
(48, '2016-06-08 11:35:24', 'success', 1),
(49, '2016-06-08 11:35:45', 'success', 1),
(50, '2016-06-08 11:37:20', 'failed', 1),
(51, '2016-06-08 11:37:36', 'failed', 1),
(52, '2016-06-08 11:37:58', 'failed', 1),
(53, '2016-06-08 11:40:27', 'failed', 1),
(54, '2016-06-08 11:41:45', 'failed', 1),
(55, '2016-06-08 11:44:04', 'success', 1),
(56, '2016-06-08 22:47:13', 'success', 1),
(57, '2016-06-08 22:47:23', 'success', 1),
(58, '2016-06-10 17:29:40', 'success', 1),
(59, '2016-06-10 17:39:15', 'success', 1),
(60, '2016-06-10 17:40:52', 'success', 1),
(61, '2016-06-20 07:35:12', 'success', 1),
(62, '2016-06-20 09:55:21', 'success', 1),
(63, '2016-06-20 10:41:02', 'success', 1),
(64, '2016-06-20 14:30:36', 'success', 1),
(65, '2016-06-20 17:39:08', 'success', 1),
(66, '2016-06-20 17:39:44', 'success', 2),
(67, '2016-06-20 17:39:59', 'success', 1),
(68, '2016-06-21 16:21:54', 'success', 1),
(69, '2016-06-21 16:22:00', 'success', 1),
(70, '2016-06-21 16:25:01', 'success', 1),
(71, '2016-06-21 16:26:07', 'failed', 1),
(72, '2016-06-21 16:26:09', 'success', 1),
(73, '2016-06-21 17:33:15', 'success', 1),
(74, '2016-06-21 17:33:42', 'success', 1),
(75, '2016-06-22 09:34:17', 'success', 1),
(76, '2016-06-22 09:35:00', 'success', 1),
(77, '2016-06-24 08:09:41', 'success', 1),
(78, '2016-06-24 08:11:31', 'success', 1),
(79, '2016-06-27 10:05:44', 'success', 1),
(80, '2016-06-27 15:23:27', 'success', 1),
(81, '2016-06-28 00:30:51', 'success', 1),
(82, '2016-06-28 07:48:18', 'success', 1),
(83, '2016-06-28 07:49:35', 'success', 1),
(84, '2016-06-29 08:03:06', 'success', 1),
(85, '2016-07-01 09:01:54', 'failed', 1),
(86, '2016-07-01 09:01:56', 'success', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `system` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `system`) VALUES
(1, 'nav', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` text NOT NULL,
  `url` text NOT NULL,
  `active` text NOT NULL,
  `proc` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1',
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `title`, `icon`, `url`, `active`, `proc`, `type`, `order`, `published`, `permission`) VALUES
(1, 1, 0, 'MENU.MAIN_MENU', '', '', '', '', 2, 1, 1, ''),
(2, 1, 0, 'MENU.HOME', 'home', 'dashboard', 'dashboard|/', '', 1, 2, 1, ''),
(3, 1, 0, 'MENU.MESSAGE', 'envelope', 'message', '', '', 0, 3, 1, ''),
(4, 1, 3, 'MENU.COMPOSE', 'share', 'message/compose', '', '', 0, 4, 1, ''),
(5, 1, 3, 'MENU.INBOX', 'inbox', 'message/inbox', '', 'message.MessageController.menuUnread', 0, 3, 1, ''),
(7, 1, 0, 'MENU.USERS', 'users', 'users', '', '', 0, 6, 1, 'user.view'),
(8, 1, 7, 'MENU.MANAGE_USERS', 'users', 'users', '', '', 0, 6, 1, 'user.view'),
(9, 1, 7, 'MENU.CREATE_USER', 'user-plus', 'users/create', '', '', 0, 9, 1, 'user.create'),
(10, 1, 7, 'MENU.MANAGE_ROLES', 'user-secret', 'roles', '', '', 0, 10, 1, 'user.role'),
(11, 1, 7, 'MENU.CREATE_ROLE', 'plus-square-o', 'roles/create', '', '', 0, 11, 1, 'user.role'),
(12, 1, 0, 'MENU.SARDASHT_COHORT', 'wheelchair', 'sardasht', '', '', 0, 12, 1, 'registry.view'),
(13, 1, 12, 'MENU.CREATE', 'user-plus', 'sardasht/create', '', '', 0, 12, 1, 'registry.create'),
(14, 1, 12, 'MENU.SEARCH', 'search', 'sardasht', '', '', 0, 12, 1, 'registry.search'),
(15, 1, 12, 'MENU.EXPORT', 'cloud-download', 'sardasht/export', '', '', 0, 12, 1, 'registry.export'),
(16, 1, 0, 'MENU.CORE', 'cog', 'core', '', '', 0, 11, 1, 'core.view'),
(17, 1, 16, 'MENU.SETTINGS', 'cogs', 'core/settings', '', '', 0, 11, 1, 'core.settings'),
(18, 1, 16, 'MENU.INSTALLER', 'puzzle-piece', 'core/installer', '', '', 0, 11, 1, 'core.installer'),
(19, 1, 16, 'MENU.INFO', 'info', 'core/info', '', '', 0, 11, 1, 'core.info'),
(20, 1, 16, 'MENU.LANGUAGE', 'keyboard-o', 'core/languages', '', '', 0, 11, 1, 'core.language'),
(21, 1, 3, 'MENU.SENT', 'envelope-o', 'message/sent', '', '', 0, 5, 1, ''),
(22, 1, 3, 'MENU.TRASH', 'trash-o', 'message/trash', '', '', 0, 5, 1, ''),
(23, 1, 3, 'MENU.DRAFT', 'file-text-o', 'message/drafts', '', '', 0, 4, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `attachment` text NOT NULL,
  `from` int(11) NOT NULL,
  `receipt` int(11) NOT NULL,
  `transcript` int(11) NOT NULL DEFAULT '0',
  `origin` bigint(20) NOT NULL,
  `read` int(11) NOT NULL DEFAULT '0',
  `forwarded` int(11) NOT NULL DEFAULT '0',
  `replied` int(11) NOT NULL DEFAULT '0',
  `draft` int(11) NOT NULL DEFAULT '0',
  `sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trash` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `body`, `attachment`, `from`, `receipt`, `transcript`, `origin`, `read`, `forwarded`, `replied`, `draft`, `sent_on`, `read_on`, `trash`) VALUES
(1, 'Subject', '<p>ASFDASDSA</p>', '', 2, 1, 0, 0, 1, 0, 0, 0, '2016-06-28 17:55:19', '2016-07-01 19:03:37', 0),
(2, 'Subject', '<p>ASFDASDSA</p>', '', 2, 3, 1, 1, 0, 0, 0, 0, '2016-06-28 17:55:19', '0000-00-00 00:00:00', 0),
(3, 'Subject', '<p>ASFDASDSA</p>', '', 2, 5, 1, 1, 0, 0, 0, 0, '2016-06-28 17:55:19', '0000-00-00 00:00:00', 0),
(4, 'Subject', '<p>ASFDASDSA</p>', '', 1, 2, 0, 0, 0, 0, 0, 0, '2016-06-28 18:07:51', '2016-07-01 15:54:40', 0),
(5, 'Subject', '<p>ASFDASDSA</p>', '', 1, 3, 1, 1, 0, 0, 0, 0, '2016-06-28 18:07:51', '2016-07-01 15:54:38', 0),
(6, 'Subject', '<p>ASFDASDSA</p>', '', 1, 5, 1, 1, 0, 0, 0, 0, '2016-06-28 18:07:51', '2016-07-01 15:54:35', 0),
(7, 'Subject', '', '["68","69"]', 2, 1, 0, 0, 1, 0, 0, 0, '2016-07-01 11:19:50', '2016-07-01 19:03:57', 0),
(9, 'dfasda', '<p>dasfsa</p>', '["70","71"]', 2, 1, 0, 0, 1, 0, 0, 0, '2016-07-01 11:20:33', '2016-07-01 19:03:20', 1),
(13, 'FW:Subject with long text in fron to test', '<br><br><u><b>Forwarded from Ali Heydarifard on 01 Jul 2016 03:49 PM </b></u><br>', '["68","69"]', 1, 1, 0, 0, 1, 1, 0, 0, '2016-07-01 20:02:20', '2016-07-01 19:03:49', 0),
(14, 'RE:Subject', 'reply to message<br><br><u><b>Reply to Subject Ali Heydarifard on 28 Jun 2016 10:25 PM </b></u><br><p>ASFDASDSA</p>', '["74"]', 2, 1, 0, 0, 1, 0, 1, 0, '2016-07-01 20:05:24', '2016-07-01 19:03:59', 1),
(15, '', '', '["84"]', 1, 2, 0, 0, 0, 0, 0, 0, '2016-06-30 20:54:10', '2016-07-01 20:54:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` text NOT NULL,
  `icon` text NOT NULL,
  `color` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` int(11) NOT NULL DEFAULT '0',
  `seen_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `users_id`, `title`, `message`, `url`, `icon`, `color`, `date`, `seen`, `seen_date`) VALUES
(6, 1, 'Your password has been changed.', '', '', 'unlock-alt', 'text-red', '2016-05-13 22:56:26', 1, '2016-05-13 19:36:04'),
(7, 1, 'Your password has been changed.', '', '', 'unlock-alt', 'text-red', '2016-05-13 22:58:42', 1, '2016-05-13 20:37:08'),
(8, 1, 'Your password has been changed.', '', '', 'unlock-alt', 'text-red', '2016-06-08 11:44:20', 1, '2016-06-20 05:48:49'),
(9, 1, 'Your password has been changed.', '', '', 'unlock-alt', 'text-red', '2016-06-21 17:33:31', 1, '2016-06-21 17:18:02'),
(10, 1, 'Your password has been changed.', '', '', 'unlock-alt', 'text-red', '2016-06-22 09:34:48', 1, '2016-06-22 07:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` text NOT NULL,
  `category` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `roles` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `slug`, `category`, `name`, `description`, `roles`) VALUES
(1, 'create', 'user', 'Create User', 'Create new users', '["admin"]'),
(2, 'edit', 'user', 'Edit Users', 'Edit users', '["admin"]'),
(3, 'role', 'user', 'Manage Roles', 'Manage roles', '["admin"]'),
(4, 'view', 'user', 'User Manager', 'View user manager', '["admin"]'),
(5, 'create', 'registry', 'Create Item', 'Create registry item', '["user","admin"]'),
(6, 'search', 'registry', 'Search', 'View search form', '["admin","user"]'),
(7, 'view', 'registry', 'View', 'View Item', '["admin","user"]'),
(8, 'delete', 'registry', 'Delete', 'Delete Item', '["admin"]'),
(9, 'export', 'registry', 'Export', 'Export Data', '["admin"]'),
(10, 'view', 'core', 'Manage Core', 'Manage Application Core', '["admin"]'),
(11, 'settings', 'core', 'Manage Settings', 'User can manage settings', '["admin"]'),
(12, 'installer', 'core', 'Installer', 'User can install/uninstall packages', '["admin"]'),
(13, 'info', 'core', 'System Info', 'View System Information', '["admin"]'),
(14, 'language', 'core', 'Manage Language', 'View/Manage Language Files', '["admin"]');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'System Administrator', '2016-04-26 03:10:16', '2016-06-22 07:09:09'),
(3, 'Data Miner', 'user', 'Data Miner', '2016-04-26 09:05:28', '2016-05-14 19:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `users_id`, `created_at`, `updated_at`) VALUES
(28, 3, 1, '2016-05-11 09:12:18', '2016-05-11 09:12:18'),
(29, 3, 2, '2016-05-12 19:48:17', '2016-05-12 19:48:17'),
(32, 1, 1, NULL, NULL),
(33, 1, 3, '2016-06-21 15:05:26', '2016-06-21 15:05:26'),
(34, 1, 5, '2016-06-21 15:06:17', '2016-06-21 15:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `component` text NOT NULL,
  `controller` text NOT NULL,
  `method` text NOT NULL,
  `params` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `run_on` timestamp NULL DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL,
  `interval` bigint(20) NOT NULL,
  `token` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `component`, `controller`, `method`, `params`, `run_on`, `created_on`, `type`, `interval`, `token`) VALUES
(10, 'dashboard', 'DashboardController', 'schedule', '', '2016-06-11 09:08:41', '2016-06-11 08:09:13', 2, 3600, '3b12c9f1c147c07be52fa7436f8c3cb8'),
(11, 'dashboard', 'DashboardController', 'schedule', '', '2016-06-11 08:24:49', '2016-06-11 08:08:21', 2, 3600, 'fd25fa9e714c71f01e3ee3e8136d5210'),
(12, 'dashboard', 'DashboardController', 'schedule', '', '2016-06-11 08:17:47', '2016-06-11 08:20:20', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(13, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-11 08:19:06', '2016-06-11 08:20:20', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(14, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-11 08:19:56', '2016-06-11 08:20:20', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(15, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-11 08:20:22', '2016-06-11 08:20:20', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(16, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-11 08:20:36', '2016-06-11 08:20:20', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(17, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-21 12:57:26', '2016-06-21 15:27:26', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(18, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-21 12:59:54', '2016-06-21 15:29:54', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(19, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-21 13:00:23', '2016-06-21 15:30:23', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(20, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-21 13:00:24', '2016-06-21 15:30:24', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(21, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-21 13:00:33', '2016-06-21 15:30:33', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(22, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-21 13:00:43', '2016-06-21 15:30:43', 2, 20, '47f9df296151263f1fc3297f2fc5f59d'),
(23, 'dashboard', 'DashboardController', 'schedule', 'a:2:{s:1:"x";i:10;s:1:"y";i:20;}', '2016-06-21 13:00:51', '2016-06-21 15:30:51', 2, 20, '47f9df296151263f1fc3297f2fc5f59d');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  `otp` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `session`, `created_at`, `updated_at`, `block`, `otp`, `lang`, `mobile`) VALUES
(1, 'Mohammad R Hashemi', 'shirazitcompany@yahoo.com', '703801e301cd594851c27d28d7f3fce0:baa8dff20732b63a58ee32999482a5e4', 'ce58aef0959ecd1656fd63cf3b58c3d9', '2016-04-12 01:04:37', '2016-07-01 06:31:56', 0, '', '3', '9173145877'),
(2, 'Ali Heydarifard', 'user@info.com', '56d2c3218812d52e346cb7ddf0422806:2ffed33002ed69f0850fe90d8cf93eb0', 'eb28b4ea4fff132154a9d24f4974f237', NULL, '2016-06-21 15:04:50', 0, '', '2', '9173145877'),
(3, 'test', 'info@u.com', '00141240b684f6474fd39adf3bba5b81:8d30f665c4544e0084c8aacf726299bd', NULL, '2016-06-21 15:05:26', '2016-06-21 15:05:26', 0, '', '2', '09173145877'),
(5, 'test', 'user2@info.com', '71bad51776ed48b343475396ab54281d:bf5d816321708b229280a3e193de5728', NULL, '2016-06-21 15:06:17', '2016-06-21 15:06:17', 0, '', '2', '09173145877');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
