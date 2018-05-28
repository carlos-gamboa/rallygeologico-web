import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {

  user : User;
  constructor(private dataService: DataService,
              private userService: UserService,
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
  }

  setupData(){

  }
}
