INSERT INTO `province` (`name`) VALUES ('Guanacaste');
INSERT INTO `province` (`name`) VALUES ('Alajuela');
INSERT INTO `province` (`name`) VALUES ('Puntarenas');
INSERT INTO `province` (`name`) VALUES ('Limón');
INSERT INTO `province` (`name`) VALUES ('San José');
INSERT INTO `province` (`name`) VALUES ('Cartago');
INSERT INTO `province` (`name`) VALUES ('Heredia');

INSERT INTO `canton` (`name`, `province_id`) VALUES ('Liberia', 1);
INSERT INTO `canton` (`name`, `province_id`) VALUES ('La Cruz', 1);

INSERT INTO `district` (`name`, `canton_id`) VALUES ('Nacascolo', 1);
INSERT INTO `district` (`name`, `canton_id`) VALUES ('Santa Elena', 2);

INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'El monumento', NULL, 'Se denomina brújula a un instrumento que se basa en el uso de una aguja imantada, que gira libremente alrededor de un eje y señala el norte magnético de la Tierra. Se usa un círculo graduado para determinar una ubicación de un punto con respecto a la posición horizontal que tenemos. De esta forma, si asumimos que estamos en el centro y la aguja de la brújula apunta hacia la mitad del cuadrante Noreste, tendremos un rumbo Noreste, o más exactamente un azimuth de 45°. De la misma forma, un rumbo de 200° lo lleva a 0c estará indicando una dirección en el cuadrante Suroeste.',
 'Desde este punto se pueden observar volcanes de la Cordillera Volcánica de Guanacaste. El volcán Orosí (N48°), el volcán Cacao (N60°) y el volcán Rincón de la Vieja (N90°).Hacia el azimut 110° (Sureste) se observa el cerro Góngora que es un domo volcánico con una edad de unos 8 millones de años. Un domo de lava se forma cuando sale lava muy densa o viscosa, que no puede fluir y se enfría. Queda como una protuberancia del terreno. Ligeramente a la derecha del cerro Góngora se observan protuberancias del terreno más pequeñas que corresponden con los domos de Cañas Dulces, que fueron domos que se formaron por erupciones de lava que ocurrieron hace unos 1.5 millones de años. El participante en este juego está parado sobre la Meseta de Ignimbrita, que es una planicie formada por una serie de erupciones volcánicas violentas que cubrieron la topografía existente hace unos 2 millones explosión  de  un  volcán.  En  este  caso  rellenaron  la  topografía  existente  y  dejaron  una  planicie  (Meseta  de  ignimbrita). Desde  este  punto  se  puede  observar  la  península  de  Santa  Elena  al  Noroeste,    El  cerro  El  Inglés  que  es  uno  de  los  puntos  más  altos  de  la  península  de  Santa  Elena  con  más  de  500  m  de  altura.    Desde  este  sitio  lo  puede  observar  hacia  el  Noroeste  (305°),  que  está  compuesta  por  rocas  provenientes  del  manto    terrestre.    Es  decir,  rocas  que  viajaron  desde  más  de  40  kilómetros  para  llegar  a  la  superficie  terrestre.  Estas  rocas  son  más  antiguas  que  80  millones  de  años.', '10.50053', '-85.36689', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La casona', NULL, '',
 'La Casona está edificada sobre rocas de la meseta ignimbrítica de unos 2 millones de años de antiguedad.  Específicamente en este sitio, estas rocas contienen fragmentos de lava negruscos, que se llaman escorias por contener muchos poros, que fueron cavidades que contenían gases volcánicos cuando se formaron.', '10.50017', '-85.36750', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La Discordancia de La Cortina', NULL, 'Bajando la cuesta de La Cortina. Es un sitio de difícil parqueo. Debe parquear el vehículo en un sitio seguro y caminar hacia la discordancia.',
 'Una discordancia angular es una superficie que representa una roca más joven, depositada sobre una más antigua que ha sido deformada y erosionada. Ver esquema. En esta discordancia caso se tienen rocas sedimentarias de una edad de unos 30 millones de años, que se formaron en el lecho marino, se hicieron roca y posteriormente se deformaron y salieron a la superficie terrestre. La erosión aplanó la topografía y posteriormente fue cubierta por rocas producidas por una violenta erupción volcánica hace unos 2 millones de años. El calor del depósito volcánico (ignimbrita) quemó el suelo antiguo (paleosuelo).', '10.56874', '-85.39370', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'Peridotitas de Murciélago', NULL, 'Para llegar a este sitio se debe pasar el poblado de Cuajiniquil y llegar al Sector Murciélago del Área de Conservación Guanacaste.  Se debe ubicar el río Murciélago por el área de acampar y a partir de ahí caminar sobre el río unos cientos de metros.',
 'Las peridotitas tuvieron un viaje de por lo menos 40 kilómetros desde el interior del planeta Tierra hasta el sitio donde están hoy, la península de Santa Elena. Durante este viaje, las peridotitas fueron “cruzadas” por otra roca fundida, que entró y rellenó las zonas más débiles de la peridotita, un ejemplo del acantilado de la península de Santa Elena. Esto ocurrió entre 115 y 125 millones de años. Esta roca es conocida por los geólogos como diabasas y por el hecho de penetrar a las peridotita, se usa el término de dique. Por lo que serían denominadas diques de diabasa. Estas diabasas entrecruzaron a las peridotitas a veces a tal grado que superan en volumen a las peridotitas. Para poder ver las rocas al microscopio, los geólogos cortan la roca y hacen una placa muy delgada que pegan en un vidrio. Es así como pasa la luz a través de la muestra y se pueden estudiar.  Las peridotitas tienen minerales muy ricos en hierro y magnesio, que se llaman olivinos y piroxenos. En el microscopio, los geólogos usan dos tipos de luz para estudiar las rocas, la luz natural que vibra en todas direcciones y la luz polarizada que vibra en una sola dirección. ', '10.53975', '-85.43823', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La expoza de El General', NULL, 'Para llegar a este punto se caminan unos 300 m hacia el Sur, sobre el lecho del río Murciélago ',
 'Este punto tiene rocas muy similares a las vistas en el punto anterior, peridotitas y diques de diabasa. Este lugar muestra la fuerza y dramatismo de las fuerzas de la Tierra, pues antes del 12 de Octubre del 2017 había una poza, que se llamaba la Poza de El General, que tenía agua todo el año y como consecuencia de las avenidas de material rocoso provocadas por la tormenta Nate la poza se cubrió con clastos de roca de un espesor de por lo menos 3 m. ', '10.53820', '-85.43826', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La 4x4', NULL, 'En el camino del puesto Murciélago hacia Cuajiniquil debe desviarse a la izquierda para ir a la playa denominada la 4x4. Preferiblemente ir a esta localidad en la marea baja.  ',
 'En esta localidad se observan varios estratos, que son las capas en que se encuentran divididos los sedimentos, como un resultado de sus características físicas. Estas rocas se formaron por acumulación de arenas, en el fondo marino hace unos 35 millones de años. Los estratos se depositan originalmente en forma horizontal y posteriormente se inclinan como un resutado de las fuerzas de la Tierra.  En este caso, el estrato de arenisca está inclinado  22°, con respecto a la horizontal. La dirección de inclinación es hacia el Norte.  Verifique el ángulo de inclinación. Durante el proceso de basculamiento o inclinación de los estratos se produjeron fracturas de la roca. Estas fracturas han sido utilizadas por los árboles para sentar sus raíces. Los árboles son una poderoza fuerza de destrucción de la roca. En esta localidad también se observan varias estructuras en la roca, como las huellas de las perforaciones de organismos (cangrejos por ejemplo). Estas huellas se conocen como bioturbaciones.  En la foto se destacan parcialmente las huellas con línea amarilla punteada y la piqueta o martillo geológico sirve de escala, pues tiene unos 30 cm de largo. También es destacable la pesencia de restos de troncos, destables por su tonalidad rojiza.', '10.50053', '-85.36689', 2);

INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'El mirador', NULL, 'Este mirador está ubicado en el camino que va de Cuajiniquil a el Parque Nacional Junquillal. Se va a necesitar de su conocimiento adquirido de la brújula. ',
 'Desde este mirador. Se observa La isla Los Muñecos. Localice visualmente el muñeco de la isla, que es un monolito de piedra caliza (relicto de erosión) en el extremo izquierdo de la isla. Active la brújula. Dirija la brújula hacia el “muñeco” y acepte el azimuth. Esta isla está compuesta por calizas, que son rocas ricas en carbonato de calcio (CaCO3).  Estas rocas se disuelven con el agua y forman hermosas “esculturas” como El Muñeco.  Anteriormente eran 2 muñecos, pero hace unos años el muñeco más grande, que llamaban Nefertiti desapareció.  Las rocas calizas que conforman esta isla fueron originados por construcciones de arrecifes de coral que se formaron hace unos 30 millones de años. ', '10.57746', '-85.41856', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La Islita', NULL, 'En el camino del Mirador hacia Junquillal, unos 300 m hay un desvío a la izquierda.',
 'Estas rocas se formaron hace unos 35 millones de años, son muy parecidas a las de la playa 4x4.  Se pueden observar algunos troncos. y espectaculares bioturbaciones destacadas con líneas punteadas y flechas. ', '10.57833', '-85.41765', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'Junquillal', NULL, 'Llegar al sector Junquillal del Área de Conservación Guanacaste y seguir el sendero conocido como Carao. Cuando se llega al punto más alto del sendero estará en en la localidad indicada.',
 'Esta roca es una caliza (roca cuya composición es carbonato de calcio CaCO3), formada por la acumulación de organismos marinos de forma lenticular de alrededor de 1 cm de diámetro (tipo “platillo volador”) en un océano que existió hace unos 40 millones de años. Estos organismos se llaman macroforaminíferos, e internamente sus conchas tienen una estructura interna complicada que se observa en el modelo tridimensional.', '10.58146', '-85.41095', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La Coyotera', NULL, 'Siguiendo el camino de Junquillal a La Cruz, se desvía a la izquierda hacia el Jobo y luego a la derecha hacia el hotel EcoPlaya.',
 'Esta roca se llama conglomerado. Es una roca sedimentaria formada por fragmentos redondeados de otras rocas inmersas en una arenisca.', '10.50053', '-85.36689', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La Duna', NULL, 'Caminando hacia el Norte unos 50 m.',
 'Esta zona está muy afectada por el viento, que entre diciembre y mayo entra con dirección del Noreste al Suroeste. La arena de la playa se comienza a acumular en un montículo que se denomina “duna costera”.', '10.02691', '-85.43403', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'El mojón', NULL, 'Para llegar a este sitio se debe tomar un desvío hacia el norte en la cuesta de “La Cortina”, que se ubica al Oeste del poblado de La Cruz. Se pasa el puesto de Policía de Frontera y se baja un camino por 100 m. Se debe tener cuidado de no caminar hacia el Norte, pues se cruza la frontera con Nicaragua.  Se hará uso de la brújula para obtener azimuths.',
 'En este sitio se pueden observar una serie de estratos de roca tipo arenisca fina, dispuesta en numerosas capas, que repersetan los estratos o eventos durante la depositación de las arenas en un mar relativamente profundo, lo cual ocurrió hace unos 40 millones de años. Los estratos están inclinados hacia el Suroeste, específicamente 210° como se nota con la flecha.  Las líneas amarillas en la imagen muestran las fracturas producidas por las fuerzas de la Tierra. Estas fracturas forman polígonos en las rocas. ', '11.04740', '-85.36689', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'El propio Mojón', NULL, 'Muy cerca de la casa de la Policía de Fronteras se puede encontrar el Mojón del Instituto Geográfica.',
 'Este sitio es un punto de importancia geográfica, pues es el indicativo geodésico del límite fronterizo.', '10.04785', '-85.41555', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'El mirador', NULL, 'Subiendo la cuesta de La Cortina, hay un mirador de la Municipalidad de La Cruz.',
 'Desde este punto se observa la bahía Salinas, y se observan puntos vistos en otros puntos de este juego. Parte de la razón de esta depresión del terreno que forma la bahía Salinas se debe a que las capas sedimentarias se han doblado (plegado) por las fuerzas de la Tierra y ahora las capas del lado Sur se inclinan hacia el Noreste y las capas del lado Norte se inclinan hacia el Suroeste, formando una cubeta que se llama sinclinal. ', '10.04340', '-85.38210', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La brecha', NULL, 'Caminando unos 30 m, sobre la carretera, abajo del mirador.',
 'En este sitio se puede observar una brecha. Una brecha  es una roca constituida por fragmentos irregulares de otras rocas, que están dentro de una masa rocosa (matriz) de grano más fino. En este caso todos los fragmentos son volcánicos y se formaron por una gran avalancha o derrumbe de algún antiguo volcán cercano. ', '10.04360', '-85.38178', 2);

INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'Volcanes jóvenes y viejos', NULL, 'A la par del camino que se dirige al poblado de Santa Cecilia se puede observar una buena vista del volcán Orosí.',
 'Observando en dirección al Sur se pueden observar 2 estructuras volcánicas. Este es un ejemplo de estructuras volcánicas. Con una dirección Sureste (aproximadamente un azimuth de 140°) está un volcán relativamente reciente que ha tenido actividad hace unos cuantos miles de años y al Sur-Suroeste (aproximadamente 200°) se encuentra una estructura volcánica erosionada que se conoce como el cerro El Hacha, cuya actividad terminó hace unos 2 millones de años. Las rocas que sobresalen del suelo en este sitio probablemente provienen de erupciones de este volcán.', '11.02253', '-85.3274', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'Las biotitas de Liberia', NULL, 'Este sitio es a la orilla de la carretera y sería conveniente que lleve una lupa o use una App de lupa en su teléfono.',
 'Esta roca blancuzca y polvorosa, fue producto de una explosiva erupción de un volcán extinto, cuyos productos volcánicos cubrieron una extensa área que va desde Upala, La Cruz y Bagaces, que ocurrió alrededor de 1,5 millones de años. Cuando se observa con una lupa se podrán apreciar unos cristales muy brillantes, que son como láminas y muchas veces hexagonales que se llaman biotita ', '11.02827', '-85.35910', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'La Cueva del Duende', NULL, 'Para visitar este sitio se debe entrar al Parque Santa Rosa y dirigirse a la Casona, ahí se toma el sendero Indio Desnudo. ',
 'Cuando se llega a la quebrada Duende se puede observar La Cueva del Duende, que es un puente natural formado por una capa más resistente en la parte superior, y la capa inferior se erosionó. Se puede observar ambos extremos de la cueva.', '11.50204', '-85.36679', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'Quebrada Costa Rica', NULL, 'Para llegar a este sitio se debe tomar el camino hacia playa Naranjo, y llegar a la quebrada Costa Rica, ahí se toma el sendero Los Patos.',
 'El sendero lleva a un sitio donde se observa una roca volcánica de una edad mayor a los 2 millones de años. Cuando se observa con atención se puede observar unos componentes alargados que se llaman fiammes, y que son fragmentos de vidrio volcánico. También se observan unos huecos formados por la erosión, que se llaman marmitas de erosión. Estas estructuras se forman por la erosión de algunos fragmentos de roca que raspan los huecos esféricos y los van haciendo poco a poco más grandes. ', '11.49378', '-85.38081', 2);
