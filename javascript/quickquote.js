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
