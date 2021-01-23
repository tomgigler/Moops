function load()
{
}

function capture_keypress(event, ret_func, esc_func, ret_confirm, esc_confirm, arg1, arg2, arg3)
{
   // if the ret_func is set_value, we only need to call it for IE
   // Firefox calls the onchange event for us when we hit return in a text box
   if(typeof(set_value) != "undefined" && ret_func == set_value && navigator.appName != "Microsoft Internet Explorer") return false

   if(event.which || event.keyCode)
      if ((event.which == 13) || (event.keyCode == 13)) 
      {
         if(typeof(ret_confirm) == "string" && !confirm(ret_confirm)) return true
         ret_func(arg1, arg2, arg3)
         return true;
      }
   if(event.which || event.keyCode)
      if ((event.which == 27) || (event.keyCode == 27)) 
      {
         if(typeof(esc_confirm) == "string" && !confirm(esc_confirm)) return true
         if(typeof(esc_func) == "function") esc_func(arg1, arg2, arg3)
         return true;
      }
   return false;
}

function GetXmlHttpObject(handler)
{ 
   var objXMLHttp=null
   if (window.XMLHttpRequest)
   {
      objXMLHttp=new XMLHttpRequest()
   }
   else if (window.ActiveXObject)
   {
      objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
   }
   return objXMLHttp
}

function GetXmlDOMObject(text)
{
   var xmlDoc=null
   if (window.DOMParser)
   {
      parser=new DOMParser();
      xmlDoc=parser.parseFromString(text,"text/xml");
   }
   else if (window.ActiveXObject)
   {
      xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
      xmlDoc.async=false;
      xmlDoc.loadXML(text)
   }
   return xmlDoc
}

function display_message(parser)
{
   if(parser.getElementsByTagName("message")[0])
      document.getElementById('message').innerHTML = "<font color='"+parser.getElementsByTagName("message")[0].getAttribute("color")+"'><b>"+
         parser.getElementsByTagName("message")[0].childNodes[0].nodeValue+"</b></font>"
   else document.getElementById('message').innerHTML = "&nbsp;"
}

function set_disable_all_controls(value)
{
   var button_array = document.getElementsByTagName('button')
   for(var x = 0 ; x < button_array.length ; x++)
      button_array[x].disabled=value
   var input_array = document.getElementsByTagName('input')
   for(var x = 0 ; x < input_array.length ; x++)
      input_array[x].disabled=value
   var select_array = document.getElementsByTagName('select')
   for(var x = 0 ; x < select_array.length ; x++)
      select_array[x].disabled=value

   //  if we are reenabling the controls, change reused_objects controls back to previous state
   if(!value && typeof(select_reused_objects_change) != "undefined")
      select_reused_objects_change()
}

function update_value(id,value, old_value)
{
   if(value != old_value)
   {
      document.getElementById(id).value = value
      document.getElementById(id).style.backgroundColor='yellow'
      setTimeout("document.getElementById('"+id+"').style.backgroundColor=''",500)
   }
   else
      document.getElementById(id).value = old_value
}

function update_cell(id,value, old_value)
{
   if(!document.getElementById(id)) return

   document.getElementById(id).innerHTML = value
   if(value != old_value)
   {
      document.getElementById(id).style.backgroundColor='yellow'
      setTimeout("document.getElementById('"+id+"').style.backgroundColor=''",500)
   }
}

function old_update_cell(id,value)
{
   if(!document.getElementById(id)) return
   if(document.getElementById(id).innerHTML != value)
   {
      document.getElementById(id).innerHTML = value
      document.getElementById(id).style.backgroundColor='yellow'
      setTimeout("document.getElementById('"+id+"').style.backgroundColor=''",500)
   }
}

function show_loading_div(value)
{
   if(value)
      document.getElementById('loading').style.display = 'inline'
   else
      document.getElementById('loading').style.display = 'none'
}

