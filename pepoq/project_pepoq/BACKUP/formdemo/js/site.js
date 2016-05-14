/* 未使用 */

/*
function mail_match(Input, Conf, Id){
	if (Input == Conf){
		return true;
	} else {
		
		alert("メールアドレスの入力が一致しません。");
		return false;
	}
}
*/

function set_desc_field_control(TargetRadio, TargetValue, DescArea){
	var AttachedItem;
	$("input[id^='"+TargetRadio+"']").each( function(){
		if ($(this).val() == TargetValue){
			AttachedItem = $(this);
			$(this).on( "click", function( event ) { 
				if ($(this).is(":checked")){
					$("#"+DescArea).show();
				}
			});
		} else {
			$(this).on( "click", function( event ) {
				if ($(this).is(":checked") && has_input(DescArea)==false){
					$("#"+DescArea).hide();
				}
			});
		}
	});

	if (AttachedItem.is(":checked") == false && has_input(DescArea)==false) {
		$("#"+DescArea).hide();
	};
}

function has_input(WrapperId){
	var Result = false;
	$("#"+WrapperId+" input[type='text'], #"+WrapperId+" textarea").each( function(){
		if ($(this).val().length>0){Result = true;}
	});
	$("#"+WrapperId+" input[type='checkbox'], #"+WrapperId+" input[type='radio']").each( function(){
		if ($(this).val().length>0 && $(this).is(":checked")){Result = true;}
	});
	$("#"+WrapperId+" option").each( function(){
		if ($(this).val().length>0 && $(this).is(":selected")){Result = true;}
	});
	return Result;
}


/* GOOGLE ANALYTICS
* ================= */
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-201079-7', 'sugutsukaeru.jp');
ga('send', 'pageview');

