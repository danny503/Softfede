<template>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
                             <div class="card-header">
                            <i class="fa fa-align-justify"></i> EquiposXenia Mi Amor
                            <button type="button" @click="abrirModal('equipo','registrar')" class="btn btn-primary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                       </button>
                   </div>

                       <div class="card-header">
          <div class="form-group row">
                                <div class="col-md-6">
                                    <div >
                                        <select class=" col-md-3" v-model="criterio">
                                            <option value="nombre">Nombre</option>
                                            <option value="cargo">Cargo</option>
                                        </select>
                                        <input type="text" v-model="buscar" @keyup.enter="listarEquipo(1,buscar,criterio)" placeholder="Buscar">
                                        <button type="submit" @click="listarEquipo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i></button>

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
                                            <th class="text-center list-group-item-success">Nombre</th>
                                            <th class="text-center list-group-item-success">Rama</th>
                                            <th class="text-center list-group-item-success">Logo</th>
                                            <th class="text-center list-group-item-success">Actualizar</th>
                                            <th class="text-center list-group-item-success">Eliminar</th>
                                        </tr>
                                    </thead>
                             
                                   <tbody>
                                        <tr v-for="equipo in arrayEquipo" :key="equipo.id">
                                            <td >1</td>
                                            <td v-text="equipo.nombre"></td>
                                            <td v-text="equipo.nombre_rama"></td>
                                            <td v-text="equipo.logo"></td>
                                            
                                            <td><a href="#!" @click="abrirModal('equipo','actualizar',equipo)" class="btn btn-primary btn-raised btn-xs"><i class="fa fa-pencil"></i></a></td>
                                            <template v-if="equipo.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarEquipo(equipo.id)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </template>
                                          <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarEquipo(equipo.id)">
                                                <i class="icon-ok"></i>
                                            </button>
                                        </template>
                                        </tr>                                                                            
                                    </tbody>
                                </table>
                                       <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                         <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant  </a> 
                                    </li> 
                                    <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                      <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                     </li>                                  
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page" >
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"> Sig </a>
                                    </li>
                                </ul>
                            </div>
                        </div>                       
                    </div>
          <ol class="breadcrumb" style=" margin-left: 10%; max-width: 100%; margin-right: 10%;">          
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- SELECT2 EXAMPLE -->                   
              <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                               <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Rama</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idrama">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="rama in arrayRama" :key="rama.id" :value="rama.id" v-text="rama.nombre"></option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Cantidad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="logo" class="form-control" placeholder="Cantidad de jugadores">
                                    </div>
                                </div>
                          <div class="form-group">
                                <label for="exampleInputFile">Logo</label>
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="file" id="exampleInputFile">
                          </div>
                          <div v-show="errorEquipo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEquipo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEquipo()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEquipo()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </section><!-- /.content -->
      </div>
    </template>
    <script>
    export default {
        data (){
            return{
                equipo_id : 0,
                idrama : 0,
                nombre_rama : 0,
                nombre : '',
                logo : '',
                arrayEquipo : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorEquipo : 0,
                errorMostrarMsjEquipo : [],
                pagination : {
                'total' : 0,      
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,        
                'to' : 0,   
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayRama : []
                
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                    if(from < 1){
                        from = 1;
                    }
                var  to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }   
                var pagesArray = [];
                while( from <= to){
                    pagesArray.push(from);
                    from++;
                } 
                return pagesArray;
            }
        },
        methods :{
            listarEquipo(page,buscar,criterio){
                let me=this;
                var url = '/equipo?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayEquipo = respuesta.equipos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });                        
            },
            selectRama(){
                 let me=this;
                var url = '/rama/selectRama';
                axios.get(url).then(function (response) {
                   // consolo.log(response);
                    var respuesta= response.data;
                    me.arrayRama = respuesta.ramas;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });     
            },
            cambiarPagina(page,buscar,criterio){
                let me = this; 
                //actualiza la pagina actual
                me.pagination.current_page = page;
                me.listarEquipo(page,buscar,criterio);

            },
            registrarEquipo(){
                if (this.validarEquipo()){
                    return;
                }
                
                let me = this;

                axios.post('/equipo/registrar',{
                    'idrama': this.idrama,
                    'nombre': this.nombre,
                    'logo': this.logo
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEquipo(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });

            },
              actualizarEquipo(){
               if (this.validarEquipo()){
                    return;
                }
                
                let me = this;

                axios.put('/equipo/actualizar',{
                    'idrama': this.idrama,
                    'nombre': this.nombre,
                    'logo': this.logo,
                    'id': this.equipo_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEquipo(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
             desactivarEquipo(id){
               swal({
                title: 'Esta seguro de desactivar este equipo?',
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

                    axios.put('/equipo/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEquipo(1,'','nombre');
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
            activarEquipo(id){
               swal({
                title: 'Esta seguro de activar este equipo?',
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

                    axios.put('/equipo/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEquipo(1,'','nombre');
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
               validarEquipo(){
                this.errorEquipo=0;
                this.errorMostrarMsjEquipo =[];
                if (this.idrama==0) this.errorMostrarMsjEquipo.push("Selecciones una rama.");
                if (!this.nombre) this.errorMostrarMsjEquipo.push("El nombre del equipo no puede estar vacío.");

                if (this.errorMostrarMsjEquipo.length) this.errorEquipo = 1;

                return this.errorEquipo;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal='';
                this.idrama=0,
                this.nombre_rama='',
                this.nombre='';
                this.logo='';
                this.errorEquipo=0
            },

            abrirModal(modelo, accion, data = []){
                switch(modelo){
                     case "equipo":
                {
                switch(accion){
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal ="Registrar equipo";
                        this.idrama=0,
                        this.nombre_rama ='',
                        this.nombre ='';
                        this.logo='';
                        this.tipoAccion = 1;
                        break;
                    }
                    case 'actualizar':
                    {
                        //console.log(data);
                        this.modal=1;
                        this.tituloModal='Actualizar equipo';
                        this.tipoAccion=2;
                        this.equipo_id=data['id'];
                        this.idrama=data['idrama'];
                        this.nombre = data['nombre'];
                        this.logo = data["logo"];
                        break;
                    }
                }
             }

            }
            this.selectRama()
         }
               
    },
        mounted() {
            this.listarEquipo(1,this.buscar,this.criterio);
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