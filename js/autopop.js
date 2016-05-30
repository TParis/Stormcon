$(document).ready(function() {

   //List of contact fields

   //Auto-fill in fields
   $(".contact").change(function() {

      field_id = $(this).attr('name').replace("_name", "");

      if ($(this).val() != "") {
         contact_name = $(this).val();

         $.get("ajax.php?action=get-contact-list&contact=" + contact_name, function(data, status) {

               arrData = $.parseJSON(data);

               console.log(arrData);

               if ($("input[name='" + field_id + "_phone']").length) {
                  $("input[name='" + field_id + "_phone']").val(arrData[0]['Contact phone']);
               }
               if ($("input[name='" + field_id + "_email']").length) {
                  $("input[name='" + field_id + "_email']").val(arrData[0]['Email']);
               }
               if ($("input[name='" + field_id + "_title']").length) {
                  $("input[name='" + field_id + "_title']").val(arrData[0]['Title']);
               }
               if ($("select[name='" + field_id + "_company']").length) {
                  $("select[name='" + field_id + "_company']").val(arrData[0]['Company']);
               }
               if ($("input[name='" + field_id + "_fax']").length) {
                  $("input[name='" + field_id + "_fax']").val(arrData[0]['Fax Number']);
               }

         });
      } else {
               if ($("input[name='" + field_id + "_phone']").length) {
                  $("input[name='" + field_id + "_phone']").val("");
               }
               if ($("input[name='" + field_id + "_email']").length) {
                  $("input[name='" + field_id + "_email']").val("");
               }
               if ($("input[name='" + field_id + "_title']").length) {
                  $("input[name='" + field_id + "_title']").val("");
               }
               if ($("select[name='" + field_id + "_company']").length) {
                  $("select[name='" + field_id + "_company']").val("");
               }
               if ($("input[name='" + field_id + "_fax']").length) {
                  $("input[name='" + field_id + "_fax']").val("");
               }
      }
   });

   $(".soil").change(function() {

      field_id = $(this).attr('name').substr(0, $(this).attr('name').lastIndexOf("_"));

      $.get("ajax.php?action=get-soil-data&soil=" + $(this).val(), function(data, status) {
         arrData = $.parseJSON(data);
         console.log(arrData);
         $("input[name='" + field_id + "_hsg']").val(arrData[0]["Soil hydrologic Group"]);
         $("input[name='" + field_id + "_k']").val(arrData[0]["K factor"]);
      });
   });

   $(".company").change(function() {

      field_id = $(this).attr('name').substr(0, $(this).attr('name').lastIndexOf("_"));

      $.get("ajax.php?action=get-company-list&company=" + $(this).val(), function(data, status) {
         arrData = $.parseJSON(data);
         console.log(arrData);

         if ($("select[name='" + field_id + "'").length) {

            obj = $("select[name='" + field_id + "'")

            obj.find('option').remove();
            obj.append('<option value=\"\">Select One</option>');

            $.each(arrData,function(key, value)
            {
                obj.append('<option value=\"' + value['Name'] + '\">' + value['Name'] + '</option>');
            });
         }

      });


   });

   $(".contacts-name").change(function() {

      $field_id = $(this).attr('name').split(" ");

      $.get("ajax.php?action=get-contact-list&contact=" + $(this).val(), function(data, status) {
         arrData = $.parseJSON(data);
         console.log(arrData);
         if ($field_id[0] != "inspector") {
            $("input[name='Contact phone " + $field_id[1] + "']").val(arrData[0]["Contact phone"]);
            $("input[name='Contact email " + $field_id[1] + "']").val(arrData[0]["Email"]);
            $("input[name='contact fax " + $field_id[1] + "']").val(arrData[0]["Fax Number"]);
         }
      });


   });

   //Populate lists
   $.get("ajax.php?action=get-soil-list", function(data, status) {
      arrData = $.parseJSON(data);
      console.log(arrData);


      $(".soil").each(function() {
         elem = $(this);

         $.each(arrData,function(key, value) {
            if (elem.attr("value") == value['Soil name']) {
               elem.append('<option value=\"' + value['Soil name'] + '\" SELECTED>' + value['Soil name'] + '</option>');
            } else {
               elem.append('<option value=\"' + value['Soil name'] + '\">' + value['Soil name'] + '</option>');
            }
         });
      });
   });

   $.get("ajax.php?action=get-contact-list", function(data, status) {

      arrData = $.parseJSON(data);
      console.log(arrData);

      $(".contact").each(function() {

         elem = $(this);

         $.each(arrData,function(key, value) {
            if (elem.attr("value") == value['Name']) {
               elem.append('<option value=\"' + value['Name'] + '\" SELECTED>' + value['Name'] + '</option>');
            } else {
               elem.append('<option value=\"' + value['Name'] + '\">' + value['Name'] + '</option>');
            }
         });
      });
   });

   $.get("ajax.php?action=get-company-list", function(data, status) {

      arrData = $.parseJSON(data);
      console.log(arrData);

      $(".company").each(function() {

         elem = $(this);

         $.each(arrData,function(key, value) {
            if (elem.attr("value") == value['Company name']) {
               elem.append('<option value=\"' + value['Company name'] + '\" SELECTED>' + value['Company name'] + '</option>');
            } else {
               elem.append('<option value=\"' + value['Company name'] + '\">' + value['Company name'] + '</option>');
            }
         });
      });
   });
});
