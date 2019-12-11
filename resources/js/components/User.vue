<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
                <div class="card-header">
                            <i class="fa fa-align-justify"></i> Usuarios
                            <button type="button" class="btn btn-primary" @click="abrirModal('persona','registrar')" >
                            <i class="icon-plus"></i>&nbsp;Nuevo
                       </button>
                 </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="num_documento">Documento</option>
                                      <option value="email">Email</option>
                                      <option value="telefono">Teléfono</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>                   
                      <div class="tab-pane " id="">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                    <th>Nombre</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Genero</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Estado</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                     <tr v-for="persona in arrayPersona" :key="persona.id">
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="persona.fechanac"></td>
                                    <td v-text="persona.genero"></td>
                                    <td v-text="persona.direccion"></td>
                                    <td v-text="persona.telefono"></td>
                                    <td v-text="persona.email"></td>
                                    <td v-text="persona.usuario"></td>
                                    <td v-text="persona.rol"></td>
                                             <td><a href="#" @click="abrirModal('persona','actualizar',persona)" class="btn btn-primary btn-raised btn-xs"><i class="fa fa-pencil"></i></a></td>                                        
                                        <template v-if="persona.estado">
                                            <td><a href="#" @click="desactivarUsuario(persona.id)" class="btn btn-danger btn-raised btn-xs"><i class="fa fa-trash"></i></a></td>   
                                        </template>
                                        <template v-else>
                                            <td><a href="#" @click="activarUsuario(persona.id)" class="btn btn-success btn-raised btn-xs"><i class="fa fa-check"></i></a></td>                                        
                                        </template>
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
              <!--Inicio del modal agregar/actualizar-->
          <div class="modal fade" :class="{'mostrar' : modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la persona">                                                                              
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                     <div class="col-md-9">
                                        <input type="date" v-model="fechanac" class="form-control" placeholder="Nombre de la persona">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Genero</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="genero">
                                            <option value="" disabled>Seleccione su genero</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Masculino">Maculino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Dirección</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Dirección">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Teléfono</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" data-inputmask="'mask': ['9999-9999 []', '+099 99 99 9999[9]-9999']" data-mask v-model="telefono">
                                        <span v-if="errors.telefono" class="badge badge-danger">{{errors.telefono[0]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Email">
                                        <span v-if="errors.email" class="badge badge-danger">{{errors.email[0]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Rol</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idrol">
                                            <option value="0" disabled>Seleccione un rol</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre">

                                            </option>
                                        </select>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Usuario (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" class="form-control" placeholder="Nombre de usuario">
                                        <span v-if="errors.usuario" class="badge badge-danger">{{errors.usuario[0]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Password (*)</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="Password de acceso">
                                        <span v-if="errors.password" class="badge badge-danger">{{errors.password[0]}}</span>
                                    </div>
                                </div>

                                    <div v-show="errorPersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
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
        data (){
            return{
                persona_id : 0,              
                nombre : '',
                fechanac : '',
                genero : '',
                direccion : '',
                telefono : '',
                email : '',
                usuario : '',
                password : '',
                idrol : 0,
                arrayPersona : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errors :[],
                errorPersona : 0,
                errorMostrarMsjPersona : [],
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
                buscar : ''
                
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarPersona (page,buscar,criterio){
                let me=this;
                var url= '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRol(){
                let me=this;
                var url= '/rol/selectRol';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPersona(page,buscar,criterio);
            },
            registrarPersona(){
               if (this.validarPersona()){
                    return;
                }
               this.errors = []
                
                let me = this;

                axios.post('/user/registrar',{
                    'nombre': this.nombre,
                    'fechanac': this.fechanac,
                    'genero' : this.genero,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol' : this.idrol

                }).then(response => {  
                     this.telefono=''               
                     this.email=''
                     this.usuario=''
                     this.password=''
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');

                    
                }).catch(error => {
                    if (error.response.status == 422){
                        this.errors = error.response.data.errors
                    }
                    //console.log(error);
                });
            },
            actualizarPersona(){
               if (this.validarPersona()){
                    return;
                }
                this.errors = []
                
                let me = this;

                axios.put('/user/actualizar',{
                    'nombre': this.nombre,
                    'fechanac': this.fechanac,
                    'genero' : this.genero,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'usuario': this.usuario,
                    'password': this.password,
                    'idrol' : this.idrol,
                    'id': this.persona_id
                 }).then(response => {  
                     this.telefono=''               
                     //this.email=''
                     this.usuario=''
                     this.password=''
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');

                    
                }).catch(error => {
                    if (error.response.status == 422){
                        this.errors = error.response.data.errors
                    }
                    //console.log(error);
                });
            },            
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                //if (!this.nombre) this.errorMostrarMsjPersona.push("El nombre de la persona no puede estar vacío.");
                //if (!this.usuario) this.errorMostrarMsjPersona.push("El nombre de usuario no puede estar vacío.");
                if (this.idrol==0) this.errorMostrarMsjPersona.push("Debes seleccionar un rol para el usuario.");
                //if (!this.password) this.errorMostrarMsjPersona.push("El password no puede estar vacío.");               

                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.fechanac='';
                this.genero='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.usuario='';
                this.password='';
                this.idrol=0;
                this.errorPersona=0;

            },
            abrirModal(modelo, accion, data = []){
                this.selectRol();
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Usuario';
                                this.nombre= '';
                                this.fechanac='';
                                this.genero='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.usuario='';
                                this.password='';
                                this.idrol=0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Usuario';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.nombre = data['nombre'];
                                this.fechanac = data['fechanac'];
                                this.genero = data['genero'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.email = data['email'];
                                this.usuario = data['usuario'];
                                this.password = data['password'];
                                this.idrol = data['idrol'];
                                break;
                            }
                        }
                    }
                }
            },
            desactivarUsuario(id){
               swal({
                title: 'Esta seguro de desactivar este usuario?',
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

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
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
            activarUsuario(id){
               swal({
                title: 'Esta seguro de activar este usuario?',
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

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
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
            }
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
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
