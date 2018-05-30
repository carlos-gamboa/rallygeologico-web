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

  user : User;
  userId: number;

  pageSize : number = 3;
  currentPage : number = 0;
  totalCompetitions : number = 0;


  statistics: CompetitionStatistics[] = [];
  showedStatistics: CompetitionStatistics[];
  clickedStatistic: number = -1;

  constructor(private dataService: DataService,
              private userService: UserService,
              private statisticsService : CompetitionStatisticsService,
              private route: ActivatedRoute,
              private router: Router) {
      this.user = this.dataService.getUser();
      if (!this.user) {
          this.userService.isLoggedIn().subscribe((users: User) => {
              if (users[0]) {
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
      this.statisticsService.getCurrentCompetitions(this.user.id).subscribe((stats : CompetitionStatistics[]) => {
          this.statistics = stats;
          this.reloadCompetitions(stats);
      });
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

    pageChange() : void{
        if(this.statistics) {
            this.showedStatistics = this.statistics.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }
}
