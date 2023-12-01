SELECT*FROM Estudiantes

CREATE PROCEDURE SP_LISTAR_ESTUDIANTE
AS
  BEGIN 
	SELECT 
	Estudiantes.Id, 
	Estudiantes.Codigo, 
	Estudiantes.Nombres, 
	Estudiantes.Apellidos, 
	Estudiantes.Id_grado,
	Grados.Nombres AS Grado_nombre, 
	Grados.NivelEducacional, 
	Estudiantes.Id_seccion, 
	Secciones.Nombres AS Seccion_nombre, 
	Estudiantes.Direccion, 
	Estudiantes.Telefono, 
	Estudiantes.Email, 
	Estudiantes.Genero, 
	Estudiantes.FechaNacimiento,
	Estudiantes.Estado, 
	Secciones.Estado AS Estado_seccion,
	Grados.Estado AS Estado_grado
	FROM  Estudiantes INNER JOIN
	Grados ON Estudiantes.Id_grado = Grados.Id INNER JOIN
	Secciones ON Estudiantes.Id_seccion = Secciones.Id
	WHERE Secciones.Estado='Activo' AND Grados.Estado='Activo'
 END

  
CREATE PROCEDURE SP_LISTAR_ESTUDIANTE_ID   
@Id_estudiante INT
AS
	BEGIN 
 SELECT 
 Estudiantes.Id, 
 Estudiantes.Codigo, 
 Estudiantes.Nombres, 
 Estudiantes.Apellidos, 
 Estudiantes.Id_grado,
 Grados.Nombres AS Grado_nombre, 
 Grados.NivelEducacional, 
 Estudiantes.Id_seccion, 
 Secciones.Nombres AS Seccion_nombre, 
 Estudiantes.Direccion, 
 Estudiantes.Telefono AS Tel, 
 Estudiantes.Email, 
 Estudiantes.Genero, 
 Estudiantes.FechaNacimiento,
 Estudiantes.Estado
 FROM  Estudiantes INNER JOIN
 Grados ON Estudiantes.Id_grado = Grados.Id INNER JOIN
 Secciones ON Estudiantes.Id_seccion = Secciones.Id
 WHERE  Secciones.Estado='Activo' AND Grados.Estado='Activo' AND Estudiantes.Id=@Id_estudiante
 END




CREATE  PROCEDURE SP_REGISTRAR_ESTUDIANTE 
@codigo VARCHAR(20),
@nombre VARCHAR(50),
@apellido VARCHAR(50),
@id_grado INT,
@id_seccion INT,
@direccion VARCHAR(100),
@telefono VARCHAR(20),
@correo VARCHAR(30),
@genero VARCHAR(15),
@nacimiento VARCHAR(15),
@estado VARCHAR(15)
AS
	BEGIN
	INSERT INTO Estudiantes(Codigo,Nombres,Apellidos,Id_grado,Id_seccion,Direccion,Telefono,Email,Genero,FechaNacimiento,Estado,FechaRegistro)
	VALUES(@codigo,@nombre,@apellido,@id_grado,@id_seccion,@direccion,@telefono,@correo,@genero,@nacimiento,@estado,GETDATE());
	END



CREATE  PROCEDURE SP_ACTUALIZAR_ESTUDIANTE 
@estudiante_id INT,
@codigo VARCHAR(20),
@nombre VARCHAR(50),
@apellido VARCHAR(50),
@id_grado INT,
@id_seccion INT,
@direccion VARCHAR(100),
@telefono VARCHAR(20),
@correo VARCHAR(30),
@genero VARCHAR(15),
@nacimiento VARCHAR(15),
@estado VARCHAR(15)
AS
	BEGIN
	UPDATE Estudiantes 
	SET  
	Codigo=@codigo,
	Nombres=@nombre,
	Apellidos=@apellido,
	Id_grado=@id_grado,
	Id_seccion=@id_seccion,
	Direccion=@direccion,
	Telefono=@telefono,
	Email=@correo,
	Genero=@genero,
	FechaNacimiento=@nacimiento,
	Estado=@estado 
	WHERE Id=@estudiante_id 
	END


CREATE  PROCEDURE SP_ELIMINAR_ESTUDIANTE 
@estudiante_id INT 
AS
	BEGIN
	DELETE Estudiantes WHERE Id=@estudiante_id 
	END


CREATE PROCEDURE SP_LISTAR_GRADOS
AS
	BEGIN
	SELECT*FROM Grados WHERE Estado='Activo'
	END


CREATE PROCEDURE SP_LISTAR_SECCIONES
AS
	BEGIN
	SELECT*FROM Secciones WHERE Estado='Activo'
	END