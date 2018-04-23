import { Component, OnInit } from '@angular/core';
import {FacebookService, InitParams, LoginOptions, LoginResponse, AuthResponse} from 'ngx-facebook';

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
  password: string;
  password2:string;
  confirmation:boolean;
  levelId:string = "no";
  levels: Level[];
  error:string;
  registerWithFacebook:boolean = false;

  constructor(private levelService: LevelService, private studentService: UserService, private router: Router, private fb: FacebookService) {
    console.log('Initializing Facebook');
    let initParams: InitParams = {
      appId: '785307394989604',
      xfbml: true,
      version: 'v2.11'
    };
    fb.init(initParams);
    console.log('Initialized Facebook');



    this.levelService.availableLevel().then((levels: Level[]) =>{
      if(levels){
        this.levels = [];
        this.levels = levels;
      }
    });


  }


  ngOnInit() {
  }


  seleted_level(value){
    this.levelId= value;
  }

  facebookRegisterService(){
    this.studentService.signUpWithFacebook(this.fbId, this.email, this.firstName, this.lastName, this.levelId).then((user: Student) => {
      if (user) {
        this.router.navigate(['/login']);
      }
      console.log(user);
    });
  }

  create_acount(){
    if (this.registerWithFacebook){
      this.facebookRegisterService();
    }
    else {
      if (this.firstName && this.lastName && this.email && this.password && this.password2 && this.confirmation && this.levelId != "no") {
        if (this.password.localeCompare(this.password2) == 0) {
          this.error = null;
          this.studentService.signUp(this.email, this.firstName, this.lastName, this.password, this.levelId).then((user: Student) => {
            if (user) {
              this.router.navigate(['/login']);
            }
          });
        } else {
          this.error = "Passwords do not match";
        }
      } else {
        this.error = "Some required inputs are missing";
      }
    }

  }

  match_passwords(){
    if (this.password && this.password2){
      return (this.password.localeCompare(this.password2) == 0);
    } else {
      return true;
    }

  }

  invalid_level(){
    //return (this.levelId=="no"); use this once levels are available

    return false;
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
