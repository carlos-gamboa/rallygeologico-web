import { Component, OnInit } from '@angular/core';
import {UserService} from "../services/user.service";
import {FacebookService, InitParams, LoginOptions, LoginResponse, AuthResponse} from 'ngx-facebook';
import {User} from "../model/user";
import {Rally} from "../model/rally";
import {Router} from "@angular/router";
import {DataService} from "../services/data/data.service";
import {environment} from "../../environments/environment";

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
    user : User;
    photoUrl : string;
    isNotRegistered: boolean = false;
    success : boolean = false;
    pleaseWait = false;


  constructor(private fb: FacebookService, private userService: UserService, private router: Router, private userDataService:DataService){
    console.log('Initializing Facebook');
    let initParams: InitParams = {
      appId: environment.facebookKey,
      xfbml: true,
      version: 'v2.12'
    };
    fb.init(initParams);
    console.log('Initialized Facebook');



    /*this.studentService.isLoggedIn().then((user: Student) => {
     this.userDataService.updateStudent(user);
     this.router.navigate(['/dashboard']);
     })*/
  }

  //Login if the Enter Key is pressed
/*  @HostListener('window:keyup', ['$event'])
  keyEvent(event: KeyboardEvent) {
    if (event.keyCode === 13) {
      if (this.username && this.password){
        this.onLogin();
      }
    }
  }*/



  loginWithOptions() {
    const loginOptions: LoginOptions = {
      enable_profile_selector: true,
      return_scopes: true,
      scope: 'public_profile,email'
    };
    this.fb.login(loginOptions)
      .then((res: LoginResponse) => {
        this.pleaseWait = true;
        this.loginWithFacebook = true;
        console.log('Logged in', res);
        this.fb.api('me?fields=id,first_name,last_name,email,picture.width(150).height(150)')
          .then((res: any) => {
            console.log('Got the users profile information'+ res);
            this.fbId = res.id;
            this.firstName = res.first_name;
            this.lastName = res.last_name;
            this.email = res.email;
            this.fbToken = this.fb.getAuthResponse().accessToken;
            this.photoUrl = res.picture.data.url;
            console.log("Login got : "+this.fbId +" "+this.firstName +" "+ this.lastName +" "+this.email+" "+this.fbToken);
            var count1 = 0;
            this.userService.apiId(res.id, 0).subscribe((users: User[]) => {
              for (let i: number = 0; i < users.length; ++i) {
                count1 += 1;
              }
              this.isNotRegistered = (count1 == 0);
              if(!this.isNotRegistered){
                this.user=users[0];
                this.userDataService.updateUser(this.user);
                this.pleaseWait = false;
                this.success = true;
                this.userService.auth(res.id, 0).subscribe((users: User[]) => {
                    console.log(users[0]);
                    this.userDataService.updateUser(users[0]);
                  console.log("Completed auth");
                  setTimeout(() =>
                    {
                      this.router.navigate(['/dashboard']);
                    },
                    1000);
                });
              }
              this.pleaseWait = false;
            });
          })
          .catch(this.handleErrorProfile);
      })
      .catch(this.handleErrorLogin);
  }


  // fbLoginService(){
  //   this.userService.login(this.fbId,this.fbToken).then((authentication: boolean)=>{
  //     this.error = null;
  //     if(authentication){
  //       this.studentService.isLoggedIn().then((user: Student) => {
  //         this.userDataService.updateStudent(user);
  //         this.router.navigate(['/dashboard']);
  //       })
  //     }
  //     else{
  //       this.router.navigate(['/register']);
  //     }
  //
  //   }).catch( reason => {
  //     this.error = "Unable to login with Facebook.";
  //   });
  // }

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

  getUsers(){
      // this.userService.login(this.fbId).subscribe((userArr: User[])=>{
      //         this.user.push(userArr[0]);
      //     console.log("USUARIO ES" + this.user);
      // });
  }

}
