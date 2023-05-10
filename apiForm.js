// CONSOLE LOG SHORT
var log = console.log;

const sendData = () => {
    let firstName = document.getElementById("first_name").value;
    let lastName = document.getElementById("last_name").value;
    let email = document.getElementById("email").value;
    let mobilePhone = document.getElementById("mobile").value;
    let location = document.getElementById("00N5f00000SB1X0").value;
    let language = document.getElementById("00N5f00000SB1Ws").value;
    // let smsOption = document.getElementById("00N5f00000SB1XU").value;
    let meetingType = document.getElementById("meetingTypePerson").value;
    let comment = document.getElementById("message").value;
    let sms = document.getElementById("00N5f00000SB1XU").value;


    // createLead(oid, leadSource, language, firstNamePhp, lastNamePhp, phonePhp, emailPhp, location, "Yes");
    // getLead(emailPhp);
    createLeadApi(firstName, lastName, email, mobilePhone, location, language, sms);
    // createLeadApi();
    // sendToSUMO(language, firstName, lastName, mobilePhone, email, comment, location, meetingType, "Yes");
}

const createLeadApi = (first_name, last_name, email, mobile_phone, location_name, language_site, sms_option) => {
    // let urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/sobjects/Lead';
    $.ajax({
        type: 'POST',
        url: 'apiData.php',
        data: {
            "FirstName": first_name,
            "LastName": last_name,
            "Email": email,
            "LeadSource": "EP-CA-Website",
            "MobilePhone": mobile_phone,
            "Location__c": location_name,
            "Language__c": language_site,
            "SMS_Opt_In__c": sms_option
        },
        dataType: 'json',
        success: function (data) {
            let leadID = data.id;
            log(`ID: ${leadID}`);
            log(`ID: ${data.success}`);

            let locationType = "OUR_LOCATION";
            let location = location_name;

            LACode = "a1b5f000000eT4OAAU";

            var fullUrl = `https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJCAA2&locationType=${locationType}&WhatId=a1n5f0000006fzTAAQ&WhereID=${LACode}&sumoapp_WhoId=0055f000007NE9T&clientId=${leadID}`;

            // $(location).prop('href', fullUrl);
            window.location.href = fullUrl;

        }, error: function (data) {
            log("Log ERROR:");
            log(`Response: ${data.responseText}`);
            // let info = "info";
            // $(location).prop('href', `http://stackoverflow.com/${info}`)
            // location.href("https://www.google.com");
        }
    });
}