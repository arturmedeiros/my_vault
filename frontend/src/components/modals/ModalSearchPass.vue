<template>
    <q-dialog v-model="configs.modals.search_pass"
              persistent
              transition-show="fadeIn"
              transition-hide="fadeIn">
      <q-card class="q-px-md q-pb-md" :style="'min-width: 350px; border-radius: 15px;'">
            <q-card-section class="q-pb-none">
                <div class="text-h6">
                  Procurar
                </div>
            </q-card-section>

            <q-card-section class="q-pt-none">
              <q-input dense v-model="address"
                       autofocus
                       @keyup.enter="prompt = false" />
            </q-card-section>

            <q-card-actions class="q-px-md" align="right">
              <q-btn unelevated
                     rounded
                     outline
                     style="font-weight: 600;"
                     class="shadow-0"
                     @click="setModal({ key: 'search_pass', status: false })"
                     color="primary">
                <q-item-label class="q-px-sm">
                  <span class="" style="">Cancelar</span>
                </q-item-label>
              </q-btn>
              <q-btn unelevated
                     @click="save()"
                     rounded
                     style="font-weight: 600;"
                     class="shadow-0"
                     color="primary">
                <q-item-label class="q-px-sm">
                  <span style="">Buscar</span>
                </q-item-label>
              </q-btn>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script>
export default {
    name: "ModalSearchPass",
    mounted() {
    },
    methods: {
    }
}
</script>

<style scoped>

</style>
