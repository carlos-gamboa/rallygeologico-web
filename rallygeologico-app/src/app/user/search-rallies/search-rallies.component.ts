import { Component, OnInit } from '@angular/core';
import {Competition} from "../../model/competition";
import {User} from "../../model/user";
import {CompetitionService} from "../../services/competition.service";
import {DataService} from "../../services/data/data.service";
import {Router} from "@angular/router";
import {UserService} from "../../services/user.service";

@Component({
  selector: 'app-search-rallies',
  templateUrl: './search-rallies.component.html',
  styleUrls: ['./search-rallies.component.css']
})
export class SearchRalliesComponent implements OnInit {

    user : User;
    competitions : Competition[];
    allCompetitions: Competition[];
    showedCompetitions: Competition[];

    pageSize : number = 10;
    currentPage : number = 0;
    totalCompetitions : number = 0;

    searchQuery : string = "";

  constructor(private competitionService:CompetitionService,
              private dataService:DataService,
              private router: Router,
              private  userService:UserService) {

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

  }

  setupData(){
      this.competitionService.getAllPublicCompetitions(this.user.id).subscribe((competitions : Competition[]) =>{
          this.allCompetitions = competitions;
          this.reloadCompetitions(competitions);
      });
  }

  ngOnInit() {
  }

  reloadCompetitions(competitions:Competition[]) {
      this.competitions = competitions;
      this.totalCompetitions = competitions.length;
      this.showedCompetitions = competitions.slice(0, this.pageSize);
      this.currentPage = 0;
  }

    pageChange() : void{
        if(this.competitions) {
            this.showedCompetitions = this.competitions.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }

    searchCompetition(){
        let competitionsToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let competition of this.allCompetitions) {
                if (competition.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    competitionsToShow.push(competition);
                }
            }
            this.reloadCompetitions(competitionsToShow);
        }else{
            this.reloadCompetitions(this.allCompetitions);
        }
    }
}
