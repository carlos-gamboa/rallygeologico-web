import {Component, NgZone, OnInit} from '@angular/core';
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
    username: string;
    password: string;

    GId: string;
    GfirstName: string;
    GlastName: string;
    Gemail: string;
    GuserName: string;

    error:string;

    registerWithFacebook:boolean = false;
    registerWithGoogle:boolean = false;
    registerWithPassword:boolean = true;

    showMessage: boolean;
    messageType: number;
    alertMessage: string;

    photoUrl : string = environment.assetsUrl + "assets/user-icon.png";
    user : User;
    successful : boolean = false;
    googleClientS : string = environment.googleClientS;

    facebookText: string;
    googleText: string;
    facebookWorking: boolean = environment.facebookWorking;
    googleWorking: boolean = environment.googleWorking;

    emailUsed: boolean = false;

    assetsUrl: string;

    constructor(private fb: FacebookService, private router: Router,  private userService: UserService, private _ngZone: NgZone) {
        this.assetsUrl = environment.assetsUrl;
        if (this.facebookWorking){
            let initParams: InitParams = {
                appId: environment.facebookKey,
                xfbml: true,
                version: 'v2.12'
            };
            fb.init(initParams);
            this.facebookText = "Registrarse con Facebook";
        } else {
            this.facebookText = "Pronto con Facebook";
        }
        if (this.googleWorking){
            gapi.load('auth2', function() {
                gapi.auth2.init({
                    client_id: environment.googleClient,
                    fetch_basic_profile: true
                });
            });
            this.googleText =  "Registrarse con Google";
        } else {
            this.googleText = "Pronto con Google";
        }
        this.username = "";
        this.showMessage = false;
    }

    googleSignIn() {
        if (this.googleWorking){
            this.registerWithPassword = false;
            console.log('I am passing signIn');
            var auth2 = gapi.auth2.getAuthInstance();
            var user = auth2.currentUser.get();
            var profile = user.getBasicProfile();
            // Sign the user in, and then retrieve their ID.
            setTimeout(() =>
                {
                    this._ngZone.run(
                        () => auth2.signIn().then((res: any) => {
                            var profile = res.getBasicProfile();
                            this.setGoogleVariables(profile.getId(),profile.getGivenName(),profile.getFamilyName(),profile.getImageUrl(),profile.getEmail());
                        })
                    );
                },
                1000);
            this._ngZone.run(
                () => auth2.signIn().then((res: any) => {
                    var profile = res.getBasicProfile();
                    this.setGoogleVariables(profile.getId(),profile.getGivenName(),profile.getFamilyName(),profile.getImageUrl(),profile.getEmail());
                })
            );
        }
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
        if (this.facebookWorking) {
            this.showMessage = true;
            this.messageType = 2;
            this.alertMessage = "Por favor espere.";
            this.userService.emailExists(this.email).subscribe((emailUsed: boolean) => {
                this.emailUsed = emailUsed;
                if (!emailUsed) {
                    this.userService.usernameExists(this.username).subscribe((usernameTaken: boolean) => {
                        if (!usernameTaken) {
                            this.userService.register(this.fbId, this.username, this.firstName, this.lastName, this.email, this.photoUrl, 0, null, 1).subscribe((users: User[]) => {
                                if (users) {
                                    this.successful = true;
                                    this.messageType = 0;
                                    this.alertMessage = "Se ha registrado con éxito.";
                                } else {
                                    this.messageType = 1;
                                    this.alertMessage = "Hubo un error, no se ha podido registrar.";
                                }
                            });
                        } else {
                            this.messageType = 1;
                            this.alertMessage = "El nombre de usuario no está disponible.";
                        }
                    });
                } else {
                    this.messageType = 1;
                    this.alertMessage = "El email escogido ya se encuentra asociado a una cuenta.";
                }
            });
        }
    }

    registerGoogle() {
        if (this.googleWorking) {
            this.showMessage = true;
            this.messageType = 2;
            this.alertMessage = "Por favor espere.";
            this.userService.emailExists(this.Gemail).subscribe((emailUsed: boolean) => {
                this.emailUsed = emailUsed;
                if (!emailUsed) {
                    this.userService.usernameExists(this.username).subscribe((usernameTaken: boolean) => {
                        if (!usernameTaken) {
                            this.userService.register(this.GId, this.username, this.GfirstName, this.GlastName, this.Gemail, this.photoUrl, 1, null, 1).subscribe((users: User[]) => {
                                if (users) {
                                    this.successful = true;
                                    this.messageType = 0;
                                    this.alertMessage = "Se ha registrado con éxito.";
                                } else {
                                    this.messageType = 1;
                                    this.alertMessage = "Hubo un error, no se ha podido registrar.";
                                }
                            });
                        } else {
                            this.messageType = 1;
                            this.alertMessage = "El nombre de usuario no está disponible.";
                        }
                    });
                } else {
                    this.messageType = 1;
                    this.alertMessage = "El email escogido ya se encuentra asociado a una cuenta.";
                }
            });
        }
    }

    isFacebookRegister() {
        return this.registerWithFacebook;
    }

    loginWithOptions() {
        if (environment.facebookWorking) {
            this.registerWithPassword = false;
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

    passwordRegister(){
        this.showMessage = true;
        this.messageType = 2;
        this.alertMessage = "Por favor espere.";
        this.userService.emailExists(this.email).subscribe((emailUsed: boolean) => {
            this.emailUsed = emailUsed;
            if (!emailUsed) {
                this.userService.usernameExists(this.username).subscribe((usernameTaken: boolean) => {
                    if (!usernameTaken) {
                        this.userService.register(this.fbId, this.username, this.firstName, this.lastName, this.email, this.photoUrl, 3, this.password, 1).subscribe((users: User[]) => {
                            if (users) {
                                this.successful = true;
                                this.messageType = 0;
                                this.alertMessage = "Se ha registrado con éxito.";
                            } else {
                                this.messageType = 1;
                                this.alertMessage = "Hubo un error, no se ha podido registrar.";
                            }
                        });
                    } else {
                        this.messageType = 1;
                        this.alertMessage = "El nombre de usuario no está disponible.";
                    }
                });
            } else {
                this.messageType = 1;
                this.alertMessage = "El email escogido ya se encuentra asociado a una cuenta.";
            }
        });
    }

}
