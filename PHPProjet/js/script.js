function ajoutCoq() {
	if(document.getElementById('ajoutCoq').hasClass('active'))
	{
		$(this).fadeIn();
		$(this).removeClass('active');
	}
	else
	{
		$(this).fadeOut();
		$(this).addClass('active');
	}
}