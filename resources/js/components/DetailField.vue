<template>
    <PanelItem :field="field">
        <template #value>
            <p class="text-90">{{ formattedValue }}</p>
        </template>
    </PanelItem>
</template>

<script>
    import mixin from './mixin';

    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        mixins: [mixin],
    }
</script>
