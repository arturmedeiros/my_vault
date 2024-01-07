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
        <div class="animated fadeInUp"
             :class="($q.screen.xs || $q.screen.sm)
                    ? 'q-px-none q-pt-none'
                    : 'q-px-md q-pt-md'">
            <div class="row"
                 :class="($q.screen.xs || $q.screen.sm)
                        ? 'q-px-none'
                        : 'q-px-md'">
                <div class="col-12">
                    <!-- Header  -->
                    <q-card-section>
                        <div class="text-h6">
                            Header
                        </div>
                    </q-card-section>
                    <q-separator v-show="true"/>
                    <q-card flat
                            :bordered="!($q.screen.xs || $q.screen.sm)"
                            :class="($q.screen.xs || $q.screen.sm)
                                    ? ''
                                    : 'border-radius-15'">
                        <q-card-section>
                            Blank Page
                        </q-card-section>
                    </q-card>
                </div>
            </div>
        </div>

    </q-page>
</template>

<script>
import Breadcrumbs from "components/general/Breadcrumbs.vue";

export default {
    name: 'BlankPage',
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
