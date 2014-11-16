var timezone_arrays = new Array();
var oldSelectedValue = 0;

function rebuildAllTZSelect()
{
  var formSelectElements = document.getElementsByTagName("select");
  for(var i=0; i<formSelectElements.length; i++)
  {
    if (formSelectElements[i].className.indexOf("timezone") > -1) {
      rebuildTimezoneSelect(formSelectElements[i]);
	  i++; // Jump past element
    }
  }
}

function rebuildTimezoneSelect(element)
{
	// Add the has to our element
	var tempHash = new Object();
	
	var re = /^([a-zA-Z]+)\/(.+)$/;
	// Create a new select
	var selectFirst = document.createElement("select");
	selectFirst.name = "selector_" + element.name;
	selectFirst.className = element.className;
	// selectFirst.style.width = "10em";
	
	// Go through the options creating a new set of options
	for (var i=0; i<element.options.length; i++) {
		var text = element.options[i].firstChild.nodeValue;
		var matches = re.exec(text);
		
		if (matches) {
			if (! tempHash[matches[1]]) {
				var optionline = document.createElement("option");
				
				tempHash[matches[1]] = new Array();
				
				optionline.value = matches[1];
				
				var optiontext = document.createTextNode(matches[1]);
				optionline.appendChild(optiontext);
				selectFirst.appendChild(optionline);
			}
			
			if (element.options[i].selected) {
				selectFirst.selectedIndex = selectFirst.length - 1;
				oldSelectedValue = element.options[i].value;
			}
			tempHash[matches[1]][tempHash[matches[1]].length] = new Array(element.options[i].value, matches[2]);
		}
	}
	selectFirst.onchange = function() { buildSecondaryList(selectFirst); };
	element.parentNode.insertBefore(selectFirst, element);
	timezone_arrays[element.name] = tempHash;
	
	buildSecondaryList(selectFirst);
}

function buildSecondaryList(element)
{
	var re = /^selector_(.+)$/;
	
	var selectedItem = element.options[element.selectedIndex].value;
	var matches = re.exec(element.name);
	var name = matches[1];
	
	// Remove all options
	while (element.form[name].length)
		element.form[name].remove(0);
	
	for (var i=0; i<timezone_arrays[name][selectedItem].length; i++)
	{
		var optionline = document.createElement("option");
		optionline.value = timezone_arrays[name][selectedItem][i][0];
		
		var optiontext = document.createTextNode(timezone_arrays[name][selectedItem][i][1]);
		optionline.appendChild(optiontext);

		if (oldSelectedValue == optionline.value) {
			optionline.selected = true;
			oldSelectedValue = 0;
		}
		element.form[name].appendChild(optionline);
	}
}

addLoadEvent(rebuildAllTZSelect);
                               

