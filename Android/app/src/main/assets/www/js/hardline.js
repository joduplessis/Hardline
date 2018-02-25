		
		var counter = 0 ;
		var phoneid = "b6c5c02f0681448d";
		var current_open_message = 0 ;
		
		var local = "http://joduplessis.com/store/Avalanche/Hardline/hardline PHP" ;
		var server = "http://joduplessis.com/store/Avalanche/Hardline/hardline PHP" ;
		
		var loc = server ;
		
		function onSettingsReady() {

			$.ajax({url: loc+"/return.php?type=getuser&id="+phoneid}).done(function ( data ) {
				$("#settings-data").html(data) ;
				$('#settings-data').trigger( "create" );
				$("#settings").fadeIn() ; 
			});	
			
		}
		
		function insertSettings() {
			
			var name = $("#setting-name").val() ;
			var contact = $("#setting-contact").val() ;
			var email = $("#setting-email").val() ;
			var company = $("#setting-company").val() ;
			var position = $("#setting-position").val() ;
			
			var query = "?type=setuser" ;
			query += "&name="+name ;
			query += "&contact="+contact ;
			query += "&email="+email ;
			query += "&company="+company ;
			query += "&position="+position ;
			query += "&phoneid="+phoneid ;
			
			$.ajax({url: loc+"/return.php"+query}).done(function ( data ) {
				onSettingsReady() ;
				$("#success").popup("open");
			});	
			
		}
		
		function hidePages() {
			$("#manage").hide() ;
			$("#view").hide() ;
			$("#add").hide() ;
			$("#settings").hide() ;
			$("#help").hide() ;
			$("#button-manage").hide() ;			
			$("#button-home").hide() ;			
		}
		
		function fetchMessages() {
		
			$.ajax({url: loc+"/return.php?type=list&id="+phoneid}).done(function ( data ) {

				$('#list').append(data);
				$('#list').listview("refresh");
				
				$("a#button-message-view").bind( "touchstart click", function(event, ui) { 
					hidePages() ;
					fetchMessage( $(this).attr("sp") )	;
				});	
				
				$("#manage").fadeIn() ; 
				

			});		
			
		}
				
		function fetchMessage(id) {
		
			current_open_message = id ;
		
			$.ajax({url: loc+"/return.php?type=message&id="+id}).done(function ( data ) {
			
				hidePages() ;
				$('#data').html(data);
				$("#view").fadeIn() ; 

			});
			
		}
		
		function addMessage() {
		
			var topic = $("#message-title").val() ;
			var message = $("#message-area").val() ;
			
			var name = $("#setting-name").val() ;
			var contact = $("#setting-contact").val() ;
			var email = $("#setting-email").val() ;
			var company = $("#setting-company").val() ;
			var position = $("#setting-position").val() ;
			
			var query = "?type=add" ;
			query += "&topic="+topic ;
			query += "&message="+message ;
			query += "&name="+name ;
			query += "&contact="+contact ;
			query += "&email="+email ;
			query += "&company="+company ;
			query += "&position="+position ;
			query += "&phoneid="+phoneid ;
			
			$.ajax({url: loc+"/return.php"+query}).done(function ( data ) {
			
				$("#message-title").val("Topic");
				$("#message-area").val("Message");
				data = data.replace(/(^[\s]+|[\s]+$)/g, '');
				$("#success").popup("open");

			});
			
		}
				
		$(document).ready(function() {

			$("html").niceScroll();
			
			hidePages() ;
					
			$("a#comment-send").bind( "touchstart click", function(event, ui) { 
				hidePages() ;
				$.ajax({url: loc+"/return.php?type=comment&comment="+$("#comment-area").val()+"&id="+current_open_message}).done(function ( data ) {
					fetchMessage( current_open_message )	;
					$("#comment-area").val("Comment") ;
				});		
			});	
			
			$("a#button-solve").bind( "touchstart click", function(event, ui) { 
				hidePages() ;
				$.ajax({url: loc+"/return.php?type=delete&id="+current_open_message}).done(function ( data ) {
					$('#list').empty() ;
					fetchMessages()	;
				});		
			});	
			
			$("a#button-settings-save").bind( "touchstart click", function(event, ui) { 
				hidePages() ;
				insertSettings() ;
				onSettingsReady() ;
				$("#settings").fadeIn() ;
			});	
		
			$("a#button-add").bind( "touchstart click", function(event, ui) { 
				hidePages() ;
				$(".appheader h1").text("Add");
				//$("#navbuttons").parent().removeClass("ui-btn-active") ;
				//$(this).removeClass('ui-btn-hover-a').addClass('ui-btn-up-a');
				//$(this).addClass("ui-btn-active") ;
				//$("#hardline").page() ;
				$("#add").fadeIn() ; 
			});	
			
			$("a#button-settings").bind( "touchstart click", function(event, ui) { 
				$(".appheader h1").text("Settings");
				hidePages() ;
				onSettingsReady() ;
				
			});	
			
			$("a#button-help").bind( "touchstart click", function(event, ui) { 
				$(".appheader h1").text("Help");
				hidePages() ;
				$("#help").fadeIn() ; 
			});	
			
			$("a#button-manage").bind( "touchstart click", function(event, ui) { 
				$(".appheader h1").text("Manage");
				hidePages() ;
				$('#list').empty() ; 
				fetchMessages() ;
				$("#button-manage").show() ;
			});	
			
			$("a#button-home").bind( "touchstart click", function(event, ui) { 
				$(".appheader h1").text("Welcome");
				hidePages() ;
			});				
			
			$("a#message-send").bind( "touchstart click", function(event, ui) { 
				addMessage() ; 
			});	
			
		 });
		 
		 
			
		
		