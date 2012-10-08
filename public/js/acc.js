function selectYear(){
	var day = document.getElementById("birthday_day");
	var month = document.getElementById("birthday_month");
	var year = document.getElementById("birthday_year");

	if (month.selectedIndex != 2)
		return;
	
	if (year.selectedIndex == 0){		
		changeOptionDay(day, 29);
	}else{
		var valueYear = parseInt(year.options[year.selectedIndex].value);						
		if ((valueYear % 4 == 0 && valueYear % 100 != 0) || valueYear % 400 == 0){			
			changeOptionDay(day, 29);
		}else{
			changeOptionDay(day, 28);
		}
	}
	
}
function selectMonth() {
	var day = document.getElementById("birthday_day");
	var month = document.getElementById("birthday_month");
	var year = document.getElementById("birthday_year");	
	
	var valueMonth = month.options[month.selectedIndex].value;	

	switch (parseInt(valueMonth)) {
	case 1:
		changeOptionDay(day, 31);
		break;
	case 2:
		if (year.selectedIndex == 0){
			changeOptionDay(day, 29);
		}else{
			var valueYear = parseInt(year.options[year.selectedIndex].value);
			if (valueYear % 4 == 0 && valueYear % 100 != 0){
				changeOptionDay(day, 29);
			}else{
				changeOptionDay(day, 28);
			}
		}
		break;
	case 3:
		changeOptionDay(day, 31);
		break;
	case 4:
		changeOptionDay(day, 30);
		break;
	case 5:
		changeOptionDay(day, 31);
		break;
	case 6:
		changeOptionDay(day, 30);
		break;
	case 7:
		changeOptionDay(day, 31);
		break;
	case 8:
		changeOptionDay(day, 31);
		break;
	case 9:
		changeOptionDay(day, 30);
		break;
	case 10:
		changeOptionDay(day, 31);
		break;
	case 11:
		changeOptionDay(day, 30);
		break;
	case 12:
		changeOptionDay(day, 31);
		break;
	default:
		changeOptionDay(day, 31);
		break;
	}
}

function changeOptionDay(day, n) {
	var indexDay = day.selectedIndex;
	if (indexDay > n){
		day.options[0].selected = true;
	}
	
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

}
