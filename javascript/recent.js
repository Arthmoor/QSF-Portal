function get_recent(select)
{
  if(select.value.substring(0, 1) == '.'){
    self.location.href = window.location.protocol + '//' + window.location.hostname + '/board/category/' + select.value.substring(1, select.value.length);
  }else{
    self.location.href = window.location.protocol + '//' + window.location.hostname + '/forum/' + select.value;
  }
}

function recent_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

recent_ready(function () {
  document.getElementById("recent_jump").addEventListener("change", function() { get_recent(this); } );
})