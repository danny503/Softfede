<template>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
                             <div class="card-header">
                            <i class="fa fa-align-justify"></i> Equipos
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
                                            <option value="cargo">Categoria</option>
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
                                            <th class="text-center list-group-item-success">Categoria</th>
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
                                            <td v-text="equipo.nombre_categoria"></td>
                                             <td >                     
                                                 <img :src="'images/' + equipo.logo" alt="Logo del equipo" width="75" height="75">
                                            </td>                                            
                                            <td><a href="#!" @click="abrirModal('equipo','actualizar',equipo)" class="btn btn-primary btn-raised btn-xs"><i class="fa fa-pencil"></i></a></td>
                                            
                                            <button type="button" class="btn btn-danger btn-sm" @click="eliminarEquipo(equipo)">
                                                <i class="fa fa-trash"></i>
                                            </button>                                     
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
                            <form id="myForm" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idcategoria">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>                               
                                <div class="form-group">
                                <label >Logo</label>
                                 <div>
                                <img :src="'images/' + logo" alt="Foto de equipo" width="75" height="75"> 
                                </div> 
                                <input type="file" @change="obtenerImagen" />
                                <span v-if="errors.logo" class="badge badge-danger">{{errors.logo[0]}}</span>
                                </div>
                                <figure v-if="mostrarImagen == 1">
                                   <img :src="imagen" alt="Logo del equipo" width="75" height="75">
                                </figure>
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
                idcategoria:0,
                nombre_categoria:0,
                arrayCategoria: [],
                nombre : '',
                logo : '',
                arrayEquipo : [],
                equipo:{idrama:0,idcategoria:0,nombre:'',logo:''},
                imagenMiniatura: '',
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errors:[],
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
                arrayRama : [],
                mostrarImagen : null
                
            }
        },
        computed:{
            imagen(){
                return this.imagenMiniatura;
            },
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
            resetForm: function(e) {
            e.preventDefault()
            this.$data.logo = ""
        },
         myFunction() {
         document.getElementById("myForm").reset();
        },
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
            selectCategoria() {
            let me = this;
            var url = "/categoria/selectCategoria";
            axios
                .get(url)
                .then(function(response) {
                // console.log(response);
                var respuesta = response.data;
                me.arrayCategoria = respuesta.categorias;
                })
                .catch(function(error) {
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
             obtenerImagen(e){ 
                let file = e.target.files[0];
                //console.log(file);
                this.logo = file;
                this.cargarImagen(file);
                this.file='';                
                },
                cargarImagen(file){
                let reader = new FileReader();
                reader.onload = (e) =>{
                    this.mostrarImagen = 1;
                    this.imagenMiniatura = e.target.result;
                }
                reader.readAsDataURL(file);
                },
            registrarEquipo(){
            let me = this;
            this.errors = []
            //this.logo = '';
            let formData = new FormData();
            formData.append('nombre',this.nombre);
            formData.append('idrama',this.idrama);
            formData.append('idcategoria',this.idcategoria);
            formData.append('logo',this.logo);
                axios.post("/equipo/registrar",formData)
                .then(response=>{
                me.cerrarModal();
                me.listarEquipo(1, "", "nombre");
                //console.log(response.data);
                this.imagenMiniatura='';
                this.logo='';
                this.file='';
                 
                }).catch(error => {
                            if (error.response.status == 422){
                                this.errors = error.response.data.errors
                            }
                            //console.log(error);
                        });
                        //this.logo=''; 
            },
         actualizarEquipo(){
            this.errors = []
            let me = this;  
            this.imagenMiniatura='';    
            let formData = new FormData();
            formData.append('id',this.equipo_id);
            formData.append('nombre',this.nombre);
            formData.append('idrama',this.idrama);  
            formData.append('idcategoria',this.idcategoria);         
            formData.append('logo',this.logo);

                axios.post("/equipo/actualizar",formData)
                .then(function(response){
                me.cerrarModal();
                me.listarEquipo(1, "", "nombre");
                swal(
                        "Actualizado!",
                        "Se ha actualizado con éxito.",
                        "success"
                    );
                //console.log(response.data);  
                })
            },
           eliminarEquipo(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
               swal({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
                }).then((result) => {
                let me =this;
                let equipo_id= data.id
                if (result.value) {                    
                axios.delete('/equipo/borrar/'+equipo_id
                    ).then(function (response) {
                        me.listarEquipo(1,'','nombre');
                         swal(
                        'Eliminado!',
                        'Se ha eliminado el equipo.',
                        'success'
                    )
                    })                                        
                     .catch(function (error) {
                        console.log(error);
                    });
                }
                })
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
                this.idcategoria=0,
                this.nombre_categoria='',
                this.nombre_rama='',
                this.nombre='';
                this.imagenMiniatura='';
                this.logo='';
                this.file='';
                this.mostrarImagen = 0;
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
                        this.idcategoria=0,                        
                        this.nombre_rama ='',
                        this.nombre_categoria='',
                        this.nombre ='';
                        this.imagenMiniatura = '';
                        this.mostrarImagen = 0;
                        this.file='';                        
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
                        this.idcategoria=data['idcategoria'];
                        this.nombre = data['nombre'];
                        this.imagenMiniatura = '';
                        this.mostrarImagen = 0;                        
                        this.logo = data["logo"];
                        break;
                    }
                }
             }

            }
            this.selectRama(),
            this.selectCategoria()
         }
               
    },
        mounted() {
            this.listarEquipo(1,this.buscar,this.criterio);
            this.selectCategoria();
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