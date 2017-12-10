(function() {
  var DropdownAjax = {
    init: function() {
      this.selectField = document.querySelectorAll("select[dropdown-ajax]");
      this.registerEvents();
    },

    registerEvents: function() {
      Array.from(this.selectField).forEach(function(l) {
        l.addEventListener("change", DropdownAjax.render);
      });
    },

    render: function(e) {
      var el = this,
        urlSelector,
        outputSelector;

      urlSelector =
        el.getAttribute("dropdown-ajax-url") + `?category_id=${el.value}`;

      outputSelector = document.getElementById(
        el.getAttribute("dropdown-ajax-output-id")
      );
      console.log(outputSelector);

      fetch(urlSelector)
        .then(function(response) {
          return response.text();
        })
        .then(function(body) {
          outputSelector.innerHTML = body;
        });
    },

    setAttributes: function(el, attrs) {
      for (var key in attrs) {
        el.setAttribute(key, attrs[key]);
      }
    }
  };

  DropdownAjax.init();
  console.log("cuk");
})();
