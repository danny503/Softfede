<template>
       <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
                             <div class="card-header">
                            <i class="fa fa-align-justify"></i> Cargo de Cuerpo Técnico
                            <button type="button" @click="abrirModal('tipo','registrar')" class="btn btn-primary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                       </button>
                   </div>

                       <div class="card-header">
          <div class="form-group row">
                                <div class="col-md-6">
                                    <div >
                                        <select class=" col-md-3" id="opcion" name="opcion">
                                            <option value="nombre">Nombre del cargo</option>
                                        </select>
                                        <input type="text" id="texto" name="texto"  placeholder="Buscar">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

                                    </div>
                                </div>
                            </div>
                          </div>

                      <div class="tab-pane " id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center list-group-item-success">#</th>
                                            <th class="text-center list-group-item-success">Nombre del cargo de cuerpo técnico</th>
                                            <th class="text-center list-group-item-success">Estado</th>
                                            <th class="text-center list-group-item-success">Actualizar</th>
                                            <th class="text-center list-group-item-success">Eliminar</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                       <tr v-for="tipo in arrayTipo" :key="tipo.id">
                                            <td>1</td>
                                            <td v-text="tipo.nombre"></td>
                                            <div v-if="tipo.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                            <td><a href="#" class="btn btn-warning btn-raised btn-xs" @click="abrirModal('tipo','actualizar',tipo)" ><i class="fa fa-pencil"></i></a></td>
                                         <template v-if="tipo.condicion">
                                            <td><a href="#" @click="desactivarTipo(tipo.id)" class="btn btn-danger btn-raised btn-xs"><i class="fa fa-trash"></i></a></td>   
                                        </template>
                                        <template v-else>
                                            <td><a href="#" @click="activarTipo(tipo.id)" class="btn btn-success btn-raised btn-xs"><i class="fa fa-check"></i></a></td>                                        
                                        </template>
                                        </tr>                                         
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        </div>
          <ol class="breadcrumb" style=" margin-left: 10%; max-width: 100%; margin-right: 10%;">
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- SELECT2 EXAMPLE -->
              <div class="modal fade" tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                             <button type="button" class="close"  @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre del cargo de Cuerpo Técnico</label>
                                    <div class="col-md-9">
                                        <input type="text"  v-model="nombre" class="form-control" placeholder="Ingrese el nombre del cargo">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                  <div v-show="errorTipo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjTipo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                           <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTipo()">Guardar</button>
                           <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTipo()">Actualizar</button>
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
                tipo_id: 0,
                nombre : '',
                arrayTipo : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorTipo :0,
                errorMostrarMsjTipo : []
            }
        },
        methods : {
            listarTipo(){
                    let me=this;
                    axios.get('/tipo').then(function (response) {
                    me.arrayTipo = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });

            },
            registrarTipo(){

                if(this.validarTipo()){
                    return;
                }
                  let me=this;
                    axios.post('/tipo/registrar',{
                        'nombre': this.nombre,
                    }).then(function (response) {
                        me.cerrarModal();
                        me.listarTipo();
                    })
                    .catch(function (error) {
                    console.log(error);
                });
            },
              actualizarTipo(){
                if (this.validarTipo()){
                    return;
                }
                
                let me = this;

                axios.put('/tipo/actualizar',{
                    'nombre': this.nombre,
                    'id': this.tipo_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarTipo();
                }).catch(function (error) {
                    console.log(error);
                }); 

            },
                 desactivarTipo(id){
               swal({
                title: 'Esta seguro de desactivar esta categoría?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/tipo/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarTipo();
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
              activarTipo(id){
               swal({
                title: 'Esta seguro de activar este sede?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/tipo/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarTipo(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarTipo(){
                this.errorTipo=0;
                this.errorMostrarMsjTipo=[];

                if(!this.nombre) this.errorMostrarMsjTipo.push("El nombre del tipo no puede quedar vacio.");

                if(this.errorMostrarMsjTipo.length) this.errorTipo=1;
                return this.errorTipo;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal='';
                this.nombre='';
            },

            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "tipo":
                    {
                        switch(accion)
                        {
                             case "registrar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Resgistrar tipo';
                                this.nombre= '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar  tipo';
                                this.tipoAccion = 2;
                                this.tipo_id = data['id'];
                                this.nombre= data['nombre'];
                                break;
                            }
                        }
                      

                    }
                }
            }

        },
        mounted() {
            this.listarTipo();
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
