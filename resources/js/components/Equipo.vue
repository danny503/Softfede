<template>
        <!-- Content Header (Page header) -->
        <section class="content-header">          
                             <div class="card-header">
                            <i class="fa fa-align-justify"></i> Equipos
                            <button type="button" @click="abrirModal('equipo','registrar')" class="btn btn-primary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                       </button>
                   </div>
  <div class="content-wrapper">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/">Escritorio</a>
      </li>
    </ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Inscripcion
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-secondary" >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <!--Listado -->
        <template v-if="listado">
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
                  @keyup.enter="listarIngreso(1,buscar,criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarEquipo(1,buscar,criterio)"
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
                  <th class="text-center list-group-item-success">Rama</th>
                  <th class="text-center list-group-item-success">Logo</th>
                  <th class="text-center list-group-item-success">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="equipo in arrayEquipo" :key="equipo.id">
                  <td>
                    <button
                      type="button"
                      @click="abrirModal('equipo','actualizar',equipo)"
                      class="btn btn-success btn-sm"
                    >
                      <i class="icon-eye"></i>
                    </button>&nbsp;
                  </td>
                  <td v-text="equipo.nombre"></td>
                  <td v-text="equipo.nombre_rama"></td>
                  <td v-text="equipo.logo"></td>
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
        <template v-else>
        <div class="card-body">
          <div class="form-group row border">
            <div class="col-md-6">
              <label for>Nombre</label>
              <input type="text" class="form-control" v-model="nombre" />
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for>Rama</label>
                <select class="form-control"></select>
              </div>
            </div>
            <div class="col-md-4">
              <label for>Logo</label>
              <input type="text" class="form-control" v-model="logo" />
            </div>
          </div>
          <div class="form-group row border">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="">Jugadores <span style="color:red;" v-show="idpersona==0">(Seleccione)</span></label>
                      <div class="form-inline">
                          <input type="text" class="form-control" v-model="idpersona" placeholder="Ingrese jugador">
                          <button @click="abrirModal()" class="btn btn-primary">...</button>
                      </div>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <label >Numero de camisa<span style="color:red;" v-show="ncamisa==0">(Seleccione)</span></label>
                      <input type="number" class="form-control" v-model="ncamisa">
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label >Posición <span style="color:red;" v-show="posicion==0">(Seleccione)</span></label>
                      <input type="text" class="form-control" v-model="posicion">
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="form-group">
                      <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>

                  </div>
              </div>
          </div>          
          <div class="form-group row border">
              <div class="table-responsive">
                  <table class="table table-bordered table-striped table-sm">
                      <thead>
                          <tr>
                          <th>Opciones</th>
                          <th>Jugador</th>
                          <th>N° Camisa</th>
                          <th>Posición</th>  
                          </tr>                        
                      </thead>
                      <tbody v-if="arrayDetalle.legth">
                          <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
                              <td>
                                  <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                      <i class="icon-close"></i>
                                  </button>
                              </td>
                              <td v-text="detalle.persona">jdjfdj
                              </td>
                              <td>hsjdjs</td>
                              <td>djfhdf</td>
                              <td>
                                  <input type="text" v-model="detalle.ncamisa" value="3" class="form-control">sdff
                              </td>
                              <td v-text="detalle.posicion">sdfsfd              
                              </td>                                                                                          
                          </tr>                          
                    </tbody>
                    <tbody v-else>
                      <tr>
                        <td colspan="5">
                          No hay jugadores agregados
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
          </div>
          <div class="form=group row">
              <div class="col-md-12"> 
                  <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                  <button type="button" class="btn btn-primary" @click="registrarIngreso()">Registrar equipo</button>
              </div>

          </div>
        </div>
        </template>
        <!--Fin detalle -->
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{'mostrar' : modal}"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none;"
      aria-hidden="true">
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
                    <option value="apellido">Apellido</option>
                  </select>
                  <input type="text" v-model="buscarJ" @keyup.enter="listarPersona(buscarJ,criterioJ)" placeholder="Buscar"/>
                  <button type="submit" @click="listarPersona(buscarJ,criterioJ)" class="btn btn-primary">
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
                    <th class="text-center">Fecha Nacimiento</th>
                    <th class="text-center">Género</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">Estatura</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="persona in arrayPersona" :key="persona.id">
                    <td>          
                      <button type="button" @click="agregarDetalleModal(persona)" class="btn btn-success btn-sm">
                       <i class="fa fa-check"></i>
                      </button>
                      </td>
                    <td v-text="persona.nombre"></td>
                    <td v-text="persona.fechanac"></td>
                    <td v-text="persona.genero"></td>
                    <td v-text="persona.direccion"></td>
                    <td v-text="persona.telefono"></td>
                    <td v-text="persona.estatura"></td>                                     
                  </tr>
                </tbody>               
              </table>
            </div>
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
    <!--Fin del modal-->
  </div>
  
        </section>
