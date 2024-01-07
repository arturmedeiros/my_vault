<template>
    <q-btn rounded
           :round="($q.screen.xs || $q.screen.sm)"
           outline
           unelevated
           color="primary"
           style="border-radius: 50px; text-transform: initial;">
        <q-icon v-if="($q.screen.xs || $q.screen.sm)"
                :name="icon" size="18px"/>
        <q-item-label v-if="!($q.screen.xs || $q.screen.sm)"
                      class="q-px-sm">
            {{ text }}
        </q-item-label>
    </q-btn>
</template>

<script>
export default {
    name: "BreadcrumbCTALeft",
    props: {
        'icon': { type: String }, // add
        'text': { type: String }, // Nova Senha
    },
    computed: {}
}
</script>

<style scoped>

</style>