INSERT INTO `site` (`id`, `name`, `qr_url`, `details`, `description`, `latitude`, `longitude`, `district_id`) VALUES (NULL, 'Las columnas de Carbonal', NULL, 'Continuando sobre el camino a playa Naranjo.',
 'Cuando algunas lavas se enfrían producen un sistema de fracturas en forma de columnas. Estas fracturas se forman por la contracción del material lávico al enfriar, y son idealmente en forma de hexágonos, aunque generalmente son un poco más irregulares.', '10.47893', '-85.38501', 2);

INSERT INTO `rally` (`id`, `name`, `points_awarded`, `image_url`, `description`, `latitude`, `longitude`) VALUES (NULL, 'Rally 1', '500', NULL, 'El Rally #1 incluye localidades en sitios del cantón de La Cruz como: El parque nacional Santa Rosa, con increíbles paisajes naturales declarados patrimonio de la humanidad; y Cuajiniquil, pueblo costero cuya principal actividad económica es la pesca y el creciente desarrollo turístico. En este rally se conocerán rocas volcánicas generadas en las profundidades oceánicas, así como rocas sedimentarias consecuencia de eventos meteorológicos fosilizados en las rocas, conocidas por los geólogos como tormentitas, y algunas rocas producto de erupciones volcánicas explosivas.', '10.50053', '-85.36689');
INSERT INTO `rally` (`id`, `name`, `points_awarded`, `image_url`, `description`, `latitude`, `longitude`) VALUES (NULL, 'Rally 2', '500', NULL, 'Esta geoaventura abarca pueblos costeros del cantón de La Cruz, entre los que destacan Cuajiniquil, pueblo cercano a sitios turísticos; El Jobo, pueblo con diversidad de playas y el centro poblacional del cantón, identificado por sus maravillosas vistas a la cordillera volcánica de Guanacaste y a bahía Salinas. Geológicamente se abarcan rocas sedimentarias producto de grandes avalanchas volcánicas, antiguos arrecifes coralinos, dunas activas y rocas generadas por eventos climáticos fosilizados en las rocas.', '10.57746', '-85.41856');
INSERT INTO `rally` (`id`, `name`, `points_awarded`, `image_url`, `description`, `latitude`, `longitude`) VALUES (NULL, 'Rally 3', '500', NULL, 'Este rally comprende sitios entre el parque nacional Santa Rosa, caracterizado por su alta geobiodiversidad, y el centro poblacional del cantón de La Cruz – Santa Cecilia, con sus planicies que permiten la visualización de diversas geoformas moldeadas por diferentes procesos geológicos. Desde el punto de vista geológico se identificarán rocas conformadas por diferentes tipos de actividad volcánica como: Erupciones explosivas de gas y sólidos y erupciones lávicas.', '11.02253', '-85.3274');

INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '1');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '2');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '3');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '4');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '5');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('1', '6');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '7');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '8');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '9');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '10');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '11');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '12');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '13');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '14');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('2', '15');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('3', '16');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('3', '17');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('3', '18');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('3', '19');
INSERT INTO `rally_site` (`rally_id`, `site_id`) VALUES ('3', '20');

INSERT INTO `users` (`id`, `api_id`, `username`, `first_name`, `last_name`, `email`, `photo_url`, `is_admin`, `login_api`) VALUES (NULL, '123456789123456', 'alan', 'Alan', 'Calderón', 'alan.calderon@ucr.ac.cr', NULL, b'0', 0);
INSERT INTO `users` (`id`, `api_id`, `username`, `first_name`, `last_name`, `email`, `photo_url`, `is_admin`, `login_api`) VALUES (NULL, '654321987654321', 'pablo', 'Juan Pablo', 'Solano', 'juan.solano@ucr.ac.cr', NULL, b'1', 0);

INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Círculo Graduado', ''); -- 1
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Azimuth', ''); -- 2
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Cordillera Volcánica de Guanacaste', ''); -- 3
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'El cerro El Inglés', ''); -- 4
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Manto terrestre', ''); -- 5
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Placa del Geográfico', ''); -- 6
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Discordancia', ''); -- 7
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Peridotitas', ''); -- 8
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Acantilado de la península de Santa Elena', ''); -- 9
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Dique de diabasa', ''); -- 10
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Poza de El General', ''); -- 11
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Estratos', ''); -- 12
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Inclinado', ''); -- 13
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Fracturas', ''); -- 14
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Árboles', ''); -- 15
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Destrucción de la roca', ''); -- 16
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Bioturbaciones', ''); -- 17
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Troncos', ''); -- 18
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Mirador', ''); -- 19
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Los Muñecos', ''); -- 20
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Nefertiti', ''); -- 21
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Coral', ''); -- 22
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Lenticular', ''); -- 23
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Modelo tridimensional', ''); -- 24
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Conglomerado', ''); -- 25
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Fragmentos redondeados', ''); -- 26
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Duna costera', ''); -- 27
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Flecha', ''); -- 28
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Polígonos', ''); -- 29
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Límite fronterizo', ''); -- 30
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Puntos', ''); -- 31
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Sinclinal', ''); -- 32
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Brecha', ''); -- 33
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Estructuras volcánicas', ''); -- 34
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Roca', ''); -- 35
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Biotita', ''); -- 36
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Quebrada Duende', ''); -- 37
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Fiammes', ''); -- 38
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Marmitas de erosión', ''); -- 39
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Columnas', ''); -- 40
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Hexágonos', ''); -- 41
INSERT INTO `term` (`id`, `name`, `description`) VALUES (NULL, 'Escoria', ''); -- 42

INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Círculo gradudo'); -- 1
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Azimuth de 45°'); -- 2
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Azimuth de 200°'); -- 3
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Cordillera Volcánica de Guanacaste'); -- 4
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'El cerro El Ingés'); -- 5
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Manto terrestre'); -- 6
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Placa del Geográfico'); -- 7
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Escorias'); -- 8
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Ver esquema'); -- 9
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Esta discordancia'); -- 10
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Peridotitas'); -- 11
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Un ejemplo del acantilado de la península de Santa Elena'); -- 12
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Peridotita en luz natural'); -- 13
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Peridotita en luz polarizada'); -- 14
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Dique de diabasa en luz natural'); -- 15
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Dique de diabasa en luz polarizada'); -- 16
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Peridotitas y diques de diabasa'); -- 17
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Poza de El General'); -- 18
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Estratos'); -- 19
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Inclinado'); -- 20
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Fracturas'); -- 21
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Árboles'); -- 22
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Destrucción de la roca'); -- 23
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Bioturbaciones'); -- 24
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Troncos'); -- 25
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Mirador'); -- 26
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Los Muñecos'); -- 27
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Como El Muñeco'); -- 28
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Nefertiti'); -- 29
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Coral'); -- 30
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Troncos'); -- 31
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Bioturbaciones'); -- 32
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Modelo tridimensional'); -- 33
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Conglomerado'); -- 34
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Fragmentos redondeados'); -- 35
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Duna costera'); -- 36
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Flecha'); -- 37
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Polígono'); -- 38
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Límite fronterizo'); -- 39
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Puntos'); -- 40
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Sinclinal'); -- 41
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Brecha'); -- 42
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Estructuras volcánicas'); -- 43
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Roca'); -- 44
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Biotita'); -- 45
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Quebrada Duende'); -- 46
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Extremos de la cueva'); -- 47
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Fiammes'); -- 48
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Marmitas de erosión'); -- 49
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Columnas'); -- 50
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Hexágonos'); -- 51
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Irregulares'); -- 52
INSERT INTO `multimedia` (`id`, `media_type`, `media_url`, `name`) VALUES (NULL, 0, '', 'Lenticular'); -- 53

INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (1, 1);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (2, 2);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (2, 3);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (3, 4);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (4, 5);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (5, 6);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (6, 7);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (42, 8);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (7, 9);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (7, 10);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (8, 11);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (9, 12);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (8, 13);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (8, 14);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (10, 15);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (10, 16);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (10, 17);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (8, 17);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (11, 18);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (12, 19);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (13, 20);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (14, 21);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (15, 22);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (16, 23);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (17, 24);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (18, 25);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (19, 26);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (20, 27);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (20, 28);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (21, 29);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (22, 30);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (18, 31);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (17, 32);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (23, 53);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (24, 33);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (25, 34);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (26, 35);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (27, 36);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (28, 37);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (29, 38);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (30, 39);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (31, 40);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (32, 41);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (33, 42);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (34, 43);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (35, 44);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (36, 45);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (37, 46);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (38, 47);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (39, 48);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (40, 49);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (41, 50);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (42, 51);
INSERT INTO `term_multimedia` (`term_id`, `multimedia_id`) VALUES (42, 52);