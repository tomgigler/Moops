function select_probe_est_method_loc_change(prog)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)
   var url = "request_scripts/summary_request.php?op=set_probe_est_method_loc&prog="+prog+"&probe_est_method_loc="+document.getElementById('select_probe_est_method_loc').value

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         if(parser.getElementsByTagName("probe_est_method_loc")[0].childNodes[0] && (parser.getElementsByTagName("probe_est_method_loc")[0].childNodes[0].nodeValue == "D" || parser.getElementsByTagName("probe_est_method_loc")[0].childNodes[0].nodeValue == "C"))
         {
            document.getElementById('td_range_size').innerHTML = "<input id='input_range_size' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"range_size\","+prog+", this.value)' onchange='set_value(\"range_size\","+prog+", this.value)'/>"
            if(parser.getElementsByTagName("range_size_input_value")[0])
               document.getElementById('input_range_size').value = parser.getElementsByTagName("range_size_input_value")[0].childNodes[0].nodeValue
            update_cell('td_interval_percent_size', "N/A")
         }
         else
         {
            document.getElementById('td_range_size').innerHTML = "&nbsp;"
            update_cell('td_interval_percent_size', "&nbsp;")
         }

         update_size_est_template_values(parser)
         set_disable_all_controls(false)
      }
   };

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function select_probe_est_method_time_change(prog)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)
   var url = "request_scripts/summary_request.php?op=set_probe_est_method_time&prog="+prog+"&probe_est_method_time="+document.getElementById('select_probe_est_method_time').value

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         if(parser.getElementsByTagName("probe_est_method_time")[0].childNodes[0] && (parser.getElementsByTagName("probe_est_method_time")[0].childNodes[0].nodeValue == "D" || parser.getElementsByTagName("probe_est_method_time")[0].childNodes[0].nodeValue == "C"))
         {
            document.getElementById('td_range_time').innerHTML = "<input id='input_range_time' type=text size=8 onkeypress='capture_keypress(event, set_value, 0, 0, 0, \"range_time\","+prog+", this.value)' onchange='set_value(\"range_time\","+prog+", this.value)'/>"
            if(parser.getElementsByTagName("range_time_input_value")[0])
               update_value('input_range_time', parser.getElementsByTagName("range_time_input_value")[0].childNodes[0].nodeValue)
            update_cell('td_interval_percent_time', "N/A")
         }
         else
         {
            update_cell('td_range_time', "&nbsp;")
            update_cell('td_interval_percent_time', "&nbsp;")
         }
   
         update_size_est_template_values(parser)
         set_disable_all_controls(false)
      }
   };

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function edit_reused_object(prog,objectid)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)
   var url = "request_scripts/summary_request.php?op=get_reused_object&prog="+prog+"&objectid="+objectid

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         row = document.getElementById("tr_reused_object_"+objectid)
         row.cells[4].innerHTML = "<input id='input_edit_actual_reused_loc' size=6 onkeypress='capture_keypress(event, save_reused_object_edits, cancel_reused_object_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+objectid+")'/>"
         if(parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0])
            document.getElementById("input_edit_actual_reused_loc").value = parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0].nodeValue
         row.cells[5].innerHTML="<button id='save_button' onclick='save_reused_object_edits("+prog+","+objectid+")'>Save</button>"
         row.cells[6].innerHTML="<button id='cancel_button' onclick='cancel_reused_object_edits("+prog+","+objectid+")'>Cancel</button>"
         document.getElementById("input_edit_actual_reused_loc").focus()
      }
   };

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function save_reused_object_edits(prog,objectid)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   reused_loc = parseInt(document.getElementById("input_edit_actual_reused_loc").value)
   var url = "request_scripts/summary_request.php?op=save_reused_object&prog="+prog+"&objectid="+objectid+"&reused_loc="+reused_loc

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         row = document.getElementById("tr_reused_object_"+objectid)
         if(parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0])
            row.cells[4].innerHTML = parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0].nodeValue
         else
            row.cells[4].innerHTML = "&nbsp;"
         row.cells[5].innerHTML="<button onclick='edit_reused_object("+prog+","+objectid+")'>Edit</button>"
         row.cells[6].innerHTML="<button onclick='delete_reused_object("+prog+","+objectid+")'>Delete</button>"

         update_size_est_template_values(parser)
         set_disable_all_controls(false)
      }
   };

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function cancel_reused_object_edits(prog,objectid)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   var url = "request_scripts/summary_request.php?op=get_reused_object&prog="+prog+"&objectid="+objectid

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         row = document.getElementById("tr_reused_object_"+objectid)
         if(parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0])
            row.cells[4].innerHTML = parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0].nodeValue
         else
            row.cells[4].innerHTML = "&nbsp;"
         row.cells[5].innerHTML="<button onclick='edit_reused_object("+prog+","+objectid+")'>Edit</button>"
         row.cells[6].innerHTML="<button onclick='delete_reused_object("+prog+","+objectid+")'>Delete</button>"

         set_disable_all_controls(false)
      }
   };

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function delete_reused_object(prog, objectid)
{

   if(!confirm("Remove this reused object?")) return

   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   var url = "request_scripts/summary_request.php?op=delete_reused_object&prog="+prog+"&objectid="+objectid

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         // delete the row
         var tbl = document.getElementById("table_size_est_table")
         for(var x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x].id == "tr_reused_object_"+objectid) tbl.deleteRow(x)

         // make sure we still have 5 rows in the table
         for(var x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x].id == "row_reuse_object_input") break
         if(tbl.rows[x+5].id == "tr_reused_object_total")
         {
            var row = tbl.insertRow(x+5)
            var cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore"
            cell.colSpan = 7
            cell.innerHTML = "&nbsp;"
            cell = row.insertCell(row.cells.length)
            cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore"
            cell.innerHTML = "&nbsp;"
            cell = row.insertCell(row.cells.length)
            cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore"
            cell.innerHTML = "&nbsp;"
         }

         // add this object to the select
         var e_select_reused_objects = document.getElementById("select_reused_objects")
         e_select_reused_objects.options[0].text = ""
         var new_option = document.createElement("option")
         new_option.text = parser.getElementsByTagName("reused_object_name")[0].childNodes[0].nodeValue
         new_option.value = objectid
         try {
            e_select_reused_objects.add(new_option, null) // standards compliant; doesn't work in IE
         }
         catch(ex) {
            e_select_reused_objects.add(new_option) // IE only
         }

         update_size_est_template_values(parser)
      }
   };

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function add_reused_object(prog)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   objectid = document.getElementById("select_reused_objects").value
   reused_loc = parseInt(document.getElementById("input_actual_reuse_loc").value)
   var url = "request_scripts/summary_request.php?op=add_reused_object&prog="+prog+"&objectid="+objectid+"&reused_loc="+reused_loc

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         // insert the new row
         var tbl = document.getElementById("table_size_est_table")
         var row = document.getElementById("row_reuse_object_input")
         for(var x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         // look for an empty row 
         for( x++ ; x < tbl.rows.length ; x++)
            if(tbl.rows[x].id == "" || tbl.rows[x].id == "tr_reused_object_total") break
         if(tbl.rows[x].id == "") // we found an empty row
         {
            row = tbl.rows[x]
            while(row.cells.length != 0) row.deleteCell(0)
         }
         // if we didn't find an empty row, create a new one
         else row = tbl.insertRow(x)

         var objectid = parser.getElementsByTagName("objectid")[0].childNodes[0].nodeValue
         row.id = "tr_reused_object_"+objectid

         var cell = row.insertCell(row.cells.length)
         cell.colSpan=7
         cell.className="td_underscore_left"
         cell.id = "td_reused_object_name_"+objectid
         update_cell("td_reused_object_name_"+objectid,parser.getElementsByTagName("reused_object_name")[0].childNodes[0].nodeValue)
         cell = row.insertCell(row.cells.length)
         cell = row.insertCell(row.cells.length)
         cell.className="td_underscore"
         cell.id = "td_reused_object_loc_"+objectid
         update_cell("td_reused_object_loc_"+objectid, parser.getElementsByTagName("reused_object_loc")[0].childNodes[0].nodeValue)
         cell = row.insertCell(row.cells.length)
         cell = row.insertCell(row.cells.length)
         cell.className="td_underscore"
         cell.id = "td_reused_object_actual_loc_"+objectid
         if(parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0])
            update_cell("td_reused_object_actual_loc_"+objectid, parser.getElementsByTagName("reused_actual_loc")[0].childNodes[0].nodeValue)
         else
            update_cell("td_reused_object_actual_loc_"+objectid, "&nbsp;", "&nbsp;")
         cell = row.insertCell(row.cells.length)
         cell.innerHTML = "<button onclick='edit_reused_object("+prog+","+objectid+")'>Edit</button>"
         cell = row.insertCell(row.cells.length)
         cell.innerHTML = "<button onclick='delete_reused_object("+prog+","+objectid+")'>Delete</button>"

         // remove this object from the select
         e_select_reused_objects = document.getElementById("select_reused_objects")
         for(var c = 0 ; c < e_select_reused_objects.options.length ; c++)
            if(e_select_reused_objects.options[c].value == objectid)
               e_select_reused_objects.remove(c)
         if(e_select_reused_objects.options.length == 1) e_select_reused_objects.options[0].text = "No objects available"

         update_size_est_template_values(parser)
         document.getElementById("select_reused_objects").value=""
         document.getElementById("input_actual_reuse_loc").value=""
         document.getElementById("button_reused_object_submit").disabled = true
         document.getElementById("input_actual_reuse_loc").disabled = true
         update_cell("td_reusable_objects_loc", "&nbsp;", "&nbsp;")
      }
   };

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function select_reused_objects_change()
{
   if(!document.getElementById("select_reused_objects")) return
   var value = document.getElementById("select_reused_objects").value
   if(value == "")
   {
      update_cell("td_reusable_objects_loc", "&nbsp;", "&nbsp;")
      document.getElementById("button_reused_object_submit").disabled = true
      document.getElementById("input_actual_reuse_loc").disabled = true
      document.getElementById("input_actual_reuse_loc").value = ""
   }
   else
   {
      update_cell("td_reusable_objects_loc", eval("int_reusable_object_"+value), eval("int_reusable_object_"+value))
      document.getElementById("button_reused_object_submit").disabled = false
      document.getElementById("input_actual_reuse_loc").disabled = false
   }
}

