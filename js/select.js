const changeLocation = () => {
    var location = document.getElementById('00N5f00000SB1X0').value;
    const meetingTypePhone = document.getElementById('meetingTypePhone');
    const meetingTypePerson = document.getElementById('meetingTypePerson');

    if (location == "San Bernardino") {
        meetingTypePhone.checked = false; //The radioButton (Phone) become false
        meetingTypePerson.checked = true; //The radioButton (Person) become true

        meetingTypePhone.disabled = true; //need to change to disabled
        document.getElementById("personTxt").style.color = 'black'; //Change the text color (label in radiobutton) for the active radiobutton
        document.getElementById("phoneTxt").style.color = 'gray'; //Change the text color (label in radiobutton) for the disable radiobutton

    } else if (location == "National") {
        meetingTypePhone.checked = true; //The radioButton (Phone) become true
        meetingTypePerson.checked = false; //the radioButton (Person) become false

        meetingTypePerson.disabled = true;
        document.getElementById("personTxt").style.color = 'gray'; //Change the text color (label in radiobutton) for the active radiobutton
        document.getElementById("phoneTxt").style.color = 'black';

    } else {
        meetingTypePhone.disabled = false;
        meetingTypePerson.disabled = false;

        document.getElementById("personTxt").style.color = 'black';
        document.getElementById("phoneTxt").style.color = 'black';
    }

}
