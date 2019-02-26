<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <select :id="field.name"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    v-model="value">
                <option v-for="option in options" v-bind:value="option.id" :disabled="(option.id === resourceIdNumber)">
                    {{ '&nbsp &nbsp'.repeat(option.depth-1) }}{{ option.name }}
                </option>
            </select>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            options: [],
            resourceIdNumber: null
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.belongsToId || ''
            this.resourceIdNumber = Number(this.resourceId)
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
        },
    },

    mounted() {
        console.log(this.field)
        Nova.request().get('/nova-vendor/nestedset/' + this.resourceName + '/' + this.field.belongsToRelationship).then(response => {
            this.options = response.data
        })
    }
}
</script>
