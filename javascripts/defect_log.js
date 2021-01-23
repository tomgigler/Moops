function delete_defect(prog,row_id)
{ 
   if(!confirm("Are you sure you want to permanently delete this entry?" + row_id)) return
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url="request_scripts/defect_log_action.php?op=delete&prog="+prog+"&defectid="+row_id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         var tbl = document.getElementById('table_defect_log')
         var row = document.getElementById("defect_id_"+row_id)
         var lastRow = tbl.rows.length;
         for(x = 0 ; x < lastRow ; x++){
            if(tbl.rows[x] == row) break
         }

         // each defect consists of 4 rows, delete all 4
         for(c = 0 ; c < 4 ; c++) tbl.deleteRow(x)

         // if there are no defects left, don't display the table
         if(tbl.rows.length == 0)
            document.getElementById('div_defect_log').style.display = 'none'

         // remove the last entry from the fixref drop down
         document.getElementById('select_fixref').remove(document.getElementById('select_fixref').length - 1)

         // modify values for number and fixref
         for(var d_row = 0 ; d_row * 4 < tbl.rows.length  ; d_row++)
         {
            old_update_cell(tbl.rows[d_row * 4 + 1].cells[1].id, d_row + 1)
            if(parser.getElementsByTagName("fixref")[d_row].childNodes[0])
               old_update_cell(tbl.rows[d_row * 4 + 1].cells[6].id, parser.getElementsByTagName("fixref")[d_row].childNodes[0].nodeValue)
            else
               old_update_cell(tbl.rows[d_row * 4 + 1].cells[6].id, "&nbsp;")

         }

         set_disable_all_controls(false)
         document.getElementById("input_date").focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function create_defect(prog)
{ 
   set_disable_all_controls(true)

   var xmlHttp=GetXmlHttpObject()

   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   var date = document.getElementById('input_date').value
   var type = document.getElementById('select_type').value
   var inject = document.getElementById('select_inject_phase').value
   var remove = document.getElementById('select_remove_phase').value
   var fixtime = document.getElementById('input_fixtime').value
   var fixref = document.getElementById('select_fixref').value
   var description = document.getElementById('input_description').value

   if(isNaN(parseInt(fixtime)))
   {
      document.getElementById('input_fixtime').style.backgroundColor = "pink"
      alert("Fix Time must be an integer!")
      document.getElementById('input_fixtime').style.backgroundColor = ""
      set_disable_all_controls(false)
      return
   }

   var url = "request_scripts/defect_log_action.php?op=create&prog="+prog
   url += "&date="+date+"&defect_type="+type+"&inject_phase="+inject
   url += "&remove_phase="+remove+"&fix_time="+fixtime+"&fix_ref="+fixref+"&description="+description
   url += "&rand="+Math.random()

   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         var parser = GetXmlDOMObject(xmlHttp.responseText)

         if(parser.getElementsByTagName("alert")[0])
         {
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).style.backgroundColor = "pink"
            alert(parser.getElementsByTagName("alert")[0].childNodes[0].nodeValue)
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).style.backgroundColor = ""
            set_disable_all_controls(false)
            return
         }

         var tbl = document.getElementById('table_defect_log')
         var header_row = tbl.insertRow(tbl.rows.length)
         header_row.id='defect_id_'+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue
         header_row.insertCell(0).innerHTML="Date"
         header_row.insertCell(1).innerHTML="Number"
         header_row.insertCell(2).innerHTML="Type"
         header_row.insertCell(3).innerHTML="Inject"
         header_row.insertCell(4).innerHTML="Remove"
         header_row.insertCell(5).innerHTML="Fix Time"
         header_row.insertCell(6).innerHTML="Fix Ref."

         var defect_row = tbl.insertRow(tbl.rows.length)

         var date_cell = defect_row.insertCell(0)
         date_cell.className='td_defect_box'
         date_cell.innerHTML=parser.getElementsByTagName("date")[0].childNodes[0].nodeValue
         date_cell.id = "defect_date_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var number_cell = defect_row.insertCell(1)
         number_cell.className='td_defect_box'
         number_cell.innerHTML=parser.getElementsByTagName("number")[0].childNodes[0].nodeValue
         number_cell.id = "defect_number_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var type_cell = defect_row.insertCell(2)
         type_cell.className='td_defect_box'
         type_cell.innerHTML=parser.getElementsByTagName("type")[0].childNodes[0].nodeValue
         type_cell.id = "defect_type_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var inject_cell = defect_row.insertCell(3)
         inject_cell.className='td_defect_box'
         inject_cell.innerHTML=parser.getElementsByTagName("inject_phase")[0].childNodes[0].nodeValue
         inject_cell.id = "defect_inject_phase_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var remove_cell = defect_row.insertCell(4)
         remove_cell.className='td_defect_box'
         if(parser.getElementsByTagName("remove_phase")[0].childNodes[0])
            remove_cell.innerHTML=parser.getElementsByTagName("remove_phase")[0].childNodes[0].nodeValue
         else remove_cell.innerHTML="&nbsp;"
         remove_cell.id = "defect_remove_phase_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var fixtime_cell = defect_row.insertCell(5)
         fixtime_cell.className='td_defect_box'
         fixtime_cell.innerHTML=parser.getElementsByTagName("fixtime")[0].childNodes[0].nodeValue
         fixtime_cell.id = "defect_fixtime_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var fixref_cell = defect_row.insertCell(6)
         fixref_cell.className='td_defect_box'
         if(parser.getElementsByTagName("fixref")[0].childNodes[0])
            fixref_cell.innerHTML=parser.getElementsByTagName("fixref")[0].childNodes[0].nodeValue
         else fixref_cell.innerHTML="&nbsp;"
         fixref_cell.id = "defect_fixref_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var delete_button_cell = defect_row.insertCell(7)
         delete_button_cell.innerHTML="<button onclick='edit_defect("+prog+","+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue+")' disabled>Edit</button>"

         var desc_row = tbl.insertRow(tbl.rows.length)
         var desc_label_cell = desc_row.insertCell(0)
         desc_label_cell.innerHTML="Description:"
         desc_label_cell.align="right"

         var desc_cell = desc_row.insertCell(1)
         desc_cell.className="td_underscore_left"
         desc_cell.colSpan="6"
         if(parser.getElementsByTagName("description")[0].childNodes[0])
            desc_cell.innerHTML=parser.getElementsByTagName("description")[0].childNodes[0].nodeValue
         else desc_cell.innerHTML="&nbsp;"
         desc_cell.id = "defect_description_"+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue

         var delete_button_cell = desc_row.insertCell(2)
         delete_button_cell.innerHTML="<button onclick='delete_defect("+prog+","+parser.getElementsByTagName("id")[0].childNodes[0].nodeValue+")' disabled>Delete</button>"

         // spacer row
         tbl.insertRow(tbl.rows.length).insertCell(0).innerHTML="&nbsp;"

         document.getElementById('input_date').value=date_cell.innerHTML
         document.getElementById('input_fixtime').value=0
         document.getElementById('option_fixref_none').selected=true
         document.getElementById('input_description').value=""

         var fixref_option = document.createElement('option');
         fixref_option.text = parser.getElementsByTagName("number")[0].childNodes[0].nodeValue
         fixref_option.value = parser.getElementsByTagName("number")[0].childNodes[0].nodeValue
         var select_fixref = document.getElementById('select_fixref')

         try {
            select_fixref.add(fixref_option, null); // standards compliant; doesn't work in IE
         }
         catch(ex) {
            select_fixref.add(fixref_option); // IE only
         }


         set_disable_all_controls(false)
         document.getElementById("input_date").focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

   document.getElementById('div_defect_log').style.display = 'inline'

}


