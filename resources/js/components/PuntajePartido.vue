<template>
        <!-- Content Header (Page header) -->
        <section class="content-header">          
                     
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
          <i class="fa fa-align-justify"></i> Puntaje Partido
          <button
            type="button" @click="mostrarDetalle('puntaje', 'registrar')" class="btn btn-secondary" >
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
                  @keyup.enter="listarPuntaje(1,buscar,criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarPuntaje(1,buscar,criterio)"
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
                  <th class="text-center list-group-item-success">Puntaje Equipo A</th>
                  <th class="text-center list-group-item-success">Puntaje Equipo B</th>
                  <th class="text-center list-group-item-success">Ganador</th>                  
                </tr>
              </thead>
              <tbody>
                <tr v-for="puntaje in arrayPuntaje" :key="puntaje.id">
                  <td>
                         <button type="button" @click="verPuntaje(puntaje.id)" class="btn btn-success btn-sm">
                            <i class="fa fa-eye"></i>
                        </button> &nbsp;                                          
                   <button type="button" @click="pdfPuntaje(puntaje.id)" class="btn btn-info btn-sm">
                        <i class="fa fa-file"></i>
                    </button> 
                 </td>
                  <td v-text="puntaje.punto_a"></td>
                  <td v-text="puntaje.punto_b"></td>
                  <td v-text="puntaje.ganador"></td>              
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
            <div class="col-md-3">
              <label for>Puntaje Equipo A</label>
              <input type="number" class="form-control" v-model="punto_a" />
            </div>

             <div class="col-md-3">
              <label for>Puntaje Equipo B</label>
              <input type="text" class="form-control" v-model="punto_b" />
            </div>        
            <div class="col-md-4">
              <div class="form-group">
                <label for>Ganador</label>
                   <select class="form-control" v-model="ganador">
                     <option value="" disabled>Seleccion el ganador</option>
                     <option value="Femenino">Equipo A</option>
                     <option value="Masculino">Equipo B</option>
                  </select>
              </div>
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
                      <label for="">Jugadores <span style="color:red;" v-show="idpersona==0">(Seleccione)</span></label>
                      <div class="form-inline">
                          <input type="text" class="form-control" v-model="idpersona" placeholder="Ingrese jugadores">
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
                          <th>Jugadores</th> 
                          <th>Puntos</th> 
                          <th>Faltas</th> 
                          </tr>                        
                      </thead>
                      <tbody v-if="arrayDetalle.length">
                          <tr v-for="(detalle, index) in arrayDetalle" :key="detalle.id">
                              <td>
                                  <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                      <i class="fa fa-close"></i>
                                  </button>
                              </td>
                              <td v-text="detalle.persona" ></td>
                                   <td>
                                                <input v-model="detalle.puntaje" type="number" value="3" class="form-control">
                                            </td>
                                            <td>
                                                <input v-model="detalle.falta" type="number" value="2" class="form-control">
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
                  <button type="button" class="btn btn-primary" @click="registrarPuntaje()">Registrar puntaje</button>
              </div>
          </div>
        </div>
        </template>
        <!--Fin detalle -->
         <!--Ver torneo-->
                    <template v-else-if="listado==2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Puntaje A</label>
                                    <p v-text="punto_a"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Puntaje B</label>
                                    <p v-text="punto_b"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Ganador</label>
                                <p v-text="ganador"></p>
                            </div>                                                                                          
                    </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Jugadores</th>
                                            <th>Puntos</th>
                                            <th>Faltas</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle) in arrayDetalle" :key="detalle.id">                                        
                                            <td v-text="detalle.jugador">
                                            </td>
                                            <td v-text="detalle.punto">
                                            </td>
                                            <td v-text="detalle.falta">
                                            </td>
                                        </tr>
                                    </tbody>  
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay jugadores agregados
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
                  </tr>
                </tbody>               
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTorneo()">Guardar</button>
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
      idjugador: 0,
      idpersona:0,
      idpuntaje: 0,
      idequipo:0,
      idcategoria:0,
      punto_a: 0,
      punto_b: 0,
      puntaje: 0,   
      falta: 0,
      persona:"",
      jugador: "",
      ganador:"",
      fecha_fin:"",      
      arrayJugador: [],
      arrayPuntaje: [],
      arrayDetalle: [],
      arrayPersona:[],
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
    listarPuntaje(page, buscar, criterio){
        let me = this;
      var url =
        '/puntaje?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      axios.get(url)
        .then(function(response) {
          var respuesta = response.data;
          me.arrayPuntaje = respuesta.puntajes.data;
          me.pagination = respuesta.pagination;
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
    registrarPuntaje() {
     /* if (this.validarTorneo()) {
        return;
      }*/
      let me = this;

      axios.post('/puntaje/registrar', {
          'punto_a': this.punto_a,
          'punto_b': this.punto_b,
          'ganador': this.ganador,          
          'data' : this.arrayDetalle         
        })
        .then(function(response) {
          me.listado=1;
          me.listarPuntaje(1, '', 'nombre');
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
          me.punto_a=0;
          me.punto_b=0;
          me.ganador='';
          me.idjugador=0;
          me.jugador='';
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
      if(me.idpersona==0 || me.puntaje==0 || me.falta==0 ){        
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
          puntaje : me.puntaje,
          falta : me.falta,
        });      
        me.idpersona=0;
        me.persona='';
        me.puntaje=0;
        me.falta='';
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
                    puntaje: 1,
                    falta: 1
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
    abrirModal() {  
        this.arrayPersona=[];   
          this.modal = 1;
          this.tituloModal = "Seleccion uno a varios jugadores";  
          //this.selectCategoria();         
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
                    console.log(response);
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
    this.listarPuntaje(1, this.buscar, this.criterio);
    this.listarPersona(1, this.buscar, this.criterio);
    //this.selectCategoria();
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
