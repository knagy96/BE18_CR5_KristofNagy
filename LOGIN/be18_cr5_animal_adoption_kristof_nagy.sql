/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL AUTO_INCREMENT,
  `animal_name` varchar(50) NOT NULL,
  `species_of_animal` varchar(50) NOT NULL,
  `animal_age` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `vacinated` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available',
  `animal_picture` varchar(255) NOT NULL,
  PRIMARY KEY (`animal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

CREATE TABLE `pet_adoption` (
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `adoptation_date` date NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `pet_id` (`pet_id`),
  CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animals` (`animal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `password` varchar(225) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `animals` (`animal_id`, `animal_name`, `species_of_animal`, `animal_age`, `location`, `vacinated`, `status`, `animal_picture`) VALUES
(1, 'Pablo', 'Dog', '6 ', 'Vienna', 'Yes', 'available', 'https://cdn.pixabay.com/photo/2016/12/13/05/15/puppy-1903313__340.jpg');
INSERT INTO `animals` (`animal_id`, `animal_name`, `species_of_animal`, `animal_age`, `location`, `vacinated`, `status`, `animal_picture`) VALUES
(2, 'Luise', 'cat', '1', 'Linz', 'Yes', 'adopted', 'https://cdn.pixabay.com/photo/2023/03/09/20/02/cat-7840767_960_720.jpg');
INSERT INTO `animals` (`animal_id`, `animal_name`, `species_of_animal`, `animal_age`, `location`, `vacinated`, `status`, `animal_picture`) VALUES
(3, 'Fredy', 'cat', '1', 'Vienna', 'Yes', 'available', 'https://cdn.pixabay.com/photo/2017/02/20/18/03/cat-2083492_960_720.jpg');
INSERT INTO `animals` (`animal_id`, `animal_name`, `species_of_animal`, `animal_age`, `location`, `vacinated`, `status`, `animal_picture`) VALUES
(4, 'Foxi', 'cat', '6 ', 'Vienna', 'yes', 'available', 'https://cdn.pixabay.com/photo/2015/11/16/22/14/cat-1046544__340.jpg'),
(5, 'Koko', 'cat', '7 ', 'Vienna', 'Yes', 'available', 'https://cdn.pixabay.com/photo/2017/03/14/14/49/cat-2143332__340.jpg'),
(6, 'Wolfgang', 'Dog', '2', 'Graz', 'Yes', 'available', 'https://cdn.pixabay.com/photo/2016/01/29/20/54/dog-1168663__340.jpg'),
(7, 'Biggie', 'dog', '8 ', 'Vienna', 'Yes', 'adopted', 'https://cdn.pixabay.com/photo/2016/11/23/18/06/dog-1854119__340.jpg'),
(8, 'Chewi', 'dog', '5 ', 'Vienna', 'Yes', 'available', 'https://cdn.pixabay.com/photo/2016/03/27/21/16/pet-1284307__340.jpg'),
(9, 'Monster', 'dog', '9', 'St. Pölten', 'yes', 'reserved', 'https://cdn.pixabay.com/photo/2015/11/03/12/58/dalmatian-1020790__340.jpg');

INSERT INTO `pet_adoption` (`user_id`, `pet_id`, `adoptation_date`) VALUES
(1, 2, '2023-04-01');
INSERT INTO `pet_adoption` (`user_id`, `pet_id`, `adoptation_date`) VALUES
(1, 2, '2023-04-01');
INSERT INTO `pet_adoption` (`user_id`, `pet_id`, `adoptation_date`) VALUES
(1, 2, '2023-04-01');
INSERT INTO `pet_adoption` (`user_id`, `pet_id`, `adoptation_date`) VALUES
(1, 2, '2023-04-01'),
(1, 7, '2023-04-01');

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(1, 'Kristof', 'Nagy', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '0000-00-00', 'kristof@gmail.com', '6427006f2065b.jpg', 'user');
INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(2, 'Admin', 'Admin', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '2023-03-02', 'admin@gmail.com', 'avatar.png', 'adm');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;