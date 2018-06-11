import {Component, NgZone, OnInit} from '@angular/core';
import {UserService} from "../../services/user.service";
import {FacebookService, InitParams, LoginOptions, LoginResponse, AuthResponse} from 'ngx-facebook';
import {User} from "../../model/user";
import {Rally} from "../../model/rally";
import {Router} from "@angular/router";
import {DataService} from "../../services/data/data.service";
import {environment} from "../../../environments/environment";

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

    loginWithFacebook:boolean = true;
    loginWithPassword:boolean = true;
    loginWithGoogle:boolean = true;

    photoUrl : string;
    isNotRegistered: boolean = false;
    messageType: number;
    showMessage: boolean;
    alertMessage: string;

    assetsUrl: string;

    facebookWorking: boolean = environment.facebookWorking;
    googleWorking: boolean = environment.googleWorking;
    facebookText: string;
    googleText: string;

    constructor(private _ngZone: NgZone, private fb: FacebookService, private userService: UserService, private router: Router, private userDataService:DataService,private dataService: DataService){
        this.assetsUrl = environment.assetsUrl;
        if (this.facebookWorking) {
            let initParams: InitParams = {
                appId: environment.facebookKey,
                xfbml: true,
                version: 'v2.12'
            };
            fb.init(initParams);
            this.facebookText = "Iniciar sesión con Facebook";
        } else {
            this.facebookText = "Pronto con Facebook";
        }
        if (this.googleWorking) {
            gapi.load('auth2', function () {
                gapi.auth2.init({
                    client_id: environment.googleClient,
                    fetch_basic_profile: true

                });
            });
            this.googleText = "Iniciar sesión con Google";
        } else {
            this.googleText = "Pronto con Google";
        }
        this.userService.isLoggedIn().subscribe((users: User) => {
            if (users[0]) {
                this.dataService.updateUser(users[0]);
                this.router.navigate(['/dashboard']);
            }
        });
    }

    loginWithOptions() {
        if (this.facebookWorking) {
            this.showMessage = false;
            this.loginWithGoogle = false;
            this.loginWithFacebook = true;
            this.loginWithPassword = false;
            const loginOptions: LoginOptions = {
                enable_profile_selector: true,
                return_scopes: true,
                scope: 'public_profile,email'
            };
            this.fb.login(loginOptions)
                .then((res: LoginResponse) => {
                    this.showMessage = true;
                    this.alertMessage = "Por favor espere.";
                    this.messageType = 2;
                    this.loginWithFacebook = true;
                    this.fb.api('me?fields=id,first_name,last_name,email,picture.width(150).height(150)')
                        .then((res: any) => {
                            console.log('Got the users profile information'+ res);
                            this.fbId = res.id;
                            this.firstName = res.first_name;
                            this.lastName = res.last_name;
                            this.email = res.email;
                            this.fbToken = this.fb.getAuthResponse().accessToken;
                            this.photoUrl = res.picture.data.url;
                            this.userService.adminApiId(res.id, 0).subscribe((users1: User[]) => {
                                if(users1.length != 0){
                                    this.user=users1[0];
                                    this.alertMessage = "Ha iniciado sesión con éxito.";
                                    this.messageType = 0;
                                    this.userService.auth(res.id, 0).subscribe((users: User[]) => {
                                        this.userDataService.updateUser(users[0]);
                                        setTimeout(() =>
                                            {
                                                this._ngZone.run(
                                                    () => this.router.navigate(['/admin/competition'])
                                                );
                                            },
                                            1500);
                                    });
                                } else {
                                    this.alertMessage = "Usted no está registrado, por favor registrese.";
                                    this.isNotRegistered = true;
                                    this.messageType = 1;
                                }
                            });
                        }).catch(this.handleErrorProfile);
                }).catch(this.handleErrorLogin);
        }
    }

    googleSignIn() {
        if (this.googleWorking) {
            this.loginWithGoogle = true;
            this.loginWithFacebook = false;
            this.loginWithPassword = false;
            this.showMessage = false;
            var auth2 = gapi.auth2.getAuthInstance();
            var user = auth2.currentUser.get();
            var profile = user.getBasicProfile();
            // Sign the user in, and then retrieve their ID.
            auth2.signIn().then((res: any) => {
                var profile = res.getBasicProfile();
                this._ngZone.run(
                    () => {
                        this.showMessage = true;
                        this.alertMessage = "Por favor espere.";
                        this.messageType = 2;
                    }
                );
                this.userService.adminApiId(profile.getId(), 1).subscribe((users1: User[]) => {
                    if(users1.length != 0){
                        this.user=users1[0];
                        this.alertMessage = "Ha iniciado sesión con éxito.";
                        this.messageType = 0;
                        this.userService.auth(profile.getId(), 1).subscribe((users: User[]) => {
                            this.userDataService.updateUser(users[0]);
                            console.log("Completed auth");
                            setTimeout(() =>
                                {
                                    this._ngZone.run(
                                        () => this.router.navigate(['/admin/competition'])
                                    );
                                },
                                1500);
                        })
                    } else {
                        this.alertMessage = "Usted no está registrado, por favor registrese.";
                        this.isNotRegistered = true;
                        this.messageType = 1;
                    }
                });
            }).catch(this.handleErrorProfile);
        }
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

    passwordLogin(){
        this.alertMessage = "Por favor espere.";
        this.showMessage = true;
        this.messageType = 2;
        this.userService.loginWithPassword(this.username, this.password).subscribe((user: User) => {
            if (user && user.is_admin == 1){
                this.alertMessage = "Ha iniciado sesión con éxito";
                this.messageType = 0;
                this.userDataService.updateUser(user);
                setTimeout(() =>
                    {
                        this._ngZone.run(
                            () => this.router.navigate(['/admin/competition'])
                        );
                    },
                    1500);
            } else {
                this.alertMessage = "El usuario o la contraseña son incorrectos.";
                this.messageType = 1;
            }
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
