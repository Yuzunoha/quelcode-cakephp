-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql
-- 生成日時: 2020 年 8 月 28 日 04:05
-- サーバのバージョン： 8.0.19
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `docker_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `people`
--

CREATE TABLE `people` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `mail` varchar(200) DEFAULT NULL,
  `age` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `people`
--

INSERT INTO `people` (`id`, `name`, `mail`, `age`) VALUES
(1, 'taro', 'taro@yamada', 45),
(2, 'hanako', 'hanako@flower', 34),
(3, 'sachiko', 'sachiko@happy', 23),
(4, 'ichiro', 'ichiro@baseball', 12),
(5, 'mamiko', 'mami@mumemo', 45);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `people`
--
ALTER TABLE `people`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
