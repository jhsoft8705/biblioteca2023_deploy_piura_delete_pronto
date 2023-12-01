SELECT*FROM Ubicaciones

CREATE PROCEDURE SP_LISTAR_UBICACION
AS
	BEGIN
	SELECT*FROM Ubicaciones
	END


CREATE PROCEDURE SP_LISTAR_UBICACION_ID 
@Id_ubi INT
AS
	BEGIN
	SELECT*FROM Ubicaciones WHERE Id=@Id_ubi
	END

CREATE PROCEDURE SP_REGISTRAR_UBICACION
@nombre VARCHAR(100),
@stank INT,
@referencia VARCHAR(100),
@estado Varchar(15)
AS
	BEGIN
	INSERT INTO Ubicaciones VALUES(@nombre,@stank,@referencia,@estado)
	END

CREATE PROCEDURE SP_ACTUALIZAR_UBICACION
@Id_ubi INT,
@nombre VARCHAR(100),
@stank INT,
@referencia VARCHAR(100),
@estado Varchar(15)
AS
	BEGIN
	UPDATE  Ubicaciones SET 
	NombreUbicacion=@nombre,
	NumeroStank=@stank,
	Referencia=@referencia,
	Estado=@estado
	WHERE Id=@Id_ubi
	END


CREATE PROCEDURE SP_ELIMINAR_UBICACION
@Id_ubi INT
AS
	BEGIN
	DELETE Ubicaciones WHERE Id=@Id_ubi
	END

 [NumeroStank][Referencia][Estado]