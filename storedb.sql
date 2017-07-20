-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: storedb
-- ------------------------------------------------------
-- Server version	5.7.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `app_clients`
--

DROP TABLE IF EXISTS `app_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_clients` (
  `ClientId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`ClientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_expenses_categories`
--

DROP TABLE IF EXISTS `app_expenses_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_expenses_categories` (
  `ExpenseId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `ExpenseName` varchar(30) NOT NULL,
  `FixedPayment` decimal(7,2) NOT NULL,
  PRIMARY KEY (`ExpenseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_expenses_daily_list`
--

DROP TABLE IF EXISTS `app_expenses_daily_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_expenses_daily_list` (
  `DExpenseId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ExpenseId` tinyint(3) unsigned NOT NULL,
  `Payment` decimal(7,2) NOT NULL,
  `Created` datetime NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`DExpenseId`),
  KEY `ExpenseId` (`ExpenseId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_expenses_daily_list_ibfk_1` FOREIGN KEY (`ExpenseId`) REFERENCES `app_expenses_categories` (`ExpenseId`),
  CONSTRAINT `app_expenses_daily_list_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_notifications`
--

DROP TABLE IF EXISTS `app_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_notifications` (
  `NotificationId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(30) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `Type` tinyint(2) NOT NULL,
  `Created` datetime NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Seen` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`NotificationId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_notifications_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_products_categories`
--

DROP TABLE IF EXISTS `app_products_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_products_categories` (
  `CategoryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Image` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_products_list`
--

DROP TABLE IF EXISTS `app_products_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_products_list` (
  `ProductId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CategoryId` int(10) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Image` varchar(30) DEFAULT NULL,
  `Quantity` smallint(5) unsigned NOT NULL,
  `Price` decimal(6,2) NOT NULL,
  `Unit` tinyint(1) NOT NULL,
  `BarCode` char(20) DEFAULT NULL,
  PRIMARY KEY (`ProductId`),
  KEY `CategoryId` (`CategoryId`),
  CONSTRAINT `app_products_list_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `app_products_categories` (`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_purchases_invoices`
--

DROP TABLE IF EXISTS `app_purchases_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_purchases_invoices` (
  `InvoiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SupplierId` int(10) unsigned NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentStatus` tinyint(1) NOT NULL,
  `Created` date NOT NULL,
  `Discount` decimal(8,2) DEFAULT NULL,
  `UserId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`InvoiceId`),
  KEY `SupplierId` (`SupplierId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_purchases_invoices_ibfk_1` FOREIGN KEY (`SupplierId`) REFERENCES `app_suppliers` (`SupplierId`),
  CONSTRAINT `app_purchases_invoices_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_purchases_invoices_details`
--

DROP TABLE IF EXISTS `app_purchases_invoices_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_purchases_invoices_details` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` int(10) unsigned NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `ProductPrice` decimal(7,2) NOT NULL,
  `InvoiceId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `ProductId` (`ProductId`),
  KEY `InvoiceId` (`InvoiceId`),
  CONSTRAINT `app_purchases_invoices_details_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `app_products_list` (`ProductId`),
  CONSTRAINT `app_purchases_invoices_details_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `app_purchases_invoices` (`InvoiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_purchases_invoices_receipts`
--

DROP TABLE IF EXISTS `app_purchases_invoices_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_purchases_invoices_receipts` (
  `ReceiptId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `InvoiceId` int(10) unsigned NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentAmount` decimal(8,2) NOT NULL,
  `PaymentLiteral` varchar(60) NOT NULL,
  `BankName` varchar(30) DEFAULT NULL,
  `BankAccountNumber` varchar(30) DEFAULT NULL,
  `CheckNumber` varchar(15) DEFAULT NULL,
  `TransferedTo` varchar(30) DEFAULT NULL,
  `Created` date NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ReceiptId`),
  KEY `InvoiceId` (`InvoiceId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_purchases_invoices_receipts_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `app_purchases_invoices` (`InvoiceId`),
  CONSTRAINT `app_purchases_invoices_receipts_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_sales_invoices`
--

DROP TABLE IF EXISTS `app_sales_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_sales_invoices` (
  `InvoiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ClientId` int(10) unsigned NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentStatus` tinyint(1) NOT NULL,
  `Created` date NOT NULL,
  `Discount` decimal(8,2) DEFAULT NULL,
  `UserId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`InvoiceId`),
  KEY `ClientId` (`ClientId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_sales_invoices_ibfk_1` FOREIGN KEY (`ClientId`) REFERENCES `app_clients` (`ClientId`),
  CONSTRAINT `app_sales_invoices_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_sales_invoices_details`
--

DROP TABLE IF EXISTS `app_sales_invoices_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_sales_invoices_details` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` int(10) unsigned NOT NULL,
  `Quantity` smallint(6) NOT NULL,
  `ProductPrice` decimal(7,2) NOT NULL,
  `InvoiceId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `ProductId` (`ProductId`),
  KEY `InvoiceId` (`InvoiceId`),
  CONSTRAINT `app_sales_invoices_details_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `app_products_list` (`ProductId`),
  CONSTRAINT `app_sales_invoices_details_ibfk_2` FOREIGN KEY (`InvoiceId`) REFERENCES `app_sales_invoices` (`InvoiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_sales_invoices_receipts`
--

DROP TABLE IF EXISTS `app_sales_invoices_receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_sales_invoices_receipts` (
  `ReceiptId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `InvoiceId` int(10) unsigned NOT NULL,
  `PaymentType` tinyint(1) NOT NULL,
  `PaymentAmount` decimal(8,2) NOT NULL,
  `PaymentLiteral` varchar(60) NOT NULL,
  `BankName` varchar(30) DEFAULT NULL,
  `BankAccountNumber` varchar(30) DEFAULT NULL,
  `CheckNumber` varchar(15) DEFAULT NULL,
  `TransferedTo` varchar(30) DEFAULT NULL,
  `Created` date NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ReceiptId`),
  KEY `InvoiceId` (`InvoiceId`),
  KEY `UserId` (`UserId`),
  CONSTRAINT `app_sales_invoices_receipts_ibfk_1` FOREIGN KEY (`InvoiceId`) REFERENCES `app_sales_invoices` (`InvoiceId`),
  CONSTRAINT `app_sales_invoices_receipts_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_suppliers`
--

DROP TABLE IF EXISTS `app_suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_suppliers` (
  `SupplierId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`SupplierId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_users`
--

DROP TABLE IF EXISTS `app_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(12) NOT NULL,
  `Password` char(60) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `SubscriptionDate` date NOT NULL,
  `LastLogin` datetime NOT NULL,
  `GroupId` tinyint(1) unsigned NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`),
  KEY `GroupId` (`GroupId`),
  CONSTRAINT `app_users_ibfk_1` FOREIGN KEY (`GroupId`) REFERENCES `app_users_groups` (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_users_groups`
--

DROP TABLE IF EXISTS `app_users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users_groups` (
  `GroupId` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(20) NOT NULL,
  PRIMARY KEY (`GroupId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_users_groups_privileges`
--

DROP TABLE IF EXISTS `app_users_groups_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users_groups_privileges` (
  `Id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `GroupId` tinyint(1) unsigned NOT NULL,
  `PrivilegeId` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `GroupId` (`GroupId`),
  KEY `PrivilegeId` (`PrivilegeId`),
  CONSTRAINT `app_users_groups_privileges_ibfk_1` FOREIGN KEY (`GroupId`) REFERENCES `app_users_groups` (`GroupId`),
  CONSTRAINT `app_users_groups_privileges_ibfk_2` FOREIGN KEY (`PrivilegeId`) REFERENCES `app_users_privileges` (`PrivilegeId`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_users_privileges`
--

DROP TABLE IF EXISTS `app_users_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users_privileges` (
  `PrivilegeId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Privilege` varchar(30) NOT NULL,
  `PrivilegeTitle` varchar(30) NOT NULL,
  PRIMARY KEY (`PrivilegeId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `app_users_profiles`
--

DROP TABLE IF EXISTS `app_users_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_users_profiles` (
  `UserId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(10) NOT NULL,
  `LastName` varchar(10) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Image` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`UserId`),
  CONSTRAINT `app_users_profiles_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `app_users` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-21  0:47:03
