$(document).ready(function() {

	//List of contact fields
	$.each(data, function(index) {
		obj = $(this);
		sel = "";
		el = "";
		
		$.each($(this)[0], function(index) {
			if (index != "constraints" && index != "table_name") {
				sel	=	obj[0][index]
				el	=	index
				return false;
			}
		});
		
		//Change
		$("select[name='" + el + "']").change({sel: sel, el: el, obj: obj},function(event) {
				setFields($("select[name='" + event.data.el + "'").val(), event.data.sel, event.data.el, event.data.obj)
		});
		
		populateDropDowns(obj, el, sel);
		
	});
	
	function populateDropDowns(obj, el, sel) {
		
		if (typeof obj[0]['constraints'] != 'undefined') {
			$.each(obj[0]['constraints'], function(index) {
				input  = obj[0]['constraints'][index];
				var mytype = typeof input;
				if (mytype == "string") {
					if ($("select[name='" + input + "']").val() != "") {
						obj[0]['constraints'][index] = $("select[name='" + input + "']").val();
					} else {
						obj[0]['constraints'][index] = $("select[name='" + input + "']").attr("value");
					}
				}
			});
		}
		
		$.post("ajax.php?action=populate_dropdown",
			{
				table_name: obj[0]['table_name'],
				constraints: (typeof obj[0]['constraints'] != 'undefined') ? JSON.stringify(obj[0]['constraints']) : 'none',			
				column: sel,
				field: el,
			},
			function(data, status) {
				if (data.indexOf("Fatal") < 0) {
					items = JSON.parse(data);
					
					el	=	$("select[name='" + items[0] + "']");
					el.find('option').remove();
        		    el.append('<option value=\"\">Select One</option>');
					
					$.each(items[1], function(index) {
						if ($(this)[0][0] != null) {
							if (el.attr("value") == $(this)[0][0]) {
								el.append('<option value="' + escapeHtml($(this)[0][0]) + '" SELECTED>' + escapeHtml($(this)[0][0]) + '</option>');
							} else {
								el.append('<option value="' + escapeHtml($(this)[0][0]) + '">' + escapeHtml($(this)[0][0]) + '</option>');
							}
						}
					});
				}
			}
		);
	}
	
	function setFields(value, sel, el, obj) {
		$.ajax({
				url: "ajax.php?action=populate_dropdown",
				context: obj,
				method: "POST",
				data: {
					table_name: obj[0]['table_name'],
					constraints: "{\"" + sel + "\":\"" + value + "\"}",			
					column: '*',
					field: el,
				},
				cache: false,
			})
			.done(function(data, status) {
				items = JSON.parse(data);
				obj = $(this);
				$.each($(this)[0], function(index) {
					if (index != "constraints" && index != "table_name" && index != el) {
						arrIndex = obj[0][index];
						if (typeof arrIndex != "object") {
							arrIndex = arrIndex.replace("[", "").replace("]","")
							item_data = items[1][0][arrIndex]
							$("[name='" + index + "']").val(item_data);
						} else {
							el = index
							sel = arrIndex[el]
							populateDropDowns({0: arrIndex}, el, sel);							
						}
					}
				});
			});
	};
	
	function escapeHtml(text) {
	  var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	  };
	
	  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
	}

});