function edit_defect(prog, row_id)
{
   var xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url="request_scripts/defect_log_action.php?op=get_row&prog="+prog+"&defectid="+row_id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         var row = document.getElementById("defect_id_"+row_id)
         var tbl = document.getElementById("table_defect_log")
         for(var x =0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         row = tbl.rows[x+1]
         row.cells[0].innerHTML="<input id='input_edit_date' value="+parser.getElementsByTagName("date")[0].childNodes[0].nodeValue+" size='8'/>"
         row.cells[0].innerHTML="<input id='input_edit_date' value="+parser.getElementsByTagName("date")[0].childNodes[0].nodeValue+" size='8' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+", "+row_id+")'/>"

         row.cells[2].innerHTML="<select id='select_edit_type' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+", "+row_id+")'/>"
         var e_select_edit_type = document.getElementById('select_edit_type')
         var e_select_type = document.getElementById('select_type')
         for(c = 0 ; c < e_select_type.options.length ; c++)
         { 
            var new_option_type = document.createElement('option')     
            new_option_type.text = e_select_type.options[c].text
            new_option_type.value = e_select_type.options[c].value
            try {
               e_select_edit_type.add(new_option_type, null) // standards compliant; doesn't work in IE
            } 
            catch(ex) {
               e_select_edit_type.add(new_option_type) // IE only
            }
            if(new_option_type.text == parser.getElementsByTagName("type")[0].childNodes[0].nodeValue)
               new_option_type.selected=c
         }

         row.cells[3].innerHTML="<select id='select_edit_inject_phase' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+", "+row_id+")'/>"
         var e_select_edit_inject_phase = document.getElementById('select_edit_inject_phase')
         var e_select_inject_phase = document.getElementById('select_inject_phase')
         for(c = 0 ; c < e_select_inject_phase.options.length ; c++)
         { 
            var new_option_inject_phase = document.createElement('option')     
            new_option_inject_phase.text = e_select_inject_phase.options[c].text
            new_option_inject_phase.value = e_select_inject_phase.options[c].value
            try {
               e_select_edit_inject_phase.add(new_option_inject_phase, null) // standards compliant; doesn't work in IE
            } 
            catch(ex) {
               e_select_edit_inject_phase.add(new_option_inject_phase) // IE only
            }
            if(new_option_inject_phase.text == parser.getElementsByTagName("inject_phase")[0].childNodes[0].nodeValue)
               new_option_inject_phase.selected=c
         }

         row.cells[4].innerHTML="<select id='select_edit_remove_phase' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+", "+row_id+")'/>"
         var e_select_edit_remove_phase = document.getElementById('select_edit_remove_phase')
         var e_select_remove_phase = document.getElementById('select_remove_phase')
         for(c = 0 ; c < e_select_remove_phase.options.length ; c++)
         { 
            var new_option_remove_phase = document.createElement('option')     
            new_option_remove_phase.text = e_select_remove_phase.options[c].text
            new_option_remove_phase.value = e_select_remove_phase.options[c].value
            try {
               e_select_edit_remove_phase.add(new_option_remove_phase, null) // standards compliant; doesn't work in IE
            } 
            catch(ex) {
               e_select_edit_remove_phase.add(new_option_remove_phase) // IE only
            }
            if(parser.getElementsByTagName("remove_phase")[0].childNodes[0] && new_option_remove_phase.text == parser.getElementsByTagName("remove_phase")[0].childNodes[0].nodeValue)
               new_option_remove_phase.selected=c
         }

         row.cells[5].innerHTML="<input id='input_edit_fixtime' value="+parser.getElementsByTagName("fixtime")[0].childNodes[0].nodeValue+" size='8' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+", "+row_id+")'/>"

         row.cells[6].innerHTML="<select id='select_edit_fixref' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+", "+row_id+")'/>"
         var e_select_edit_fixref = document.getElementById('select_edit_fixref')
         var e_select_fixref = document.getElementById('select_fixref')
         for(c = 0 ; c < e_select_fixref.options.length ; c++)
         { 
            var new_option_fixref = document.createElement('option')     
            new_option_fixref.text = e_select_fixref.options[c].text
            new_option_fixref.value = e_select_fixref.options[c].value
            if(e_select_fixref.options[c].value != parser.getElementsByTagName("number")[0].childNodes[0].nodeValue)
            {
               try {
                  e_select_edit_fixref.add(new_option_fixref, null) // standards compliant; doesn't work in IE
               } 
               catch(ex) {
                  e_select_edit_fixref.add(new_option_fixref) // IE only
               }
               if(parser.getElementsByTagName("fixref")[0].childNodes[0] && new_option_fixref.text == parser.getElementsByTagName("fixref")[0].childNodes[0].nodeValue)
                  new_option_fixref.selected=c
            }
         }
         row.cells[7].innerHTML="<button onclick='save_edits("+prog+","+row_id+")'>Save</button>"
         row = tbl.rows[x+2]

         row.cells[1].innerHTML="<input id='input_edit_description' size='100' onkeypress='capture_keypress(event, save_edits, cancel_edits, \"Save edits?\", \"Cancel edits?\", "+prog+", "+row_id+")'/>"
         if(parser.getElementsByTagName("description")[0].childNodes[0])
            document.getElementById('input_edit_description').value = parser.getElementsByTagName("description")[0].childNodes[0].nodeValue
         else
            document.getElementById('input_edit_description').value = ""
         row.cells[2].innerHTML="<button onclick='cancel_edits("+prog+","+row_id+")'>Cancel</button>"
         document.getElementById("input_edit_date").focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
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

   var e_select_edit_type=document.getElementById('select_edit_type')
   var type=e_select_edit_type.options[e_select_edit_type.selectedIndex].value

   var e_select_edit_inject_phase=document.getElementById('select_edit_inject_phase')
   var inject_phase=e_select_edit_inject_phase.options[e_select_edit_inject_phase.selectedIndex].value

   var e_select_edit_remove_phase=document.getElementById('select_edit_remove_phase')
   var remove_phase=e_select_edit_remove_phase.options[e_select_edit_remove_phase.selectedIndex].value

   var fixtime=document.getElementById('input_edit_fixtime').value

   var e_select_edit_fixref=document.getElementById('select_edit_fixref')
   var fixref=e_select_edit_fixref.options[e_select_edit_fixref.selectedIndex].value

   var description=document.getElementById('input_edit_description').value

   if(isNaN(parseInt(fixtime)))
   {
      document.getElementById('input_edit_fixtime').style.backgroundColor = "pink"
      alert("Fix Time must be an integer!")
      document.getElementById('input_edit_fixtime').style.backgroundColor = ""
      set_disable_all_controls(false)
      return
   }

   var url = "request_scripts/defect_log_action.php?op=update&prog="+prog+"&defectid="+row_id
   url += "&date="+date+"&defect_type="+type+"&inject_phase="+inject_phase
   url += "&remove_phase="+remove_phase+"&fix_time="+fixtime+"&fix_ref="+fixref+"&description="+description
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
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).style.backgroundColor = ""
            set_disable_all_controls(false)
            return
         }

         document.getElementById('defect_date_'+row_id).innerHTML = parser.getElementsByTagName("old_date")[0].childNodes[0].nodeValue
         document.getElementById('defect_type_'+row_id).innerHTML = parser.getElementsByTagName("old_type")[0].childNodes[0].nodeValue
         document.getElementById('defect_inject_phase_'+row_id).innerHTML = parser.getElementsByTagName("old_inject_phase")[0].childNodes[0].nodeValue
         if(parser.getElementsByTagName("old_remove_phase")[0].childNodes[0])
            document.getElementById('defect_remove_phase_'+row_id).innerHTML = parser.getElementsByTagName("old_remove_phase")[0].childNodes[0].nodeValue
         else
            document.getElementById('defect_remove_phase_'+row_id).innerHTML = "&nbsp;"
         document.getElementById('defect_fixtime_'+row_id).innerHTML = parser.getElementsByTagName("old_fixtime")[0].childNodes[0].nodeValue
         if(parser.getElementsByTagName("old_fixref")[0].childNodes[0])
            document.getElementById('defect_fixref_'+row_id).innerHTML = parser.getElementsByTagName("old_fixref")[0].childNodes[0].nodeValue
         else
            document.getElementById('defect_fixref_'+row_id).innerHTML = "&nbsp;"
         if(parser.getElementsByTagName("old_description")[0].childNodes[0])
            document.getElementById('defect_description_'+row_id).innerHTML = parser.getElementsByTagName("old_description")[0].childNodes[0].nodeValue
         else
            document.getElementById('defect_description_'+row_id).innerHTML = "&nbsp;"
         
         old_update_cell('defect_date_'+row_id, parser.getElementsByTagName("date")[0].childNodes[0].nodeValue)
         old_update_cell('defect_type_'+row_id, parser.getElementsByTagName("type")[0].childNodes[0].nodeValue)
         old_update_cell('defect_inject_phase_'+row_id, parser.getElementsByTagName("inject_phase")[0].childNodes[0].nodeValue)
         if(parser.getElementsByTagName("remove_phase")[0].childNodes[0])
            old_update_cell('defect_remove_phase_'+row_id, parser.getElementsByTagName("remove_phase")[0].childNodes[0].nodeValue)
         else
            old_update_cell('defect_remove_phase_'+row_id, "&nbsp;")
         old_update_cell('defect_fixtime_'+row_id, parser.getElementsByTagName("fixtime")[0].childNodes[0].nodeValue)
         if(parser.getElementsByTagName("fixref")[0].childNodes[0])
            old_update_cell('defect_fixref_'+row_id, parser.getElementsByTagName("fixref")[0].childNodes[0].nodeValue)
         else
            old_update_cell('defect_fixref_'+row_id, "&nbsp;")
         if(parser.getElementsByTagName("description")[0].childNodes[0])
            old_update_cell('defect_description_'+row_id, parser.getElementsByTagName("description")[0].childNodes[0].nodeValue)
         else
            old_update_cell('defect_description_'+row_id, "&nbsp;")
         
         var row = document.getElementById("defect_id_"+row_id)
         var tbl = document.getElementById("table_defect_log")
         for(var x =0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         tbl.rows[x+1].cells[7].innerHTML = "<button onclick='edit_defect("+prog+","+row_id+")'>Edit</button>"
         tbl.rows[x+2].cells[2].innerHTML = "<button onClick='delete_defect("+prog+","+row_id+")'>Delete</button>"
         
         set_disable_all_controls(false)
         document.getElementById("input_date").focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}

