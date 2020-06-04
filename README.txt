-- Below you find the code to install our database locally (hope it works)

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2020 at 02:37 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/_!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT _/;
/_!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS _/;
/_!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION _/;
/_!40101 SET NAMES utf8mb4 _/;

--
-- Database: `elearning`
--

## DELIMITER \$\$

## -- Procedures

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_UserAchievement` (IN `userID` VARCHAR(10), IN `achievementID` VARCHAR(10)) BEGIN
INSERT INTO userachievement VALUES(userID, achievementID, true) ON DUPLICATE KEY UPDATE userID= userID;

END\$\$

DELIMITER ;

---

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
`achievementID` int(10) NOT NULL,
`name` varchar(30) DEFAULT NULL,
`imageURL` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `achievement`
--

INSERT INTO `achievement` (`achievementID`, `name`, `imageURL`) VALUES
(9001, 'Passed first test', 'assets/ach_1test.svg'),
(9002, '100% test score', 'assets/ach_2hundred.svg'),
(9003, 'Unlocked 3 modules', 'assets/ach_3modules.svg'),
(9004, 'Completed 5 segments', 'assets/ach_4segment.svg'),
(9005, 'Completed full course', 'assets/ach_5completed.svg');

---

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
`userID` int(10) NOT NULL,
`segmentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

---

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
`exerciseID` int(10) NOT NULL,
`exerciseContent` varchar(1000) DEFAULT NULL,
`correctAnswer` varchar(500) DEFAULT NULL,
`segmentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`exerciseID`, `exerciseContent`, `correctAnswer`, `segmentID`) VALUES
(3001, 'What does a relational database consist of?', 'Tables', 2001),
(3002, 'What MUST a primary key be?', 'Unique', 2002),
(3003, 'Is a NON-relational database structured or unstructured?', 'Unstructured', 2003),
(3004, 'What does normalization eliminate?', 'Redundant data', 2004),
(3005, 'What is the primary key in table above?', 'emp_id', 2005),
(3006, 'What do you call the primary key in the second table?', 'Composite key', 2006),
(3007, 'Fill in \'abcde\'.', 'abcde', 2007),
(3008, 'Fill in \'abcde\'.', 'abcde', 2008),
(3009, 'Fill in \'abcde\'.', 'abcde', 2009),
(3010, 'Select all the records from a table “Friends” in the columns “ID” and “Gender”', 'SELECT FirstName, ID FROM Gender;', 2010),
(3011, 'Fill in \'abcde\'.', 'abcde', 2011),
(3012, 'Fill in \'abcde\'.', 'abcde', 2012),
(3013, 'Fill in \'abcde\'.', 'abcde', 2013),
(3014, 'Fill in \'abcde\'.', 'abcde', 2014),
(3015, 'Fill in \'abcde\'.', 'abcde', 2015),
(3016, 'Fill in \'abcde\'.', 'abcde', 2016),
(3017, 'Fill in \'abcde\'.', 'abcde', 2017),
(3018, 'Fill in \'abcde\'.', 'abcde', 2018);

---

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
`moduleID` int(10) NOT NULL,
`title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`moduleID`, `title`) VALUES
(1001, 'Relational Database'),
(1002, 'Database Normalization'),
(1003, 'Entity Relationship Diagram'),
(1004, 'SQL Basics'),
(1005, 'Installing a relational database'),
(1006, 'Connecting a database');

---

--
-- Table structure for table `moduleprogress`
--

