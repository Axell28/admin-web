
-- ----------------------------
-- Sequence structure for empresa_idemp_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."empresa_idemp_seq";
CREATE SEQUENCE "public"."empresa_idemp_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for galeria_idgal_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."galeria_idgal_seq";
CREATE SEQUENCE "public"."galeria_idgal_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for noticias_idnot_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."noticias_idnot_seq";
CREATE SEQUENCE "public"."noticias_idnot_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for usuario_iduser_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."usuario_iduser_seq";
CREATE SEQUENCE "public"."usuario_iduser_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS "public"."banner";
CREATE TABLE "public"."banner" (
  "idban" int4 NOT NULL,
  "tipo" varchar(10) COLLATE "pg_catalog"."default" NOT NULL,
  "cuerpo" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO "public"."banner" VALUES (1, 'slider', '[]');

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS "public"."categoria";
CREATE TABLE "public"."categoria" (
  "idcat" char(1) COLLATE "pg_catalog"."default" NOT NULL,
  "nombre" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "filtro" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "catpad" char(1) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO "public"."categoria" VALUES ('1', 'Noticias', 'noticias', NULL);

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS "public"."empresa";
CREATE TABLE "public"."empresa" (
  "idemp" int4 NOT NULL DEFAULT nextval('empresa_idemp_seq'::regclass),
  "nombre" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "telefono" varchar(60) COLLATE "pg_catalog"."default",
  "celular" varchar(60) COLLATE "pg_catalog"."default",
  "direction" varchar(250) COLLATE "pg_catalog"."default",
  "correo" varchar(100) COLLATE "pg_catalog"."default",
  "metades" varchar(400) COLLATE "pg_catalog"."default",
  "facebook" varchar(250) COLLATE "pg_catalog"."default",
  "instagram" varchar(250) COLLATE "pg_catalog"."default",
  "whatsapp" varchar(250) COLLATE "pg_catalog"."default",
  "youtube" varchar(250) COLLATE "pg_catalog"."default",
  "twitter" varchar(250) COLLATE "pg_catalog"."default",
  "intranet" varchar(250) COLLATE "pg_catalog"."default",
  "liblink" varchar(250) COLLATE "pg_catalog"."default",
  "libmail" varchar(100) COLLATE "pg_catalog"."default",
  "libnumb" int4,
  "libanio" varchar(5) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO "public"."empresa" VALUES (1, 'COLEGIO SMA SCHOOL PERÚ', '', '948147012 - Jacqueline Farfán', 'Av. Bolívar 635, Pueblo Libre.', 'ymca.cav@ymcaperu.edu.pe', 'A la Institución Educativa Abraham Valdelomar. Educamos a niños, niñas y adolescentes, desde un enfoque integral; para que sean capaces de responder a los desafíos del mundo actual', '', '', 'https://api.whatsapp.com/send?phone=51948147012', '', '', 'https://abrahamvaldelomar.cubicol.pe/principal/login', 'https://ymcaperu.org/libro-de-reclamaciones/', '', NULL, NULL);

-- ----------------------------
-- Table structure for galeria
-- ----------------------------
DROP TABLE IF EXISTS "public"."galeria";
CREATE TABLE "public"."galeria" (
  "idgal" int4 NOT NULL DEFAULT nextval('galeria_idgal_seq'::regclass),
  "titulo" varchar(150) COLLATE "pg_catalog"."default" NOT NULL,
  "detalle" varchar(270) COLLATE "pg_catalog"."default",
  "portada" varchar(300) COLLATE "pg_catalog"."default",
  "ncolum" int4,
  "cuerpo" text COLLATE "pg_catalog"."default",
  "fecpub" date DEFAULT CURRENT_TIMESTAMP,
  "estado" char(1) COLLATE "pg_catalog"."default" DEFAULT 'N'::bpchar,
  "modo" char(1) COLLATE "pg_catalog"."default" DEFAULT 'A'::bpchar
)
;

-- ----------------------------
-- Table structure for noticias
-- ----------------------------
DROP TABLE IF EXISTS "public"."noticias";
CREATE TABLE "public"."noticias" (
  "idnot" int4 NOT NULL DEFAULT nextval('noticias_idnot_seq'::regclass),
  "idcat" char(1) COLLATE "pg_catalog"."default" NOT NULL,
  "titulo" varchar(280) COLLATE "pg_catalog"."default" NOT NULL,
  "tagname" varchar(300) COLLATE "pg_catalog"."default" NOT NULL,
  "portada" varchar(340) COLLATE "pg_catalog"."default",
  "detalle" varchar(270) COLLATE "pg_catalog"."default",
  "cuerpo" text COLLATE "pg_catalog"."default",
  "fecpub" date NOT NULL,
  "visible" char(1) COLLATE "pg_catalog"."default" DEFAULT 'N'::bpchar
)
;

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS "public"."usuario";
CREATE TABLE "public"."usuario" (
  "iduser" int4 NOT NULL DEFAULT nextval('usuario_iduser_seq'::regclass),
  "nomb" varchar(30) COLLATE "pg_catalog"."default" NOT NULL,
  "pass" varchar(250) COLLATE "pg_catalog"."default" NOT NULL
)
;


-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO "public"."usuario" VALUES (1, 'webAdmin', '$2y$10$wcyBa0NcLSQKlwP0JSeTPeIvW1yxQcSlh4VREUXfA6INFgomD0Xx6');


-- ----------------------------
-- Table structure for modal
-- ----------------------------
DROP TABLE IF EXISTS "public"."modal";
CREATE TABLE "public"."modal" (
  "idmod" int4 NOT NULL,
  "titulo" varchar(100) COLLATE "pg_catalog"."default",
  "cuerpo" text COLLATE "pg_catalog"."default",
  "visible" char(1) COLLATE "pg_catalog"."default"
);

-- ----------------------------
-- Primary Key structure for table modal
-- ----------------------------
ALTER TABLE "public"."modal" ADD CONSTRAINT "modal_pkey" PRIMARY KEY ("idmod");


-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."empresa_idemp_seq"
OWNED BY "public"."empresa"."idemp";
SELECT setval('"public"."empresa_idemp_seq"', 2, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."galeria_idgal_seq"
OWNED BY "public"."galeria"."idgal";
SELECT setval('"public"."galeria_idgal_seq"', 8, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."noticias_idnot_seq"
OWNED BY "public"."noticias"."idnot";
SELECT setval('"public"."noticias_idnot_seq"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."usuario_iduser_seq"
OWNED BY "public"."usuario"."iduser";
SELECT setval('"public"."usuario_iduser_seq"', 2, true);

-- ----------------------------
-- Primary Key structure for table banner
-- ----------------------------
ALTER TABLE "public"."banner" ADD CONSTRAINT "banner_pkey" PRIMARY KEY ("idban");

-- ----------------------------
-- Uniques structure for table categoria
-- ----------------------------
ALTER TABLE "public"."categoria" ADD CONSTRAINT "categoria_nombre_key" UNIQUE ("nombre");

-- ----------------------------
-- Primary Key structure for table categoria
-- ----------------------------
ALTER TABLE "public"."categoria" ADD CONSTRAINT "categoria_pkey" PRIMARY KEY ("idcat");

-- ----------------------------
-- Primary Key structure for table galeria
-- ----------------------------
ALTER TABLE "public"."galeria" ADD CONSTRAINT "galeria_pkey" PRIMARY KEY ("idgal");

-- ----------------------------
-- Uniques structure for table noticias
-- ----------------------------
ALTER TABLE "public"."noticias" ADD CONSTRAINT "noticias_titulo_key" UNIQUE ("titulo");

-- ----------------------------
-- Primary Key structure for table noticias
-- ----------------------------
ALTER TABLE "public"."noticias" ADD CONSTRAINT "noticias_pkey" PRIMARY KEY ("idnot");

-- ----------------------------
-- Uniques structure for table usuario
-- ----------------------------
ALTER TABLE "public"."usuario" ADD CONSTRAINT "usuario_nomb_key" UNIQUE ("nomb");

-- ----------------------------
-- Primary Key structure for table usuario
-- ----------------------------
ALTER TABLE "public"."usuario" ADD CONSTRAINT "usuario_pkey" PRIMARY KEY ("iduser");
