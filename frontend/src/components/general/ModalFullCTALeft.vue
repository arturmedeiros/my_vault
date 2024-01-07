<template>
    <q-btn unelevated
           rounded
           outline
           style="height: 40px; font-weight: 600;"
           class="full-width shadow-0"
           :color="color ? color : 'primary'">
        <q-item-label>
            <span class="" style="">{{ text }}</span>
        </q-item-label>
    </q-btn>
</template>
<script>
export default {
    name: "ModalFullCTALeft",
    props: [
        'color',
        'text'
    ]
}
</script>

<style scoped>

</style>