function update_size_est_template_values(parser, new_base, id)
{
   if(parser.getElementsByTagName("total_actual_reused_loc")[0])
      update_cell("td_total_actual_reused_loc", parser.getElementsByTagName("total_actual_reused_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("total_plan_reused_loc")[0])
      update_cell("td_total_plan_reused_loc", parser.getElementsByTagName("total_plan_reused_loc")[0].childNodes[0].nodeValue)

   if(parser.getElementsByTagName("est_total_new_reuse")[0])
      update_cell('td_est_total_new_reuse', parser.getElementsByTagName("est_total_new_reuse")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("est_obj_loc")[0])
      update_cell('td_est_obj_loc', parser.getElementsByTagName("est_obj_loc")[0].childNodes[0].nodeValue)

   if(typeof(new_base) != "undefined")
   {
      if(parser.getElementsByTagName("plan_total_"+new_base)[0])
         update_cell('td_plan_total_'+new_base+'_objects', parser.getElementsByTagName("plan_total_"+new_base)[0].childNodes[0].nodeValue)
      if(parser.getElementsByTagName("total_"+new_base)[0])
         update_cell('td_total_'+new_base+'_objects', parser.getElementsByTagName("total_"+new_base)[0].childNodes[0].nodeValue)
   }

   if(parser.getElementsByTagName("probe_est_method_loc")[0])
      update_value('select_probe_est_method_loc', parser.getElementsByTagName("probe_est_method_loc")[0].childNodes[0].nodeValue)

   if(parser.getElementsByTagName("b0_size")[0])
      if(parser.getElementsByTagName("b0_size")[0].childNodes[0])
         update_cell("td_b0_size", parser.getElementsByTagName("b0_size")[0].childNodes[0].nodeValue)
      else
         update_cell("td_b0_size", "&nbsp;")
   if(parser.getElementsByTagName("b1_size")[0])
      if(parser.getElementsByTagName("b1_size")[0].childNodes[0])
         update_cell("td_b1_size", parser.getElementsByTagName("b1_size")[0].childNodes[0].nodeValue)
      else
         update_cell("td_b1_size", "&nbsp;")

   if(parser.getElementsByTagName("b0_time")[0])
      if(parser.getElementsByTagName("b0_time")[0].childNodes[0])
         update_cell("td_b0_time", parser.getElementsByTagName("b0_time")[0].childNodes[0].nodeValue)
      else
         update_cell("td_b0_time", "&nbsp;")
   if(parser.getElementsByTagName("b1_time")[0])
      if(parser.getElementsByTagName("b1_time")[0].childNodes[0])
         update_cell("td_b1_time", parser.getElementsByTagName("b1_time")[0].childNodes[0].nodeValue)
      else
         update_cell("td_b1_time", "&nbsp;")

   if(parser.getElementsByTagName("upper_interval_size")[0])
      if(parser.getElementsByTagName("upper_interval_size")[0].childNodes[0])
         update_cell("td_upper_interval_size", parser.getElementsByTagName("upper_interval_size")[0].childNodes[0].nodeValue)
      else
         update_cell("td_upper_interval_size", "&nbsp;")

   if(parser.getElementsByTagName("lower_interval_size")[0])
      if(parser.getElementsByTagName("lower_interval_size")[0].childNodes[0])
         update_cell("td_lower_interval_size", parser.getElementsByTagName("lower_interval_size")[0].childNodes[0].nodeValue)
      else
         update_cell("td_lower_interval_size", "&nbsp;")

   if(parser.getElementsByTagName("upper_interval_time")[0])
      if(parser.getElementsByTagName("upper_interval_time")[0].childNodes[0])
         update_cell("td_upper_interval_time", parser.getElementsByTagName("upper_interval_time")[0].childNodes[0].nodeValue)
      else
         update_cell("td_upper_interval_time", "&nbsp;")

   if(parser.getElementsByTagName("lower_interval_time")[0])
      if(parser.getElementsByTagName("lower_interval_time")[0].childNodes[0])
         update_cell("td_lower_interval_time", parser.getElementsByTagName("lower_interval_time")[0].childNodes[0].nodeValue)
      else
         update_cell("td_lower_interval_time", "&nbsp;")

   if(parser.getElementsByTagName("probe_plan_time")[0])
      if(parser.getElementsByTagName("probe_plan_time")[0].childNodes[0])
         update_cell('td_probe_plan_time', parser.getElementsByTagName("probe_plan_time")[0].childNodes[0].nodeValue)
      else
         update_cell('td_probe_plan_time', "&nbsp;")
   if(parser.getElementsByTagName("probe_plan_newchg_loc")[0])
      if(parser.getElementsByTagName("probe_plan_newchg_loc")[0].childNodes[0])
         update_cell("td_probe_plan_newchg_loc", parser.getElementsByTagName("probe_plan_newchg_loc")[0].childNodes[0].nodeValue)
      else
         update_cell('td_probe_plan_newchg_loc', "&nbsp;")
   if(parser.getElementsByTagName("probe_plan_total_loc")[0])
      if(parser.getElementsByTagName("probe_plan_total_loc")[0].childNodes[0])
         update_cell("td_probe_plan_total_loc", parser.getElementsByTagName("probe_plan_total_loc")[0].childNodes[0].nodeValue)
      else
         update_cell('td_probe_plan_total_loc', "&nbsp;")
}

function set_edit_inputs_disabled(value)
{
   document.getElementById('save_button').disabled = value
   document.getElementById('cancel_button').disabled = value
   document.getElementById('input_object_edit_name').disabled = value
   document.getElementById('select_object_edit_type').disabled = value
   document.getElementById('input_object_edit_methods').disabled = value
   if(document.getElementById('select_object_edit_rel_size'))
      document.getElementById('select_object_edit_rel_size').disabled = value
   document.getElementById('input_object_edit_loc').disabled = value
}

function save_edits(prog, id, new_base)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_edit_inputs_disabled(true)
   var name = document.getElementById('input_object_edit_name').value
   var type = document.getElementById('select_object_edit_type').value
   var methods = document.getElementById('input_object_edit_methods').value
   if(document.getElementById('select_object_edit_rel_size'))
      var rel_size = document.getElementById('select_object_edit_rel_size').value
   var loc = document.getElementById('input_object_edit_loc').value

   if(name == "")
   {
      document.getElementById('input_object_edit_name').style.backgroundColor = "pink"
      alert("Invalid name!")
      document.getElementById('input_object_edit_name').style.backgroundColor = ""
      set_edit_inputs_disabled(false)
      return
   }

   if(isNaN(parseInt(methods)))
   {
      document.getElementById('input_object_edit_methods').style.backgroundColor = "pink"
      alert("Methods must be an integer!")
      document.getElementById('input_object_edit_methods').style.backgroundColor = ""
      set_edit_inputs_disabled(false)
      return
   }

   if(new_base == 'base') loc = parseInt(loc)

   var url = "request_scripts/summary_request.php?op=update_object&prog="+prog
   url += "&id="+id+"&name="+name+"&type="+type+"&methods="+methods
   if(document.getElementById('select_object_edit_rel_size'))
      url+="&rel_size="+rel_size
   url += "&loc="+loc+"&new_base="+new_base+"&rand="+Math.random()

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
            set_edit_inputs_disabled(false)
            if(parser.getElementsByTagName("focus")[0])
               document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
            return
         }

         update_size_est_template_values(parser, new_base, id)

         update_cell('cell_'+new_base+'_object_name_'+id, parser.getElementsByTagName("name")[0].childNodes[0].nodeValue, parser.getElementsByTagName("old_name")[0].childNodes[0].nodeValue)
         update_cell('cell_'+new_base+'_object_type_'+id, parser.getElementsByTagName("type")[0].childNodes[0].nodeValue, parser.getElementsByTagName("old_type")[0].childNodes[0].nodeValue)
         update_cell('cell_'+new_base+'_object_methods_'+id, parser.getElementsByTagName("methods")[0].childNodes[0].nodeValue, parser.getElementsByTagName("old_methods")[0].childNodes[0].nodeValue)
         update_cell('cell_'+new_base+'_object_loc_'+id, parser.getElementsByTagName("loc")[0].childNodes[0].nodeValue, parser.getElementsByTagName("old_loc")[0].childNodes[0].nodeValue)
         if(parser.getElementsByTagName("rel_size")[0])
         {
            update_cell('cell_'+new_base+'_object_rel_size_'+id, parser.getElementsByTagName("rel_size")[0].childNodes[0].nodeValue, parser.getElementsByTagName("old_rel_size")[0].childNodes[0].nodeValue)
            update_cell('cell_'+new_base+'_object_est_loc_'+id, parser.getElementsByTagName("est_loc")[0].childNodes[0].nodeValue, parser.getElementsByTagName("old_est_loc")[0].childNodes[0].nodeValue)
         }

         row = document.getElementById('row_'+new_base+'_object_'+id)
         row.cells[11].innerHTML="<button onclick='edit_object("+prog+","+id+",\""+new_base+"\")'>Edit</button>"
         row.cells[12].innerHTML="<button onClick='delete_object("+prog+","+id+",\""+new_base+"\",\""+parser.getElementsByTagName("name")[0].childNodes[0].nodeValue+"\")'>Delete</button>"

         set_disable_all_controls(false)

      }
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function cancel_edits(prog, id, new_base)
{
   var xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)

   var url = "request_scripts/summary_request.php?op=get_object&prog="+prog+"&id="+id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         var row = document.getElementById("row_"+new_base+"_object_"+id)
         row.cells[0].innerHTML = parser.getElementsByTagName("name")[0].childNodes[0].nodeValue
         row.cells[2].innerHTML = parser.getElementsByTagName("type")[0].childNodes[0].nodeValue
         row.cells[4].innerHTML = parser.getElementsByTagName("methods")[0].childNodes[0].nodeValue
         if(parser.getElementsByTagName("level")[0].childNodes[0].nodeValue > 1)
         {
            row.cells[6].innerHTML = parser.getElementsByTagName("rel_size")[0].childNodes[0].nodeValue
            row.cells[8].innerHTML = parser.getElementsByTagName("est_loc")[0].childNodes[0].nodeValue
         }
         if(parser.getElementsByTagName("reuse")[0].childNodes[0].nodeValue == 1)
            row.cells[10].innerHTML = parser.getElementsByTagName("loc")[0].childNodes[0].nodeValue+"*"
         else
            row.cells[10].innerHTML = parser.getElementsByTagName("loc")[0].childNodes[0].nodeValue
         row.cells[11].innerHTML="<button onclick='edit_object("+prog+","+id+",\""+new_base+"\")'>Edit</button>"
         row.cells[12].innerHTML="<button onClick='delete_object("+prog+","+id+",\""+new_base+"\",\""+parser.getElementsByTagName("name")[0].childNodes[0].nodeValue+"\")'>Delete</button>"

         set_disable_all_controls(false)
      }
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function edit_object(prog, id, new_base, name)
{
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)

   var url = "request_scripts/summary_request.php?op=get_object_for_edit&prog="+prog+"&id="+id+"&rand="+Math.random()
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

         // find location to insert new row
         var tbl = document.getElementById("table_size_est_table")
         var row = document.getElementById("row_"+new_base+"_object_"+id)
         for(var x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x].id == row) break
         row.cells[0].innerHTML = "<input id='input_object_edit_name' size=40 onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+","+id+",\""+new_base+"\")'/>"
         document.getElementById("input_object_edit_name").value = parser.getElementsByTagName("name")[0].childNodes[0].nodeValue
         row.cells[2].innerHTML = "<select id='select_object_edit_type' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+
