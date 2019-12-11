<template>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Titulo principal</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
          <!-- SELECT2 EXAMPLE -->
             
            <div class="col-xs-9 col-md-10" >

 			<div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Planilla de juego</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                      <div class="form- col-md-3">
                  <div class="form-group">
                    <label>Equipos</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">Equipo A</option>
                      <option>Equipo B</option>
                      
                    </select>
                  </div>                
                </div>
                <div class="form- col-md-1 ">
                  <div class="form-group">
                    <label>Periodo</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>
                  </div>                
                </div>    
              </div><!-- /.row -->
                  <div class="row">
            <div class="col-md-6">
                
                  <table id="" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Nº camisa</th>
                        <th>Nombre</th>
                        <th>Faltas</th> 
                        <th>Opciones</th>                       
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
              
                      <tr>
                        <td>1</td>
                        <td>Adonay Pérez</td>
                        <td> <input type="number" value="0" step="any" class="form-control" v-model="precio"></td>
                         <td>
                         <button type="button" @click="abrirModal('articulo','actualizar',articulo)" class="btn btn-warning btn-sm">
                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarArticulo(articulo.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"   @click="activarArticulo(articulo.id)">
                               <i class="icon-check"></i>
                            </button>
                         </td>
                        <td>10</td>
                      </tr>

                      <tr>
                        <td>1</td>
                        <td>Adonay Pérez</td>
                        <td> <input type="number" value="0" step="any" class="form-control" v-model="precio"></td>
                         <td>
                         <button type="button" @click="abrirModal('articulo','actualizar',articulo)" class="btn btn-warning btn-sm">
                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarArticulo(articulo.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"   @click="activarArticulo(articulo.id)">
                               <i class="icon-check"></i>
                            </button>
                         </td>
                        <td>10</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
                  <div class="col-md-6">
                
                  <table id="" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Nº</th>
                        <th>Nombre</th>
                        <th>Faltas</th> 
                        <th>Opciones</th>                       
                        <th>Nº camisa</th>
                     </tr>
                    </thead>
                    <tbody> 
                     <tr>
                        <td>1</td>
                        <td>Adonay Pérez</td>
                        <td> <input type="number" value="0" step="any" class="form-control" v-model="precio"></td>
                         <td>
                         <button type="button" @click="abrirModal('articulo','actualizar',articulo)" class="btn btn-warning btn-sm">
                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarArticulo(articulo.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm"   @click="activarArticulo(articulo.id)">
                               <i class="icon-check"></i>
                            </button>
                         </td>
                        <td>10</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
                  <br><br>
                  <table id="" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Primer juez</th>
                        <th>Segundo juez</th>
                        <th>Tercer juez</th>
                        </tr>
                    </thead>
                    <tbody>                                          
                      <tr>
                        <td>Roberto Menjivar</td>
                        <td>Miguel Pérez</td>
                        <td>Oscar Pineda</td>
                      </tr>                                              
                    </tbody>
                    <tfoot>                     
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Punteo progresivo</h3>
                </div>
                <div class="box-body">
               <div class="row">
                      <div class="form- col-md-3">
                  <div class="form-group">
                    <label>Equipos</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">Equipo A</option>
                      <option>Equipo B</option>
                      
                    </select>
                  </div>                
                </div>
                <div class="form- col-md-1">
                  <div class="form-group">
                    <label>Periodo</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>
                  </div>                
                </div>   
              </div><!-- /.row -->
                  <div class="box-body">
                  <table id="" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>N&uacute;mero de camisa</th>
                        <th>Canastas</th>
                        <th>N&uacute;mero de partido</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                      
                      <tr>
                        <td><input type="text" style="max-width: 20%;" id="camisa"></td>
                        <td><input type="text" style="max-width: 20%;" id="canasta"></td>
                        <td><input type="text" style="max-width: 20%;" id="partido"></td>
                      </tr>
                    </tbody>
                    <tfoot>
                     
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
                 
                      <label for="exampleInputPuntos">Total de puntos</label>
                      <input type="text" style="max-width: 10%;" id="exampleInputPuntos">
                  

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div>
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div>
</template>