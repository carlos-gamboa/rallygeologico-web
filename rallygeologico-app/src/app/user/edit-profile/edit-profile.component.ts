import {Component, OnInit, ViewChild} from '@angular/core';
import {DataService} from "../../services/data/data.service";
import {CompetitionStatisticsService} from "../../services/competition.statistics.service";
import {ActivatedRoute, Router} from "@angular/router";
import {User} from "../../model/user";
import {UserService} from "../../services/user.service";
import {environment} from "../../../environments/environment";
import {NgForm} from "@angular/forms";

@Component({
  selector: 'app-edit-profile',
  templateUrl: './edit-profile.component.html',
  styleUrls: ['./edit-profile.component.css']
})
export class EditProfileComponent implements OnInit {

    @ViewChild("changePasswordForm")
    changePasswordForm: NgForm;

    readyToShow: boolean = false;
    activeTab: number;

    currentUser : User;
    userId: number;

    changesSaved: boolean;
    alertMessage: string;
    messageType: boolean;

    first_name: string;
    last_name: string;
    photo_url: string;

    assetsUrl: string;

    currentPassword: string;
    newPassword: string;
    newPasswordVerify: string;

    constructor(private dataService: DataService,
                private userService: UserService,
                private statisticsService : CompetitionStatisticsService,
                private route: ActivatedRoute,
                private router: Router) {
        this.assetsUrl = environment.assetsUrl;
        this.currentUser = this.dataService.getUser();
        if (!this.currentUser) {
            this.userService.isLoggedIn().subscribe((users: User) => {
                if (users[0]) {
                    this.dataService.updateUser(users[0]);
                    this.currentUser = users[0];
                    this.setupData();
                } else {
                    this.router.navigate(['/landing']);
                }
            });
        } else {
            this.setupData();
        }
        this.activeTab = 0;
    }

    changeTab(i: number){
        this.activeTab = i;
    }

    ngOnInit() {
    }

    setupData(){
        this.first_name = this.currentUser.first_name;
        this.last_name = this.currentUser.last_name;
        this.photo_url = this.currentUser.photo_url;
        this.readyToShow = true;
    }

    saveChanges(){
        this.changesSaved = false;
        this.userService.editProfile(this.currentUser.id, this.first_name, this.last_name, this.photo_url).subscribe((users: User) => {
            if (users){
                this.currentUser.photo_url = this.photo_url;
                this.currentUser.first_name = this.first_name;
                this.currentUser.last_name = this.last_name;
                this.dataService.updateUser(this.currentUser);
                this.changesSaved = true;
                this.messageType = true;
                this.alertMessage = "Se han guardado los cambios.";
            } else {
                this.changesSaved = true;
                this.messageType = false;
                this.alertMessage = "No se ha logrado guardar los cambios.";
            }
        });
    }

    matchPasswords(){
        if (this.newPassword && this.newPasswordVerify){
            return (this.newPassword.localeCompare(this.newPasswordVerify) == 0);
        } else {
            return true;
        }
    }


    savePasswordChanges(){
        this.changesSaved = false;
        if(this.currentPassword && this.newPassword && this.newPasswordVerify) {
            if (this.currentPassword.localeCompare(this.newPasswordVerify) != 0) {
                this.userService.updatePassword(this.currentUser.id, this.currentPassword, this.newPassword).subscribe((changed: Boolean) => {
                    if (changed) {
                        this.changesSaved = true;
                        this.messageType = true;
                        this.alertMessage = "Su contraseña ha sido actualizada";
                        this.currentPassword = null;
                        this.newPassword = null;
                        this.newPasswordVerify = null;
                        this.resetForm(this.changePasswordForm);
                    } else {
                        this.changesSaved = true;
                        this.messageType = false;
                        this.alertMessage = "Contraseña actual es incorrecta";
                    }
                });
            }
            else {
                this.changesSaved = true;
                this.messageType = false;
                this.alertMessage = "La contraseña actual y la nueva son iguales";
            }
        }
        else {
            this.changesSaved = true;
            this.messageType = false;
            this.alertMessage = "Debe llenar todos los campos";
        }
    }

    resetForm(form: NgForm){
        form.form.markAsPristine();
        form.form.markAsUntouched();
        form.form.updateValueAndValidity();
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
