CREATE DATABASE bd_sys_library 
use bd_sys_library
SELECT*FROM Usuarios
CREATE TABLE Autores(
Id INT PRIMARY KEY IDENTITY(1,1),
Nombre NVARCHAR(100),
Nacionalidad NVARCHAR(100)NULL,
FechaNacimiento DATE NULL,
Estado VARCHAR(15) NULL,
FechaRegistro DATETIME NULL
);

CREATE TABLE Ubicaciones (
Id INT PRIMARY KEY IDENTITY(1,1),
NombreUbicacion  NVARCHAR(255),
NumeroStank INT,
Referencia NVARCHAR(255),  
Estado VARCHAR(15) NULL, 
); 

CREATE TABLE Categorias (
Id INT PRIMARY KEY  IDENTITY(1,1),
Nombres NVARCHAR(100),
Descripcion NVARCHAR(255), 
Estado VARCHAR(15) NULL,
);

CREATE TABLE Libros (
Id INT  PRIMARY KEY IDENTITY(1,1),
Codigo NVARCHAR(255),
Titulo NVARCHAR(255),
Id_autor INT,
Id_ubicacion INT, 
Id_categoria INT,
Cantidad_Libros INT,
AnioPublicacion INT,
FechaRegistro DATETIME NULL,
Estado VARCHAR(15) NULL,
CONSTRAINT FK_LibroAutor FOREIGN KEY (Id_autor) REFERENCES Autores(Id) ON DELETE CASCADE,
CONSTRAINT FK_LibroUbicacion FOREIGN KEY (Id_ubicacion) REFERENCES Ubicaciones(Id) ON DELETE CASCADE,
CONSTRAINT FK_LibrCategoria FOREIGN KEY (Id_categoria) REFERENCES Categorias(Id) ON DELETE CASCADE
);
  
CREATE TABLE Grados (
Id INT PRIMARY KEY  IDENTITY(1,1),
Nombres NVARCHAR(100),
Descripcion NVARCHAR(100),
NivelEducacional NVARCHAR(50), 
Estado VARCHAR(15) NULL,
);

CREATE TABLE Secciones (
Id INT PRIMARY KEY  IDENTITY(1,1),
Nombres NVARCHAR(100),
Descripcion NVARCHAR(100),
Estado VARCHAR(15) NULL,
);

CREATE TABLE Estudiantes (
Id INT PRIMARY KEY  IDENTITY(1,1),
Codigo NVARCHAR(100),  
Nombres NVARCHAR(100),
Apellidos NVARCHAR(100),
Id_grado INT,
Id_seccion INT,
Direccion NVARCHAR(255), 
Telefono NVARCHAR(20),
Email NVARCHAR(100),
Genero NVARCHAR(10),
FechaNacimiento DATE NULL, 
Estado VARCHAR(15) NULL,
FechaRegistro DATETIME NULL, 
CONSTRAINT FK_EsttudianteGrado FOREIGN KEY (Id_grado) REFERENCES Grados(Id)ON DELETE CASCADE, 
CONSTRAINT FK_EsttudianteSeccionGrado FOREIGN KEY (Id_seccion) REFERENCES Secciones(Id)ON DELETE CASCADE, 
);



CREATE TABLE Roles (
Id INT PRIMARY KEY IDENTITY(1,1),
NombreRol NVARCHAR(50),
Descripcion NVARCHAR(50),
Estado VARCHAR(15) NULL, 
 );

CREATE TABLE Usuarios (
Id INT PRIMARY KEY IDENTITY(1,1),
NombresUsuario NVARCHAR(50),
NumeroDocumento NVARCHAR(20),
Telefono NVARCHAR(20),  
CorreoElectronico NVARCHAR(100),
Contrasena NVARCHAR(255),
Id_rol INT,
Direccion NVARCHAR(255), 
Genero NVARCHAR(10),
Estado VARCHAR(15) NULL,  
FechaRegistro DATETIME,
CONSTRAINT FK_UserRol FOREIGN KEY (Id_rol) REFERENCES Roles(Id)ON DELETE CASCADE,  
);


