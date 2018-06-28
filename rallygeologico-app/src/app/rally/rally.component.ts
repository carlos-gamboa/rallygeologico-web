import {Component, OnInit } from '@angular/core';
import {RallyService} from "../services/rally.service";
import {Rally} from "../model/rally";
import {ActivatedRoute, Params, Router} from "@angular/router";
import {CompetitionStatisticsService} from "../services/competition.statistics.service";
import {CompetitionStatistics} from "../model/competition.statistics";
import {User} from "../model/user";
import {DataService} from "../services/data/data.service";
import {UserService} from "../services/user.service";
import {environment} from "../../environments/environment";

@Component({
  selector: 'app-rally',
  templateUrl: './rally.component.html',
  styleUrls: ['./rally.component.css']
})
export class RallyComponent implements OnInit {

  zoom: number;

  rally: Rally;
  rallyId: number;

  usersWithMaxPoints : number;
  activeUsersWithMaxPoints : number;

  totalTotalCompetitions : number;
  totalTotalUsers : number;
  totalMaxPoints : number;
  totalTotalPoints : number;

  activeTotalCompetitions : number;
  activeTotalUsers : number;
  activeMaxPoints : number;
  activeTotalPoints : number;

  user: User;
  assetsUrl: string;

  constructor(private dataService: DataService, private userService: UserService, private rallyService: RallyService,private competitionStatService : CompetitionStatisticsService, private route: ActivatedRoute, private router: Router){
    this.zoom = 9;
    this.assetsUrl = environment.assetsUrl;
  }

  ngOnInit() {
      this.user = this.dataService.getUser();
      if (!this.user) {
          this.userService.isLoggedIn().subscribe((users: User) => {
              if (users[0]) {
                  this.dataService.updateUser(users[0]);
                  this.user = users[0];
              }
          });
      }
      this.setupData();
  }

  setupData(){
    this.route.params.subscribe( (params: Params) => {
        this.rallyId = this.route.snapshot.params['rallyId'];
        this.rallyService.getRally(this.rallyId).subscribe((rally: Rally)=>{
            if (rally) {
                this.rally = rally;
                //console.log("Rally "+JSON.stringify(this.rally));
                this.competitionStatService.getTotalRallyStatistics(this.rallyId).subscribe((totalCompetitionStats: any) => {
                    this.totalTotalCompetitions = totalCompetitionStats[0].totalCompetitions;
                    this.totalTotalUsers = totalCompetitionStats[0].totalUsers;
                    this.totalMaxPoints = totalCompetitionStats[0].maxPoints;
                    this.totalTotalPoints = totalCompetitionStats[0].totalPoints;
                    this.competitionStatService.getActiveRallyStatistics(this.rallyId).subscribe((activeCompetitionStats: any) => {
                        this.activeTotalCompetitions = activeCompetitionStats[0].totalCompetitions;
                        this.activeTotalUsers = activeCompetitionStats[0].totalUsers;
                        this.activeMaxPoints = activeCompetitionStats[0].maxPoints;
                        this.activeTotalPoints = activeCompetitionStats[0].totalPoints;
                        this.competitionStatService.getUsersWithMostPoints(this.rallyId, this.totalMaxPoints, 0).subscribe((users: any) => {
                            this.usersWithMaxPoints = users[0].totalUsers;
                        });
                        this.competitionStatService.getUsersWithMostPoints(this.rallyId, this.activeMaxPoints, 1).subscribe((users: any) => {
                            this.activeUsersWithMaxPoints = users[0].totalUsers;
                        });
                    });
                });
            } else {
                if (this.user){
                    this.router.navigate(['/dashboard']);
                } else {
                    this.router.navigate(['/landing']);
                }
            }
        });
    });
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
