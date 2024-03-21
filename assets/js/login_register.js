function togglePasswordVisibility(inputId, eyeIconId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = document.getElementById(eyeIconId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
$(document).ready(function() {
    $("form").submit(function(event) {
        event.preventDefault(); 
        var errorMessage = document.getElementById("error-message");
        var closeIcon = document.getElementById("close-icon");
        var userName = $("#userName").val();
        var userPassword = $("#userPassword").val();
        var confirmPassword = $("#confirmPassword").val();
        var formAction = $("#form-action").val(); 

        if (formAction === "register") {
            $.ajax({
                type: "POST",
                url: "process_register.php",
                data: {
                    userName: userName,
                    userPassword: userPassword,
                    confirmPassword: confirmPassword
                },
                success: function(response) {
                    if (response === "success") {
                        window.location.href = "login.php";
                    } else {
                        errorMessage.style.display = "inline-block";
                        closeIcon.style.display = "inline-block";
                        $("#error-message").html(response);
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "process_login.php",
                data: {
                    userName: userName,
                    userPassword: userPassword
                },
                success: function(response) {
                    if (response === "admin") {
                        window.location.href = "admin/index.php"; 
                    } else if (response === "user") {
                        window.location.href = "index.php";
                    } else {
                        errorMessage.style.display = "inline-block";
                        closeIcon.style.display = "inline-block";
                        $("#error-message").html(response);
                    }
                }
            });
        }
    });
});
function closeMessage() {
    var errorMessage = document.getElementById("error-message");
    var closeIcon = document.getElementById("close-icon");
    errorMessage.style.display = "none";
    closeIcon.style.display = "none";
}
