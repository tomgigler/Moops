function reset_pass(username)
{
   if(confirm("Reset password for "+username+"?"))
   {
      xmlHttp=GetXmlHttpObject()
      if (xmlHttp==null)
      {
         alert ("Browser does not support HTTP Request")
         return
      } 
      var url="request_scripts/admin_action.php?op=reset_pass&username="+username+"&rand="+Math.random()
      xmlHttp.onreadystatechange=function()
      { 
         if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
         { 
            parser = GetXmlDOMObject(xmlHttp.responseText)
            my_message = "<font color='"+parser.getElementsByTagName("message")[0].getAttribute("color")+"'><b>"
            my_message += parser.getElementsByTagName("message")[0].childNodes[0].nodeValue+"</b></font>"
            document.getElementById('message').innerHTML = my_message
         } 
      };
      xmlHttp.open("GET",url,true)
      xmlHttp.send(null)
   }
}

function delete_user(username)
{
   if(confirm("Are you sure you want to permanently delete "+username+"?"))
   {
      xmlHttp=GetXmlHttpObject()
      if (xmlHttp==null)
      {
         alert ("Browser does not support HTTP Request")
         return
      } 
      var url="request_scripts/admin_action.php?op=delete_user&username="+username+"&rand="+Math.random()
      xmlHttp.onreadystatechange=function()
      { 
         if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
         { 
            parser = GetXmlDOMObject(xmlHttp.responseText)
            my_message = "<font color='"+parser.getElementsByTagName("message")[0].getAttribute("color")+"'><b>"
            my_message += parser.getElementsByTagName("message")[0].childNodes[0].nodeValue+"</b></font>"
            document.getElementById('message').innerHTML = my_message
         } 
      };
      xmlHttp.open("GET",url,true)
      xmlHttp.send(null)
      var tbl = document.getElementById('user_table')
      var row = document.getElementById("user_"+username)
      for(x = 0 ; x < tbl.rows.length ; x++){
         if(tbl.rows[x] == row) break;
      }
      tbl.deleteRow(x)
   }
}

function create_user()
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   username = document.getElementById('input_username').value
   if(username == "")
   {
      document.getElementById('message').innerHTML = "<font color='red'><b>--Invalid user name--</b></font>";
      return
   }

   var url="request_scripts/admin_action.php?op=create_user&username="+username+"&rand="+Math.random()
   var tbl = document.getElementById('user_table')

   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         if(parser.getElementsByTagName("result")[0].childNodes[0].nodeValue != 0)
         {
            var lastRow = tbl.rows.length;
            for(x = 0 ; x < lastRow ; x++)
               if(tbl.rows[x].id.toUpperCase() > ("user_"+username).toUpperCase())
                  break
            var row = tbl.insertRow(x);
            row.insertCell(0).innerHTML=username
            row.id = "user_"+username
            row.insertCell(1).innerHTML="<button onClick='reset_pass(\""+username+"\")'>Reset Password</button>";
            row.insertCell(2).innerHTML="<button onClick='delete_user(\""+username+"\")'>Delete</button>";
         }
         my_message = "<font color='"+parser.getElementsByTagName("message")[0].getAttribute("color")+"'><b>"
         my_message += parser.getElementsByTagName("message")[0].childNodes[0].nodeValue+"</b></font>"
         document.getElementById('message').innerHTML = my_message
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

   document.getElementById('input_username').value = ""
   document.getElementById('input_username').focus()
}

