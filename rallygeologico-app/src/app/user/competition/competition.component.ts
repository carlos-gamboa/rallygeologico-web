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

    pageSize : number = 10;
    currentPage : number = 0;
    totalUsers : number = 0;

    searchQuery : string = "";

    user: User;
    users : User[];
    allUsers: User[];
    showedUsers: User[];

    constructor(private userService: UserService, private dataService: DataService) {
        this.user = this.dataService.getUser();
        this.userService.getUsers().subscribe((users: User[]) => {
          this.allUsers = users;
          this.reloadUsers(users);
        });
    }

    reloadUsers(users : User[]) : void{
        this.users = users;
        this.totalUsers = users.length;
        this.showedUsers = users.slice(0, this.pageSize);
        this.currentPage = 0;
    }

    pageChange() : void{
        if(this.users) {
            this.showedUsers = this.users.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }

    searchUser(){
        let usersToShow = [];

        if(this.searchQuery.length >= 1) {
            for (let user of this.users) {
                if (user.username.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    usersToShow.push(user);
                }
            }
            this.reloadUsers(usersToShow);
        }else{
            this.reloadUsers(this.allUsers);
        }
    }

    invite (index: number){

    }

    ngOnInit() {

    }

}
