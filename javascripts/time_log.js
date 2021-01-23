function cancel_edits(prog, row_id)
{
   var xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url="request_scripts/time_log_action.php?op=get_row&prog="+prog+"&timeid="+row_id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         var row = document.getElementById("time_id_"+row_id)
         row.cells[0].innerHTML = parser.getElementsByTagName("date")[0].childNodes[0].nodeValue
         row.cells[1].innerHTML = parser.getElementsByTagName("starttime")[0].childNodes[0].nodeValue
         row.cells[2].innerHTML = parser.getElementsByTagName("stoptime")[0].childNodes[0].nodeValue
         row.cells[3].innerHTML = parser.getElementsByTagName("int_time")[0].childNodes[0].nodeValue
         row.cells[4].innerHTML = parser.getElementsByTagName("delta")[0].childNodes[0].nodeValue
         row.cells[5].innerHTML=parser.getElementsByTagName("phase")[0].childNodes[0].nodeValue
         if(parser.getElementsByTagName('comments')[0].childNodes[0])
            row.cells[6].innerHTML = parser.getElementsByTagName("comments")[0].childNodes[0].nodeValue
         else
            row.cells[6].innerHTML="&nbsp;"
         row.cells[7].innerHTML="<button onclick='edit_row("+prog+","+row_id+")'>Edit</button>"
         row.cells[8].innerHTML="<button onClick='delete_row("+prog+","+row_id+")'>Delete</button>"

         set_disable_all_controls(false)
         document.getElementById('input_start_time').focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function edit_row(prog, row_id)
{
   var xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url="request_scripts/time_log_action.php?op=get_row&prog="+prog+"&timeid="+row_id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         var row = document.getElementById("time_id_"+row_id)
         row.cells[0].innerHTML="<input id='input_edit_date' value="+parser.getElementsByTagName("date")[0].childNodes[0].nodeValue+" size='8' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+row_id+")'/>"
         row.cells[1].innerHTML="<input id='input_edit_start_time' value="+parser.getElementsByTagName("starttime")[0].childNodes[0].nodeValue+" size='6' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+row_id+")'/>"
         row.cells[2].innerHTML="<input id='input_edit_stop_time' value="+parser.getElementsByTagName("stoptime")[0].childNodes[0].nodeValue+" size='6'  onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+row_id+")'/>"
         row.cells[3].innerHTML="<input id='input_edit_int_time' value="+parser.getElementsByTagName("int_time")[0].childNodes[0].nodeValue+" size='4'  onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+row_id+")'/>"
         row.cells[5].innerHTML="<select id='select_edit_phase'  onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+row_id+")'/>"
         var e_select_edit_phase = document.getElementById('select_edit_phase')
         var e_select_phase = document.getElementById('select_phase')
         for(c = 0 ; c < e_select_phase.options.length ; c++)
         { 
            var new_option_phase = document.createElement('option')     
            new_option_phase.text = e_select_phase.options[c].text
            new_option_phase.value = e_select_phase.options[c].value
            try {
               e_select_edit_phase.add(new_option_phase, null) // standards compliant; doesn't work in IE
            } 
            catch(ex) {
               e_select_edit_phase.add(new_option_phase) // IE only
            }
            if(new_option_phase.text == parser.getElementsByTagName("phase")[0].childNodes[0].nodeValue)
               new_option_phase.selected=c
         }
         row.cells[6].innerHTML="<input id='input_edit_comments' size='40'  onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+row_id+")'/>"
         if(parser.getElementsByTagName("comments")[0].childNodes[0])
            document.getElementById('input_edit_comments').value = parser.getElementsByTagName("comments")[0].childNodes[0].nodeValue
         else
            document.getElementById('input_edit_comments').value = ""
         row.cells[7].innerHTML="<button onclick='save_edits("+prog+","+row_id+")'>Save</button>"
         row.cells[8].innerHTML="<button onclick='cancel_edits("+prog+","+row_id+")'>Cancel</button>"
         document.getElementById("input_edit_date").focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function add_new_cell(row, index, name, row_id)
{
   if(parser.getElementsByTagName("old_"+name)[0].childNodes[0])
      var old_value = parser.getElementsByTagName("old_"+name)[0].childNodes[0].nodeValue
   else
      var old_value = "&nbsp;"
   if(parser.getElementsByTagName(name)[0].childNodes[0])
      var value = parser.getElementsByTagName(name)[0].childNodes[0].nodeValue
   else
      var value = "&nbsp;"
   row.insertCell(index).id = name+"_"+row_id
   row.cells[index].innerHTML = old_value
   old_update_cell(row.cells[index].id, value)
}

