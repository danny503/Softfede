<template>
        <!-- Content Header (Page header) -->
        <section class="content-header">          
                     
  <div class="content-wrapper">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Escritorio</a>
      </li>
    </ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Inscripcion
          <button
            type="button" @click="mostrarDetalle('torneo', 'registrar')" class="btn btn-secondary" >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <!--Listado -->
        <template v-if="listado==1">
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <select class="form-control col-md-3" v-model="criterio">
                  <option value="nombre">nombre</option>
                </select>
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarTorneo(1,buscar,criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarTorneo(1,buscar,criterio)"
                  class="btn btn-primary"
                >
                  <i class="fa fa-search"></i> Buscar
                </button>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
              <thead>
                <tr>
                  <th class="text-center list-group-item-success">Opciones</th>
                  <th class="text-center list-group-item-success">Nombre</th>
                  <th class="text-center list-group-item-success">Categoria</th>
                  <th class="text-center list-group-item-success">Fecha inicio</th>
                  <th class="text-center list-group-item-success">Fecha fin</th>
                  <th class="text-center list-group-item-success">Estado</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="torneo in arrayTorneo" :key="torneo.id">
                  <td>
                         <button type="button" @click="verTorneo(torneo.id)" class="btn btn-success btn-sm">
                            <i class="fa fa-eye"></i>
                        </button> &nbsp;
                     <template v-if="torneo.estado">
                      <button type="button" class="btn btn-danger btn-sm" @click="desactivarTorneo(torneo.id)">
                        <i class="fa fa-trash"></i>
                       </button>
                  </template>                  
                  <template v-else>
                      <button type="button" class="btn btn-info btn-sm" @click="activarTorneo(torneo.id)">
                          <i class="fa fa-check"></i>
                      </button>
                  </template>&nbsp;
                  <button type="button" @click="abrirModal('torneo','actualizar',torneo)" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                   </button> &nbsp;
                   <button type="button" @click="pdfTorneo(torneo.id)" class="btn btn-info btn-sm">
                        <i class="fa fa-file"></i>
                    </button> 
                 </td>
                  <td v-text="torneo.nombre"></td>
                  <td v-text="torneo.nombre_categoria"></td>
                  <td v-text="torneo.fecha_inicio"></td>
                  <td v-text="torneo.fecha_fin"></td>
                 <td>
                     <div v-if="torneo.estado">
                         <span class="badge badge-success">Activo</span>
                     </div>
                     <div v-else>
                       <span class="badge badge-danger">Desactivado</span>
                    </div>                                  
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <nav>            
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                >Ant</a>
              </li>
              <li
                class="page-item"
                v-for="page in pagesNumber"
                :key="page"
                :class="[page == isActived ? 'active' : '']">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(page,buscar,criterio)"
                  v-text="page"
                ></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                >Sig</a>
              </li>
            </ul>
          </nav>
        </div>
        </template>
        <!--Fin Listado -->
        <!--Inicio Detalle -->
        <template v-else-if="listado==0">
        <div class="card-body">
          <div class="form-group row border">
            <div class="col-md-6">
              <label for>Nombre</label>
              <input type="text" class="form-control" v-model="nombre" />
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for>Categoria</label>
                 <select class="form-control" v-model="idcategoria">
                <option value="0" disabled>Seleccione una categoria</option>
                <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                 </select>
              </div>
            </div>
            
            <div class="col-md-4">
              <label for>Fecha inicio</label>
              <input type="date" class="form-control" v-model="fecha_inicio" />
            </div>
            <div class="col-md-4">
              <label for>Fecha fin</label>
              <input type="date" class="form-control" v-model="fecha_fin" />
            </div>
            <div class="col-md-12">
              <div v-show="errorTorneo" class="form-group row div-error">
                      <div class="text-center text-error">
                       <div v-for="error in errorMostrarMsjTorneo" :key="error" v-text="error">
                      </div>
                  </div>
             </div>
              </div>            
          </div>
          <div class="form-group row border">
              <div class="col-md-8">
                  <div class="form-group">
                      <label for="">Equipos <span style="color:red;" v-show="idequipo==0">(Seleccione)</span></label>
                      <div class="form-inline">
                          <input type="text" class="form-control" v-model="idequipo" placeholder="Ingrese equipos">
                          <button @click="abrirModal()" class="btn btn-primary">...</button>
                      </div>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="fa fa-plus"></i></button>
                  </div>
              </div>
          </div>          
          <div class="form-group row border">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-sm">
                      <thead>
                          <tr>
                          <th>Opciones</th>
                          <th>Equipo</th> 
                          </tr>                        
                      </thead>
                      <tbody v-if="arrayDetalle.length">
                          <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
                              <td>
                                  <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                      <i class="fa fa-close"></i>
                                  </button>
                              </td>
                              <td v-text="detalle.equipo" >
                              </td>                                                                                                                                                          
                          </tr>                          
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">
                          No hay equipos agregados
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
          </div>
          <div class="form=group row">
              <div class="col-md-12"> 
                  <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                  <button type="button" class="btn btn-primary" @click="registrarTorneo()">Registrar torneo</button>
              </div>
          </div>
        </div>
        </template>
        <!--Fin detalle -->
         <!--Ver torneo-->
                    <template v-else-if="listado==2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Nombre del torneo</label>
                                    <p v-text="nombre"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Categoria</label>
                                <p v-text="categoria"></p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha inicio</label>
                                    <input type="date" class="form-control" v-model="fecha_inicio" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha fin</label>
                                    <input type="date" class="form-control" v-model="fecha_fin" />
                                </div>
                            </div>                               
                        <div class="col-md-8">
                          <div class="form-group">
                            <label for="">Equipos <span style="color:red;" v-show="idequipo==0">(Seleccione)</span></label>
                              <div class="form-inline">
                                <input type="text" class="form-control" v-model="idequipo" placeholder="Ingrese equipos">
                                  <button @click="abrirModal()" class="btn btn-primary">...</button>
                              </div>
                          </div>
                        </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>                     
                    </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                          <th>Opciones</th>
                                            <th>Equipo</th>
                                            <th>Rama</th>
                                            <th>Categoria</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
                                           <button type="button" @click="eliminarDetalle(index)" class="btn btn-danger btn-sm">
                                              <i class="fa fa-close"></i>
                                           </button>
                                            <td v-text="detalle.equipo">
                                            </td>
                                            <td v-text="detalle.rama">
                                            </td>
                                            <td v-text="detalle.nombre_categoria"></td>
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay equipos agregados
                                            </td>
                                        </tr>
                                    </tbody>                                  
                                </table>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>                                
                                <button type="button" @click="insertEquipo()" class="btn btn-warning">Editar</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!--Fin ver torneo-->
                    <!--Ver detalle actuazalizar-->
                     <template v-else-if="listado==3">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Nombre del torneo</label>
                                    <p v-text="nombre"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Categoria</label>
                                <p v-text="categoria"></p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha inicio</label>
                                    <input type="date" class="form-control" v-model="fecha_inicio" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha fin</label>
                                    <input type="date" class="form-control" v-model="fecha_fin" />
                                </div>
                            </div>                               
                <div class="col-md-8">
                  <div class="form-group">
                      <label for="">Equipos <span style="color:red;" v-show="idequipo==0">(Seleccione)</span></label>
                      <div class="form-inline">
                          <input type="text" class="form-control" v-model="idequipo" placeholder="Ingrese equipos">
                          <button @click="abrirModal()" class="btn btn-primary">...</button>
                      </div>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="fa fa-plus"></i></button>
                  </div>
              </div>                     
                    </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                          <th>Opciones</th>
                                            <th>Equipo</th>
                                            <th>Rama</th>
                                            <th>Categoria</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
                                           <button type="button" @click="eliminarDetalle(index)" class="btn btn-danger btn-sm">
                                              <i class="fa fa-close"></i>
                                           </button>
                                            <td v-text="detalle.equipo">
                                            </td>
                                            <td v-text="detalle.nombre_rama">
                                            </td>
                                            <td v-text="detalle.nombre_categoria"></td>
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay equipos agregados
                                            </td>
                                        </tr>
                                    </tbody>                                  
                                </table>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle2()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" @click="actualizarTorneo1()" class="btn btn-primary">Guardar cambios</button>                                
                            </div>
                        </div>
                    </div>
               </template>                                        
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="form-group row">
              <div class="col-md-6">
                <div>
                  <select class="col-md-3" v-model="criterioJ">
                    <option value="nombre">Nombre</option>
                  </select>
                  <input type="text" v-model="buscarJ" @keyup.enter="listarEquipo(buscarJ,criterioJ)" placeholder="Buscar"/>
                  <button type="submit" @click="listarEquipo(buscarJ,criterioJ)" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responseve">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="text-center">Opciones</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Rama</th>
                    <th class="text-center">Categoria</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="equipo in arrayEquipo" :key="equipo.id">
                    <td>          
                      <button type="button" @click="agregarDetalleModal(equipo)" class="btn btn-success btn-sm">
                       <i class="fa fa-check"></i>
                      </button>
                      </td>
                    <td v-text="equipo.nombre"></td>
                    <td v-text="equipo.nombre_rama"></td>
                    <td v-text="equipo.nombre_categoria"></td>                                               
                  </tr>
                </tbody>               
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTorneo()">Guardar</button>
            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarTorneo()">Actualizar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
  </div>
    </section>
</template>

<script>
export default {
  data() {
    return {    
      idtorneo: 0,
      idrama: 0,
      idequipo:0,
      idcategoria:0,
      nombre_categoria: "",
      categoria:"",
      nombre: "",
      logo: "",
      equipo: "",
      fecha_inicio:"",
      fecha_fin:"",      
      arrayEquipo: [],
      arrayTorneo: [],
      arrayDetalle: [],
      listado:1,
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorTorneo: 0,
      errorMostrarMsjTorneo: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      criterio: "",
      buscar: "",
      criterioJ: 'nombre',
      buscarJ: '',
      arrayRama: [],
      arrayCategoria: []
    };
  },
  computed: {
    isActived: function() {
      return this.pagination.current_page;
    },
    //Calcula los elementos de la paginación
    pagesNumber: function() {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {
    listarTorneo(page, buscar, criterio){
        let me = this;
      var url =
        '/torneo?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayTorneo = respuesta.torneos.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    selectRama() {
      let me = this;
      var url = "/rama/selectRama";
      axios
        .get(url)
        .then(function(response) {
           console.log(response);
          var respuesta = response.data;
          me.arrayRama = respuesta.ramas;
        })
        .catch(function(error) {
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
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //actualiza la pagina actual
      me.pagination.current_page = page;
      me.listarTorneo(page, buscar, criterio);
    },
    registrarTorneo() {
      if (this.validarTorneo()) {
        return;
      }
      let me = this;
      axios.post('/torneo/registrar', {
          'nombre': this.nombre,
          'idcategoria': this.idcategoria,
          'fecha_inicio': this.fecha_inicio,
          'fecha_fin': this.fecha_fin,
          'data' : this.arrayDetalle         
        })
        .then(function(response) {
          me.listado=1;
          me.listarTorneo(1, '', 'nombre');
          me.idcategoria=0;
          me.nombre='';
          me.fecha_inicio='';
          me.fecha_fin='';
          me.idequipo=0;
          me.equipo='';
          me.arrayDetalle=[];
         // window.open('/torneo/pdf/'+ response.data.id);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    insertEquipo(){
      let me = this;
      console.log(this.idequipo, this.idtorneo)
      axios.post('/torneo/insertarEquipo',{
        'idequipo': this.idequipo,
        'idtorneo': this.idtorneo
      })
        .then(function(response){
          me.listarTorneo(1, '', 'nombre');
        })
        .catch(function(error){

        });              
    },    
    actualizarTorneo() {     
      let me = this;
      //console.log(response.data);
      axios.put("/torneo/actualizar",{          
          'nombre': this.nombre,
          'idcategoria': this.idcategoria,
          'fecha_inicio': this.fecha_inicio,
          'fecha_fin': this.fecha_fin,
          'data': this.arrayDetalle,
          'id': this.idtorneo          
        })
        .then(function(response) {
          me.cerrarModal();
          me.listado=1;
          me.listarTorneo(1, '', 'nombre');
          me.idcategoria=0;
          me.nombre='';
          me.fecha_inicio='';
          me.fecha_fin='';
          me.idequipo=0;
          me.equipo='';
          me.arrayDetalle=[];
          console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    validarTorneo() {
      this.errorTorneo = 0;
      this.errorMostrarMsjTorneo = [];

      if (!this.nombre) this.errorMostrarMsjTorneo.push("El nombre del torneo no puede estar vacío.");
      if (this.idcategoria==0) this.errorMostrarMsjTorneo.push("La categoria no puede estar vacío.");
      if(this.arrayDetalle.length<=0)this.errorMostrarMsjTorneo.push("Ingrese detalle");
      if (this.errorMostrarMsjTorneo.length) this.errorTorneo = 1;

      return this.errorTorneo;
    },
    mostrarDetalle(){
     
      let me = this;
      this.listado=0;
          me.idcategoria=0;
          me.nombre='';
          me.fecha_inicio='';
          me.fecha_fin='';
          me.idequipo=0;
          me.equipo='';
          me.arrayDetalle=[];
    },
    ocultarDetalle(){
      this.listado=1;
    },

     ocultarDetalle2(){
      this.listado=2;
    },

    encuentra(id){
      var sw=0;
      for(var i=0;i<this.arrayDetalle.length;i++){
        if(this.arrayDetalle[i].idequipo==id){
          sw = true;
        }
      }
      return sw;
    },

    eliminarDetalle(index){
      let me =this;
      me.arrayDetalle.splice(index,1 );
    },
    agregarDetalle(){
      let me=this;
      if(me.idequipo==0 ){        
      }
      else{
        if(me.encuentra(me.idequipo)){
          swal({
            type: 'error',
            title: 'Error',
            text : 'Este equipo ya esta agregado',
          })
        }
        else{
          me.arrayDetalle.push({
          idequipo: me.idequipo,
          equipo: me.equipo,
        });      
        me.idequipo=0;
        me.equipo='';
        }
          
      }
    
    },
    agregarDetalleModal(data =[]){
                let me=this;
                if(me.encuentra(data['id'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Este equipo ya se encuentra agregado!',
                        })
                    }else{
                    me.arrayDetalle.push({
                    idequipo: data['id'],
                    equipo: data['nombre'],
                    idrama: data['idrama'],
                    rama : data['nombre_rama'],
                    idcategoria: data['idcategoria'],
                    nombre_categoria: data['nombre_categoria']

                    });
                 }
            }, 
    listarEquipo(buscar, criterio) {
      let me = this;
      var url = "/equipo/listarEquipo?buscar=" + buscar + "&criterio=" + criterio;
      axios.get(url,{params: {idcategoria:this.idcategoria}}).then(function(response) {
          var respuesta = response.data;
          me.arrayEquipo = respuesta.equipos.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },  
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";     
    },
    abrirModal(modelo, accion, data = []) {     
          this.modal = 1;
          this.tituloModal = "Seleccion uno a varios equipos";  
          this.selectCategoria();
          switch(modelo){
                    case "torneo":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar torneo';
                                this.nombre= '';
                                this.idcategoria=0;
                                this.fecha_inicio='';
                                this.fecha_fin='';                                
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar detalle';
                                this.tipoAccion=2;
                                this.idtorneo=data['id'];
                                this.idequipo=data['idequipo'];
                                this.nombre = data['nombre'];
                                this.idcategoria = data['idcategoria'];
                                this.fecha_inicio = data['fecha_inicio'];
                                this.fecha_fin = data['fecha_fin'];
                         //       this.arrayDetalle= data['datalle'];
                                break;
                            }
                        }
                    }
                }
    },
    verTorneoActualizar(id){
                let me=this;
                me.listado=3;

                //Obtener datos del ingreso
                var arrayTorneoT=[];
                var url= '/torneo/obtenerCabecera?id=' + id;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayTorneoT = respuesta.torneo;
                    
                    me.nombre = arrayTorneoT[0]['nombre'];
                    me.categoria = arrayTorneoT[0]['categoria'];
                    me.fecha_inicio=arrayTorneoT[0]['fecha_inicio'];
                    me.fecha_fin=arrayTorneoT[0]['fecha_fin'];                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                //obtener datos de los detalles
                 var url= '/torneo/obtenerDetalles?id=' + id;
                axios.get(url).then(function (response) {
                   // console.log(response);
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.detalles;

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pdfTorneo(id){
              window.open('/torneo/pdf/'+ id ,'_blank');
            },
    verTorneo(id){
                let me=this;
                me.listado=2;
                //Obtener datos del ingreso
                var arrayTorneoT=[];
                var url= '/torneo/obtenerCabecera?id=' + id;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayTorneoT = respuesta.torneo;
                    
                    me.nombre = arrayTorneoT[0]['nombre'];
                    me.categoria = arrayTorneoT[0]['categoria'];
                    me.fecha_inicio=arrayTorneoT[0]['fecha_inicio'];
                    me.fecha_fin=arrayTorneoT[0]['fecha_fin'];                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                //obtener datos de los detalles
                 var url= '/torneo/obtenerDetalles?id=' + id;

                axios.get(url).then(function (response) {
                   // console.log(response);
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.detalles;

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
    desactivarTorneo(id) {
      swal({
        title: "Esta seguro de desactivar este torneo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;

          axios
            .put("/torneo/desactivar", {
              id: id
            })
            .then(function(response) {
              me.listarTorneo(1, "", "nombre");
              swal(
                "Desactivado!",
                "El registro ha sido desactivado con éxito.",
                "success"
              );
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    activarTorneo(id) {
      swal({
        title: "Esta seguro de activar este torneo?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true
      }).then(result => {
        if (result.value) {
          let me = this;

          axios.put("/torneo/activar", {
              id: id
            })
            .then(function(response) {
              me.listarTorneo(1, "", "nombre");
              swal(
                "Activado!",
                "El registro ha sido activado con éxito.",
                "success"
              );
            })
            .catch(function(error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    }
  },
  mounted() {
    this.listarTorneo(1, this.buscar, this.criterio);
    this.selectCategoria();
  }
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
@media (min-width: 600px) {
  .btnagregar {
    margin-top: 2rem;
  }

    .modal-body{
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }}
</style>
