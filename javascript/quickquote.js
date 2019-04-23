/* This adds JSON processing to the string class
See http://json.org for more info */
String.prototype.parseJSON = function () {
    try {
        return !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test(
                this.replace(/"(\\.|[^"\\])*"/g, ''))) &&
            eval('(' + this + ')');
    } catch (e) {
        return false;
    }
};

/* The below functions are for handling the XMLHttpRequest object */

/* Request a HTTP object. If there are multiple http requests going on then we may have more than one object being used at a time */
function getHTTPObject(func) {
	function requestHandler() {
		var httpRequester = null;
		if (typeof window.XMLHttpRequest != 'undefined') {
			httpRequester = new XMLHttpRequest();
		} else if (typeof window.ActiveXObject != 'undefined') {
			try {
				httpRequester = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				try {
					httpRequester = new ActiveXObject("Microsoft.XMLHTTP");
				} catch(e) {
					httpRequester = null;
				}
			}
		}

		if (httpRequester) this.ready = true;
		else this.ready = false;

		var stateHandler = function() {
				if (httpRequester.readyState == 4) {
					func(httpRequester.responseText);
				}                             
			};

		this.requestData = function() {
			var pathName = location.pathname;

			var url = pathName.substring(pathName.lastIndexOf("/") + 1, pathName.length);

			if (arguments.length > 0) {
				url += '?a=' + arguments[0];
			}
			for (var i=1; (i + 1) < arguments.length; i+=2) {
				url += "&" + arguments[i] + "=" + escape(arguments[i+1]);
			}

			httpRequester.open("GET", url, true);
			httpRequester.onreadystatechange = stateHandler;
			httpRequester.send(null);
		};
	}

	var waystation = new requestHandler();

	if (!waystation.ready) return null;

	return waystation
}

// Fetch the quote and append it onto the text area value
function doQuickQuote(textarea, quote_id) {
	
	var handler = function(text) {
		var responseData = text.parseJSON();
			
		if (!responseData) return;
		
		var quote = "\n[quote=" + responseData['user'];
		quote += ']' + responseData['text'] + '[/quote]';
		
		textarea.value = textarea.value + quote;

		textarea.focus();
	};
	
	var dataFetcher = getHTTPObject(handler);
	dataFetcher.requestData('jsdata', 'data', 'post', 'p', quote_id);

	// Force open the quickreply box
	quickReplyBox.style.display = 'inline';
	toggleQuickReplyBoxStatus = 1;
}

function quickQuoteInit() {
	var textarea = document.getElementById("bbcodequick");
	if (!textarea) return; // bail out
	
	var allLinks = document.getElementsByTagName('a');
	
	for (var i = 0; i < allLinks.length; i++) {
		if (allLinks[i].className == 'quotepost') {
			// Find the post id
			var url = allLinks[i].href;
			var post_id = url.substring(url.lastIndexOf('qu=') + 3, url.length);
			allLinks[i].post_id = post_id;
			allLinks[i].href = '#bottom';

			allLinks[i].onclick = function() {
				var post_id = this.post_id;
				doQuickQuote(textarea, post_id);
				return true;
			};
		}
	}
}

addLoadEvent(quickQuoteInit);