import { Component, OnInit } from '@angular/core';
import {DataService} from "../../services/data/data.service";
import {CompetitionStatisticsService} from "../../services/competition.statistics.service";
import {ActivatedRoute, Router} from "@angular/router";
import {User} from "../../model/user";
import {UserService} from "../../services/user.service";
import {environment} from "../../../environments/environment";

@Component({
  selector: 'app-edit-profile',
  templateUrl: './edit-profile.component.html',
  styleUrls: ['./edit-profile.component.css']
})
export class EditProfileComponent implements OnInit {

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
}
