function checkother(val)
{

	if(val=='Other')
	{
		document.getElementById("otherquestion").style.display='block';
		document.getElementById("otherQuestionLabel").style.display='block';
	}
	else
	{
		document.getElementById("otherquestion").style.display='none';
		document.getElementById("otherQuestionLabel").style.display='none';
	}
}