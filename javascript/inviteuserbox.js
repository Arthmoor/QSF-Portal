// Script to open the invite users conversation box when clicked.

var invitetogglestate = false;

function OpenInviteBox() {
  if( !invitetogglestate ) {
    document.getElementById("inviteuserbox").style.display = 'inline';
    invitetogglestate = true;
  } else {
    document.getElementById("inviteuserbox").style.display = 'none';
    invitetogglestate = false;
  }
}

function inviteusersbox_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

inviteusersbox_ready(function () {
  document.getElementById("inviteuserbox").style.display = 'none';
  document.getElementById("inviteuserslink").addEventListener("click", OpenInviteBox);
})