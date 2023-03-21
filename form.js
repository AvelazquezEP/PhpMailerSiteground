const sendData = () => {
    const firstNamePhp = document.getElementById("first_name").value;
    const lastNamePhp = document.getElementById("last_name").value;
    const emailPhp = document.getElementById("email").value;
    const phonePhp = document.getElementById("mobile").value;
    const messagePhp = document.getElementById("message").value;

    $.ajax({
        type: 'POST',
        url: 'mail.php',
        data: {
            firstName: firstNamePhp,
            lastName: lastNamePhp,
            phone: phonePhp,
            email: emailPhp,
            message: messagePhp,

        },
        success: function () {
            console.log("Enviado pa");
        }
    });
}

// #region GetInput Onclick

const getFirstName = () => {
    const first_name = document.getElementById("first_name").value;
    document.getElementById("first_namePhp").value = first_name;
}

const getLastName = () => {
    const last_name = document.getElementById("last_name").value;
    document.getElementById("last_namePhp").value = last_name;
}

const getEmail = () => {
    const email = document.getElementById("email").value;
    document.getElementById("emailPhp").value = email;
}

const getNumber = () => {
    const mobile = document.getElementById("mobile").value;
    document.getElementById("mobilePhp").value = mobile;
}

const getQuestion = () => {
    const message = document.getElementById("message").value;
    document.getElementById("messagePhp").value = message;
}

// #endregion GetInput onClick

// 