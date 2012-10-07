function selectMonth() {
	var day = document.getElementById("birthday_day");
	var month = document.getElementById("birthday_month");
	var year = document.getElementById("birthday_year");
	
	var valueDay = day.options[day.selectedIndex].value;
	var valueMonth = month.options[month.selectedIndex].value;
	var valueYear = year.options[year.selectedIndex].value;

	
	switch (parseInt(valueMonth)) {	
	case 1:		
		day.innerHTML = generateOptionDay(31, day.options[1].text);		
		break;
	case 2:

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

function generateOptionDay(n, valueDefault)
{
	var str = '<option value="-1">'+ valueDefault +'</option>';
	for(var i=1; i<=n;i++)
	{
		str += '<option value="'+ i +'">' + i + '</option>';
	}
	return str;
}
