import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {ActivatedRoute, Params, Router} from "@angular/router";
import {Rally} from "../../model/rally";
import {CompetitionStatistics} from "../../model/competition.statistics";
import {CompetitionStatisticsService} from "../../services/competition.statistics.service";
import {Competition} from "../../model/competition";

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
    readyToShow: boolean = false;

  currentUser : User;
  userId: number;

  targetUser : User;
  pageSize : number = 3;
  currentPage : number = 0;
  totalCompetitions : number = 0;

  visitedSites: number = 0;
  totalSites: number = 0;
  totalPoints:number = 0;
  totalRallies:number = 0;
  currentRallies:number = 0;

  statistics: CompetitionStatistics[] = [];
  allStatistics: CompetitionStatistics[][];
  showedStatistics: CompetitionStatistics[];
  clickedStatistic: number = -1;

  constructor(private dataService: DataService,
              private userService: UserService,
              private statisticsService : CompetitionStatisticsService,
              private route: ActivatedRoute,
              private router: Router) {
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
  }

  ngOnInit() {
      // this.route.params
      //     .subscribe(
      //         (params: Params) => {
      //             this.userId = this.route.snapshot.params['userId'];
      //             console.log("Rally Id = " + this.userId);
      //             this.userService.get(this.userId).subscribe((rally: Rally) => {
      //                 if (rally) {
      //                     this.rally = rally;
      //                     //console.log("Rally "+JSON.stringify(this.rally));
      //                 } else {
      //                     this.router.navigate(['/dashboard']);
      //                 }
      //             });
      //         }
      //     );
  }

  setupData(){

      this.route.params
          .subscribe(
              (params: Params) => {
                  this.userId = this.route.snapshot.params['userId'];
                  this.userService.findById(this.userId).subscribe((user: User) => {
                      this.targetUser = user;
                      if (user) {
                          this.statisticsService.getCurrentCompetitions(this.targetUser.id).subscribe((stats : CompetitionStatistics[]) => {
                              console.log(stats);
                              this.statistics = stats;
                              this.reloadCompetitions(stats);
                          });
                          this.statisticsService.getActiveCompetitions(this.targetUser.id).subscribe((total : any) => {

                              this.currentRallies = total[0].totalActiveCompetitions;
                          });
                          this.statisticsService.getTotalCompetitions(this.targetUser.id).subscribe((total :any) => {
                              console.log(total);
                              this.totalRallies = total[0].totalCompetitions;
                              this.totalPoints = total[0].totalPoints;
                          });
                          this.statisticsService.getVisitedSites(this.targetUser.id).subscribe((total : any) => {
                              this.visitedSites = total[0].totalVisited;
                          });
                          this.statisticsService.getTotalSites().subscribe((total : any) => {
                              this.totalSites = total[0].totalSites;
                          });
                          let i = 0;
                          for (let competition of this.statistics) {

                              this.statisticsService.getStatistics(competition.id).subscribe((statistics: CompetitionStatistics[])=>{
                                  if (statistics){
                                      this.allStatistics[i] = statistics;
                                      console.log(this.statistics);
                                      this.sortStatistics();
                                      this.readyToShow = true;
                                  } else {
                                      console.log("Couldn't get statistics");
                                  }
                              });
                              i++;
                          }


                      }else{
                          this.router.navigate(['/dashboard']);
                      }
                  });
              }
          );
        this.readyToShow = true;
  }


  reloadCompetitions(competitionStats:CompetitionStatistics[]) {
        this.statistics = competitionStats;
        this.totalCompetitions = competitionStats.length;
        this.showedStatistics = competitionStats.slice(0, this.pageSize);
        this.currentPage = 0;
  }


    isUserStatisticClicked(i: number){
        return i == this.clickedStatistic;
    }

    userStatisticClicked(i: number){
        if (i == this.clickedStatistic){
            this.clickedStatistic = -1;
        } else {
            this.clickedStatistic = i;
        }
    }

    sortStatistics(){
        this.statistics.sort(function(a,b) {return (b.points - a.points)});
    }

    pageChange() : void{
        if(this.statistics) {
            this.showedStatistics = this.statistics.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }
}
