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
                    <button type="button" @click="verEquipo(equipo.id)" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i>
                    </button> &nbsp;
                    <button type="button" @click="abrirModal('equipo','actualizar',equipo)" class="btn btn-success btn-sm">
                      <i class="fa fa-check"></i>
                    </button>&nbsp;
                         <button type="button" @click="pdfEquipo(equipo.id)" class="btn btn-info btn-sm">
                        <i class="fa fa-file"></i>
                    </button> 
                  </td>
                  <td v-text="equipo.nombre"></td>
                  <td v-text="equipo.nombre_rama"></td>
                   <td >                     
                      <img :src="'images/' + equipo.logo" alt="Logo del equipo" width="75" height="75">
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
        <template v-if="listado==0">
        <div class="card-body">
          <div class="form-group row border">
           <!-- <div class="col-md-6">
              <label for>Nombre</label>
              <input type="text" class="form-control" v-model="nombre" />
            </div>-->

          <div class="col-md-6">
              <div class="form-group">
                <label for>Equipo</label>
                 <select class="form-control" v-model="idequipo">
                <option value="0" disabled>Seleccione un Equipo</option>
                <option v-for="equipo in arrayEquipo" :key="equipo.id" :value="equipo.id" v-text="equipo.nombre"></option>
                 </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for>Jugador</label>
                 <select class="form-control" v-model="idjugador">
                <option value="0" disabled>Seleccione un jugador</option>
                <option v-for="jugador in arrayPersona" :key="jugador.id" :value="jugador.id" v-text="jugador.nombre"></option>
                 </select>
              </div>
            </div>
            <div class="col-md-6">
              <label for>Número de camisa</label>
              <input type="number" class="form-control" v-model="numero_camisa" />
            </div>
                  <div class="col-md-6">
            <div class="form-group row">
              <label  for="text-input">Posición</label>                
                  <select class="form-control" v-model="posicion">
                    <option value="" disabled>Seleccione la Posición</option>
                      <option value="Escolta">Escolta</option>
                        <option value="Pivote">Pivote</option>
                          <option value="Alero">Alero</option>
                            <option value="Alero">Base</option>
                  </select>
                </div>
            </div>
            <div class="col-md-12">
              <div v-show="errorEquipo" class="form-group row div-error">
                      <div class="text-center text-error">
                       <div v-for="error in errorMostrarMsjEquipo" :key="error" v-text="error">
                      </div>
                  </div>
             </div>
              </div>            
          </div>      
          <div class="form-group row border">
              <div class="table-responsive">

              </div>
          </div>
          <div class="form=group row">
              <div class="col-md-12"> 
                  <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                  <button type="button" class="btn btn-primary" @click="registrarEquipo()">Registrar equipo</button>
              </div>

          </div>
        </div>
        </template>
        <!--Fin detalle -->
         <!--Ver ingreso-->
                   <template v-if="listado==2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">rama</label>
                                    <p v-text="nombre_rama"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Equipo</label>
                                <p v-text="nombre" ></p>
                            </div>
                            
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Jugador</th>
                                            <th>Número de camisa</th>
                                            <th>Posición</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="detalle in arrayDetalle" :key="detalle.detalle_id">
                                            <td v-text="detalle.persona">
                                            </td>
                                            <td v-text="detalle.numero_camisa">
                                            </td>
                                            <td v-text="detalle.posicion">
                                            </td>
                                            <td><a href="#!" class="btn btn-warning btn-raised btn-xs" @click="abrirModal('equipo','actualizar', detalle)" ><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="#!" class="btn btn-danger btn-raised btn-xs" @click="eliminarEquipo(detalle)"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay jugadores agregados al equipo
                                            </td>
                                        </tr>
                                    </tbody>                                  
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!--Fin ver ingreso-->                    
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <!--Inicio del modal agregar/actualizar-->
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
                                    <label class="col-md-3 form-control-label" for="text-input">jugador</label>
                                    <div class="col-md-9">
                                        
                                        <label class="badge badge-success" v-text="persona"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">numero de camisa</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="numero_camisa" class="form-control" >
                                        
                                    </div>
                                </div>
                      <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Posición</label>
                                <div class="col-md-9">
                                  <select class="form-control" v-model="posicion">
                                    <option value="" disabled>Seleccione la Posición</option>
                                      <option value="Escolta">Escolta</option>
                                        <option value="Pivote">Pivote</option>
                                          <option value="Alero">Alero</option>
                                          <option value="Base">Base</option>
                                  </select>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEquipo()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
    <!--Fin del modal-->

    <!--Fin del modal-->
  </div>
  
        </section>
