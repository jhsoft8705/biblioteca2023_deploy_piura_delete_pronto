

--PRESTAMOS
ALTER PROCEDURE SP_LISTAR_PRESTAMOS
AS
	BEGIN
		SELECT
		Prestamos.Id, 
		Prestamos.Id_estudiante, 
		Estudiantes.Codigo, 
		Estudiantes.Nombres, 
		Estudiantes.Apellidos, 
		Estudiantes.Id_grado, 
		Grados.Nombres AS Grado, 
		Estudiantes.Id_seccion, 
		Secciones.Nombres AS Seccion,
		Estudiantes.Telefono,
		Estudiantes.Email,
		Estudiantes.Direccion,
		Prestamos.Id_usuario, 
		Usuarios.NombresUsuario, 
		Prestamos.FechaPrestamo, 
		Prestamos.FechaDevolucion,
	   --DATEDIFF(day, Prestamos.FechaPrestamo, Prestamos.FechaDevolucion) AS DiasPrestamo, 
		Prestamos.Total, 
		Prestamos.Estado
		FROM Estudiantes INNER JOIN 
		Grados ON Estudiantes.Id_grado = Grados.Id INNER JOIN
		Prestamos ON Estudiantes.Id = Prestamos.Id_estudiante INNER JOIN
		Secciones ON Estudiantes.Id_seccion = Secciones.Id INNER JOIN
		Usuarios ON Prestamos.Id_usuario = Usuarios.Id
		WHERE Prestamos.Estado='PRESTADO' 
	END
 

--DEVOLUCIONES 
ALTER PROCEDURE SP_LISTAR_DEVOLUCION
AS
	BEGIN
	SELECT 
	Prestamos.Id,
	Prestamos.Id_estudiante, 
	Estudiantes.Codigo, 
	Estudiantes.Nombres, 
	Estudiantes.Apellidos, 
	Estudiantes.Id_grado,
	Grados.Nombres AS Grado, 
	Estudiantes.Id_seccion, 
	Secciones.Nombres AS Seccion, 
    Prestamos.Id_usuario, 
	Usuarios.NombresUsuario, 
	Prestamos.FechaPrestamo, 
	Prestamos.FechaDevolucion, 
    Devoluciones.FechaDevolucion AS FechaDevolucionFinal,  
	Devoluciones.Total_devuelto AS Total,
	Prestamos.Estado
	FROM Estudiantes INNER JOIN
    Grados ON Estudiantes.Id_grado = Grados.Id INNER JOIN
    Prestamos ON Estudiantes.Id = Prestamos.Id_estudiante INNER JOIN
    Secciones ON Estudiantes.Id_seccion = Secciones.Id INNER JOIN
    Usuarios ON Prestamos.Id_usuario = Usuarios.Id INNER JOIN
    Devoluciones ON Prestamos.Id = Devoluciones.Id_prestamo
	WHERE Prestamos.Estado='DEVUELTO'
	END 


ALTER PROCEDURE SP_RELOAD_DETALLE_PRESTAMO
AS
	BEGIN 
		DECLARE @ids_detall_prestamo TABLE (Id INT);
		DECLARE @ids_libros TABLE (Id_libro INT, Cantidad INT); 

 		INSERT INTO @ids_detall_prestamo (Id)
		SELECT Id FROM DetallePrestamo WHERE Estado = 'PREPRESTADO'; 

		INSERT INTO @ids_libros (Id_libro, Cantidad)
		SELECT Id_libro, cantidad FROM DetallePrestamo WHERE Estado = 'PREPRESTADO';
		
		DELETE FROM DetallePrestamo
		WHERE Id IN (SELECT Id FROM @ids_detall_prestamo);  

		UPDATE Libros
		SET Cantidad_Libros = Cantidad_Libros + i.Cantidad
		FROM Libros l
		INNER JOIN @ids_libros i ON l.Id = i.Id_libro;
		--SELECT * FROM @ids_detall_prestamo;
		--SELECT * FROM @ids_libros;
		--SELECT * FROM Libros WHERE Id IN (SELECT Id_libro FROM @ids_libros);
	END

  

