function save_edits(prog, taskid)
{ 
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   name = document.getElementById('select_edit_name').value
   minutes = document.getElementById('input_edit_minutes').value
   plan_date = document.getElementById('input_edit_plan_date').value

   var url = "request_scripts/task_plan_template_action.php?op=update&prog="+prog+"&taskid="+taskid
   url += "&name="+name+"&minutes="+minutes+"&plan_date="+plan_date
   url += "&rand="+Math.random()

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
            document.getElementById('button_save').disabled = false            
            document.getElementById('button_cancel').disabled = false            
            document.getElementById('select_edit_name').disabled = false            
            document.getElementById('input_edit_minutes').disabled = false            
            document.getElementById('input_edit_plan_date').disabled = false            
            if(parser.getElementsByTagName("focus")[0])
               document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
            return 
         }

         var row = document.getElementById("tr_task_id_"+taskid)
         row.cells[1].innerHTML = parser.getElementsByTagName("update_name")[0].childNodes[0].nodeValue
         row.cells[2].innerHTML = parser.getElementsByTagName("update_minutes")[0].childNodes[0].nodeValue
         row.cells[6].innerHTML = parser.getElementsByTagName("update_plan_date")[0].childNodes[0].nodeValue
         row.cells[10].innerHTML = "<button onclick='edit_task("+prog+","+taskid+")'>Edit</button>"
         row.cells[11].innerHTML = "<button onclick='delete_task("+prog+","+taskid+")'>Delete</button>"

         // if the row's number has changed, we need to move it
         for(var x = 0 ; x < parser.getElementsByTagName("task").length ; x++)
            if(parser.getElementsByTagName("task")[x].getAttribute("id") == taskid) break
         var task = parser.getElementsByTagName("task")[x]
         if(task && task.getElementsByTagName("number")[0])
         {
            var hold_number = document.getElementById("td_task_number_"+taskid).innerHTML
            var hold_name = document.getElementById("td_task_name_"+taskid).innerHTML
            var hold_minutes = document.getElementById("td_task_minutes_"+taskid).innerHTML
            var hold_planned_value = document.getElementById("td_task_planned_value_"+taskid).innerHTML
            var hold_cumulative_minutes = document.getElementById("td_task_cumulative_minutes_"+taskid).innerHTML
            var hold_cumulative_planned_value = document.getElementById("td_task_cumulative_planned_value_"+taskid).innerHTML
            var hold_plan_date = document.getElementById("td_task_plan_date_"+taskid).innerHTML
            var hold_actual_date = document.getElementById("td_task_actual_date_"+taskid).innerHTML
            var hold_earned_value = document.getElementById("td_task_earned_value_"+taskid).innerHTML
            var hold_cumulative_earned_value = document.getElementById("td_task_cumulative_earned_value_"+taskid).innerHTML

            document.getElementById("table_task_plan").deleteRow(parseInt(hold_number) + 1)
            row = document.getElementById("table_task_plan").insertRow(parseInt(task.getElementsByTagName("number")[0].childNodes[0].nodeValue) + 1)
            row.id = "tr_task_id_"+taskid
            var cell = row.insertCell(row.cells.length)
            cell.id = "td_task_number_"+taskid
            cell.innerHTML = hold_number
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_name_"+taskid
            cell.innerHTML = hold_name
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_minutes_"+taskid
            cell.innerHTML = hold_minutes
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_planned_value_"+taskid
            cell.innerHTML = hold_planned_value
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_cumulative_minutes_"+taskid
            cell.innerHTML = hold_cumulative_minutes
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_cumulative_planned_value_"+taskid
            cell.innerHTML = hold_cumulative_planned_value
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_plan_date_"+taskid
            cell.innerHTML = hold_plan_date
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_actual_date_"+taskid
            cell.innerHTML = hold_actual_date
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_earned_value_"+taskid
            cell.innerHTML = hold_earned_value
            cell = row.insertCell(row.cells.length)
            cell.id = "td_task_cumulative_earned_value_"+taskid
            cell.innerHTML = hold_cumulative_earned_value
            row.insertCell(row.cells.length).innerHTML = "<button onclick='edit_task("+prog+","+taskid+")'>Edit</button>"
            row.insertCell(row.cells.length).innerHTML = "<button onclick='delete_task("+prog+","+taskid+")'>Delete</button>"
         }

         update_task_table(parser)
         set_disable_all_controls(false)
         document.getElementById("select_name").focus()
      }
   }

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function cancel_edits(prog, taskid)
{ 
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url = "request_scripts/task_plan_template_action.php?op=get_task&prog="+prog
   url += "&taskid="+taskid+"&rand="+Math.random()

   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         for(var x = 0 ; x < parser.getElementsByTagName("task").length ; x++)
            if(parser.getElementsByTagName("task")[x].getAttribute("id") == taskid) break
         var task = parser.getElementsByTagName("task")[x]

         var row = document.getElementById("tr_task_id_"+taskid)
         row.cells[1].innerHTML = task.getElementsByTagName("name")[0].childNodes[0].nodeValue
         row.cells[2].innerHTML = task.getElementsByTagName("minutes")[0].childNodes[0].nodeValue
         row.cells[6].innerHTML = task.getElementsByTagName("plan_date")[0].childNodes[0].nodeValue

         row.cells[10].innerHTML = "<button onclick='edit_task("+prog+","+taskid+")'>Edit</button>"
         row.cells[11].innerHTML = "<button onclick='delete_task("+prog+","+taskid+")'>Delete</button>"

         set_disable_all_controls(false)
         document.getElementById("select_name").focus()
      }
   }

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function edit_task(prog, taskid)
{ 
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url = "request_scripts/task_plan_template_action.php?op=get_task&prog="+prog
   url += "&taskid="+taskid+"&rand="+Math.random()

   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         for(var x = 0 ; x < parser.getElementsByTagName("task").length ; x++)
            if(parser.getElementsByTagName("task")[x].getAttribute("id") == taskid) break
         var task = parser.getElementsByTagName("task")[x]

         var row = document.getElementById("tr_task_id_"+taskid)
         row.cells[1].innerHTML = "<select id='select_edit_name' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+taskid+")'/>"
         var select_edit_name = document.getElementById('select_edit_name')
         var select_name = document.getElementById('select_name')
         for(var c = 0 ; c < select_name.options.length ; c++)
         {
            var new_option_name = document.createElement('option')
            new_option_name.text = select_name.options[c].text
            new_option_name.value = select_name.options[c].value
            try {
               select_edit_name.add(new_option_name, null) // standards compliant; doesn't work in IE
            }
            catch(ex) {
               select_edit_name.add(new_option_name) // IE only
            }
            if(new_option_name.text == task.getElementsByTagName("name")[0].childNodes[0].nodeValue)
               new_option_name.selected=c
         }
         row.cells[2].innerHTML = "<input id='input_edit_minutes' size=6 onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+taskid+")'/>"
         document.getElementById("input_edit_minutes").value = task.getElementsByTagName("minutes")[0].childNodes[0].nodeValue
         row.cells[6].innerHTML = "<input id='input_edit_plan_date' size=10 onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+taskid+")'/>"
         document.getElementById("input_edit_plan_date").value = task.getElementsByTagName("plan_date")[0].childNodes[0].nodeValue

         row.cells[10].innerHTML = "<button id='button_save' onclick='save_edits("+prog+","+taskid+")'>Save</button>"
         row.cells[11].innerHTML = "<button id='button_cancel' onclick='cancel_edits("+prog+","+taskid+")'>Cancel</button>"
         document.getElementById("select_edit_name").focus()
      }
   }

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function delete_task(prog, taskid)
{ 
   if(!confirm("Are you sure you want to permanently delete this entry?")) return
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url = "request_scripts/task_plan_template_action.php?op=delete&prog="+prog
   url += "&taskid="+taskid+"&rand="+Math.random()

   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         var tbl = document.getElementById("table_task_plan")
         var row = document.getElementById("tr_task_id_"+taskid)
         for(var x = 2 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         tbl.deleteRow(x)

         if(tbl.rows.length < 4) document.getElementById("div_task_plan_template").style.display = "none"

         update_task_table(parser)

         set_disable_all_controls(false)
         document.getElementById("select_name").focus()
      }
   }

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function create_task(prog)
{ 
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   name = document.getElementById('select_name').value
   plan_date = document.getElementById('input_plan_date').value

   var url = "request_scripts/task_plan_template_action.php?op=create&prog="+prog
   url += "&name="+name+"&plan_date="+plan_date
   url += "&rand="+Math.random()

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

         id = parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var tbl = document.getElementById("table_task_plan")
         var row = tbl.insertRow(parseInt(parser.getElementsByTagName("number")[0].childNodes[0].nodeValue) + 1)
         row.id = "tr_task_id_"+id
         for(var x = 0 ; x < parser.getElementsByTagName("task").length ; x++)
            if(parser.getElementsByTagName("task")[x].getAttribute("id") == id) break
         var task = parser.getElementsByTagName("task")[x]
         row.insertCell(row.cells.length).id = "td_task_number_"+id
         row.insertCell(row.cells.length).id = "td_task_name_"+id
         row.insertCell(row.cells.length).id = "td_task_minutes_"+id
         row.insertCell(row.cells.length).id = "td_task_planned_value_"+id
         row.insertCell(row.cells.length).id = "td_task_cumulative_minutes_"+id
         row.insertCell(row.cells.length).id = "td_task_cumulative_planned_value_"+id
         row.insertCell(row.cells.length).id = "td_task_plan_date_"+id
         row.insertCell(row.cells.length).id = "td_task_actual_date_"+id
         row.insertCell(row.cells.length).id = "td_task_earned_value_"+id
         row.insertCell(row.cells.length).id = "td_task_cumulative_earned_value_"+id
         row.insertCell(row.cells.length).innerHTML = "<button onclick='edit_task("+prog+","+id+")'>Edit</button>"
         row.insertCell(row.cells.length).innerHTML = "<button onclick='delete_task("+prog+","+id+")'>Delete</button>"

         document.getElementById("div_task_plan_template").style.display = "inline"

         update_task_table(parser)
         set_disable_all_controls(false)
         document.getElementById("select_name").focus()
      } 
   }
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function update_task_table(parser)
{
   for(var x = 0 ; x < parser.getElementsByTagName("task").length ; x++)
   {
      var task = parser.getElementsByTagName("task")[x]
      var id = task.getAttribute("id")
      if(task.getElementsByTagName("number")[0])
         update_cell("td_task_number_"+id, task.getElementsByTagName("number")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("name")[0])
         update_cell("td_task_name_"+id, task.getElementsByTagName("name")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("minutes")[0])
         update_cell("td_task_minutes_"+id, task.getElementsByTagName("minutes")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("planned_value")[0])
         update_cell("td_task_planned_value_"+id, task.getElementsByTagName("planned_value")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("cumulative_minutes")[0])
         update_cell("td_task_cumulative_minutes_"+id, task.getElementsByTagName("cumulative_minutes")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("cumulative_planned_value")[0])
         update_cell("td_task_cumulative_planned_value_"+id, task.getElementsByTagName("cumulative_planned_value")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("plan_date")[0])
         update_cell("td_task_plan_date_"+id, task.getElementsByTagName("plan_date")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("actual_date")[0])
         if(task.getElementsByTagName("actual_date")[0].childNodes[0])
            update_cell("td_task_actual_date_"+id, task.getElementsByTagName("actual_date")[0].childNodes[0].nodeValue)
         else
            update_cell("td_task_actual_date_"+id, "&nbsp;")
      if(task.getElementsByTagName("earned_value")[0])
         update_cell("td_task_earned_value_"+id, task.getElementsByTagName("earned_value")[0].childNodes[0].nodeValue)
      if(task.getElementsByTagName("cumulative_earned_value")[0])
         update_cell("td_task_cumulative_earned_value_"+id, task.getElementsByTagName("cumulative_earned_value")[0].childNodes[0].nodeValue)
   }

   if(parser.getElementsByTagName("total_minutes")[0])
      update_cell("td_total_minutes", parser.getElementsByTagName("total_minutes")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("total_planned_value")[0])
      update_cell("td_total_planned_value", parser.getElementsByTagName("total_planned_value")[0].childNodes[0].nodeValue)

}

