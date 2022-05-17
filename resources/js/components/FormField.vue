<template>
    <DefaultField :field="currentField">
        <template #field>
            <div class="flex flex-wrap items-stretch w-full relative">
                <div class="flex -mr-px">
                    <span class="flex items-center bg-gray-100 rounded rounded-r-none px-3 whitespace-no-wrap text-sm form-control form-input-bordered">{{ currentField.currency }}</span>
                </div>
                <input
                    :id="currentField.attribute"
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
    import {DependentFormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [DependentFormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        computed: {
            defaultAttributes() {
                return {
                    type: this.currentField.type || 'number',
                    min: this.currentField.min,
                    max: this.currentField.max,
                    step: this.currentField.step,
                    pattern: this.currentField.pattern,
                    placeholder: this.currentField.placeholder || this.currentField.name,
                    class: this.errorClasses,
                }
            },

            extraAttributes() {
                const attrs = this.currentField.extraAttributes

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
                this.value = this.currentField.value || 0
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.currentField.attribute, this.value || 0)
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            }
        },

        mounted() {
            this.value = parseFloat(this.value).toFixed(this.currentField.subUnits);
        },
    }
</script>
