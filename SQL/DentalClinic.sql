-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: מרץ 30, 2019 בזמן 10:28 AM
-- גרסת שרת: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental`
--
CREATE DATABASE IF NOT EXISTS `dental` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dental`;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `client`
--

CREATE TABLE `client` (
  `email` varchar(100) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `phone` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `client`
--

INSERT INTO `client` (`email`, `firstname`, `lastname`, `phone`) VALUES
('aannttoonn@list.ru', 'אנטון', 'קוליש', '0523698741'),
('adham@gmail.com', 'אדהם', 'חלבי', '0541253648'),
('ameersaid1994@gmail.com', 'עמיר ', 'סעיד', '0544822064'),
('aor.mal1@walla.com', 'אור', 'מלכה', '0536754208'),
('asaf.23@gmail.com', 'אסף', 'לריח', '0542051206'),
('avi.cohen2@gmail.com', 'אבי', 'כהן', '0524321678'),
('bmw_n_1995@hotmail.com', 'מוחמד', 'חיגזי', '0534123025'),
('evgenia@gmail.com', 'יבגיניה', 'צרנמוז', '0534125821'),
('fahad_grefat@gmail.com', 'פהד', 'גריפאת', '0574365212'),
('hossen12@gmail.com', 'חוסין', 'יאסין', '0527441666'),
('lion_king_14_10@hotmail.com', 'אברהם', 'בוקאעי', '0524623516'),
('moor.sh12@hotmail.com', 'מור', 'שקורי', '0523698751'),
('nadeembokaee9@gmail.com', 'נדים', 'בוקאעי', '0527441563'),
('nadeembokaee9@hotmail.com', 'נדים', 'בוקאעי', '0527441563'),
('rami123@gmail.com', 'רמי', 'לוי', '0546321035'),
('roni12@gmail.com', 'רוני', 'פינקל', '0539823601'),
('root.baz@gmail.com', 'רות', 'פזז', '0531532387'),
('shlomi34@gmail.com', 'שלומי', 'חאזן', '0537496521'),
('shoval.a@gmail.com', 'שובל', 'אליאב', '0572501635'),
('tania89@gmail.com', 'תניה', 'אינישטיין', '0527813951'),
('yotam77@gmail.com', 'יותם', 'אמסלם', '0546315208');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `companies`
--

CREATE TABLE `companies` (
  `company_id` int(10) UNSIGNED NOT NULL,
  `c_name` varchar(25) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `companies`
--

INSERT INTO `companies` (`company_id`, `c_name`, `phone`, `email`) VALUES
(1, 'כללית', '048567999', 'clalit@gmail.com'),
(2, 'מכבי', '049940815', 'maccabi12@hotmail.com'),
(3, 'לאומי', '049944456', 'leumi@hotmail.com');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `fullname` varchar(51) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `doctor`
--

INSERT INTO `doctor` (`id`, `fullname`, `phone`, `email`) VALUES
(3, 'חנין חמדאן', '0524261444', 'hanen23@gmail.com'),
(6, 'יוסף חמדאן', '0525289363', 'yosif12@gmail.com');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `suggestions`
--

CREATE TABLE `suggestions` (
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `content` text NOT NULL,
  `suggestion_id` int(11) UNSIGNED NOT NULL,
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `suggestions`
--

INSERT INTO `suggestions` (`first_name`, `last_name`, `content`, `suggestion_id`, `add_date`) VALUES
('אור', 'מלכה', 'הייתי ממליץ למרפאה לעשות פינת עיתונים. לקוח שמחכה לתור שיהיה לו במה להעביר את הזמן .', 10, '2019-03-24 09:31:28'),
('יותם', 'אמסלם', 'מבחינת מקצועיות אין דברים כאלה . אבל הייתי ממליץ לכם להשקיע יותר בשילוט . הסתבכתי קצת בהגעה אליכם .', 13, '2019-03-24 09:37:38'),
('שובל', 'אליאב', 'אחלה שירות שיש . ממליץ לרשום את המרפאה בוויז לכל הזרים שמגיעים . ', 14, '2019-03-24 09:39:29'),
('חוסין', 'יאסין', 'התאכזבתי שאין כניסה נגישה לבעלי מוגבליות . ממליץ לכם לטפל בנושא זה . ', 15, '2019-03-24 09:43:58');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `treatment_client`
--

CREATE TABLE `treatment_client` (
  `email` varchar(100) NOT NULL,
  `t_id` int(11) NOT NULL,
  `treatment_date` datetime NOT NULL,
  `company_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `treatment_client`
--

INSERT INTO `treatment_client` (`email`, `t_id`, `treatment_date`, `company_id`) VALUES
('asaf.23@gmail.com', 4, '2019-03-31 16:00:00', NULL),
('evgenia@gmail.com', 6, '2019-03-31 18:25:00', NULL),
('lion_king_14_10@hotmail.com', 2, '2019-04-02 10:00:00', NULL),
('moor.sh12@hotmail.com', 3, '2019-03-31 11:10:00', NULL),
('roni12@gmail.com', 6, '2019-04-02 12:25:00', NULL),
('adham@gmail.com', 1, '2019-03-30 19:50:00', 1),
('ameersaid1994@gmail.com', 4, '2019-04-01 17:20:00', 1),
('bmw_n_1995@hotmail.com', 3, '2019-03-31 15:15:00', 1),
('nadeembokaee9@gmail.com', 1, '2019-03-30 12:20:00', 1),
('root.baz@gmail.com', 6, '2019-04-01 13:25:00', 1),
('shoval.a@gmail.com', 1, '2019-03-31 09:15:00', 1),
('tania89@gmail.com', 5, '2019-04-03 10:05:00', 1),
('aannttoonn@list.ru', 5, '2019-03-30 15:00:00', 2),
('adham@gmail.com', 1, '2019-03-31 09:50:00', 2),
('avi.cohen2@gmail.com', 5, '2019-04-01 08:05:00', 2),
('fahad_grefat@gmail.com', 3, '2019-04-01 10:40:00', 2),
('yotam77@gmail.com', 2, '2019-04-04 13:30:00', 2),
('ameersaid1994@gmail.com', 2, '2019-03-30 17:25:00', 3),
('aor.mal1@walla.com', 1, '2019-03-31 14:00:00', 3),
('rami123@gmail.com', 6, '2019-04-02 14:25:00', 3),
('shlomi34@gmail.com', 4, '2019-04-02 17:00:00', 3);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `treatment_type`
--

CREATE TABLE `treatment_type` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `description` varchar(250) NOT NULL,
  `treatment_time` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `treatment_type`
--

INSERT INTO `treatment_type` (`id`, `title`, `description`, `treatment_time`) VALUES
(1, 'הלבנת שיניים', 'זהו תהליך בו מתבצעת לאחר שהמקרה נבחר כמתאים לטיפול.הלבנה במרפאה ושילוב עם הלבנה ביתית מה שמקנה תוצאות ארוכות טווח טובות יותר.ויתרון נוסף שניתן לחזור על הטיפול מפעם לפעם.\n', 30),
(2, 'טיפולי שורש', 'טיפול בו אנו מסלקים את רקמת המך מתוך תעלת השורש (בדרך כלל בגלל דלקת של המך=עצב) ומבצעים הכנה של תעלות השורש לקבלת סתימות השורש על מנת ליצור איטום בין חלל הפה לעצם.לעיתים קרובות יש צורך בביצוע טיפול שורש למרות שאין בהכרח סימנים מקדימים לכך.', 90),
(3, 'השתלת שיניים', 'השתלת שיניים הינו פתרון המוצא במקרים של חוסר בשיניים או במקרים בהם יש צורך בשיקום ושחזור השן,למרות שמדובר במסע לא קל, החדרת שתלים הינה השיטה הנפוצה ביותר לטיפול בנזק בלתי הפיך בפה ואם מקפידים לעשות אותה נכון, התוצאה דומה מאוד למקור.', 120),
(4, 'גשרים', 'גשר הוא למעשה השלמה של שן או שיניים חסרות שנאחזת בשיניים סמוכות לחסר. שן הדמה נקראת פונטיק והיא מחוברת בין שני כתרים המשמשים כעוגנים המחוברים לשיניים הסמוכות לחסר. בצורה כזאת, ההתקן \"מגשר\" על החסר של השן או השיניים.', 60),
(5, 'סתימה', 'סתימה הינו טיפול שיניים אשר נועד לטפל בלכלוך ובחיידקים אשר מצטברים על רובד השן. טיפול שיניים של סתימת חורים הינו טיפול השיניים הנפוץ ביותר היות ואנשים רבים מגיעים לרופא שיניים עקב כאב בשן, אולם בדרך כלל לא מחכים עד אשר השן במצב קשה במיוחד ונדרש טיפול', 30),
(6, 'עקירת שן', 'היא פעולה כירורגית המבוצעת לרוב על ידי רופא שיניים ומטרתה סילוק שן שאינה ניתנת לטיפול שמרני או שיקומי מחלל הפה. ישנן סיבות רבות לביצוע עקירות: בדרך כלל הסיבה העיקרית היא לשם עקירת שיניים שאינן ניתנות לשיקום בעקבות עששת, מחלת חניכיים או טראומה דנטלית.', 60);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- הוצאת מידע עבור טבלה `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'caf1a3dfb505ffed0d024130f58c5cfa');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`email`);

--
-- אינדקסים לטבלה `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- אינדקסים לטבלה `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`suggestion_id`);

--
-- אינדקסים לטבלה `treatment_client`
--
ALTER TABLE `treatment_client`
  ADD PRIMARY KEY (`email`,`t_id`,`treatment_date`),
  ADD KEY `t_id` (`email`),
  ADD KEY `client_id` (`t_id`),
  ADD KEY `company_id` (`company_id`);

--
-- אינדקסים לטבלה `treatment_type`
--
ALTER TABLE `treatment_type`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `suggestion_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `treatment_type`
--
ALTER TABLE `treatment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- הגבלות לטבלאות שהוצאו
--

--
-- הגבלות לטבלה `treatment_client`
--
ALTER TABLE `treatment_client`
  ADD CONSTRAINT `treatment_client_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `treatment_type` (`id`),
  ADD CONSTRAINT `treatment_client_ibfk_2` FOREIGN KEY (`email`) REFERENCES `client` (`email`),
  ADD CONSTRAINT `treatment_client_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
