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

    // WEB TO LEAD
    // sendToWebToLead = (oid, leadSource, language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, location, sms);

    // SUMO SCHEDULER APP
    sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, phone);
    // $.ajax({
    //     type: 'POST',
    //     url: 'mail.php',
    //     data: {
    //         "00N5f00000SB1Ws": language,
    //         first_name: firstNamePhp,
    //         last_name: lastNamePhp,
    //         mobile: phonePhp,
    //         email: emailPhp,
    //         message: comment,
    //         "00N5f00000SB1X0": location,
    //         meetingType: phone,
    //     },
    //     dataType: 'text',
    //     success: function (data) {
    //         alert(data);
    //     }
    // });

    // if (document.getElementById("meetingTypePhone").checked) {

    //     const phone = "VID_CONFERENCE";
    //     sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, phone);

    // } else if (document.getElementById("meetingTypePerson").checked) {

    //     const person = "OUR_LOCATION";
    //     sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, person);
    // }

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