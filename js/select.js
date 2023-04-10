const changeLocation = () => {
    var location = document.getElementById('00N5f00000SB1X0').value;
    var recordTypeGroup = document.getElementById('recordTypeGroup');
    var recordMessage = document.getElementById('recordMessage');

    // console.log(location);

    if (location == "Chicago" || location == "National") {

        recordMessage.removeAttribute("hidden", "");
        recordMessage.innerHTML = `En ${location} se le asignara en automatico el tipo de cita que este disponible.`
        recordTypeGroup.setAttribute("hidden", "");

    } else {
        recordMessage.setAttribute("hidden", "");
        recordMessage.innerHTML = ""
        recordTypeGroup.removeAttribute("hidden");
    }

}
