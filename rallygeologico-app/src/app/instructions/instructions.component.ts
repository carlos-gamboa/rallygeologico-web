import { Component, OnInit } from '@angular/core';
import {environment} from "../../environments/environment";
import {User} from "../model/user";
import {UserService} from "../services/user.service";
import {DataService} from "../services/data/data.service";

@Component({
  selector: 'app-instructions',
  templateUrl: './instructions.component.html',
  styleUrls: ['./instructions.component.css']
})
export class InstructionsComponent implements OnInit {

  assetsUrl: string;
  user: User;

  constructor(private userService: UserService, private dataService: DataService,) {
    this.assetsUrl = environment.assetsUrl;
    this.user = this.dataService.getUser();
    if (!this.user){
       this.userService.isLoggedIn().subscribe((users: User) => {
           if(users[0]){
              this.dataService.updateUser(users[0]);
              this.user = users[0];
           }
       });
    }
  }

  ngOnInit() {

  }

}
