CREATE PROCEDURE SP_LISTAR_LIBRO   
AS 
BEGIN
SELECT 
    Libros.Id, 
	Libros.Codigo, 
    Libros.Titulo, 
    Autores.Nombre AS Autor, 
    Ubicaciones.NombreUbicacion, 
    Ubicaciones.NumeroStank, 
    Categorias.Nombres AS Categoria, 
    Libros.Cantidad_Libros, 
    Libros.AnioPublicacion, 
    Libros.FechaRegistro, 
    Libros.Estado
FROM Libros
INNER JOIN Autores ON Autores.Id = Libros.Id_autor
INNER JOIN Categorias ON Categorias.Id = Libros.Id_categoria
INNER JOIN Ubicaciones ON Ubicaciones.Id = Libros.Id_ubicacion; 
END;

CREATE PROCEDURE SP_LISTAR_LIBRO_ID 1
@Id_libro INT
AS
BEGIN
SELECT 
    Libros.Id, 
	Libros.Codigo, 
    Libros.Titulo, 
	Autores.Id AS autor_id, 
    Autores.Nombre AS Autor, 
	Ubicaciones.Id AS ubi_id, 
    Ubicaciones.NombreUbicacion, 
    Ubicaciones.NumeroStank, 
	Categorias.Id AS cate_id, 
    Categorias.Nombres AS Categoria, 
    Libros.Cantidad_Libros, 
    Libros.AnioPublicacion, 
    Libros.FechaRegistro, 
    Libros.Estado
FROM Libros
INNER JOIN Autores ON Autores.Id = Libros.Id_autor
INNER JOIN Categorias ON Categorias.Id = Libros.Id_categoria
INNER JOIN Ubicaciones ON Ubicaciones.Id = Libros.Id_ubicacion
WHERE Libros.Id=@Id_libro
END;

CREATE PROCEDURE SP_REGISTRAR_LIBRO
  @codigo VARCHAR(50),
  @Titulo NVARCHAR(255),
  @Id_autor INT,
  @Id_ubicacion INT,
  @Id_categoria INT,
  @Cantidad_Libros INT,
  @AnioPublicacion INT
AS
BEGIN
  INSERT INTO Libros (Codigo,Titulo, Id_autor, Id_ubicacion, Id_categoria, Cantidad_Libros, AnioPublicacion, FechaRegistro, Estado)
  VALUES (@codigo,@Titulo, @Id_autor, @Id_ubicacion, @Id_categoria, @Cantidad_Libros, @AnioPublicacion, GETDATE(),'Activo');
END

 CREATE PROCEDURE SP_ACTUALIZAR_LIBRO
  @Id INT,
  @codigo VARCHAR(50),
  @Titulo NVARCHAR(255),
  @Id_autor INT,
  @Id_ubicacion INT,
  @Id_categoria INT,
  @Cantidad_Libros INT,
  @AnioPublicacion INT
AS
BEGIN
  UPDATE Libros
  SET
    Codigo=  @codigo,
    Titulo = @Titulo,
    Id_autor = @Id_autor,
    Id_ubicacion = @Id_ubicacion,
    Id_categoria = @Id_categoria,
    Cantidad_Libros = @Cantidad_Libros,
    AnioPublicacion = @AnioPublicacion
  WHERE Id = @Id;
END



CREATE PROCEDURE SP_ELIMINAR_LIBRO
  @Id INT
AS
BEGIN
  DELETE FROM Libros
  WHERE Id = @Id;
END

----------------UBICACIONES---------------------
CREATE PROCEDURE SP_LISTAR_UBICACIONES
AS
BEGIN
	SELECT*FROM Ubicaciones WHERE Estado='Activo'
END
----------------AUTORES---------------------
CREATE PROCEDURE SP_LISTAR_AUTORES
AS
BEGIN
	SELECT*FROM Autores WHERE Estado='Activo'
END

----------------CATEGORIAS---------------------
CREATE PROCEDURE SP_LISTAR_CATEGORIAS
AS
BEGIN
	SELECT*FROM Categorias WHERE Estado='Activo'
END


 