import { Component, OnInit } from '@angular/core';
import {Rally} from "../../model/rally";
import {RallyService} from "../../services/rally.service";
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";

@Component({
  selector: 'app-create-competition',
  templateUrl: './create-competition.component.html',
  styleUrls: ['./create-competition.component.css']
})
export class CreateCompetitionComponent implements OnInit {

  ralliesList: Rally[] = [];
  usersList: User[] = [];
  minDate = new Date(2000, 0, 1);
  maxDate = new Date(2020, 0, 1);

  constructor(private rallyService: RallyService, private userService: UserService) {
      this.rallyService.getNewestRallies().subscribe((rallies: Rally[])=>{
          for (let i: number = 0; i < rallies.length; ++i){
              this.ralliesList.push(rallies[i]);
          }
          console.log(this.ralliesList);
      });
      this.userService.getUsers().subscribe((users: User[])=>{
          for (let i: number = 0; i < users.length; ++i){
              this.usersList.push(users[i]);
          }
          console.log(this.usersList);
      });
  }

  ngOnInit() {
  }

}
