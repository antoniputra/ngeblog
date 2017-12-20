<template>
  <div class="field">
    <label class="label">Blog Meta</label>
    <div v-show="isLoading" class="control">
      <table id="meta-items" class="table is-fullwidth is-narrow">
        <template v-if="compMetas.length > 0">
          <tr v-for="(m, index) in compMetas">
            <td style="width: 5%;">
              <span class="drag-handle ion-arrow-move"></span>
            </td>
            <td style="width: 30%;">
              <!-- <input type="text" :name="'order[]'" :value="index"> -->
              <input type="text" :name="'meta_key[]'" :value="_.get(currentValue, [index, 'meta_key'], m.meta_default_key)" class="input" />
            </td>
            <td>
              <meta-field :meta-data="m" :the-index="index"></meta-field>
            </td>
          </tr>
        </template>
        <tr v-else>
          <td>There is no meta. <a :href="urlMetaCreate">Click here</a> to create meta configuration.</td>
        </tr>
      </table>
    </div>
    <div v-show="!isLoading">
      loading prend....
    </div>
  </div>
</template>

<script>
  import Sortable from 'sortablejs'
  import axios from 'axios'
  import _ from 'lodash'

  export default {
    props: ['value', 'url-meta-create', 'url-meta-api', 'current-category-id'],
    components: {
      'meta-field': require("./MetaField.vue")
    },
    data () {
      return {
        metas: [],
        currentValue: [],
        isLoading: false,
        fetchError: null
      }
    },
    computed: {
      compMetas: function () {
        if (this.currentValue.length > 0 && this.$root.category_id == this.currentCategoryId) {
          return this.currentValue
        }
        return this.metas
      }
    },
    methods: {
      fetchMeta () {
        var self = this,
          url = this.urlMetaApi +'?category_id='+ parseInt(this.$root.category_id)
        self.isLoading = false

        return axios.get(url)
          .then(function (response) {
            self.metas = response.data
            self.isLoading = true
          })
          .catch(function (error) {
            self.fetchError = error
          })
      }
    },
    mounted () {
      if (this.value) {
        this.currentValue = JSON.parse(this.value)
      }
      this.$root.category_id = parseInt(document.querySelector('meta[name=category_id]').content)

      this.fetchMeta()

      var self = this
      self.$nextTick(function () {
        console.log(document.getElementById('meta-items'))
        var srt = Sortable.create(document.getElementById('meta-items'), {
          animation: 150,
          handle: '.drag-handle',
          onEnd: function(e) {
            console.log('on end event prend...')
          }
        })
      })
    }
  }
</script>