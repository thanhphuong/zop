var toggle = 'on';
function menuPullDown() {	
	var menu = document.getElementById('navAccount');
	if (toggle == 'off') {
		menu.classList.remove('openToggler');
		toggle = 'on';
	} else {
		menu.classList.add('openToggler');
		toggle = 'off';
	}
}