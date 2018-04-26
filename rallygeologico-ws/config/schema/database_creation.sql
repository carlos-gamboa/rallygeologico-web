CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  facebook_id VARCHAR(30) UNIQUE NOT NULL,
  username VARCHAR(30) UNIQUE NOT NULL,
  first_name VARCHAR(15),
  last_name VARCHAR(15),
  email VARCHAR(30),
  photo_url VARCHAR (200),
  is_admin BIT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS rally (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  points_awarded INT NOT NULL,
  image_url VARCHAR (200),
  description VARCHAR (5000)
);

CREATE TABLE IF NOT EXISTS competition(
  id INT AUTO_INCREMENT PRIMARY KEY,
  is_active BIT DEFAULT 1,
  starting_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  finishing_date DATETIME,
  is_public BIT DEFAULT 1,
  Name VARCHAR(30) NOT NULL,
  rally_id INT NOT NULL,
  FOREIGN KEY (rally_id) REFERENCES rally(id)
);

CREATE TABLE IF NOT EXISTS invitation (
  id INT AUTO_INCREMENT PRIMARY KEY,
  accepted BIT DEFAULT 0,
  user_id_send INT NOT NULL,
  user_id_receive INT NOT NULL,
  competition_id INT NOT NULL,
  FOREIGN KEY (user_id_send) REFERENCES users(id),
  FOREIGN KEY (user_id_receive) REFERENCES users(id),
  FOREIGN KEY (competition_id) REFERENCES competition(id)
);

CREATE TABLE IF NOT EXISTS competition_statistics(
  user_id INT NOT NULL,
  competition_id INT NOT NULL,
  starting_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  finishing_date DATETIME,
  points INT DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (competition_id) REFERENCES competition(id),
  PRIMARY KEY (user_id, competition_id)
);

CREATE TABLE IF NOT EXISTS province (
  name VARCHAR (20) PRIMARY KEY
);

CREATE TABLE IF NOT EXISTS canton (
  name VARCHAR (40) PRIMARY KEY,
  province_id VARCHAR (20) NOT NULL,
  FOREIGN KEY (province_id) REFERENCES province(Name)
);

CREATE TABLE IF NOT EXISTS district (
  name VARCHAR (40) PRIMARY KEY,
  canton_id VARCHAR(40),
  FOREIGN KEY (canton_id) REFERENCES canton(name)
);

CREATE TABLE IF NOT EXISTS site (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  points_awarded INT NOT NULL,
  qr_url VARCHAR(200),
  details VARCHAR(2000),
  description VARCHAR(2000),
  latitude FLOAT NOT NULL,
  longitude FLOAT NOT NULL,
  district_id VARCHAR (40) NOT NULL,
  FOREIGN KEY (district_id) REFERENCES district(name)
);

CREATE TABLE IF NOT EXISTS rally_site(
  rally_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (rally_id) REFERENCES rally(id),
  FOREIGN KEY (site_id) REFERENCES site(id),
  PRIMARY KEY (rally_id, site_id)
);

CREATE TABLE IF NOT EXISTS competition_statistics_site(
  user_id INT NOT NULL,
  competition_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES competition_statistics(user_id),
  FOREIGN KEY (competition_id) REFERENCES competition_statistics(competition_id),
  FOREIGN KEY (site_id) REFERENCES site(id),
  PRIMARY KEY (user_id, competition_id, site_id)
);

CREATE TABLE IF NOT EXISTS term (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image_url VARCHAR (2000),
  video_url VARCHAR (200),
  name VARCHAR (40) NOT NULL,
  description VARCHAR(2000)
);

CREATE TABLE term_site(
  term_id INT NOT NULL,
  site_id INT NOT NULL,
  FOREIGN KEY (term_id) REFERENCES term(id),
  FOREIGN KEY (site_id) REFERENCES term(id),
  PRIMARY KEY (term_id, site_id)
);
