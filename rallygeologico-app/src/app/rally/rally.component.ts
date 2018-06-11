import {Component, OnInit } from '@angular/core';
import {RallyService} from "../services/rally.service";
import {Rally} from "../model/rally";
import {ActivatedRoute, Params, Router} from "@angular/router";
import {CompetitionStatisticsService} from "../services/competition.statistics.service";
import {CompetitionStatistics} from "../model/competition.statistics";

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

  constructor(private rallyService: RallyService,private competitionStatService : CompetitionStatisticsService, private route: ActivatedRoute, private router: Router){
    this.zoom = 9;

  }

  ngOnInit() {
    this.route.params
        .subscribe(
            (params: Params) => {
              this.rallyId = this.route.snapshot.params['rallyId'];
              console.log("Rally Id = " + this.rallyId);
              this.rallyService.getRally(this.rallyId).subscribe((rally: Rally)=>{
                if (rally){
                   this.rally = rally;
                   //console.log("Rally "+JSON.stringify(this.rally));
                } else {
                   this.router.navigate(['/dashboard']);
                }
              });
            }
            );
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
  }

}
