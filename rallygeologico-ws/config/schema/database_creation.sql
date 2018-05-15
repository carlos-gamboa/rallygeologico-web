CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  api_id VARCHAR(30) NOT NULL,
  username VARCHAR(30) UNIQUE NOT NULL,
  first_name VARCHAR(15),
  last_name VARCHAR(15),
  email VARCHAR(30),
  photo_url VARCHAR (200),
  is_admin BIT DEFAULT 0,
  login_api INT
);

CREATE TABLE IF NOT EXISTS rally (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  points_awarded INT NOT NULL,
  image_url VARCHAR (200),
  description VARCHAR (5000),
  latitude FLOAT NOT NULL,
  longitude FLOAT NOT NULL
);

CREATE TABLE IF NOT EXISTS competition(
  id INT AUTO_INCREMENT PRIMARY KEY,
  is_active BIT DEFAULT 1,
  starting_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  finishing_date DATETIME,
  is_public BIT DEFAULT 1,
  admin_id INT,
  description varchar(2000),
  name VARCHAR(30) NOT NULL,
  rally_id INT NOT NULL,
  FOREIGN KEY (rally_id) REFERENCES rally(id),
  FOREIGN KEY (admin_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS invitation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  accepted BIT DEFAULT 0,
  rejected BIT DEFAULT 0,
  user_id_send INT NOT NULL,
  user_id_receive INT NOT NULL,
  competition_id INT NOT NULL,
  FOREIGN KEY (user_id_send) REFERENCES users(id),
  FOREIGN KEY (user_id_receive) REFERENCES users(id),
  FOREIGN KEY (competition_id) REFERENCES competition(id)
);

CREATE TABLE IF NOT EXISTS competition_statistics(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  competition_id INT NOT NULL,
  starting_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  finishing_date DATETIME,
  points INT DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (competition_id) REFERENCES competition(id)
);

CREATE TABLE IF NOT EXISTS province (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (20) UNIQUE
);

CREATE TABLE IF NOT EXISTS canton (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (40),
  province_id INT NOT NULL,
  FOREIGN KEY (province_id) REFERENCES province(id)
);

CREATE TABLE IF NOT EXISTS district (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (40),
  canton_id INT,
  FOREIGN KEY (canton_id) REFERENCES canton(id)
);

CREATE TABLE IF NOT EXISTS site (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  qr_url VARCHAR(200),
  details VARCHAR(2000),
  description VARCHAR(2000),
  latitude FLOAT NOT NULL,
  longitude FLOAT NOT NULL,
  district_id INT NOT NULL,
  FOREIGN KEY (district_id) REFERENCES district(id)
);

CREATE TABLE IF NOT EXISTS rally_site(
  rally_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (rally_id) REFERENCES rally(id),
  FOREIGN KEY (site_id) REFERENCES site(id),
  PRIMARY KEY (rally_id, site_id)
);

CREATE TABLE IF NOT EXISTS competition_statistics_site(
  competition_statistics_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (competition_statistics_id) REFERENCES competition_statistics(id),
  FOREIGN KEY (site_id) REFERENCES site(id),
  PRIMARY KEY (competition_statistics_id, site_id)
);

CREATE TABLE IF NOT EXISTS term (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (40) NOT NULL,
  description VARCHAR(2000)
);

CREATE TABLE IF NOT EXISTS term_site(
  term_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (term_id) REFERENCES term(id),
  FOREIGN KEY (site_id) REFERENCES site(id),
  PRIMARY KEY (term_id, site_id)
);

CREATE TABLE IF NOT EXISTS multimedia(
  id INT AUTO_INCREMENT PRIMARY KEY,
  media_type INT NOT NULL,
  media_url VARCHAR(2000)
);

CREATE TABLE IF NOT EXISTS activity(
  id INT AUTO_INCREMENT PRIMARY KEY,
  site_id INT,
  activity_type INT NOT NULL,
  points_awarded INT NOT NULL,
  description VARCHAR(1000),
  FOREIGN KEY (site_id) REFERENCES site(id)
);

CREATE TABLE IF NOT EXISTS options(
  id INT AUTO_INCREMENT PRIMARY KEY,
  activity_id INT,
  is_correct BIT NOT NULL,
  option_text VARCHAR(200),
  FOREIGN KEY (activity_id) REFERENCES activity(id)
);

CREATE TABLE IF NOT EXISTS activity_multimedia(
  activity_id INT NOT NULL,
  multimedia_id INT NOT NULL,
  FOREIGN KEY (activity_id) REFERENCES activity(id),
  FOREIGN KEY (multimedia_id) REFERENCES multimedia(id),
  PRIMARY KEY (activity_id, multimedia_id)
);

CREATE TABLE IF NOT EXISTS term_multimedia(
  term_id INT NOT NULL,
  multimedia_id INT NOT NULL,
  FOREIGN KEY (term_id) REFERENCES term(id),
  FOREIGN KEY (multimedia_id) REFERENCES multimedia(id),
  PRIMARY KEY (term_id, multimedia_id)
);