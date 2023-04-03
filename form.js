const sendData = () => {
    const firstNamePhp = document.getElementById("first_name").value;
    const lastNamePhp = document.getElementById("last_name").value;
    const emailPhp = document.getElementById("email").value;
    const phonePhp = document.getElementById("mobile").value;
    const messagePhp = document.getElementById("message").value;

    $.ajax({
        type: 'POST',
        // the next line can change for directory url.
        url: 'https://ericp138.sg-host.com/mail.php',
        data: {
            firstName: firstNamePhp,
            lastName: lastNamePhp,
            phone: phonePhp,
            email: emailPhp,
            message: messagePhp,
        },
        success: function () {
        }
    });
}

// const startScheduler = () => {
//     const firstNamePhp = document.getElementById("first_name").value;
//     const lastNamePhp = document.getElementById("last_name").value;
//     const emailPhp = document.getElementById("email").value;
//     const phonePhp = document.getElementById("mobile").value;

//     // const returnInput = document.getElementById('returnValue');
//     const urlScheduler = 'https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&sumoapp_WhoId=0055f000007NttK&clientId=00Q5f00000P5ms2EAB' + '&a2=' + firstNamePhp + '&a3=' + lastNamePhp + '&a5=' + emailPhp + '&a6=' + phonePhp;
//     // returnInput.value = urlScheduler;

//     location.href = 'https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&sumoapp_WhoId=0055f000007NttK&clientId=00Q5f00000P5ms2EAB' + '&a2=' + firstNamePhp + '&a3=' + lastNamePhp + '&a5=' + emailPhp + '&a6=' + phonePhp;
// }