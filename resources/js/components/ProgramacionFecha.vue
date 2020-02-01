<template>
  <div class="content-wrapper">
    <section class="content-header">            
      <div class="card-header"> 
      <div class="form-group row">
        <label class="col-md-3 form-control-label" for="text-input">Torneo</label>
          <div class="col-md-9">
            <select class="form-control" v-model="idtorneo">
              <option value="0" disabled>Seleccione</option>
                <option v-for="torneo in arrayTorneo" :key="torneo.id" :value="torneo.id" v-text="torneo.nombre" @click="listarPartido(idtorneo)"></option>
            </select>
          </div>
      </div>
    </div>           
        <div class="card-header">  
            <div class="table-responsive">
               <form action="propartido" method="post" enctype="multipart/form-data">
               <h1>Ver Partidos Generados</h1>
               <button type="button" @click="listarPartido(idtorneo)" class="btn btn-info btn-sm">
                        <i class="fa fa-life-ring"></i>
                </button> &nbsp; 
                   <button type="button" @click="pdfProPartido(idtorneo)" class="btn btn-info btn-sm">
                        <i class="fa fa-file"></i>
                    </button>                                    
                    <div class="table-responsive">
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th class="text-center list-group-item-success">Jornadas</th>
                  <th class="text-center list-group-item-success">Equipo A</th>
                  <th class="text-center list-group-item-success">Vs</th>
                  <th class="text-center list-group-item-success">Equipo B</th>      
                  <th class="text-center list-group-item-success">Fecha</th>      
                  <th class="text-center list-group-item-success">Hora</th>      
                  <th class="text-center list-group-item-success">Sede</th>
                  <th class="text-center list-group-item-success">Opciones</th>
                </tr>
              </thead>
            <tbody>
                <tr v-for="propartido in arrayProPartido" :key="propartido.id">                  
                  <td v-text="propartido.jornada"></td>                          
                  <!--<td>
                  <input type="text" v-model="propartido.equipoA" class="form-control"  disabled/>
                  </td>   -->               
                  <td v-text="propartido.equipoA"></td>
                  <td>Vs</td>
                  <!--<td>
                  <input type="text" v-model="propartido.equipoB" class="form-control"  disabled/>
                  </td>-->
                  <td v-text="propartido.equipoB"></td>
                  <td v-text="propartido.fecha"></td>
                  <td v-text="propartido.hora"></td>
                  <td v-text="propartido.nombre_sede"></td>
                  <td >
                 <button type="button" @click="abrirModal('categoria','actualizar', propartido)" class="btn btn-info btn-sm">
                     <i class="fa fa-plus"></i>
                  </button>
                  </td>  
                </tr> 
              </tbody>               
            </table>
          </div>          
          </form> 
            </div>      
        </div>
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
                            <form method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Fecha</label>
                                    <div class="col-md-9">
                                        <input type="date"  min="0" v-model="fecha" class="form-control" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Hora</label>
                                    <div class="col-md-9">
                                        <input type="time" v-model="hora" min="0" class="form-control" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>                                       
                                    </div>
                                </div>
                  <div class="col-md-9">