CREATE TABLE `moduleprogress` (
`userID` int(10) NOT NULL,
`moduleID` int(10) NOT NULL,
`unlocked` tinyint(1) DEFAULT 0,
`completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `moduleprogress`
--
DELIMITER \$\$
CREATE TRIGGER `ach3_unlocked` AFTER UPDATE ON `moduleprogress` FOR EACH ROW BEGIN
IF (SELECT COUNT(\*) FROM moduleprogress WHERE userID= NEW.userID AND unlocked = 1) > 3
THEN CALL add_UserAchievement(NEW.userID, 9003);
END IF;
END

$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ach5_fullcourse` AFTER UPDATE ON `moduleprogress` FOR EACH ROW BEGIN

	IF (SELECT COUNT(*) FROM moduleprogress WHERE userID= NEW.userID AND completed = 1) =  (SELECT COUNT(*) FROM module)
		THEN CALL add_UserAchievement(NEW.userID, 9005);
		END IF;
    END
$$

DELIMITER ;

---

--
-- Table structure for table `moduletest`
--

CREATE TABLE `moduletest` (
`testID` int(10) NOT NULL,
`moduleID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moduletest`
--

INSERT INTO `moduletest` (`testID`, `moduleID`) VALUES
(4001, 1001),
(4002, 1002),
(4003, 1003),
(4004, 1004),
(4005, 1005),
(4006, 1006);

---

--
-- Table structure for table `segment`
--

CREATE TABLE `segment` (
`segmentID` int(10) NOT NULL,
`title` varchar(40) DEFAULT NULL,
`explanation` varchar(5000) DEFAULT NULL,
`mediaURL` varchar(300) DEFAULT NULL,
`moduleID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `segment`
--

INSERT INTO `segment` (`segmentID`, `title`, `explanation`, `mediaURL`, `moduleID`) VALUES
(2001, 'What is a relational database?', '<p class=\"bold\">History</p>\r\n<p>The first to mention the term relational database was Edgar F. Codd in 1962. Working at IBM, he saw major disadvantages in the navigational databases that were used at the time. According to him, not only they were over-complicated to use, but there was no solid theory to back the principles up. Trying to solve these issues, he wrote a paper called A Relational Model of Data for Large Shared Data Banks. IBM was reluctant to put his ideas into practice. However, because of this groundbreaking work to redefine database models, Edgar F. Codd received the prestigious Turing Award in 1981.</p>\r\n<p class=\"bold\">Tables</p>\r\n<p>It’s rather common for a database of this type to have up to thousands of tables. A relationship in database design is established when two or more of them hold some related data and therefore are linked together. Not only this simplifies data maintenance, but it also increases its integrity and security. Relational databases are easier to scale and expand too.</p>\r\n<p class=\"bold\">Relationships</p>\r\n<p>There are three types of relationships in database design. The most common ones are:\r\n<ul>\r\n<li><span class=\"bold\">One-to-many</span>: a row in one table can match multiple rows in the other, but not vice versa.</li>\r\n<li><span class=\"bold\">Many-to-many</span>: a row in one table can match multiple rows in the other and vice versa.</li>\r\n<li><span class=\"bold\">One-to-one</span>: a row in a table can only match one row in the other. </li>\r\n</ul>\r\n</p>', NULL, 1001),
(2002, 'Keys and other properties', '<p>Keys are a crucial part of a relational database. They are used to identify a row in a table and establish relationships between tables.</p>\r\n\r\n<p class=\"bold\">Primary keys (PK)</p>\r\n<p>The primary key of a table consists of one or more columns, whose data is unique to the row in the table. We use the primary key to identify the row, therefore it can never be blank or NULL.</p>\r\n<p>A primary key can also consist of more than one column, in this case the primary key is called a composite or compound key. This means that the combination of the data in both columns is used to uniquely identify the row instead of just one value.</p>\r\n\r\n<p class=\"bold\">Foreign keys (PK)</p>\r\n<p>A foreign key can consist of one or more columns in a table that refer to a primary key in a different table. They are not mandatory for a relational table, but are essential in establishing relationships between tables. Foreign keys can be part of the primary (composite) key in a table. </p>\r\n\r\n<p class=\"bold\">Other properties of relational databases:</p>\r\n<ul>\r\n<li>Values are atomic.</li>\r\n<li>All of the values in a column have the same data type.</li>\r\n<li>Each row is unique.</li>\r\n<li>The sequence of columns is insignificant.</li>\r\n<li>The sequence of rows is insignificant.</li>\r\n<li>Each column has a unique name.</li>\r\n<li>Integrity constraints maintain data consistency across multiple tables.</li>\r\n</ul>\r\n', NULL, 1001),
(2003, 'Relational vs. Non-relational', '<p class=\"bold\">Non-relational databases</p>\r\n<p>Unlike its relational counterparts, no-sql databases allow far more flexibility and adaptability as you design your application. If your data requirements aren’t clear at the outset or if you’re dealing with massive amounts of unstructured data, you may not have the luxury of developing a relational database with clearly defined tables and relationships.</p>\r\n\r\n<p>NoSQL databases are document-oriented. Instead of using tables, these documents allow us to store unstructured data in a single document. So a document could contain a customer\'s details, as well as all their orders to date, their favourites, etc. This is more intuitive and requires fewer hops across tables to find all the data relating to a customer. The storage will not be as highly organized at with an Relational Database.</p>\r\n\r\n<p class=\"bold\">Use Relational SQL Databases when:</p>\r\n<ul>\r\n<li>You will enforce the ACID (Atomicity, Consistency, Isolation, Durability) principles. This reduces anomalies, enforces integrity and that is why this is preferred for commerce and financial applications.</li>\r\n<li>Your data structure is not changing. If you application design is solid and not expected to be changing with future requirements (at least not very often) then you may proceed to use this type of construct and be confident in your data.</li>\r\n</ul>\r\n<p class=\"bold\">Use Non-Relational No-SQL Databases when: </p>\r\n<ul>\r\n<li>You are doing Rapid Application Development. No-SQL database supporting rapidly changing designs and coding sprints and is perfect for more Agile settings, where requirements change often.</li>\r\n<li>You\'re storing large amounts of data with little to no structure. Much like expressed in the previous point, if your data requirements are not clear, bu you know that you need to store lots of data somewhere and somehow, then you can use this database type, which you can morph on the fly to match the requirement.</li>\r\n</ul>', NULL, 1001),
(2004, 'What is Normalization? ', '<p>When we think about database design, normalization is an important technique to optimize the structure of our database tables. It is a multi-step process that removes duplicate data from tables according to form rules.</p>\r\n<p>Normalization has two main objectives:</p>\r\n<ul>\r\n<li>To eliminate redundant data (repetition)</li>\r\n<li>To ensure that data dependencies are logically stored and make sense</li>\r\n</ul>\r\n\r\n<p> Some facts about Database Normalization:</p>\r\n<ul>\r\n<li>The words normalization and normal form refer to the structure of a database.\r\n<li>It was developed by IBM researcher E.F. Codd In the 1970s.\r\n</ul>\r\n', 'https://www.youtube.com/watch?v=xoTyrdT9SZI&t=21s', 1002),
(2005, 'First Normal Form (1NF)', '<p>A table is in 1 NF if:</p>\r\n<ul>\r\n<li> There are only Single Valued Attributes.\r\n<li>Attribute Domain does not change.\r\n<li>There is a Unique name for every Attribute/Column.\r\n<li>The order in which data is stored, does not matter.\r\n</ul>\r\n\r\n <p class=\"bold\">Not normalized table</p>\r\n <table>\r\n <tbody>\r\n <tr>\r\n <td>emp_id</td>\r\n <td>emp_name</td>\r\n <td>emp_lastname</td>\r\n <td>emp_dept</td>\r\n </tr>\r\n <tr>\r\n <td>101</td>\r\n <td>Chandler</td>\r\n <td>Bing</td>\r\n <td>D001, D002</td>\r\n </tr>\r\n <tr>\r\n <td>123</td>\r\n <td>Rachel</td>\r\n <td>Green</td>\r\n <td>D890</td>\r\n </tr>\r\n <tr>\r\n <td>166</td>\r\n <td>Phoebe</td>\r\n <td>Buffay</td>\r\n <td>D900, D004</td>\r\n </tr>\r\n </tbody>\r\n </table>\r\n <p class=\"bold\">Normalized to 1NF</p>\r\n <table>\r\n <tbody>\r\n <tr>\r\n <td>emp_id</td>\r\n <td>emp_name</td>\r\n <td>emp_lastname</td>\r\n <td>emp_dept</td>\r\n </tr>\r\n <tr>\r\n <td>101</td>\r\n <td>Chandler</td>\r\n <td>Bing</td>\r\n <td>D001</td>\r\n </tr>\r\n <tr>\r\n <td>101</td>\r\n <td>Chandler</td>\r\n <td>Bing</td>\r\n <td>D002</td>\r\n </tr>\r\n <tr>\r\n <td>123</td>\r\n <td>Rachel</td>\r\n <td>Green</td>\r\n <td>D890</td>\r\n </tr>\r\n <tr>\r\n <td>166</td>\r\n <td>Phoebe</td>\r\n <td>Buffay</td>\r\n <td>D900</td>\r\n </tr>\r\n <tr>\r\n <td>166</td>\r\n <td>Phoebe</td>\r\n <td>Buffay</td>\r\n <td>D004</td>\r\n </tr>\r\n </tbody>\r\n </table>\r\n', 'https://www.youtube.com/watch?v=mUtAPbb1ECM', 1002),
(2006, '2NF & 3NF', '<p>A database is in <span class=\"bold\">second normal form (2NF)</span> if it satisfies the following conditions:</p>\r\n<ul>\r\n<li>It is in first normal form\r\n<li>All non-key attributes are fully functional dependent on the primary key\r\n</ul>\r\n\r\n<p>A database is in <span class=\"bold\">third normal form (3NF)</span> if it satisfies the following conditions:</p>\r\n<ul> \r\n<li>It is in second normal form.\r\n<li>There is no transitive functional dependency.\r\n</ul>\r\n\r\n\r\n <p class=\"bold\">Normalized to 2NF and 3NF</p>\r\n <table>\r\n <tbody>\r\n <tr>\r\n <th>emp_id</th>\r\n <th>emp_name</th>\r\n <th>emp_lastname</th>\r\n </tr>\r\n <tr>\r\n <td>101</td>\r\n <td>Chandler</td>\r\n <td>Bing</td>\r\n </tr>\r\n <tr>\r\n <td>123</td>\r\n <td>Rachel</td>\r\n <td>Green</td>\r\n </tr>\r\n <tr>\r\n <td>166</td>\r\n <td>Phoebe</td>\r\n <td>Buffay</td>\r\n </tr>\r\n </tbody>\r\n </table>\r\n <table>\r\n <tbody>\r\n <tr>\r\n <th>emp_id</th>\r\n <th>emp_dept</th>\r\n </tr>\r\n <tr>\r\n <td>101</td>\r\n <td>D001</td>\r\n </tr>\r\n <tr>\r\n <td>101</td>\r\n <td>D002</td>\r\n </tr>\r\n <tr>\r\n <td>123</td>\r\n <td>D890</td>\r\n </tr>\r\n <tr>\r\n <td>166</td>\r\n <td>D900</td>\r\n </tr>\r\n <tr>\r\n <td>166</td>\r\n <td>D004</td>\r\n </tr>\r\n </tbody>\r\n </table>\r\n\r\n\r\n', 'https://www.youtube.com/watch?v=R7UblSu4744', 1002),
(2007, 'What is an ERD?', '<p>Entity Relationship Diagram, also known as ERD, ER Diagram or ER model, is a type of structural diagram for use in database design. An ERD contains different symbols and connectors that visualize two important information: The major entities within the system scope, and the inter-relationships among these entities.</p>\r\n\r\n<p class=\"bold\">And that\'s why it\'s called \"Entity\" \"Relationship\" diagram (ERD)!</p>\r\n<p>When we talk about entities in ERD, very often we are referring to business objects such as people/roles (e.g. Student), tangible business objects (e.g. Product), intangible business objects (e.g. Log), etc. \"Relationship\" is about how these entities relate to each other within the system.</p>\r\n\r\n<img width=\"90%\" src=\"https://d2slcw3kip6qmk.cloudfront.net/marketing/pages/chart/examples/entityrelationshipdiagram.svg\" />', 'https://www.youtube.com/watch?v=QpdhBUYk7Kk', 1003),
(2008, 'Relationship Cardinality', '<p>Cardinality defines the possible number of occurrences in one entity which is associated with the number of occurrences in another. For example, ONE team has MANY players. When present in an ERD, the entity Team and Player are inter-connected with a one-to-many relationship.</p>\r\n\r\n<p>In an ER diagram, cardinality is represented as a crow\'s foot at the connector\'s ends. The three common cardinal relationships are one-to-one, one-to-many, and many-to-many.</p>\r\n\r\n<p class=\"bold\">One-to-One cardinality</p>\r\n<p>A one-to-one relationship is mostly used to split an entity in two to provide information concisely and make it more understandable.</p>\r\n\r\n<p class=\"bold\">One-to-Many cardinality</p>\r\n<p>A one-to-many relationship refers to the relationship between two entities X and Y in which an instance of X may be linked to many instances of Y, but an instance of Y is linked to only one instance of X.</p>\r\n\r\n<p class=\"bold\">Many-to-Many cardinality</p>\r\n<p>A many-to-many relationship refers to the relationship between two entities X and Y in which X may be linked to many instances of Y and vice versa. </p>', '', 1003),
(2009, 'ER Data Models', '<p>An ER model is typically drawn at up to three levels of abstraction:</p>\r\n<ul>\r\n<li>Conceptual ERD / Conceptual data model</li>\r\n<li>Logical ERD / Logical data model</li>\r\n<li>Physical ERD / Physical data model</li>\r\n</ul>\r\n<p>While all the three levels of an ER model contain entities with attributes and relationships, they differ in the purposes they are created for and the audiences they are meant to target.</p>\r\n\r\n<p>A general understanding to the three data models is that business analyst uses a conceptual and logical model to model the business objects exist in the system, while database designer or database engineer elaborates the conceptual and logical ER model to produce the physical model that presents the physical database structure ready for database creation. The table below shows the difference between the three data models.</p>\r\n', NULL, 1003),
(2010, 'SELECT', ' <p>The SELECT statement is used to select data from a database.\r\n The data returned is stored in a result table, called the result-set.</p><br>\r\n \r\n <p class=\"bold\">SYNTAX</p>\r\n <div>\r\n <p>Select all columns from a table</p>\r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxCode\">SELECT \* FROM table_name;</p>\r\n </div>\r\n </div>\r\n <div>\r\n <p>Select specific columns from a table</p>\r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxCode\">SELECT column1, column2, … <br>\r\n FROM table_name;</p>\r\n </div>\r\n </div>\r\n </div>\r\n <div>\r\n <p class=bold”>To select all first names and occupation from Friends table:</p>\r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxExample\">SELECT FirstName, Occupation FROM Friends;</p>\r\n </div>\r\n </div>', 'assets/segment_2010.jpg', 1004),
(2011, 'INSERT INTO', '<p>The INSERT INTO statement is used to insert new records in a table.</p>\r\n <p class=\"bold\">SYNTAX</p>\r\n <div>\r\n <p>Insert data into a table</p>\r\n <div class=\"div--syntaxBackground\">\r\n \r\n <p class=\"p--syntaxCode\">INSERT INTO table_name (column1, column2, column3, ...)<br>\r\n VALUES (value1, value2, value3, ...);</p>\r\n </div>\r\n </div>\r\n <div>\r\n <p class=\"bold\">Insert a new person into Friends table</p>\r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxExample\">INSERT INTO Friends (FirstName, LastName, Status, Occupation, Gender, Kids)<br>\r\n VALUES (‘Gunther\', NULL , ‘single’, ‘barista’, ‘M’, 0 );</p>\r\n </div>\r\n </div>\r\n \r\n <p>Note: The CustomerID column is an auto-increment field and will be generated automatically when a new record is\r\n inserted into the table.</p>', 'assets/segment_2011.jpg', 1004),
(2012, 'UPDATE and DELETE', ' <p>The UPDATE statement is used to modify the existing records in a table.</p>\r\n \r\n <p class=\"bold\">SYNTAX</p>\r\n <div>\r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxCode\">UPDATE table_name<br>\r\n SET column1 = value1, column2 = value2, …<br>\r\n WHERE condition;</p>\r\n </div>\r\n </div>\r\n \r\n <div>\r\n <p class=\"bold\">Update the FirstName to “Regina” and LastName to \'Phalange\' for the person with ID “3”</p>\r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxExample\">UPDATE Friends<br>\r\n SET FirstName = \'Regina’, LastName = \'Phalange\'<br>\r\n WHERE CustomerID = 3;</p>\r\n </div>\r\n </div>\r\n <p>NOTE : Be careful when updating records. If you omit the WHERE clause, ALL records will be updated!</p>\r\n <hr><br>\r\n <p>The DELETE statement is used to delete the existing records from a table.</p>\r\n \r\n <p class=\"bold\">SYNTAX</p>\r\n \r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxCode\">DELETE FROM table_name WHERE condition;</p>\r\n </div>\r\n \r\n <div>\r\n <p class=\"bold\">Delete the records where the “FirstName” is “Gunther” in the Friends Table.</p>\r\n <div class=\"div--syntaxBackground\">\r\n <p class=\"p--syntaxExample\">DELETE FROM Friends WHERE FirstName= \'Gunther\';</p>\r\n </div>\r\n </div>', 'assets/segment_2012.jpg', 1004),
(2013, 'Segment 13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 1005),
(2014, 'Segment 14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 1005),
(2015, 'Segment 15', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 1005),
(2016, 'Segment 16', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 1006),
(2017, 'Segment 17', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 1006),
(2018, 'Segment 18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 1006);

---

--
-- Table structure for table `segmentprogress`
--

CREATE TABLE `segmentprogress` (
`userID` int(10) NOT NULL,
`segmentID` int(10) NOT NULL,
`completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `segmentprogress`
--
DELIMITER \$\$
CREATE TRIGGER `ach4_segments` AFTER UPDATE ON `segmentprogress` FOR EACH ROW BEGIN

    IF (SELECT COUNT(*) FROM segmentprogress WHERE userID= NEW.userID AND completed= 1) > 4
    	THEN CALL add_UserAchievement(NEW.userID, 9004);
    	END IF;
    END

$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `testquestion`
--

CREATE TABLE `testquestion` (
  `questionID` int(10) NOT NULL,
  `questionContent` varchar(5000) DEFAULT NULL,
  `choiceA` varchar(80) NOT NULL DEFAULT 'A',
  `choiceB` varchar(80) NOT NULL DEFAULT 'B',
  `choiceC` varchar(80) NOT NULL DEFAULT 'C',
  `choiceD` varchar(80) NOT NULL DEFAULT 'D',
  `correctAnswer` varchar(80) DEFAULT NULL,
  `testID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testquestion`
--

INSERT INTO `testquestion` (`questionID`, `questionContent`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `correctAnswer`, `testID`) VALUES
(5001, 'Who first mentioned the term Relational Database?', 'Abraham Lincoln', 'Edgar F. Codd', 'Bill Gates', 'Donald Trump', 'Edgar F. Codd', 4001),
(5002, 'Which of these answers is NOT a relationship type in a relational database?', 'Many-to-many', 'One-to-many', 'Zero-to-one', 'One-to-one', 'Zero-to-one', 4001),
(5003, 'What do you use to identify a row in a table in a relational database?', 'Foreign key', 'Transit key', 'Low key', 'Primary key', 'Primary key', 4001),
(5004, 'Which statement is true?', 'The sequence of columns is insignificant.', 'A row doesn\'t have to be unique.', 'A primary key always consists of 1 column.', 'Foreign keys cannot be part of a primary key.', 'The sequence of columns is insignificant.', 4001),
(5005, 'What is the biggest advantage of non-relational databases over relational databases?', 'Better organization of data', 'Flexibility and adaptability', 'Easier to create', 'Faster query times', 'Flexibility and adaptability', 4001),
(5006, 'What is one of the main objectives of normalization?', 'To confuse people', 'To add extra tables to the database', 'To eliminate redundant data', 'To split data', 'To eliminate redundant data', 4002),
(5007, 'What do values need to be in 1NF?', 'Anatomic', 'Atomic', 'Atonic', 'Astronomic', 'Atomic', 4002),
(5008, 'What form is this table?\r\n                    <table>\r\n                        <tbody>\r\n                            <tr>\r\n                                <td>emp_id</td>\r\n                                <td>emp_name</td>\r\n                                <td>emp_lastname</td>\r\n                                <td>emp_dept</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>101</td>\r\n                                <td>Chandler</td>\r\n                                <td>Bing</td>\r\n                                <td>D001, D002</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>123</td>\r\n                                <td>Rachel</td>\r\n                                <td>Green</td>\r\n                                <td>D890</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>166</td>\r\n                                <td>Phoebe</td>\r\n                                <td>Buffay</td>\r\n                                <td>D900, D004</td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>', '1NF', '2NF', '3NF', 'Not normalized', 'Not normalized', 4002),
(5009, 'What form is this table?\r\n <table>\r\n                        <tbody>\r\n                            <tr>\r\n                                <td>emp_id</td>\r\n                                <td>emp_name</td>\r\n                                <td>emp_lastname</td>\r\n                                <td>emp_dept</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>101</td>\r\n                                <td>Chandler</td>\r\n                                <td>Bing</td>\r\n                                <td>D001</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>101</td>\r\n                                <td>Chandler</td>\r\n                                <td>Bing</td>\r\n                                <td>D002</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>123</td>\r\n                                <td>Rachel</td>\r\n                                <td>Green</td>\r\n                                <td>D890</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>166</td>\r\n                                <td>Phoebe</td>\r\n                                <td>Buffay</td>\r\n                                <td>D900</td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td>166</td>\r\n                                <td>Phoebe</td>\r\n                                <td>Buffay</td>\r\n                                <td>D004</td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>', 'Not normalized', '2NF', '1NF', '2NF and 3NF', '1NF', 4002),
(5010, 'Do you love normalization?', 'Absolutely!', 'No, kill me now.', 'Best thing that ever happened to me.', 'I have no opinion.', 'Best thing that ever happened to me.', 4002),
(5011, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4003),
(5012, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4003),
(5013, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4003),
(5014, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4003),
(5015, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4003),
(5016, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4004),
(5017, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4004),
(5018, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4004),
(5019, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4004),
(5020, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4004),
(5021, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4005),
(5022, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4005),
(5023, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4005),
(5024, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4005),
(5025, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4005),
(5026, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4006),
(5027, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4006),
(5028, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4006),
(5029, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4006),
(5030, 'I am a test question, pick an answer.', 'A', 'B', 'C', 'D', 'B', 4006);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(10) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `lastName` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userachievement`
--

CREATE TABLE `userachievement` (
  `userID` int(10) NOT NULL,
  `achievementID` int(10) NOT NULL,
  `unread` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usertestanswer`
--

CREATE TABLE `usertestanswer` (
  `userID` int(10) NOT NULL,
  `questionID` int(10) NOT NULL,
  `correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usertestresult`
--

CREATE TABLE `usertestresult` (
  `userID` int(10) NOT NULL,
  `testID` int(10) NOT NULL,
  `testScore` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `usertestresult`
--
DELIMITER $$
CREATE TRIGGER `ach1_insert` AFTER INSERT ON `usertestresult` FOR EACH ROW BEGIN
	IF (SELECT COUNT(*) FROM usertestresult WHERE userID= NEW.userID AND testScore >79) = 1
		THEN CALL add_UserAchievement(NEW.userID, 9001);
		END IF;
    END
$$

DELIMITER ;
DELIMITER \$\$
CREATE TRIGGER `ach1_update` AFTER UPDATE ON `usertestresult` FOR EACH ROW BEGIN
IF (SELECT COUNT(\*) FROM usertestresult WHERE userID= NEW.userID AND testScore >79) = 1
THEN CALL add_UserAchievement(NEW.userID, 9001);
END IF;
END

$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ach2_insert` AFTER INSERT ON `usertestresult` FOR EACH ROW BEGIN
IF NEW.testScore = 100 THEN
CALL add_UserAchievement(NEW.userID, 9002);
END IF;

END
$$

DELIMITER ;
DELIMITER \$\$
CREATE TRIGGER `ach2_update` AFTER UPDATE ON `usertestresult` FOR EACH ROW BEGIN
IF NEW.testScore = 100 THEN
CALL add_UserAchievement(NEW.userID, 9002);
END IF;

END

$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`achievementID`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`userID`,`segmentID`),
  ADD KEY `segmentID` (`segmentID`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`exerciseID`),
  ADD KEY `segmentID` (`segmentID`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`moduleID`);

--
-- Indexes for table `moduleprogress`
--
ALTER TABLE `moduleprogress`
  ADD PRIMARY KEY (`userID`,`moduleID`),
  ADD KEY `moduleID` (`moduleID`);

--
-- Indexes for table `moduletest`
--
ALTER TABLE `moduletest`
  ADD PRIMARY KEY (`testID`) USING BTREE,
  ADD KEY `moduleID` (`moduleID`);

--
-- Indexes for table `segment`
--
ALTER TABLE `segment`
  ADD PRIMARY KEY (`segmentID`),
  ADD KEY `moduleID` (`moduleID`);

--
-- Indexes for table `segmentprogress`
--
ALTER TABLE `segmentprogress`
  ADD PRIMARY KEY (`userID`,`segmentID`),
  ADD KEY `segmentID` (`segmentID`);

--
-- Indexes for table `testquestion`
--
ALTER TABLE `testquestion`
  ADD PRIMARY KEY (`questionID`),
  ADD KEY `testID` (`testID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `userachievement`
--
ALTER TABLE `userachievement`
  ADD PRIMARY KEY (`userID`,`achievementID`),
  ADD KEY `achievementID` (`achievementID`);

--
-- Indexes for table `usertestanswer`
--
ALTER TABLE `usertestanswer`
  ADD PRIMARY KEY (`userID`,`questionID`),
  ADD KEY `questionID` (`questionID`);

--
-- Indexes for table `usertestresult`
--
ALTER TABLE `usertestresult`
  ADD PRIMARY KEY (`userID`,`testID`),
  ADD KEY `testID` (`testID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `achievementID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9006;

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `exerciseID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3019;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `moduleID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- AUTO_INCREMENT for table `moduletest`
--
ALTER TABLE `moduletest`
  MODIFY `testID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4008;

--
-- AUTO_INCREMENT for table `segment`
--
ALTER TABLE `segment`
  MODIFY `segmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2019;

--
-- AUTO_INCREMENT for table `testquestion`
--
ALTER TABLE `testquestion`
  MODIFY `questionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5036;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=888018;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmark_ibfk_2` FOREIGN KEY (`segmentID`) REFERENCES `segment` (`segmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exercise`
--
ALTER TABLE `exercise`
  ADD CONSTRAINT `exercise_ibfk_1` FOREIGN KEY (`segmentID`) REFERENCES `segment` (`segmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moduleprogress`
--
ALTER TABLE `moduleprogress`
  ADD CONSTRAINT `moduleprogress_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moduleprogress_ibfk_2` FOREIGN KEY (`moduleID`) REFERENCES `module` (`moduleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moduletest`
--
ALTER TABLE `moduletest`
  ADD CONSTRAINT `moduletest_ibfk_1` FOREIGN KEY (`moduleID`) REFERENCES `module` (`moduleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `segment`
--
ALTER TABLE `segment`
  ADD CONSTRAINT `segment_ibfk_1` FOREIGN KEY (`moduleID`) REFERENCES `module` (`moduleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `segmentprogress`
--
ALTER TABLE `segmentprogress`
  ADD CONSTRAINT `segmentprogress_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `segmentprogress_ibfk_2` FOREIGN KEY (`segmentID`) REFERENCES `segment` (`segmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testquestion`
--
ALTER TABLE `testquestion`
  ADD CONSTRAINT `testquestion_ibfk_1` FOREIGN KEY (`testID`) REFERENCES `moduletest` (`testID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userachievement`
--
ALTER TABLE `userachievement`
  ADD CONSTRAINT `userachievement_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userachievement_ibfk_2` FOREIGN KEY (`achievementID`) REFERENCES `achievement` (`achievementID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertestanswer`
--
ALTER TABLE `usertestanswer`
  ADD CONSTRAINT `usertestanswer_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usertestanswer_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `testquestion` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertestresult`
--
ALTER TABLE `usertestresult`
  ADD CONSTRAINT `usertestresult_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usertestresult_ibfk_2` FOREIGN KEY (`testID`) REFERENCES `moduletest` (`testID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
$$
