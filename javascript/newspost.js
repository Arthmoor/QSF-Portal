function get_newspost(select)
{
   self.location.href = window.location.protocol + '//' + window.location.hostname + '/newspost/' + select.value;
}

function news_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

news_ready(function () {
  document.getElementById("newspost_select").addEventListener("change", function() { get_newspost(this); } );
})