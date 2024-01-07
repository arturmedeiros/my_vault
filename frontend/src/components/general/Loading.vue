<template>
    <div class="animated fadeIn">
        <q-card-section class="q-pt-md  q-pb-xs shadow-0" v-if="true">
            <q-card class="q-pa-xs q-pt-md bg-transparent text-center shadow-0">
                <div class="row " :style="height ? `min-height: ${height}` : 'min-height: 500px;' " style="">
                    <div class="col-12 flex justify-center content-center">
                        <q-spinner-ios size="4.5em" color="grey-7"/>
                        <q-spinner-puff v-if="false" size="4.5em" color="grey-7"/>
                        <q-spinner-dots v-if="false" size="4.5em" color="grey-7"/>
                    </div>
                </div>
            </q-card>
        </q-card-section>
    </div>
</template>

<script>
export default {
    name: "Loading",
    props: ['height']
}
</script>

<style scoped>

</style>
