<template>
    <q-page class="bg-grey-2"
            :class="($q.screen.xs || $q.screen.sm) ? 'q-pt-md' : 'q-pt-md'">
        <!-- Breadcrumbs -->
        <div :class="($q.screen.xs || $q.screen.sm)
                    ? 'q-px-sm q-pt-none'
                    : 'q-px-md q-pt-sm'">
            <Breadcrumbs/>
        </div>

        <!-- Cards -->
        <div class="q-px-md q-pt-md">
            <!-- Content -->
        </div>
    </q-page>
</template>

<script>
import Breadcrumbs from "components/general/Breadcrumbs.vue";

export default {
    name: 'Home',
    components: {
        Breadcrumbs,
    },
    data() {
        return {}
    },
    mounted() {
    },
    methods: {},
}
</script>
<style>
</style>
