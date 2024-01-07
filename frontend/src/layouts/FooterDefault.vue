<template>
    <q-footer bordered style="position: absolute;" class="bg-white text-grey-8 q-py-xs q-px-sm">
        <q-toolbar>
            <div>
        <span style="font-size: .8rem !important;">
            {{ copyrightMessage }}
            <a style="font-weight: 600; text-decoration: none; color: black;"
                target="_blank"
                :href="copyrightLink">
                {{ copyright }}
            </a>
        </span>
            </div>
            <q-space></q-space>
            <div class="">
                <span style="font-size: .8rem !important;">Version {{ configs.app_version }}</span>
            </div>
        </q-toolbar>
    </q-footer>
</template>

<script>
export default {
    name: "FooterDefault",
    data() {
        return {
            copyright: "ARJOS",
            copyrightLink: "https://arjos.eu/",
        }
    },
    computed: {
        copyrightMessage() {
            let year = new Date().getFullYear()
            return `${year} - My Vault by`
        },
    }
}
</script>

<style scoped>
</style>
