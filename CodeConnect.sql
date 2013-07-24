-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 24, 2013 at 07:21 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CodeConnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `CodeSave`
--

CREATE TABLE IF NOT EXISTS `CodeSave` (
  `nick` longtext,
  `html` longtext,
  `js` longtext,
  `css` longtext,
  `extres` longtext,
  `id` varchar(11) NOT NULL DEFAULT '',
  `Comments` longtext,
  `Rating` longtext,
  `Description` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CodeSave`
--

INSERT INTO `CodeSave` (`nick`, `html`, `js`, `css`, `extres`, `id`, `Comments`, `Rating`, `Description`) VALUES
('karthik', '<!-- DESCRIPTION/READ ME -->', 'fgfh', 'fgfg', '', 'bswjmwau', NULL, '0/0;', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->', 'dgsdg', 'dgsdg', '', 'bzqvpyno', NULL, '0/0;', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->', 'gbgdb', 'dbdbn', '', 'ezgjuylz', NULL, '0/0;', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->', 'bdfb', 'fbfdb', '', 'gdrahml', NULL, '0/0;', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->\r\nsdsdbhsdh', '//Use Check to validate your javascript code', 'body\r\n{\r\n  color:red;\r\n}', '"{}"', 'knctketln', NULL, '0/0', ''),
('karthik', '<!-- DESCRIPTION/READ ME -->', 'sdgsdg', 'sdgsdg', '', 'peiwhuy', NULL, '0/0;', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->', '//Use Check to validate your javascript code', '', '"{}"', 'pityrcx', NULL, '0/0', ''),
('admins', '<!-- DESCRIPTION/READ ME -->\r\ndgssdgsd', '//Use Check to validate your javascript code', '', '', 'rajmtsci', 'admins:::Fri Jul 19 2013 22:16:49:::sdngjsdng;;admins:::Fri Jul 19 2013 22:16:57:::slgndlg;;admins:::Fri Jul 19 2013 22:17:01:::<br />gfnglk;;', '5/1;;karthik', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->', 'sdgsdg', 'sdgsd', '', 'sbkziomv', NULL, '0/0;', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->', 'sdgsdg', 'dgsdg', '', 'srnbmqtna', NULL, '0/0;', NULL),
('karthik', '<!-- DESCRIPTION/READ ME -->\r\nsdfsdf', 'var a;', '', '{}', 'vhztfwg', NULL, '5/1;;karthik', 'Ya Mama'),
('karthik', '<!-- DESCRIPTION/READ ME -->\r\nsdgvsdvdv', 'var a;', 'body\r\n{\r\n  color:red;\r\n}', '{".js":"js"}', 'vquwvlml', 'karthik:::13:::sdgdg;;karthik:::Fri Jul 12 2013 02:03:20:::dffh;;karthik:::Fri Jul 12 2013 02:05:24:::shh;;karthik:::Fri Jul 12 2013 02:13:28:::;;karthik:::Fri Jul 12 2013 02:14:11:::;;karthik:::Fri Jul 12 2013 02:14:33:::;;karthik:::Fri Jul 12 2013 02:14:53:::;;karthik:::Fri Jul 12 2013 02:15:10:::;;karthik:::Fri Jul 12 2013 02:15:57:::;;karthik:::13:::;;karthik:::Fri Jul 12 2013 02:19:14:::hellow world;;karthik:::Fri Jul 12 2013 02:21:47:::hello!!;;karthik:::Fri Jul 12 2013 02:23:51:::Hello!!hi!!;;karthik:::Fri Jul 12 2013 19:29:53:::sdgdg;;karthik:::Fri Jul 12 2013 19:30:05:::sdgdg;;karthik:::Fri Jul 12 2013 19:30:10:::sdgndsklgnsdg sdg;;karthik:::Fri Jul 12 2013 19:40:25:::hihello;;karthik:::Fri Jul 12 2013 19:44:04:::dgdgdsdgsdg;;karthik:::Fri Jul 12 2013 19:44:39:::asdgd<br>sdgdg;;karthik:::Fri Jul 12 2013 19:45:19:::ssdgdg<br>dd;;karthik:::Fri Jul 12 2013 19:45:49:::sdgdg<br>sdg;;karthik:::Fri Jul 12 2013 19:46:34:::sdgdgdsgdsg;;karthik:::Fri Jul 12 2013 19:47:48:::dfghdg\n;;karthik:::Fri Jul 12 2013 19:51:49:::sdgdg<br />sdgsdg<br />\n;;karthik:::Thu Jul 18 2013 22:46:43:::hello;;admins:::Fri Jul 19 2013 18:50:10:::efh;;karthik:::Fri Jul 19 2013 22:47:07:::sdbds;;', '9/2;;karthik;admins', 'This is a test code piece which has too dumb codes..:P...so testing 1...2...3...check check');

-- --------------------------------------------------------

--
-- Table structure for table `UserInfo`
--

CREATE TABLE IF NOT EXISTS `UserInfo` (
  `Nick` varchar(20) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  UNIQUE KEY `Nick` (`Nick`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserInfo`
--

INSERT INTO `UserInfo` (`Nick`, `Email`, `Password`) VALUES
('karthik', 'karthik@sdg.sdg', 'cb4abed6c07c79e2deeb7d5895ddc855894ab403'),
('admins', 'vijaypcguy@yahoo.com', 'aafdc23870ecbcd3d557b6423a8982134e17927e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
