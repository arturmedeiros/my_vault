<template>
    <q-separator v-if="!($q.screen.xs || $q.screen.sm)"/>
    <q-card-section v-if="!($q.screen.xs || $q.screen.sm)">
        <q-card class="no-shadow q-px-none">
            <ButtonsModalActions>
                <template v-slot:CTALeft>
                    <slot name="ModalCTALeft"></slot>
                </template>
                <template v-slot:CTARight>
                   <slot name="ModalCTARight"></slot>
                </template>
            </ButtonsModalActions>
        </q-card>
    </q-card-section>
    <q-footer
        v-else
        style=""
        class="bg-white shadow-2 flex"
        :style="($q.screen.xs || $q.screen.sm) ? 'height: 60px; left: 0;' : ''"
    >
        <ButtonsModalActions>
            <template v-slot:CTALeft>
                <slot name="ModalCTALeft"></slot>
            </template>
            <template v-slot:CTARight>
                <slot name="ModalCTARight"></slot>
            </template>
        </ButtonsModalActions>
    </q-footer>
</template>

<script>
import ButtonsModalActions from 'components/general/ButtonsModalActions.vue';

export default {
    name: 'ModalActionsFooter',
    components: {
        ButtonsModalActions
    }
};
</script>

<style scoped>

</style>
