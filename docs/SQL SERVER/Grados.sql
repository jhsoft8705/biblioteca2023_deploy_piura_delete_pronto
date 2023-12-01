SELECT*FROM Grados

CREATE PROCEDURE SP_LISTAR_GRADO
AS
	BEGIN
	SELECT*FROM Grados
	END

CREATE PROCEDURE SP_LISTAR_GRADO_ID 
@Id_grado INT
AS
	BEGIN
	SELECT*FROM Grados WHERE Id=@Id_grado
	END


CREATE PROCEDURE SP_REGISTRAR_GRADO
@nombres VARCHAR(50),
@descripcion VARCHAR(100),
@nivel VARCHAR(50),
@estado VARCHAR(15)
AS
	BEGIN
	INSERT INTO Grados VALUES(@nombres,@descripcion,@nivel,@estado)
	END


CREATE PROCEDURE SP_ACTUALIZAR_GRADO
@Id_grado INT,
@nombres VARCHAR(50),
@descripcion VARCHAR(100),
@nivel VARCHAR(50),
@estado VARCHAR(15)
AS
	BEGIN
	UPDATE Grados SET Nombres=@nombres,Descripcion=@descripcion,
	NivelEducacional=@nivel,Estado=@estado WHERE
	Id=@Id_grado
	END	


CREATE PROCEDURE SP_ELIMINAR_GRADO
@Id_grado INT 
AS
	BEGIN
	DELETE Grados WHERE
	Id=@Id_grado
	END	
