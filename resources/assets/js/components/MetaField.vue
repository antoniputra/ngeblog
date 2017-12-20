<template>
  <div>
    <input type="hidden" :name="'meta_id[]'" :value="metaData.id">
    <input type="hidden" :name="'meta_field[]'" :value="metaData.meta_field">
    <template v-if="metaData.meta_field == 'textarea'">
      <textarea :name="'meta_value[]'" class="textarea" rows="4" :value="getValueByIndex(theIndex)"></textarea>
    </template>
    <template v-else-if="metaData.meta_field == 'text'">
      <input type="text" :name="'meta_value[]'" class="input" :value="getValueByIndex(theIndex)">
    </template>
    <template v-else-if="metaData.meta_field == 'number'">
      <input type="number" :name="'meta_value[]'" class="input" :value="getValueByIndex(theIndex)">
    </template>
    <template v-else-if="metaData.meta_field == 'date'">
      <input type="date" :name="'meta_value[]'" class="input" :value="getValueByIndex(theIndex)">
    </template>
  </div>
</template>

<script>
  import _ from 'lodash'

  export default {
    props: ['meta-data', 'the-index'],
    data () {
      return {
        input_name: 'meta_value['+ this.theIndex +']'
      }
    },
    methods: {
      getValueByIndex(ind) {
        return _.get(this.$parent.currentValue, [ind, 'meta_value'], this.metaData.meta_default_value)
      }
    }
  }
</script>