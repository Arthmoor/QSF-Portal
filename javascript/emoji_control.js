function image_preview(selected)
{
  document.emoji_preview.src = '../emojis/' + selected.options[selectedIndex].value;
}

function emojis_ready(triggerEvents) {
    if (document.readyState != "loading") return triggerEvents();
    document.addEventListener("DOMContentLoaded", triggerEvents);
}

emojis_ready(function () {
  document.getElementById("emoji_new_image").addEventListener("change", function() { image_preview(this); } );
})