-- phpMyAdmin Library SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




-- Таблица "Читатели"

CREATE TABLE `readers` (
  `reader_id` INT COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci,
  `phonenumber` VARCHAR(11),
  `email` VARCHAR(100),
  `dateofbirth` DATE,
  `login` VARCHAR(20) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`reader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `readers` (`name`, `phonenumber`, `email`, `dateofbirth`, `login`, `password`) VALUES
('ADMIN', NULL, NULL, NULL, 'admin', '1234'),
('Новокшонов Никита Григорьевич', '89674619881', 'nikita62@ya.ru', '2001-04-27', 'nikita62', 'nikita62'),
('Лесничий Георгий Прохорович', '89727765195', 'georgiyles@mail.ru', '2003-12-26', 'georg', 'les977'),
('Ряхина Валентина Алексеевна', '89749166942', 'val.ryakhina@mail.ru', '2001-08-05', 'valr', 'ryakhina01'),
('Вершинин Даниил Тимофеевич', '89475763888', 'daniilv2000@mail.ru', '2000-11-27', 'daniil', 'versh1dan'),
('Беспалова Мила Никифоровна', '89318547360', 'bespalova@ya.ru', '2002-01-20', 'milabespalova', '120mila'),
('Крутикова Варвара Николаевна', '89639966456', 'varvara11k@mail.ru', '2003-11-06', 'krtvar', 'vrvr22'),
('Марин Иван Николаевич', '89128037499', 'marinivan@ya.ru', '2004-07-07', 'ivanm', 'ivan2004');









-- Таблица "Авторы"

CREATE TABLE `authors` (
  `author_id` INT COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `authors` (`name`) VALUES
('Александр Сергеевич Пушкин'),
('Иван Сергеевич Тургенев'),
('Альберт Эйнштейн'),
('Лев Николаевич Толстой'),
('Федор Михайлович Достоевский'),
('Владимир Иванович Даль'),
('Антон Павлович Чехов'),
('Жюль Верн');








-- Таблица "Виды"

CREATE TABLE `types` (
  `type_id` INT COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `types` (`name`) VALUES
('Художественная литература'),
('Научная литература'),
('Справочная литература'),
('Техническая литература'),
('Документальная литература');









-- Таблица "Издательства"

CREATE TABLE `publishers` (
  `publisher_id` INT COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `adress` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `publishers` (`name`, `city`, `adress`) VALUES
('ОНИКС', 'Москва', 'ул. Новочеремушкинская, 54, 117418'),
('Азбука', 'Санкт-Петербург', 'ул. Решетникова, 15, 196105'),
('Омега-Л', 'Москва', 'ш. Энтузиастов, 56, 111123'),
('Просвещение', 'Москва', '3-й пр. Марьиной Рощи, 41, 127521'),
('Эксмо', 'Москва', 'ул. Зорге, 1, 123308');









-- Таблица "Книги"

CREATE TABLE `books` (
  `book_id` INT COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `year` INT COLLATE utf8_unicode_ci NOT NULL,
  `pages` INT COLLATE utf8_unicode_ci NOT NULL,
  `author_id` INT COLLATE utf8_unicode_ci NOT NULL,
  `type_id` INT COLLATE utf8_unicode_ci NOT NULL,
  `publisher_id` INT COLLATE utf8_unicode_ci NOT NULL,
  `amount` INT NOT NULL,
  PRIMARY KEY (`book_id`),
  CONSTRAINT `books_authors_fk` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`),
  CONSTRAINT `books_types_fk` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`),
  CONSTRAINT `books_publishers_fk` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `books` (`name`, `year`, `pages`, `author_id`, `type_id`, `publisher_id`, `amount`) VALUES
('Идиот', 1976, 267, 5, 1, 2, 10),
('Толковый словарь русского языка', 2010, 401, 6, 3, 4, 9),
('Таинственный остров', 1985, 324, 8, 1, 1, 2),
('Преступление и наказание', 1994, 378, 5, 1, 5, 7),
('Теория относительности', 1978, 198, 3, 2, 4, 1),
('Анна Каренина', 1996, 560, 4, 1, 3, 7),
('Отцы и дети', 2013, 457, 2, 1, 5, 9),
('Руслан и Людмила', 1965, 180, 1, 1, 4, 5);









-- Таблица "Выдачи"

CREATE TABLE `borrows` (
  `borrow_id` INT COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT,
  `borrowdate` DATE COLLATE utf8_unicode_ci NOT NULL,
  `returndate` DATE COLLATE utf8_unicode_ci NOT NULL,
  `book_id` INT COLLATE utf8_unicode_ci NOT NULL,
  `reader_id` INT COLLATE utf8_unicode_ci NOT NULL,
  `status` BOOLEAN,
  PRIMARY KEY (`borrow_id`),
  CONSTRAINT `borrows_books_fk` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `borrows_readers_fk` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`reader_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `borrows` (`borrowdate`, `returndate`, `book_id`, `reader_id`, `status`) VALUES
('2022-12-05', '2022-12-19', 4, 3, 0),
('2022-12-07', '2022-12-21', 2, 2, 0),
('2022-12-09', '2022-12-30', 3, 4, 1),
('2022-12-26', '2023-01-09', 1, 5, 1);