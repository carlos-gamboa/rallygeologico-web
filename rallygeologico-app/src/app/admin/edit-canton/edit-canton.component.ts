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

    currentCompetition: Competition;
    currentCompetitionIndex: number;

    statistics: CompetitionStatistics[];

    name: string;
    is_active: string;
    is_public: string;
    rally_id: string;
    description: string;
    starting_date: string;
    finishing_date: string;
    admin_id: string;

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
        if (!this.currentCompetition){
            this.cantonService.adminAddCompetition(this.name, this.is_active, this.is_public, this.description,
                this.starting_date.replace("T", " "),
                this.finishing_date.replace("T", " "), this.rally_id, this.admin_id).subscribe((competition: Competition) => {
                if (competition){
                    this.currentCompetition = competition;
                    this.allCompetitions.push(this.currentCompetition);
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
            this.cantonService.editCompetition(this.currentCompetition.id, this.name, this.is_active,
                this.is_public, this.description, this.starting_date.replace("T", " "),
                this.finishing_date.replace("T", " "), this.rally_id,
                this.admin_id).subscribe((competition: Competition) => {
                this.changesSaved = true;
                if (competition){
                    this.currentCompetition = competition;
                    this.allCompetitions[this.currentCompetitionIndex] = this.currentCompetition;
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
        if (!this.currentCompetition){
            this.name = "";
            this.is_active = "1";
            this.is_public = "1";
            this.rally_id = "";
            this.description = "";
            this.starting_date = "";
            this.finishing_date = "";
            this.admin_id = "";
        } else {
            this.name = this.currentCompetition.name;
            this.is_active = this.currentCompetition.is_active.toString();
            this.is_public = this.currentCompetition.is_public.toString();
            this.rally_id = this.currentCompetition.rally_id.toString();
            this.admin_id = this.currentCompetition.admin_id.toString();
            this.description = this.currentCompetition.description;
            this.starting_date = this.dataPipe.transform(this.currentCompetition.starting_date, 'yyyy-MM-ddThh:mm');
            this.finishing_date = this.dataPipe.transform(this.currentCompetition.finishing_date, 'yyyy-MM-ddThh:mm');
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
            this.currentCompetition = null;
        } else {
            this.currentCompetition = this.showedCantons[i];
            this.currentCompetitionIndex = ((this.currentPageCompetition - 1) * this.pageSize) + i;
            this.updateStatistics();
        }
        this.editCompetitionChange();
    }

    updateStatistics(){
        this.competitionStatisticsService.getStatistics(this.currentCompetition.id).subscribe((statistics: CompetitionStatistics[])=>{
            if (statistics){
                this.statistics = statistics;
                this.sortStatistics();
                this.readyToShow = true;
            } else {
                console.log("Couldn't get statistics");
            }
        });
        this.clickedStatistic = -1;
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
        this.competitionSelected = false;
        this.currentCompetition = null;
        this.reloadCompetitions(this.allCompetitions);
    }

    deleteCompetition(){
        this.deleted = false;
        this.changesSaved = false;
        this.competitionService.deleteCompetition(this.currentCompetition.id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.currentCompetition = null;
                this.allCompetitions.splice(this.currentCompetitionIndex, 1);
                this.messageType = true;
                this.alertMessage = "Se ha eliminado la competencia.";
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar la competencia.";
            }
        });
    }

    deleteStatistic(id: number){
        this.deleted = false;
        this.competitionStatisticsService.deleteStatistic(id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.updateStatistics();
                this.messageType = true;
                this.alertMessage = "Se han eliminado las estadísticas del jugador.";
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar las estadística del jugador.";
            }
        });
    }

    deleteStatisticSite(id: number){
        this.deleted = false;
        this.competitionStatisticsService.deleteStatisticSite(id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.updateStatistics();
                this.messageType = true;
                this.alertMessage = "Se ha eliminado la estadística del sitio.";
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar la estadística del sitio.";
            }
        });
    }

    deleteStatisticActivity(id: number){
        this.deleted = false;
        this.competitionStatisticsService.deleteStatisticActivity(id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.updateStatistics();
                this.messageType = true;
                this.alertMessage = "Se ha eliminado la estadística de la actividad.";
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar la estadística de la actividad.";
            }
        });
    }
}
