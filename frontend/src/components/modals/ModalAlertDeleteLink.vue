<template>
    <q-dialog persistent
              v-model="configs.modals.alert_delete_link">
        <q-card class="q-px-md q-py-md q-pb-lg" style="border-radius: 15px;">
            <q-card-section class="text-center">
                <div class="text-h6">Tem certeza que deseja remover esse link?</div>
            </q-card-section>

            <q-card-section class="text-center q-pt-none">
                <div>Essa ação é irreversível!</div>
            </q-card-section>

            <q-card-actions align="center">
                <q-btn rounded
                       outline
                       color="deep-purple-5"
                       @click.prevent="setModal({ key: 'alert_delete_link', status: false })"
                       class="shadow-0 q-py-sm "
                       style="border-radius: 50px; text-transform: initial;">
                    <q-item-label class="q-px-md" style="">Cancelar</q-item-label>
                </q-btn>
                <q-btn flat
                       rounded
                       @click.prevent="setModal({ key: 'alert_delete_link', status: false }); remove()"
                       class="bg-deep-purple-5 text-white shadow-0 q-py-sm q-px-md"
                       style="border-radius: 50px; text-transform: initial;">
                    <q-item-label class="q-px-md" style="">Sim, excluir!</q-item-label>
                </q-btn>
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>

<script>
export default {
    name: "ModalAlertDeleteLink",
    mounted() {
    },
    methods: {
        remove() {
            this.$store.dispatch('deleteLink', {
                key: this.links.data.key,
            })

            this.$q.notify({
                message: 'Link removido!',
                color: 'white',
                textColor: 'grey-9',
                position: 'bottom-right',
                icon: 'announcement',
                classes: 'border-radius-15',
                actions: [
                    {
                        icon: 'close',
                        size: 'xs',
                        color: 'grey-9',
                        /*handler: () => {}*/
                    }
                ]
            })
        }
    }
}
</script>

<style scoped>

</style>
