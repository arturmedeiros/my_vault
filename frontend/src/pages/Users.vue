<template>
    <q-page class="bg-grey-2"
            :class="($q.screen.xs || $q.screen.sm)
          ? 'q-pt-md'
          : 'q-pt-md'">
        <!-- Breadcrumbs -->
        <div :class="($q.screen.xs || $q.screen.sm)
          ? 'q-px-sm q-pt-none'
          : 'q-px-md q-pt-sm'">
            <Breadcrumbs/>
        </div>

        <!-- Card -->
        <div class="animated fadeInUp"
             :class="($q.screen.xs || $q.screen.sm)
          ? 'q-px-none q-pt-none'
          : 'q-px-md q-pt-md'">
            <div class="row"
                 :class="($q.screen.xs || $q.screen.sm)
            ? 'q-px-none'
            : 'q-px-md'">
                <div class="col-12">
                    <q-separator v-if="($q.screen.xs || $q.screen.sm)"/>
                    <q-card flat
                            :bordered="!($q.screen.xs || $q.screen.sm)"
                            :class="($q.screen.xs || $q.screen.sm)
                    ? ''
                    : 'border-radius-15'">
                        <!--  Table  -->
                    </q-card>
                    <q-separator v-if="($q.screen.xs || $q.screen.sm)"/>
                </div>
            </div>
        </div>

        <!-- Modals -->
    </q-page>
</template>

<script>
import Breadcrumbs from "components/general/Breadcrumbs";

export default {
    name: 'Users',
    components: {
        Breadcrumbs
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
