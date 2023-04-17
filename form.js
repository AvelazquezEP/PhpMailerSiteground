const sendData = () => {

    // const oid = document.getElementById("oid").value;
    // const leadSource = document.getElementById("lead_source").value;
    const language = document.getElementById("00N5f00000SB1Ws").value;
    const firstNamePhp = document.getElementById("first_name").value;
    const lastNamePhp = document.getElementById("last_name").value;
    const emailPhp = document.getElementById("email").value;
    const phonePhp = document.getElementById("mobile").value;
    const location = document.getElementById("00N5f00000SB1X0").value;
    const comment = document.getElementById("message").value;

    // SMS options (radioButton)
    const disagreeSms = document.getElementById("disagreeSms");
    const agreSms = document.getElementById("agreeSms");


    const phone = "VID_CONFERENCE";
    const person = "OUR_LOCATION";

    if (disagreeSms.checked == true) {
        if (location == "National") {
            sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, phone, "No");
        } else {
            sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, person, "No");
        }
    } else {
        if (location == "National") {
            sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, phone, "Yes");
        } else {
            sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, person, "Yes");
        }
    }

    // SUMO SCHEDULER APP

    // if (location == "National") {
    //     sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, phone, sms);
    // } else {
    //     sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, person, sms);
    // }
}

const sendToPHP = (languages, name, lastName, phone, mail, comment, place, type, smsA) => {

    $.ajax({
        type: 'POST',
        url: 'mail.php',
        data: {
            "00N5f00000SB1Ws": languages,
            first_name: name,
            last_name: lastName,
            mobile: phone,
            email: mail,
            message: comment,
            "00N5f00000SB1X0": place,
            meetingType: type,
            "00N5f00000SB1XU": smsA,
        },
        dataType: 'text',
        success: function (data) {
            window.location.replace(data);
        }
    });

}

// Este esta bien
const sendToWebToLead = (oid, leadSource, language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, location, sms) => {

    $.ajax({
        type: 'POST',
        url: 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8',
        data: {
            oid: oid,
            lead_source: leadSource,
            "00N5f00000SB1Ws": language,
            first_name: firstNamePhp,
            last_name: lastNamePhp,
            mobile: phonePhp,
            email: emailPhp,
            "00N5f00000SB1X0": location,
            "00N5f00000SB1XU": sms,
        },
        // success: function (data) {
        //     sendToPHP(firstNamePhp, lastNamePhp, phonePhp, emailPhp);
        // }
    });

}

// #region HTTPS REQUEST

 // Primer request
    // const formElement = document.querySelector("form");
    // var http = new XMLHttpRequest();
    // var url = 'get_data.php';
    // var params = 'orem=ipsum&name=binny';
    // http.open('POST', url, true);

    //Send the proper header information along with the request
    // http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // http.onreadystatechange = function () {//Call a function when the state changes.
    //     if (http.readyState == 4 && http.status == 200) {
    //         alert(http.responseText);
    //     }
    // }
    // http.send(params);


// Second Request
    // var params = new Object();
    // params.myparam1 = myval1;
    // params.myparam2 = myval2;

    // // Turn the data object into an array of URL-encoded key/value pairs.
    // let urlEncodedData = "", urlEncodedDataPairs = [], name;
    // for (name in params) {
    //     urlEncodedDataPairs.push(encodeURIComponent(name) + '=' + encodeURIComponent(params[name]));
    // }



// #endrregion HTTPS REQUEST