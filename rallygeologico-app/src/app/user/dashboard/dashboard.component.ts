import { Component, OnInit } from '@angular/core';
import {InvitationService} from "../../services/invitation.service";
import {CompetitionService} from "../../services/competition.service";
import {ActivatedRoute, Router} from "@angular/router";
import {Invitation} from "../../model/invitation";
import {User} from "../../model/user";
import {UserService} from "../../services/user.service";
import {DataService} from "../../services/data/data.service";
import {Competition} from "../../model/competition";
import {RallyService} from "../../services/rally.service";
import {Rally} from "../../model/rally";
import {CompetitionStatisticsService} from "../../services/competition.statistics.service";
import {CompetitionStatistics} from "../../model/competition.statistics";

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

    user: User;
    invitations: Invitation[] = [];
    competitionsStatistics: CompetitionStatistics[] = [];
    ralliesToShow: Rally[] = [];
    initialLatitude: number;
    initialLongitude: number;
    zoom: number;
    readyToShow: boolean = false;

    constructor(private userService: UserService, private dataService: DataService,
                private invitationService: InvitationService,
                private competitionStatisticsService: CompetitionStatisticsService,
                private rallyService: RallyService, private router: Router) {

        this.user = this.dataService.getUser();
        if (!this.user){
            this.userService.isLoggedIn().subscribe((users: User) => {
                if(users[0]){
                    this.dataService.updateUser(users[0]);
                    this.user = users[0];
                    this.setupData();
                } else {
                    this.router.navigate(['/landing']);
                }
            });
        } else {
            this.setupData();
        }
        this.initialLatitude = 10.4958;
        this.initialLongitude = -85.355;
        this.zoom = 9;
    }

    setupData(){
        this.invitationService.getInvitations(this.user.id).subscribe((invitations: Invitation[]) =>{
            this.invitations = invitations;
            this.competitionStatisticsService.getCurrentCompetitions(this.user.id).subscribe((stats: CompetitionStatistics[]) =>{
                this.competitionsStatistics = stats;
                this.rallyService.getAllRallies().subscribe((rallies: Rally[]) =>{
                    this.ralliesToShow = rallies;
                    this.readyToShow = true;
                });
            });
        });
    }

    ngOnInit() {
    }

}
