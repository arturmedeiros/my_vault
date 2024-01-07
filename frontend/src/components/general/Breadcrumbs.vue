<template>
    <div class="row animated fadeInUp">
        <div :class="classCTA()">
            <div style="font-size: 1.5rem;
                  font-weight: 500;">
                {{ title ? title : ($route.meta.title ? $route.meta.title : '') }}
            </div>
            <div class="text-grey-7"
                 style="font-size: .9rem;
                  font-weight: 400;">
                {{ subtitle ? subtitle : ($route.meta.subtitle ? $route.meta.subtitle : '') }}
            </div>
        </div>
        <div v-if="cta"
             class="col-md-6 col-sm-4 col-xs-4"
             :class="($q.screen.xs || $q.screen.sm)
                    ? 'text-right q-pl-none q-pr-md q-pb-md'
                    : 'text-right q-px-md q-pb-md'"
             style="align-self: center;">
            <slot v-if="cta" name="cta"></slot>
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({
    name: 'Breadcrumbs',
    props: [
        'title',
        'subtitle',
        'icon',
        'cta'
    ],
    methods: {
        classCTA(){
            if (this.cta) {
                return 'q-px-md q-pb-md col-md-6 col-sm-8 col-xs-8'
            } else {
                return 'q-px-md q-pb-md col-md-12 col-sm-12 col-xs-12'
            }
        }
    }
})
</script>
