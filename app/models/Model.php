<?php
require_once './app/config.php';

class Model {
    
    protected $db;

    // Asignar su correspondiente PDO a cada model hijo
    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
        $this->deploy();
    }

    // Pregunta si la base de datos "streaming_peliculas" tiene tablas, de no tenerlas las crea
    // e inserta el contenido
    function deploy() {
        // Chequear si hay tablas
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
        if (count($tables) == 0) {
            // Si no hay, crearlas

            $sql = <<<SQL
CREATE TABLE `clubes` (
    `id_club` int(11) NOT NULL,
    `nombre` varchar(64) NOT NULL,
    `pais` varchar(64) NOT NULL,
    `fecha_fundacion` date NOT NULL,
    `titulos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `clubes`
INSERT INTO `clubes` (`id_club`, `nombre`, `pais`, `fecha_fundacion`, `titulos`) VALUES
(1, 'River', 'Argentina', '1901-05-25', 72),
(12, 'Boca Juniors', 'Argentina', '1905-05-05', 74),
(13, 'Estudiantes', 'Argentina', '2024-09-01', 40),
(18, 'Velez', 'Argentina', '2024-10-11', 48);

-- Estructura de tabla para la tabla `jugadores`
CREATE TABLE `jugadores` (
    `id_jugador` int(11) NOT NULL,
    `nombre` varchar(64) NOT NULL,
    `nacionalidad` varchar(64) NOT NULL,
    `posicion` varchar(64) NOT NULL,
    `edad` int(11) NOT NULL,
    `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `jugadores`
INSERT INTO `jugadores` (`id_jugador`, `nombre`, `nacionalidad`, `posicion`, `edad`, `id_club`) VALUES
(1, 'Facundo Colidio', 'Argentina', 'Delantero', 24, 1),
(10, 'Franco Mastantuono', 'Argentina', 'Mediocampista', 17, 1),
(11, 'Edinson Cavani', 'Uruguay', 'Delantero', 37, 12),
(14, 'Claudio Echeverri', 'Argentina', 'Delantero', 18, 1);

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE `usuarios` (
    `id_usuario` int(11) NOT NULL,
    `usuario` varchar(250) NOT NULL,
    `contrasenia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `usuarios`
INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasenia`) VALUES
(4, 'roman', '$2y$10$I5A5ZiAMk/0GrqDnPImD0ehytvO36SvolMssyRe1ztTO/h59ayofy'),
(6, 'webadmin', '$2y$10$/iMmkZQYxZAdPJcYDBWb1.hjH7sC2ggdCvfboptQ2Gus51U25MKni');

-- Índices para tablas volcadas
ALTER TABLE `clubes` ADD PRIMARY KEY (`id_club`);
ALTER TABLE `jugadores` ADD PRIMARY KEY (`id_jugador`), ADD KEY `id_club` (`id_club`);
ALTER TABLE `usuarios` ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `usuario` (`usuario`);

-- AUTO_INCREMENT de las tablas volcadas
ALTER TABLE `clubes` MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
ALTER TABLE `jugadores` MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
ALTER TABLE `usuarios` MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- Restricciones para tablas volcadas
ALTER TABLE `jugadores` ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`id_club`) REFERENCES `clubes` (`id_club`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
SQL;

            $this->db->exec($sql);
        }
    }
}
?>
