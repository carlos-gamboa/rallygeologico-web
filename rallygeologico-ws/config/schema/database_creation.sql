CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  api_id VARCHAR(30),
  username VARCHAR(30) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(15),
  last_name VARCHAR(15),
  email VARCHAR(30),
  photo_url VARCHAR (200),
  is_admin TINYINT DEFAULT 0,
  login_api INT,
  password_needs_change TINYINT DEFAULT 0,
  is_active TINYINT DEFAULT 0,
  UNIQUE(api_id, login_api)
);

CREATE TABLE IF NOT EXISTS rally (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  points_awarded INT NOT NULL,
  image_url VARCHAR (200),
  description VARCHAR (5000),
  latitude DOUBLE NOT NULL,
  longitude DOUBLE NOT NULL
);

CREATE TABLE IF NOT EXISTS competition(
  id INT AUTO_INCREMENT PRIMARY KEY,
  is_active TINYINT DEFAULT 1,
  starting_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  finishing_date TIMESTAMP,
  is_public TINYINT DEFAULT 1,
  admin_id INT NOT NULL,
  description varchar(2000),
  name VARCHAR(30) NOT NULL,
  rally_id INT NOT NULL,
  FOREIGN KEY (rally_id) REFERENCES rally(id) ON DELETE CASCADE,
  FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS invitation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  accepted TINYINT DEFAULT 0,
  rejected TINYINT DEFAULT 0,
  user_id_send INT NOT NULL,
  user_id_receive INT NOT NULL,
  competition_id INT NOT NULL,
  FOREIGN KEY (user_id_send) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id_receive) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (competition_id) REFERENCES competition(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS competition_statistics(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  competition_id INT NOT NULL,
  starting_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  finishing_date TIMESTAMP,
  points INT DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (competition_id) REFERENCES competition(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS province (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (20) UNIQUE
);

CREATE TABLE IF NOT EXISTS canton (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (40),
  province_id INT NOT NULL,
  FOREIGN KEY (province_id) REFERENCES province(id) ON DELETE NO ACTION
);

CREATE TABLE IF NOT EXISTS district (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (40),
  canton_id INT,
  FOREIGN KEY (canton_id) REFERENCES canton(id) ON DELETE NO ACTION
);

CREATE TABLE IF NOT EXISTS site (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  qr_url VARCHAR(200),
  details VARCHAR(2000),
  description VARCHAR(5000),
  latitude DOUBLE NOT NULL,
  longitude DOUBLE NOT NULL,
  district_id INT NOT NULL,
  points INT DEFAULT 100,
  is_easter_egg TINYINT DEFAULT 0,
  FOREIGN KEY (district_id) REFERENCES district(id) ON DELETE NO ACTION
);

CREATE TABLE IF NOT EXISTS rally_site(
  id INT AUTO_INCREMENT PRIMARY KEY,
  rally_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (rally_id) REFERENCES rally(id) ON DELETE CASCADE,
  FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE,
  UNIQUE (rally_id, site_id)
);

CREATE TABLE IF NOT EXISTS competition_statistics_site(
  id INT AUTO_INCREMENT PRIMARY KEY,
  competition_statistics_id INT NOT NULL,
  site_id INT NOT NULL,
  visited_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (competition_statistics_id) REFERENCES competition_statistics(id) ON DELETE CASCADE,
  FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE,
  UNIQUE (competition_statistics_id, site_id)
);

CREATE TABLE IF NOT EXISTS term (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (40) NOT NULL,
  description VARCHAR(5000)
);

CREATE TABLE IF NOT EXISTS term_site(
  id INT AUTO_INCREMENT PRIMARY KEY,
  term_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (term_id) REFERENCES term(id) ON DELETE CASCADE,
  FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE,
  UNIQUE (term_id, site_id)
);

CREATE TABLE IF NOT EXISTS multimedia(
  id INT AUTO_INCREMENT PRIMARY KEY,
  media_type INT NOT NULL,
  media_url VARCHAR(2000),
  name VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS activity(
  id INT AUTO_INCREMENT PRIMARY KEY,
  site_id INT NOT NULL,
  activity_type INT DEFAULT 0,
  points_awarded INT DEFAULT 100,
  description VARCHAR(5000),
  name VARCHAR(100),
  FOREIGN KEY (site_id) REFERENCES site(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS options(
  id INT AUTO_INCREMENT PRIMARY KEY,
  activity_id INT NOT NULL,
  is_correct TINYINT DEFAULT 0,
  option_text VARCHAR(2000),
  FOREIGN KEY (activity_id) REFERENCES activity(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS activity_multimedia(
  id INT AUTO_INCREMENT PRIMARY KEY,
  activity_id INT NOT NULL,
  multimedia_id INT NOT NULL,
  FOREIGN KEY (activity_id) REFERENCES activity(id) ON DELETE CASCADE,
  FOREIGN KEY (multimedia_id) REFERENCES multimedia(id) ON DELETE CASCADE,
  UNIQUE (activity_id, multimedia_id)
);

CREATE TABLE IF NOT EXISTS term_multimedia(
  id INT AUTO_INCREMENT PRIMARY KEY,
  term_id INT NOT NULL,
  multimedia_id INT NOT NULL,
  FOREIGN KEY (term_id) REFERENCES term(id) ON DELETE CASCADE,
  FOREIGN KEY (multimedia_id) REFERENCES multimedia(id) ON DELETE CASCADE,
  UNIQUE (term_id, multimedia_id)
);

CREATE TABLE IF NOT EXISTS competition_statistics_activity(
  id INT AUTO_INCREMENT PRIMARY KEY,
  competition_statistics_id INT NOT NULL,
  activity_id INT NOT NULL,
  resolved_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  points_obtained INT DEFAULT 0,
  FOREIGN KEY (competition_statistics_id) REFERENCES competition_statistics(id) ON DELETE CASCADE,
  FOREIGN KEY (activity_id) REFERENCES activity(id) ON DELETE CASCADE,
  UNIQUE (competition_statistics_id, activity_id)
);

-- Insert CompetitionStatisticsSite
DELIMITER $$
CREATE TRIGGER insert_competition_statistics_site
AFTER INSERT ON competition_statistics_site FOR EACH ROW
BEGIN
  DECLARE old_points INT;
  DECLARE new_points INT;

  SELECT points INTO @old_points
	FROM competition_statistics c
	WHERE c.id = NEW.competition_statistics_id;

  SELECT points INTO @new_points
	FROM site s
	WHERE s.id = NEW.site_id;

	UPDATE competition_statistics
	SET	points = @old_points + @new_points
	WHERE id = NEW.competition_statistics_id;
END;
$$
DELIMITER ;

-- Delete CompetitionStatisticsSite
DELIMITER $$
CREATE TRIGGER delete_competition_statistics_site
BEFORE DELETE ON competition_statistics_site FOR EACH ROW
BEGIN
  DECLARE old_points INT;
  DECLARE new_points INT;

  SELECT points INTO @old_points
	FROM competition_statistics c
	WHERE c.id = OLD.competition_statistics_id;

  SELECT points INTO @new_points
	FROM site s
	WHERE s.id = OLD.site_id;

	UPDATE competition_statistics
	SET	points = @old_points - @new_points
	WHERE id = OLD.competition_statistics_id;
END;
$$
DELIMITER ;

-- Insert CompetitionStatisticsActivity
DELIMITER $$
CREATE TRIGGER insert_competition_statistics_activity
AFTER INSERT ON competition_statistics_activity FOR EACH ROW
BEGIN
  DECLARE old_points INT;

  SELECT points INTO @old_points
	FROM competition_statistics c
	WHERE c.id = NEW.competition_statistics_id;

	UPDATE competition_statistics
	SET	points = @old_points + NEW.points_obtained
	WHERE id = NEW.competition_statistics_id;
END;
$$
DELIMITER ;

-- Delete CompetitionStatisticsActivity
DELIMITER $$
CREATE TRIGGER delete_competition_statistics_activity
BEFORE DELETE ON competition_statistics_activity FOR EACH ROW
BEGIN
  DECLARE old_points INT;

  SELECT points INTO @old_points
	FROM competition_statistics c
	WHERE c.id = OLD.competition_statistics_id;

	UPDATE competition_statistics
	SET	points = @old_points - OLD.points_obtained
	WHERE id = OLD.competition_statistics_id;
END;
$$
DELIMITER ;

-- Update Site
DELIMITER $$
CREATE TRIGGER update_site
AFTER UPDATE ON site FOR EACH ROW
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE statistics_id INT;
  DECLARE old_points INT;
  DEClARE statistics_cursor CURSOR FOR SELECT competition_statistics_id FROM competition_statistics_site WHERE site_id = NEW.id;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN statistics_cursor;

  statistics_loop: LOOP
    FETCH statistics_cursor INTO statistics_id;
    IF done THEN
      LEAVE statistics_loop;
    END IF;

    SELECT points INTO old_points
	  FROM competition_statistics c
	  WHERE c.id = statistics_id;

	  UPDATE competition_statistics
	  SET	points = old_points - OLD.points + NEW.points
	  WHERE id = statistics_id;

  END LOOP statistics_loop;

  CLOSE statistics_cursor;

END;
$$
DELIMITER ;

-- Update Activity
DELIMITER $$
CREATE TRIGGER update_competition_statistics_activity
AFTER UPDATE ON competition_statistics_activity FOR EACH ROW
BEGIN
  DECLARE old_points INT;

  SELECT points INTO @old_points
	FROM competition_statistics c
	WHERE c.id = NEW.competition_statistics_id;

	UPDATE competition_statistics
	SET	points = @old_points - OLD.points_obtained + NEW.points_obtained
	WHERE id = NEW.competition_statistics_id;

END;
$$
DELIMITER ;

-- Create Competition end date
DELIMITER $$
CREATE TRIGGER insert_competition
BEFORE INSERT ON competition FOR EACH ROW
SET
  NEW.finishing_date = TIMESTAMPADD(DAY,8,NOW())
$$
DELIMITER ;