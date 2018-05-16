import { Component, OnInit } from '@angular/core';
import {Competition} from "../../model/competition";
import {User} from "../../model/user";
import {CompetitionService} from "../../services/competition.service";

@Component({
  selector: 'app-search-rallies',
  templateUrl: './search-rallies.component.html',
  styleUrls: ['./search-rallies.component.css']
})
export class SearchRalliesComponent implements OnInit {

    competitions : Competition[];
    allCompetitions: Competition[];
    showedCompetitions: Competition[];

    currentCompetition: Competition;

    pageSize : number = 10;
    currentPage : number = 0;
    totalCompetitions : number = 0;

    searchQuery : string = "";

    admin_name: string;
    competition_name: string;
    rally: string;
    start_date: string;


    competitionCreated: boolean;



  constructor(competitionService:CompetitionService) {
      competitionService.getAllPublicCompetitions().subscribe((competitions : Competition[]) =>{
          this.allCompetitions = competitions;
          this.reloadCompetitions(competitions);
      })
  }

  ngOnInit() {
  }

  searchCompetition(){

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

    searchUser(){
        let usersToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let competition of this.allCompetitions) {
                if (competition.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    usersToShow.push(competition);
                }
            }
            this.reloadCompetitions(usersToShow);
        }else{
            this.reloadCompetitions(this.allCompetitions);
        }
    }

    goto(i:number) {

    }

}
