// Script to open the quickreply box when clicked.

var quickreplyboxtogglestate = false;

function OpenQuickReplyBox() {
  if( !quickreplyboxtogglestate ) {
    document.getElementById("quickreplyform").style.display = 'inline';
    quickreplyboxtogglestate = true;
  } else {
    document.getElementById("quickreplyform").style.display = 'none';
    quickreplyboxtogglestate = false;
  }
}

function quickreply_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

quickreply_ready(function () {
  document.getElementById("quickreplyform").style.display = 'none';
  document.getElementById("quick_reply").addEventListener("click", OpenQuickReplyBox);
})