ALTER PROCEDURE DEVOLVER_PRESTAMO 
 @Prestamo_id INT
 AS
	BEGIN
		DECLARE @total INT
		DECLARE @ids_detalle TABLE (Id INT,Id_libro INT, Cantidad INT);
 
		UPDATE Prestamos SET Estado='DEVUELTO' WHERE Id=@Prestamo_id

		SELECT @total =  Total FROM Prestamos  WHERE Id = @Prestamo_id  
		INSERT INTO Devoluciones (Id_prestamo,FechaDevolucion,Total_devuelto,Estado,Fecha_Registro)
		VALUES(@Prestamo_id,CAST(GETDATE()AS DATE),@total,'DEVUELTO',GETDATE())

		INSERT INTO @ids_detalle (Id, Id_libro, Cantidad)
		SELECT Id, Id_libro, Cantidad FROM DetallePrestamo WHERE Id_prestamo = @Prestamo_id AND Estado = 'PRESTADO';

		 UPDATE Libros
		 SET Cantidad_Libros = Cantidad_Libros + ids_d.Cantidad
		 FROM Libros l
   	     INNER JOIN @ids_detalle ids_d ON l.Id = ids_d.Id_libro;
		 --SELECT * FROM @ids_detalle; 
 	END



 
 ALTER PROCEDURE SP_LISTAR_DETALLE_PRESTAMO   
 @Prestamo_id INT
 AS
	BEGIN
	SELECT        
	DetallePrestamo.Id,
	DetallePrestamo.Id_prestamo, 
	DetallePrestamo.Id_libro, Libros.Codigo,
	Libros.Titulo, DetallePrestamo.cantidad, 
	DetallePrestamo.Estado, 
	Libros.Id_autor, 
	Autores.Nombre AS Nombre_Autor, 
	Libros.Id_ubicacion, 
	Categorias.Nombres AS Nombre_Categoria
	FROM DetallePrestamo INNER JOIN
    Libros ON DetallePrestamo.Id_libro = Libros.Id INNER JOIN
    Autores ON Libros.Id_autor = Autores.Id INNER JOIN
    Categorias ON Libros.Id_categoria = Categorias.Id
	WHERE DetallePrestamo.Id_prestamo=@Prestamo_id AND DetallePrestamo.Estado='PREPRESTADO'
END


 ALTER PROCEDURE SP_LISTAR_DETALLE_PRESTAMO_UPDATE  
 @Prestamo_id INT
 AS
	BEGIN
	SELECT        
	DetallePrestamo.Id,
	DetallePrestamo.Id_prestamo, 
	DetallePrestamo.Id_libro, Libros.Codigo,
	Libros.Titulo, DetallePrestamo.cantidad, 
	DetallePrestamo.Estado, 
	Libros.Id_autor, 
	Autores.Nombre AS Nombre_Autor, 
	Libros.Id_ubicacion, 
	Categorias.Nombres AS Nombre_Categoria
	FROM DetallePrestamo INNER JOIN
    Libros ON DetallePrestamo.Id_libro = Libros.Id INNER JOIN
    Autores ON Libros.Id_autor = Autores.Id INNER JOIN
    Categorias ON Libros.Id_categoria = Categorias.Id
	WHERE DetallePrestamo.Id_prestamo=@Prestamo_id AND DetallePrestamo.Estado='PRESTADO'
	OR  DetallePrestamo.Estado='PREPRESTADO'
END




ALTER PROCEDURE SP_ACTUALIZAR_TOTAL_DETALL_PREST
@Id_prestamo INT
AS
BEGIN
    SELECT ISNULL(SUM(DetallePrestamo.cantidad), 0) AS Total
    FROM DetallePrestamo
    INNER JOIN Prestamos ON DetallePrestamo.Id_prestamo = Prestamos.Id 
    WHERE Prestamos.Id = @Id_prestamo AND DetallePrestamo.Estado='PREPRESTADO';
END



