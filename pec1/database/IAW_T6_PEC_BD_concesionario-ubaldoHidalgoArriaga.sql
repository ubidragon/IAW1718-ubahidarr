﻿CREATE DATABASE concesionario CHARSET utf8 COLLATE utf8_spanish_ci;

USE Concesionario;

CREATE TABLE MarcaModelo(
	Marca Varchar(25),
	Modelo Varchar(25),
	CONSTRAINT PK_MarcaModelo PRIMARY KEY (Marca, Modelo)
);

INSERT 
INTO MarcaModelo
VALUES 	('PEUGEOT','208'),
		('PEUGEOT','2008'),
		('PEUGEOT','308'),
		('PEUGEOT','3008'),
		('PEUGEOT','508'),
		('SEAT','IBIZA'),
		('SEAT','LEÓN'),
		('SEAT','TOLEDO'),
		('SEAT','EXEO'),
		('FORD','FIESTA'),
		('FORD','CMAX'),
		('FORD','FOCUS'),
		('FORD','MONDEO'),
		('AUDI','A1'),
		('AUDI','A3'),
		('AUDI','A4'),
		('AUDI','A5'),
		('AUDI','A6'),
		('OPEL','CORSA'),
		('OPEL','ASTRA'),
		('OPEL','INSIGNIA'),
		('RENAULT','TWINGO'),
		('RENAULT','LAGUNA'),
		('RENAULT','CLIO'),
		('RENAULT','MEGANE');

CREATE TABLE Vehiculos(
	ID				int (7) auto_increment,
	Marca 			Varchar(25) NOT NULL,
	Modelo 			Varchar(25) NOT NULL,
	Fecha_Compra	Date NOT NULL,
	Precio			Numeric(7,2) NOT NULL,
	Imagen			Varchar(25) DEFAULT NULL,
	CONSTRAINT PK_Vehiculos PRIMARY KEY (ID),
	CONSTRAINT FK_Vehic_Marca FOREIGN KEY (Marca, Modelo)
		REFERENCES MarcaModelo (Marca, Modelo)
);

