<template>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
                             <div class="card-header">
                            <i class="fa fa-align-justify"></i> Cuerpo Tecnico
                            <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-primary">
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
                                        <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" placeholder="Buscar">
                                        <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i></button>

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
                                            <th class="text-center list-group-item-success">Fecha de nacimiento</th>
                                            <th class="text-center list-group-item-success">Genero</th>
                                             <th class="text-center list-group-item-success">Direccion</th>
                                             <th class="text-center list-group-item-success">Telefono</th>
                                              <th class="text-center list-group-item-success">Email</th>
                                              <th class="text-center list-group-item-success">Cargo</th>
                                            <th class="text-center list-group-item-success">Actualizar</th>
                                            <th class="text-center list-group-item-success">Eliminar</th>
                                        </tr>
                                    </thead>

                                   <tbody>
                                        <tr v-for="persona in arrayPersona" :key="persona.id">
                                    <td>1</td>
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="persona.fechanac"></td>
                                    <td v-text="persona.genero"></td>
                                    <td v-text="persona.direccion"></td>
                                    <td v-text="persona.telefono"></td>
                                    <td v-text="persona.email"></td>
                                    <td v-text="persona.cargo"></td>
                                    <td><a href="#!" class="btn btn-warning btn-raised btn-xs" @click="abrirModal('persona','actualizar',persona)" ><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="fa fa-trash"></i></a></td>
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
                                    <label class="col-md-3                                                                                                                                                                                                              form-control-label" for="text-input">Nombre (*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de la persona">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de nacimiento  (*)</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="fechanac" class="form-control" placeholder="fecha de nacimiento de la persona">
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
                                        <input type="text" v-model="telefono" class="form-control" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="cargo">
                                            <option value="" disabled>Seleccione el tipo</option>
                                            <option value="Arbitro_mesa">Arbitro de mesa</option>
                                            <option value="Arbitro_Cancha">Arbitro de cancha</option>
                                        </select>
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
      </div>
    </template>
    <script>
    export default {
        data (){
            return{
                persona_id: 0,
                nombre : '',
                fechanac : '',
                genero : '',
                direccion : '',
                telefono : '',
                email : '',
                cargo : '',

                arrayPersona : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
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
                var url= '/arbitro?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
                    me.pagination= respuesta.pagination;
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
                let me = this;
                axios.post('/arbitro/registrar',{
                    'nombre': this.nombre,
                    'fechanac': this.fechanac,
                    'genero' : this.genero,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'cargo': this.cargo

                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarPersona(){
               if (this.validarPersona()){
                    return;
                }

                let me = this;

                axios.put('/arbitro/actualizar',{
                    'nombre': this.nombre,
                    'fechanac': this.fechanac,
                    'genero' : this.genero,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'cargo': this.cargo,

                    'id': this.persona_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                if (!this.nombre) this.errorMostrarMsjPersona.push("El nombre de la persona no puede estar vacío.");
                if (this.cargo ==0) this.errorMostrarMsjPersona.push("Debes seleccionar un cargo");
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
                this.cargo=0,

                this.errorPersona=0;

            },
            abrirModal(modelo, accion, data = []){
               // this.selectTipo();
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Árbitro';
                                this.nombre= '';
                                this.fechanac='';
                                this.genero='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.cargo=0,

                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Árbitro';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.nombre = data['nombre'];
                                this.fechanac = data['fechanac'];
                                this.genero = data['genero'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.email = data['email'];
                                this.cargo = data['cargo'];

                                break;
                            }
                        }
                    }
                }
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
