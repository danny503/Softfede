<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
                             <div class="card-header">
                            <i class="fa fa-align-justify"></i> actualizar
                            <button type="button" class="btn btn-primary" @click="abrirModal('update','registrar')" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                       </button>
                   </div>

                       <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" id="opcion" name="opcion">
                                            <option value="producto">Nombre</option>
                                            <option value="codigo">Descripción</option>
                                        </select>
                                        <input type="text" id="texto" name="texto" class="form-control" placeholder="Buscador">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                        
                        <li><a href="#list" data-toggle="tab">List</a></li>
                    </ul>
                      <div class="tab-pane " id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                   <thead>
                                        <tr>
                                            <th>jugador</th>
                                            <th>numero de camisa</th>
                                            <th>posicion</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                            <td v-text="detalle.persona">
                                            </td>
                                            <td v-text="detalle.numero_camisa">
                                            </td>
                                            <td v-text="detalle.posicion">
                                            </td>
                                            <td><a href="#!" class="btn btn-warning btn-raised btn-xs" @click="abrirModal('equipo','actualizar', detalle)" ><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="#!" class="btn btn-danger btn-raised btn-xs" v-on:click.prevent="eliminarJugador(detalle)"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay jugadores agregados al equipo
                                            </td>
                                        </tr>
                                    </tbody>                                 <thead>
                                        <tr>
                                            <th>jugador</th>
                                            <th>numero de camisa</th>
                                            <th>posicion</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                            <td v-text="detalle.persona">
                                            </td>
                                            <td v-text="detalle.numero_camisa">
                                            </td>
                                            <td v-text="detalle.posicion">
                                            </td>
                                            <td><a href="#!" class="btn btn-warning btn-raised btn-xs" @click="abrirModal('equipo','actualizar', detalle)" ><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="#!" class="btn btn-danger btn-raised btn-xs" v-on:click.prevent="eliminarJugador(detalle)"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay jugadores agregados al equipo
                                            </td>
                                        </tr>
                                    </tbody>                                 
                                </table>
                                
                            </div>
                        </div>                                                
                    </div>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- SELECT2 EXAMPLE -->                   
              <div class="modal fade" tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close"  @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">jugador</label>
                                    <div class="col-md-9">
                                        
                                        <label class="badge badge-success" v-text="persona"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">numero de camisa</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="numero_camisa" class="form-control" >
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">posicion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="posicion" class="form-control" placeholder="Descripcion de categoría">
                                      
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarDetalle()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
</template>

<script>
    export default {
        data(){
            return {
                update_id: 0,
                persona : '',
                numero_camisa : '',
                posicion:'',
                arrayDetalle : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                id:0
                
            }
        },
        methods : {
            listarCategoria(){
                    let me=this;
                     //obtener datos de los detalles
                 var url= '/equipo/obtenerDetalles';
                  
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayUpdate= respuesta.detalles;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });

            },
            
            actualizarCategoria(){
               
                let me = this;

                axios.put('/inscripcionej/actualizar',{
                    'idjugador': this.idjugador,
                    'numero_camisa': this.numero_camisa,
                    'posicion' : this.posicion,
                    
                    'id': this.update_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });  

            },
            validarCategoria(){
                this.errorCategoria=0;
                this.errorMostrarMsjCategoria=[];

                if(!this.nombre) this.errorMostrarMsjCategoria.push("El nombre de la categoria no puede quedar vacio.");

                if(this.errorMostrarMsjCategoria.length) this.errorCategoria=1;
                return this.errorCategoria;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },

            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion)
                        {
                             case "registrar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Resgistrar Categoria';
                                this.nombre= '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                           case "actualizar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar';
                                this.tipoAccion = 2;
                                this.update_id = data['id'];
                                this.numero_camisa= data['numero_camisa'];
                                this.posicion = data['posicion'];
                                this.persona = data['persona'];

                                break;
                            }
                        }
                      

                    }
                }
            }

        },
        mounted() {
            this.listarCategoria();
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;

    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