function cancel_edits(prog, row_id)
{
   var xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   } 

   set_disable_all_controls(true)

   var url="request_scripts/defect_log_action.php?op=get_row&prog="+prog+"&defectid="+row_id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         var row = document.getElementById("defect_id_"+row_id)
         var tbl = document.getElementById("table_defect_log")
         for(var x =0 ; x < tbl.rows.length ; x++)
            if(tbl.rows[x] == row) break
         row = tbl.rows[x+1]
         row.cells[0].innerHTML = parser.getElementsByTagName("date")[0].childNodes[0].nodeValue
         row.cells[1].innerHTML = parser.getElementsByTagName("number")[0].childNodes[0].nodeValue
         row.cells[2].innerHTML = parser.getElementsByTagName("type")[0].childNodes[0].nodeValue
         row.cells[3].innerHTML = parser.getElementsByTagName("inject_phase")[0].childNodes[0].nodeValue
         if(parser.getElementsByTagName("remove_phase")[0].childNodes[0])
            row.cells[4].innerHTML = parser.getElementsByTagName("remove_phase")[0].childNodes[0].nodeValue
         else
            row.cells[4].innerHTML = "&nbsp;"
         row.cells[5].innerHTML=parser.getElementsByTagName("fixtime")[0].childNodes[0].nodeValue
         if(parser.getElementsByTagName("fixref")[0].childNodes[0])
            row.cells[6].innerHTML=parser.getElementsByTagName("fixref")[0].childNodes[0].nodeValue
         else
            row.cells[6].innerHTML = "&nbsp;"
         row.cells[7].innerHTML="<button onclick='edit_defect("+prog+","+row_id+")'>Edit</button>"
         row = tbl.rows[x+2]
         if(parser.getElementsByTagName('description')[0].childNodes[0])
            row.cells[1].innerHTML = parser.getElementsByTagName("description")[0].childNodes[0].nodeValue
         else
            row.cells[1].innerHTML="&nbsp;"
         row.cells[2].innerHTML="<button onClick='delete_defect("+prog+","+row_id+")'>Delete</button>"

         set_disable_all_controls(false)
         document.getElementById("input_date").focus()
      } 
   };
   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)

}
