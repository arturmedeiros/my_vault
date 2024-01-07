<template>
    <q-dialog v-model="configs.modals.alert"
              persistent
              transition-show="fadeIn"
              transition-hide="fadeIn">
        <q-card>
            <q-card-section>
                <div class="text-h6">Alert</div>
            </q-card-section>

            <q-card-section class="q-pt-none">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum repellendus sit voluptate voluptas
                eveniet porro. Rerum blanditiis perferendis totam, ea at omnis vel numquam exercitationem aut, natus
                minima, porro labore.
            </q-card-section>

            <q-card-actions align="right">
                <q-btn flat label="OK"
                       color="deep-purple-5"
                       @click="setModal({ key: 'alert', status: false })"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script>
export default {
    name: "ModalAlert",
    mounted() {
    },
    methods: {
    }
}
</script>

<style scoped>

</style>
