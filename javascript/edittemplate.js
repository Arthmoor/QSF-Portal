changed = false;

function savechanges()
{
  if (changed)
  {
    var answer = confirm($this->lang->template_confirm);
    if (answer)
    {
      document.templates.submit();
      return false;
    }
  }
}
// window.onunload = savechanges;
