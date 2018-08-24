<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <slot>
                <h4 class="font-normal text-80">
                    {{ field.name }}
                </h4>
            </slot>
        </div>
        <div class="w-3/4 py-4">
            <slot name="value">
                <p v-if="field.value" class="text-90">{{ formattedValue }}</p>
                <p v-else>&mdash;</p>
            </slot>
        </div>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        mixins: [mixin],
    }
</script>
