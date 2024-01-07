<template>
    <q-dialog persistent
              v-model="configs.modals.alert_file_size">
        <q-card class="q-px-sm q-py-md" style="border-radius: 15px;">
            <q-card-section class="text-center">
                <div class="text-h6">Arquivo muito grande!</div>
            </q-card-section>

            <q-card-section class="text-center q-pt-none">
                <div>Parece que você fez upload de um tipo arquivo não permitido.</div>
                <div>Tipos permitidos: JPG, JPEG e PNG.</div>
            </q-card-section>

            <q-card-actions align="center">
                <q-btn label="OK"
                       rounded
                       unelevated
                       color="deep-purple-5"
                       @click="setModal({ key: 'alert_file_size', status: false })"/>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script>
export default {
    name: "ModalAlertFileSizeError",
    mounted() {
    },
    methods: {
    }
}
</script>

<style scoped>

</style>
