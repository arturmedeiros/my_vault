<template>
    <div class="fullscreen bg-menu text-white text-center q-pa-md flex flex-center">
        <div class="q-px-lg">
            <div style="font-size: 20vh;">
                404
            </div>

            <div class="text-h2" style="font-size: 5vh; opacity:.6;">
                Page not found.
            </div>

            <q-btn
                class="q-mt-xl"
                color="white"
                text-color="dark"
                unelevated
                to="/"
                rounded
                label="Return to the Dashboard"
                no-caps
            />
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: 'Error404',
    mounted() {
    }
})
</script>
