import { Component, OnInit } from '@angular/core';
import {InvitationService} from "../../services/invitation.service";
import {CompetitionService} from "../../services/competition.service";
import {ActivatedRoute} from "@angular/router";
import {Invitation} from "../../model/invitation";
import {User} from "../../model/user";
import {UserService} from "../../services/user.service";
import {DataService} from "../../services/data/data.service";

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

    user: User;
    invitations: Invitation[];

    constructor(private userService: UserService, private dataService: DataService,
              private invitationService: InvitationService,
              private competitionService: CompetitionService,) {

        this.user = this.dataService.getUser();
        if (!this.user){
            this.userService.isLoggedIn().subscribe((users: User) => {
                // this.dataService.updateUser(users[0]);
                // this.user = users[0];
                console.log(users);
            });
        }
        this.invitationService.getInvitations(this.user.id).subscribe((invitations: Invitation[]) =>{
            this.invitations = invitations;
        });
    }

    ngOnInit() {
    }

}
