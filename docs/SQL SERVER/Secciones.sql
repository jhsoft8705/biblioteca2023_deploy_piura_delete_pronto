SELECT*FROM Secciones

CREATE PROCEDURE SP_LISTAR_SECCION
AS
	BEGIN
	SELECT*FROM Secciones
	END


CREATE PROCEDURE SP_LISTAR_SECCION_ID
@Id_seccion INT
AS
	BEGIN
	SELECT*FROM Secciones WHERE Id=@Id_seccion
	END

CREATE PROCEDURE SP_REGISTRAR_SECCION
@nombre VARCHAR(50),
@descipcion VARCHAR(100),
@estado VARCHAR(15) 
AS
	BEGIN
	INSERT INTO Secciones VALUES(@nombre,@descipcion,@estado)
	END

CREATE PROCEDURE SP_ACTUALIZAR_SECCION
@Id_seccion INT,
@nombre VARCHAR(50),
@descipcion VARCHAR(100),
@estado VARCHAR(15) 
AS
	BEGIN
	UPDATE Secciones SET Nombres=@nombre,Descripcion=@descipcion,Estado=@estado
	WHERE Id=@Id_seccion
	END

CREATE PROCEDURE SP_ELIMINAR_SECCION
@Id_seccion INT
AS
	BEGIN
	DELETE Secciones 
	WHERE Id=@Id_seccion
	END