function save_edits(prog, row_id)
{
   var xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   var date=document.getElementById('input_edit_date').value
   var start_time=document.getElementById('input_edit_start_time').value
   var stop_time=document.getElementById('input_edit_stop_time').value
   var int_time=document.getElementById('input_edit_int_time').value
   var e_select_edit_phase=document.getElementById('select_edit_phase')
   var phase=e_select_edit_phase.options[e_select_edit_phase.selectedIndex].value
   var comments=document.getElementById('input_edit_comments').value

   if(isNaN(parseInt(int_time)))
   {
      document.getElementById('input_edit_int_time').style.backgroundColor = "pink"
      alert("Interruption Time must be an integer!")
      document.getElementById('input_edit_int_time').style.backgroundColor = ""
      set_disable_all_controls(false)
      return
   }

   var url = "request_scripts/time_log_action.php?op=update&prog="+prog+"&timeid="+row_id
   url += "&date="+date+"&start_time="+start_time+"&stop_time="+stop_time
   url += "&int_time="+int_time+"&phase="+phase+"&comments="+comments
   url += "&rand="+Math.random()

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         if(parser.getElementsByTagName("alert")[0])
         {
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).style.backgroundColor = "pink"
            alert(parser.getElementsByTagName("alert")[0].childNodes[0].nodeValue)
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).style.backgroundColor = ""
            set_disable_all_controls(false)
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
            return 
         }

         // find the old row
         var tbl = document.getElementById('table_time_log')
         var row = document.getElementById('time_id_'+row_id)
         for(x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         tbl.deleteRow(x)

         row = tbl.insertRow(parser.getElementsByTagName("index")[0].childNodes[0].nodeValue)
         add_new_cell(row, 0, 'date', row_id)
         add_new_cell(row, 1, 'starttime', row_id)
         add_new_cell(row, 2, 'stoptime', row_id)
         add_new_cell(row, 3, 'int_time', row_id)
         add_new_cell(row, 4, 'delta', row_id)
         add_new_cell(row, 5, 'phase', row_id)
         add_new_cell(row, 6, 'comments', row_id)
         row.insertCell(7).innerHTML="<button onclick='edit_row("+prog+","+row_id+")'>Edit</button>"
         row.insertCell(8).innerHTML="<button onClick='delete_row("+prog+","+row_id+")'>Delete</button>"
         row.id="time_id_"+row_id

         document.getElementById('total').innerHTML = "<b>Total:  "+parser.getElementsByTagName("total")[0].childNodes[0].nodeValue+"</b>"
         set_disable_all_controls(false)
         document.getElementById('input_start_time').focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function delete_row(prog, row_id)
{ 
   if(!confirm("Are you sure you want to permanently delete this entry?")) return
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url="request_scripts/time_log_action.php?op=delete&prog="+prog+"&timeid="+row_id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)
         document.getElementById('total').innerHTML = "<b>Total:  "+parser.getElementsByTagName("total")[0].childNodes[0].nodeValue+"</b>"

         // delete the row
         var tbl = document.getElementById('table_time_log')
         var row = document.getElementById("time_id_"+row_id)
         var lastRow = tbl.rows.length
         for(x = 0 ; x < lastRow ; x++){
            if(tbl.rows[x] == row) break
         }
         tbl.deleteRow(x)
         if(tbl.rows.length == 1)
            document.getElementById('div_time_log').style.display = 'none'

         set_disable_all_controls(false)
         document.getElementById('input_start_time').focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function create_row(prog)
{ 
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   date = document.getElementById('input_date').value
   start_time = document.getElementById('input_start_time').value
   stop_time = document.getElementById('input_stop_time').value
   int_time = document.getElementById('input_int_time').value
   phase = document.getElementById('select_phase').value
   comments = document.getElementById('input_comments').value

   if(isNaN(parseInt(int_time)))
   {
      document.getElementById('input_int_time').style.backgroundColor = "pink"
      alert("Interruption Time must be an integer!")
      document.getElementById('input_int_time').style.backgroundColor = ""
      set_disable_all_controls(false)
      return
   }

   var url = "request_scripts/time_log_action.php?op=create&prog="+prog
   url += "&date="+date+"&start_time="+start_time+"&stop_time="+stop_time
   url += "&int_time="+int_time+"&phase="+phase+"&comments="+comments
   url += "&rand="+Math.random()

   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)
         if(parser.getElementsByTagName("alert")[0])
         {
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).style.backgroundColor = "pink"
            alert(parser.getElementsByTagName("alert")[0].childNodes[0].nodeValue)
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).style.backgroundColor = ""
            set_disable_all_controls(false)
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
            return 
         }
         id = parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         // insert the new row
         var tbl = document.getElementById('table_time_log')
         var row = tbl.insertRow(parser.getElementsByTagName("index")[0].childNodes[0].nodeValue)
         add_new_cell(row, 0, "date", id)
         document.getElementById('input_date').value = parser.getElementsByTagName("date")[0].childNodes[0].nodeValue
         add_new_cell(row, 1, "starttime", id)
         add_new_cell(row, 2, "stoptime", id)
         document.getElementById('input_start_time').value = parser.getElementsByTagName("stoptime")[0].childNodes[0].nodeValue
         add_new_cell(row, 3, "int_time", id)
         add_new_cell(row, 4, "delta", id)
         add_new_cell(row, 5, "phase", id)
         add_new_cell(row, 6, "comments", id)
         row.insertCell(7).innerHTML="<button onClick='edit_row("+prog+","+id+")'>Edit</button>"
         row.insertCell(8).innerHTML="<button onClick='delete_row("+prog+","+id+")'>Delete</button>"
         row.id = "time_id_"+id

         document.getElementById('total').innerHTML = "<b>Total:  "+parser.getElementsByTagName("total")[0].childNodes[0].nodeValue+"</b>"

         document.getElementById('div_time_log').style.display = 'inline'
         set_disable_all_controls(false)
         document.getElementById('input_stop_time').value = ""
         document.getElementById('input_int_time').value = "0"
         document.getElementById('input_comments').value = ""
         document.getElementById('input_start_time').focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

