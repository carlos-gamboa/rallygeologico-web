import { Component, OnInit } from '@angular/core';
import {Competition} from "../../model/competition";
import {User} from "../../model/user";
import {CompetitionService} from "../../services/competition.service";
import {DataService} from "../../services/data/data.service";
import {Router} from "@angular/router";
import {UserService} from "../../services/user.service";
import {environment} from "../../../environments/environment";

@Component({
  selector: 'app-search-users',
  templateUrl: './search-users.component.html',
  styleUrls: ['./search-users.component.css']
})
export class SearchUsersComponent implements OnInit {

    user : User;
    users : User[];
    allUsers: User[];
    showedUsers: User[];

    pageSize : number = 10;
    currentPage : number = 0;
    totalUsers : number = 0;

    searchQuery : string = "";
    assetsUrl: string;

    constructor(private dataService:DataService,
              private router: Router,
              private  userService:UserService) {
        this.assetsUrl = environment.assetsUrl;
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
        this.userService.getUsers().subscribe((users : User[]) =>{
            this.allUsers = users;
            this.reloadUsers(users);
        });
    }

    ngOnInit() {

    }

    reloadUsers(users:User[]) {
      this.users = users;
      this.totalUsers= users.length;
      this.showedUsers = users.slice(0, this.pageSize);
      this.currentPage = 0;
    }

    pageChange() : void{
        if(this.users) {
            this.showedUsers = this.users.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }

    searchUsers(){
        let usersToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let user of this.allUsers) {
                if (user.username.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    usersToShow.push(user);
                }
            }
            this.reloadUsers(usersToShow);
        }else{
            this.reloadUsers(this.allUsers);
        }
    }

    async ngAfterViewInit() {
        await this.loadScript(this.assetsUrl+"assets/js/jquery-2.2.4.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/superfish.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.magnific-popup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.counterup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/main.js");
    }

    private loadScript(scriptUrl: string) {
        return new Promise((resolve, reject) => {
            const scriptElement = document.createElement('script');
            scriptElement.src = scriptUrl;
            scriptElement.type = "text/javascript";
            scriptElement.onload = resolve;
            document.body.appendChild(scriptElement);
        })
    }
}
