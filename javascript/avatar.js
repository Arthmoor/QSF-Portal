/* Javascript for the avatars page */

function enable(what)
{
  if(what == 'local'){
    document.forms['avatar'].avatar_local.disabled = false;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(0);
  }else if(what == 'url'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = false;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(1);
  }else if(what == 'upload'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = false;
    check(2);
  }else if(what == 'use_uploaded'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(3);
  }else if(what == 'none'){
    document.forms['avatar'].avatar_local.disabled = true;
    document.forms['avatar'].avatar_url.disabled = true;
    document.forms['avatar'].avatar_upload.disabled = true;
    check(4);
  }
}

function setuser_avatar(url)
{
  if(document.images){
    image = document.images['current_avatar'];
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

function setWidth()
{
	var width = document.forms['avatar'].user_avatar_width.value;
	if(js_lang && (width > js_lang.sets['avatar_width'] || width < 1)){
		width = js_lang.sets['avatar_width'];
		var message = js_lang.jslang_avatar_size_width.replace(/%d/, parseInt(js_lang.sets['avatar_width']));
		alert(message);
	}
	if(document.images){
		document.images['current_avatar'].width = width;
	}
}

function setHeight()
{
	var height = document.forms['avatar'].user_avatar_height.value;
	
	if(js_lang && (height > js_lang.sets['avatar_height'] || height < 1)){
		height = js_lang.sets['avatar_height'];
		var message = js_lang.jslang_avatar_size_height.replace(/%d/, parseInt(js_lang.sets['avatar_height']));
		alert(message);
	}
	if(document.images){
		document.images['current_avatar'].height = height;
	}
}

function noavatar()
{
  image = document.images['current_avatar'];
  image.onerror = "";
  image.src = './skins/{$this->skin}/images/noavatar.png';
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

// Look at the size of the loaded image and adjust our size accordingly
function setAvatarSize() {
	var i = new Image();
	var avatarImg = document.getElementById("current_avatar");
	i.src = avatarImg.src; // should be already loaded
	var h = i.height;
	var w = i.width;
	if (js_lang) {
		if (h>js_lang.sets['avatar_height'])
			h = js_lang.sets['avatar_height'];
		if (w>js_lang.sets['avatar_width'])
			w = js_lang.sets['avatar_width'];
	}
	
	document.forms['avatar'].user_avatar_height.value = h;
	document.forms['avatar'].user_avatar_width.value = w;
	setHeight();
	setWidth();
}

function enableLocal() {
	enable('local');
	setuser_avatar(document.forms['avatar'].avatar_local.value);
}

function enableURL() {
	enable('url');
	setuser_avatar(document.forms['avatar'].avatar_url.value);
}

function enableUpload() {
	enable('upload');
	setuser_avatar(document.forms['avatar'].avatar_upload.value);
}

function enableUploaded() {
	enable('use_uploaded');
	var old_avatar = document.forms['avatar'].old_avatar.value;
	if (old_avatar.indexOf("./avatars/uploaded/") != 0) {
		old_avatar = "";
	}
	setuser_avatar(old_avatar);
}

function enableNone() {
	enable('none');
	noavatar();
}

// Setup the functions on the page
function initAvatarPage()
{
	var avatarImg = document.getElementById("current_avatar");
	avatarImg.onerror=noavatar;
	avatarImg.onload=setAvatarSize;
	
	document.getElementById("local_row").onclick = enableLocal;
	document.getElementById("local_radio").onfocus = enableLocal;
	document.getElementById("url_row").onclick = enableURL;
	document.getElementById("url_radio").onfocus = enableURL;
	document.getElementById("upload_row").onclick = enableUpload;
	document.getElementById("upload_radio").onfocus = enableUpload;
	document.getElementById("none_row").onclick = enableNone;
	document.getElementById("none_radio").onfocus = enableNone;
	
	document.forms['avatar'].user_avatar_width.onchange=setWidth;
	document.forms['avatar'].user_avatar_height.onchange=setHeight;
	document.forms['avatar'].avatar_local.onchange = function() {
		setuser_avatar(document.forms['avatar'].avatar_local.value);
	};
	document.forms['avatar'].avatar_url.onchange = function() {
		setuser_avatar(document.forms['avatar'].avatar_url.value);
	};
	document.forms['avatar'].avatar_upload.onchange = function() {
		noavatar();
	};
	
	// Now load our language data for error messages
	load_js_lang(function() {
			// do nothing
		});
}

addLoadEvent(initAvatarPage);

