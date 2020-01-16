<template>
  <div class="content-wrapper">
    <section class="content-header">            
      <div class="card-header"> 
      <div class="form-group row">
        <label class="col-md-3 form-control-label" for="text-input">Torneo</label>
          <div class="col-md-9">
            <select class="form-control" v-model="idtorneo">
              <option value="0" disabled>Seleccione</option>
                <option v-for="torneo in arrayTorneo" :key="torneo.id" :value="torneo.id" v-text="torneo.nombre"></option>
            </select>
          </div>
      </div>
    </div>    
    <template v-if="listado==1">       
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
                  <th class="text-center list-group-item-success">Opciones</th>
                </tr>
              </thead>
            <tbody>
                <tr v-for="propartido in arrayProPartido" :key="propartido.id">                  
                  <td v-text="propartido.jornada"></td>                          
                  <td>
                  <input type="text" v-model="propartido.equipoA" class="form-control"  disabled/>
                  </td>                  
                  <!--<td v-text="propartido.eq1"></td>-->
                  <td>Vs</td>
                  <td>
                  <input type="text" v-model="propartido.equipoB" class="form-control"  disabled/>
                  </td>
                  <td>
                 <button type="button" @click="mostrarDetalle()" class="btn btn-info btn-sm">
                          <i class="fa fa-eye"></i>
                  </button> 
                  </td>                                    
                  <!--<td v-text="propartido.eq2"></td> -->
                </tr> 
              </tbody>               
            </table>
          </div>          
               </form> 
            </div>      
        </div>
    </template>
 
 <template v-if="listado==0"> 
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
                  <input type="text" class="form-control" v-model="ganador" />
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
           // ideq1:0,
            arrayVerp:[],
            ideq2:0,
            equipo_b:0,
            equipo:'',
            torneo:'',
            equipo_id:0,
            idtorneo:0, 
            arrayProPartido:[],
            arrayTorneo:[],
            listado:1,
             idjugador: 0,
      idpro_partido:0,
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
        arrayPro: [],
      arrayPuntaje: [],
      arrayDetalle: [],
      arrayPersona:[],
      arrayTorneo:[],
 
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      offset: 3,
      criterio: "",
      buscar: "",
      criterioJ: 'nombre',
      buscarJ: '',
      arrayRama: [],
      arrayCategoria: []
        }
    },              
    methods:{
        listarPartido(idtorneo) {
          //console.log(this.idtorneo);
          this.arrayProPartido = [];
          let me = this;
            axios.get('/propartido/verprogramacion/' + idtorneo).then(function(response) {
              //me.arrayProPartido = response.data;
              /*var x = response.data;
              var l = x.length;
              for(var index=0; index < l; index++){
              // x[index][0] ,'vs', x[index][1];
              me.arrayProPartido.push({'eq1': x[index][0].equipoA,'eq2': x[index][1].equipoB,jornada: x[index][2]});
              console.log('eq1');
              }*/
               var respuesta= response.data;
                    me.arrayProPartido = respuesta.proo;
         console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
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
     ocultarDetalle(){
      this.listado=1;
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
            abrirModal() {  
        this.arrayPersona=[];   
          this.modal = 1;
          this.tituloModal = "Seleccion uno a varios jugadores";  
          //this.selectCategoria();         
    },
     pdfProPartido(idtorneo){
              //window.open('/puntaje/pdf/'+ id ,'_blank');
              window.open('/propartido/programacionPdf/' + idtorneo,'_blank');
            },
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
     mounted() {
        //this.listarPartido();
        this.selectTorneo();
  }
}
</script>