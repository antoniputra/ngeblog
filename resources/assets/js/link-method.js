/**
 * This Javascript Vanilla will help you to transform anchor link into triggered form.
 * 
 * You write this:
 * <a href="http://localhost/data/delete/1" data-method="delete" data-confirm="Are you sure">Delete</a>
 *
 * When above link clicked, below will rendered & triggered:
 * <form method="POST" action="http://localhost/data/delete/1">
 *   <input type="text" name="_token" value="{the-laravel-token}">
 *   <input type="text" name="_method" value="delete">
 * </form> 
 *
* @see  [jquery version] https://gist.github.com/JeffreyWay/5112282
 */

(function() {

  var LinkSangar = {
    init: function () {
      this.links = document.querySelectorAll('a[data-method]')
      this.registerEvents()
    },

    registerEvents: function () {
      Array.from(this.links).forEach(function (l) {
        l.addEventListener('click', LinkSangar.render)
      })
    },

    render: function (e) {
      var el = this,
        httpMethod,
        form

      httpMethod = el.getAttribute('data-method')

      // Ignore when the data-method attribute is not PUT or DELETE,
      if (['PUT', 'DELETE'].indexOf(httpMethod.toUpperCase()) === -1) {
        return;
      }

      // Allow user to optionally provide data-confirm="Are you sure?"
      if (el.hasAttribute('data-confirm') && ! LinkSangar.verifyConfirm(el) ) {
        e.preventDefault()
        return false;
      }

      form = LinkSangar.createForm(el)
      form.submit()

      e.preventDefault()
    },

    verifyConfirm: function (link) {
      return confirm(link.getAttribute('data-confirm'))
    },

    createForm: function (link) {
      var form = document.createElement('form')
      LinkSangar.setAttributes(form, {
        method: 'POST',
        action: link.getAttribute('href')
      })

      var laravelToken = document.querySelector("meta[name=csrf-token]").getAttribute('content');

      if (!laravelToken) {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
      }

      var inputToken = document.createElement('input')
      LinkSangar.setAttributes(inputToken, {
        type: 'text',
        name: '_token',
        value: laravelToken
      })

      var inputMethod = document.createElement('input')
      LinkSangar.setAttributes(inputMethod, {
        type: 'text',
        name: '_method',
        value: link.getAttribute('data-method')
      })

      form.appendChild(inputToken)
      form.appendChild(inputMethod)
      document.body.appendChild(form)

      return form
    },

    setAttributes: function (el, attrs) {
      for (var key in attrs) {
        el.setAttribute(key, attrs[key]);
      }
    }
  }

  LinkSangar.init()

})();