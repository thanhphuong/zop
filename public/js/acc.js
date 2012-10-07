function selectMonth() {
	var day = document.getElementById("birthday_day");
	var month = document.getElementById("birthday_month");
	var year = document.getElementById("birthday_year");

	// var valueDay = day.options[day.selectedIndex].value;
	var valueMonth = month.options[month.selectedIndex].value;
	// var valueYear = year.options[year.selectedIndex].value;

	switch (parseInt(valueMonth)) {
	case 1:
		changeOptionDay(day, 31);
		break;
	case 2:
		changeOptionDay(day, 29);
		break;
	case 3:

		break;
	case 4:

		break;
	case 5:

		break;
	case 6:

		break;
	case 7:

		break;
	case 8:

		break;
	case 9:

		break;
	case 10:

		break;
	case 11:

		break;
	case 12:

		break;
	default:
		break;
	}
}

function changeOptionDay(day, n) {
	var length = day.length;
	if (length == n + 1)
		return;

	if (length < n + 1) {
		var addOption = n + 1 - length;
		for ( var i = 0; i < addOption; i++) {
			try {
				day.add(new Option(length + i, length + i), null); 
			} catch (e) { // in IE, try the below version instead of add()
				day.add(new Option(length + i, length + i));
			}
		}
	} else {
		var removeOption = length - (n + 1);		
		for ( var i = 0; i < removeOption; i++) {			
			day.remove(length - 1 - i);			
		}
	}
	
//	if (myselect.options[i].selected==true){
//		  alert("Selected Option's index: "+i)
//		  break
//		 }

}