prog+","+id+",\""+new_base+"\")'/>"
         row.cells[4].innerHTML = "<input id='input_object_edit_methods' size=6 onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+
prog+","+id+",\""+new_base+"\")'/>"
         document.getElementById("input_object_edit_methods").value = parser.getElementsByTagName("methods")[0].childNodes[0].nodeValue
         row.cells[10].innerHTML = "<input id='input_object_edit_loc' size=6 onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+
prog+","+id+",\""+new_base+"\")'/>"

         if(parser.getElementsByTagName("level")[0].childNodes[0].nodeValue > 1)
         {
            row.cells[6].innerHTML = "<select id='select_object_edit_rel_size' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+
prog+","+id+",\""+new_base+"\")'/>"
            row.cells[8].innerHTML = "&nbsp;"
         }
         if(parser.getElementsByTagName("reuse")[0].childNodes[0].nodeValue == 1)
            document.getElementById("input_object_edit_loc").value = parser.getElementsByTagName("loc")[0].childNodes[0].nodeValue+'*'
         else
            document.getElementById("input_object_edit_loc").value = parser.getElementsByTagName("loc")[0].childNodes[0].nodeValue

         var e_select_edit_object_type = document.getElementById("select_object_edit_type")
         var e_select_object_type = document.getElementById("select_"+new_base+"_object_type")
         for(c = 0 ; c < e_select_object_type.options.length ; c++)
         {
            var new_option = document.createElement("option")
            new_option.text = e_select_object_type.options[c].text
            new_option.value = e_select_object_type.options[c].value
            try {
               e_select_edit_object_type.add(new_option, null) // standards compliant; doesn't work in IE
            }
            catch(ex) {
               e_select_edit_object_type.add(new_option) // IE only
            }
            if(new_option.text == parser.getElementsByTagName("type")[0].childNodes[0].nodeValue)
               new_option.selected=c
         }

         if(document.getElementById("select_object_edit_rel_size"))
         {
            var e_select_edit_object_rel_size = document.getElementById("select_object_edit_rel_size")
            var e_select_object_rel_size = document.getElementById("select_"+new_base+"_object_rel_size")
            for(c = 0 ; c < e_select_object_rel_size.options.length ; c++)
            {
               var new_option = document.createElement("option")
               new_option.text = e_select_object_rel_size.options[c].text
               new_option.value = e_select_object_rel_size.options[c].value
               try {
                  e_select_edit_object_rel_size.add(new_option, null) // standards compliant; doesn't work in IE
               }
               catch(ex) {
                  e_select_edit_object_rel_size.add(new_option) // IE only
               }
               if(new_option.text == parser.getElementsByTagName("rel_size")[0].childNodes[0].nodeValue)
                  new_option.selected=c
            }
         }
         row.cells[11].innerHTML="<button id='save_button' onclick='save_edits("+prog+","+id+",\""+new_base+"\")'>Save</button>"
         row.cells[12].innerHTML="<button id='cancel_button' onclick='cancel_edits("+prog+","+id+",\""+new_base+"\")'>Cancel</button>"
         document.getElementById("input_object_edit_name").focus()
      }
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function delete_object(prog, id, new_base, name)
{
  
   if(!confirm("Are you sure you want to permanently delete \""+name+"\"?")) return

   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)

   var url = "request_scripts/summary_request.php?op=delete_object&prog="+prog+"&id="+id+"&new_base="+new_base+"&rand="+Math.random()

   xmlHttp.onreadystatechange=function()
   {
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      {
         parser = GetXmlDOMObject(xmlHttp.responseText)

         // if server returned an alert, display alert and cancel action
         if(parser.getElementsByTagName("alert")[0])
         {
            alert(parser.getElementsByTagName("alert")[0].childNodes[0].nodeValue)
            set_disable_all_controls(false)
            return
         }

         // find row to delete
         var id = parser.getElementsByTagName("id")[0].childNodes[0].nodeValue
         var tbl = document.getElementById("table_size_est_table")
         var row = document.getElementById("row_"+new_base+"_object_"+id)
         for(var x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         tbl.deleteRow(x)

         // make sure we still have at least 5 rows for new or 4 for base
         if(new_base == 'new') var row_count = 5
         else var row_count = 4
         var row = document.getElementById("row_"+new_base+"_object_input")
         for( x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         if(tbl.rows[x+row_count].id == "row_"+new_base+"_object_total")
         {
            row = tbl.insertRow(x+row_count)
            var cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore_left"
            cell.innerHTML = "&nbsp;"
            row.insertCell(row.cells.length)
            cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore_left"
            cell.innerHTML = "&nbsp;"
            row.insertCell(row.cells.length)
            cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore_left"
            cell.innerHTML = "&nbsp;"
            row.insertCell(row.cells.length)
            cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore_left"
            if(parser.getElementsByTagName("level")[0].childNodes[0].nodeValue > 1)
               cell.innerHTML = "&nbsp;"
            row.insertCell(row.cells.length)
            cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore_left"
            if(parser.getElementsByTagName("level")[0].childNodes[0].nodeValue > 1)
               cell.innerHTML = "&nbsp;"
            row.insertCell(row.cells.length)
            cell = row.insertCell(row.cells.length)
            cell.className = "td_underscore_left"
            cell.innerHTML = "&nbsp;"
         }

         update_size_est_template_values(parser, new_base, id)

         set_disable_all_controls(false)
         document.getElementById('input_'+new_base+'_object_name').focus()
      }
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function create_object(prog, new_base)
{
   xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)

   var name = document.getElementById('input_'+new_base+'_object_name').value
   var type = document.getElementById('select_'+new_base+'_object_type').value
   var methods = document.getElementById('input_'+new_base+'_object_methods').value
   if(document.getElementById('select_'+new_base+'_object_rel_size'))
      var rel_size = document.getElementById('select_'+new_base+'_object_rel_size').value
   var loc = document.getElementById('input_'+new_base+'_object_loc').value

   if(name == "")
   {
      document.getElementById('input_'+new_base+'_object_name').style.backgroundColor = "pink"
      alert("Invalid name!")
      document.getElementById('input_'+new_base+'_object_name').style.backgroundColor = ""
      set_disable_all_controls(false)
      document.getElementById('input_'+new_base+'_object_name').focus()
      return
   }

   if(isNaN(parseInt(methods)))
   {
      document.getElementById('input_'+new_base+'_object_methods').style.backgroundColor = "pink"
      alert("Methods must be an integer!")
      document.getElementById('input_'+new_base+'_object_methods').style.backgroundColor = ""
      set_disable_all_controls(false)
      document.getElementById('input_'+new_base+'_object_methods').focus()
      return
   }

   if(new_base == 'base') loc = parseInt(loc)

   var url = "request_scripts/summary_request.php?op=create_object&prog="+prog
   url += "&name="+name+"&type="+type+"&methods="+methods
   if(document.getElementById('select_'+new_base+'_object_rel_size'))
      url += "&rel_size="+rel_size
   url += "&loc="+loc+"&new_base="+new_base+"&rand="+Math.random()

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

         // find location to insert new row
         var tbl = document.getElementById("table_size_est_table")
         var row = document.getElementById("row_"+new_base+"_object_input")
         for(var x = 0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x].id == "row_"+new_base+"_object_input") break
         for( x++ ; x < tbl.rows.length ; x++)
            if(tbl.rows[x].id == "" || tbl.rows[x].id == "row_"+new_base+"_object_total") break
         if(tbl.rows[x].id == "")
         {
            row = tbl.rows[x]
            while(row.cells.length != 0) row.deleteCell(0)
         }
         else row = tbl.insertRow(x)

         var id = parser.getElementsByTagName("id")[0].childNodes[0].nodeValue
         row.id = "row_"+new_base+"_object_"+id

         var cell = row.insertCell(row.cells.length)
         cell.className = "td_underscore_left"
         cell.id = "cell_"+new_base+"_object_name_"+id
         update_cell('cell_'+new_base+'_object_name_'+id, parser.getElementsByTagName("name")[0].childNodes[0].nodeValue)

         row.insertCell(row.cells.length)

         cell = row.insertCell(row.cells.length)
         cell.className = "td_underscore"
         cell.id = "cell_"+new_base+"_object_type_"+id
         update_cell('cell_'+new_base+'_object_type_'+id, parser.getElementsByTagName("type")[0].childNodes[0].nodeValue)

         row.insertCell(row.cells.length)

         cell = row.insertCell(row.cells.length)
         cell.className = "td_underscore"
         cell.id = "cell_"+new_base+"_object_methods_"+id
         update_cell('cell_'+new_base+'_object_methods_'+id, parser.getElementsByTagName("methods")[0].childNodes[0].nodeValue)

         row.insertCell(row.cells.length)

         cell = row.insertCell(row.cells.length)
         cell.className = "td_underscore"
         cell.id = "cell_"+new_base+"_object_rel_size_"+id

         row.insertCell(row.cells.length)

         cell = row.insertCell(row.cells.length)
         row.insertCell(row.cells.length)
         cell.className = "td_underscore"
         cell.id = "cell_"+new_base+"_object_est_loc_"+id

         cell = row.insertCell(row.cells.length)
         cell.className = "td_underscore"
         cell.id = "cell_"+new_base+"_object_loc_"+id
         update_cell('cell_'+new_base+'_object_loc_'+id, parser.getElementsByTagName("loc")[0].childNodes[0].nodeValue)

         if(parser.getElementsByTagName("rel_size")[0])
         {
            update_cell('cell_'+new_base+'_object_rel_size_'+id, parser.getElementsByTagName("rel_size")[0].childNodes[0].nodeValue)
            update_cell('cell_'+new_base+'_object_est_loc_'+id, parser.getElementsByTagName("est_loc")[0].childNodes[0].nodeValue)
         }

         row.insertCell(row.cells.length).innerHTML="<button onClick='edit_object(\""+prog+"\",\""+id+"\",\""+new_base+"\")'>Edit</button>"
         row.insertCell(row.cells.length).innerHTML="<button onClick='delete_object(\""+prog+"\",\""+id+"\",\""+new_base+"\",\""+parser.getElementsByTagName("name")[0].childNodes[0].nodeValue+"\")'>Delete</button>"

         update_size_est_template_values(parser, new_base, id)

         set_disable_all_controls(false)
         document.getElementById('input_'+new_base+'_object_name').focus()

         document.getElementById('input_'+new_base+'_object_name').value = ""
         document.getElementById('input_'+new_base+'_object_methods').value = ""
         document.getElementById('input_'+new_base+'_object_loc').value = ""
      }
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

