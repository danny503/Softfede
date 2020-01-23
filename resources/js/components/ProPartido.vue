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
               <h1>Generar partidos aleatorios</h1>
               <button type="button" @click="listarPartido()" class="btn btn-info btn-sm">
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
                </tr>
              </thead>
              <tbody>
                <tr v-for="propartido in arrayProPartido" :key="propartido.id">                  
                  <td v-text="propartido.jornada"></td> 
                 <!-- <td>
                  <input type="text" v-model="jornada" class="form-control"/>
                  </td>-->                            
                  <td>
                  <input type="text" v-model="propartido.eq1" class="form-control"  disabled/>
                  </td>                  
                  <!--<td v-text="propartido.eq1"></td>-->
                  <td>Vs</td>
                  <td>
                  <input type="text" v-model="propartido.eq2" class="form-control"  disabled/>
                  </td>
                  <td>
                  <input type="date"  class="form-control" />
                  </td>
                  <td>
                  <input type="time"  class="form-control" />
                  </td> 
                  <td>
                  <div class="col-md-9">
                    <div class="form-group row">              
                          <select class="form-control" >
                            <option value="" disabled>Seleccione la sede</option>
                              <option value="Escolta">Maraña</option>
                                <option value="Pivote">Chalate</option>
                          </select>
                        </div>
                    </div>  
                  </td>                                   
                  <!--<td v-text="propartido.eq2"></td> -->
                </tr>                   
                <button type="button" @click="registrarProPartido() " class="btn btn-primary">
                      <i class="fa fa-add"></i>&nbsp;Guardar
                </button>
              </tbody>
            </table>
          </div>
               </form> 
            </div>      
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
           // ideq1:0,
            ideq2:0,
            equipo_b:0,
            equipo:'',
            torneo:''           ,
            equipo_id:0,
            idtorneo:0, 
            arrayProPartido:[],
            arrayTorneo:[]
        }
    },              
    methods:{
        listarPartido() {
          //console.log(this.idtorneo);
          this.arrayProPartido = [];
          let me = this;
            axios.get('/propartido',{params: {idtorneo:this.idtorneo}}).then(function(response) {
              //me.arrayProPartido = response.data;
              var x = response.data;
              var l = x.length;
              for(var index=0; index < l; index++){
              // x[index][0] ,'vs', x[index][1];
              me.arrayProPartido.push({'eq1': x[index][0].nombre,'eq2': x[index][1].nombre,'jornada': x[index][2],'ideq1': x[index][0].id,'ideq2': x[index][1].id});
              //console.log('eq1');
              }
         //console.log(response.data);
        })
        .catch(function(error) {
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
     registrarProPartido() {       
      let me = this;        
      //console.log(this.arrayProPartido[0].ideq1);
      axios.post('/propartido/registrar', {
          'idtorneo':this.idtorneo,              
          'programaciones': this.arrayProPartido                
        })
        .then(function(response) {         
          me.listarPartido();
          me.arrayProPartido=[];
          me.idtorneo=0;
          me.torneo=''
        })
        .catch(function(error) {
          console.log(error);
        });
    },
     pdfProPartido(idtorneo){
              //window.open('/puntaje/pdf/'+ id ,'_blank');
              window.open('/propartido/programacionPdf/' + idtorneo,'_blank');
            },
  },
     mounted() {
        //this.listarPartido();
        this.selectTorneo();
  }
}
</script>