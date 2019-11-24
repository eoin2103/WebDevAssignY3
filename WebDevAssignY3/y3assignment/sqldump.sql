-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 03:20 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_name` varchar(100) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `book_ISBN` varchar(20) NOT NULL,
  `year_published` varchar(8) NOT NULL,
  `book_availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_name`, `book_author`, `book_ISBN`, `year_published`, `book_availability`) VALUES
('The Outsiders', 'S.E. Hinton', '014038572X', '1967', 1),
('Paper Towns', 'John Green', '014241493X', '2008', 1),
('Jurassic Park', 'Michael Crichton', '030734813X', '1990', 1),
('Breaking Dawn', 'Stephenie Meyer', '031606792X', '2008', 1),
('Harry Potter and the Prisoner of Azkaban', 'J.K. Rowling', '043965548X', '1999', 1),
('The Glass Castle', 'Jeannette Walls', '074324754X', '2005', 1),
('The Curious Incident of the Dog in the Night-Time', 'Mark Haddon', '1400032717', '2003', 1),
('Lord of the Flies', 'William Golding', '140283331', '1954', 1),
('\'Frankenstein; or, The Modern Prometheus\'', 'Mary Wollstonecraft Shelley', '141439475', '1818', 1),
('A Tale of Two Cities', 'Charles Dickens', '141439602', '1859', 1),
('Sense and Sensibility', 'Jane Austen', '141439661', '1811', 1),
('Angels & Demons', 'Dan Brown', '1416524797', '2000', 1),
('City of Bones', 'Cassandra Clare', '1416914285', '2007', 1),
('Of Mice and Men', 'John Steinbeck', '142000671', '1937', 1),
('The Secret Life of Bees', 'Sue Monk Kidd', '142001740', '2001', 1),
('Looking for Alaska', 'John Green', '142402516', '2005', 1),
('The Adventures of Huckleberry Finn', 'Guy Cardwell', '142437174', '1884', 1),
('Jane Eyre', 'Charlotte Bront?', '142437204', '1847', 1),
('Eat, pray, love: one womans search for everything across Italy, India and Indonesia\'', 'Elizabeth Gilbert', '143038419', '2006', 1),
('Le Petit Prince', 'Antoine de Saint-Exup?ry', '156012197', '1946', 1),
('Water for Elephants', 'Sara Gruen', '1565125606', '2006', 1),
('The Kite Runner', 'Khaled Hosseini', '1594480001', '2003', 1),
('A Thousand Splendid Suns', 'Khaled Hosseini', '1594489505', '2007', 1),
('The Girl on the Train', 'Paula Hawkins', '1594633665', '2015', 1),
('Fifty Shades of Grey', 'E.L. James', '1612130291', '2011', 1),
('Fifty Shades Darker', 'E.L. James', '1612130585', '2011', 1),
('Gone Girl', 'Gillian Flynn', '297859382', '2012', 1),
('M?n som hatar kvinnor', 'Reg Keeland', '307269752', '2005', 1),
('Flickan som lekte med elden', 'Reg Keeland', '307269981', '2006', 1),
('The Devil Wears Prada', 'Lauren Weisberger', '307275558', '2003', 1),
('The Da Vinci Code', 'Dan Brown', '307277674', '2003', 1),
('Fahrenheit 451', 'Ray Bradbury', '307347974', '1953', 1),
('Twilight', 'Stephenie Meyer', '316015849', '2005', 1),
('The Host', 'Stephenie Meyer', '316068047', '2008', 1),
('\'New Moon (Twilight, #2)\'', 'Stephenie Meyer', '316160199', '2006', 1),
('Eclipse', 'Stephenie Meyer', '316160202', '2007', 1),
('The Lovely Bones', 'Alice Sebold', '316166685', '2002', 1),
('The Catcher in the Rye', 'J.D. Salinger', '316769177', '1951', 1),
('The Hitchhikers Guide to the Galaxy', 'Douglas Adams', '345391802', '1979', 1),
('The Princess Bride', 'William Goldman', '345418263', '1973', 1),
('Fifty Shades Freed', 'E.L. James', '345803507', '2012', 1),
('Un di Velt Hot Geshvign', 'Elie Wiesel', '374500010', '1958', 1),
('The Picture of Dorian Gray', 'Jeffrey Eugenides', '375751513', '1891', 1),
('Eragon', 'Christopher Paolini', '375826696', '2002', 1),
('The Book Thief', 'Markus Zusak', '375831002', '2005', 1),
('Slaughterhouse-Five, or The Childrens Crusade: A Duty-Dance with Death\'', 'Kurt Vonnegut Jr.', '385333846', '1969', 1),
('A Time to Kill', 'John Grisham', '385338600', '1989', 1),
('Into the Wild', 'Jon Krakauer', '385486804', '1996', 1),
('The Giver', 'Lois Lowry', '385732554', '1993', 1),
('The Maze Runner', 'James Dashner', '385737947', '2009', 1),
('Dracula', 'Bram Stoker', '393970124', '1897', 1),
('Wuthering Heights', 'Emily Bront?', '393978893', '1847', 1),
('The Help', 'Kathryn Stockett', '399155341', '2009', 1),
('The Hunger Games', 'Suzanne Collins', '439023483', '2008', 1),
('Catching Fire', 'Suzanne Collins', '439023491', '2009', 1),
('Mockingjay', 'Suzanne Collins', '439023513', '2010', 1),
('Harry Potter and the Chamber of Secrets', 'J.K. Rowling', '439064864', '1998', 1),
('Harry Potter and the Goblet of Fire', 'J.K. Rowling', '439139600', '2000', 1),
('Holes', 'Louis Sachar', '439244196', '1998', 1),
('Harry Potter and the Order of the Phoenix', 'J.K. Rowling', '439358078', '2003', 1),
('Harry Potter and the Philosophers Stone', 'J.K. Rowling', '439554934', '1997', 1),
('Harry Potter and the Half-Blood Prince', 'J.K. Rowling', '439785960', '2005', 1),
('Gone with the Wind', 'Margaret Mitchell', '446675539', '1936', 1),
('The Shining', 'Stephen King', '450040186', '1977', 1),
('Nineteen Eighty-Four', 'Celal Uster', '451524934', '1949', 1),
('Little Women', 'Louisa May Alcott', '451529308', '1868', 1),
('Animal Farm: A Fairy Story', 'George Orwell', '452284244', '1945', 1),
('The Secret Garden', 'Frances Hodgson Burnett', '517189607', '1911', 1),
('The Fault in Our Stars', 'John Green', '525478817', '2012', 1),
('Harry Potter and the Deathly Hallows', 'J.K. Rowling', '545010225', '2007', 1),
('Het Achterhuis: Dagboekbrieven 14 juni 1942 - 1 augustus 1944', 'Anne Frank', '553296981', '1947', 1),
('A Game of Thrones', 'George R.R. Martin', '553588486', '1996', 1),
('The Notebook', 'Nicholas Sparks', '553816713', '1996', 1),
('The Giving Tree', 'Shel Silverstein', '60256656', '1964', 1),
('Where the Sidewalk Ends: The Poems and Drawings of Shel Silverstein', 'Shel Silverstein', '60513039', '1974', 1),
('Cien a?os de soledad', 'Gabriel Garc?a M?rquez', '60531045', '1967', 1),
('\'The Lion, the Witch and the Wardrobe\'', 'C.S. Lewis', '60764899', '1950', 1),
('Brave New World', 'Aldous Huxley', '60929871', '1932', 1),
('To Kill a Mockingbird', 'Harper Lee', '61120081', '1960', 1),
('O Alquimista', 'Alan R. Clarke', '61122416', '1988', 1),
('Freakonomics: A Rogue Economist Explores the Hidden Side of Everything', 'Stephen J. Dubner', '61234001', '2005', 1),
('The Hobbit or There and Back Again', 'J.R.R. Tolkien', '618260307', '1937', 1),
('The Fellowship of the Ring', 'J.R.R. Tolkien', '618346252', '1954', 1),
('Divergent', 'Veronica Roth', '62024035', '2011', 1),
('Charlottes Web', 'E.B. White', '64410935', '1952', 1),
('The Perks of Being a Wallflower', 'Stephen Chbosky', '671027344', '1999', 1),
('Pride and Prejudice', 'Jane Austen', '679783261', '1813', 1),
('Northern Lights', 'Philip Pullman', '679879242', '1995', 1),
('Memoirs of a Geisha', 'Arthur Golden', '739326228', '1997', 1),
('The Great Gatsby', 'F. Scott Fitzgerald', '743273567', '1925', 1),
('My Sisters Keeper', 'Jodi Picoult', '743454537', '2004', 1),
('An Excellent conceited Tragedie of Romeo and Juliet', 'Robert Jackson', '743477111', '1595', 1),
('Insurgent', 'Veronica Roth', '7442912', '2012', 1),
('Life of Pi', 'Yann Martel', '770430074', '2001', 1),
('The Lightning Thief', 'Rick Riordan', '786838655', '2005', 1),
('Enders Game', 'Orson Scott Card', '812550706', '1985', 1),
('The Time Travelers Wife', 'Audrey Niffenegger', '965818675', '2003', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_first_name` varchar(50) NOT NULL,
  `contact_surname` varchar(50) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_subject` varchar(100) NOT NULL,
  `contact_comments` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_first_name`, `contact_surname`, `contact_email`, `contact_subject`, `contact_comments`) VALUES
