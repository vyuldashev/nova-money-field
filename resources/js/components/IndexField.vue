<template>
    <div :class="`text-${field.textAlign}`">
        <div v-if="field.value" class="whitespace-no-wrap">{{ formattedValue }}</div>
        <div v-else>&mdash;</div>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        props: ['resourceName', 'field'],
        mixins: [mixin],
    }
</script>
