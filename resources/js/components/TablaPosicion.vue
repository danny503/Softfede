<template>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

                <div class="form- col-md-3">
                  <div class="form-group">
                    <label>Nombre del torneo</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">Amistoso</option>
                      <option>Torneo local</option>
                      <option>Navide&ntilde;o</option>
                    </select>
                  </div>                
                </div>
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
                pj:0,
                pg:0,
                pp:0,
                pts:0,
                arrayEstadistica:[]
            }
        },
        methods :{
            lsitarEstadistica(){
                let me=this;
                axios.get('/estadistica').then(function (response) {
                    var respuesta = response.data;
                    me.arrayEstadistica = respuesta.estadistica;
                    console.log(respuesta);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            }
    },
    mounted() {
        this.lsitarEstadistica();
    }
}

</script>
