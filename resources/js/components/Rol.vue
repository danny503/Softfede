<template>
    <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="card-header">

                    <ul class="nav nav-tabs" style="margin-bottom: 15px;">

                        <li><a href="#list" data-toggle="tab"><h1>Rol</h1></a></li>
                    </ul>
                      <div class="tab-pane " id="list">
                            <div class="table-responsive">
                                <table class="table table-hover text-center list-group-item-info">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombre</th>
                                        </tr>
                                    </thead>
                                   <tbody class="list-group-item-info">
                                        <tr v-for="rol in arrayRol" :key="rol.id ">
                                            <td>1</td>
                                            <td v-text="rol.nombre"></td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                        </div>
          <ol class="breadcrumb" style=" margin-left: 10%; max-width: 100%; margin-right: 10%;">
          </ol>
        </section>
       </div>
        <!-- Main content -->
</template>

<script>
    export default {
        data(){
            return{
                nombre : '',
                arrayRol : []
            }
        },
        methods :{
            listarRol(){
                let me=this;
                axios.get('/rol').then(function (response) {
                    //console.log(response);
                    me.arrayRol = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            }
    },
    mounted() {
        this.listarRol();
    }
}

</script>
