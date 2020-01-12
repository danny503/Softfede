<template>
    <div>
        <navbar :app="this"></navbar>

        <spinner v-if="loading"></spinner>
        <div v-else-if="initiated">
            <router-view :app="this" />
        </div>
    </div>
</template>

<script>
    import Navbar from "./components/navbar";
    import Helper from './utils/helper'
    export default {
        name: "App",
        components: {Navbar},
        data()
        {
            return {
                loading: false,
                initiated: false,
                helper: Helper,
                req: axios.create({
                    baseURL: BASE_URL
                }),
                user: null,
            }
        },
        mounted(){
            this.init();
        },
        methods: {
            init()
            {
                this.loading = true;

                this.req.get('init').then((response) => {
                    this.loading = false;
                    this.initiated = true;

                    if (response.data.user)
                    {
                        this.user = response.data.user;
                    }
                });
            }
        }
    }
</script>

<style>

</style>