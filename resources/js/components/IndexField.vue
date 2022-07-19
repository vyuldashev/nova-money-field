<template>
    <div>{{ formattedValue }}</div>
</template>

<script>
    import mixin from './mixin';

    export default {
        props: ['resourceName', 'field'],
        mixins: [mixin],
    }
</script>
