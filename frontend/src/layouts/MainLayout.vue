<template>
    <q-layout v-if="true"
              view="lHh Lpr lFf"
              class="bg-white">
        <Loading height="90vh" v-show="configs.loading"/>

        <div v-show="!configs.loading">
          <!-- HEADER -->
          <HeaderDefault/>

          <!-- CONTENT -->
          <q-page-container>
            <transition
                appear
                enter-active-class="animated fadeIn"
                leave-active-class="animated fadeOut">
              <router-view/>
            </transition>
          </q-page-container>

          <!--  FOOTER -->
          <FooterDefault/>

          <!--  MODALS -->
          <!-- TODO: IMPLEMENTAR -->
        </div>

    </q-layout>
</template>

<script>
import {defineComponent, ref} from 'vue'
import FooterDefault from "layouts/FooterDefault";
import HeaderDefault from "layouts/HeaderDefault";
import Loading from "components/general/Loading.vue";

export default defineComponent({
    name: 'MainLayout',
    components: {
      Loading,
        HeaderDefault,
        FooterDefault
    },
    mounted() {
        this.loadResources();
    },
    methods: {
        loadResources() {
            this.$store.dispatch('setLoadDataApi')
        },
    },
})
</script>
