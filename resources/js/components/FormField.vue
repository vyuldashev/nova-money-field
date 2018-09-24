<template>
    <default-field :field="field">
        <template slot="field">
            <div class="flex flex-wrap items-stretch w-full relative h-full">
                <div class="flex -mr-px">
                    <span class="flex items-center bg-30 rounded-r-none px-3 whitespace-no-wrap text-sm form-control form-input-bordered">{{ field.currency }}</span>
                </div>
                <input :id="field.name" type="text"
                       class="flex-1 relative focus:border-blue focus:shadow form-control form-input form-input-bordered"
                       style="border-top-left-radius: 0;border-bottom-left-radius: 0;"
                       :class="errorClasses"
                       :placeholder="field.name"
                       v-model="value"
                />
            </div>
            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

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
