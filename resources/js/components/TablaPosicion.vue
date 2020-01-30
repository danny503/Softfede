<template>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header"> 
          <div class="form-group row">
            <label class="col-md-4 form-control-label" for="text-input">Torneo</label>           
              <div class="col-md-8">
                <select class="form-control" v-model="idtorneo">
                  <option value="0" disabled>Seleccione</option>
                    <option v-for="torneo in arrayTorneo" :key="torneo.id" :value="torneo.id" v-text="torneo.nombre" v-on:change="listarEstadistica()" ></option>
                </select>                
              </div>              
          </div>
        </div>  
  
                            <button type="button" @click="listarEstadistica()" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i>
                    </button>          
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Tablas de pocisiones</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="" class="table table-bordered table-hover list-group-item-primary">
                    <thead>
                      <tr>
                        <th>Equipos</th>
                        <th>J.J</th>
                        <th>J.G</th>
                        <th>J.P</th>
                        <th>Pts</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="estad in arrayEstadistica" :key="estad.id ">
                        <td v-text="estad.nombre"></td>
                        <td v-text="estad.pj"></td>
                        <td v-text="estad.pg"></td>
                        <td v-text="estad.pp"></td>
                        <td v-text="estad.pts"></td>
                      </tr>                        
                    </tbody>
                    <tfoot>
                     
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->             
            </div><!-- /.col -->
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
                arrayTorneo:[],
                arrayEstadistica:[]
            }
        },
        methods :{
            listarEstadistica(){
                let me=this;
                this.arrayEstadistica = [];
                axios.get('/estadistica', {params: {idtorneo:this.idtorneo}}).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEstadistica = respuesta.estadistica;
                    console.log(respuesta);
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
    },
    mounted() {
        //this.listarEstadistica();
        this.selectTorneo();
    }
}

</script>
