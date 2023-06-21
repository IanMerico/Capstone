   $(document).ready(function () {

      //   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      // Validate Email
      regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
      $("#error_email").hide();
      let emailError = true;
      $("#email").keyup(function () {
         validateEmail();
      });
      function validateEmail() {
         let emailValue = $("#email").val();
         if (emailValue.length == "") {
               $("#error_email").show();
               $("#error_email").html("Email cannot be empty!");
               emailError = false;
               return false;

         } else if (emailValue.length < 3 || emailValue.length > 25) {
               $("#error_email").show();
               $("#error_email").html("Email must be between 3 and 25 characters.");
               emailValue.focus();
               emailError = false;
               return false;

         } else if (!regex.test(emailValue)) {
            $("#error_email").show();
            $("#error_email").html("Invalid email format");
            emailValue.focus();
            emailError = false;
            return false;

         } else {
            $("#error_email").hide();
         }
      }


      const email = document.getElementById("email");
      email.addEventListener("blur", () => {
         let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
         let s = email.value;
         if (regex.test(s)) {
         email.classList.remove("is-invalid");
         email.classList.add("is-valid");
         emailError = true;
         } else {
            email.classList.add("is-invalid");
            emailError = false;
         }
      });

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


      
   $("#btnLogin").click(function () {
      validateEmail();
      validatePassword();
      if (
         emailError == true &&
         passwordError == true
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

   });

   // $(document).ready(function () {

   //     //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   //  // This is for the login page.

   //      // Validate Email
   //      Loginregex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
   //      $("#error_emailLogin").hide();
   //      let emailLoginError = true;
   //      $("#emailLogin").keyup(function () {
   //        validateEmailLogin();
   //      });
   //      function validateEmailLogin() {
   //          let emailLogValue = $("#emailLogin").val();
   //          if (emailLogValue.length == "") {
   //              $("#error_emailLogin").show();
   //              $("#error_emailLogin").html("Email cannot be empty!");
   //              emailLoginError = false;
   //              return false;
   
   //          } else if (emailLogValue.length < 3 || emailLogValue.length > 25) {
   //              $("#error_emailLogin").show();
   //              $("#error_emailLogin").html("Email must be between 3 and 25 characters.");
   //              emailLogValue.focus();
   //              emailLoginError = false;
   //              return false;
   
   //          } else if (!Loginregex.test(emailLogValue)) {
   //           $("#error_emailLogin").show();
   //           $("#error_emailLogin").html("Invalid email format");
   //           emailLogValue.focus();
   //           emailLoginError = false;
   //           return false;
   
   //          } else {
   //           $("#error_emailLogin").hide();
   //         }
   //      }
   
   
   //      const emaillog = document.getElementById("emailLogin");
   //      emaillog.addEventListener("blur", () => {
   //         let logregex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
   //         let s = emaillog.value;
   //         if (logregex.test(s)) {
   //         emaillog.classList.remove("is-invalid");
   //         emaillog.classList.add("is-valid");
   //         emailLoginError = true;
   //         } else {
   //            emaillog.classList.add("is-invalid");
   //            emailLoginError = false;
   //         }
   //      });

   //       //  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   //   // Validate Password
   //   passLogregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
   //   $("#error_passLogin").hide();
   //   let passwordLogError = true;
   //   $("#passwordLogin").keyup(function () {
   //      validateLogPassword();
   //   });
   //   function validateLogPassword() {
   //      let passwordLogValue = $("#passwordLogin").val();
   //      if (passwordLogValue.length == "") {
   //         $("#error_passLogin").show();
   //         $("#error_passLogin").html("Password cannot be empty!");
   //         passwordLogError = false;
   //         return false;
   //      }
   //      if (passwordLogValue.length < 7 || passwordLogValue.length > 15) {
   //         $("#error_passLogin").show();
   //         $("#error_passLogin").html(
   //         "The length of the password should be between 8 or 15 characters."
   //         );
   //         $("#error_passLogin").css("color", "red");
   //         passwordLogError = false;
   //         return false;

   //      } else if (!passLogregex.test(passwordLogValue)) {
   //        $("#error_passLogin").show();
   //        $("#error_passLogin").html("min 8 characters which contain at least one numeric digit and a special character");
   //        passwordLogError = false;
   //        return false;

   //      } else {
   //         $("#error_passLogin").hide();   
   //      }
   //   }
   
   //   const passwordlogValuex = document.getElementById("passwordLogin");
   //   passwordlogValuex.addEventListener("blur", () => {
   //      let passLogregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
   //      let s = passwordlogValuex.value;
   //      if (passLogregex.test(s)) {
   //      passwordlogValuex.classList.remove("is-invalid");
   //      passwordlogValuex.classList.add("is-valid");
   //      passwordError = true;
   //      } else {
   //         passwordlogValuex.classList.add("is-invalid");
   //         passwordError = false;
   //      }
   //   });

   //      //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   //   // Submit button
   //   $("#btnLogin").click(function () {
   //     validateEmailLogin();
   //     validateLogPassword();
   //     if (
   //        emailLoginError == true &&
   //        passwordLogError == true
   //     ) {
   //     return true;
   //     } else {
   //        return false;
   //     }
   //  });

   //  const exampleInputPassword1 = document.querySelector("#passwordLogin")
   //  const eye2 = document.querySelector("#eye2")
   //  eye2.addEventListener("click", function(){
   //     this.classList.toggle("fa-eye-slash")
   //     const type2 = exampleInputPassword1.getAttribute("type") === "password" ? "text" : "password"
   //     exampleInputPassword1.setAttribute("type", type2)
   //   })


   // });