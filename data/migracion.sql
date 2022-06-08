CREATE DATABASE tutorial_crud;

use tutorial_crud;

CREATE TABLE alumnos (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  apellido VARCHAR(30) NOT NULL,
  email VARCHAR(50) NOT NULL,
  edad INT(3),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `git` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `procs` varchar(50) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