(1, 'Stephen', 'Healy', 'stephenhealy21@gmail.com', 'Choose a subject...', 't');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `book_ISBN` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`book_ISBN`, `user_id`) VALUES
('141439475', 'bigric'),
('141439602', 'bigric'),
('316160199', 'bigric'),
('439064864', 'bigric'),
('439139600', 'bigric'),
('545010225', 'bigric');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_text`) VALUES
(1, 'what was your first pet\'s name?'),
(2, 'What is your mother\'s maiden name?'),
(3, 'What was the name of your primary school?'),
(4, 'Who was your childhood hero?'),
(5, 'What city did your parents meet in?');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(40) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `security_question` varchar(200) NOT NULL,
  `security_answer` varchar(100) NOT NULL,
  `profile_pic_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `user_id`, `password`, `security_question`, `security_answer`, `profile_pic_path`) VALUES
('joshua', 'bigjosh', 'joshspw', '', '', NULL),
('ricardo', 'bigric', '123', 'how big are my muscles?				', 'very', NULL),
('callam', 'callam', '123', 'What is my favourite colour?				', 'pink', NULL),
('adrian', 'celestion', '4321', 'What was the name of your primary school?', 'poland', 'pics/biblethump.png'),
('Shawn', 'HeartBreakKid', '4321', '', '', NULL),
('kyle', 'heffo99', '4321', 'What city did your parents meet in?', 'Hamilton', NULL),
('henry', 'king', '4321', 'chungus				', 'yes', NULL),
('conor', 'mccool', '4321', 'spoons?				', 'always', NULL),
('ry', 'ry', '$2y$10$JxkEj0c3Vy2NYCFOBncta.qJcVlk27cvskcHQg2EU7Tg0GKPd.HN6', 'what was your first pet\'\'s name?', 'kita', 'pics/archer pete.png'),
('sam', 'sam', '123', 'what was your first pet\'s name?', 'dog', NULL),
('eoin', 'spikyhippo', 'a', 'Who was your childhood hero?', 'Stephen', NULL),
('stephen', 'stevie', '4321', 'what was your first pet', 'chog', NULL),
('peter', 'strongest_avenger', '4321', 'what was your first pet\'s name?', 'odinson', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_ISBN`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`book_ISBN`,`user_id`),
  ADD KEY `book_ISBN` (`book_ISBN`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`book_ISBN`) REFERENCES `book` (`book_ISBN`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
