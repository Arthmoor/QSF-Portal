function select_all_cats()
{
  opts = document.forms['search'].elements['cats[]'].options
  for(i=0; i<opts.length; i++)
  {
    opts[i].selected = true;
  }
}

function select_all_children(toSelect)
{	var id;
	var pid;

	opts = document.forms['search'].elements['cats[]'].options
	for(i=0; i<opts.length; i++)
        {	for(n = 0; n < select_all_children.arguments.length ; n++)
		{	id = Number(select_all_children.arguments[n]);
			cid = Number(opts[i].value);
			if(id == cid)
				opts[i].selected = true;
		}

	}
	
}