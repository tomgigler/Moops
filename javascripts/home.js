function create_program(username)
{
   level = document.getElementById('select_psp_level').value
   program_name = document.getElementById('input_program_name').value

   if(program_name == "")
   {
      document.getElementById('message').innerHTML = "&nbsp;"
      document.getElementById('input_program_name').style.backgroundColor = "pink"
      alert("Invalid program name!")
      document.getElementById('input_program_name').style.backgroundColor = ""
      document.getElementById('input_program_name').focus()
      return
   }

   set_disable_all_controls(true)

   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   var url="request_scripts/home_action.php?op=create&progname="+program_name+"&level="+level+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)
 
         if(parser.getElementsByTagName("alert")[0])
         {
            if(parser.getElementsByTagName("highlight")[0])
               document.getElementById(parser.getElementsByTagName("highlight")[0].childNodes[0].nodeValue).style.backgroundColor = "pink"
            alert(parser.getElementsByTagName("alert")[0].childNodes[0].nodeValue)
            if(parser.getElementsByTagName("highlight")[0])
               document.getElementById(parser.getElementsByTagName("highlight")[0].childNodes[0].nodeValue).style.backgroundColor = ""
            set_disable_all_controls(false)
            if(parser.getElementsByTagName("focus")[0])
               document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
            return
         }

         display_message(parser)
         var tbl = document.getElementById('table_programs')
         var row = tbl.insertRow(1)
         row.id = "tr_program_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue
         row.insertCell(0).innerHTML = " <a href=\"summary.php?prog="+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue+"\"> "+program_name+" </a>"
         row.insertCell(1).innerHTML = "<center>"+parser.getElementsByTagName("number")[0].childNodes[0].nodeValue+"</center>"
         row.insertCell(2).innerHTML = "<center>"+parser.getElementsByTagName("level")[0].childNodes[0].nodeValue+"</center>"
         del_button = row.insertCell(3)
         del_button.innerHTML="<button onClick='delete_program("+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue+",\""+program_name+"\")'>Delete</button>"
         document.getElementById('div_programs').style.display = "inline"
         set_disable_all_controls(false)
         document.getElementById('input_program_name').value = ""
         document.getElementById('input_program_name').focus()
      } 
   }
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function delete_program(id,name)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   if(!confirm('Are you sure you want to permanently delete '+name+'?'))
   {
      set_disable_all_controls(false)
      return
   }

   var url="request_scripts/home_action.php?op=delete&prog="+id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         if(parser.getElementsByTagName("alert")[0])
         {
            alert(parser.getElementsByTagName("alert")[0].childNodes[0].nodeValue)
            set_disable_all_controls(false)
            return
         }

         var tbl = document.getElementById('table_programs')
         var row = document.getElementById("tr_program_"+id)
         for(var x = 1 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break

         tbl.deleteRow(x)
         if(tbl.rows.length == 1)
            document.getElementById('div_programs').style.display = 'none'

         // cute way of showing program numbers
         for(var x = 1 ; x < tbl.rows.length ; x++)
            tbl.rows[x].cells[1].innerHTML = "<center>"+(tbl.rows.length - x)+"</center>"

         my_message = "<font color='"+parser.getElementsByTagName("message")[0].getAttribute("color")+"'><b>"
         my_message += parser.getElementsByTagName("message")[0].childNodes[0].nodeValue+"</b></font>"
         document.getElementById('message').innerHTML = my_message

         set_disable_all_controls(false)
         document.getElementById('input_program_name').focus()
      } 
   }
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

