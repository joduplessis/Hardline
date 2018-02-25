-- phpMyAdmin SQL Dump
-- version 2.7.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 03, 2014 at 10:51 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6
-- 
-- Database: `hardline`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `comments`
-- 

CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `comment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `avalanche` tinyint(1) NOT NULL,
  `mid` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `comments`
-- 

INSERT INTO `comments` VALUES (28, 'Comment', '2013-04-08', 0, 22);
INSERT INTO `comments` VALUES (27, 'Himent', '2013-04-08', 0, 20);
INSERT INTO `comments` VALUES (26, 'another', '2013-04-08', 0, 19);
INSERT INTO `comments` VALUES (25, 'comment', '2013-04-08', 0, 19);

-- --------------------------------------------------------

-- 
-- Table structure for table `messages`
-- 

CREATE TABLE `messages` (
  `id` int(11) NOT NULL auto_increment,
  `topic` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `phoneid` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `messages`
-- 

INSERT INTO `messages` VALUES (22, 'Topic', 'Message', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'ede12ersfd', '2013-04-08');
INSERT INTO `messages` VALUES (20, 'Topic 2', 'Message', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined', 'ede12ersfde', '2013-04-08');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `phoneid` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES (3, 'Jo', 'Number', 'd', 'Hipany', 'Position', 'ede12ersfd');
