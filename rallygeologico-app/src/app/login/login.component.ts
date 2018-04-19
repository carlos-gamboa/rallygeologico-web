import { Component, OnInit } from '@angular/core';
import {FacebookService, InitParams, LoginOptions, LoginResponse, AuthResponse} from 'ngx-facebook';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  username:string;
  password:string;
  error:string;
  fbId: string;
  firstName: string;
  lastName: string;
  email: string;
  fbToken: string;
  loginWithFacebook:boolean=false;



  constructor(private fb: FacebookService){
    console.log('Initializing Facebook');
    let initParams: InitParams = {
      appId: '785307394989604',
      xfbml: true,
      version: 'v2.11'
    };
    fb.init(initParams);
    console.log('Initialized Facebook');

    /*this.studentService.isLoggedIn().then((user: Student) => {
     this.userDataService.updateStudent(user);
     this.router.navigate(['/dashboard']);
     })*/
  }
  onLogin(){
    if (this.username && this.password){
      this.studentService.login(this.username,this.password).then((user: boolean)=>{
        this.error = null;
        if(user)
          this.studentService.isLoggedIn().then((user: Student) => {
            this.userDataService.updateStudent(user);
            if (user.passwordNeedsChange){
              this.router.navigate(['/change/' + user.id]);
            } else {
              this.router.navigate(['/dashboard']);
            }
          })
      }).catch( reason => {
        this.error = "The email or password are incorrect";
      });
    } else {
      this.error = "Some required inputs are missing";
    }
  }

  //Login if the Enter Key is pressed
  @HostListener('window:keyup', ['$event'])
  keyEvent(event: KeyboardEvent) {
    if (event.keyCode === 13) {
      if (this.username && this.password){
        this.onLogin();
      }
    }
  }



  loginWithOptions() {
    const loginOptions: LoginOptions = {
      enable_profile_selector: true,
      return_scopes: true,
      scope: 'public_profile,email'
    };

    this.fb.login(loginOptions)
      .then((res: LoginResponse) => {
        this.loginWithFacebook = true;
        console.log('Logged in', res);
        this.fb.api('me?fields=id,first_name,last_name,email')
          .then((res: any) => {
            console.log('Got the users profile information'+ res);
            this.fbId = res.id;
            this.firstName = res.first_name;
            this.lastName = res.last_name;
            this.email = res.email;
            this.fbToken = this.fb.getAuthResponse().accessToken;
            console.log("Login got : "+this.fbId +" "+this.firstName +" "+ this.lastName +" "+this.email+" "+this.fbToken);
            this.fbLogin();
          })
          .catch(this.handleErrorProfile);
      })
      .catch(this.handleErrorLogin);
  }


  fbLogin(){
    this.studentService.loginWithFacebook(this.fbId,this.fbToken).then((authentication: boolean)=>{
      this.error = null;
      if(authentication){
        this.studentService.isLoggedIn().then((user: Student) => {
          this.userDataService.updateStudent(user);
          this.router.navigate(['/dashboard']);
        })
      }

    }).catch( reason => {
      this.error = "Unable to login with Facebook.";
    });
  }

  private handleErrorLogin(error) {
    console.error('Error processing FB login', error);
  }

  /**
   * Obtains the user's information from his facebook profile and stores it.
   */
  getProfile() {

  }

  private handleErrorProfile(error) {
    console.error('Error processing FB profile', error);
  }

  getLoginStatus() {
    this.fb.getLoginStatus()
      .then(console.log.bind(console))
      .catch(console.error.bind(console));
  }

  ngOnInit() {
  }

}
