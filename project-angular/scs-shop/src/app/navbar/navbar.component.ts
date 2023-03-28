import { Component } from '@angular/core';
import { AuthService } from '../auth.service';
import { FormBuilder, FormGroup } from '@angular/forms';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent {
  currentUser = {};

  constructor (
    private auth: AuthService,
    private formBuilder: FormBuilder
  ) {};

  loginForm = this.formBuilder.group({
    email: "",
    password: ""
  });

  signupForm = this.formBuilder.group({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    telephone: "",
    streetaddr: "",
    city: "",
    province: "",
    postcode: ""
  });

  onLogin() {
    //console.log(this.form.value);
    this.auth.login(this.loginForm.value.email, this.loginForm.value.password)
      .subscribe((result) => {
        console.log(result);
        this.setCurrentUser(result);
        window.location.reload();
        //document.getElementById('closeLoginModal').click();
      },
      (error) => {
        console.log('login failed')
        document.getElementById('loginErrorMsg').innerHTML = "Login failed! Please check your login credentials";
      });
  }

  onSignup() {
    //validate info here
    const verified = this.verifySignup();
    console.log(verified);

    if (verified['valid']) {
      console.log("proceed");
      this.auth.checkIfExists(this.signupForm.value.email)
        .subscribe((result) => {
          console.log(result);

          if (result.status != "OK") {
            document.getElementById('signupError').innerHTML = result.status;
            console.log(result.status);
          } else {
            this.auth.signup(this.signupForm.value)
              .subscribe((result) => {
                console.log(result);

                if (result.status == "OK") {
                  //document.getElementById('closeSignupModal').click();
                  //document.getElementById('signupError').innerHTML = "Signup successful. Redirecting...";
                  window.location.reload();
                  console.log("signup successful");
                } else {
                  document.getElementById('signupError').innerHTML = "signup error";
                  console.log("signup failed");
                }
              });
          }
        })
      //this.auth.signup(this.signupForm.value);
    } else {
      document.getElementById('signupError').innerHTML = verified['error'];
    }
    //this.auth.signup();
  }

  verifySignup() {
    //console.log(this.signupForm.value);
    var sInfo = this.signupForm.value;

    const LETTERS: RegExp = /[a-z]/i;
    const NUMBERS: RegExp = /[0-9]/;
    const PHONECHECK: RegExp = /^[0-9]{10}$/;
    const POSTCHECK: RegExp = /^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/;

    if (sInfo.password.length < 8) {
      //console.log("at least 8");
      return {'valid': false, 'error': "Password must be at least 8 characters"};
    }

    if (!LETTERS.test(sInfo.password)) {
      //console.log("1 letter");
      return {'valid': false, 'error': "Password must contain at least 1 letter"};
    }

    if (!NUMBERS.test(sInfo.password)) {
      //console.log("1 number");
      return {'valid': false, 'error': "Password must contain at least 1 number"};
    }

    if (sInfo.password != sInfo.password_confirmation) {
      //console.log("Passwords must match");
      return {'valid': false, 'error': "Passwords must match"};
    }

    if (!PHONECHECK.test(sInfo.telephone)) {
      //console.log("Invalid phone number");
      return {'valid': false, 'error': "Invalid phone number"};
    }

    if (!POSTCHECK.test(sInfo.postcode)) {
      //console.log("Invalid postal code");
      return {'valid': false, 'error': "Invalid postal code"};
    }

    return {'valid': true, 'error': ""};
    // check email in auth?
  }

  setCurrentUser(userInfo: Object) {
    sessionStorage.setItem('name', userInfo["UserName"]);
    sessionStorage.setItem('email', userInfo["Email"]);
    sessionStorage.setItem('phone', userInfo["Phone"]);
    sessionStorage.setItem('address', userInfo["UserAddress"]);
    sessionStorage.setItem('postcode', userInfo["CityCode"]);
    sessionStorage.setItem('balance', userInfo["Balance"]);
  }

  clearCurrentUser() {
    // maybe don't do this
    sessionStorage.clear()
    window.location.reload();
  }

  ngOnInit() {
    this.currentUser = {
      "name": sessionStorage.getItem('name'),
      "email": sessionStorage.getItem('email'),
      "phone": sessionStorage.getItem('phone'),
      "address": sessionStorage.getItem('address'),
      "postcode": sessionStorage.getItem('postcode'),
      "balance": sessionStorage.getItem('balance')
    }

    console.log(this.currentUser);
  }
  
  // getUserOnLoad() {
  //   if (window.localStorage.getItem("currentUser")) {
  //     //document.getElementById("cu").innerHTML = window.localStorage.getItem("location")
  //     console.log(window.localStorage.getItem("currentUser"));
  //     return true;
  //   }

  //   return false;
  // }

  // ngOnInit() {
  //   //this.getUserOnLoad();
  //   console.log(this.currentUser);
  // }

}
