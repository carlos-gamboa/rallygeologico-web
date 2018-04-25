import { Component, OnInit } from '@angular/core';
import {FacebookService, InitParams, LoginOptions, LoginResponse, AuthResponse} from 'ngx-facebook';
import {Router} from "@angular/router";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  fbId: string;
  firstName: string;
  lastName: string;
  email: string;
  userName: string;
  password: string;
  password2:string;
  confirmation:boolean;
  levelId:string = "no";
  error:string;
  registerWithFacebook:boolean = false;

  constructor(private fb: FacebookService, private router: Router) {
    console.log('Initializing Facebook');
    let initParams: InitParams = {
      appId: '1417631371676772',
      xfbml: true,
      version: 'v2.12'
    };
    fb.init(initParams);
    console.log('Initialized Facebook');


  }

  ngOnInit() {
  }


  /**
   * When userService has a signUpWithFacebook method uncomment this
   */
  /*facebookRegisterService(){
    this.userService.signUpWithFacebook(this.fbId, this.email, this.firstName, this.lastName).then((user: Student) => {
      if (user) {
        this.router.navigate(['/login']);
      }
    });
  }*/

  create_acount(){
    if (this.registerWithFacebook){
      //this.facebookRegisterService();
    }
  }

  /**
   * Checks that the userName is free to use
   */
  freeUsername(){

  }


  isFacebookRegister() {
    return this.registerWithFacebook;
  }

  loginWithOptions() {
    const loginOptions: LoginOptions = {
      enable_profile_selector: true,
      return_scopes: true,
      scope: 'public_profile,email'
    };

    this.fb.login(loginOptions)
      .then((res: LoginResponse) => {
        console.log('Logged in', res);
        this.getProfile();
        this.registerWithFacebook = true;
      })
      .catch(this.handleErrorLogin);
  }

  private handleErrorLogin(error) {
    console.error('Error processing FB login', error);
  }

  /**
   * Obtains the user's information from his facebook profile and stores it.
   */
  getProfile() {
    this.fb.api('me?fields=id,first_name,last_name,email')
      .then((res: any) => {
        console.log('Got the users profile information'+ res);
        this.fbId = res.id;
        this.firstName = res.first_name;
        this.lastName = res.last_name;
        this.email = res.email;
        console.log(this.fbId +" "+this.firstName +" "+ this.lastName +" "+this.email);
        return res;
      })
      .catch(this.handleErrorProfile);
  }

  private handleErrorProfile(error) {
    console.error('Error processing FB profile', error);
  }

  getLoginStatus() {
    this.fb.getLoginStatus()
      .then(console.log.bind(console))
      .catch(console.error.bind(console));
  }


}
