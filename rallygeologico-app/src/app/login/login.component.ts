import { Component, OnInit } from '@angular/core';
import {UserService} from "../services/user.service";
import {FacebookService, InitParams, LoginOptions, LoginResponse, AuthResponse} from 'ngx-facebook';
import {User} from "../model/user";
import {Rally} from "../model/rally";
import {Router} from "@angular/router";
import {DataService} from "../services/data/data.service";
import {environment} from "../../environments/environment";

declare var gapi: any;

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
    user : User;
    GId: string;
    GfirstName: string;
    GlastName: string;
    Gemail: string;
    GuserName: string;
    changeUsername : boolean;
    loginWithFacebook:boolean = true;
    loginWithGoogle:boolean = true;

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
  }

  ngAfterViewInit(): void {
    gapi.load('auth2', function() {
      gapi.auth2.init({
        client_id: environment.googleClient,
        fetch_basic_profile: true
      });
    });
  }




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



  googleSignIn() {
    console.log('I am passing signIn');
    var auth2 = gapi.auth2.getAuthInstance();
    var user = auth2.currentUser.get();
    var profile = user.getBasicProfile();
    // Sign the user in, and then retrieve their ID.
    auth2.signIn().then((res: any) => {
      var profile = res.getBasicProfile();
      this.setGoogleVariables(profile.getId(),profile.getGivenName(),profile.getFamilyName(),profile.getImageUrl(),profile.getEmail());
      this.loginWithGoogle = true;
      this.loginWithFacebook = false;
      var count1 = 0;
      this.userService.apiId(this.GId, 1).subscribe((users: User[]) => {
        for (let i: number = 0; i < users.length; ++i) {
          count1 += 1;
        }
        this.isNotRegistered = (count1 == 0);
        if(!this.isNotRegistered){
          this.user=users[0];
          this.pleaseWait = false;
          this.success = true;
          this.userService.auth(this.GId, 1).subscribe((users: User[]) => {
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
    });
      //
  }

  setGoogleVariables(id:string, name:string, lastname:string , img:string , email:string ){
    this.loginWithFacebook = false;
    this.loginWithGoogle = true;
    this.GId = id;
    this.GfirstName = name;
    this.GlastName = lastname;
    this.Gemail = email;
    this.photoUrl = img;
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
