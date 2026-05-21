drop database if exists aeropuerto; 
CREATE DATABASE aeropuerto; 
USE aeropuerto; 

CREATE TABLE destinos(
	id_destino 	INT 			PRIMARY KEY,
    ciudad		VARCHAR(50)		NOT NULL,
    imagen		VARCHAR(255)	NOT NULL
);

CREATE TABLE vuelos(
	id_vuelo		INT 			AUTO_INCREMENT PRIMARY KEY,
    id_origen		INT				NOT NULL,
    fecha			DATE			NOT NULL, 
    hora_salida		TIME			NOT NULL,
    embarque		VARCHAR(50)		NOT NULL,
    precio			DECIMAL(10,2)	NOT NULL,
    cupo 			INT 			NOT NULL 	DEFAULT 48,
    id_destino 		INT 			NOT NULL,
    FOREIGN KEY (id_destino) REFERENCES destinos(id_destino),
    FOREIGN KEY (id_origen) REFERENCES destinos(id_destino)
); 

CREATE TABLE usuarios(
	id_usuario		INT 			AUTO_INCREMENT	PRIMARY KEY,
    nombre			VARCHAR(50)		NOT NULL,
    a_paterno		VARCHAR(50)		NOT NULL,
    a_materno		VARCHAR(50)		NOT NULL,
    fecha_nac		DATE			NOT NULL,
    correo			VARCHAR(40)		NOT NULL,
    password		VARCHAR(50)		NOT NULL
); 

CREATE TABLE boletos(
	id_boleto	VARCHAR(20)	  	PRIMARY KEY,
    asiento		VARCHAR(2)		NOT NULL,
    checked_in	BOOLEAN			NOT NULL DEFAULT FALSE,
    nombre		VARCHAR(50)		NOT NULL,
    a_paterno	VARCHAR(50) 	NOT NULL,
    a_materno	VARCHAR(50)		NOT NULL,
    id_usuario	INT				NOT NULL,
    id_vuelo	INT				NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_vuelo) REFERENCES vuelos(id_vuelo)
);

CREATE TABLE empleados(
	id_empleado		INT				AUTO_INCREMENT		PRIMARY KEY,
    nombre			VARCHAR(50)		NOT NULL,
    a_paterno		VARCHAR(50)		NOT NULL,
    a_materno		VARCHAR(50)		NOT NULL,
    sueldo			DECIMAL(10,2)	NOT NULL,
    hora_entrada	TIME			NOT NULL,
	hora_salida		TIME			NOT NULL,
    id_jefe			INT 			NULL,
    FOREIGN KEY 	(id_jefe)	REFERENCES empleados(id_empleado)
);

INSERT INTO destinos (id_destino, ciudad,imagen) VALUES
(1, 'Guadalajara','https://cdn.travelconline.com/images/fit-in/2000x0/filters:quality(75):strip_metadata():format(webp)/https%3A%2F%2Ftr2storage.blob.core.windows.net%2Fimagenes%2Fu5mDjrIbRxHc-NDHgnpxembjpeg.jpeg'),
(2, 'Monterrey', 'https://www.entornoturistico.com/wp-content/uploads/2021/09/Metropolitan-center-en-San-Pedro-Garza-Garci%CC%81a-Monterrey-1280x720.jpg'),
(3, 'Cancún','https://images.trvl-media.com/place/179995/1d2c3f9b-5a1a-4305-b0e2-9bef30204118.jpg'),
(4, 'Tijuana','https://www.mexicodesconocido.com.mx/wp-content/uploads/2020/10/Cosas-que-hacer-Tijuana-900x593.jpg'),
(5, 'Mérida','https://kunukhotel.com/wp-content/uploads/2025/03/Slide_y_Preview_Cosas_que_hacer_en_merida_7d0fbba96e.webp');

INSERT INTO vuelos (id_origen ,fecha, hora_salida, embarque, precio, cupo, id_destino) VALUES
(2,'2025-07-10', '06:30:00', 'Bloque A, Acceso 1', 1450.00, 43, 1),
(2,'2025-06-15', '06:30:00', 'Bloque A, Acceso 1', 1450.00, 48, 1),
(2,'2025-06-15', '07:30:00', 'Bloque B, Acceso 1', 1450.00, 48, 1),
(3,'2025-07-20', '06:30:00', 'Bloque A, Acceso 1', 1450.00, 48, 1),
(1,'2025-07-17', '08:15:00', 'Bloque B, Acceso 3', 1799.00, 43, 2),
(3,'2025-07-23', '09:15:00', 'Bloque C, Acceso 3', 1799.00, 48, 2),
(2,'2025-07-17', '11:00:00', 'Bloque C, Acceso 2', 2300.00, 45, 3),
(2,'2025-07-10', '12:30:00', 'Bloque C, Acceso 2', 3300.00, 47, 3),
(3,'2025-07-27', '15:45:00', 'Bloque A, Acceso 4', 2500.00, 48, 4),
(1,'2025-07-28', '16:45:00', 'Bloque A, Acceso 1', 2500.00, 47, 4),
(3,'2025-07-30', '15:45:00', 'Bloque A, Acceso 2', 2500.00, 48, 4),
(4,'2025-07-30', '19:30:00', 'Bloque D, Acceso 1', 1650.00, 47, 5);

