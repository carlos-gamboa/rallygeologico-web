import { Component, OnInit } from '@angular/core';
import {environment} from "../../environments/environment";
import {UserService} from "../services/user.service";

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.css']
})
export class ForgotPasswordComponent implements OnInit {

    assetsUrl: string;
    email: string;

    showMessage: boolean;
    messageType: number;
    alertMessage: string;

    constructor(private userService: UserService) {
        this.assetsUrl = environment.assetsUrl;
    }

    ngOnInit() {
    }

    forgotPassword(){
        this.showMessage = false;
        this.userService.forgotPassword(this.email).subscribe((result: boolean) => {
            this.showMessage = true;
            if (result){
                this.messageType = 0;
                this.alertMessage = "Se ha enviado un correo electrónico para recuperar la contraseña.";
            } else {
                this.messageType = 1;
                this.alertMessage = "No se ha podido enviar el correo electrónico a la dirección ingresada.";
            }
        })
    }

}
