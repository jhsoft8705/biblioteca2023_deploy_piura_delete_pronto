 <!--TODO:MODAL CREATE-->
 <div class="modal fade" id="modal_mantenimiento" tabindex="-1" data-bs-backdrop="false">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="lbltitulo"></h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form id="form_mantenimiento" method="post">
                     <div class="row mb-3">

                         <input hidden type="text" id="id_ubicacion" name="id_ubicacion" class="form-control">

                         <div class="row mb-3">
                             <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                             <div class="col-sm-10">
                                 <input type="text" id="nombre" name="nombre" class="form-control">
                             </div>
                         </div>


                         <div class="row mb-3">
                             <label for="stank" class="col-sm-3 col-form-label">Número de Stank</label>
                             <div class="col-sm-9">
                                 <input type="number" id="stank" name="stank" class="form-control">
                             </div>
                         </div>

                         <div class="row mb-4">
                             <label for="referencia" class="col-sm-3 col-form-label">Referencia</label>
                             <div class="col-sm-9">
                                 <textarea id="referencia" name="referencia"class="form-control" style="height: 100px"></textarea>
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label class="col-sm-2 col-form-label">Estado</label>
                             <div class="col-sm-10">
                                 <select class="form-select" id="estado" name="estado"
                                     aria-label="Default select example">
                                     <option selected value="">Seleccionar</option>
                                     <option value="Activo">Activo</option>
                                     <option value="Inactivo">Inactivo</option>
                                 </select>
                             </div>
                         </div> 
                         <div class="modal-footer">
                             <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                             <button type="submit" name="action" value="add" id="lblbtn"
                                 class="btn btn-primary "></button>
                         </div>
                 </form>
             </div>

         </div>
     </div>
 </div>