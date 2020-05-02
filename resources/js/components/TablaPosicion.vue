<template>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">
          <div class="form-group">                       
              <div class="col-lg-8 col-sm-6">               
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
                      <a href="#!" class="ver" type="button" @click="listarEstadistica()"><i class="fa fa-eye"></i>Ver</a>
                  </li> 
                </ul>  
            </div>  
          </div>       
        </div>                     
        </section>
        <!-- Main content -->
    <section id="contant" class="contant">
	    <div class="container">
	      <div class="row">
		      <div class="col-lg-12 col-sm-12 col-xs-12">
          <h4>Tabla de posiciones</h4>
    			<aside id="sidebar" class="left-bar">
		    		<div class="feature-matchs">
				     <table class="table table-bordered table-hover table table-striped">
					    <thead>
						   <tr>
							<th>#</th>
							<th>Equipo</th>
							<th>Pj</th>
							<th>Pg</th>
							<th>Pp</th>
              <th>Pts</th>
						 </tr>
					  </thead>
					  <tbody>
						 <tr v-for="(estadistica, index) in arrayEstadistica" :key="estadistica.id">               
							<td>{{index + 1}}</td>
							<td><img :src="'images/' + estadistica.logo" alt="Logo del equipo" width="35" height="35">{{estadistica.nombre}}</td>
							<td v-text="estadistica.pj"></td>
							<td v-text="estadistica.pg"></td>
							<td v-text="estadistica.pp"></td>
              <td v-text="estadistica.pts"></td>
						 </tr>						 
					  </tbody>
				   </table>
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
                nombre_equipo: '',
                idtorneo:0,
                nombre_torneo:'',
                pj:0,
                pg:0,
                pp:0,
                pts:0,
                logo: '',
                arrayTorneo:[],
                arrayEstadistica:[]
            }
        },
        methods :{
            listarEstadistica(){
                let me=this;
                this.arrayEstadistica = [];
                axios.get('/estadistica/home', {params: {idtorneo:this.idtorneo}}).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEstadistica = respuesta.estadistica;
                   // console.log(respuesta);
                })
                .catch(function (error) {
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
    },
    mounted() {
        //this.listarEstadistica();
        this.selectTorneo();
    }
}

</script>
