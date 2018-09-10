<template>
    <default-field :field="field">
        <template slot="field">
            <div class="flex items-center">
                <span class="mr-1">{{ field.currency }}</span>
            
                <input :id="field.name" type="text"
                    class="w-full form-control form-input form-input-bordered flex-1"
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
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
          this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
          formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
          this.value = value
        }
    }
}
</script>
