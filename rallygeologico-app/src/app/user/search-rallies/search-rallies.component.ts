import { Component, OnInit } from '@angular/core';
import {Competition} from "../../model/competition";
import {User} from "../../model/user";
import {CompetitionService} from "../../services/competition.service";
import {RouterLink} from "@angular/router";
import {RallyService} from "../../services/rally.service";
import {forEach} from "@angular/router/src/utils/collection";
import {Rally} from "../../model/rally";
import {UserService} from "../../services/user.service";

@Component({
  selector: 'app-search-rallies',
  templateUrl: './search-rallies.component.html',
  styleUrls: ['./search-rallies.component.css']
})
export class SearchRalliesComponent implements OnInit {

    competitions : Competition[];
    allCompetitions: Competition[];
    showedCompetitions: Competition[];

    pageSize : number = 10;
    currentPage : number = 0;
    totalCompetitions : number = 0;

    searchQuery : string = "";





  constructor(competitionService:CompetitionService, rallyService:RallyService, userService:UserService) {
      competitionService.getAllPublicCompetitions().subscribe((competitions : Competition[]) =>{
          this.allCompetitions = competitions;
          this.reloadCompetitions(competitions);
          console.log(this.allCompetitions);
      })
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
