-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 19 日 05:22
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

DELIMITER $$
--
-- プロシージャ
--
CREATE DEFINER=`reservation_db`@`localhost` PROCEDURE `EDIT_RESERVATION` (IN `IN_MODE` INT, IN `IN_DOMAIN` VARCHAR(255), IN `IN_MODE_RESERVE` INT, IN `IN_DATE` DATE, IN `IN_EMAIL` VARCHAR(255), OUT `OUT_MESSAGES` VARCHAR(255))   BEGIN
  -- 変数定義
  DECLARE ROW_COUNT    INT;           -- 処理件数
  DECLARE RSV_COUNT    INT;           -- 予約済件数
  DECLARE MAX_COUNT    INT;           -- 予約上限数
  DECLARE OUT_MESSAGE  VARCHAR(255);  -- 完了メッセージ
  
  DECLARE _not_found tinyint UNSIGNED DEFAULT 0;
  DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE, @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
      SELECT @sqlstate, @errno, @text;
      ROLLBACK;
    END;
  
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET _not_found = 1;
  
  DECLARE CONTINUE HANDLER FOR SQLWARNING
    BEGIN
      GET DIAGNOSTICS CONDITION 1 @sqlstate = RETURNED_SQLSTATE, @errno = MYSQL_ERRNO, @text = MESSAGE_TEXT;
    END;
    
  BEGIN  
    START TRANSACTION;

    IF IN_MODE = 0 THEN
      -- １．DELの場合は、空振りOKで削除
      DELETE FROM `reservations` WHERE `domain_organization` = IN_DOMAIN AND `mode_reserve` = IN_MODE_RESERVE AND `date_reservation` = IN_DATE AND `email_staff` = IN_EMAIL;
      SET OUT_MESSAGE = '予約取消が完了しました。';

    ELSE
      -- INSの場合は条件アリ
      -- １．Organizationマスタから予約上限数を取得
     SELECT `count_license` INTO MAX_COUNT FROM `organizations` WHERE `domain_organization` = IN_DOMAIN AND `mode_reserve` = IN_MODE_RESERVE;



      -- ２．全体の予約件数
      SELECT COUNT(*) INTO RSV_COUNT  FROM `reservations` WHERE `domain_organization` = IN_DOMAIN AND `mode_reserve` = IN_MODE_RESERVE AND `date_reservation` = IN_DATE;
      -- ３．予約判定
      IF RSV_COUNT < MAX_COUNT THEN
        -- ３－１．予約上限に満たない場合は、REPLACEでデータ追加（重複の場合は削除＆追加）
        REPLACE INTO `reservations` (`domain_organization`, `mode_reserve`, `date_reservation`, `email_staff`, `created_at`, `updated_at`)
        VALUES (IN_DOMAIN, IN_MODE_RESERVE, IN_DATE, IN_EMAIL, CURRENT_DATE(), NOW());
        SET OUT_MESSAGE = '予約登録が完了しました。';
      ELSE
        -- ３－２．予約上限を超えている場合は、ROLLBACKして終了
        SET OUT_MESSAGE = '予約上限数を超えたため、予約登録できません。';
        ROLLBACK;
      END IF;
    END IF;
    -- コミット
    COMMIT;
    -- 完了メッセージ
    select OUT_MESSAGE INTO OUT_MESSAGES;
    -- sample 
    --  select OUT_MESSAGE INTO OUT_MESSAGES,@text INTO TEXT;
--      SELECT @sqlstate, @errno, @text, OUT_MESSAGE AS MSG_RESULT;
  END;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- テーブルの構造 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint UNSIGNED NOT NULL,
  `date_holiday` date NOT NULL COMMENT '祝日',
  `name_holiday` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '祝日名',
  `flag_delete` int NOT NULL DEFAULT '0' COMMENT '削除フラグ（0:アクティブ/1:削除）',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `holidays`
--

