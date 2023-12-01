 <!--TODO:MODAL CREATE-->

 <div class="modal fade" id="modal_mantenimiento" tabindex="-1">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="lblnombre"></h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form id="form_mantenimiento" method="post">
                     <div class="row mb-3">
                         <div class="row align-items-center -3g">

                         <input hidden type="text" id="prestamo_id" name="prestamo_id" class="form-control">

                             <div class="col-lg-3">
                                 <label for="codigo" class="form-label">Cod. Estudiante</label>
                                 <input type="text" class="form-control" id="codigo" name="codigo"
                                     placeholder="Cod. Estudiante" />
                             </div>

                             <div class="col-lg-4">
                                 <label for="nombre" class="form-label">Nombres</label>
                                 <input type="text" class="form-control" id="nombre" name="nombre"
                                     placeholder="Nombre" />
                             </div>

                             <div class="col-lg-5">
                                 <label for="apellido" class="form-label">Apellidos</label>
                                 <input type="text" class="form-control" id="apellido" name="apellido"
                                     placeholder="Apellidos" />
                             </div>

                             <div class="col-lg-4">
                                 <label for="grado_id" class="form-label">Grado</label>
                                 <select id="grado_id" name="grado_id" class="form-control form-select"
                                     aria-label="Seleccione">
                                     <option value='' selected>Seleccione</option>
                                 </select>
                             </div>

                             <div class="col-lg-4">
                                 <label for="seccion_id" class="form-label">Sección</label>
                                 <select id="seccion_id" name="seccion_id" class="form-control form-select"
                                     aria-label="Seleccione">
                                     <option value='' selected>Seleccione</option>
                                 </select>
                             </div>
                             <div class="col-lg-4">
                                 <label for="direccion" class="form-label">Dirección</label>
                                 <input type="text" class="form-control" id="direccion" name="direccion"
                                     placeholder="Dirección" />
                             </div>

                             <div class="col-lg-4">
                                 <label for="tel" class="form-label">Teléfono</label>
                                 <input type="text" class="form-control" id="tel" name="tel"
                                     placeholder="Teléfono" />
                             </div>

                             <div class="col-lg-6">
                                 <label for="correo" class="form-label">Correo Electrónico</label>
                                 <input type="email" class="form-control" id="correo" name="correo"
                                     placeholder="Correo Electrónico" />
                             </div> 
                             <div class="col-lg-5">
                                 <label for="genero" class="form-label">Genero</label>
                                 <select id="genero" name="genero" class="form-control form-select"
                                     aria-label="Seleccione">
                                     <option value='' selected>Seleccione</option>
                                     <option value='Masculino'>Masculino</option>
                                     <option value='Femenino'>Femenino</option>
                                 </select>
                             </div>

                             <div class="col-lg-6">
                                 <label for="nacimiento" class="form-label">Fech. Nacimiento</label>
                                 <input type="date" class="form-control" id="nacimiento" name="nacimiento"
                                     placeholder="Fech. Nacimiento" />
                             </div>

                             <div class="col-lg-5">
                                 <label for="estado" class="form-label">Estado</label>
                                 <select id="estado" name="estado" class="form-control form-select"
                                     aria-label="Seleccione">
                                     <option value="" selected>Seleccione</option>
                                     <option value="Activo">Activo</option>
                                     <option value="Inactivo" >Inactivo</option>
                                 </select>
                             </div>

                         </div>
                     </div>
                     
             <div class="modal-footer">
                 <button type="button" class="botones_secundario" data-bs-dismiss="modal">Cancelar</button>
                 <button type="submit" name="action" value="add" id="lblbtn" class="botones"></button>
             </div>
                 </form>
             </div>
         </div>
     </div>
 </div><!-- End Large Modal-->