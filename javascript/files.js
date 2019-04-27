function get_filecat(select)
{
   self.location.href = window.location.protocol + '//' + window.location.hostname + '/files/category/' + select.value;
}

function recent_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

recent_ready(function () {
  document.getElementById("file_jump").addEventListener("change", function() { get_filecat(this); } );
})