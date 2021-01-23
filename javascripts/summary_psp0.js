function set_value(name, program_id, value)
{
   if(!value) value = document.getElementById('input_'+name).value
   set_disable_all_controls(true)
   value = parseInt(value)
   if(isNaN(value))
   {
      document.getElementById('input_'+name).style.backgroundColor = "pink"
      alert("Must be an integer!")
      document.getElementById('input_'+name).style.backgroundColor = ""
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return false
   } 
   var url="request_scripts/summary_request.php?op=set_"+name+"&"+name+"="+value+"&prog="+program_id+"&rand="+Math.random()
   xmlHttp.onreadystatechange=function()
   { 
      if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
      { 
         parser = GetXmlDOMObject(xmlHttp.responseText)

         // update the value modified by user and display message
         if(parser.getElementsByTagName("old_"+name)[0])
            update_value('input_'+name, parser.getElementsByTagName("old_"+name)[0].childNodes[0].nodeValue, parser.getElementsByTagName("old_"+name)[0].childNodes[0].nodeValue)
         else
            update_value('input_'+name, parser.getElementsByTagName(name)[0].childNodes[0].nodeValue)
         display_message(parser)

         update_form(parser)

         // don't try to update size estimating template if the javascript is not loaded
         if(typeof(update_size_est_template_values) != "undefined")
            update_size_est_template_values(parser)

         set_disable_all_controls(false)
         if(parser.getElementsByTagName("focus")[0])
            document.getElementById(parser.getElementsByTagName("focus")[0].childNodes[0].nodeValue).focus()
      } 
   } 

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
   return false
}

function update_form(parser)
{
   // update values sent back by the server
   if(parser.getElementsByTagName("plan_loc_per_hour")[0])
      update_cell('td_plan_loc_per_hour', parser.getElementsByTagName("plan_loc_per_hour")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("plan_total_loc")[0])
      update_cell('td_plan_total_loc', parser.getElementsByTagName("plan_total_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("plan_added")[0])
      update_cell('td_plan_added', parser.getElementsByTagName("plan_added")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("added_loc")[0])
      update_cell('td_added_loc', parser.getElementsByTagName("added_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_reused_loc")[0])
      update_cell('td_to_date_reused_loc', parser.getElementsByTagName("to_date_reused_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("newchg_loc")[0])
      update_cell('td_newchg_loc', parser.getElementsByTagName("newchg_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_newchg_loc")[0])
      update_cell('td_to_date_newchg_loc', parser.getElementsByTagName("to_date_newchg_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("plan_total_loc")[0])
      update_cell('td_plan_total_loc', parser.getElementsByTagName("plan_total_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_total_loc")[0])
      update_cell('td_to_date_total_loc', parser.getElementsByTagName("to_date_total_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("loc_per_hour")[0])
      update_cell('td_loc_per_hour', parser.getElementsByTagName("loc_per_hour")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_loc_per_hour")[0])
      update_cell('td_to_date_loc_per_hour', parser.getElementsByTagName("to_date_loc_per_hour")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("plan_time")[0])
      update_cell('td_plan_time', parser.getElementsByTagName("plan_time")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_plan_time")[0])
      update_cell('td_to_date_plan_time', parser.getElementsByTagName("to_date_plan_time")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("CPI")[0])
      update_cell('td_CPI', parser.getElementsByTagName("CPI")[0].childNodes[0].nodeValue)

   if(parser.getElementsByTagName("percent_plan_new_reuse")[0])
      update_cell('td_percent_plan_new_reuse', parser.getElementsByTagName("percent_plan_new_reuse")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("percent_new_reuse")[0])
      update_cell('td_percent_new_reuse', parser.getElementsByTagName("percent_new_reuse")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_percent_new_reuse")[0])
      update_cell('td_to_date_percent_new_reuse', parser.getElementsByTagName("to_date_percent_new_reuse")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("percent_plan_reused_loc")[0])
      update_cell('td_percent_plan_reused_loc', parser.getElementsByTagName("percent_plan_reused_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("percent_reused_loc")[0])
      update_cell('td_percent_reused_loc', parser.getElementsByTagName("percent_reused_loc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_percent_reused_loc")[0])
      update_cell('td_to_date_percent_reused_loc', parser.getElementsByTagName("to_date_percent_reused_loc")[0].childNodes[0].nodeValue)

   for(x = 0 ; x < parser.getElementsByTagName("plan_phase").length ; x++)
         update_cell('td_plan_'+parser.getElementsByTagName("plan_phase")[x].attributes.getNamedItem("phase").nodeValue, parser.getElementsByTagName("plan_phase")[x].childNodes[0].nodeValue)

   if(parser.getElementsByTagName("plan_test_defects_per_kloc")[0])
      update_cell('td_plan_test_defects_per_kloc', parser.getElementsByTagName("plan_test_defects_per_kloc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("test_defects_per_kloc")[0])
      update_cell('td_test_defects_per_kloc', parser.getElementsByTagName("test_defects_per_kloc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("to_date_test_defects_per_kloc")[0])
      update_cell('td_to_date_test_defects_per_kloc', parser.getElementsByTagName("to_date_test_defects_per_kloc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("plan_total_defects_per_kloc")[0])
      update_cell('td_plan_total_defects_per_kloc', parser.getElementsByTagName("plan_total_defects_per_kloc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("total_defects_per_kloc")[0])
      update_cell('td_total_defects_per_kloc', parser.getElementsByTagName("total_defects_per_kloc")[0].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("total_to_date_defects_per_kloc")[0])
      update_cell('td_total_to_date_defects_per_kloc', parser.getElementsByTagName("total_to_date_defects_per_kloc")[0].childNodes[0].nodeValue)

   for(x = 0 ; x < parser.getElementsByTagName("plan_injected_phase").length ; x++)
         update_cell('td_plan_injected_'+parser.getElementsByTagName("plan_injected_phase")[x].attributes.getNamedItem("phase").nodeValue, parser.getElementsByTagName("plan_injected_phase")[x].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("total_plan_injected")[0])
      update_cell('td_total_plan_injected', parser.getElementsByTagName("total_plan_injected")[0].childNodes[0].nodeValue)

   for(x = 0 ; x < parser.getElementsByTagName("plan_remove_phase").length ; x++)
         update_cell('td_plan_remove_'+parser.getElementsByTagName("plan_remove_phase")[x].attributes.getNamedItem("phase").nodeValue, parser.getElementsByTagName("plan_remove_phase")[x].childNodes[0].nodeValue)
   if(parser.getElementsByTagName("total_plan_remove")[0])
      update_cell('td_total_plan_remove', parser.getElementsByTagName("total_plan_remove")[0].childNodes[0].nodeValue)

   for(x = 0 ; x < parser.getElementsByTagName("plan_defects_per_hour").length ; x++)
         update_cell('td_plan_defects_per_hour_'+parser.getElementsByTagName("plan_defects_per_hour")[x].attributes.getNamedItem("phase").nodeValue, parser.getElementsByTagName("plan_defects_per_hour")[x].childNodes[0].nodeValue)

}