INSERT INTO `holidays` (`id`, `date_holiday`, `name_holiday`, `flag_delete`, `created_at`, `updated_at`) VALUES
(1, '2023-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(2, '2023-01-02', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(3, '2023-01-09', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(4, '2023-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(5, '2023-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(6, '2023-03-21', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(7, '2023-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(8, '2023-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(9, '2023-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(10, '2023-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(11, '2023-07-17', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(12, '2023-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(13, '2023-09-18', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(14, '2023-09-23', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(15, '2023-10-09', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(16, '2023-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(17, '2023-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(18, '2024-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(19, '2024-01-08', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(20, '2024-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(21, '2024-02-12', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(22, '2024-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(23, '2024-03-20', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(24, '2024-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(25, '2024-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(26, '2024-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(27, '2024-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(28, '2024-05-06', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(29, '2024-07-15', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(30, '2024-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(31, '2024-08-12', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(32, '2024-09-16', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(33, '2024-09-22', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(34, '2024-09-23', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(35, '2024-10-14', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(36, '2024-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(37, '2024-11-04', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(38, '2024-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(39, '2025-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(40, '2025-01-13', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(41, '2025-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(42, '2025-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(43, '2025-02-24', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(44, '2025-03-20', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(45, '2025-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(46, '2025-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(47, '2025-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(48, '2025-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(49, '2025-05-06', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(50, '2025-07-21', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(51, '2025-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(52, '2025-09-15', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(53, '2025-09-23', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(54, '2025-10-13', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(55, '2025-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(56, '2025-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(57, '2025-11-24', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(58, '2026-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(59, '2026-01-12', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(60, '2026-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(61, '2026-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(62, '2026-03-20', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(63, '2026-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(64, '2026-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(65, '2026-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(66, '2026-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(67, '2026-05-06', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(68, '2026-07-20', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(69, '2026-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(70, '2026-09-21', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(71, '2026-09-22', '国民の休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(72, '2026-09-23', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(73, '2026-10-12', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(74, '2026-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(75, '2026-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(76, '2027-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(77, '2027-01-11', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(78, '2027-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(79, '2027-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(80, '2027-03-21', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(81, '2027-03-22', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(82, '2027-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(83, '2027-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(84, '2027-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(85, '2027-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(86, '2027-07-19', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(87, '2027-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(88, '2027-09-20', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(89, '2027-09-23', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(90, '2027-10-11', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(91, '2027-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(92, '2027-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(93, '2028-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(94, '2028-01-10', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(95, '2028-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(96, '2028-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(97, '2028-03-20', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(98, '2028-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(99, '2028-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(100, '2028-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(101, '2028-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(102, '2028-07-17', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(103, '2028-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(104, '2028-09-18', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(105, '2028-09-22', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(106, '2028-10-09', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(107, '2028-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(108, '2028-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(109, '2029-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(110, '2029-01-08', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(111, '2029-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(112, '2029-02-12', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(113, '2029-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(114, '2029-03-20', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(115, '2029-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(116, '2029-04-30', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(117, '2029-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(118, '2029-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(119, '2029-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(120, '2029-07-16', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(121, '2029-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(122, '2029-09-17', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(123, '2029-09-23', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(124, '2029-09-24', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(125, '2029-10-08', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(126, '2029-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(127, '2029-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(128, '2030-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(129, '2030-01-14', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(130, '2030-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(131, '2030-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(132, '2030-03-20', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(133, '2030-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(134, '2030-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(135, '2030-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(136, '2030-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(137, '2030-05-06', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(138, '2030-07-15', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(139, '2030-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(140, '2030-08-12', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(141, '2030-09-16', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(142, '2030-09-23', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(143, '2030-10-14', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(144, '2030-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(145, '2030-11-04', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(146, '2030-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(147, '2031-01-01', '元日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(148, '2031-01-13', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(149, '2031-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(150, '2031-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(151, '2031-02-24', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(152, '2031-03-21', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(153, '2031-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(154, '2031-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(155, '2031-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(156, '2031-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(157, '2031-05-06', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(158, '2031-07-21', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(159, '2031-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(160, '2031-09-15', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(161, '2031-09-23', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(162, '2031-10-13', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(163, '2031-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(164, '2031-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(165, '2031-11-24', '振替休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(166, '2032-01-12', '成人の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(167, '2032-02-11', '建国記念の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(168, '2032-02-23', '天皇誕生日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(169, '2032-03-20', '春分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(170, '2032-04-29', '昭和の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(171, '2032-05-03', '憲法記念日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(172, '2032-05-04', 'みどりの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(173, '2032-05-05', 'こどもの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(174, '2032-07-19', '海の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(175, '2032-08-11', '山の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(176, '2032-09-20', '敬老の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(177, '2032-09-21', '国民の休日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(178, '2032-09-22', '秋分の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(179, '2032-10-11', 'スポーツの日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(180, '2032-11-03', '文化の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40'),
(181, '2032-11-23', '勤労感謝の日', 0, '2022-12-08 06:56:40', '2022-12-08 06:56:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `log`
--

CREATE TABLE `log` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_09_21_135907_add_column_to_users_table', 1),
(8, '2022_11_16_160825_create_log_table', 3),
(10, '2022_11_28_101101_modify_organizations_table', 4),
(12, '2022_11_28_103132_create_organizations_table', 5),
(14, '2022_12_08_133052_create_holidays_table', 6),
(18, '2014_10_12_000000_create_users_table', 7),
(19, '2022_09_08_130747_create_reservations_table', 8),
(22, '2022_09_08_130822_create_notifications_table', 10),
(25, '2022_11_18_091451_create_organization_table', 11);

-- --------------------------------------------------------

--
-- テーブルの構造 `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `flag_display` int NOT NULL COMMENT '全体周知系',
  `domain_organization` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '自治体ドメイン',
  `mode_reserve` int NOT NULL DEFAULT '0' COMMENT 'アカウントフラグ（0:通常/1:常時）',
  `date_post` date NOT NULL COMMENT '投稿日時',
  `text_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '投稿タイトル',
  `text_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '投稿メッセージ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `notifications`
--

INSERT INTO `notifications` (`id`, `flag_display`, `domain_organization`, `mode_reserve`, `date_post`, `text_title`, `text_message`, `created_at`, `updated_at`) VALUES
(1, 1, 'marumaru.co.jp', 0, '2022-12-16', 'Err', '緊急メンテナンスの為14:00~17:00はご利用いただけません。', '2022-12-16 02:34:16', '2022-12-16 02:34:16'),
(2, 1, 'marumaru.co.jp', 0, '2023-01-01', 'Info', '年末年始休業の為予約不可', '2022-12-16 02:34:51', '2022-12-16 02:34:51');

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
  `flag_license` int NOT NULL DEFAULT '0' COMMENT '契約形態（0:一般/1:個別）',
  `flag_delete` int NOT NULL DEFAULT '0' COMMENT '削除フラグ（0:アクティブ/1:削除）',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `organizations`
--

INSERT INTO `organizations` (`id`, `domain_organization`, `mode_reserve`, `name_organization`, `stored_server`, `count_license`, `date_maintenance`, `flag_license`, `flag_delete`, `created_at`, `updated_at`) VALUES
(1, 'marumaru.co.jp', 0, 'まるまる市', 'server1', 10, '2099-12-31', 0, 1, NULL, NULL),
(2, 'test1.co.jp', 0, 'test1市', 'server1', 10, '2099-12-31', 0, 0, NULL, NULL),
(3, 'test2.co.jp', 0, 'test2市', 'server3', 10, '2099-12-31', 0, 0, NULL, NULL),
(4, 'marumaru.co.jp', 1, 'まるまる市(常時)', 'server1', 5, '2099-12-31', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'test', '3f20026e4bb985efc82763b11bd8646f80d3d82a583e71a296dd5981085a4afb', '[\"*\"]', '2022-12-19 04:07:18', NULL, '2022-12-05 07:53:22', '2022-12-19 04:07:18'),
(2, 'App\\Models\\User', 1, 'test', '6a28e41809907b86b0058cc4102170be12cd00ac74d9128a0f7dcc866b5b6070', '[\"*\"]', '2023-01-16 03:42:25', NULL, '2023-01-11 01:52:47', '2023-01-16 03:42:25'),
(3, 'App\\Models\\User', 1, 'test', '00a820c46232d92668ca06d925d5b78af2345a13911eac0eaa6ad1929eb16530', '[\"*\"]', '2023-01-17 03:46:13', NULL, '2023-01-16 06:46:30', '2023-01-17 03:46:13');

-- --------------------------------------------------------

--
-- テーブルの構造 `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint UNSIGNED NOT NULL,
  `domain_organization` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '自治体ドメイン名',
  `mode_reserve` int NOT NULL DEFAULT '0' COMMENT 'アカウントフラグ（0:通常/1:常時）',
  `date_reservation` date NOT NULL COMMENT '予約日',
  `email_staff` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '職員メールアドレス',
  `text_remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin COMMENT '備考欄',
  `created_at` date NOT NULL COMMENT 'データ登録日',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'データ更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `reservations`
--

INSERT INTO `reservations` (`id`, `domain_organization`, `mode_reserve`, `date_reservation`, `email_staff`, `text_remarks`, `created_at`, `updated_at`) VALUES
(4, 'marumaru.co.jp', 1, '2023-01-12', 'user3@marumaru.co.jp', NULL, '2022-12-16', '2023-01-11 02:03:12'),
(5, 'marumaru.co.jp', 1, '2023-01-04', 'user4@marumaru.co.jp', NULL, '2022-12-16', '2022-12-16 07:01:19'),
(6, 'marumaru.co.jp', 1, '2023-01-04', 'user5@marumaru.co.jp', NULL, '2022-12-16', '2022-12-16 07:01:19'),
(7, 'marumaru.co.jp', 1, '2023-01-04', 'user6@marumaru.co.jp', NULL, '2022-12-16', '2022-12-16 07:01:19'),
(9, 'marumaru.co.jp', 1, '2023-01-03', 'user1@marumaru.co.jp', NULL, '2022-12-16', '2022-12-16 07:24:17'),
(13, 'marumaru.co.jp', 1, '2022-12-24', 'user1@marumaru.co.jp', NULL, '2022-12-16', '2022-12-16 07:39:25'),
(18, 'marumaru.co.jp', 1, '2023-01-04', 'user1@marumaru.co.jp', NULL, '2022-12-16', '2022-12-16 07:49:28'),
(20, 'marumaru.co.jp', 1, '2022-12-23', 'user1@marumaru.co.jp', NULL, '2022-12-16', '2022-12-16 07:57:26'),
(21, 'marumaru.co.jp', 1, '2022-12-19', 'user1@marumaru.co.jp', NULL, '2022-12-16', '2022-12-19 04:05:01'),
(24, 'marumaru.co.jp', 0, '2023-01-09', 'user@marumaru.co.jp', NULL, '2022-12-19', '2022-12-19 04:04:16'),
(25, 'marumaru.co.jp', 0, '2022-12-19', 'user@marumaru.co.jp', NULL, '2022-12-19', '2022-12-19 04:05:20'),
(26, 'marumaru.co.jp', 0, '2023-01-05', 'user@marumaru.co.jp', NULL, '2022-12-19', '2022-12-19 04:44:27'),
(27, 'marumaru.co.jp', 0, '2023-01-12', 'user@marumaru.co.jp', NULL, '2023-01-11', '2023-01-11 03:49:01'),
(28, 'marumaru.co.jp', 0, '2023-01-13', 'user@marumaru.co.jp', NULL, '2023-01-11', '2023-01-11 03:49:25'),
(29, 'marumaru.co.jp', 0, '2023-01-14', 'user@marumaru.co.jp', NULL, '2023-01-11', '2023-01-11 03:49:37'),
(30, 'marumaru.co.jp', 0, '2023-01-21', 'user@marumaru.co.jp', NULL, '2023-01-11', '2023-01-11 03:50:08'),
(31, 'marumaru.co.jp', 0, '2023-01-20', 'user@marumaru.co.jp', NULL, '2023-01-11', '2023-01-11 03:50:20'),
(33, 'marumaru.co.jp', 0, '2023-02-01', 'user@marumaru.co.jp', NULL, '2023-01-16', '2023-01-16 06:51:04');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '職員メールアドレス',
  `domain_organization` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '自治体ドメイン名',
  `mode_reserve` int NOT NULL DEFAULT '0' COMMENT 'アカウントフラグ（0:通常/1:常時）',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'ユーザー名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'ログインパスワード',
  `mode_admin` tinyint NOT NULL COMMENT '管理者モード(0:一般/1:自治体/9:NESIC)',
  `flag_delete` int NOT NULL DEFAULT '0' COMMENT '削除フラグ（0:アクティブ/1:削除）',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `email`, `domain_organization`, `mode_reserve`, `name`, `password`, `mode_admin`, `flag_delete`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'super@marumaru.co.jp', 'marumaru.co.jp', 0, 'superuser', '$2y$10$0/CWIK35p1h6EUleady7Vebc1X6kGUU3iKk4nJ/30Ol1kDOrsw.Ta', 9, 0, NULL, 'uGod623o9PfnWyIcuRrzw2YiqZ2wlsKoIru7VzbL', NULL, NULL),
(2, 'admin@marumaru.co.jp', 'marumaru.co.jp', 0, 'admin', '$2y$10$XJK/AuZiRLdn8ySO0Vad9ed5NVt9WHUDS4LvqomdDab22Zft.QXiW', 1, 0, NULL, NULL, NULL, NULL),
(3, 'user@marumaru.co.jp', 'marumaru.co.jp', 0, 'user', '$2y$10$f0eu3xGKc10as4xqSZ94yeA0TlFBDJ/RBNErt8KQb.055xbEg6UaG', 0, 0, NULL, NULL, NULL, NULL),
(4, 'super@test1.co.jp', 'test1.co.jp', 0, 'superuser', '$2y$10$3weW3a6clCeohoSpT8f2uef.ePM34Z1dMUC4Y53S5R8BAzyXwUwnW', 9, 0, NULL, NULL, NULL, NULL),
(5, 'admin@test1.co.jp', 'test1.co.jp', 0, 'admin', '$2y$10$DHkx3X/3S0y2KRB4tKjUVOUqz4tAMLGbNgwlivTWzTckVXu2JejaC', 1, 0, NULL, NULL, NULL, NULL),
(6, 'user@test1.co.jp', 'test1.co.jp', 0, 'user', '$2y$10$hiOEbcjj99VnaTtAEJunA.6BElv31GJCYu/NQKxrYAOpMKKW2lStW', 0, 0, NULL, NULL, NULL, NULL),
(7, 'user1@marumaru.co.jp', 'marumaru.co.jp', 1, 'user1', '$2y$10$f0eu3xGKc10as4xqSZ94yeA0TlFBDJ/RBNErt8KQb.055xbEg6UaG', 0, 0, NULL, NULL, NULL, NULL);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- テーブルのインデックス `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organizations_domain_organization_mode_reserve_unique` (`domain_organization`,`mode_reserve`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- テーブルの AUTO_INCREMENT `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- テーブルの AUTO_INCREMENT `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
