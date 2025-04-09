<?php

require_once 'config.php';

abstract class Model {
        protected $db;

        function __construct() {
            $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
                
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->deploy();
        }

        private function deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            if(count($tables) == 0) {
                $sql =<<<END
                        SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                        START TRANSACTION;
                        SET time_zone = "+00:00";


                        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                        /*!40101 SET NAMES utf8mb4 */;

                        --
                        -- Base de datos: `to-dolist`
                        --

                        -- --------------------------------------------------------

                        --
                        -- Estructura de tabla para la tabla `tarea`
                        --

                        CREATE TABLE `tarea` (
                        `id_tarea` int(11) NOT NULL,
                        `nombre_tarea` varchar(50) NOT NULL,
                        `contenido_tarea` varchar(500) NOT NULL,
                        `tarea_completa` tinyint(1) NOT NULL,
                        `id_user_fk` int(11) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                        --
                        -- Volcado de datos para la tabla `tarea`
                        --

                        INSERT INTO `tarea` (`id_tarea`, `nombre_tarea`, `contenido_tarea`, `tarea_completa`, `id_user_fk`) VALUES
                        (1, 'comprar', 'comprar pan', 0, 0),
                        (2, 'comprar', 'comprar pan', 0, 0);

                        -- --------------------------------------------------------

                        --
                        -- Estructura de tabla para la tabla `user`
                        --

                        CREATE TABLE `user` (
                        `id_user` int(11) NOT NULL,
                        `nombre_user` varchar(20) NOT NULL,
                        `contrasenia_user` varchar(50) NOT NULL,
                        `mail_user` varchar(50) NOT NULL,
                        `rol_user` varchar(20) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                        --
                        -- Volcado de datos para la tabla `user`
                        --

                        INSERT INTO `user` (`id_user`, `nombre_user`, `contrasenia_user`, `mail_user`, `rol_user`) VALUES
                        (0, 'admin', 'admin1234', 'anelecarg@icloud.com', 'admin'),
                        (1, 'nico', '1234', 'anelecarg@gmail.com', '');

                        --
                        -- Índices para tablas volcadas
                        --

                        --
                        -- Indices de la tabla `tarea`
                        --
                        ALTER TABLE `tarea`
                        ADD PRIMARY KEY (`id_tarea`),
                        ADD KEY `id_user_fk` (`id_user_fk`);

                        --
                        -- Indices de la tabla `user`
                        --
                        ALTER TABLE `user`
                        ADD PRIMARY KEY (`id_user`),
                        ADD KEY `id_user` (`id_user`);

                        --
                        -- AUTO_INCREMENT de las tablas volcadas
                        --

                        --
                        -- AUTO_INCREMENT de la tabla `tarea`
                        --
                        ALTER TABLE `tarea`
                        MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

                        --
                        -- AUTO_INCREMENT de la tabla `user`
                        --
                        ALTER TABLE `user`
                        MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

                        --
                        -- Restricciones para tablas volcadas
                        --

                        --
                        -- Filtros para la tabla `tarea`
                        --
                        ALTER TABLE `tarea`
                        ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`id_user_fk`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
                        COMMIT;

                        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





                END;
                $this->db->query($sql);
              }
              
          }
      }