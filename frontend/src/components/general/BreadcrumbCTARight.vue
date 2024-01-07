<template>
    <q-btn rounded
           :round="($q.screen.xs || $q.screen.sm)"
           unelevated
           color="primary"
           :class="'q-ml-sm'"
           style="border-radius: 50px; text-transform: initial;">
        <q-icon v-if="($q.screen.xs || $q.screen.sm)"
                :name="icon" size="18px"/>
        <q-item-label v-if="!($q.screen.xs || $q.screen.sm)"
                      class="q-px-sm">
            <q-icon :name="icon" size="16px"/>
            <span class="q-pl-sm">{{ text }}</span>
        </q-item-label>
    </q-btn>
</template>

<script>
export default {
    name: "BreadcrumbCTARight",
    props: {
        'icon': { type: String }, // search
        'text': { type: String }, // Procurar
    },
    computed: {},
}
</script>


<style scoped>

</style>
