/* Used by the POST_BOX_RICH template */

function to_textarea()
{
   document.forms['mbpost'].post.value = document.all['box'].innerHTML;
   return true;
}

document.forms['mbpost'].onsubmit = to_textarea;

function getLength()
{
   var length = document.all['box'].innerText.length;
   alert("{$this->lang->post_mbcode_length}");
   return false;
}

function getText()
{
   return ((document.all['box'].innerText && document.all['box'].caretPos) ? document.all['box'].caretPos.text : '');
}

function insertSmiley(smiley)
{
   document.all['box'].focus();
   var caret = document.selection.createRange().duplicate();

   caret.text = smiley;

   return false;
}

function format(command, param, nodialog)
{
   document.all['box'].focus();

   if(!param){
      document.execCommand(command);
   }else{
      if(!nodialog){
         document.execCommand(command, true, param);
      }else{
         document.execCommand(command, null, param);
      }
   }
}

color_act = null;

function forecolor()
{
   color_act = 'forecolor';
   document.all['color_tool'].style.display = '';
}

function backcolor()
{
   color_act = 'backcolor';
   document.all['color_tool'].style.display = '';
}

function color_select(id)
{
   if(id != 'close'){
      format(color_act, id);
   }

   color_act = null;
   document.all['color_tool'].style.display = 'none';
}

function color_preview(obj)
{
   document.all['color_face'].innerText = ' ';
   document.all['color_face'].style.backgroundColor = obj.style.backgroundColor;
}

function increment(hex)
{
   switch(hex)
   {
      case '00': return '33'; break;
      case '33': return '66'; break;
      case '66': return '99'; break;
      case '99': return 'cc'; break;
      case 'cc': return 'ff'; break;
      case 'ff': return '00'; break;
   }
}

i = 0;
function quote(code)
{
   document.all['box'].innerHTML = document.all['box'].innerHTML + '<!--STARTCODE' + i +  'STARTCODE--><table border="1" width="90%" cellpadding="3" cellspacing="0" style="margin-left:5%; margin-right:5%;"><tr><td' + (code ? " style='font-family:courier'" : '') + '><!--STARTICODE' + i + 'STARTICODE--><!--ENDICODE' + i + 'ENDICODE--></td></tr></table><!--ENDCODE' + i +  'ENDCODE-->';
   i++;
}

function over(obj)
{
   obj.className = 'button_over';
}

function html_mode(obj)
{
   if(obj.checked){
      document.all['box'].innerText = document.all['box'].innerHTML;
   }else{
      document.all['box'].innerHTML = document.all['box'].innerText;
   }
}

function out(obj)
{
   obj.className = 'button';
}

function down(obj)
{
   obj.className = 'button_down';
}
