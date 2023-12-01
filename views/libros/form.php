 <!--TODO:MODAL CREATE-->
 <div class="modal fade" id="modal_libro" tabindex="-1" data-bs-backdrop="false">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="lbltitulo"></h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form id="form_libros"  method="post">
                     <div class="row mb-3">

                         <input hidden type="text" id="id" name="id" class="form-control">

                         <div class="row mb-3">
                             <label for="codigo" class="col-sm-2 col-form-label">Código</label>
                             <div class="col-sm-10">
                                 <input type="text" id="codigo" name="codigo" class="form-control">
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label for="titulo" class="col-sm-2 col-form-label">Título</label>
                             <div class="col-sm-10">
                                 <input type="text" id="titulo" name="titulo" class="form-control">
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label class="col-sm-2 col-form-label">Autor</label>
                             <div class="col-sm-10">
                                 <select class="form-select" id="autor" name="autor"
                                     aria-label="Default select example">
                                     <option selected>Seleccionar</option>
                                     <option value="1">One</option>
                                     <option value="2">Two</option>
                                 </select>
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label class="col-sm-2 col-form-label">Ubicación</label>
                             <div class="col-sm-10">
                                 <select class="form-select" id="ubi" name="ubi" aria-label="Default select example">
                                     <option selected>Seleccionar</option>
                                     <option value="1">One</option>
                                     <option value="2">Two</option>
                                 </select>
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label class="col-sm-2 col-form-label">Categoria</label>
                             <div class="col-sm-10">
                                 <select class="form-select" id="cate" name="cate" aria-label="Default select example">
                                     <option selected>Seleccionar</option>
                                     <option value="1">One</option>
                                     <option value="2">Two</option>
                                 </select>
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label for="inputNumber" class="col-sm-2 col-form-label">Cantidad</label>
                             <div class="col-sm-10">
                                 <input type="number" id="cantidad" name="cantidad" class="form-control">
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label for="inputanio" class="col-sm-2 col-form-label">Año de Publicación</label>
                             <div class="col-sm-10">
                                 <input type="number" id="anio" name="anio" class="form-control">
                             </div>
                         </div>
                   
                         <div class="modal-footer">
                             <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                             <button type="submit" name="action" value="add" id="lblbtn"class="btn btn-primary "></button>
                         </div>
                 </form>
             </div>

         </div>
     </div>
 </div>