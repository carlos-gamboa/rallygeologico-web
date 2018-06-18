import { Component, OnInit } from '@angular/core';
import {User} from "../model/user";
import {Rally} from "../model/rally";
import {RallyService} from "../services/rally.service";
import {UserService} from "../services/user.service";
import {DataService} from "../services/data/data.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-rallies',
  templateUrl: './rallies.component.html',
  styleUrls: ['./rallies.component.css']
})
export class RalliesComponent implements OnInit {

    user : User;
    rallies : Rally[];
    allRallies: Rally[];
    showedRallies: Rally[];

    pageSize : number = 10;
    currentPage : number = 0;
    totalRallies : number = 0;

    searchQuery : string = "";

  constructor(private rallyService: RallyService, private dataService:DataService, private router: Router, private  userService:UserService) {
      this.user = this.dataService.getUser();
      if (!this.user){
          this.userService.isLoggedIn().subscribe((users: User) => {
              if(users[0]){
                  this.dataService.updateUser(users[0]);
                  this.user = users[0];
              }
          });
      }
      this.setupData();
  }

  ngOnInit() {
  }

  setupData(){
      this.rallyService.getAllRallies().subscribe((rallies : Rally[]) =>{
          this.allRallies = rallies;
          this.reloadRallies(rallies);
          console.log(this.allRallies);
      });
  }

  reloadRallies(rallies:Rally[]) {
        this.rallies = rallies;
        this.totalRallies = rallies.length;
        this.showedRallies = rallies.slice(0, this.pageSize);
        this.currentPage = 0;
    }

    pageChange() : void{
        if(this.rallies) {
            this.showedRallies = this.rallies.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }

    searchCompetition(){
        let ralliesToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let rally of this.allRallies) {
                if (rally.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    ralliesToShow.push(rally);
                }
            }
            this.reloadRallies(ralliesToShow);
        }else{
            this.reloadRallies(this.allRallies);
        }
    }

}
