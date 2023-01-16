-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 16 日 05:32
-- サーバのバージョン： 8.0.31
-- PHP のバージョン: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `reservation_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint UNSIGNED NOT NULL,
  `domain_organization` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '自治体ドメイン名',
  `mode_reserve` int NOT NULL DEFAULT '0' COMMENT 'アカウントフラグ（0:通常/1:常時）',
  `name_organization` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '自治体名',
  `stored_server` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'SplashTop対象サーバー名',
  `count_license` int NOT NULL DEFAULT '0' COMMENT '所持ライセンス',
  `date_maintenance` date NOT NULL COMMENT 'メンテナンス',
  `name_file` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'csvファイル名',
  `flag_license` int NOT NULL DEFAULT '0' COMMENT '契約形態（0:一般/1:個別）',
  `flag_delete` int NOT NULL DEFAULT '0' COMMENT '削除フラグ（0:アクティブ/1:削除）',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `organizations`
--

INSERT INTO `organizations` (`id`, `domain_organization`, `mode_reserve`, `name_organization`, `stored_server`, `count_license`, `date_maintenance`, `name_file`, `flag_license`, `flag_delete`, `created_at`, `updated_at`) VALUES
(1, 'marumaru.co.jp', 0, 'まるまる市', 'server1', 10, '2099-12-31', 'test.csv', 0, 0, NULL, NULL),
(2, 'test1.co.jp', 0, 'test1市', 'server1', 10, '2099-12-31', 'test1.csv', 0, 0, NULL, NULL),
(3, 'test2.co.jp', 0, 'test2市', 'server3', 10, '2099-12-31', 'test2.csv', 0, 0, NULL, NULL),
(4, 'marumaru.co.jp', 1, 'まるまる市(常時)', 'server1', 5, '2099-12-31', 'test.csv', 0, 0, NULL, NULL),
(6, 'test1.co.jp', 1, 'test1市(常時)', 'server2', 10, '2099-12-31', 'test1.csv', 0, 0, NULL, NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organizations_domain_organization_mode_reserve_unique` (`domain_organization`,`mode_reserve`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
