-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2024 at 08:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noamslab`
--

-- --------------------------------------------------------

--
-- Table structure for table `navbar`
--

CREATE TABLE `navbar` (
  `id` int NOT NULL,
  `displayName` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL,
  `highlighted` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `navbar`
--

INSERT INTO `navbar` (`id`, `displayName`, `url`, `highlighted`) VALUES
(1, 'מידע', '/#about', 0),
(2, 'שירותים', '/#services', 0),
(3, 'מדריכים', '/#posts', 0),
(4, 'צרו קשר', '/#contact', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postName` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `SEOkeywords` text NOT NULL,
  `SEOdescription` text NOT NULL,
  `content` longtext NOT NULL,
  `author` int NOT NULL,
  `indexing` tinyint(1) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT NULL,
  `sticky` tinyint(1) DEFAULT NULL,
  `publish_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tagColor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `category` varchar(32) NOT NULL,
  `SEOimage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postName`, `title`, `description`, `SEOkeywords`, `SEOdescription`, `content`, `author`, `indexing`, `publish`, `sticky`, `publish_date`, `tag`, `tagColor`, `category`, `SEOimage`) VALUES
('catRating', 'איזה כבל רשת לרכוש?', 'רכישת כבל רשת הינה שאלה שעולה כאשר מרשתים מחדש את הבית, בואו ואעשה סדר.', 'איזה כבל אינטרנט לרכוש, איזה כבל רשת לרכוש, cat5e או cat6a, כבל רשת למחשב, השחלת כבלים בקיר, איזה כבל אינטרנט להשחיל, באיזה כבל רשת להשתמש, השחלת כבל רשת, , מאריך כבל רשת, , כבל רשת מוצלב, כבל רשת rj45, כבל רשת cat 5, ראש כבל רשת, התקנת כבל רשת בבית', 'רכישת כבל רשת הינה שאלה שעולה כאשר מרשתים מחדש את הבית, בואו ואעשה סדר. ', '&lt;div class=&quot;container has-text-right pt-5 px-0&quot; style=&quot;text-align: right;&quot;&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כבלי רשת נחשבים לאחד הפריטים הפחות בולטים בתקשורת הביתית, עד שהם מתגלים כחיוניים ברגע שהופכים לנחוצים להחלפת תשתיות או כאשר נתקלים במונח Cat (קטגוריה).&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;המונח Cat הוא קיצור למילה Category, וקיימים מספר סוגים הנחשבים חשובים בעידן הנוכחי.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לפני שנעמוד על השאלה מה לרכוש, חשוב להבין מה הצורך המדויק שלכם.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;strong&gt;נתחיל מהשאלה הבאה, למה יש לי צורך בכבל טוב יותר?&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;רוב כבלי הרשת הנמכרים כיום מדורגים כ- Cat5e. זהו כבל מודרני המיועד לטווחים קצרים, ומספק מהירות של עד 1Gb. כל עוד אין צורך במהירויות גבוהות יותר, הוא יהיה מספיק לכל השימושים.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אז מהן הקטגוריות השונות?&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לכל סוג כבל יש דירוג מהירות משל עצמו. כיום קיימים 4 סוגי כבלי רשת המיועדים לשימוש:&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;strong&gt;אז מה הן הקטגוריות השונות?&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;:לכל כבל יש דירוג מהירות משל עצמו. כיום קיימים 4 סוגי כבלי רשת &quot;המאושרים&quot; לשימוש&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Cat5e&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כבל זה מיועד למרחקים קצרים בלבד, אך יכול להגיע עד ל-100 מטר. לא מומלץ להשחלות בקיר, אך מתאים לחיבורים בקרבת המחשב. רוב הכבלים שמגיעים עם מוצרים אלקטרוניים חדשים מדורגים בקטגוריה זו.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Cat6&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כבל זה מיועד למרחקים קצרים עד 55 מטר ומספק מהירות של עד 10Gb. ניתן להשחיל בקיר והוא מתאים לשימוש ביתי.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Cat6a&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כבל זה מיועד למרחקים עד 100 מטר ומספק מהירות של עד 10Gb. מומלץ להשתמש בו להשחלות בקיר וליצירת תשתיות רשת מתקדמות.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;span style=&quot;text-decoration: underline;&quot;&gt;&lt;strong&gt;Cat7&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כבל זה דומה ל-Cat6a, אך מספק איכות קו גבוהה יותר. מתאים לרשתות גדולות ועסקיות.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;ישנם סוגים נוספים של כבלים, כמו FTP, SFTP ו-FUTP, אך לרוב, כבלים לשימוש ביתי לא דורשים יותר מדי הגנה.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;הכבל הינו מומלץ עבור רשתות גדולות עם מספר רב של מחשבים עקב התעבורה הגדולה שהמחשבים מייצרים.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;div style=&quot;text-align: right;&quot;&gt;ניתן לקרוא עוד על תעבורה ב&lt;a class=&quot;is-underlined has-text-info&quot; href=&quot;posts/whytheinternetisslow.html&quot;&gt;למה האינטרנט כל כך איטי בשעות מסוימות?&lt;/a&gt;.&lt;/div&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;strong&gt;Cat8&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;Cat8 הוא סוג של כבל רשת שאינו רשמי ומיועד לחדרי שרתים בעיקר. על אף שהוא לא מתאים לשימוש במגזר הביתי, ישנם מקומות בהם הוא עשוי להיות שימושי.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;ניתן לקרוא עוד על הכבל &lt;a class=&quot;is-underlined has-text-info&quot; href=&quot;https://www.google.com/search?q=cat8+cable&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt;בגוגל&lt;/a&gt;.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כן אציין בקצרה שהכבל מיועד לחיבור חדרי שרתים ואין לו כל ייתרון במגזר הביתי.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;strong&gt;מה זה STP, UTP?&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לאחר שהבנו את סוגי הקטגוריות השונות של כבלי הרשת, עלינו להתייחס לקטגוריה המתייחסת להגנה.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לשימוש בסיסי כמו חיבור מחשב אין יותר מדי תועלת לקטגורייה אך כן חשיבות בהשחלות בקיר.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;u&gt;הנה הקטגוריות:&lt;/u&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;strong&gt;UTP - Unshilded twisted pair&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;הינו כבל ללא הגנות למעט הסיבוביות של החוטים, מומלץ לבצע בו שימוש לחיבור מחשבים במרחקים קצרים בלבד (לדוגמא מהראוטר לסטרימר).&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;זהו סוג מאוד נפוץ, כנראה ורוב הכבלים אצלכם מדורגים בזה.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;img src=&quot;https://s3-us-west-1.amazonaws.com/foscoshopify/graphics/uploads/2011/01/UTP-Cable-Picture.jpg&quot; alt=&quot;הדגמה לUTP&quot;&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;strong&gt;STP - Shilded twisted pair&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;הינו כבל מוגן מפני הפרעות אלקטרומגנטיות, ניתן לראות בתמונה דוגמא לכבל מוגן.&lt;br&gt;מתאים בעיקר להשחלות בקיר.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;img src=&quot;https://www.keline.com/assets/images/produkty/full/600-ke550hs231e-dca-1.jpg&quot; alt=&quot;הדגמה לUTP&quot;&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;strong&gt;סוגים נוספים -&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;קיימים סוגי הגנה נוספים כמו ftp, sftp, futp.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;ניתן לקרוא עוד על סוגי ההגנות &lt;a class=&quot;is-underlined has-text-info&quot; href=&quot;https://www.cablesandkits.com/learning-center/what-is-the-difference-between-utp-stp-ftp-sftp&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt;כאן&lt;/a&gt; אך חשוב לציין שכל כבל המדורג עם הגנה בסיסית יספיק למשתמש הביתי.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;strong&gt;פיצול הקו -&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;שאלה נפוצה בקרב אנשים שמעוניינים לרשת בית בכבלים זה איך ניתן לפצל כבל.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לא ניתן לפצל עם מתאמים (מפצל Y) אך כן ניתן באמצעות מכשיר הנקרא &lt;a class=&quot;is-underlined has-text-info&quot; href=&quot;https://www.google.com/search?q=ethernet+switch&quot; target=&quot;_blank&quot; rel=&quot;noopener&quot;&gt;Switch&lt;/a&gt;.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לא אפרט בכתבה על המכשיר, אך כן אדגיש שצריך לוודא את המפרט הטכני של המכשיר שרוכשים מכיוון וקיימים סוגים התומכים במהירויות שונות.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;חשוב לציין שמכשירי סוויטץ&#039; במהירויות גבוההות (2.5Gb ומעלה) לרוב נחשבים כציוד Enterprise ומחירם יהיה בהתאם.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;קיימת כתבה בארכיון על מהירויות אינטרנט ולמה הצרכן הביתי אינו צריך מהירות מעל 1Gb.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לכל שאלה אחרת מ-&quot;אם אין לי תשתית מתאימה&quot;? או &quot;החיבור יציב עם תקיעות&quot;?&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;קיימים מספר פוסטים באתר אשר עונים על כל השאלות הנפוצות. ניתן לחפש בארכיון:&lt;/p&gt;\r\n&lt;/div&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;button class=&quot;button is-warning is-light&quot;&gt;&lt;a href=&quot;../archive&quot;&gt;ארכיון כתבות&lt;/a&gt;&lt;/button&gt;&lt;/p&gt;', 1, 1, 1, 1, '2024-04-03 00:24:40', '', NULL, 'רשתות', 'https://noamslab.co.il/img/posts/catRating.webp'),
('nowifi', 'מה עושים אם הוויפי איטי?', 'בעיות וויפי הן אחת מהבעיות הנפוצות בדירות בישראל, הנה מדריך מקוצר. ', 'בעיות בוויפי, אין קליטה בוויפי, וייפי לא עובד, לא מתחבר הוויפי', 'בעיות בוויפי, אין קליטה בוויפי, וייפי לא עובד, לא מתחבר הוויפי.', '&lt;div class=&quot;container has-text-right pt-5 px-0&quot; style=&quot;text-align: right;&quot;&gt;בטח יצא לכם לקבל וויפי איטי מאוד באחד מהחדרים בבית. אם אתם קוראים את זה,סביר להניח שזה המצב אצלכם.\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;מדובר באחת מבעיות התקשורת הכי נפוצות בדירות בישראל אשר לא מקבלות מענה והסבר נכון מחברות התקשורת.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;וויפי הינו פרוטוקול אשר שולח גלי רדיו ממכשיר הנקרא &quot;נקודת גישה&quot; (נמצא באופן מובנה בכל ראוטר/ נתב ביתי).&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כאשר הגלים מגיעים לאזורים כמו קירות, עץ וכל אובייקט שנמצא בדרך, נוצרת בליעה של הגלים והאטה אפשרית באות והמהירות.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;הבעיה נפוצה מאוד בישראל כי בישראל לעומת דירות בחו&quot;ל, הדירות בנויות מבטון (לעומת ארהב) ואף חלק מהדירות כוללות ממדים אשר בולעים לגמרי את אותות ה wifi לחלוטין.&lt;br&gt;סיבה נוספת היא מיקום לא נכון של הנתב, ופריסה שגויה של נקודות גישה, בעיקר עקב תשתית לקוייה.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אז מה אפשר לעשות? יש כמה אפשרויות לשיפור עוצמת הוויפי בבית.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;הראשונה היא לוודא שהראוטר נמצא במקום שאינו מוסתר כמו ארונות, ממד או באזור לא מרכזי בבית. רק מהזזת הראוטר לנקודה יותר פעילה בבית (לדוגמא סלון/ חדר עבודה) תשפר את עוצמת הגלישה באזור הרצוי,&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אך חשוב לשים לב שאין הבטחה שהעוצמה תתגבר.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אופציה מאוד פופולארית היא רכישת מגדיל טווח - אך מדובר על מכשיר אשר אינו תורם למהירות הגלישה ואף יכול לגרום לבעיות נוספות.&lt;br&gt;מגדיל טווח לוקח את המהירות שהוא מקבל (לדוגמא 5 מגה ביט) באזור שהוא הוצב, ומשדר את אותה מהירות לאזור קצת יותר רחוק.&lt;br&gt;ובכך בפועל אם המכשיר מקבל מהירות נמוכה, התוצאה תהיה שידור אות נמוך (לפי המהירות שהמכשיר קלט) וללא שיפור במהירות הגלישה.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;האופציה הכי מומלצת היא למקם נקודות גישה נוספות ברחבי הבית באופן קווי. לדוגמא אחת בסלון (ראוטר ראשי), והשני באזור אשר בו אין קליטה (חדר מרוחק/ ממד).&lt;br&gt;החיסרון שנדרש חיבור באופן קווי, אך זה יוודא חיבור יציב ואמין לכל רחבי הבית.&lt;br&gt;הכוונה במיקום נקודות גישה נוספות באופן קווי, מתבצע כפי שזה נשמע. מחברים מכשיר ייעודי שנקרא נקודת גישה, לאזור בו יש כבל רשת פעיל.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;מה לגבי זה שהמהירות שלי נורא איטית גם כשאני ליד הראוטר?&lt;br&gt;יש הרבה סיבות אפשריות, אך כדי לאבחן ממה הבעיה נובעת נדרש לבצע בדיקת מהירות ישירות מהראוטר הראשי באופן קווי כדי לוודא שמקבלים את המהירות המבוקשת בצורה קווית.&lt;br&gt;אם אין לנו איטיות, יש סיבה לא ידועה שיכולה לגרום לאיטיות (ואף חוסר קליטה כלל).&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אחת הסיבות המרכזיות הן חוסר תמיכה בדורות הwifi.&lt;br&gt;כן גם לוויפי יש דורות בדיוק כמו לאייפון. אם אתם מחזיקים בראוטר ישן (שתומך עד 100Mb בWifi) ומשלמים על מהירות גבוהה (לדוגמא 1Gb),&lt;br&gt;אתם פשוט מחזיקים בציוד תקשורת לא תקין ומומלץ להחליפו בציוד מודרני.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;כדי לאבחן בצורה נכונה ומדויקת בדירתכם, יש להתייעץ עם מומחה רשתות.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;לכל שאלה אחרת מ-&quot;אם אין לי תשתית מתאימה&quot;? או &quot;החיבור יציב עם תקיעות&quot;?&lt;br&gt;קיימים מספר פוסטים באתר אשר עונים על כל השאלות הנפוצות. ניתן לחפש בארכיון:&lt;/p&gt;\r\n&lt;button class=&quot;button is-warning is-light&quot;&gt;&lt;a href=&quot;../archive&quot;&gt;ארכיון כתבות&lt;/a&gt;&lt;/button&gt;&lt;/div&gt;\r\n&lt;div class=&quot;container has-text-right pt-5 px-0&quot; style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/div&gt;', 1, 1, 1, 1, '2023-09-29 00:21:14', 'קריאה מומלצת 🔥', 'has-background-danger-dark', 'רשתות', 'https://noamslab.co.il/img/posts/nowifi.webp'),
('slowdownloadspeed', 'הורדת קבצים ומשחקים איטית', 'גם לכם המשחקים בסטים יורדים לאט (או קבצים)? זה מעצבן נכון? בואו ואסביר למה זה קורה ולמה זה בסדר.', 'הורדת משחקים איטית, למה המשחקים יורדים לאט, למה משחקים מסטים יורדים לאט, למה משחקים באקבוקס יורדים לאט, הורדה איטית בטורנט, הורדה איטית באקסבוקס, הורדה איטית באפיק, הורדת משחקים איטית, מהירות הורדת קבצים איטית, קבצים יורדים לאט, הורדה איטית באינטרנט, לא מקבל מהירות הורדה טובה', 'גם לכם המשחקים בסטים יורדים לאט (או קבצים)? זה מעצבן נכון? בואו ואסביר למה זה קורה ולמה זה בסדר.', '&lt;div class=&quot;container has-text-right pt-5 px-0&quot; style=&quot;text-align: right;&quot;&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;strong&gt;ההורדה שלי נורא איטית למה?&lt;br&gt;&lt;/strong&gt;ידעתם שחברות האינטרנט &quot;מרמות אתכם&quot;?, כן מרמות באופן חוקי.&lt;br&gt;אתם לא באמת משלמים ומקבלים מגה בית (MegaByte) הנפוץ כגודל קבצים, אתם משלמים על מהירות נמוכה יותר הנקראת מגה ביט (MegaBit) לשנייה.&lt;br&gt;אם תשימו לב, במהירות ההורדה יהיה לכם המילה Mb המעידה על MegaBit, ולא MB.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;בהרבה תוכנות כמו סטים, אפיק, קונסולות וכו.. מהירות ההורדה תוצג לכם בMB ולא Mb שעליה אתם משלמים. מוזר נכון?.&lt;br&gt;הסיבה לכך היא חוסר ידיעה טכנולוגית בנושא, במחשב אנחנו רגילים למונח מגה בית לקבצים (התמונה שוקלת 20 מגה בית).&lt;br&gt;אך במונחי אינטרנט זה כלל לא נכון, התרגלנו מחברות האינטרנט לחשוב שאנחנו מקבלים גם מגה בית.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אז לפני שאתם מתפלאים למה המהירות נמוכה, 20MB שווה ל160Mb מהמירות הורדה שלכם.&lt;br&gt;הנוסחה הינה הכפלה של הMB ב8 ותתקבל לכם תוצאת הביטים.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;strong&gt;אבל רגע, אני עדיין משלם על 1000 מגה, למה אני לא מקבל 1000 מגה ביט בהורדות?&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;התשובה מאוד פשוטה, נכון שמהירות העלאה מוגבלת ועד לפני כמה שנים היינו מקבלים 5 מגה בגג?. אותו דבר אצל השרתים.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;כאשר אנו מעוניינים להוריד קובץ מאתר, לשרת (איפה שהאתר נמצא) יש מגבלה על המהירות שהוא יכול לשלוח למשתמשים,&lt;br&gt;בכך יוצר מצב שאם לשרת יש 100Mb העלאה לחלוק (זוכרים את ה5 מגה ב2015?), הוא יחלק את מהירות העלאה למספר המורידים והגולשים בשרת ברגע זה. לכן אף פעם לא תקבלו הורדה במהירות שאתם משלמים עליה מאתרים לדוגמא סטים.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;תרצו לדעת עוד על תעבורת אינטרנט ולמה האינטרנט איטי בזמן הורדות? מוזמנים לקרוא את הכתבה הבאה אשר תתן לכם ידע מעמיק על מהירות האינטרנט שלכם:&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;a class=&quot;is-underlined has-text-info&quot; href=&quot;https://noamslab.co.il/posts/whytheinternetisslow.html&quot;&gt;http://noamslab.co.il/posts/whytheinternetisslow&lt;/a&gt;&lt;span style=&quot;background-color: rgb(34, 47, 62); color: rgb(255, 255, 255);&quot;&gt; &lt;/span&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;br&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;לכל שאלה אחרת מ-&quot;אם אין לי תשתית מתאימה&quot;? או &quot;החיבור יציב עם תקיעות&quot;?&lt;br&gt;קיימים מספר פוסטים באתר אשר עונים על כל השאלות הנפוצות. ניתן לחפש בארכיון:&lt;/p&gt;\r\n&lt;button class=&quot;button is-warning is-light&quot;&gt;&lt;a href=&quot;archive&quot;&gt;ארכיון כתבות&lt;/a&gt;&lt;/button&gt;&lt;/div&gt;\r\n&lt;div class=&quot;container has-text-right pt-5 px-0&quot; style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/div&gt;', 1, 1, 1, 0, '2023-08-09 00:26:42', '', NULL, 'רשתות', 'https://noamslab.co.il/img/posts/jonathan-SwVkmowt7qA-unsplash.jpg'),
('whytheinternetisslow', 'למה מהירות האינטרנט איטית בערב?', 'מהירות אינטרנט איטית היא תופעה נפוצה על תשתיות ישנות, בכתבה אסביר למה המהירות נמוכה בערב.', 'מה האינטרנט איטי בערב, למה יש תקיעות באינטרנט, תעבורת אינטרנט, הסבר תעבורת אינטרנט, למה האינטרנט איטי כשמורידים, אינטרנט איטי עם הרבה מחשבים, תעבודה אינטרנט איטית, הוויפי איטי, למה לא צריך יותר מאלף מגה, כמה מגה לקנות, למה ההורדה איטית, הורדת משחק איטית, למה המשחק לא יורד מהר, סטים יורד לאט, משחקים יורדים לאט, יוטיוב נתקע', 'מהירות אינטרנט איטית היא תופעה נפוצה על תשתיות ישנות, בכתבה אסביר למה המהירות נמוכה בערב. ', '&lt;p&gt;מהירות אינטרנט איטית היא תופעה נפוצה על תשתיות ישנות, בכתבה אסביר למה המהירות נמוכה בערב. &quot;, &quot;content&quot;:&quot;&lt;/p&gt;\r\n&lt;div class=&quot;container has-text-right pt-5 px-0&quot; style=&quot;text-align: right;&quot;&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;strong&gt;למה האינטרנט כל כך איטי בערב, או למה האינטרנט כל כך איטי כשיש הורדה ברקע באינטרנט?&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;ברוך הבא לעידן האינטרנט, בכל רגע נתון כל מחשב המחובר לרשת (אפילו דרך וויפי!) שולח מאות הודעות בכל דקה לאינטרנט, בואו נדבר על זה.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;- כבר עכשיו המחשב שלכם שלח בין 10-50 הודעות!&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&lt;strong&gt;שאלה, על כמה מגה אתם משלמים על מהירות האינטרנט?&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;100? 500? 1000? יש גם שיגידו 2500 מגה.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אתם לא באמת משלמים על מהירות, בואו נדמיין את זה ככביש עם מהירות עד.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;בואו נוסיף כמה מכוניות לכביש, לדוגמא 20 רכבים על 2 נתיבים.&lt;br&gt;בתנאים אידייאלים לא יהיה פקק בכביש מהיר שכזה.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;אבל מה ייקרה אם נוסיף עוד 500 מכוניות? פקק גדול כמו באיילון.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;כאשר מתבצעות הורדות (והעלאות) מאחד המחשבים ברשת, אנחנו מוסיפים מכוניות (פאקטות של מידע) לכביש שאנחנו משלמים עליו ובכך מאיטים מסרים (פאקטות) אחרים שנתקעים בפקק.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;בואו נקח לדוגמא 4 מחשבים.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;מחשב גיימינג, סטרימר טלוויזיה, מחשב משרדי, וטלפון סלולארי שכולם דלוקים באותו הזמן.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;מה יקרה ברגע שתתחיל הורדה של GTA 6 במחשב הגיימינג?, ייתווספו (הרבה) מכוניות לכביש ובכך ייגרם האטה למכשירים הנוספים שחולקים את אותה רשת.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;וכך קורה כאשר מהירות האינטרנט שאנחנו משלמים עליה (הכביש) לא מספיקה למשתמשים. לכן נדמה לכם שמהירות האינטרנט נמוכה בשעות הערב, כאשר כל הבית מחובר לרשת, אך בפועל אתם מקבלים את אותה המהירות, רק בחלוקה ועדיפות למחשב שצורך הכי הרבה נתיבים.&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;direction: rtl;&quot;&gt;חשוב לציין את פיצ&#039;ר הQoS שיודע להקצות לכל מחשב עדיפות, חשוב לשים לב שהנושא אומנם רלוונטי לרשתות Enterprise ומשרדים, אך ברשתות כאלו יש אמצעים לחלוק בצורה יעילה את המשאבים.&lt;strong&gt;והגענו לנקודה החשובה ביותר, כמה מהירות הורדה אני צריך?&lt;/strong&gt;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;תאשלו אתכם, כמה מחשבים יש לכם בבית?. האם יש לכם תקיעות בשעות מסויימות?. &lt;br&gt;זה הזמן לשדרג את המהירות.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;המלצה שלי, אין צורך לשלם מעל ל1Gb לאינטרנט, לפחות לא בזמן כתיבת כתבה ולשנים לאחריה.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;נראה שבשנת 2023 (נכון לכתיבת הכתבה) מתחיל פרסומים אגרסיביים למהירויות של 2.5Gb בצורה מטעה.&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;מהירות 2.5Gb מיועדות בדרך כלל למשרדים ורשתות עם הרבה מחשבים ברשת. ניתן לוותר על המהירות ולהשתמש ב1Gb אשר מספיקה בהחלט לכל השימושים הביתיים.&lt;br&gt;במיוחד בהתחשב בעובדה שציוד תקשורת למהירויות של 2.5Gb מגיעים למחירים ממש לא זולים לבית פרטי.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&lt;strong&gt;אבל אני רוצה להוריד קבצים במהירות גבוהה!&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;נכון שיש לכם מהירות העלאה מוגבלת (נניח 10 מגה, 100 מגה)?&lt;br&gt;אותו דבר יש גם לשרתים מהם אתם מורידים קבצים, אם השרת מוגבל ל100 מגה העלאה, סביר להניח שהוא ייתן לכם להוריד ב10Mb הורדה (90Mb לדוגמא ישמשו אנשים אחרים),&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;לכן רכישה של מהירות גבוהה חסרת כל תועלת ברוב המקרים לבית משפחתי שאינו כולל עשרות מחשבים פעילים בו זמנית.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;direction: rtl;&quot;&gt;ניתן לקרוא עוד כאן:&lt;/p&gt;\r\n&lt;a class=&quot;is-underlined has-text-info&quot; href=&quot;posts/slowdownloadspeed.html&quot;&gt;http://noamslab.co.il/posts/slowdownloadspeed&lt;/a&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;לכל שאלה אחרת מ-&quot;אם אין לי תשתית מתאימה&quot;? או &quot;החיבור יציב עם תקיעות&quot;?&lt;br&gt;קיימים מספר פוסטים באתר אשר עונים על כל השאלות הנפוצות. ניתן לחפש בארכיון:&lt;/p&gt;\r\n&lt;button class=&quot;button is-warning is-light&quot;&gt;&lt;a href=&quot;archive&quot;&gt;ארכיון כתבות&lt;/a&gt;&lt;/button&gt;&lt;/div&gt;\r\n&lt;p style=&quot;text-align: right;&quot;&gt;&amp;nbsp;&lt;/p&gt;', 1, 1, 1, 0, '2023-06-22 00:28:45', '', NULL, 'רשתות', 'https://noamslab.co.il/img/posts/jonathan-SwVkmowt7qA-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int NOT NULL,
  `service` varchar(45) NOT NULL COMMENT 'Service name (Ex Whatsapp)',
  `icon` varchar(255) NOT NULL COMMENT 'ICON css attribute',
  `url` varchar(255) NOT NULL,
  `skipBottom` int NOT NULL COMMENT 'Tick to skip from displaying this service at the bottom of the page (Mostly contact forms)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `service`, `icon`, `url`, `skipBottom`) VALUES
(1, 'טלפון', 'fa fa-2x fa-phone-alt', 'tel:+972522622010', 0),
(2, 'וואצאפ', 'fa fa-2x fa-whatsapp', 'https://wa.me/972522622010', 0),
(3, 'מייל', 'far fa-2x fa-envelope-open', 'mailto:contact@noamslab.co.il', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'username',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `logTries` int NOT NULL COMMENT 'number of unsuccessful tries to login',
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'User creation date',
  `lastLogin` datetime NOT NULL COMMENT 'Last login date',
  `displayName` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Autor name to display in posts',
  `authorimage` text NOT NULL,
  `ip` text,
  `favLink` varchar(255) NOT NULL COMMENT 'Favorite url to display in posts in author name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `logTries`, `creationDate`, `lastLogin`, `displayName`, `authorimage`, `ip`, `favLink`) VALUES
(1, 'noam', '$2y$10$cMFfNFPuxXYfYaeW30HfvOplRzvK7DXxIJRH5MeuvWK08uDlWkHBO', 0, '2024-06-08 13:17:29', '2024-06-17 18:44:59', 'Noam Sapir', 'https://noamsapir.me/img/main/Profile2.webp', '::1', 'https://noamsapir.me');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postName`),
  ADD UNIQUE KEY `postName` (`postName`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `navbar`
--
ALTER TABLE `navbar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
