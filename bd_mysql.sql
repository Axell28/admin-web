SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner`  (
  `idban` int(11) NOT NULL,
  `tipo` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cuerpo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`idban`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'TRIAL' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES (1, 'slider', '[]');

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria`  (
  `idcat` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'TRIAL',
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'TRIAL',
  `filtro` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'TRIAL',
  `catpad` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  PRIMARY KEY (`idcat`) USING BTREE,
  UNIQUE INDEX `categoria_nombre_key`(`nombre`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'TRIAL' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES ('1', 'Noticias', 'noticias', NULL);

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `idemp` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TRIAL',
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'TRIAL',
  `telefono` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `celular` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `direction` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `metades` varchar(400) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `facebook` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `instagram` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `whatsapp` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `youtube` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `twitter` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `intranet` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `liblink` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `libmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `libnumb` int(11) NULL DEFAULT NULL COMMENT 'TRIAL',
  `libanio` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  PRIMARY KEY (`idemp`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'TRIAL' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES (1, 'EMPRESA WEB PRUEBA', '923817327', '923817327', 'Av. Bolívar 635, Pueblo Libre.', 'ymca.cav@ymcaperu.edu.pe', 'A la Institución Educativa Abraham Valdelomar. Educamos a niños, niñas y adolescentes, desde un enfoque integral; para que sean capaces de responder a los desafíos del mundo actual', 'https://www.facebook.com/axel.valle.16', 'https://www.instagram.com/prueba', 'https://api.whatsapp.com/send?phone=51948147012', 'https://www.youtube.com/watch?v=AU2R__YrSw0', '', 'https://abrahamvaldelomar.cubicol.pe/principal/login', 'https://ymcaperu.org/libro-de-reclamaciones/', '', NULL, NULL);

-- ----------------------------
-- Table structure for galeria
-- ----------------------------
DROP TABLE IF EXISTS `galeria`;
CREATE TABLE `galeria`  (
  `idgal` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TRIAL',
  `titulo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'TRIAL',
  `detalle` varchar(270) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `ncolum` int(11) NULL DEFAULT NULL COMMENT 'TRIAL',
  `cuerpo` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'TRIAL',
  `fecpub` date NULL DEFAULT NULL COMMENT 'TRIAL',
  `estado` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N' COMMENT 'TRIAL',
  `modo` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'A' COMMENT 'TRIAL',
  `portada` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  PRIMARY KEY (`idgal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'TRIAL' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for modal
-- ----------------------------
DROP TABLE IF EXISTS `modal`;
CREATE TABLE `modal`  (
  `idmod` int(11) NOT NULL COMMENT 'TRIAL',
  `titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `cuerpo` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'TRIAL',
  `visible` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N' COMMENT 'TRIAL',
  PRIMARY KEY (`idmod`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'TRIAL' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modal
-- ----------------------------
INSERT INTO `modal` VALUES (1, 'Titulo de ventana', '', 'N');

-- ----------------------------
-- Table structure for noticias
-- ----------------------------
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias`  (
  `idnot` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TRIAL',
  `idcat` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'TRIAL',
  `titulo` varchar(280) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'TRIAL',
  `tagname` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'TRIAL',
  `portada` varchar(340) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `detalle` varchar(270) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'TRIAL',
  `cuerpo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT 'TRIAL',
  `fecpub` date NOT NULL COMMENT 'TRIAL',
  `visible` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N' COMMENT 'TRIAL',
  PRIMARY KEY (`idnot`) USING BTREE,
  UNIQUE INDEX `noticias_titulo_key`(`titulo`(255)) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 101 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'TRIAL' ROW_FORMAT = Dynamic;


-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `iduser` int(11) NOT NULL AUTO_INCREMENT COMMENT 'TRIAL',
  `nomb` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'TRIAL',
  `pass` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'TRIAL',
  PRIMARY KEY (`iduser`) USING BTREE,
  UNIQUE INDEX `usuario_nomb_key`(`nomb`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'TRIAL' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'webAdmin', '$2y$10$wcyBa0NcLSQKlwP0JSeTPeIvW1yxQcSlh4VREUXfA6INFgomD0Xx6');

ALTER TABLE noticias AUTO_INCREMENT = 101;

ALTER TABLE galeria AUTO_INCREMENT = 1001;

SET FOREIGN_KEY_CHECKS = 1;
