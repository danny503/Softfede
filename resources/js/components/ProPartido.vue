<template>
    <div class="content-wrapper">
        <section class="content-header">            
            <div class="card-header"> 
                <i class="fa fa-align-justify"></i> Sede
          <button type="button" @click="abrirModal('sede','registrar')" class="btn btn-primary">
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
          </div>           
        <div class="card-header">  
            <div class="table-responsive">
               <form action="propartido" method="post" enctype="multipart/form-data">
               <h1>ola</h1>
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
            arrayProPartido:[]
        }
    },      
        
    methods:{
        listarPartido() {
      let me = this;
      //var url = '/sede?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
      axios.get('/propartido').then(function(response) {
          me.arrayProPartido = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    }
  },
     mounted() {
        this.listarPartido();
  }
}
</script>