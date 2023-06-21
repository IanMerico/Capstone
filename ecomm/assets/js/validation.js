
   // Document is ready
   $(document).ready(function () {
      // Validate First name
      $("#error_name").hide();
      let firstnameError = true;
      $("#name").keyup(function () {
         validateUsername();
      });
      function validateUsername() {
         let firstnameValue = $("#name").val();
         if (firstnameValue.length == "") {
            $("#error_name").show();  
            $("#error_name").html("First name cannot be empty!");
            //  firstnameValue.classList.remove("is-invalid");
            firstnameError = false;
            return false;
         } else if (firstnameValue.length < 3 || firstnameValue.length > 25) {
            $("#error_name").show();
            $("#error_name").html("First name must be between 3 and 25 characters.");
            firstnameError = false;
            return false;
         } else if (parseInt(firstnameValue)) {
            $("#error_name").show();
            $("#error_name").html("First name contains letters only");
            firstnameError = false;
            return false;

         } else {
            $("#error_name").hide();
         }
      }

      const firstnameValuex = document.getElementById("name");
      firstnameValuex.addEventListener("blur", () => {
      let regFName  = /^[a-zA-Z ]{2,30}$/;
      let s = firstnameValuex.value;
      if (regFName.test(s)) {
            firstnameValuex.classList.remove("is-invalid");
            firstnameValuex.classList.add("is-valid");
            firstnameError = true;
         } else {
            firstnameValuex.classList.add("is-invalid");
            firstnameError = false;
         }
   });

      // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      // Validate Last Name
      $("#error_lname").hide();
      let lastnameError = true;
      $("#lname").keyup(function () {
         validatelastname();
      });
      function validatelastname() {
         let lastnameValue = $("#lname").val();
         if (lastnameValue.length == "") {
               $("#error_lname").show();
               $("#error_lname").html("Last name cannot be empty!");
               lastnameError = false;
               return false;

         } else if (lastnameValue.length < 3 || lastnameValue.length > 25) {
               $("#error_lname").show();
               $("#error_lname").html("Last name must be between 3 and 25 characters.");
               lastnameValue.focus();
               lastnameError = false;
               return false;

         } else if (parseInt(lastnameValue)) {
            $("#error_lname").show();
            $("#error_lname").html("Last name contain letters only");
            lastnameValue.focus();
            lastnameError = false;
            return false;

         } else {
            $("#error_lname").hide();
         }
      }

               
      const lastnameValuex = document.getElementById("lname");
      lastnameValuex.addEventListener("blur", () => {
      let regName  = /^[a-zA-Z ]{2,30}$/;
      let s = lastnameValuex.value;
      if (regName.test(s)) {
            lastnameValuex.classList.remove("is-invalid");
            lastnameValuex.classList.add("is-valid");
            lastnameError = true;
         } else {
            lastnameValuex.classList.add("is-invalid");
            lastnameError = false;
         }
   });
      
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

      //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      // Validate Confirm Password
      $("#error_confirm_password").hide();
      let confirmPasswordError = true;
      $("#confirm_password").keyup(function () {
         validateConfirmPassword();
      });
      function validateConfirmPassword() {
         let confirmPasswordValue = $("#confirm_password").val();
         let passwordValue = $("#password").val();
         if(confirmPasswordValue.length == ""){
            $("#error_confirm_password").show();
            $("#error_confirm_password").html("Retype confirmation password");
            confirmPasswordError = false;
            return false;

         } else if (passwordValue != confirmPasswordValue) {
            $("#error_confirm_password").show();
            $("#error_confirm_password").html("Password does not match");
            $("#error_confirm_password").css("color", "red");
            confirmPasswordError = false;
            return false;
         } else {
            $("#error_confirm_password").hide();
         }
      }

      const confirmPasswordValuex = document.getElementById("confirm_password");
      confirmPasswordValuex.addEventListener("blur", () => {
         let confirm_passregex = /^(?=.*\d)(?=.*[a-z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,15}$/;
         let s = confirmPasswordValuex.value;
         if (confirm_passregex.test(s)) {
         confirmPasswordValuex.classList.remove("is-invalid");
         confirmPasswordValuex.classList.add("is-valid");
         confirmPasswordError = true;
         } else {
            confirmPasswordValuex.classList.add("is-invalid");
            confirmPasswordError = false;
         }
      });

      //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

      
      $("#submitbtn").click(function () {  
         var sexSelected = $("#sex");
         if(sexSelected.val() === "") {
            document.getElementById("error_gender").innerHTML="Please select option!";
         } else {
            document.getElementById("error_gender").innerHTML="";
            document.getElementById("error_gender").style.color="green";
         }

      });

      $("#submitbtn").click(function () {  
         var datenotSelected = $("#example");
         if(datenotSelected.val() === "") {
            document.getElementById("error_date").innerHTML="Date required";
         } else {
            document.getElementById("error_date").innerHTML="";
            document.getElementById("error_date").style.color="green";
         }

      });

         //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


         // Validate address
         $("#errorAddress").hide();
               let addressError = true;
         $("#street_address").keyup(function () {
               validateAddress();
         });
         function validateAddress() {
            let addressValue = $("#street_address").val();
            if (addressValue.length =="") {
               $("#errorAddress").show();  
               $("#errorAddress").html("Address cannot be empty!");
               addressError = false;
               return false;
            } else if (addressValue.length < 10 || addressValue.length > 50) {
               $("#errorAddress").show();
               $("#errorAddress").html("Address must be between 10 and 50 characters.");
               //   addressValue.focus();
               addressError = false;
               return false;
            } else {
               $("#errorAddress").hide();
            }
         }

         const street_addressValuex = document.getElementById("street_address");
         street_addressValuex.addEventListener("blur", () => {
            let Addressregex = /^(?=(\s*[a-zA-Z\d]){10,50}$).*$/;
            let s = street_addressValuex.value;
            if (Addressregex.test(s)) {
            street_addressValuex.classList.remove("is-invalid");
            street_addressValuex.classList.add("is-valid");
            addressError = true;
            } else {
               street_addressValuex.classList.add("is-invalid");
               addressError = false;
            }
         });

      //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

         // baranggay address
         $("#error_brgy").hide();
               let barangayError = true;
         $("#barangay").keyup(function () {
               validatebarangay();
         });
         function validatebarangay() {
            let barangayValue = $("#barangay").val();
            if (barangayValue.length == "") {
               $("#error_brgy").show();  
               $("#error_brgy").html("Barangay cannot be empty!");
               barangayError = false;
               return false;
            } else if (barangayValue.length < 10 || barangayValue.length > 100) {
               $("#error_brgy").show();
               $("#error_brgy").html("Barangay must be between 10 and 100 characters.");
               //   barangayValue.focus();
               barangayError = false;
               return false;
            } else {
               $("#error_brgy").hide();
            }
         }

         const barangayValuex = document.getElementById("barangay");
         barangayValuex.addEventListener("blur", () => {
            let barangayregex = /^(?=(\s*[a-zA-Z\d]){10,50}$).*$/;
            let s = barangayValuex.value;
            if (barangayregex.test(s)) {
            barangayValuex.classList.remove("is-invalid");
            barangayValuex.classList.add("is-valid");
            addressError = true;
            } else {
               barangayValuex.classList.add("is-invalid");
               addressError = false;
            }
         });


         //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
         //   Validate province
         $("#submitbtn").click(function () {  
            var datenotSelected = $("#province");
            if(datenotSelected.val() === "") {
               document.getElementById("errorProvince").innerHTML="Selecet province!";
            } else {
               document.getElementById("errorProvince").innerHTML="";
               document.getElementById("errorProvince").style.color="green";
            }
      
         });

         //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // Validate city address
            $("#city_Error").hide();
            let cityError = true;
            $("#city").keyup(function () {
               validatecity();
            });
         function validatecity() {
            let cityValue = $("#city").val();
            if (cityValue.length =="") {
               $("#city_Error").show();  
               $("#city_Error").html("City cannot be empty!");
               cityError = false;
               // return false;
            } else if (cityValue.length < 10 || cityValue.length > 50) {
               $("#city_Error").show();
               $("#city_Error").html("5 and 50 characters city.");
               cityValue.focus();
               cityError = false;
               return false;
            } else {
               $("#city_Error").hide();
            }
         }

         const cityex = document.getElementById("city");
         cityex.addEventListener("blur", () => {
            let cityexregex = /^(?=(\s*[a-zA-Z\d]){5,50}$).*$/;
            let s = cityex.value;
            if (cityexregex.test(s)) {
            cityex.classList.remove("is-invalid");
            cityex.classList.add("is-valid");
            cityError = true;
            } else {
               cityex.classList.add("is-invalid");
               cityError = false;
            }
         });

         //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            // Validate Zip Code
            $("#zipcodeError").hide();
            let zipcodeError = true;
            $("#zipcode").keyup(function () {
               validatezipcode();
            });
         function validatezipcode() {
            let zipcodeValue = $("#zipcode").val();
            if (zipcodeValue.length =="") {
               $("#zipcodeError").show();  
               $("#zipcodeError").html("Zip code empty!");
               zipcodeValue.focus();
               zipcodeError = false;
               return false;
            } else if (zipcodeValue.length < 3|| zipcodeValue.length > 6) {
               $("#zipcodeError").show();
               $("#zipcodeError").html("4 or 6 characters.");
               zipcodeValue.focus();
               zipcodeError = false;
               return false;
            } else {
               $("#zipcodeError").hide();
            }
         }

         const zipcodeValue = document.getElementById("zipcode");
         zipcodeValue.addEventListener("blur", () => {
            let zipcodexregex = /(^\d{4}$)/;
            let ss = zipcodeValue.value;
            if (zipcodexregex.test(ss)) {
            zipcodeValue.classList.remove("is-invalid");
            zipcodeValue.classList.add("is-valid");
            zipcodeError = true;
            } else {
               zipcodeValue.classList.add("is-invalid");
               zipcodeError = false;
            }
         });
            

         //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
         
         // Validate Phone number
         phoneregex = /((\+[0-9]{2})|0)[.\- ]?9[0-9]{2}[.\- ]?[0-9]{3}[.\- ]?[0-9]{4}/;
         $("#phoneError").hide();
         let phoneError = true;
         $("#phone").keyup(function () {
            validatephone();
         });
      function validatephone() {
         let zipcodeValue = $("#phone").val();
         if (zipcodeValue.length =="") {
            $("#phoneError").show();  
            $("#phoneError").html("Phone number cannot be empty");
            // zipcodeValue.focus();
            phoneError = false;
            return false;
         } else if (zipcodeValue.length < 0 || zipcodeValue.length > 20) {
            $("#phoneError").show();
            $("#phoneError").html("Enter valid phone number (+63)");
            zipcodeValue.focus();
            phoneError = false;
            return false;
         }  else if(!phoneregex.test(zipcodeValue)) {
               $("#phoneError").show();
               $("#phoneError").html("Alphabet are not allowed, Numbers only.");
               zipcodeValue.focus();
               phoneError = false;
               return false;
         }else {
            $("#phoneError").hide();
         }
      }

      const phoneValue = document.getElementById("phone");
      phoneValue.addEventListener("blur", () => {
         let phoneregex = /((\+[0-9]{2})|0)[.\- ]?9[0-9]{2}[.\- ]?[0-9]{3}[.\- ]?[0-9]{4}/;
         let ss = phoneValue.value;
         if (phoneregex.test(ss)) {
         phoneValue.classList.remove("is-invalid");
         phoneValue.classList.add("is-valid");
         phoneError = true;
         } else {
            phoneValue.classList.add("is-invalid");
            phoneError = false;
         }
      });


      //  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      // Submit button
      $("#submitbtn").click(function () {
         validateUsername();
         validatelastname();
         validatePassword();
         validateConfirmPassword();
         validateEmail();
         validateSex();
         validateAddress();
         validatebarangay();
         validatecity();
         validatezipcode();
         validatephone();
         if (
         firstnameError == true &&
         lastnameError == true &&
         passwordError == true &&
         confirmPasswordError == true &&
         emailError == true  &&
         genderError == true &&
         addressError == true &&
         barangayError == true &&
         cityError == true &&
         zipcodeError == true &&
         phoneError == true
         ) {
         return true;
         } else {
            return false;
         }
      });

         // Submit button


      //  This function show the password and the confirmation password in register.php
      const passwordInput = document.querySelector("#password")
      const eye = document.querySelector("#eye")
      eye.addEventListener("click", function(){
         this.classList.toggle("fa-eye-slash")
         const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
         passwordInput.setAttribute("type", type)
      })
      const confirm_passwordInput = document.querySelector("#confirm_password")
      const eye1 = document.querySelector("#eye1")
      eye1.addEventListener("click", function(){
         this.classList.toggle("fa-eye-slash")
         const type1 = confirm_passwordInput.getAttribute("type") === "password" ? "text" : "password"
         confirm_passwordInput.setAttribute("type", type1)
      })

   });





   // function validate()
   // {
   //  var error="";
   //  var name = document.getElementById( "name" );
   //  var lname = document.getElementById( "lname" );
   //  var email = document.getElementById( "email" );
   //  var password = document.getElementById( "password" );

   //  if( name.value == "" )
   //  {
   //   error = " You Have To Write Your FIrst Name. ";
   //   document.getElementById( "error_name" ).innerHTML = error;
   //   name.focus();
   //   return false;
   //  }

   //  if( lname.value == "" )
   //  {
   //   error = " You Have To Write Your Last Name. ";
   //   document.getElementById( "error_lname" ).innerHTML = error;
   //   lname.focus();
   //   return false;
   //  }


   //  if( email.value == "" || email.value.indexOf( "@" ) == -1 )
   //  {
   //   error = " You Have To Write Valid Email Address. ";
   //   document.getElementById( "error_email" ).innerHTML = error;
   //   email.focus();
   //   return false;
   //  }

   
   //  if( password.value == "" || password.value >= 8 )
   //  {
   //   error = " Password Must Be More Than Or Equal To 8 Digits. ";
   //   document.getElementById( "error_password" ).innerHTML = error;
   //   password.focus();
   
   //   return false;
   //  }

   //  else
   //  {
   //   return true;
   //  }
   // }

   // // $(document).ready(function(){
   //     const nameEL = document.querySelector('#name');
   //     const lnameEL = document.querySelector('#lname');
   //     const emailEL = document.querySelector('#email');
   //     const passwordEL = document.querySelector('#password');
   //     const confirm_passwordEL = document.querySelector('#confirm_password');
   //     // const sexEL = document.querySelector('#sex');
   //     const form = document.querySelector('#signup');
      


   //     const checkName = () => {

   //         let valid = false;
      
   //         const min = 3,
   //             max = 25;
      
   //         const name = nameEL.value.trim();
      
   //         if (!isRequired(name)) {
   //             showError(nameEL, 'First name cannot be blank.');
   //         } else if (!isBetween(name.length, min, max)) {
   //             showError(nameEL, `First name must be between ${min} and ${max} characters.`)
   //         } else {
   //             showSuccess(nameEL);
   //             valid = true;
   //         }
   //         return valid;
   //     };

   //     const checklname = () => {

   //         let valid = false;
      
   //         const min = 3,
   //             max = 25;
      
   //         const lname = lnameEL.value.trim();
      
   //         if (!isRequired(lname)) {
   //             showError(lnameEL, 'Last name cannot be blank.');
   //         } else if (!isBetween(lname.length, min, max)) {
   //             showError(lnameEL, `Last name must be between ${min} and ${max} characters.`)
   //         } else {
   //             showSuccess(lnameEL);
   //             valid = true;
   //         }
   //         return valid;
   //     };

   //     const checkEmail = () => {
   //         let valid = false;
   //         const email = emailEL.value.trim();
   //         if (!isRequired(email)) {
   //             showError(emailEL, 'Email cannot be blank.');
   //         } else if (!isEmailValid(email)) {
   //             showError(emailEL, 'Email is not valid.')
   //         } else {
   //             showSuccess(emailEL);
   //             valid = true;
   //         }
   //         return valid;
   //     };

   //     const checkPassword = () => {
   //         let valid = false;
      
      
   //         const password = passwordEL.value.trim();
      
   //         if (!isRequired(password)) {
   //             showError(passwordEL, 'Password cannot be blank.');
   //         } else if (!isPasswordSecure(password)) {
   //             showError(passwordEL, 'Password must has at least 8 characters that include at least 1 lowercase character, 1 uppercase characters, 1 number, and 1 special character in (!@#$%^&*)');
   //         } else {
   //             showSuccess(passwordEL);
   //             valid = true;
   //         }
      
   //         return valid;
   //     };

   //     const checkConfirmPassword = () => {
   //         let valid = false;
   //         // check confirm password
   //         const confirm_password = confirm_passwordEL.value.trim();
   //         const password = confirm_passwordEL.value.trim();
      
   //         if (!isRequired(confirm_password)) {
   //             showError(confirm_passwordEL, 'Please enter the password again');
   //         } else if (password !== confirm_password) {
   //             showError(confirm_passwordEL, 'The password does not match');
   //         } else {
   //             showSuccess(confirm_passwordEL);
   //             valid = true;
   //         }
      
   //         return valid;
   //     };

   //     // const checksexEL = () => {

   //     //     let valid = false;
         
   //     //     const sex = sexEL.value.trim();
      
   //     //     if (isRequired(sex)) {
   //     //         showError(sexEL, 'Required');
   //     //     }else if(sex ==='') {
   //     //         showSuccess(sexEL,);
   //     //          valid = true;
   //     //     }
   //     //     return valid;
   //     // };

   //     const isEmailValid = (email) => {
   //         const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   //         return re.test(email);
   //     };

   //     const isPasswordSecure = (password) => {
   //         const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
   //         return re.test(password);
   //     };

   //     const isRequired = value => value === '' ? false : true;

   //     const isBetween = (length, min, max) => length < min || length > max ? false : true;



   //     const showError = (input, message) => {
   //         // get the form-field element
   //         const formField = input.parentElement;
   //         // add the error class
   //         formField.classList.remove('success');
   //         formField.classList.add('error');
      
   //         // show the error message
   //         const error = formField.querySelector('small');
   //         error.textContent = message;
   //     };

   //     const showSuccess = (input) => {
   //         // get the form-field element
   //         const formField = input.parentElement;
      
   //         // remove the error class
   //         formField.classList.remove('error');
   //         formField.classList.add('success');
      
   //         // hide the error message
   //         const error = formField.querySelector('small');
   //         error.textContent = '';
   //     };


   //     form.addEventListener('submit', function (e) {
   //         // prevent the form from submitting
   //         e.preventDefault();

   //         // validate fields
   //         let isCheckNameValid  = checkName(),
   //             isCheckLnameValid = checklname(),
   //             isEmailValid = checkEmail(),
   //             isPasswordValid  = checkPassword(),
   //             isConfirmPasswordValid = checkConfirmPassword();
   //             // isSexValid = checksexEL();


               

   //         let isFormValid = isCheckNameValid &&
   //             isCheckLnameValid && 
   //             isEmailValid && 
   //             isPasswordValid && 
   //             isConfirmPasswordValid;
   //             // isSexValid;

   //         // submit to the server if the form is valid
   //         if (isFormValid) {

   //             form.submit();
               
   //         }
         
   //     });



         
   //         const debounce = (fn, delay = 500) => {
   //             let timeoutId;
   //             return (...args) => {
   //                 // cancel the previous timer
   //                 if (timeoutId) {
   //                     clearTimeout(timeoutId);
   //                 }
   //                 // setup a new timer
   //                 timeoutId = setTimeout(() => {
   //                     fn.apply(null, args)
   //                 }, delay);
   //             };
   //         };

   //         form.addEventListener('input', debounce(function (e) {
   //             switch (e.target.id) {
   //                 case 'name':
   //                     checkName();
   //                     break;
   //                 case 'lname':
   //                     checklname();
   //                     break;
   //                 case 'email':
   //                     checkEmail();
   //                     break;
   //                 case 'password':
   //                     checkPassword();
   //                     break;
   //                 case 'confirm_password':
   //                     checkConfirmPassword();
   //                     break;
   //                 // case 'sex':
   //                 //     checksexEL();
   //                 // break;
   //             }
   //         }));

      
   //     // });
   // //     // alert("Alert Me");

   // //     // $('.name').blur(function (e){
   // //     //     e.preventDefault();

   // //     //     var name = $('.name').val();
   // //     //     if($.trim(name).length == 0)
   // //     //     {
   // //     //         name_err = "Name is empty";
   // //     //         $('#name_err').text(name_err);
   // //     //     }else {
   // //     //         name_err = "";
   // //     //         $('#name_err').text(name_err);
   // //     //     }
   // //     // });

