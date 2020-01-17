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
                  <th class="text-center list-group-item-success">Puntaje A</th>      
                  <th class="text-center list-group-item-success">Puntaje B</th>      
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
                  <td v-text="propartido.puntaje_a"></td>
                  <td v-text="propartido.puntaje_b"></td>

                  <td v-if="!propartido.puntaje_a && propartido.puntaje_b == null ">
                 <button type="button" @click="abrirModal('categoria','actualizar', propartido)" class="btn btn-info btn-sm">
                     <i class="fa fa-plus"></i>
                  </button>
                 <button type="button" @click="puntaje()" disabled class="btn btn-info btn-sm">
                      <i class="fa fa-eye"></i>
                  </button> 
                  </td>  
                  <td v-else="">

                 <button type="button" disabled @click="abrirModal('categoria','actualizar', propartido)" class="btn btn-info btn-sm">
                     <i class="fa fa-plus"></i>
                  </button>
                 <button type="button" @click="mostrarDetalle()" disabled class="btn btn-info btn-sm">
                      <i class="fa fa-eye"></i>
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Puntaje Equipo A</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="puntaje_a" class="form-control" placeholder="">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Puntaje Equipo B</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="puntaje_b" class="form-control" placeholder="">                                      
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
            puntaje_a:0,
            puntaje_b:0,
            arrayVerp:[],
            ideq2:0,
            equipo_b:0,
            equipo:'',
            torneo:'',
            equipo_id:0,
            idtorneo:0, 
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
          this.arrayProPartido = [];
          let me = this;
            axios.get('/propartido/verprogramacion/' + idtorneo).then(function(response) {
               var respuesta= response.data;
                    me.arrayProPartido = respuesta.proo;
         //console.log(response.data);
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
     actualizarProgramacion(id){
                let me = this;
               
                axios.post('/propartido/actualizar/'+id,{
                    'puntaje_a': this.puntaje_a,
                    'puntaje_b': this.puntaje_b,
                    
                    'id': this.id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPartido();
                }).catch(function (error) {
                    console.log(error);
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
                                this.tituloModal = 'Ingrasar puntajes';
                                this.tipoAccion = 2;
                                this.id = data['id'];
                                this.puntaje_a= data['puntaje_a'];
                                this.puntaje_b = data['puntaje_b'];

                                break;
                            }
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
        //this.listarPartido();
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
