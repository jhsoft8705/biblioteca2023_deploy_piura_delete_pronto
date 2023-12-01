SELECT*FROM Usuarios

CREATE PROCEDURE SP_LISTAR_USUARIO
AS
BEGIN
	SELECT 
	Usuarios.Id, 
	Usuarios.NombresUsuario, 
	Usuarios.CorreoElectronico, 
	Usuarios.Contrasena, 
	Usuarios.Id_rol,
	Roles.NombreRol, 
	Usuarios.Estado,
	Usuarios.FechaRegistro
	FROM Roles INNER JOIN Usuarios ON Roles.Id = Usuarios.Id_rol
	WHERE  Roles.Estado='Activo'

 END

ALTER PROCEDURE SP_LISTAR_USUARIO_ID 
@Id_usuario INT
AS
 BEGIN
	SELECT 
	Usuarios.Id, 
	Usuarios.NombresUsuario, 
	Usuarios.NumeroDocumento, 
	Usuarios.Telefono, 
	Usuarios.CorreoElectronico, 
	Usuarios.Contrasena, 
	Usuarios.Id_rol, 
	Roles.NombreRol,
	Roles.Descripcion, 
	Usuarios.Direccion, 
    Usuarios.Genero, 
	Usuarios.Estado, 
	Usuarios.FechaRegistro
	FROM Roles INNER JOIN
    Usuarios ON Roles.Id = Usuarios.Id_rol 
	WHERE Usuarios.Id=@Id_usuario AND Roles.Estado='Activo'
END

CREATE PROCEDURE SP_REGISTRAR_USUARIO
@nombre VARCHAR(100),
@correo VARCHAR(30),
@pass VARCHAR(30),
@Id_rol INT,
@estado VARCHAR(15)
AS
 BEGIN
	INSERT INTO Usuarios(NombresUsuario,CorreoElectronico,Contrasena,Id_rol,Estado,FechaRegistro)
	VALUES(@nombre,@correo,@pass,@Id_rol,@estado,GETDATE())
END




CREATE PROCEDURE SP_ACTUALIZAR_USUARIO
@Id_usuario INT,
@nombre VARCHAR(100),
@correo VARCHAR(30),
@pass VARCHAR(30),
@Id_rol INT,
@estado VARCHAR(15)
AS
 BEGIN
	UPDATE  Usuarios SET NombresUsuario=@nombre,CorreoElectronico=@correo,
	Contrasena=@pass,Id_rol=@Id_rol,Estado=@estado
	WHERE Id=@Id_usuario
END


CREATE PROCEDURE SP_ELIMINAR_USUARIO
@Id_usuario INT
AS
 BEGIN
	DELETE  Usuarios WHERE Id=@Id_usuario
END


----ROLES-------
CREATE PROCEDURE SP_LISTAR_ROLES
AS
BEGIN
	SELECT*FROM Roles  
	WHERE Estado='Activo'

 END
  

ALTER PROCEDURE SP_LOGIN 
    @correo VARCHAR(50),
    @pass VARCHAR(30)
AS
BEGIN
    DECLARE @usuario VARCHAR(50);   
    DECLARE @Contrasena VARCHAR(30);  

    SELECT @usuario = CorreoElectronico, @Contrasena = Contrasena
    FROM Usuarios
    WHERE CorreoElectronico = @correo; 

    IF (@usuario IS NOT NULL)
    BEGIN
        IF (@Contrasena = @pass)
        BEGIN
            SELECT 'SUCCESS' AS LoginStatus,
                   Usuarios.Id, Usuarios.NombresUsuario, Usuarios.CorreoElectronico, 
                   Usuarios.Contrasena, Usuarios.Id_rol, Roles.NombreRol 
            FROM Roles 
            INNER JOIN Usuarios ON Roles.Id = Usuarios.Id_rol 
            WHERE CorreoElectronico = @correo;
        END
        ELSE
        BEGIN
            SELECT 'PASSWORD_ERROR' AS LoginStatus;
        END
    END
    ELSE
    BEGIN
        SELECT 'USER_NOT_FOUND' AS LoginStatus;
    END
END 

 


ALTER PROCEDURE SP_UPDATE_PERFIL
@id_user INT,
@nombres VARCHAR(80),
@doc VARCHAR (15),
@tel VARCHAR(15),
@dir VARCHAR(50)
AS
BEGIN
	UPDATE Usuarios
	SET
    NombresUsuario = @nombres,
    NumeroDocumento = @doc,
    Telefono = @tel,
    Direccion = @dir
 	WHERE Id = @id_user
END 


ALTER PROCEDURE SP_CHANGE_PASSWORD
@id_user INT,
@current_pass VARCHAR(255),
@new_pass VARCHAR(255)
AS
BEGIN
 SET NOCOUNT ON 
    DECLARE @Mensaje NVARCHAR(255) 
    SET @Mensaje = '' 
    DECLARE @current_pass_db VARCHAR(255);
	
    SELECT @current_pass_db = Contrasena
    FROM Usuarios
    WHERE Id = @id_user;

    IF @current_pass_db IS NOT NULL AND @current_pass_db = @current_pass
    BEGIN
        UPDATE Usuarios
        SET Contrasena = @new_pass
        WHERE Id = @id_user; 

		 SET @Mensaje = 'Password actualizada correctamente.' 
    END
    ELSE
    BEGIN
	     SET @Mensaje = 'La contraseña actual no es correcta' 
    END
   SELECT @Mensaje AS Mensaje 
    SET NOCOUNT ON 
END;


SELECT*FROM Usuarios
   
SP_CHANGE_PASSWORD 2,'vvvvv','12345'
