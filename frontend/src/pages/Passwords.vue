<template>
    <q-page class="bg-grey-2"
            :class="($q.screen.xs || $q.screen.sm)
                    ? 'q-pt-md'
                    : 'q-pt-md'">
        <!-- Breadcrumbs -->
        <div :class="($q.screen.xs || $q.screen.sm)
                    ? 'q-px-sm q-pt-none'
                    : 'q-px-md q-pt-sm'">
            <Breadcrumbs :cta="true">
                <template v-slot:cta>
                    <BreadcrumbCTALeft
                        @click="setModal({ key: 'pass_modal', state: true })"
                        icon="add"
                        text="Nova Senha"/>
                    <BreadcrumbCTARight
                        @click="setModal({ key: 'pass_search', state: true })"
                        icon="search"
                        text="Procurar"/>
                </template>
            </Breadcrumbs>
        </div>

        <!-- Card -->
        <div class="animated fadeInUp q-pb-md"
             :class="($q.screen.xs || $q.screen.sm)
                    ? 'q-px-none q-pt-none'
                    : 'q-px-md q-pt-md'">
            <div class="row q-pb-md"
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
                        <TablePasswords/>
                    </q-card>
                    <q-separator v-if="($q.screen.xs || $q.screen.sm)"/>
                </div>
            </div>
        </div>

        <!-- Modals -->
        <ModalPassManagement/>
        <ModalSearchPass/>
    </q-page>
</template>

<script>
import Breadcrumbs from "components/general/Breadcrumbs.vue";
import ModalPassManagement from "components/modals/ModalPassManagement.vue";
import TablePasswords from "components/general/TablePasswords.vue";
import BreadcrumbCTALeft from "components/general/BreadcrumbCTALeft.vue";
import BreadcrumbCTARight from "components/general/BreadcrumbCTARight.vue";
import ModalSearchPass from "components/modals/ModalSearchPass.vue";

export default {
    name: 'Passwords',
    components: {
        ModalSearchPass,
        BreadcrumbCTARight,
        BreadcrumbCTALeft,
        TablePasswords,
        ModalPassManagement,
        Breadcrumbs
    },
    data() {
        return {}
    },
    mounted() {},
    methods: {},
}
</script>
<style>
</style>
