
SELECT*FROM Autores

CREATE PROCEDURE SP_LISTAR_AUTOR
AS
	BEGIN
	SELECT*FROM Autores
END

CREATE PROCEDURE SP_LISTAR_AUTOR_ID  
@Id_autor INT
AS
	BEGIN
	SELECT*FROM Autores Where Id=@Id_autor
END

CREATE PROCEDURE SP_REGISTRAR_AUTOR
@nombre VARCHAR(100),
@nacionalidad VARCHAR(30),
@fecha_nacimiento DATE,
@estado VARCHAR(15)
AS
BEGIN
    INSERT INTO Autores (Nombre, Nacionalidad, FechaNacimiento, FechaRegistro, Estado)
    VALUES (@nombre, @nacionalidad, @fecha_nacimiento, GETDATE(), @estado);
END


CREATE PROCEDURE SP_ACTUALIZAR_AUTOR
@Id_autor INT,
@nombre VARCHAR(100),
@nacionalidad VARCHAR(30),
@fecha_nacimiento DATE,
@estado VARCHAR(15)
AS
BEGIN
    UPDATE Autores
    SET
        Nombre = @nombre,
        Nacionalidad = @nacionalidad,
        FechaNacimiento = @fecha_nacimiento,
        Estado = @estado
    WHERE Id = @Id_autor;
END

CREATE PROCEDURE SP_ELIMINAR_AUTOR
@Id_autor INT
AS
	BEGIN
	DELETE FROM Autores WHERE Id=@Id_autor
	END