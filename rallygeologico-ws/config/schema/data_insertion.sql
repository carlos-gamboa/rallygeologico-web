INSERT INTO `province` (`name`) VALUES ('Guanacaste');
INSERT INTO `province` (`name`) VALUES ('Alajuela');
INSERT INTO `province` (`name`) VALUES ('Puntarenas');
INSERT INTO `province` (`name`) VALUES ('Limón');
INSERT INTO `province` (`name`) VALUES ('San José');
INSERT INTO `province` (`name`) VALUES ('Cartago');
INSERT INTO `province` (`name`) VALUES ('Heredia');

INSERT INTO `canton` (`name`, `province_id`) VALUES ('Liberia', 'Guanacaste');
INSERT INTO `canton` (`name`, `province_id`) VALUES ('La Cruz', 'Guanacaste');

INSERT INTO `district` (`name`, `canton_id`) VALUES ('Nacascolo', 'Liberia');
INSERT INTO `district` (`name`, `canton_id`) VALUES ('Santa Elena', 'La Cruz');

INSERT INTO `site` (`id`, `name`, `points_awarded`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'El Monumento', '100', NULL, 'Uso de la brújula (la aplicación muestra los pasos a seguir para el uso de la misma).', 'Desde este punto se pueden observar volcanes de la Cordillera Volcánica de Guanacaste. El volcán Orosí (N48°E), el volcán Cacao (N60°E) y el volcán Rincón de la Vieja (N90°E).\r\nHacia el azimut 110° (Sureste) se observa el cerro Góngora que es un domo volcánico con una edad de unos 8 millones de años. Un domo de lava se forma cuando sale lava muy densa o viscosa, que no puede fluir y se enfría. Queda como una protuberancia del terreno.\r\nLigeramente a la derecha del cerro Góngora se observan protuberancias del terreno más pequeñas que corresponden con los domos de Cañas Dulces, que fueron domos que se formaron por erupciones de lava que ocurrieron hace unos 1.5 millones de años.\r\nEl participante en este juego está ubicado sobre la Meseta de Ignimbrita, que es una planicie formada por una serie de erupciones volcánicas violentas que cubrieron la topografía existente hace unos 2 millones de años. Las ignimbritas son flujos de fragmentos volcánicos que se depositaron violentamente, después de la explosión de un volcán. En este caso rellenaron la topografía existente y dejaron una planicie (Meseta de ignimbritas).\r\nDesde este punto se puede observar la península de Santa Elena al Noroeste. El cerro El Inglés es uno de los puntos más altos de la península de Santa Elena con más de 500 m de altura). \r\nDesde este sitio lo puede observar hacia el Noroeste (305°), que está compuesta por rocas provenientes del manto terrestre (acá lo lleva a la figura 1c). \r\nEs decir, rocas que viajaron desde más de 40 kilómetros para llegar a la superficie terrestre. Estas rocas son más antiguas que 80 millones de años. ', '10.8341667', '-85.61138888888888', 'Nacascolo');
INSERT INTO `site` (`id`, `name`, `points_awarded`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La Casona', '100', NULL, 'Acceso con automóvil.', 'La Casona está edificada sobre rocas de la meseta ignimbrítica de unos 2 millones de años de antiguedad. Específicamente en este sitio, estas rocas contienen fragmentos de lava negruscos, que se llaman escorias caracterizadas por contener muchos poros, que fueron cavidades que contenían gases volcánicos cuando se formaron.', '10.8336111', '-85.6125', 'Nacascolo');
INSERT INTO `site` (`id`, `name`, `points_awarded`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La Discordancia de La Cortina', '100', NULL, 'Bajando la cuesta de La Cortina.\r\nEs un sitio de difícil parqueo. \r\nDebe parquear el vehículo en un sitio seguro y caminar hacia la discordancia.', 'Una discordancia angular es una superficie que representa una roca más joven, depositada sobre una más antigua que ha sido deformada y erosionada. Ver esquema. \r\nEn esta discordancia se tienen rocas sedimentarias de una edad de unos 30 millones de años, que se formaron en el lecho marino, se hicieron roca y posteriormente se deformaron y salieron a la superficie terrestre. La erosión aplanó la topografía y posteriormente fue cubierta por rocas producidas por una violenta erupción volcánica hace unos 2 millones de años.\r\nEl calor del depósito volcánico (ignimbrita) quemó el suelo antiguo (paleosuelo). ', '10.9477778', '-85.65611111111112', 'Santa Elena');

INSERT INTO `rally` (`id`, `name`, `points_awarded`, `image_url`, `description`) VALUES (NULL, 'Recorrido por Guanacaste', '500', NULL, 'Los rallies abarcan parte del Área de Conservación Guanacaste, los pueblos de Cuajiniquil y La Cruz y sitios cercanos, comprendiendo rocas con edades de 30 millones de años (Oligoceno) a la actualidad (Cuaternario). Además, algunos de estos territorios son declarados Patrimonio de la Humanidad (UNESCO, 1999, id N°928).\r\nEl noroeste de Costa Rica se diferencia por sus amplios paisajes geológicos, que dan paso al desarrollo de gran biodiversidad de la fauna y flora. El empleo de los recursos naturales en parques nacionales es de preponderancia para la divulgación, la educación y el turismo local.\r\nLa ampliación de la oferta económica en la zona es de gran apoyo para las actividades locales, basadas principalmente en la pesca. A partir del geoturismo se promueven: la recreación educativa y cultural, generación de empleo y la concientización acerca del rescate de valores patrimoniales, teniendo como base la geología y demás ciencias sustentadas a través de esta.');

INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '1');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '2');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '3');

INSERT INTO `users` (`id`, `facebook_id`, `username`, `first_name`, `last_name`, `email`, `photo_url`, `is_admin`) VALUES (NULL, '123456789123456', 'alan', 'Alan', 'Calderón', 'alan.calderon@ucr.ac.cr', NULL, b'0');
INSERT INTO `users` (`id`, `facebook_id`, `username`, `first_name`, `last_name`, `email`, `photo_url`, `is_admin`) VALUES (NULL, '654321987654321', 'pablo', 'Juan Pablo', 'Solano', 'juan.solano@ucr.ac.cr', NULL, b'1');