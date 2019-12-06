<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
                             <div class="card-header">
                            <i class="fa fa-align-justify"></i> Categorias
                            <button type="button" class="btn btn-primary" @click="abrirModal('categoria','registrar')" >
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
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Descripcion</th>
                                            <th class="text-center">Update</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    
                                   <tbody>

                                        <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                            <td>{{  $i }}</td>
                                            <td v-text="categoria.nombre"></td>
                                            <td v-text="categoria.descripcion"></td>
                                            
                                            <td><a href="#!" class="btn btn-warning btn-raised btn-xs" @click="abrirModal('categoria','actualizar',categoria)" ><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="fa fa-trash"></i></a></td>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Descripcion de categoría">
                                      
                                    </div>
                                </div>
                                <div v-show="errorCategoria" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCategoria()">Actualizar</button>
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
                categoria_id: 0,
                nombre : '',
                descripcion : '',
                arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorCategoria :0,
                errorMostrarMsjCategoria : []
            }
        },
        methods : {
            listarCategoria(){
                    let me=this;
                    axios.get('/categoria').then(function (response) {
                    me.arrayCategoria = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });

            },
            registrarCategoria(){

                if(this.validarCategoria()){
                    return;
                }
                  let me=this;
                    axios.post('/categoria/registrar',{
                        'nombre': this.nombre,
                        'descripcion': this.descripcion
                    }).then(function (response) {
                        me.cerrarModal();
                        me.listarCategoria();
                    })
                    .catch(function (error) {
                    console.log(error);
                });
            },
            actualizarCategoria(){
                if (this.validarCategoria()){
                    return;
                }
                
                let me = this;

                axios.put('/categoria/actualizar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id': this.categoria_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria();
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
                                this.tituloModal = 'Actualizar  Categoria';
                                this.tipoAccion = 2;
                                this.categoria_id = data['id'];
                                this.nombre= data['nombre'];
                                this.descripcion = data['descripcion'];

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
