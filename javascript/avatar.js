/* Javascript for the avatars page */

function enable(what)
{
  if(what == 'local'){
    document.forms['avatar'].avatar_local.disabled = false;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_gurl.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(0);
  }else if(what == 'url'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = false;
    document.forms['avatar'].avatar_gurl.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(1);
  }else if(what == 'gravatar'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_gurl.disabled = false;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(2);
  }else if(what == 'upload'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_gurl.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = false;
    check(3);
  }else if(what == 'use_uploaded'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_gurl.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(4);
  }else if(what == 'none'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_gurl.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(5);
  }
}

function set_local_avatar(url)
{
  if(document.images){
    image = document.images['localavatar'];
    if(url == ''){
      noavatar();
    }else{
      image.src = url;

      if(image.fileSize){
        if(image.fileSize == -1){
          noavatar();
        }
      }
    }
  }
}

function noavatar()
{
  image = document.images['current_avatar'];
  image.onerror = "";
  image.src = '{$this->sets['loc_of_board']}/skins/{$this->skin}/images/noavatar.png';
  image.height = 64;
  image.width = 64;
  document.forms['avatar'].user_avatar_width.value = 64;
  document.forms['avatar'].user_avatar_height.value = 64;
}

function check(i)
{
  if(i == 0){
    var x = 1;
  }else{
    var x = 0;
  }
  document.forms['avatar'].user_avatar_type[i].checked = true;
  document.forms['avatar'].user_avatar_type[x].checked = false;
}

function enableLocal() {
	enable('local');
}

function enableURL() {
	enable('url');
}

function enableGURL() {
	enable('gravatar');
}

function enableUpload() {
	enable('upload');
}

function enableUploaded() {
	enable('use_uploaded');
}

function enableNone() {
	enable('none');
}

// Setup the functions on the page
function initAvatarPage()
{
	document.getElementById("local_row").onclick = enableLocal;
	document.getElementById("local_radio").onfocus = enableLocal;
	document.getElementById("url_row").onclick = enableURL;
	document.getElementById("url_radio").onfocus = enableURL;
	document.getElementById("gravatar_row").onclick = enableGURL;
	document.getElementById("gurl_radio").onclick = enableGURL;
	document.getElementById("upload_row").onclick = enableUpload;
	document.getElementById("upload_radio").onfocus = enableUpload;
	document.getElementById("none_row").onclick = enableNone;
	document.getElementById("none_radio").onfocus = enableNone;
	
	document.forms['avatar'].avatar_local.onchange = function() {
		set_local_avatar(document.forms['avatar'].avatar_local.value);
	};
	document.forms['avatar'].avatar_url.onchange = function() {
		set_local_avatar(document.forms['avatar'].avatar_url.value);
	};

	// Now load our language data for error messages
	load_js_lang(function() {
			// do nothing
		});
}

addLoadEvent(initAvatarPage);