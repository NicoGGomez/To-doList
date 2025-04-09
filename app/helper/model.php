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
                        `tarea_completa` tinyint(1) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                        -- --------------------------------------------------------

                        --
                        -- Estructura de tabla para la tabla `user`
                        --

                        CREATE TABLE `user` (
                        `id_user` int(11) NOT NULL,
                        `nombre_user` varchar(20) NOT NULL,
                        `contrasenia_user` varchar(50) NOT NULL,
                        `mail_user` varchar(50) NOT NULL,
                        `rol_user` varchar(20) NOT NULL,
                        `id_tarea_fk` int(11) DEFAULT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                        --
                        -- Volcado de datos para la tabla `user`
                        --

                        INSERT INTO `user` (`id_user`, `nombre_user`, `contrasenia_user`, `mail_user`, `rol_user`, `id_tarea_fk`) VALUES
                        (2, 'admin', 'admin1234', 'anelecarg@icloud.com', 'admin', NULL);

                        --
                        -- Índices para tablas volcadas
                        --

                        --
                        -- Indices de la tabla `tarea`
                        --
                        ALTER TABLE `tarea`
                        ADD PRIMARY KEY (`id_tarea`);

                        --
                        -- Indices de la tabla `user`
                        --
                        ALTER TABLE `user`
                        ADD PRIMARY KEY (`id_user`),
                        ADD KEY `id_tarea_fk` (`id_tarea_fk`);

                        --
                        -- AUTO_INCREMENT de las tablas volcadas
                        --

                        --
                        -- AUTO_INCREMENT de la tabla `tarea`
                        --
                        ALTER TABLE `tarea`
                        MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT;

                        --
                        -- AUTO_INCREMENT de la tabla `user`
                        --
                        ALTER TABLE `user`
                        MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

                        --
                        -- Restricciones para tablas volcadas
                        --

                        --
                        -- Filtros para la tabla `user`
                        --
                        ALTER TABLE `user`
                        ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_tarea_fk`) REFERENCES `tarea` (`id_tarea`) ON DELETE CASCADE ON UPDATE CASCADE;
                        COMMIT;

                        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




                END;
                $this->db->query($sql);
              }
              
          }
      }