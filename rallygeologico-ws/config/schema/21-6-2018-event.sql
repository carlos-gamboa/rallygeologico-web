DROP TRIGGER IF EXISTS insert_competition;

DELIMITER $$
CREATE TRIGGER insert_competition
BEFORE INSERT ON competition FOR EACH ROW
SET
  NEW.finishing_date = CONCAT(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 7 DAY) ,'%Y-%m-%d'), ' 23:59:00')
$$
DELIMITER ;

SET GLOBAL event_scheduler = ON;

DELIMITER $$
CREATE EVENT e_check_competitions_expiration
  ON SCHEDULE EVERY 1 DAY STARTS '2018-06-22 00:00:00'
DO
  UPDATE competition
  SET is_active = 0
  WHERE finishing_date <= UNIX_TIMESTAMP(CURDATE());
$$
DELIMITER ;

CREATE TABLE IF NOT EXISTS tokens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  value VARCHAR(64) UNIQUE,
  type VARCHAR(10),
  is_valid TINYINT DEFAULT 1,
  created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  user_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
)

ALTER TABLE `multimedia` ADD `external_url` VARCHAR(2000) NULL AFTER `media_url`;