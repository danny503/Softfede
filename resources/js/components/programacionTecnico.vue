<template>
  <div class="content-wrapper">
    <section class="content-header">
          <div class="card-header"> 
            <div class="form-group">                       
                <div class="col-lg-6 col-sm-6">               
                <div>
                   <label>Seleccione un Torneo</label>&nbsp;&nbsp;
                <select class="form-control" v-model="idtorneo">
                  <option value="0" disabled>Seleccione</option>
                    <option v-for="torneo in arrayTorneo" :key="torneo.id" :value="torneo.id" v-text="torneo.nombre" v-on:change="listarEstadistica()" ></option>
                </select>
                </div> 
              </div>          
          </div>          
          <div class="form-group">
                <div class="col-lg-3">
                  <ul class="ver">
                    <li class="ver-modal">
                        <a href="#!" class="ver" type="button" @click="listarProTec(idtorneo)"><i class="fa fa-eye"></i>Ver</a>
                    </li>
                     <li>
                        <div class="cart-option">
                          <a href="#!"><i class="fa fa-file" type="button" @click="pdfProPartido(idtorneo)"></i>PDF</a>
                        </div>
                    </li> 
                  </ul>
              </div>         
         </div>   
        </div>  
    </section>                    
        <section id="contant" class="contant">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12 col-sm-12 col-xs-12">			 
                  <h4>Encuentros</h4>
                  <aside id="sidebar" class="left-bar">
                    <div class="feature-matchs">
                      <div class="team-btw-match">
                        <ul v-for="pro in arrayProPartido" :key="pro.id">
                          <li>
                            <span v-text="pro.jornada"></span>
                          </li>
                        <li>
                          <img :src="'images/' + pro.logo1" alt="Logo del equipo" width="50" height="50">
                          <span v-text="pro.equipoA"></span>
                        </li>
                        <li><span>vs</span></li>
                        <li>
                          <img :src="'images/' + pro.logo2" alt="Logo del equipo" width="50" height="50">
                          <span v-text="pro.equipoB"></span>
                        </li>
                        </ul>			  				 			
                      </div>
                    </div>
                  </aside> 
                  </div>
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
            logo: '',
            numero_camisa:0,
            posicion:0,
            puntaje_a: null,
            puntaje_b:null,
            arrayVerp:[],
            ideq2:0,
            equipo_b:0,
            equipo:'',
            torneo:'',
            equipo_id:0,
            idtorneo:0, 
            errors:[],
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
        listarProTec(idtorneo) {
          //console.log(this.idtorneo);
          this.arrayProPartido = [];
          let me = this;
            axios.get('/propartido/listarHome/' + idtorneo).then(function(response) {
               var respuesta= response.data;
                    me.arrayProPartido = respuesta.prootec;
        // console.log(me.arrayProPartido);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },    
       selectTorneo(){
        let me=this;
                var url = '/torneo/torneoSelect';
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
              window.open('/propartido/programaciontecnicoPdf/' + idtorneo,'_blank');
            },
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
