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
            // console.log("Enviado pa");
        }
    });
}