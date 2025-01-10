-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: asistenciapersonal
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) DEFAULT NULL,
  `dni` char(8) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Rodrigo Barreto','12345678','password_1',0),(2,'Adrian Gonzales','76123409','password_2',1),(3,'Jonny Lawrence','11235813','password',1),(4,'Adrian Gonzales','76123409','password',1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id_area` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `habilitado` tinyint DEFAULT '1',
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Administración','Área encargada de la administración general del instituto',0),(2,'Docencia','Área encargada de la enseñanza y desarrollo académico',1),(3,'Biblioteca','Área de administración de recursos bibliográficos y materiales de estudio',1);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asistencias` (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `fk_personal` int NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `justificacion` text,
  `asistencia` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_asistencia`),
  KEY `fk_personal` (`fk_personal`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`fk_personal`) REFERENCES `personal` (`id_personal`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencias`
--

LOCK TABLES `asistencias` WRITE;
/*!40000 ALTER TABLE `asistencias` DISABLE KEYS */;
INSERT INTO `asistencias` VALUES (1,1,'2024-10-25','08:00:00','17:00:00','',1),(2,2,'2024-10-25','08:15:00','16:50:00','Retraso por tráfico',1),(3,3,'2024-10-25','08:00:00','17:10:00','Permiso para salida tardía',1),(4,4,'2024-12-10','00:00:00','00:00:00','',0),(7,5,'2024-12-12','00:00:00','00:00:00','',0),(8,2,'2025-01-04','18:05:38',NULL,'Llegada tarde justificada por trafico',1),(10,3,'2025-01-05','16:13:32','16:37:02',NULL,1),(11,4,'2025-01-05','17:40:42','17:43:21',NULL,1);
/*!40000 ALTER TABLE `asistencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal`
--

DROP TABLE IF EXISTS `personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal` (
  `id_personal` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(200) NOT NULL,
  `dni` char(8) NOT NULL,
  `telefono` char(9) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cargo` enum('Docente','Administrativo','Servicios Generales','Otros') NOT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `sueldo` decimal(5,2) DEFAULT NULL,
  `fk_area` int DEFAULT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `habilitado` tinyint DEFAULT '1',
  PRIMARY KEY (`id_personal`),
  UNIQUE KEY `dni` (`dni`),
  KEY `fk_area` (`fk_area`),
  CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`fk_area`) REFERENCES `areas` (`id_area`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal`
--

LOCK TABLES `personal` WRITE;
/*!40000 ALTER TABLE `personal` DISABLE KEYS */;
INSERT INTO `personal` VALUES (1,'Carlos Perez','12345678',NULL,NULL,'Administrativo',NULL,NULL,NULL,1,'cperez123',0),(2,'Ana Lopez','87654321',NULL,NULL,'Docente','Matemáticas',NULL,NULL,2,'alopez123',1),(3,'Juan Martinez','11223344',NULL,NULL,'Servicios Generales',NULL,NULL,NULL,3,'jmartinez123',1),(4,'María Gomez','22334455',NULL,NULL,'Docente','Historia',NULL,NULL,2,'mgomez123',1),(5,'Carlos Cuela','78346701',NULL,NULL,'Administrativo',NULL,NULL,NULL,1,'ccuela123',1);
/*!40000 ALTER TABLE `personal` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-09 23:46:54
