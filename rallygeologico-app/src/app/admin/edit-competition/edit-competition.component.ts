import { Component, OnInit } from '@angular/core';
import { DatePipe } from '@angular/common';
import {Rally} from "../../model/rally";
import {User} from "../../model/user";
import {Competition} from "../../model/competition";
import {CompetitionStatisticsService} from "../../services/competition.statistics.service";
import {CompetitionService} from "../../services/competition.service";
import {InvitationService} from "../../services/invitation.service";
import {UserService} from "../../services/user.service";
import {RallyService} from "../../services/rally.service";
import {Router} from "@angular/router";
import {DataService} from "../../services/data/data.service";

@Component({
    selector: 'app-edit-competition',
    templateUrl: './edit-competition.component.html',
    styleUrls: ['./edit-competition.component.css'],
    providers: [ DatePipe ]
})
export class EditCompetitionComponent implements OnInit {

    ralliesList: Rally[] = [];
    competitionList: Competition[] = [];

    user: User;
    users : User[];
    allUsers: User[];
    showedUsers: User[];

    pageSize : number = 10;
    currentPage : number = 0;
    totalUsers : number = 0;

    searchQuery : string = "";

    currentCompetition: Competition;
    currentCompetitionIndex: number;

    name: string;
    is_active: string;
    is_public: string;
    rally_id: string;
    description: string;
    starting_date: string;
    finishing_date: string;
    admin_id: string;

    newCompetition: boolean;
    changesSaved: boolean;

    invitedUsers: number[] = [];

    constructor(private rallyService: RallyService, private userService: UserService,
                private dataService: DataService, private competitionService: CompetitionService,
                private invitationService: InvitationService,
                private competitionStatisticsService: CompetitionStatisticsService,  private router: Router,
                private dataPipe: DatePipe) {
        this.changesSaved = false;
        this.currentCompetitionIndex = -1;
        this.user = this.dataService.getUser();
        if (!this.user) {
            this.userService.isLoggedIn().subscribe((users: User) => {
                if (users[0] && users[0].is_admin == 1) {
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
        this.rallyService.getAllRallies().subscribe((rallies: Rally[]) => {
            for (let i: number = 0; i < rallies.length; ++i) {
                this.ralliesList.push(rallies[i]);
            }
        });
        this.competitionService.getAllCompetitions().subscribe((competitions: Competition[]) => {
            for (let i: number = 0; i < competitions.length; ++i) {
                this.competitionList.push(competitions[i]);
            }
            this.currentCompetitionIndex = 0;
            this.editCompetitionChange();
        });
        this.allUsers = [];
        this.userService.getUsers().subscribe((users: User[]) => {
            for (let user of users){
                if (user.id != this.user.id){
                    this.allUsers.push(user);
                }
            }
            this.reloadUsers(this.allUsers);
            //console.log(this.allUsers);
        });
    }

    /**
     * Reloads the corresponding users in the table
     * @param {User[]} users
     */
    reloadUsers(users : User[]) : void{
        this.users = users;
        this.totalUsers = users.length;
        this.showedUsers = users.slice(0, this.pageSize);
        this.currentPage = 0;
    }

    /**
     * Selects the number of users' pages
     */
    pageChange() : void{
        if(this.users) {
            this.showedUsers = this.users.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }

    /**
     * Searches a specified user
     */
    searchUser(){
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

    saveChanges(){
        if (this.currentCompetitionIndex == 0){
            this.competitionService.adminAddCompetition(this.name, this.is_active, this.is_public, this.description,
                this.starting_date.replace("T", " "),
                this.finishing_date.replace("T", " "), this.rally_id, this.admin_id);
        } else {
            this.competitionService.editCompetition(this.currentCompetition.id, this.name, this.is_active,
                this.is_public, this.description, this.starting_date.replace("T", " "),
                this.finishing_date.replace("T", " "), this.rally_id,
                this.admin_id);
        }
    }

    editCompetitionChange(){
        if (this.currentCompetitionIndex == 0){
            this.currentCompetition = new Competition(null);
            this.name = "";
            this.is_active = "1";
            this.is_public = "1";
            this.rally_id = "1";
            this.description = "";
            this.starting_date = "";
            this.finishing_date = "";
        } else {
            this.currentCompetition = this.competitionList[this.currentCompetitionIndex - 1];
            this.name = this.currentCompetition.name;
            this.is_active = this.currentCompetition.is_active.toString();
            this.is_public = this.currentCompetition.is_public.toString();
            this.rally_id = this.currentCompetition.rally_id.toString();
            this.description = this.currentCompetition.description;
            this.starting_date = this.dataPipe.transform(this.currentCompetition.starting_date, 'yyyy-MM-ddThh:mm');
            this.finishing_date = this.dataPipe.transform(this.currentCompetition.finishing_date, 'yyyy-MM-ddThh:mm');
        }
    }

}
