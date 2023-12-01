 
CREATE PROCEDURE SP_LISTAR_CATEGORIA
AS
	BEGIN
	SELECT*fROM Categorias
	END

CREATE PROCEDURE SP_LISTAR_CATEGORIA_ID 
@Id_categoria INT
AS
	BEGIN
	SELECT*fROM Categorias WHERE Id=@Id_categoria
	END

CREATE PROCEDURE SP_REGISTRAR_CATEGORIA  
@nombres VARCHAR(50),
@descipcion VARCHAR(200),
@estado VARCHAR(15)
AS
	BEGIN
	INSERT INTO Categorias VALUES(@nombres,@descipcion,@estado)
	END

CREATE PROCEDURE SP_ACTUALIZAR_CATEGORIA  
@Id_categoria INT,
@nombres VARCHAR(50),
@descipcion VARCHAR(200),
@estado VARCHAR(15)
AS
	BEGIN
	UPDATE  Categorias 
	SET Nombres=@nombres, Estado=@estado,Descripcion=@descipcion
	WHERE Id=@Id_categoria
	END

CREATE PROCEDURE SP_ELIMINAR_CATEGORIA  
@Id_categoria INT
AS
	BEGIN
	DELETE FROM Categorias WHERE Id=@Id_categoria
	END