ALTER PROCEDURE SP_ACTUALIZAR_TOTAL_DETALL_PREST_UPDATE
@Id_prestamo INT
AS
BEGIN
    SELECT ISNULL(SUM(DetallePrestamo.cantidad), 0) AS Total
    FROM DetallePrestamo
    INNER JOIN Prestamos ON DetallePrestamo.Id_prestamo = Prestamos.Id 
    WHERE Prestamos.Id = @Id_prestamo AND DetallePrestamo.Estado='PRESTADO';
END



ALTER PROCEDURE SP_UPDATE_PRESTAMO_TEMPORAL
AS
BEGIN
SET NOCOUNT ON
    INSERT INTO Prestamos (Estado, Fecha_Registro)
    VALUES ('PREPRESTADO', GETDATE());  

    DECLARE @NuevoIdPrestamo INT;
    SET @NuevoIdPrestamo = SCOPE_IDENTITY(); 
    SELECT * FROM Prestamos WHERE Id = @NuevoIdPrestamo;
SET NOCOUNT ON
END
 
  

ALTER PROCEDURE SP_REGISTRAR_DETALLES_PRESTAMO 
    @Id_prestamo INT,
    @Id_libro INT,
    @Cantidad INT 
AS
BEGIN 
    SET NOCOUNT ON 
    DECLARE @Mensaje NVARCHAR(255) 
    SET @Mensaje = ''   
    IF NOT EXISTS (
        SELECT 1 FROM DetallePrestamo 
        WHERE Id_prestamo = @Id_prestamo AND Id_libro = @Id_libro
    )
    BEGIN
        -- Obtener la cantidad actual de libros disponibles
        DECLARE @CantidadDisponible INT
        SELECT @CantidadDisponible = Cantidad_Libros FROM Libros WHERE Id = @Id_libro
        
        -- Verificar si hay suficientes libros disponibles para agregar
        IF @Cantidad = 1 AND @CantidadDisponible >= 1  
        BEGIN
            BEGIN TRANSACTION
            -- Agregar el detalle del préstamo
            INSERT INTO DetallePrestamo(Id_prestamo, Id_libro, cantidad, Estado, Fecha_Registro)
            VALUES(@Id_prestamo, @Id_libro, @Cantidad, 'PREPRESTADO', GETDATE())
    
            -- Actualizar la cantidad de libros disponibles
            UPDATE Libros SET Cantidad_Libros = Cantidad_Libros - 1 WHERE Id = @Id_libro
            COMMIT
    
            SET @Mensaje = 'Detalle de préstamo agregado exitosamente.'
        END
        ELSE
        BEGIN
            SET @Mensaje = 'La cantidad debe ser igual a 1 y debe haber suficientes libros disponibles.'
        END
    END
    ELSE
    BEGIN
        SET @Mensaje = 'Este libro ya se encuentra agregado al detalle de este préstamo.'
    END  
    SELECT @Mensaje AS Mensaje 
    SET NOCOUNT ON 
END

 
 
ALTER PROCEDURE SP_REGISTRAR_DETALLES_PRESTAMO_UPDATE 
    @Id_prestamo INT,
    @Id_libro INT,
    @Cantidad INT 
AS
BEGIN 
    SET NOCOUNT ON 
    DECLARE @total INT;   
    DECLARE @Mensaje NVARCHAR(255) 
    SET @Mensaje = ''   
    IF NOT EXISTS (
        SELECT 1 FROM DetallePrestamo 
        WHERE Id_prestamo = @Id_prestamo AND Id_libro = @Id_libro
    )
    BEGIN
        -- Obtener la cantidad actual de libros disponibles
        DECLARE @CantidadDisponible INT
        SELECT @CantidadDisponible = Cantidad_Libros FROM Libros WHERE Id = @Id_libro
        
        -- Verificar si hay suficientes libros disponibles para agregar
        IF @Cantidad = 1 AND @CantidadDisponible >= 1  
        BEGIN
            BEGIN TRANSACTION
            -- Agregar el detalle del préstamo
            INSERT INTO DetallePrestamo(Id_prestamo, Id_libro, cantidad, Estado, Fecha_Registro)
            VALUES(@Id_prestamo, @Id_libro, @Cantidad, 'PREPRESTADO', GETDATE())
    
            -- Actualizar la cantidad de libros disponibles
            UPDATE Libros SET Cantidad_Libros = Cantidad_Libros - 1 WHERE Id = @Id_libro
            COMMIT
    
            SET @Mensaje = 'Detalle de préstamo agregado exitosamente.' 
        END
        ELSE
        BEGIN
            SET @Mensaje = 'La cantidad debe ser igual a 1 y debe haber suficientes libros disponibles.'
        END
    END
    ELSE
    BEGIN
        SET @Mensaje = 'Este libro ya se encuentra agregado al detalle de este préstamo.'
    END  
    SELECT @Mensaje AS Mensaje 
    SET NOCOUNT ON 
