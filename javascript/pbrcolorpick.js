/* Used by POST_BOX_RICH template */

color = '000000';
gray = 'cccccc';
while(1)
{
   document.write("<td class='color' style='background-color:#" + color + "' title='#" + color + "' onmouseover='color_preview(this)' onclick='color_select(this.style.backgroundColor)' unselectable='on'></td>");

   if(color == 'ffffff'){
      break;
   }

   r = color.substring(0, 2);
   g = color.substring(2, 4);
   b = color.substring(4, 6);

   g = increment(g);

   if(g == '00'){
      r = increment(r);
      if(r == '00'){
         b = increment(b);

         document.write('</tr><tr>');
         document.write("<td class='color' style='background-color:#" + gray + "' title='#" + gray + "' onmouseover='color_preview(this)' onclick='color_select(this.style.backgroundColor)' unselectable='on'></td><td style='width:10px'></td>");

         switch(gray)
         {
            case 'cccccc': gray = '999999'; break;
            case '999999': gray = '666666'; break;
            case '666666': gray = '333333'; break;
            case '333333': gray = '000000'; break;
         }
      }
   }
   color = r + g + b;
}
