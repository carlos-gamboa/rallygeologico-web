import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {DataService} from "../../services/data/data.service";
import {User} from "../../model/user";

@Component({
  selector: 'app-competition',
  templateUrl: './competition.component.html',
  styleUrls: ['./competition.component.css']
})
export class CompetitionComponent implements OnInit {

  user: User;
  users: User[];

  constructor(private userService: UserService, private dataService: DataService) {
    this.user = this.dataService.getUser();
    this.userService.getUsers().subscribe((users: User[]) => {
      this.users = users;
    });
  }

  ngOnInit() {
  }

}
