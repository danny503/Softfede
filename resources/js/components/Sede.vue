<template>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="card-header">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Sede
          <button type="button" @click="abrirModal('sede','registrar')" class="btn btn-primary">
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-header">
          <div class="form-group row">
            <div class="col-md-6">
              <div>
                <select class="col-md-3" id="opcion" name="opcion">
                  <option value="nombre">Nombre</option>
                  <option value="direccion">Dirección</option>
                </select>
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarSede(1,buscar,criterio)"
                  placeholder="Buscar"
                />
                <button
                  type="submit"
                  @click="listarSede(1,buscar,criterio)"
                  class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>        
          <div class="table-responsive">
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th class="text-center list-group-item-success">#</th>
                  <th class="text-center list-group-item-success">Nombre</th>
                  <th class="text-center list-group-item-success">Direccion</th>
                  <th class="text-center list-group-item-success">Estado</th>
                  <th class="text-center list-group-item-success">Actualizar</th>
                  <th class="text-center list-group-item-success">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="sede in arraySede" :key="sede.id">
                  <td>1</td>
                  <td v-text="sede.nombre"></td>
                  <td v-text="sede.direccion"></td>

                  <td>
                    <div v-if="sede.condicion">
                      <span class="badge badge-success">Activo</span>
                    </div>
                    <div v-else>
                      <span class="badge badge-danger">Desactivado</span>
                    </div>
                  </td>
                  <td>
                    <a href="#!" @click="abrirModal('sede','actualizar',sede)"
                      class="btn btn-primary btn-raised btn-xs">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </td>
                  <template v-if="sede.condicion">
                    <td>
                      <a href="#" @click="desactivarSede(sede.id)" class="btn btn-danger btn-raised btn-xs">                      
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </template>
                  <template v-else>
                    <td>
                      <a href="#" @click="activarSede(sede.id)" class="btn btn-success btn-raised btn-xs">                      
                        <i class="fa fa-check"></i>
                      </a>
                    </td>
                  </template>
                </tr>
              </tbody>
            </table>
          </div>        
      </div>
      <ol class="breadcrumb" style=" margin-left: 10%; max-width: 100%; margin-right: 10%;"></ol>
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
              <form action method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                  <div class="col-md-9">
                    <input type="text" v-model="nombre" class="form-control" />
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 form-control-label" for="email-input">Direccion</label>
                  <div class="col-md-9">
                    <input type="text" v-model="direccion" class="form-control" placeholder="Escriba la dirección"/>
                  </div>
                </div>
                <div v-show="errorSede" class="form-group row div-error">
                  <div class="text-center text-error">
                    <div v-for="error in errorMostrarMsjSede" :key="error" v-text="error"></div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
              <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarSede()">Guardar</button>
              <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarSede()">Actualizar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
export default {
  data() {
    return {
      sede_id: 0,
      nombre: "",
      direccion: "",
      arraySede: [],
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorSede: 0,
      errorMostrarMsjSede: [],
      criterio: "nombre",
      buscar: ""
    };
  },
  methods: {
    listarSede(page, buscar, criterio) {
      let me = this;
      //var url = '/sede?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      axios
        .get("/sede")
        .then(function(response) {
          me.arraySede = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    registrarSede() {
      if (this.validarSede()) {
        return;
      }

      let me = this;

      axios.post("/sede/registrar", {
          nombre: this.nombre,
          direccion: this.direccion
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarSede(1, "", "nombre");
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
    actualizarSede() {
      if (this.validarSede()) {
        return;
      }

      let me = this;

      axios.put("/sede/actualizar", {
          nombre: this.nombre,
          direccion: this.direccion,
          id: this.sede_id
        })
        .then(function(response) {
          me.cerrarModal();
          me.listarSede(1, "", "nombre");
          swal(
                "Actualizado!",
                "Se ha actualizado con éxito.",
                "success"
              );
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    desactivarSede(id) {
      swal({
        title: "Esta seguro de desactivar esta sede?",
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

          axios.put("/sede/desactivar", {
              id: id
            })
            .then(function(response) {
              me.listarSede();
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
    activarSede(id) {
      swal({
        title: "Esta seguro de activar este sede?",
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
            .put("/sede/activar", {
              id: id
            })
            .then(function(response) {
              me.listarSede(1, "", "nombre");
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
    },
    validarSede() {
      this.errorSede = 0;
      this.errorMostrarMsjSede = [];

      if (!this.nombre)
        this.errorMostrarMsjSede.push(
          "El nombre del sede no puede estar vacío."
        );

      if (this.errorMostrarMsjSede.length) this.errorSede = 1;

      return this.errorSede;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
      this.nombre = "";
      this.direccion = "";
    },

    abrirModal(modelo, accion, data = []) {
      switch (modelo) {
        case "sede": {
          switch (accion) {
            case "registrar": {
              this.modal = 1;
              this.tituloModal = "Registrar sede";
              this.nombre = "";
              this.direccion = "";
              this.tipoAccion = 1;
              break;
            }
            case "actualizar": {
              //console.log(data);
              this.modal = 1;
              this.tituloModal = "Actualizar sede";
              this.tipoAccion = 2;
              this.sede_id = data["id"];
              this.nombre = data["nombre"];
              this.direccion = data["direccion"];
              break;
            }
          }
        }
      }
    }
  },
  mounted() {
    this.listarSede(1, this.buscar, this.criterio);
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
