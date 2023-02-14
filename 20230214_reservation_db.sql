-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 2 月 14 日 01:25
-- サーバのバージョン： 8.0.32
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `AUTO_RESERVATION` (IN `IN_DATE` DATE, OUT `OUT_MESSAGES` VARCHAR(255))   BEGIN
  -- 変数定義
  DECLARE ROW_COUNT    INT;           -- 処理件数
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

    -- 指定日の登録
    REPLACE INTO `reservations` (`domain_organization`, `mode_reserve`, `date_reservation`, `email_staff`,`created_at`)
      SELECT `o`.`domain_organization`, `o`.`mode_reserve`, `IN_DATE`, `u`.`email`, CURRENT_DATE
      FROM `organizations` `o` INNER JOIN `users` `u` ON
          `o`.`domain_organization` = `u`.`domain_organization`
      AND `o`.`mode_reserve`        = `u`.`mode_reserve`
      AND `o`.`flag_delete`         = `u`.`flag_delete`
      WHERE `o`.`mode_reserve` = 1
      AND   `o`.`flag_delete` = 0
    ;

    -- 処理件数（REPLACEのため、削除件数も含まれる）
    SELECT ROW_COUNT() INTO OUT_MESSAGE;

    -- 実際の件数
    SELECT COUNT(*) INTO ROW_COUNT
    FROM `organizations` `o` INNER JOIN `users` `u` ON
          `o`.`domain_organization` = `u`.`domain_organization`
      AND `o`.`mode_reserve`        = `u`.`mode_reserve`
      AND `o`.`flag_delete`         = `u`.`flag_delete`
      WHERE `o`.`mode_reserve` = 1
      AND   `o`.`flag_delete` = 0
    ;

    -- コミット
    COMMIT;
    -- 完了メッセージ
    SELECT CONCAT(DATE_FORMAT(`IN_DATE`, '%Y-%m-%d'), ' : [', ROW_COUNT, '] 件挿入 / [', OUT_MESSAGE, '] 件処理しました。') INTO OUT_MESSAGES;
  END;
END$$

DELIMITER ;

