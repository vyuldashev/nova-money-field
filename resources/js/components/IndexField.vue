<template>
    <div :class="`text-${field.textAlign}`">
        <span v-if="field.value" class="whitespace-no-wrap">{{ formattedValue }}</span>
        <span v-else>&mdash;</span>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        props: ['resourceName', 'field'],
        mixins: [mixin],
    }
</script>
