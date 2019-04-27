function get_forum(select)
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
  document.getElementById("forum_jump").addEventListener("change", function() { get_forum(this); } );
})