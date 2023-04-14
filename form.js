const sendData = () => {

    const oid = document.getElementById("oid").value;
    const language = document.getElementById("00N5f00000SB1Ws").value;
    const leadSource = document.getElementById("lead_source").value;
    const firstNamePhp = document.getElementById("first_name").value;
    const lastNamePhp = document.getElementById("last_name").value;
    const emailPhp = document.getElementById("email").value;
    const phonePhp = document.getElementById("mobile").value;
    const location = document.getElementById("00N5f00000SB1X0").value;
    const comment = document.getElementById("message").value;
    const smsYes = document.getElementById("smsAgree").value;
    const smsNO = document.getElementById("smsDisagree").value;
    const sms = document.getElementById("00N5f00000SB1XU").value;
    const phone = "VID_CONFERENCE";
    const person = "OUR_LOCATION";

    // FORMDATA
    const formData = new FormData();

    formData.append("username", "Groucho");
    formData.append("accountnum", 123456); // number 123456 is immediately converted to a string "123456"

    // HTML file input, chosen by user
    formData.append("userfile", fileInputElement.files[0]);

    // JavaScript file-like object
    const content = '<q id="a"><span id="b">hey!</span></q>'; // the body of the new file…
    const blob = new Blob([content], { type: "text/xml" });

    formData.append("webmasterfile", blob);

    const request = new XMLHttpRequest();
    request.open("POST", "http://foo.com/submitform.php");
    request.send(formData);


    // SUMO SCHEDULER APP
    sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, phone);
}

const sendToPHP = (languages, name, lastName, phone, mail, comment, place, type) => {

    $.ajax({
        type: 'POST',
        url: 'https://ericp138.sg-host.com/mail.php',
        data: {
            "00N5f00000SB1Ws": languages,
            first_name: name,
            last_name: lastName,
            mobile: phone,
            email: mail,
            message: comment,
            "00N5f00000SB1X0": place,
            meetingType: type,
        },
        dataType: 'text',
        success: function (data) {
            alert(data);
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