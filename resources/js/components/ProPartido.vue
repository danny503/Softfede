<template>
    <div class="content-wrapper">
        <section class="content-header">            
            <div class="card-header"> 
                <i class="fa fa-align-justify"></i> x
          <button type="button" @click="abrirModal()" class="btn btn-primary">
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
          </div>           
        <div class="card-header">  
            <div class="table-responsive">
               <form action="propartido" method="post" enctype="multipart/form-data">
               <h1>Generar partidos aleatorios</h1>
               <button type="button" @click="pdfProPartido()" class="btn btn-info btn-sm">
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
                  <td v-text="propartido.jornada"></td>
                  <td v-text="propartido.eq1"></td>
                  <td>Vs</td>
                  <td v-text="propartido.eq2"></td>              
                </tr>
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
            nombre:'',           
            equipo_id:0, 
            arrayProPartido:[]
        }
    },              
    methods:{
        listarPartido() {
      let me = this;
      //var url = '/sede?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      axios.get('/propartido').then(function(response) {
          //me.arrayProPartido = response.data;
          var x = response.data;
          var l = x.length;
          for(var index=0; index < l; index++){
           // x[index][0] ,'vs', x[index][1];
           me.arrayProPartido.push({'eq1': x[index][0],'eq2': x[index][1],'jornada': x[index][2]});

          }
          console.log(x);

          console.log('ok');
          console.log(response.data);
          //alert('')
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
     pdfProPartido(id){
              //window.open('/puntaje/pdf/'+ id ,'_blank');
              window.open('/propartido/'+ id ,'_blank');
            },
  },
     mounted() {
        this.listarPartido();
  }
}
</script>