END

 

 ALTER PROCEDURE SP_DELETE_DETALLE_PREST
@Id_detalle INT
AS
BEGIN
    BEGIN TRANSACTION
    DECLARE @total INT;  
    DECLARE @Id_libro INT
    DECLARE @Id_prestamo INT  -- Agregada esta línea 
    -- Obtener Id_libro e Id_prestamo
    SELECT @Id_libro = Id_libro, @Id_prestamo = Id_prestamo
    FROM DetallePrestamo
    WHERE Id = @Id_detalle 
     DELETE DetallePrestamo WHERE Id = @Id_detalle   
    UPDATE Libros SET Cantidad_Libros = Cantidad_Libros + 1 WHERE Id = @Id_libro 
    -- Recalcular la cantidad total prestada en el préstamo
    SELECT @total = ISNULL(SUM(cantidad), 0)
    FROM DetallePrestamo
    WHERE Id_prestamo = @Id_prestamo  
    UPDATE Prestamos SET Total = @total WHERE Id = @Id_prestamo  
    COMMIT
END

  

ALTER PROCEDURE SP_REGISTRAR_PRESTAMO
    @Prestamo_id INT,
    @Estudiante_id INT,
    @Usuario_id INT,
    @fecha_inicio DATE,
    @fecha_devolucion DATE,
    @comentario VARCHAR(250) 
AS
BEGIN
    DECLARE @total INT; 
    IF EXISTS (SELECT 1 FROM DetallePrestamo WHERE Id_prestamo = @Prestamo_id)
    BEGIN
        SELECT @total = ISNULL(SUM(cantidad), 0) 
        FROM DetallePrestamo  
        WHERE Id_prestamo = @Prestamo_id   

         UPDATE Prestamos
        SET
            Id_estudiante = @Estudiante_id,
            Id_usuario = @Usuario_id,
            FechaPrestamo = @fecha_inicio,
            FechaDevolucion = @fecha_devolucion, 
            Total = @total,
            Comentario = @comentario, 
            Estado = 'PRESTADO',
            Fecha_Registro = GETDATE() 
        WHERE Id = @Prestamo_id

        UPDATE DetallePrestamo  
        SET Estado = 'PRESTADO', 
            Fecha_Registro = GETDATE() 
        WHERE Id_prestamo = @Prestamo_id
    END
    ELSE
    BEGIN
        -- Mensaje específico si no hay detalles
        SELECT 'No se pueden registrar préstamos sin detalles.' AS Mensaje;
        RETURN;
    END
END
 

 ALTER PROCEDURE SP_PRESTAMO_ID  
 @Id_prestamo INT
 AS 
 BEGIN   
	SELECT  Prestamos.Id, 
	Prestamos.Id_estudiante, 
	Prestamos.Id_usuario, 
	Usuarios.NombresUsuario, 
	Prestamos.FechaPrestamo, 
	Prestamos.FechaDevolucion, 
	Prestamos.Total, 
	Prestamos.Estado, 
	Prestamos.Comentario, 
	Prestamos.Fecha_Registro
	FROM Prestamos INNER JOIN
	Usuarios ON Prestamos.Id_usuario = Usuarios.Id
    WHERE Prestamos.Id=@Id_prestamo
 END

 