<label class="col-md-3 form-control-label" for="text-input">Sede</label>                      
                    <div class="form-group row">              
                          <select class="form-control" v-model="idsede">
                            <option value="0" disabled>Seleccione la sede</option>
                           <option v-for="sede in arraySede" :key="sede.id" :value="sede.id" v-text="sede.nombre"></option>
                          </select>
                        </div>
                    </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProgramacion(id)">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data(){
        return{
            propartido:'',
            id:0,
            nombre:'',
            jornada:0,
            equipo_a:0,
            eq1:0,
            eq2:0,
            numero_camisa:0,
            posicion:0,
            puntaje_a: null,
            puntaje_b:null,
            arrayVerp:[],
            idsede:0,
            fecha:'',
            hora:'',
            arraySede:[],            
            ideq2:0,
            equipo_b:0,
            equipo:'',
            torneo:'',
            equipo_id:0,
            idtorneo:0, 
            errors:[],
            idequipo_a:null,
            idequipo_b:null,
            errorMostrarMsjPuntaje:[],
            errorPuntaje:0,
            arrayProPartido:[],
            arrayTorneo:[],
            arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
            listado:1,      
        }
    },  
    methods:{
        listarPartido(idtorneo) {
          //console.log(this.idtorneo);
          //this.arrayProPartido = [];
          let me = this;
            axios.get('/propartido/verprogramacion/' + idtorneo).then(function(response) {
               var respuesta= response.data;
               me.arrayProPartido = respuesta.proo;
         console.log(me.arrayProPartido);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    selectSede(){
      let me=this;
                var url = '/sede/selectSede';
                axios.get(url).then(function (response) {
                   // consolo.log(response);
                    var respuesta= response.data;
                    me.arraySede = respuesta.sedes;                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });     
            },      
     buscarEstadistica(ida,idb,pa,pb) {
          //console.log(this.idtorneo);
         // this.arrayProPartido = [];
          let me = this;
            axios.get('/propartido/buscarida/'+ ida + idb + pa + pb).then(function(response) {
          //me.arrayEstadistica = response.data;
          var respuesta = response.data;
          me.arrayEstadistica = respuesta.pj;
         console.log(me.arrayEstadistica);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    checkForm:function(event) {
      if(this.puntaje_a && this.puntaje_b) return true;
      this.errors = [];
      if(!this.puntaje_a) this.errors.push("Age required.");
      if(!this.puntaje_b) this.errors.push("Name required.");
      event.preventDefault();
    },
       verProgramacion(idtorneo){
                    let me=this;
                    console.log(me.arrayVerp);
                   // axios.get('/propartido/verprogramacion/' + idtorneo).then(function (response) {
                    //me.arrayVerp = response.data;

               var arrayTorneoT=[];
                var url= '/propartido/verprogramacion/' + idtorneo;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayTorneoT = respuesta.programacion;
                    
                    me.jornada = arrayTorneoT[0]['jornada'];
                    me.equipo_a = arrayTorneoT[0]['equipoA'];
                    me.equipo_b=arrayTorneoT[0]['equipoB'];
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });

            }, 
     actualizarProgramacion(id){
              if(this.validarPuntaje()){
                //preventDefault();
                    return;
                }
                let me = this;               
                axios.post('/propartido/actualizar/'+id,{
                    'idtorneo' : this.idtorneo,   
                    'fecha':this.fecha,
                    'hora':this.hora,
                    'idsede':this.idsede,                 
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPartido(this.idtorneo);
                    me.arrayProPartido = [];
                    //me.idtorneo=0;
                   // me.torneo=''                    
                }).catch(function (error) {
                    console.log(error);
                }); 
            },                               
    puntaje(){
            let me=this;
                var url = '/propartido/obtenerpunto';
                axios.get(url).then(function (response) {
                    console.log(response.data);
                    var respuesta= response.data;
                    //me.arrayTorneo = respuesta.torneos;                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
                validarPuntaje(){
                this.errorPuntaje=0;
                this.errorMostrarMsjPuntaje=[];

                if(!this.puntaje_a) this.errorMostrarMsjPuntaje.push("El puntaje A no puede quedar vacío.");
                if(!this.puntaje_b) this.errorMostrarMsjPuntaje.push("El puntaje B no puede quedar vacío.");

                if(this.errorMostrarMsjPuntaje.length) this.errorPuntaje=1;
                return this.errorPuntaje;
            },
       selectTorneo(){
        let me=this;
                var url = '/torneo/selectTorneo';
                axios.get(url).then(function (response) {
                   // consolo.log(response);
                    var respuesta= response.data;
                    me.arrayTorneo = respuesta.torneos;                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });     
            }, 
     pdfProPartido(idtorneo){
              //window.open('/puntaje/pdf/'+ id ,'_blank');
              window.open('/propartido/programacionPdf/' + idtorneo,'_blank');
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
      abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion)
                        {
                             case "registrar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Resgistrar Categoria';
                                this.puntaje_a= 0;
                                this.puntaje_b = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case "actualizar":
                            {
                                this.modal = 1;
                                this.tituloModal = 'Ingrasar';
                                this.tipoAccion = 2;
                                this.id = data['id'];
                                this.fecha = data['fecha']
                                this.hora = data['hora']
                                this.idsede= data['idsede'];
                                this.puntaje_b = data['puntaje_b'];

                                break;
                            }
                            //console.log();
                        }
                      

                    }
                }
            },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";     
    }
  },
     mounted() {

        this.selectSede();
        this.selectTorneo();
  }
}
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
