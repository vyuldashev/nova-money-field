<template>
    <DefaultField
        :field="currentField"
        :errors="errors"
        :show-help-text="showHelpText"
    >
        <template #field>
            <div class="flex flex-wrap items-stretch w-full relative">
                <div class="flex">
                    <span class="flex items-center bg-gray-100 rounded rounded-r-none px-3 whitespace-no-wrap text-sm form-control form-input form-control-bordered">{{ currentField.currency }}</span>
                </div>
                <input
                    v-bind="extraAttributes"
                    type="number"
                    class="flex-1 relative focus:border-blue focus:shadow form-control form-input form-control-bordered rounded-l-none"
                    @input="handleChange"
                    :value="value"
                    :id="currentField.uniqueKey"
                    :disabled="currentlyIsReadonly"
                />
            </div>
        </template>
    </DefaultField>
</template>

<script>
    import { DependentFormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        mixins: [HandlesValidationErrors, DependentFormField],

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
             * Set the initial value for the field
             */
            setInitialValue() {
                this.value = !(
                    this.currentField.value === undefined ||
                    this.currentField.value === null
                )
                    ? (this.currentField.value || 0)
                    : (this.value || 0)
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                this.fillIfVisible(formData, this.currentField.attribute, this.value || 0)
            },

        },

        mounted() {
            this.value = parseFloat(this.value).toFixed(this.currentField.subUnits);
        },
    }
</script>
