import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {ActivatedRoute, Params, Router} from "@angular/router";
import {CompetitionStatistics} from "../../model/competition.statistics";
import {CompetitionStatisticsService} from "../../services/competition.statistics.service";

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

    ngOnInit() {}

    /**
     * This method set all the required data
     */
    setupData(){
        this.route.params
            .subscribe(
                (params: Params) => {
                    this.userId = this.route.snapshot.params['userId'];
                    this.userService.findById(this.userId).subscribe((user: User) => {
                        this.targetUser = user;
                        if (user) {
                            this.statisticsService.getCurrentCompetitions(this.targetUser.id).subscribe((stats : CompetitionStatistics[]) => {
                                this.statistics = stats;
                                this.reloadCompetitions(stats);
                                this.statisticsService.getActiveCompetitions(this.targetUser.id).subscribe((total : any) => {
                                    this.currentRallies = total[0].totalActiveCompetitions;
                                    this.statisticsService.getTotalCompetitions(this.targetUser.id).subscribe((total :any) => {
                                        this.totalRallies = total[0].totalCompetitions;
                                        this.totalPoints = total[0].totalPoints;
                                        this.statisticsService.getVisitedSites(this.targetUser.id).subscribe((total : any) => {
                                            this.visitedSites = total[0].totalVisited;
                                            this.statisticsService.getTotalSites().subscribe((total : any) => {
                                                this.totalSites = total[0].totalSites;
                                                this.readyToShow = true;
                                            });
                                        });
                                    });
                                });
                            });
                        } else{
                            this.router.navigate(['/dashboard']);
                        }
                    });
                }
            );
    }

    /**
     * This method reload all the showed statistics
     * @param {CompetitionStatistics[]} competitionStats
     */
    reloadCompetitions(competitionStats:CompetitionStatistics[]) {
        this.statistics = competitionStats;
        this.totalCompetitions = competitionStats.length;
        this.showedStatistics = competitionStats.slice(0, this.pageSize);
        this.currentPage = 0;
    }

    /**
     * This method controls the statistics drop down in a row
     * @param {number} i
     * @returns {boolean}
     */
    isUserStatisticClicked(i: number){
        return i == this.clickedStatistic;
    }

    /**
     *
     * @param {number} i
     */
    userStatisticClicked(i: number){
        if (i == this.clickedStatistic){
            this.clickedStatistic = -1;
        } else {
            this.clickedStatistic = i;
        }
    }

    /**
     * This method sort the user statistics
     */
    sortStatistics(){
        this.statistics.sort(function(a,b) {return (b.points - a.points)});
    }

    /**
     * This method is call when user wants to see more statistics
     */
    pageChange() : void{
        if(this.statistics) {
            this.showedStatistics = this.statistics.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
            this.clickedStatistic = -1;
        }
    }
}
