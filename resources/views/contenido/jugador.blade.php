    <div class="content-wrapper">
           <section class="full-box dashboard-contentPage">
          <!-- SELECT2 EXAMPLE -->
          <div class="card-header">
          <div class="form-group row">
                                <div class="col-md-6">
                                    <div >
                                        <select class=" col-md-3" id="opcion" name="opcion">
                                            <option value="producto">Nombre</option>
                                            <option value="codigo">Cargo</option>
                                        </select>
                                        <input type="text" id="texto" name="texto"  placeholder="Buscar">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

                                    </div>
                                </div>
                            </div>
                          </div>

                          <ul class="list-group">
                      <li class="list-group-item list-group-item-primary"><a href="#new" data-toggle="tab">Nuevo</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#list" data-toggle="tab">Lista</a></li>  
                    </ul> 

                <div class="card">
                     <div id="myTabContent" class="tab-content"> 
                    <div class="tab-pane active in" id="new">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-9 col-md-10">
                                        <form action="">

                                            <div class="form-group label-floating">
                                              <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" class="form-control" id="exampleInputNombre" placeholder="Ingrese nombre su nombre">
                     
                                            </div>
                                            <div class="form-group">
                    <label>Fecha Nacimiento:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div><!-- /.input group -->
                  </div>
                                            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Direcci&oacute;n:</label>
                <div class="col-sm-12">
      
                <textarea id="direccion" name="direccion" class="form-control" maxlength="250" onKeyDown="cuenta()" onKeyUp="cuenta()">&nbsp;</textarea>
                </div>
                </div>
                                            <label>G&eacute;nero:</label>
                     <div class="form-group">
                      <div class="radio">
                        <label>
                          &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                          Masculino
                          &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;
                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                          Femenino
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                    <label>T&eacute;lefono:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input type="text" class="form-control" data-inputmask="'mask': ['9999-9999 []', '+099 99 99 9999[9]-9999']" data-mask>
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Estatura</label>
                      <input type="text" class="form-control" id="exampleInputNombre" placeholder="Ingrese su estatura">
                    </div>  
                     <div class="form-group">
                      <label for="exampleInputFile">Foto</label>
                      <input type="file" id="exampleInputFile">
                      
                    </div>
                                            <p class="text-center">
                                                
                                             <button type="submit" class="btn btn-primary">Guardar</button>              
                                          </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="tab-pane fade" id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Fecha de nacimiento</th>
                                            <th class="text-center">Dirección</th>
                                            <th class="text-center">Género</th>
                                            <th class="text-center">Teléfono</th>
                                            <th class="text-center">Estatura</th>
                                            <th class="text-center">Actualizar</th>
                                            <th class="text-center">Eliminar</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                        <tr>
                                            <td>Julio Ruiz</td>
                                            <td>10/05/2000</td>
                                            <td>Caba&ntilde;as</td>
                                            <td>Masculino</td>
                                            <td>7765-0987</td>
                                            <td>1.75 cm</td>
                                            
                                            
                                            <td><a href="#!" class="btn btn-warning btn-raised btn-xs" data-toggle="modal" data-target="#modalNuevo"><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="#!" class="btn btn-danger btn-raised btn-xs"  data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Ricardo Orellana</td>
                                            <td>10/09/1998</td>
                                           <td>Aguilares</td>
                                           <td>Masculino</td>
                                           <td>7832-1232</td>
                                           <td>1.69 cm</td>
                                            <td><a href="#!" class="btn btn-warning btn-raised btn-xs"data-toggle="modal" data-target="#modalNuevo"><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="#!" class="btn btn-danger btn-raised btn-xs"  data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Nelson Beltrán</td>
                                            <td>12/07/2000</td>
                                            <td>Chalatenango</td>
                                            <td>Masculino</td>
                                            <td>7655-0987</td>
                                            <td>1.70 cm</td>
                                          
                                            <td><a href="#!" class="btn btn-warning btn-raised btn-xs"data-toggle="modal" data-target="#modalNuevo"><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="#!" class="btn btn-danger btn-raised btn-xs"  data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>
                                
                            </div>

                             <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Jugador</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                       <div class="form-group label-floating">
                                              <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" class="form-control" id="exampleInputNombre" placeholder="Ingrese nombre su nombre">
                     
                                            </div>
                                            <div class="form-group">
                    <label>Fecha Nacimiento:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div><!-- /.input group -->
                  </div>
                                            <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Direcci&oacute;n:</label>
                <div class="col-sm-12">
      
                <textarea id="direccion" name="direccion" class="form-control" maxlength="250" onKeyDown="cuenta()" onKeyUp="cuenta()">&nbsp;</textarea>
                </div>
                </div>
                                            <label>G&eacute;nero:</label>
                     <div class="form-group">
                      <div class="radio">
                        <label>
                          &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                          Masculino
                          &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;
                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                          Femenino
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                    <label>T&eacute;lefono:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input type="text" class="form-control" data-inputmask="'mask': ['9999-9999 []', '+099 99 99 9999[9]-9999']" data-mask>
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Estatura</label>
                      <input type="text" class="form-control" id="exampleInputNombre" placeholder="Ingrese su estatura">
                    </div>  
                     <div class="form-group">
                      <label for="exampleInputFile">Foto</label>
                      <input type="file" id="exampleInputFile">
                      
                    </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


                            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Jugador</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar jugador?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </section><!-- /.content -->

  </div>