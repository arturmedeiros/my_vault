<template>
    <div class="row full-width">
        <div class="col-6 q-pr-xs q-pl-md flex self-center">
            <slot name="CTALeft"></slot>
        </div>
        <div class="col-6 q-pl-xs q-pr-md flex self-center">
            <slot name="CTARight"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "ButtonsModalActions"
}
</script>

<style scoped>
</style>
