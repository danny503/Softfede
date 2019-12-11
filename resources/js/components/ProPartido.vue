<template>
    <!-- CONTENIDO-->
        <!-- Main content -->
        <div class="content-wrapper">
        <section class="invoice" style="border-top: solid;">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> Softfede.
                <h3>Programaci&oacute;n de partidos</h3>
              </h2>
            </div><!-- /.col -->

          </div>
          <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Rama</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idrama">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="rama in arrayRama" :key="rama.id" :value="rama.id" v-text="rama.nombre"></option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
          <!-- info row -->
            <button class="btn btn-dark pull-left"  style="margin-left"> <router-link to="/rama"></router-link><i class="fa fa-download"></i>Generar partidos aleatorios</button>
          <!-- Table row -->

        </section><!-- /.content -->
        </div>
</template>
