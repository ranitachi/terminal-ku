<?PHP
<script type="text/javascript">
function myTrim(x){ return x.replace(/^\s+|\s+$/gm,''); }
function SbmtFrmContact()
{
	var ctr = 0;
	var msg = '';
	var un = myTrim($('#un').val());
	var pw = myTrim($('#pw').val());
	if( un == '' )
	{
		$('#un').tooltip({title: "Make sure you entry username", placement: "top"});
		$('#un').tooltip("show");
		$('#un').css('border-color', '#d9534f');
		ctr++;
	}
	else {$('#un').tooltip("destroy"); $('#un').css('border-color', '#ededed');}
	if( pw == '' )
	{
		$('#pw').tooltip({title: "Make sure you entry password", placement: "top"});
		$('#pw').tooltip("show");
		$('#pw').css('border-color', '#d9534f');
		ctr++;
	}
	else {$('#pw').tooltip("destroy"); $('#pw').css('border-color', '#ededed');}
	if( ctr == 0 )
	{
		var urlString = document.getElementById("main-login-form").action;
		var dataString = 'un=' + un + '&pw=' + pw;
		 /*Process submit*/
		$.ajax({
			url: urlString,
			data: dataString,
			type: "post",
			dataType: 'json',
			success: function (res)
			{
				if (res.status == 0 && res.errfield.length > 0)
				{
					for(var i=0; i<res.errfield.length; i++)
					{
						/*Show tooltips of error*/
						$('#' + res.errfield[i]).tooltip({title: res.errmsg[i], placement: "top"});
						$('#' + res.errfield[i]).tooltip("show");
						$('#' + res.errfield[i]).css('border-color', '#d9534f');
					}
				}
				else if (res.status == 1)
				{
					var errfield = ["un", "pw"];
					for(var i=0; i<errfield.length; i++)
					{
						/*Destroy tooltips of error*/
						$('#' + errfield[i]).tooltip("destroy");
						$('#' + errfield[i]).css('border-color', '#ededed');
					}
					/*Clear form*/
					document.getElementById("main-login-form").reset();
					/*Show success message*/
					$("#msgsuccess").css('color', '#2DCC70');
					$("#msgsuccess").text('Login success. You are redirecting to main page...');
					setTimeout(function(){
					   window.location.reload(1);
					}, 5000);
				}
			}
		});
	}
}
</script>