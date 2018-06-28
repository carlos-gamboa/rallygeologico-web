import { Component, OnInit } from '@angular/core';
import {User} from "../../model/user";
import {District} from "../../model/district";
import {UserService} from "../../services/user.service";
import {Router} from "@angular/router";
import {DistrictService} from "../../services/district.service";
import {DataService} from "../../services/data/data.service";
import {Canton} from "../../model/canton";
import {CantonService} from "../../services/canton.service";

@Component({
  selector: 'app-edit-district',
  templateUrl: './edit-district.component.html',
  styleUrls: ['./edit-district.component.css']
})
export class EditDistrictComponent implements OnInit {

    readyToShow : boolean;
    districtSelected : boolean;
    changesSaved: boolean;
    deleted: boolean;
    newDistrict: boolean;
    messageType : boolean;

    searchQuery : string = "";
    alertMessage : string = "";

    user: User;
    pageSize : number = 10;
    activeTab : number;

    districts : District[];
    allDistricts : District[];
    showedDistricts : District[];
    totalDistricts : number;
    currentPageDistrict : number;


    currentDistrict : District;
    currentDistrictIndex: number;

    name: string;
    canton_id: number;

    allCantons : Canton[];

    constructor(private dataService: DataService,
                private districtService: DistrictService,
                private cantonService: CantonService,
                private router: Router,
                private userService : UserService) {
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
        this.districtService.getAllDistricts().subscribe((districts : District[]) => {
            console.log(districts);
            this.allDistricts = districts;
            this.reloadDistricts(this.allDistricts);
            this.allCantons = [];
            this.cantonService.selectallCantons().subscribe((cantons : Canton[]) => {
                this.allCantons = cantons;
                this.readyToShow = true;
            });
        });
    }

    /**
     *  This method reload all Districts showing in the page
     * @param {District[]} districts
     */
    reloadDistricts(districts : District[]) : void{
        this.districts = districts;
        this.totalDistricts = districts.length;
        this.showedDistricts = districts.slice(0, this.pageSize);
        this.currentPageDistrict = 0;
    }

    /**
     * This method search an specific District and show it in the page
     */
    searchDistrict(){
        let termsToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let district of this.allDistricts) {
                if (district.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    termsToShow.push(district);
                }
            }
            this.reloadDistricts(termsToShow);
        }else{
            this.reloadDistricts(this.allDistricts);
        }
    }

    /**
     * This method change the showed Districts in the table
     */
    districtPageChange() : void{
        if(this.districts) {
            this.showedDistricts = this.districts.slice((this.currentPageDistrict - 1) * this.pageSize, ((this.currentPageDistrict) * this.pageSize));
        }
    }

    /**
     * This method allows to delete an specific District when the delete button is pressed
     * @param {number} id
     * @param {number} i
     */
    deleteDistrict(id: number, i: number){
        this.deleted = false;
        this.changesSaved = false;
        this.districtService.deleteDistrict(id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.currentDistrict = null;
                this.allDistricts.splice(((this.currentPageDistrict - 1) * this.pageSize) + i, 1);
                this.messageType = true;
                this.alertMessage = "Se ha eliminado el distrito.";
                this.reloadDistricts(this.allDistricts);
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar el distrito.";
            }
        });
    }

    /**
     * This method allows to edit an specific District
     * @param {number} i
     */
    edit(i: number){
        this.readyToShow = false;
        this.activeTab = 0;
        this.districtSelected = true;
        this.changesSaved = false;
        this.deleted = false;
        if (i == -1){
            this.newDistrict = true;
            this.currentDistrict = null;
        } else {
            this.currentDistrict = this.showedDistricts[i];
            this.currentDistrictIndex = ((this.currentPageDistrict - 1) * this.pageSize) + i;
        }
        this.editCantonChange();
    }

    /**
     * This method allows to edit a District
     */
    editCantonChange(){
        if (!this.currentDistrict){
            this.name = "";
            this.canton_id = -1;
        } else {
            this.name = this.currentDistrict.name;
            this.canton_id = this.currentDistrict.canton_id;
        }
        this.readyToShow = true;
    }

    /**
     * This method set variables to default when user goes back in the menu
     */
    goBack(){
        this.districtSelected = false;
        this.currentDistrict = null;
        this.reloadDistricts(this.allDistricts);
    }

    /**
     * This method call web services to create or edit an specific District
     */
    saveChanges(){
        this.changesSaved = false;
        this.deleted = false;
        if (!this.currentDistrict){
            this.districtService.addDistrict(this.name, this.canton_id).subscribe((district : District) => {
                if (district){
                    this.currentDistrict = district;
                    this.allDistricts.push(this.currentDistrict);
                    this.changesSaved = true;
                    this.messageType = true;
                    this.newDistrict = false;
                    this.alertMessage = "El distrito ha sido creado.";
                } else {
                    this.messageType = false;
                    this.alertMessage = "No se pudo eliminar el distrito.";
                }
            });
        } else {
            this.districtService.editDistrict(this.currentDistrict.id, this.name, this.canton_id).subscribe((district : District) => {
                this.changesSaved = true;
                if (district){
                    this.currentDistrict = district;
                    this.allDistricts[this.currentDistrictIndex] = this.currentDistrict;
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
