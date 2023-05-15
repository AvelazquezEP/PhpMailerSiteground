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
    createLeadApi(firstName, lastName, email, mobilePhone, location, language, sms, comment);
    // sendEmail();
    // createLeadApi();
    // sendToSUMO(language, firstName, lastName, mobilePhone, email, comment, location, meetingType, "Yes");
}

const createLeadApi = (first_name, last_name, email, mobile_phone, location_name, language_site, sms_option, comment) => {
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
            "SMS_Opt_In__c": sms_option,
            "comments": comment
        },
        dataType: 'json',
        success: function (data) {
            var fullUrl = "";
            let leadID = data.id;
            // log(`ID: ${leadID}`);

            let locationCode = getLocation(location_name);
            // log(`Code: ${locationCode}`);

            let inPerson = "OUR_LOCATION";
            let byPhone = "VID_CONFERENCE";
            // let location = location_name;

            // LACode = "a1b5f000000eT4OAAU";
            if (location_name != "National") {
                fullUrl = `https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJCAA2&locationType=${inPerson}&WhatId=a1n5f0000006fzTAAQ&WhereID=${locationCode}&sumoapp_WhoId=0055f000007NE9T&clientId=${leadID}`;
            } else {
                fullUrl = `https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJZAA2&locationType=${byPhone}&WhatId=a1n5f0000006fzTAAQ&WhereID=a1b5f000000enBiAAI&sumoapp_WhoId=0055f000007NE9T&clientId=${leadID}`;
            }


            window.location.href = fullUrl;

        }, error: function (data) {
            window.location.href = "https://ericp138.sg-host.com/thanks.html";
        }
    });
}

// GET LOCATION CODE
const getLocation = (location) => {
    var code = "";
    let LACode = "a1b5f000000eT4OAAU";
    let OCCode = "a1b5f000000eT4PAAU";
    let SDCode = "a1b5f000000eT8bAAE";
    let SMCode = "a1b5f000000eT8gAAE";
    let CHCode = "a1b5f000000enBnAAI";
    let SBCode = "a1b5f000001signAAA";
    // $NCode = ""; TODAVIA NO HAY CODIGO

    switch (location) {
        case "Los Angeles":
            code = LACode;
            break;
        case "Orange County":
            code = OCCode;
            break;
        case "San Diego":
            code = SDCode;
            break;
        case "San Marcos":
            code = SMCode;
            break;
        case "Chicago":
            code = CHCode;
            break;
        case "San Bernardino":
            code = SBCode;
            break;
        case "National":
            code = LACode;
            // $code = strval($NCode);
            break;
        default:
            code = strval(LACode);
            break;
    }

    return code;
}