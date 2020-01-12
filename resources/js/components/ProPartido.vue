<template>
  <div class="content-wrapper">
    <section class="content-header">            
      <div class="card-header"> 
        <i class="fa fa-align-justify"></i> x
          <button type="button" @click="abrirModal()" class="btn btn-primary">
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
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
                </button> 
                    <div class="table-responsive">
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th class="text-center list-group-item-success">Jornadas</th>
                  <th class="text-center list-group-item-success">Nombre</th>
                  <th class="text-center list-group-item-success">Vs</th>
                  <th class="text-center list-group-item-success">Nombre</th>                  
                </tr>
              </thead>
              <tbody>
                <tr v-for="propartido in arrayProPartido" :key="propartido.id">
                  <!--<td v-text="propartido.jornada"></td>-->
                  <td>
                  <input type="text" v-model="propartido.jornada" class="form-control" disabled/>
                  </td>
                  <td>
                  <input type="text" v-model="propartido.eq1" class="form-control"  disabled/>
                  </td>
                  <!--<td v-text="propartido.eq1"></td>-->
                  <td>Vs</td>
                  <td>
                  <input type="text" v-model="propartido.eq2" class="form-control"  disabled/>
                  </td>
                  <!--<td v-text="propartido.eq2"></td>                                   -->
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
            equipo_a:0,
            eq1:0,
            eq2:0,
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
            //var url = '/sede?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
            axios.get('/propartido',{params: {idtorneo:this.idtorneo}}).then(function(response) {
              //me.arrayProPartido = response.data;
              var x = response.data;
              var l = x.length;
              for(var index=0; index < l; index++){
              // x[index][0] ,'vs', x[index][1];
              me.arrayProPartido.push({'eq1': x[index][0].nombre,'eq2': x[index][1].nombre,'jornada': x[index][2]});
              }
          //console.log('eq1');
         console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    selectTorneo(){
      //console.log('ok');
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
      /*if (this.validarTorneo()) {
        return;
      }*/
      
      let me = this;      
      axios.post('/propartido/registrar', {
          'jornada': this.propartido.jornada,
          'equipo_a': this.propartido.eq1,
          'equipo_b': this.propartido.equ2,
          'idtorneo':this.propartido.idtorneo,
          //'data' : this.arrayDetalle         
        })
        .then(function(response) {
          console.log(jornada);
          //me.listado=1;
          me.listarPartido();
          me.jornada='';
          me.equipo_a=0;
          me.equipo='';
          me.equipo_b=0;
          me.equipo='';
          me.iddetalle_torneo=0;
          me.torneo=''
          //me.arrayDetalle=[];
         // window.open('/torneo/pdf/'+ response.data.id);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
     pdfProPartido(id){
              //window.open('/puntaje/pdf/'+ id ,'_blank');
              window.open('/propartido/'+ id ,'_blank');
            },
  },
     mounted() {
        //this.listarPartido();
        this.selectTorneo();
  }
}
</script>