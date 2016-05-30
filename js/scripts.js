$(document).ready(function() {

   //Search Box
   $(".search-box input[type=button]").click(function() {

      qs = "?page=" + querystring("page");

      qs += "&search=" + $(".search-box input[type=text]").val();

      if (querystring("start") != "") {

         qs += "&start=0";

      }

      window.location = qs;

   });

   $(".search-box form").submit(function() {
      $(".search-box input[type=button]").click();
      return false;
   });

   //Next Page
   $(".page_next").click(function() {

      qs = "?page=" + querystring("page");


      if (querystring("search") != "") {

         qs += "&search=" + querystring("search");

      }

      start = Math.floor(querystring("start")) + 20;

      qs += "&start=" + start;

      window.location = qs;

   });

   //Previous Page
   $(".page_prev").click(function() {

      qs = "?page=" + querystring("page");


      if (querystring("search") != "") {

         qs += "&search=" + querystring("search");

      }

      start = Math.floor(querystring("start")) - 20;

      qs += "&start=" + start;

      window.location = qs;


   });

   //Get Querystring
   function querystring(key) {
      var re=new RegExp('(?:\\?|&)'+key+'=(.*?)(?=&|$)','gi');
      var r=[], m;
      while ((m=re.exec(document.location.search)) != null) r.push(m[1]);
      return r;
   }

   //Delete item
   $(".item-delete").click(function() {
      if (confirm("Are you sure you want to delete this?")) {
         return true;
      } else {
         return false;
      }
   });

   //Send update request form
   if ($("select[name='company-list']").length) {
      if (querystring("id") != 0) {
         $(".company-name-visible").css("display", "none");
      }
      $("select[name='company-list']").change(function () {
         if ($(this).val() != 0) {
            $(".company-name-visible").css("display", "none");
         } else {
            $(".company-name-visible").css("display", "block");
         }
      });
   }

   //User form validation
   if ($("input[name='user_password']").length && $("input[name='confirm-password']").length) {
      if ($(".submit-center").length) {
         $(".submit-center").click(function() {

            //Password complexity regex
            pass_regex = /^(?=.*[A-Za-z].*[A-Za-z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9]).{8,}$/
            email_regex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i

            //Clear warnings
            $(".user_warning").remove();

            //Form validation
            if ($("input[name='user_password']").val() != $("input[name='confirm-password']").val()) {
               $("input[name='user_password']").after("<span class=\"user_warning\">Passwords do not match.</span>");
               return false;

            } else if ($("input[name='user_password']").val().trim() != "" && !$("input[name='user_password']").val().match(pass_regex)) {
               $("input[name='user_password']").after("<span class=\"user_warning\">Password is not complex enough.</span>");
               return false;
            } else if (!$("input[name='user_email']").val().match(email_regex)) {
               $("input[name='user_email']").after("<span class=\"user_warning\">Email address is not correct.</span>");
               return false;
            } else if ($("input[name='user_full_name']").val().trim() == "") {
               $("input[name='user_user_full']").after("<span class=\"user_warning\">This is a required field.</span>");
               return false;
            } else if ($("input[name='user_phone']").val().trim() == "") {
               $("input[name='user_phone']").after("<span class=\"user_warning\">This is a required field.</span>");
               return false;
            } else {
               return true;
            }


         });
      }
   }

});