CREATE TABLE Configuracion_prestamos (
Id INT PRIMARY KEY IDENTITY(1,1),
Nombre NVARCHAR(50),
Cant_Book_prest NVARCHAR(100),
Estado VARCHAR(15) NULL,  
FechaRegistro DATETIME,
);


CREATE TABLE Prestamos(
Id INT PRIMARY KEY  IDENTITY(1,1),
Id_estudiante INT,
Id_usuario INT,
FechaPrestamo DATE NULL, 
FechaDevolucion DATE NULL,
Total INT, 
Comentario NVARCHAR(255),
Estado VARCHAR(15) NULL,
Fecha_Registro DATETIME NULL, 
CONSTRAINT FK_PrestamoEstudiante FOREIGN KEY (Id_estudiante) REFERENCES Estudiantes(Id)ON DELETE CASCADE,  
CONSTRAINT FK_PrestamoUser FOREIGN KEY (Id_usuario) REFERENCES Usuarios(Id)ON DELETE CASCADE,  


); 
CREATE TABLE DetallePrestamo(
Id INT PRIMARY KEY  IDENTITY(1,1),
Id_prestamo INT,
Id_libro INT, 
cantidad INT,
Estado VARCHAR(15) NULL,
Fecha_Registro DATETIME NULL, 
CONSTRAINT FK_PrestamoDetalle FOREIGN KEY (Id_prestamo) REFERENCES Prestamos(Id)ON DELETE CASCADE, 
CONSTRAINT FK_LibroDetalle FOREIGN KEY (Id_libro) REFERENCES Libros(Id)ON DELETE CASCADE,  
);

CREATE TABLE Devoluciones (
Id INT PRIMARY KEY IDENTITY(1,1),
Id_prestamo INT,
FechaDevolucion DATE,
Total_devuelto INT,
Comentario NVARCHAR(255),
Estado VARCHAR(15) NULL,
Fecha_Registro DATETIME,
CONSTRAINT FK_DevolucionPrestamo FOREIGN KEY (Id_prestamo) REFERENCES Prestamos(Id) ON DELETE CASCADE
);

  INSERT INTO Autores (Nombre, Nacionalidad, FechaNacimiento, Estado, FechaRegistro)
VALUES
   ('Gabriel García Márquez', 'Colombiano', '1927-03-06', 'Activo', GETDATE()),
   ('J.K. Rowling', 'Británico', '1965-07-31', 'Activo', GETDATE()),
   ('Haruki Murakami', 'Japonés', '1949-01-12', 'Inactivo', GETDATE()),
   ('Isabel Allende', 'Chileno', '1942-08-02', 'Activo', GETDATE()),
   ('Stephen King', 'Estadounidense', '1947-09-21', 'Inactivo', GETDATE());


   INSERT INTO Ubicaciones (NombreUbicacion, NumeroStank, Referencia, Estado)
VALUES
   ('Biblioteca A', 101, 'Planta Baja', 'Activo'),
   ('Biblioteca B', 203, 'Segundo Piso', 'Inactivo'),
   ('Sala de Estudio', 305, 'Tercer Piso', 'Activo'),
   ('Archivo Central', 120, 'Planta Sótano', 'Activo'),
   ('Sala de Conferencias', 450, 'Cuarto Piso', 'Inactivo');

	INSERT INTO Secciones (Nombres, Descripcion, Estado)
VALUES
   ('A', 'Sección A', 'Activo'),
   ('B', 'Sección B', 'Inactivo'),
   ('C', 'Sección C', 'Activo'),
   ('D', 'Sección D', 'Inactivo'),
   ('E', 'Sección E', 'Activo');


   INSERT INTO Categorias (Nombres, Descripcion, Estado)
