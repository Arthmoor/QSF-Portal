function get_folder(select)
{
  self.location.href = window.location.protocol + '//' + window.location.hostname + '/index.php?a=pm&f=' + select.value;
}

function pm_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

pm_ready(function () {
  document.getElementById("pm_select_all").addEventListener("click", function() { select_all_boxes(); } );
  document.getElementById("pm_jumpselect1").addEventListener("change", function() { get_folder(this); } );
  document.getElementById("pm_jumpselect2").addEventListener("change", function() { get_folder(this); } );
})