</template>

<script>
export default {
  data() {
    return {  
      id:0,  
      equipo_id: 0,
      idrama: 0,
      idpersona:0,
      detalle_id: 0,
      nombre_rama: 0,
      nombre: "",
      logo: "",
      ncamisa :0,
      persona: "",
      posicion: "",
      idequipo:0,
      idjugador:0,
      arrayEquipo: [],
      numero_camisa:"",
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
      axios.get(url).then(function(response) {
          // console.log(response);
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
    registrarEquipo() {
      if (this.validarEquipo()) {
        return;
      }
      let me = this;
      axios.post('/inscripcionej/registrar', {
          'idequipo': this.idequipo,
          'idjugador': this.idjugador,
          'numero_camisa':this.numero_camisa,
          'posicion':this.posicion
         
        })
        .then(function(response) {
          me.listado=1;
          me.listarEquipo(1, '', 'nombre');
          me.idrama=0;
          me.nombre='';
          me.logo='';
          me.idpersona=0;
          me.persona='';
          me.ncamisa=0;
          me.posicion='';
          me.arrayDetalle=[];
          window.open('/equipo/pdf/'+ id ,'_blank');
        })
        .catch(function(error) {
          console.log(error);
        });
    },
     actualizarEquipo(){           
                let me = this;

                axios.post('/inscripcionej/actualizar',{
                    'numero_camisa': this.numero_camisa,
                    'posicion' : this.posicion,                    
                    'detalle_id': this.detalle_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarEquipo(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
    validarEquipo() {
      this.errorEquipo = 0;
      this.errorMostrarMsjEquipo = [];

     // if (!this.nombre) this.errorMostrarMsjEquipo.push("El nombre del equipo no puede estar vacío.");
     // if (this.idrama==0) this.errorMostrarMsjEquipo.push("La rama no puede estar vacío.");
      //if(this.arrayDetalle.length<=0)this.errorMostrarMsjEquipo.push("Ingrese detalle");
      if (this.errorMostrarMsjEquipo.length) this.errorEquipo = 1;

      return this.errorEquipo;
    },
    pdfEquipo(id){
       window.open('/equipo/listarPdf/'+ id ,'_blank');
    },

     eliminarJugador(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
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
                let id = data.id
                if (result.value) {                    
                axios.delete('/inscripcionej/borrar/'+ id
                    ).then(function (response) {
                      console.log(response);
                        //me.arrayDetalle();
                         swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    })                                        
                     .catch(function (error) {
                        console.log(error);
                    });
                }
                })
            },    
    mostrarDetalle(){
      let me = this;
      this.listado=0;
          me.idrama=0;
          me.nombre='';
          me.logo='';
          me.idpersona-0;
          me.persona='';
          me.ncamisa=0;
          me.posicion='';
          me.arrayDetalle=[];
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
   abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "equipo":
                    {
                        switch(accion)
                        {
                             case "registrar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Resgistrar';
                                
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar';
                                this.tipoAccion = 2;
                                this.detalle_id = data['detalle_id'];
                                this.numero_camisa= data['numero_camisa'];
                                this.posicion = data['posicion'];
                                this.persona = data['persona'];

                                break;
                            }
                        }
                      

                    }
                }
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
                let detalle_id = data.id
                console.log(detalle_id);
                if (result.value) {                    
                axios.get('/inscripcionej/destroy/'+detalle_id
                    ).then(function (response) {
                        me.listarEquipo(1,'','nombre');
                         swal(
                        'Eliminado!',
                        'Tu jugador ha sido eliminado.',
                        'success'
                    )
                    })                                        
                     .catch(function (error) {
                        console.log(error);
                    });
                }
                })
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

          axios.put("/user/desactivar", {
              id: id
            }).then(function(response) {
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
   verEquipo(id){
                let me=this;
                me.listado=2;
                //Obtener datos del ingreso
                var arrayEquipoT=[];
                var url= '/equipo/obtenerCabecera?id=' + id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayEquipoT = respuesta.equipo;                    
                    me.nombre_rama = arrayEquipoT[0]['nombre_rama'];
                    me.nombre=arrayEquipoT[0]['nombre'];                  
                })
                .catch(function (error) {
                    console.log(error);
                });
                //obtener datos de los detalles
                 var url= '/equipo/obtenerDetalles?id=' + id;                  
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.detalles;
                })
                .catch(function (error) {
                    console.log(error);
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

          axios.put("/user/activar", {
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
    this.selectRama();
    //this.listarPersona(this.buscar,this.criterio);
    
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
