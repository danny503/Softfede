<template>
  <div class="content-wrapper">
    <section class="full-box dashboard-contentPage">
      <!-- SELECT2 EXAMPLE -->
      <div class="card-header">
        <div class="form-group row">
          <div class="col-md-6">
            <div>
              <select class="col-md-3" v-model="criterio">
                <option value="nombre">Nombre</option>
                <option value="apellido">Apellido</option>
              </select>
              <input
                type="text"
                v-model="buscar"
                @keyup.enter="listarPersona(1,buscar,criterio)" placeholder="Buscar"/>
              <button
                type="submit"
                @click="listarPersona(1,buscar,criterio)"
                class="btn btn-primary">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <ul class="list-group">
        <li class="list-group-item list-group-item-primary">
          <a href="#new" data-toggle="tab">Nuevo</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a
            href="#list"
            data-toggle="tab"
          >Lista</a>
        </li>
      </ul>

      <div class="card">
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="new">
            <div class="container-fluid">
              <div class="row">
                <div class="col-xs-9 col-md-10">
                  <form @submit.prevent="registrarPersona" enctype="multipart/form-data">
                    <div class="form-group label-floating">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="nombre"
                        id="exampleInputNombre"
                        placeholder="Ingrese nombre su nombre" />
                        <span v-if="errors.nombre" class="badge badge-danger">{{errors.nombre[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label>Fecha Nacimiento:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input
                          type="date"
                          class="form-control"
                          v-model="fechanac"
                          data-inputmask="'alias': 'dd/mm/yyyy'"
                          data-mask
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group row">
                      <label
                        for="exampleInputEmail1"
                        class="col-sm-4 col-form-label"
                      >Direcci&oacute;n:</label>
                      <div class="col-sm-12">
                        <textarea
                          id="direccion"
                          name="direccion"
                          class="form-control"
                          v-model="direccion"
                          maxlength="250"></textarea>
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
                    <div class="form-group">
                      <label>T&eacute;lefono:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" v-model="telefono"  placeholder="Ingrese su telefono"/>
                        <span v-if="errors.telefono" class="badge badge-danger">{{errors.telefono[0]}}</span>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Correo</label>
                      <input
                        type="email"
                        class="form-control"
                        id="exampleInputNombre"
                        v-model="email"
                        placeholder="Ingrese su correo" />
                        <span v-if="errors.email" class="badge badge-danger">{{errors.email[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Estatura</label>
                      <input
                        type="text"
                        class="form-control"
                        id="exampleInputNombre"
                        v-model="estatura"
                        placeholder="Ingrese su estatura"
                      />
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Foto</label>
                      <input type="file" @change="obtenerImagen" id="exampleInputFile" />
                      <span v-if="errors.foto" class="badge badge-danger">{{errors.foto[0]}}</span>
                    </div>
                    <figure>
                        <img :src="imagen" alt="Foto de jugador" width="304" height="300">
                    </figure>
                    <p class="text-center">
                      <button type="button" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="list">
            <div class="table-responsive">
              <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Fecha Nacimiento</th>
                    <th class="text-center">Género</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Teléfono</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Estatura</th>
                    <th class="text-center">Foto</th>
                    <th class="text-center">Actualizar</th>
                    <th class="text-center">Eliminar</th>
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
                    <td v-text="persona.estatura"></td>
                    <td >                     
                        <img :src="'images/' + persona.foto" alt="Foto de jugador" width="75" height="75">
                    </td>
                  <td><a href="#" class="btn btn-warning btn-raised btn-xs" @click="abrirModal('persona','actualizar',persona)" ><i class="fa fa-pencil"></i></a></td>
                  <td><a href="#" class="btn btn-danger btn-raised btn-xs"><i class="fa fa-trash"></i></a></td>
                  </tr>
                </tbody>
                <ul class="pagination">
                  <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                      class="page-link"
                      href="#"
                      @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                  </li>
                  <li
                    class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']" >
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
                      @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)" >Sig</a>
                  </li>
                </ul>
              </table>
            </div>
          </div>
          
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
                  <form action method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group label-floating">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input  type="text"  class="form-control"  v-model="nombre"  placeholder="Ingrese nombre su nombre"  />
                      <span v-if="errors.nombre" class="badge badge-danger">{{errors.nombre[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label>Fecha Nacimiento:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input
                          type="date"
                          class="form-control"
                          v-model="fechanac"
                          data-inputmask="'alias': 'dd/mm/yyyy'"
                          data-mask
                        />
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Genero</label>
                      <div class="col-md-9">
                        <select class="form-control" v-model="genero">
                          <option value>Seleccione su genero</option>
                          <option value="Femenino">Femenino</option>
                          <option value="Masculino">Maculino</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Direcci&oacute;n:</label>
                      <div class="col-sm-12">
                        <textarea
                          id="direccion"
                          name="direccion"
                          v-model="direccion"
                          class="form-control"
                          maxlength="250"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>T&eacute;lefono:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" v-model="telefono" />
                        <span v-if="errors.telefono" class="badge badge-danger">{{errors.telefono[0]}}</span>
                      </div>
                      <!-- /.input group -->
                    </div>
                      <div class="form-group">
                      <label>Correo:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-email"></i>
                        </div>
                        <input type="text" class="form-control" v-model="email" />
                        <span v-if="errors.email" class="badge badge-danger">{{errors.email[0]}}</span>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Estatura</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="estatura"
                        id="exampleInputNombre"
                        placeholder="Ingrese su estatura" />
                    </div>
                    <div class="form-group">                        
                      <label for="exampleInputFile">Foto</label> 
                      <div>
                      <img :src="'images/' + foto" alt="Foto de jugador" width="75" height="75"> 
                      </div>                
                      <input type="file" id="foto" @change="obtenerImagen"/>
                      <span v-if="errors.foto" class="badge badge-danger">{{errors.foto[0]}}</span>
                    </div>
                    <figure>
                        <img :src="imagen" alt="Foto de jugador" width="304" height="300">
                    </figure>
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="submit" v-if="tipoAccion==1" class="btn btn-primary">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
               </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      persona_id: 0,
      nombre: "",
      fechanac: "",
      genero: "",
      direccion: "",
      telefono: "",
      email: "",
      estatura: "",
      foto: "",
      imagenMiniatura: '',
      arrayPersona: [],
      errors:[],
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorPersona: 0,
      errorMostrarMsjPersona: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0
      },
      offset: 3,
      criterio: "nombre",
      buscar: ""
    };
  },
  computed: {
    imagen(){
      return this.imagenMiniatura;
    },
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
    obtenerImagen(e){
      let file = e.target.files[0];
      //console.log(file);
      this.foto = file;

      this.cargarImagen(file);

    },
    cargarImagen(file){
      let reader = new FileReader();
      reader.onload = (e) =>{
        this.imagenMiniatura = e.target.result;

      }
      reader.readAsDataURL(file);

    },
    registrarPersona(){
      let me = this;
      this.errors = []
      let formData = new FormData();
      formData.append('nombre',this.nombre);
      formData.append('fechanac',this.fechanac);
      formData.append('genero',this.genero);
      formData.append('direccion',this.direccion);
      formData.append('telefono',this.telefono);
      formData.append('email',this.email);
      formData.append('estatura',this.estatura);
      formData.append('foto',this.foto);

         axios.post("/jugador/registrar",formData)
         .then(response=>{
           me.cerrarModal();
          me.listarPersona(1, "", "nombre");
           //console.log(response.data);  
           }).catch(error => {
                    if (error.response.status == 422){
                        this.errors = error.response.data.errors
                    }
                    //console.log(error);
                });
    },
    listarPersona(page, buscar, criterio) {
      let me = this;
      var url =
        "/jugador?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayPersona = respuesta.personas.data;
          me.pagination = respuesta.pagination;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      //Actualiza la página actual
      me.pagination.current_page = page;
      //Envia la petición para visualizar la data de esa página
      me.listarPersona(page, buscar, criterio);
    },
    registrarPerson() {
      if (this.validarPersona()) {
        return;
      }

      let me = this;

      axios.post("/jugador/registrar", {
          nombre: this.nombre,
          fechanac: this.fechanac,
          genero: this.genero,
          direccion: this.direccion,
          telefono: this.telefono,
          email: this.email,
          estatura: this.estatura,
          foto: this.foto
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarPersona(1, "", "nombre");
          swal(
                "Registrado!",
                "Se ha registrado con éxito.",
                "success"
              );
        })
   
        .catch(function(error) {
          console.log(error);
        });
    },
    everImagen:function(){
        var _this = this;
        _this.file = _this.$$refs.foto.file[0];
        _this.url = URL.createObjectURL(_this.file);
    },
    actualizarPersona(){
      this.errors = []
      let me = this;      
      let formData = new FormData();
      formData.append('id',this.persona_id);
      formData.append('nombre',this.nombre);
      formData.append('fechanac',this.fechanac);
      formData.append('genero',this.genero);
      formData.append('direccion',this.direccion);
      formData.append('telefono',this.telefono);
      formData.append('email',this.email);
      formData.append('estatura',this.estatura);
      formData.append('foto',this.foto);

         axios.post("/jugador/actualizar",formData)
         .then(function(response){
           me.cerrarModal();
           me.listarPersona(1, "", "nombre");
           swal(
                "Actualizado!",
                "Se ha actualizado con éxito.",
                "success"
              );
           //console.log(response.data);  
         })
    },
    actualizarPerson() {
      if (this.validarPersona()) {
        return;
      }

      let me = this;

      axios.put('/jugador/actualizar', {
          'nombre': this.nombre,
          'fechanac': this.fechanac,
          'genero': this.genero,
          'direccion': this.direccion,
          'telefono': this.telefono,
          'email': this.email,
          'estatura': this.estatura,
          'foto': this.foto,
          'id': this.persona_id
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
          "El nombre de la persona no puede estar vacío."
        );

      if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

      return this.errorPersona;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
      this.nombre = "";
      this.fechanac = "";
      this.genero = "";
      this.direccion = "";
      this.telefono = "";
      this.email = "";
      this.estatura = "";
      this.foto = ""; 
      this.errorPersona = 0;
    },
    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case "persona": {
          switch (accion) {
            case "registrar": {
              this.modal = 1;
              this.tituloModal = "Registrar jugador";
              this.nombre = "";
              this.fechanac = "";
              this.genero = "";
              this.direccion = "";
              this.telefono = "";
              this.email = "";
              this.estatura = "";
              this.foto = "";
              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              //console.log(data);
              this.modal = 1;
              this.tituloModal = "Actualizar Jugador";
              this.tipoAccion = 2;
              this.persona_id = data["id"];
              this.nombre = data["nombre"];
              this.fechanac = data["fechanac"];
              this.genero = data["genero"];
              this.direccion = data["direccion"];
              this.telefono = data["telefono"];
              this.email = data["email"];
              this.estatura = data["estatura"];
              this.foto = data["foto"];
              break;
            }
          }
        }
      }
    }
  },
  mounted() {
    this.listarPersona(1, this.buscar, this.criterio);
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
</style>