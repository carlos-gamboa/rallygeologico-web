import { Component, OnInit } from '@angular/core';
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
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

    readyToShow : boolean;
    cantonSelected : boolean;
    changesSaved: boolean;
    deleted: boolean;
    newCanton: boolean;
    messageType : boolean;

    searchQuery : string = "";
    alertMessage : string = "";

    user: User;
    pageSize : number = 10;
    activeTab : number;

    cantons : Canton[];
    allCantons : Canton[];
    showedCantons : Canton[];
    totalCantons : number;
    currentPageCanton : number;

    allProvinces : Province[];

    currentCanton : Canton;
    currentCantonIndex: number;

    name: string;
    province_id: number;

    constructor(private cantonService: CantonService,
                private provinceService : ProvinceService,
                private userService: UserService,
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

    /**
     *  This method set all data using web services
     */
    setupData(){
        this.cantonService.selectallCantons().subscribe((cantons: Canton[]) => {
            console.log(cantons);
            this.allCantons = cantons;
            this.reloadCantons(this.allCantons);
            this.allProvinces = [];
            this.provinceService.getAllProvinces().subscribe((provinces : Province[]) => {
                console.log(provinces);
                this.allProvinces = provinces;
                this.readyToShow = true;
            });
        });
    }

    /**
     *  This method reload all cantons showing in the page
     * @param {Canton[]} cantons
     */
    reloadCantons(cantons : Canton[]) : void{
        this.cantons = cantons;
        this.totalCantons = cantons.length;
        this.showedCantons = cantons.slice(0, this.pageSize);
        this.currentPageCanton = 0;
    }

    /**
     * This method search an specific canton and show it in the page
     */
    searchCanton(){
        let termsToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let canton of this.allCantons) {
                if (canton.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    termsToShow.push(canton);
                }
            }
            this.reloadCantons(termsToShow);
        }else{
            this.reloadCantons(this.allCantons);
        }
    }

    /**
     * This method change the showed Cantons in the table
     */
    cantonPageChange() : void{
        if(this.cantons) {
            this.showedCantons = this.cantons.slice((this.currentPageCanton - 1) * this.pageSize, ((this.currentPageCanton) * this.pageSize));
        }
    }

    /**
     * This method allows to delete an specific Canton when the delete button is pressed
     * @param {number} id
     * @param {number} i
     */
    deleteCanton(id: number, i: number){
        this.deleted = false;
        this.changesSaved = false;
        this.cantonService.deleteCanton(id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.currentCanton = null;
                this.allCantons.splice(((this.currentPageCanton - 1) * this.pageSize) + i, 1);
                this.messageType = true;
                this.alertMessage = "Se ha eliminado el término.";
                this.reloadCantons(this.allCantons);
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar el término.";
            }
        });
    }

    /**
     * This method allows to edit an specific Canton
     * @param {number} i
     */
    edit(i: number){
        this.readyToShow = false;
        this.activeTab = 0;
        this.cantonSelected = true;
        this.changesSaved = false;
        this.deleted = false;
        if (i == -1){
            this.newCanton = true;
            this.currentCanton = null;
        } else {
            this.currentCanton = this.showedCantons[i];
            this.currentCantonIndex = ((this.currentPageCanton - 1) * this.pageSize) + i;
        }
        this.editCantonChange();
    }

    /**
     * This method allows to edit a Canton
     */
    editCantonChange(){
        if (!this.currentCanton){
            this.name = "";
            this.province_id = -1;
        } else {
            this.name = this.currentCanton.name;
            this.province_id = this.currentCanton.province_id;
        }
        this.readyToShow = true;
    }

    /**
     * This method set variables to default when user goes back in the menu
     */
    goBack(){
        this.cantonSelected = false;
        this.currentCanton = null;
        this.reloadCantons(this.allCantons);
    }

    /**
     * This method call web services to create or edit an specific Canton
     */
    saveChanges(){
        this.changesSaved = false;
        this.deleted = false;
        if (!this.currentCanton){
            this.cantonService.addCanton(this.name, this.province_id).subscribe((canton : Canton) => {
                if (canton){
                    this.currentCanton = canton;
                    this.allCantons.push(this.currentCanton);
                    this.changesSaved = true;
                    this.messageType = true;
                    this.newCanton = false;
                    this.alertMessage = "El cantón ha sido creado.";
                } else {
                    this.messageType = false;
                    this.alertMessage = "No se pudo eliminar el cantón.";
                }
            });
        } else {
            this.cantonService.editCanton(this.currentCanton.id, this.name, this.province_id).subscribe((canton : Canton) => {
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

}