INSERT INTO usuarios (nombre, a_paterno, a_materno, fecha_nac, correo, password) VALUES
('Diego Eduardo', 'Díaz', 'Zamudio','2003-03-24','diego@dominio.com','1234'),
('Juan', 'Pérez', 'Zavala','2000-12-24','juan@dominio.com','1234'),
('Ruth', 'López', 'Medina','1999-01-01','ruth@dominio.com','1234'),
('Nicole', 'Guzmán', 'Guzmán','2001-07-10','nicole@dominio.com','1234');

INSERT INTO boletos (id_boleto, nombre, a_paterno, a_materno, asiento, checked_in, id_vuelo,id_usuario) VALUES
	('75010007010141', 'Diego Eduardo', 'Díaz', 'Zamudio', 'E1', FALSE, 1, 1),
    ('75010007010203', 'Juan', 'Pérez', 'Pérez', 'A3', FALSE, 1, 1),
    ('75010007010316', 'Ruth', 'López', 'Medina', 'B6', TRUE, 1, 1),
    ('75010007010451', 'Nicole', 'Guzmán', 'Guzmán', 'F1', TRUE, 1, 2),
    ('75010007010504', 'Rosa', 'Fuentes', 'Flores', 'A4', TRUE, 1, 2),
    ('75010007050112', 'Juan', 'Pérez', 'Pérez', 'B2', FALSE, 5, 2),
    ('75010007050217', 'Juana', 'Pérez', 'Pérez', 'B7', FALSE, 5, 2),
    ('75010007050301', 'Ruth', 'Pérez', 'García', 'A1', FALSE, 5, 3),
    ('75010007050453', 'José', 'Pérez', 'García', 'F3', FALSE, 5, 3),
    ('75010007050505', 'Miguel', 'Perez', 'Medina', 'A5', FALSE, 5, 3),
    ('75010007070156', 'Ruth', 'López', 'Medina', 'F6', FALSE, 7, 3),
    ('75010007070244', 'Nicole', 'Guzmán', 'Guzman', 'E4', FALSE, 7, 4),
    ('75010007070301', 'Rosa', 'Fuentes', 'Flores', 'A1', FALSE, 7, 4),
    ('75010007080147', 'Pedro', 'Cornejo', 'Ceja', 'E7', FALSE, 8, 4),
    ('75010007100114', 'Rosa', 'Zamudio', 'Pérez', 'B4', FALSE, 10, 4),
    ('75010007120131', 'Juan', 'Pérez', 'García', 'D1', FALSE, 12, 4); 
    
INSERT INTO empleados(nombre, a_paterno, a_materno, sueldo, hora_entrada, hora_salida, id_jefe)
VALUES
('Carlos', 'Ramirez', 'Lopez', 25000.00, '08:00:00', '17:00:00', NULL),
('Ana', 'Martinez', 'Sanchez', 18000.00, '08:30:00', '17:30:00', 1),
('Luis', 'Hernandez', 'Garcia', 17500.00, '09:00:00', '18:00:00', 1),
('Sofia', 'Torres', 'Mendoza', 19000.00, '08:00:00', '17:00:00', 1),
('Diego', 'Castro', 'Vega', 16000.00, '09:00:00', '18:00:00', 1);

-- Creación de trigger para automatizar la actualizacion del cupo en vuelos
delimiter $
create trigger trigger_cupo after insert on boletos
for each row
	begin
		update vuelos set cupo=cupo-1 where id_vuelo=new.id_vuelo; 
    end $
delimiter ;

-- PROCEDIMIENTOS ALMACENADOS
drop procedure if exists sp_getVuelos; 
drop procedure if exists sp_getVuelosBaratos;
delimiter $
	create procedure sp_getVuelos()
		begin
			select id_vuelo, o.ciudad as origen, d.ciudad as destino, v.fecha, v.precio
			from vuelos v join destinos o on o.id_destino=v.id_origen
			join destinos d on d.id_destino=v.id_destino
			order by origen asc,v.fecha asc;
	end $
delimiter ;

delimiter $ 
    create procedure sp_getVuelosBaratos()
		begin
			select id_vuelo, o.ciudad as origen,
					d.ciudad as destino, v.fecha, v.precio,v.hora_salida,
                    d.imagen
			from vuelos v join destinos o on o.id_destino=v.id_origen
			join destinos d on d.id_destino=v.id_destino
            where v.cupo>=0
			order by precio asc limit 5;
		end $
delimiter ;
call sp_getVuelos();
call sp_getVuelosBaratos(); 
