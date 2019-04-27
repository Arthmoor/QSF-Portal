function prune_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

prune_ready(function () {
  document.getElementById("prune_select_all").addEventListener("click", function() { select_all_boxes(); } );
})