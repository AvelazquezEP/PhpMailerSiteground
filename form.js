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
    const sms = document.getElementById("00N5f00000SB1XU").value;
    const phone = "VID_CONFERENCE";
    const person = "OUR_LOCATION";

    sendToPHP(language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, comment, location, phone);

    // #region Ajax para Salesforce

    // if (document.getElementById('gender_Male').checked) {
    //     meetType = "VID_CONFERENCE";
    // } else if (document.getElementById('gender_Female').checked) {
    //     meetType = "OUR_LOCATION";
    // }


    // if (document.getElementById('gender_Male').checked) {
    //     //Male radio button is checked
    // } else if (document.getElementById('gender_Female').checked) {
    //     //Female radio button is checked
    // }

    // $.ajax({
    //     type: 'POST',
    //     url: 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8',
    //     data: {
    //         oid: oid,
    //         lead_source: leadSource,
    //         "00N5f00000SB1Ws": language,
    //         first_name: firstNamePhp,
    //         last_name: lastNamePhp,
    //         mobile: phonePhp,
    //         email: emailPhp,
    //         "00N5f00000SB1X0": location,
    //         "00N5f00000SB1XU": sms,
    //     },
    //     success: function (data) {
    //         sendToPHP(firstNamePhp, lastNamePhp, phonePhp, emailPhp);
    //     }
    // });
    // #endregion

}

const sendToPHP = (languages, name, lastName, phone, mail, comment, place, type) => {

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
        },
        success: function (data) {
            // window.Locatio
            // Simulate a mouse click:
            // window.location.href = "http://www.w3schools.com";

            // Simulate an HTTP redirect:
            window.location.replace("http://google.com");
        }
    });

}