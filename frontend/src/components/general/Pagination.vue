<template>
    <q-pagination v-if="data.total > data.per_page"
                  v-model="page"
                  :max="data.last_page"
                  :max-pages="5"
                  direction-links
                  :ellipses="false"
                  :boundary-numbers="false"
                  round
                  outline
                  flat
                  unelevated
                  class="justify-center"
                  text-color="primary"
                  color="grey-6"
                  active-color="primary"
    />
</template>

<script>
import { api } from "boot/axios";

export default {
    name: "Pagination",
    props: ['data', 'commit'],
    watch: {
        'page': function () {
            this.$store.commit('SET_LOADING_TABLE', true)
            let getUrl = `${this.data.path}?page=${this.page}`;
            api.get(getUrl).then(response => {
                this.$store.commit(this.commit, response.data)
                this.$store.commit('SET_LOADING_TABLE', false)
            }).catch(error => {
                console.log(error);
                this.$store.commit('SET_LOADING_TABLE', false)
            });
        }
    },
    data() {
        return {
            page: 1
        }
    },
    methods: {}
}
</script>

<style scoped>
</style>
