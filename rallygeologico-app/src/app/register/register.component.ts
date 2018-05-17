import { Component, OnInit } from '@angular/core';
import {FacebookService, InitParams, LoginOptions, LoginResponse, AuthResponse} from 'ngx-facebook';
import {Router} from "@angular/router";
import {User} from "../model/user";
import {UserService} from "../services/user.service";
import {environment} from "../../environments/environment";

declare var gapi: any;

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
  GId: string;
  GfirstName: string;
  GlastName: string;
  Gemail: string;
  GuserName: string;
  changeUsername : boolean;
  error:string;
  registerWithFacebook:boolean = false;
  registerWithGoogle:boolean = false;
  photoUrl : string ="13241235";
  user : User;
  successful : boolean = false;
  emailUsed : boolean = false;
  pleaseWait : boolean = false;
  googleClientS : string = environment.googleClientS;

  constructor(private fb: FacebookService, private router: Router,  private userService: UserService) {
    console.log('Initializing Facebook');
    let initParams: InitParams = {
      appId: environment.facebookKey,
      xfbml: true,
      version: 'v2.12'
    };
    fb.init(initParams);
    console.log('Initialized Facebook');
    this.changeUsername = false;
    this.userName = "";


  }

  ngAfterViewInit(): void {
    gapi.load('auth2', function() {
      gapi.auth2.init({
        client_id: environment.googleClient,
        fetch_basic_profile: true
      });
    });
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
    });
  }

  setGoogleVariables(id:string, name:string, lastname:string , img:string , email:string ){
    this.registerWithFacebook = false;
    this.registerWithGoogle = true;
    this.GId = id;
    this.GfirstName = name;
    this.GlastName = lastname;
    this.Gemail = email;
    this.photoUrl = img;

  }



  ngOnInit() {
  }

  /**
   * Checks that the userName is free to use
   */
  registerFb() {
    this.pleaseWait = true;
    var count1 = 0;
    this.userService.emailExists(this.email).subscribe((users: boolean) => {
      this.emailUsed = users;
      if (!this.emailUsed) {
        var count2 = 0;
        this.userService.usernameExists(this.userName).subscribe((usersTwo: boolean) => {
          this.changeUsername = usersTwo;
          if (!this.changeUsername) {
            this.userService.register(this.fbId, this.userName, this.firstName, this.lastName, this.email, this.photoUrl, 0).subscribe((users: User[]) => {
              if (users) {
                this.successful = true;
                this.pleaseWait = false;
              }else {
                console.log("Couldn't register");
              }
            });
          }
        });
      }
    });

  }

  registerGoogle() {
    this.pleaseWait = true;
    var count1 = 0;
    this.userService.emailExists(this.email).subscribe((users: boolean) => {
      this.emailUsed = users;
      if (!this.emailUsed) {
        var count2 = 0;
        this.userService.usernameExists(this.userName).subscribe((usersTwo: boolean) => {
          this.changeUsername = usersTwo;
          if (!this.changeUsername) {
            this.userService.register(this.GId, this.userName, this.GfirstName, this.GlastName, this.Gemail, this.photoUrl, 1).subscribe((users: User[]) => {
              if (users) {
                console.log("GOOGLE ID: "+ this.userName);
                this.successful = true;
                this.pleaseWait = false;
              }else {
                console.log("Couldn't register");
              }
            });
          }
        });
      }
    });

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
    this.fb.api('me?fields=id,first_name,last_name,email,picture.width(150).height(150)')
      .then((res: any) => {
        console.log('Got the users profile information'+ res);
        this.fbId = res.id;
        this.firstName = res.first_name;
        this.lastName = res.last_name;
        this.email = res.email;
        this.photoUrl = res.picture.data.url;
        console.log(this.fbId +" "+this.firstName +" "+ this.lastName +" "+this.email);
        this.registerWithFacebook = true;
        this.registerWithGoogle = false;
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