VALUES
   ('Novela', 'Ficción narrativa extensa', 'Activo'),
   ('Ciencia Ficción', 'Ficción especulativa', 'Inactivo'),
   ('Poesía', 'Expresión artística en verso', 'Activo'),
   ('Historia', 'Relato de eventos pasados', 'Activo'),
   ('Autoayuda', 'Desarrollo personal', 'Inactivo');


   INSERT INTO Libros (Codigo, Titulo, Id_autor, Id_ubicacion, Id_categoria, Cantidad_Libros, AnioPublicacion, FechaRegistro, Estado)
VALUES
   ('ABC123', 'Cien años de soledad', 1, 1, 1, 10, 1967, GETDATE(), 'Activo'),
   ('XYZ456', 'Harry Potter y la piedra filosofal', 2, 2, 2, 8, 1997, GETDATE(), 'Inactivo'),
   ('LMN789', 'Norwegian Wood', 3, 3, 3, 15, 1987, GETDATE(), 'Activo'),
   ('DEF321', 'La Casa de los Espíritus', 4, 4, 1, 12, NULL, GETDATE(), 'Activo'),
   ('GHI654', 'It', 5, 1, 2, 20, 1986, GETDATE(), 'Inactivo');

INSERT INTO Roles (NombreRol, Descripcion, Estado)
VALUES
   ('Admin', 'Administrador del sistema', 'Activo'),
   ('Usuario', 'Usuario estándar', 'Activo'),
   ('Bibliotecario', 'Encargado de la biblioteca', 'Inactivo'),
   ('Estudiante', 'Rol para estudiantes', 'Activo'),
   ('Invitado', 'Rol de acceso limitado', 'Inactivo');

   INSERT INTO Grados (Nombres, Descripcion, NivelEducacional, Estado)
VALUES
   ('Primero', 'Primer grado escolar', 'Primaria', 'Activo'),
   ('Segundo', 'Segundo grado escolar', 'Primaria', 'Inactivo'),
   ('Tercero', 'Tercer grado escolar', 'Primaria', 'Activo'),
   ('Cuarto', 'Cuarto grado escolar', 'Primaria', 'Activo'),
   ('Quinto', 'Quinto grado escolar', 'Primaria', 'Inactivo');

   
INSERT INTO Estudiantes (Codigo, Nombres, Apellidos, Id_grado, Id_seccion, Direccion, Telefono, Email, Genero, FechaNacimiento, Estado, FechaRegistro)
VALUES
   ('E001', 'Juan', 'Pérez', 1, 1, 'Calle 123', '123456789', 'juan@email.com', 'Masculino', '2005-05-15', 'Activo', GETDATE()),
   ('E002', 'María', 'Gómez', 2, 2, 'Avenida 456', '987654321', 'maria@email.com', 'Femenino', '2006-08-22', 'Activo', GETDATE()),
   ('E003', 'Carlos', 'López', 3, 1, 'Calle Principal', '555555555', 'carlos@email.com', 'Masculino', '2004-03-10', 'Inactivo', GETDATE()),
   ('E004', 'Ana', 'Martínez', 4, 3, 'Avenida Central', '333333333', 'ana@email.com', 'Femenino', '2007-11-05', 'Activo', GETDATE()),
   ('E005', 'Pedro', 'Sánchez', 5, 2, 'Calle Secundaria', '111111111', 'pedro@email.com', 'Masculino', '2003-06-18', 'Inactivo', GETDATE());


INSERT INTO Usuarios (NombresUsuario, CorreoElectronico, Contrasena, Id_rol, Estado, FechaRegistro)
VALUES
   ('admin123', 'admin@gmail.com', '12345', 1, 'Activo', GETDATE()),
   ('user456', 'user@email.com', 'hashedpassword', 2, 'Activo', GETDATE()),
   ('bibliotecario789', 'biblio@email.com', 'hashedpassword', 3, 'Inactivo', GETDATE()),
   ('estudiante101', 'estudiante@email.com', 'hashedpassword', 4, 'Activo', GETDATE());
 
