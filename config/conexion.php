<?php
    session_start();
    /* TODO: Inicio de Session */
    class Conectar{
        protected $dbh;
        protected function Conexion(){
            try{
                /* TODO: Cadena de Conexion */
                $conectar = $this->dbh=new 

                PDO("sqlsrv:Server=server-01-colegio.database.windows.net;Database=bd_sys_library","administrado-colegio","@Sistema12345");
                 
                return $conectar;
            }catch (Exception $e){
                /* TODO: En caso de error mostrar mensaje */
                print "Error Conexion BD". $e->getMessage() ."<br/>";
                die();
            }
        } 
        public static function ruta(){ 
            //return "http://localhost/Sistema_gestion_biblioteca_2023/";  
            return "http://sistema-web-biblioteca.azurewebsites.net/";  

            //Server:server-01-colegio.database.windows.net
            //User:administrado-colegio
            //Pass:@Sistema12345

            //nombre:http://sistema-web-biblioteca.azurewebsites.net

        }
    }
?>