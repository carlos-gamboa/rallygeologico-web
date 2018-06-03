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

    competitions: Competition[];
    allCompetitions: Competition[];
    showedCompetitions: Competition[];

    user: User;
    users : User[];
    allUsers: User[];
    showedUsers: User[];

    pageSize : number = 10;
    currentPageUser : number = 0;
    totalUsers : number = 0;
    totalCompetitions : number = 0;
    currentPageCompetition: number = 0;

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
    competitionSelected: boolean;
    readyToShow: boolean;
    activeTab: number;

    invitedUsers: number[] = [];

    constructor(private rallyService: RallyService, private userService: UserService,
                private dataService: DataService, private competitionService: CompetitionService,
                private invitationService: InvitationService,
                private competitionStatisticsService: CompetitionStatisticsService,  private router: Router,
                private dataPipe: DatePipe) {
        this.readyToShow = false;
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
            this.allCompetitions = [];
            this.competitionService.getAllCompetitions().subscribe((competitions: Competition[]) => {
                for (let i: number = 0; i < competitions.length; ++i) {
                    this.allCompetitions.push(competitions[i]);
                }
                this.reloadCompetitions(this.allCompetitions);
                this.allUsers = [];
                this.userService.getUsers().subscribe((users: User[]) => {
                    for (let user of users){
                        if (user.id != this.user.id){
                            this.allUsers.push(user);
                        }
                    }
                    this.reloadUsers(this.allUsers);
                    this.competitionSelected = false;
                    this.readyToShow = true;
                });
            });
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
        this.currentPageUser = 0;
    }

    /**
     * Selects the number of users' pages
     */
    userPageChange() : void{
        if(this.users) {
            this.showedUsers = this.users.slice((this.currentPageUser - 1) * this.pageSize, ((this.currentPageUser) * this.pageSize));
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

    /**
     * Reloads the corresponding users in the table
     * @param {User[]} users
     */
    reloadCompetitions(competitions : Competition[]) : void{
        this.competitions = competitions;
        this.totalCompetitions = competitions.length;
        this.showedCompetitions = competitions.slice(0, this.pageSize);
        this.currentPageCompetition = 0;
    }

    /**
     * Selects the number of users' pages
     */
    competitionPageChange() : void{
        if(this.users) {
            this.showedUsers = this.users.slice((this.currentPageCompetition - 1) * this.pageSize, ((this.currentPageCompetition) * this.pageSize));
        }
    }

    /**
     * Searches a specified user
     */
    searchCompetition(){
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
        if (!this.currentCompetition){
            this.name = "";
            this.is_active = "1";
            this.is_public = "1";
            this.rally_id = "1";
            this.description = "";
            this.starting_date = "";
            this.finishing_date = "";
        } else {
            this.name = this.currentCompetition.name;
            this.is_active = this.currentCompetition.is_active.toString();
            this.is_public = this.currentCompetition.is_public.toString();
            this.rally_id = this.currentCompetition.rally_id.toString();
            this.description = this.currentCompetition.description;
            this.starting_date = this.dataPipe.transform(this.currentCompetition.starting_date, 'yyyy-MM-ddThh:mm');
            this.finishing_date = this.dataPipe.transform(this.currentCompetition.finishing_date, 'yyyy-MM-ddThh:mm');
        }
    }

    edit(i: number){
        this.activeTab = 0;
        this.competitionSelected = true;
        if (i == -1){
            this.currentCompetition = null;
        } else {
            this.currentCompetition = this.showedCompetitions[i];
        }
        this.editCompetitionChange();
    }

    changeTab(i: number){
        this.activeTab = i;
    }

}
