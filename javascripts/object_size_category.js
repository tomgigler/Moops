function load(programid)
{
   if(category_groups)
   {
      document.getElementById('radio_categories').checked = 1
      show_categories_by_type(programid)
   }
   else
   {
      document.getElementById('radio_one').checked = 1
      show_categories_in_one_group(programid)
   }
}

function show_categories_in_one_group(programid)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)

   var url="request_scripts/object_size_category_action.php?op=one_group&programid="+programid+"&rand="+Math.random()

   xmlHttp.onreadystatechange=display_tables;

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function show_categories_by_type(programid)
{
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
      alert ("Browser does not support HTTP Request")
      return
   }

   set_disable_all_controls(true)

   var url="request_scripts/object_size_category_action.php?op=group_by_type&programid="+programid+"&rand="+Math.random()

   xmlHttp.onreadystatechange=display_tables;

   xmlHttp.open("GET",url,true)
   xmlHttp.send(null)
}

function display_tables()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
      parser = GetXmlDOMObject(xmlHttp.responseText)

      var tbl = document.getElementById("object_category_size_table")
      while(tbl.rows.length > 1) tbl.deleteRow(1)

      var table = parser.getElementsByTagName("table")[0]
      for(var x = 0 ; x < table.childNodes.length ; x++)
      {
         if(table.childNodes[x].tagName == "row")
         {
            var row = tbl.insertRow(tbl.rows.length)
            for(var y = 0 ; y < table.childNodes[x].childNodes.length ; y++)
               if(table.childNodes[x].childNodes[y].tagName == "cell")
               {
                  if(table.childNodes[x].childNodes[y].childNodes[0])
                     row.insertCell(row.cells.length).innerHTML = table.childNodes[x].childNodes[y].childNodes[0].nodeValue
                  else
                     row.insertCell(row.cells.length).innerHTML
               }
         }
      }

      tbl = document.getElementById("object_category_size_table_ln")
      while(tbl.rows.length > 1) tbl.deleteRow(1)

      var table = parser.getElementsByTagName("table_ln")[0]
      for(var x = 0 ; x < table.childNodes.length ; x++)
      {
         if(table.childNodes[x].tagName == "row")
         {
            var row = tbl.insertRow(tbl.rows.length)
            for(var y = 0 ; y < table.childNodes[x].childNodes.length ; y++)
               if(table.childNodes[x].childNodes[y].tagName == "cell")
               {
                  if(table.childNodes[x].childNodes[y].childNodes[0])
                     row.insertCell(row.cells.length).innerHTML = table.childNodes[x].childNodes[y].childNodes[0].nodeValue
                  else
                     row.insertCell(row.cells.length).innerHTML
               }
         }
      }

      set_disable_all_controls(false)
   }
}

