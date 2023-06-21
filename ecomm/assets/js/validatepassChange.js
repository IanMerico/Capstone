$(document).ready(function () {

    //  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     // Validate Password
      passregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
      $("#error_password").hide();
      let passwordError = true;
      $("#password").keyup(function () {
         validatePassword();
      });
      function validatePassword() {
         let passwordValue = $("#password").val();
         if (passwordValue.length == "") {
            $("#error_password").show();
            $("#error_password").html("Password cannot be empty!");
            passwordError = false;
            return false;
         }
         if (passwordValue.length < 7 || passwordValue.length > 15) {
            $("#error_password").show();
            $("#error_password").html(
            "The length of the password should be between 8 or 15 characters."
            );
            $("#error_password").css("color", "red");
            passwordError = false;
            return false;
   
         } else if (!passregex.test(passwordValue)) {
            $("#error_password").show();
            $("#error_password").html("min 8 characters which contain at least one numeric digit and a special character");
            passwordError = false;
            return false;
   
         } else {
            $("#error_password").hide();
         }
      }
      
      const passwordValuex = document.getElementById("password");
      passwordValuex.addEventListener("blur", () => {
         let passregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
         let s = passwordValuex.value;
         if (passregex.test(s)) {
         passwordValuex.classList.remove("is-invalid");
         passwordValuex.classList.add("is-valid");
         passwordError = true;
         } else {
            passwordValuex.classList.add("is-invalid");
            passwordError = false;
         }
      });


     //  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     // NewPassword Password
      newpassregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
      $("#error_newpassword").hide();
      let NewpasswordError = true;
      $("#newpassword").keyup(function () {
         validateNewPassword();
      });
      function validateNewPassword() {
         let newpasswordValue = $("#newpassword").val();
         if (newpasswordValue.length == "") {
            $("#error_newpassword").show();
            $("#error_newpassword").html("New Password cannot be empty!");
            NewpasswordError = false;
            return false;
         }
         if (newpasswordValue.length < 7 || newpasswordValue.length > 15) {
            $("#error_newpassword").show();
            $("#error_newpassword").html(
            "The length of the password should be between 8 or 15 characters.");
            $("#error_newpassword").css("color", "red");
            NewpasswordError = false;
            return false;
   
         } else if (!newpassregex.test(newpasswordValue)) {
            $("#error_newpassword").show();
            $("#error_newpassword").html("min 8 characters which contain at least one numeric digit and a special character");
            NewpasswordError = false;
            return false;
   
         } else {
            $("#error_newpassword").hide();
         }
      }
      
      const newpasswordValuex = document.getElementById("newpassword");
      newpasswordValuex.addEventListener("blur", () => {
         let newpassregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
         let s = newpasswordValuex.value;
         if (newpassregex.test(s)) {
         newpasswordValuex.classList.remove("is-invalid");
         newpasswordValuex.classList.add("is-valid");
         NewpasswordError = true;
         } else {
            newpasswordValuex.classList.add("is-invalid");
            NewpasswordError = false;
         }
      });

         //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      // Validate Confirm Password
      $("#error_confirm_newpassword").hide();
      let confirmNewPasswordError = true;
      $("#confirm_newpassword").keyup(function () {
         validateConfirmNewPassword();
      });
      function validateConfirmNewPassword() {
         let confirmNewPasswordValue = $("#confirm_newpassword").val();
         let newpasswordValue = $("#newpassword").val();
         if(confirmNewPasswordValue.length == ""){
            $("#error_confirm_newpassword").show();
            $("#error_confirm_newpassword").html("Retype New confirmation password");
            confirmNewPasswordError = false;
            return false;

         } else if (newpasswordValue != confirmNewPasswordValue) {
            $("#error_confirm_newpassword").show();
            $("#error_confirm_newpassword").html("New Password does not match");
            $("#error_confirm_newpassword").css("color", "red");
            confirmNewPasswordError = false;
            return false;
         } else {
            $("#error_confirm_newpassword").hide();
         }
      }

      const confirmNewPasswordValuex = document.getElementById("confirm_newpassword");
      confirmNewPasswordValuex.addEventListener("blur", () => {
         let confirm_newpassregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
         let s = confirmNewPasswordValuex.value;
         if (confirm_newpassregex.test(s)) {
         confirmNewPasswordValuex.classList.remove("is-invalid");
         confirmNewPasswordValuex.classList.add("is-valid");
         confirmNewPasswordError = true;
         } else {
            confirmNewPasswordValuex.classList.add("is-invalid");
            confirmNewPasswordError = false;
         }
      });
   
   
   
      
   $("#updateNewPassword").click(function () {
      validatePassword();
      validateNewPassword();
      validateConfirmNewPassword();
      if (
         emailError == true &&
         passwordError == true &&
         NewpasswordError == true &&
         confirmNewPasswordError == true
      ) {
      return true;
      } else {
         return false;
      }
   });
   
   const passwordInputlog = document.querySelector("#password")
   const eye2 = document.querySelector("#eye2")
   eye2.addEventListener("click", function(){
      this.classList.toggle("fa-eye-slash")
      const type = passwordInputlog.getAttribute("type") === "password" ? "text" : "password"
      passwordInputlog.setAttribute("type", type)

   })
   const newpasswordInputlog = document.querySelector("#newpassword")
   const eye3 = document.querySelector("#eye3")
   eye3.addEventListener("click", function(){
      this.classList.toggle("fa-eye-slash")
      const type = newpasswordInputlog.getAttribute("type") === "password" ? "text" : "password"
      newpasswordInputlog.setAttribute("type", type)
   })
   const confirm_newpasswordInputlog = document.querySelector("#confirm_newpassword")
   const eye4 = document.querySelector("#eye4")
   eye4.addEventListener("click", function(){
      this.classList.toggle("fa-eye-slash")
      const type = confirm_newpasswordInputlog.getAttribute("type") === "password" ? "text" : "password"
      confirm_newpasswordInputlog.setAttribute("type", type)
   })
   
   });