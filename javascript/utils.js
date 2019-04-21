/* General javascript utils loaded on all pages */

/* A centered pop-up window for any cases that might need one */
function CenterPopUp( URL, name, width, height ) {
	var left = ( screen.width - width ) / 2;
	var top  = ( screen.height - height ) / 2;
	var settings;

	if( left < 0 ) left = 0;
	if( top < 0 ) top = 0;

	settings = 'width=' + width + ',';
	settings += 'height=' + height + ',';
	settings += 'top=' + top + ',';
	settings += 'left=' + left;

	window.open( URL, name, settings );
}

/* Use this when wanting a function to run onload. That way you allow
multiple functions to run onload without needing to be aware of the other */
function addLoadEvent(func) {
	if (typeof window.attachEvent != 'undefined') {
		window.attachEvent("onload", func);
	} else {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				oldonload();
				func();
			};
		}
	}
}

function select_all_forums()
{
  opts = document.forms['search'].elements['forums[]'].options
  for(i=0; i<opts.length; i++)
  {
    opts[i].selected = true;
  }
}

function select_all_cats()
{
  opts = document.forms['search'].elements['cats[]'].options
  for(i=0; i<opts.length; i++)
  {
    opts[i].selected = true;
  }
}

function select_all_children(toSelect)
{
  var id;
  var pid;

  opts = document.forms['search'].elements['cats[]'].options
  for(i=0; i<opts.length; i++)
  {
    for(n = 0; n < select_all_children.arguments.length ; n++)
    {
      id = Number(select_all_children.arguments[n]);
      cid = Number(opts[i].value);
      if(id == cid)
        opts[i].selected = true;
    }
  }
}

function select_all_boxes()
{
  formElements = document.getElementsByTagName('input');
  for(i=0; i<formElements.length; i++)
  {
    if (formElements[i].type == 'checkbox') {
      formElements[i].checked = true;
    }
  }
}

function select_all_groups()
{
  opts = document.forms['mailer'].elements['groups[]'].options
  for (i=0; i<opts.length; i++)
  {
    opts[i].selected = true;
  }
}

function get_forum(select,link)
{
  if(select.value.substring(0, 1) == '.'){
    self.location.href = link + '?a=board&c=' + select.value.substring(1, select.value.length);
  }else{
    self.location.href = link + '?a=forum&f=' + select.value;
  }
}

function get_folder(select,link)
{
  self.location.href = link + '?a=pm&f=' + select.value;
}

function get_filecat(select,link)
{
   self.location.href = link + '?a=files&cid=' + select.value;
}

function get_newspost(select,link)
{
   self.location.href = link + '?a=newspost&t=' + select.value;
}