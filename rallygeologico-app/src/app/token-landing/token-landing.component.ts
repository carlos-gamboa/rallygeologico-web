import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Params, Router} from "@angular/router";
import {UserService} from "../services/user.service";
import {Token} from "../model/token";
import {environment} from "../../environments/environment";

@Component({
  selector: 'app-token-landing',
  templateUrl: './token-landing.component.html',
  styleUrls: ['./token-landing.component.css']
})
export class TokenLandingComponent implements OnInit {

    value: string;
    token: Token;
    readyToShow: boolean;
    assetsUrl: string;

    showMessage: boolean;
    messageType: number;
    alertMessage: string;

    newPassword: string;
    newPasswordVerify: string;

    successful: boolean;


    constructor(private router: Router,  private userService: UserService, private route: ActivatedRoute) {
        this.assetsUrl = environment.assetsUrl;
        this.readyToShow = false;
        this.successful = false;
        this.route.params.subscribe( (params: Params) => {
            this.value = this.route.snapshot.params['tokenValue'];
            this.userService.getTokenByValue(this.value).subscribe((token: Token[]) => {
               if (token[0]){
                   this.token = token[0];
                   if (this.token.type == "activate"){
                       this.userService.activateUser(this.token.user.id).subscribe((result: boolean) => {
                           this.userService.invalidateUsersToken(this.token.user.id, this.token.type).subscribe((result2: boolean) => {
                               this.readyToShow = true;
                           });
                       })
                   } else {
                       this.readyToShow = true;
                   }
               } else {
                   this.router.navigate(['/landing']);
               }
            });
        });
    }

    ngOnInit() {
    }

    isForgot(){
        return (this.token.type == "forgot" && this.token.is_valid == "1");
    }

    isActivate(){
        return (this.token.type == "activate" && this.token.is_valid == "1");
    }

    isInvalid(){
        return (this.token.is_valid == "0");
    }

    matchPasswords(){
        if (this.newPassword && this.newPasswordVerify){
            return (this.newPassword.localeCompare(this.newPasswordVerify) == 0);
        } else {
            return true;
        }
    }

    changePassword(){
        this.showMessage = false;
        this.userService.forceChangePassword(this.token.user.id, this.newPassword).subscribe((result: boolean) => {
            this.showMessage = true;
            if (result){
                this.userService.invalidateUsersToken(this.token.user.id, this.token.type).subscribe((result2: boolean) => {
                    this.messageType = 0;
                    this.alertMessage = "Se ha cambiado la contraseña.";
                    this.successful = true;
                });
            } else {
                this.messageType = 1;
                this.alertMessage = "No se ha podido cambiar la contraseña.";
            }
        })
    }

    async ngAfterViewInit() {
        await this.loadScript(this.assetsUrl+"assets/js/jquery-2.2.4.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/superfish.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.magnific-popup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.counterup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/main.js");
    }

    private loadScript(scriptUrl: string) {
        return new Promise((resolve, reject) => {
            const scriptElement = document.createElement('script');
            scriptElement.src = scriptUrl;
            scriptElement.type = "text/javascript";
            scriptElement.onload = resolve;
            document.body.appendChild(scriptElement);
        })
    }

}
