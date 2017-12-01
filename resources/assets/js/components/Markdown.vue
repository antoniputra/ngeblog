<template>
  <div>
    <div class="columns">
      <div class="column">
        <textarea :name="name" class="textarea textarea-markdown"
          :rows="textarea_row"
          :value="content"
          @keyup="autoSize"
          @input="update"></textarea>
      </div>
      <div class="column">
        <div v-html="compiledMarkdown"></div>
      </div>
    </div>
  </div>
</template>

<script>
  import marked from 'marked'
  import _ from 'lodash'

  export default {
    props: ['name', 'value'],
    data () {
      return {
        textarea_row_default: 3,
        textarea_row: 3,
        content: ''
      }
    },
    computed: {
      compiledMarkdown: function () {
        return marked(this.content, { sanitize: true })
      }
    },
    methods: {
      autoSize: function (e) {
        var str = e.target.value
        var lineCount = str.split(/\r\n|\r|\n/).length

        // console.log(
        //   'line: '+ lineCount,
        //   'height: '+ this.textarea_row,
        //   'event grow: '+ (lineCount > this.textarea_row),
        //   'event shrink: '+ (lineCount <= this.textarea_row && this.textarea_row > 3)
        // )

        if (e.key == 'Enter') {
          if (lineCount > this.textarea_row) {
            this.textarea_row += 1
          }
        }

        if (e.key == 'Backspace' || e.key == 'Delete') {
          if (lineCount <= this.textarea_row && lineCount !== this.textarea_row && this.textarea_row > 3) {
            this.textarea_row -= 1
          }
        }

        if (lineCount < this.textarea_row) {
          this.textarea_row = this.textarea_row_default
        }
      },
      update: _.debounce(function (e) {
        this.content = e.target.value
      }, 100)
    },
    created() {
      this.content = this.value

      var lineCount = this.content.split(/\r\n|\r|\n/).length
      if (lineCount > 0) {
        this.textarea_row = this.textarea_row_default = lineCount
      }

    }
  }
</script>

<style lang="scss" scoped>
  .textarea-markdown {
    border-width: 0px;
    background: #fafafa;

    &:focus {
      border-color: transparent;
      box-shadow: inset 0 1px 2px rgba(10, 10, 10, 0.1);
    }
  }
</style>