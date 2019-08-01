function formValidate()
{
	var usn = document.forms['form']['username'].value;
	var pwd = document.forms['form']['password'].value;

	if(usn == "" || pwd == "")
	{
		alert("You left something undone");
		return false;
	}
}