</template>

<script>
export default {
  data() {
    return {
      equipo_id: 0,
      idrama: 0,
      idpersona:0,
      nombre_rama: 0,
      nombre: "",
      logo: "",
      ncamisa :0,
      persona: "",
      posicion: "",
      arrayEquipo: [],
      arrayPersona: [],
      arrayDetalle: [],
      listado:1,
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorEquipo: 0,
      errorMostrarMsjEquipo: [],
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
      arrayRama: []
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
    listarEquipo(page, buscar, criterio) {
      let me = this;
      var url =
        "/equipo?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayEquipo = respuesta.equipos.data;
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
          // consolo.log(response);
          var respuesta = response.data;
          me.arrayRama = respuesta.ramas;
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
      me.listarEquipo(page, buscar, criterio);
    },
    registrarPersona() {
      if (this.validarPersona()) {
        return;
      }

      let me = this;

      axios
        .post("/user/registrar", {
          nombre: this.nombre,
          tipo_documento: this.tipo_documento,
          num_documento: this.num_documento,
          direccion: this.direccion,
          telefono: this.telefono,
          email: this.email,
          idrol: this.idrol,
          usuario: this.usuario,
          password: this.password
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarPersona(1, "", "nombre");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    actualizarPersona() {
      if (this.validarPersona()) {
        return;
      }

      let me = this;

      axios
        .put("/user/actualizar", {
          nombre: this.nombre,
          tipo_documento: this.tipo_documento,
          num_documento: this.num_documento,
          direccion: this.direccion,
          telefono: this.telefono,
          email: this.email,
          idrol: this.idrol,
          usuario: this.usuario,
          password: this.password,
          id: this.persona_id
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarPersona(1, "", "nombre");
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    validarPersona() {
      this.errorPersona = 0;
      this.errorMostrarMsjPersona = [];

      if (!this.nombre)
        this.errorMostrarMsjPersona.push(
          "El nombre de la pesona no puede estar vacío."
        );
      if (!this.usuario)
        this.errorMostrarMsjPersona.push(
          "El nombre de usuario no puede estar vacío."
        );
      if (!this.password)
        this.errorMostrarMsjPersona.push(
          "La password del usuario no puede estar vacía."
        );
      if (this.idrol == 0)
        this.errorMostrarMsjPersona.push("Seleccione una Role.");
      if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

      return this.errorPersona;
    },
    mostrarDetalle(){
      this.listado=0;
    },
    ocultarDetalle(){
      this.listado=1;
    },
    encuentra(id){
      var sw=0;
      for(var i=0;i<this.arrayDetalle.length;i++){
        if(this.arrayDetalle[i].idpersona==id){
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
      if(me.idpersona==0 || me.ncamisa==0 || me.posicion=="" ){        
      }
      else{
        if(me.encuentra(me.idpersona)){
          swal({
            type: 'error',
            title: 'Error',
            text : 'Este jugador ya esta agregado',
          })
        }
        else{
          me.arrayDetalle.push({
          idpersona: me.idpersona,
          persona: me.persona,
          ncamisa : me.ncamisa,
          posicion : me.posicion,
        });      
        me.idpersona=0;
        me.persona='';
        me.ncamisa=0;
        me.posicion='';
        }
          
      }
    
    },
    agregarDetalleModal(data =[]){
                let me=this;
                if(me.encuentra(data['id'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Este jugador ya se encuentra agregado!',
                        })
                    }else{
                    me.arrayDetalle.push({
                    idpersona: data['id'],
                    persona: data['nombre'],
                    ncamisa: 1,
                    posicion: 1
                    });
                 }
            }, 
    listarPersona(buscar, criterio) {
      let me = this;
      var url = "/jugador/listarJugador?buscar=" + buscar + "&criterio=" + criterio;
      axios.get(url).then(function(response) {
          var respuesta = response.data;
          me.arrayPersona = respuesta.personas.data;
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
          this.tituloModal = "Seleccion uno a vrios jugadores";      
      
    },
    desactivarUsuario(id) {
      swal({
        title: "Esta seguro de desactivar este usuario?",
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
            .put("/user/desactivar", {
              id: id
            })
            .then(function(response) {
              me.listarPersona(1, "", "nombre");
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
    activarUsuario(id) {
      swal({
        title: "Esta seguro de activar este usuario?",
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
            .put("/user/activar", {
              id: id
            })
            .then(function(response) {
              me.listarPersona(1, "", "nombre");
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
    this.listarEquipo(1, this.buscar, this.criterio);
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
}
</style>
