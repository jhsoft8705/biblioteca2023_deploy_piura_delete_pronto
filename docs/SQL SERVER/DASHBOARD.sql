

ALTER PROCEDURE SP_DONA
AS
BEGIN  
SELECT
Categorias.Nombres, 
SUM(Libros.Cantidad_Libros) AS Total
FROM Categorias INNER JOIN
Libros ON Categorias.Id = Libros.Id_categoria
GROUP BY   Categorias.Nombres
ORDER BY  Total DESC 
END

ALTER  PROCEDURE SP_OPERACIONES_RECIENTES
AS
BEGIN
 SELECT 
	Prestamos.Id, 
	Prestamos.Total, 
	Usuarios.NombresUsuario, 
	Estudiantes.Nombres+' '+Estudiantes.Apellidos AS solicitante,
	Prestamos.Estado
 	FROM Estudiantes INNER JOIN
	Prestamos ON Estudiantes.Id = Prestamos.Id_estudiante INNER JOIN
	Usuarios ON Prestamos.Id_usuario = Usuarios.Id 
	WHERE Prestamos.Estado='DEVUELTO' OR Prestamos.Estado='PRESTADO'
	ORDER BY Prestamos.Id DESC
END
 