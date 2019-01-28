 document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, open());

    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, open());

  });

