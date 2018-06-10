import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {CompetitionStatistics} from "../../model/competition.statistics";
import {User} from "../../model/user";
import {Competition} from "../../model/competition";
import {DataService} from "../../services/data/data.service";
import {Router} from "@angular/router";
import {CantonService} from "../../services/canton.service";
import {Canton} from "../../model/canton";
import {Province} from "../../model/province";
import {ProvinceService} from "../../services/province.service";

@Component({
  selector: 'app-edit-canton',
  templateUrl: './edit-canton.component.html',
  styleUrls: ['./edit-canton.component.css']
})
export class EditCantonComponent implements OnInit {
    
    cantons: Canton[];
    allCantons: Canton[];
    showedCantons: Canton[];

    allProvinces: Province[];

    user: User;


    pageSize : number = 10;
    currentPageCanton : number = 0;
    totalUsers : number = 0;
    totalCompetitions : number = 0;
    currentPageCompetition: number = 0;
    clickedStatistic: number = -1;

    searchQuery : string = "";

    currentCanton: Canton;
    currentCantonIndex: number;

    statistics: CompetitionStatistics[];

    name: string;
    province_id: string;


    changesSaved: boolean;
    deleted: boolean;
    alertMessage: string;
    messageType: boolean;

    newCompetition: boolean;
    cantonSelected: boolean;
    readyToShow: boolean;
    activeTab: number;

    invitedUsers: number[] = [];

    constructor(private cantonService:CantonService,
                private userService: UserService,
                private provinceService: ProvinceService,
                private dataService: DataService,
                private router:Router) {
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
        this.cantonService.selectallCantons().subscribe((cantons: Canton[]) => {
            this.allCantons = cantons;
            this.reloadCantons(this.allCantons);
        });


        this.cantonSelected = false;
        this.readyToShow = true;
    }

    /**
     * Reloads the corresponding users in the table
     * @param {User[]} users
     */
    reloadCantons(cantons : Canton[]) : void{
        this.cantons = cantons;
        this.totalUsers = cantons.length;
        this.showedCantons = cantons.slice(0, this.pageSize);
        this.currentPageCanton = 0;
    }

    /**
     * Selects the number of users' pages
     */
    cantonPageChange() : void{
        if(this.cantons) {
            this.showedCantons = this.cantons.slice((this.currentPageCanton - 1) * this.pageSize, ((this.currentPageCanton) * this.pageSize));
        }
    }

    /**
     * Searches a specified user
     */
    searchCanton(){
        let usersToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let canton of this.allCantons) {
                if (canton.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    usersToShow.push(canton);
                }
            }
            this.reloadCantons(usersToShow);
        }else{
            this.reloadCantons(this.allCantons);
        }
    }

    /**
     * Reloads the corresponding users in the table
     * @param {User[]} users
     */
    // reloadCompetitions(competitions : Competition[]) : void{
    //     this.competitions = competitions;
    //     this.totalCompetitions = competitions.length;
    //     this.showedCompetitions = competitions.slice(0, this.pageSize);
    //     this.currentPageCompetition = 0;
    // }
    //
    // /**
    //  * Selects the number of users' pages
    //  */
    // competitionPageChange() : void{
    //     if(this.users) {
    //         this.showedUsers = this.users.slice((this.currentPageCompetition - 1) * this.pageSize, ((this.currentPageCompetition) * this.pageSize));
    //     }
    // }
    //
    // /**
    //  * Searches a specified user
    //  */
    // searchCompetition(){
    //     let usersToShow = [];
    //     if(this.searchQuery.length >= 1) {
    //         for (let user of this.allUsers) {
    //             if (user.username.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
    //                 usersToShow.push(user);
    //             }
    //         }
    //         this.reloadUsers(usersToShow);
    //     }else{
    //         this.reloadUsers(this.allUsers);
    //     }
    // }

    saveChanges(){
        this.changesSaved = false;
        this.deleted = false;
        if (!this.currentCanton){
            this.cantonService.addCanton("",1).subscribe((canton:Canton) => {
                if (canton){
                    this.currentCanton = canton;
                    this.allCantons.push(this.currentCanton);
                    this.changesSaved = true;
                    this.messageType = true;
                    this.newCompetition = false;
                    this.alertMessage = "La competencia ha sido creada.";
                } else {
                    this.messageType = false;
                    this.alertMessage = "No se pudo crear la competencia.";
                }
            });
        } else {
            this.cantonService.editCanton(this.currentCanton.id, this.name, this.currentCanton.province_id,)
                .subscribe((canton: Canton) => {
                this.changesSaved = true;
                if (canton){
                    this.currentCanton = canton;
                    this.allCantons[this.currentCantonIndex] = this.currentCanton;
                    this.messageType = true;
                    this.alertMessage = "Se han guardado los cambios.";
                } else {
                    this.alertMessage = "No se pudo guardar los cambios.";
                    this.messageType = false;

                }
            });
        }
    }

    editCompetitionChange(){
        if (!this.currentCanton){
            this.name = "";
            this.province_id = "";
        } else {
            this.name = this.currentCanton.name;
            this.province_id = this.currentCanton.province_id.toString();
        }
    }

    sortStatistics(){
        this.statistics.sort(function(a,b) {return (b.points - a.points)});
    }

    edit(i: number){
        this.readyToShow = false;
        this.activeTab = 0;
        this.cantonSelected = true;
        this.changesSaved = false;
        this.deleted = false;
        if (i == -1){
            this.newCompetition = true;
            this.currentCanton = null;
        } else {
            this.currentCanton = this.showedCantons[i];
            this.currentCantonIndex = ((this.currentPageCompetition - 1) * this.pageSize) + i;
        }
        this.editCompetitionChange();
    }

    changeTab(i: number){
        this.activeTab = i;
        this.changesSaved = false;
        this.deleted = false;
    }

    isUserStatisticClicked(i: number){
        return i == this.clickedStatistic;
    }

    userStatisticClicked(i: number){
        if (i == this.clickedStatistic){
            this.clickedStatistic = -1;
        } else {
            this.clickedStatistic = i;
        }
    }

    goBack(){
        this.cantonSelected = false;
        this.currentCanton = null;
        this.reloadCantons(this.allCantons);
    }

    deleteCompetition(){
        this.deleted = false;
        this.changesSaved = false;
        this.cantonService.deleteCanton(this.currentCanton.id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.currentCanton = null;
                this.allCantons.splice(this.currentCantonIndex, 1);
                this.messageType = true;
                this.alertMessage = "Se ha eliminado la competencia.";
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar la competencia.";
            }
        });
    }
}
