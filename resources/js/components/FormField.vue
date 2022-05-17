<template>
    <DefaultField :field="field">
        <template #field>
            <div class="flex flex-wrap items-stretch w-full relative">
                <div class="flex -mr-px">
                    <span class="flex items-center bg-gray-100 rounded rounded-r-none px-3 whitespace-no-wrap text-sm form-control form-input-bordered">{{ field.currency }}</span>
                </div>
                <input
                    :id="field.attribute"
                    type="number"
                    class="flex-1 relative focus:border-blue focus:shadow form-control form-input form-input-bordered rounded-l-none"
                    v-bind="extraAttributes"
                    v-model="value"
                />
            </div>
            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </DefaultField>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        computed: {
            defaultAttributes() {
                return {
                    type: this.field.type || 'number',
                    min: this.field.min,
                    max: this.field.max,
                    step: this.field.step,
                    pattern: this.field.pattern,
                    placeholder: this.field.placeholder || this.field.name,
                    class: this.errorClasses,
                }
            },

            extraAttributes() {
                const attrs = this.field.extraAttributes

                return {
                    // Leave the default attributes even though we can now specify
                    // whatever attributes we like because the old number field still
                    // uses the old field attributes
                    ...this.defaultAttributes,
                    ...attrs,
                }
            },
        },

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || 0
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || 0)
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            }
        },

        mounted() {
            this.value = parseFloat(this.value).toFixed(this.field.subUnits);
        },
    }
</script>