INSERT INTO Vehiculos(Marca, Modelo, Fecha_Compra, Precio)
VALUES 	('PEUGEOT','208','2016/01/01',12000),
		('PEUGEOT','208','2010/01/01',2000),
		('PEUGEOT','208','2010/07/01',5000),
		('PEUGEOT','208','2013/01/01',4000),
		('PEUGEOT','208','2009/01/01',1000),
		('PEUGEOT','2008','2016/01/01',12000),
		('PEUGEOT','2008','2010/03/31',2500),
		('PEUGEOT','2008','2010/07/01',5700),
		('PEUGEOT','2008','2013/01/01',4000),
		('PEUGEOT','2008','2009/01/01',1000),
		('PEUGEOT','308','2016/01/01',12000),
		('PEUGEOT','308','2010/01/01',2000),
		('PEUGEOT','308','2010/07/01',5000),
		('PEUGEOT','308','2015/01/01',7000),
		('PEUGEOT','308','2009/01/01',1000),
		('PEUGEOT','3008','2016/01/01',12000),
		('PEUGEOT','3008','2010/03/31',2500),
		('PEUGEOT','3008','2010/07/01',5700),
		('PEUGEOT','3008','2013/01/01',4000),
		('PEUGEOT','3008','2009/01/01',1000),
		('PEUGEOT','508','2016/01/01',12000),
		('PEUGEOT','508','2010/01/01',2000),
		('PEUGEOT','508','2010/07/01',5000),
		('PEUGEOT','508','2013/01/01',4000),
		('PEUGEOT','508','2009/01/01',1000),
		('PEUGEOT','2008','2016/01/01',11000),
		('PEUGEOT','2008','2010/03/31',3500),
		('PEUGEOT','2008','2010/07/01',7700),
		('PEUGEOT','2008','2013/01/01',8000),
		('PEUGEOT','2008','2009/01/01',11000),
		('PEUGEOT','308','2016/01/01',2000),
		('PEUGEOT','308','2010/01/01',4000),
		('PEUGEOT','308','2010/07/01',7300),
		('PEUGEOT','308','2015/01/01',7900),
		('PEUGEOT','308','2009/01/01',2000),
		('PEUGEOT','3008','2016/01/01',10000),
		('PEUGEOT','3008','2012/03/31',10500),
		('PEUGEOT','3008','2010/05/31',6700),
		('PEUGEOT','3008','2006/01/19',4700),
		('PEUGEOT','3008','2009/01/01',3000),
		('SEAT','IBIZA','2016/01/01',12000),
		('SEAT','IBIZA','2010/01/01',2000),
		('SEAT','IBIZA','2010/07/01',5000),
		('SEAT','IBIZA','2013/01/01',4000),
		('SEAT','LEÓN','2016/01/01',12000),
		('SEAT','LEÓN','2010/01/01',2000),
		('SEAT','LEÓN','2010/07/01',5000),
		('SEAT','LEÓN','2013/01/01',4000),
		('SEAT','TOLEDO','2016/01/01',12000),
		('SEAT','TOLEDO','2010/01/01',2000),
		('SEAT','TOLEDO','2010/07/01',5000),
		('SEAT','TOLEDO','2013/01/01',4000),
		('SEAT','EXEO','2016/01/01',12020),
		('SEAT','EXEO','2010/01/01',2900),
		('SEAT','EXEO','2010/07/01',5000),
		('SEAT','EXEO','2013/01/01',4000),
		('FORD','FIESTA','2016/01/01',12090),
		('FORD','FIESTA','2010/01/01',2000),
		('FORD','FIESTA','2010/07/01',5900),
		('FORD','FIESTA','2013/01/01',4000),
		('FORD','CMAX','2016/01/01',12000),
		('FORD','CMAX','2010/01/01',2900),
		('FORD','CMAX','2010/07/01',5020),
		('FORD','CMAX','2013/01/01',4000),
		('FORD','FOCUS','2016/01/01',12002),
		('FORD','FOCUS','2010/01/01',2900),
		('FORD','FOCUS','2010/07/01',5000),
		('FORD','FOCUS','2013/01/01',4002),
		('FORD','MONDEO','2016/01/01',12000),
		('FORD','MONDEO','2010/01/01',2020),
		('FORD','MONDEO','2010/07/01',5000),
		('FORD','MONDEO','2013/01/01',4090),
		('AUDI','A1','2016/01/01',12090),
		('AUDI','A1','2010/01/01',2000),
		('AUDI','A1','2010/07/01',5090),
		('AUDI','A1','2013/01/01',4000),
		('AUDI','A3','2016/01/01',12000),
		('AUDI','A3','2010/01/01',2000),
		('AUDI','A3','2010/07/01',5000),
		('AUDI','A3','2013/01/01',4050),
		('AUDI','A4','2016/01/01',11060),
		('AUDI','A4','2010/03/31',3500),
		('AUDI','A4','2010/07/01',7700),
		('AUDI','A4','2013/01/01',8000),	
		('AUDI','A5','2016/01/01',12000),
		('AUDI','A5','2010/01/01',2060),
		('AUDI','A5','2010/07/01',5000),
		('AUDI','A5','2013/01/01',4050),
		('AUDI','A6','2016/01/01',11000),
		('AUDI','A6','2010/03/31',3506),
		('AUDI','A6','2010/07/01',7700),
		('AUDI','A6','2013/01/01',8000),
		('OPEL','CORSA','2016/01/01',12000),
		('OPEL','CORSA','2010/01/01',2060),
		('OPEL','CORSA','2010/07/01',5000),
		('OPEL','CORSA','2013/01/01',4050),
		('OPEL','ASTRA','2016/01/01',11060),
		('OPEL','ASTRA','2010/03/31',3500),
		('OPEL','ASTRA','2010/07/01',7706),
		('OPEL','ASTRA','2013/01/01',8000),
		('OPEL','INSIGNIA','2016/01/01',12000),
		('OPEL','INSIGNIA','2010/01/01',2060),
		('OPEL','INSIGNIA','2010/07/01',5000),
		('OPEL','INSIGNIA','2013/01/01',4050),
		('RENAULT','TWINGO','2016/01/01',11060),
		('RENAULT','TWINGO','2010/03/31',3500),
		('RENAULT','TWINGO','2010/07/01',7706),
		('RENAULT','TWINGO','2013/01/01',8000),
		('RENAULT','LAGUNA','2016/01/01',12000),
		('RENAULT','LAGUNA','2010/01/01',2060),
		('RENAULT','LAGUNA','2010/07/01',5000),
		('RENAULT','LAGUNA','2013/01/01',4050),
		('RENAULT','CLIO','2016/01/01',11060),
		('RENAULT','CLIO','2010/03/31',3500),
		('RENAULT','CLIO','2010/07/01',7706),
		('RENAULT','CLIO','2013/01/01',8000),
		('RENAULT','MEGANE','2016/01/01',12000),
		('RENAULT','MEGANE','2010/01/01',2060),
		('RENAULT','MEGANE','2010/07/01',5000),
		('RENAULT','MEGANE','2013/01/01',4050);
		
		update vehiculos
		set imagen=concat(modelo,'_',id,'.jpg');
		