import { Component, OnInit } from '@angular/core';
import { DatePipe } from '@angular/common';
import {Rally} from "../../model/rally";
import {User} from "../../model/user";
import {UserService} from "../../services/user.service";
import {RallyService} from "../../services/rally.service";
import {Router} from "@angular/router";
import {DataService} from "../../services/data/data.service";
import {District} from "../../model/district";
import {Site} from "../../model/site";
import {SiteService} from "../../services/site.service";
import {DistrictService} from "../../services/district.service";

@Component({
    selector: 'app-edit-site',
    templateUrl: './edit-site.component.html',
    styleUrls: ['./edit-site.component.css'],
    providers: [ DatePipe ]
})
export class EditSiteComponent implements OnInit {

    districtList: District[];

    sites: Site[];
    allSites: Site[];
    showedSites: Site[];

    user: User;

    rallies: Rally[];
    allRallies: Rally[];
    showedRallies: Rally[];

    currentRallies: Rally[];
    otherRallies: Rally[];

    pageSize : number = 10;
    currentPageSite : number = 0;
    totalSite : number = 0;
    totalRallies : number = 0;
    currentPageRallies: number = 0;

    searchSiteQuery : string = "";
    searchRallyQuery : string = "";

    currentSite: Site;
    currentSiteIndex: number;

    name: string;
    qr_url: string;
    details: string;
    description: string;
    latitude: string;
    longitude: string;
    district_id: string;
    points: string;
    is_easter_egg: string;

    changesSaved: boolean;
    deleted: boolean;
    alertMessage: string;
    messageType: boolean;

    newSite: boolean;
    siteSelected: boolean;
    readyToShow: boolean;
    activeTab: number;

    constructor(private rallyService: RallyService, private siteService: SiteService,
                private dataService: DataService, private districtService: DistrictService,
                private router: Router, private dataPipe: DatePipe, private userService: UserService) {
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
        this.districtService.getAllDistricts().subscribe((districts: District[]) => {
            this.districtList = districts;
            this.siteService.getAllSites().subscribe((sites: Site[]) => {
                this.allSites = sites;
                this.reloadSites(this.allSites);
                this.siteSelected = false;
                this.readyToShow = true;
            });
        });
    }

    /**
     * Reloads the corresponding rallies in the table
     * @param {Rally[]} rallies
     */
    reloadRallies(rallies : Rally[]) : void{
        this.rallies = rallies;
        this.totalRallies = rallies.length;
        this.showedRallies = rallies.slice(0, this.pageSize);
        this.currentPageRallies = 0;
    }

    /**
     * Selects the number of rally's pages
     */
    rallyPageChange() : void{
        if(this.rallies) {
            this.showedRallies = this.rallies.slice((this.currentPageRallies - 1) * this.pageSize, ((this.currentPageRallies) * this.pageSize));
        }
    }

    /**
     * Searches a specified rally
     */
    searchRally(){
        let ralliesToShow = [];
        if(this.searchRallyQuery.length >= 1) {
            for (let rally of this.allRallies) {
                if (rally.name.toLowerCase().startsWith(this.searchRallyQuery.toLowerCase())) {
                    ralliesToShow.push(rally);
                }
            }
            this.reloadRallies(ralliesToShow);
        }else{
            this.reloadRallies(this.allRallies);
        }
    }

    /**
     * Reloads the corresponding site in the table
     * @param {Site[]} sites
     */
    reloadSites(sites : Site[]) : void{
        this.sites = sites;
        this.totalSite = sites.length;
        this.showedSites = sites.slice(0, this.pageSize);
        this.currentPageSite = 0;
    }

    /**
     * Selects the number of site' pages
     */
    sitePageChange() : void{
        if(this.sites) {
            this.showedSites = this.sites.slice((this.currentPageSite - 1) * this.pageSize, ((this.currentPageSite) * this.pageSize));
        }
    }

    /**
     * Searches a specified site
     */
    searchSite(){
        let sitesToShow = [];
        if(this.searchSiteQuery.length >= 1) {
            for (let site of this.allSites) {
                if (site.name.toLowerCase().startsWith(this.searchSiteQuery.toLowerCase())) {
                    sitesToShow.push(site);
                }
            }
            this.reloadSites(sitesToShow);
        }else{
            this.reloadSites(this.allSites);
        }
    }

    saveChanges(){
        this.changesSaved = false;
        this.deleted = false;
        if (!this.currentSite){
                this.siteService.addSite(this.name, this.qr_url, this.details, this.description,
                this.latitude, this.longitude, this.district_id, this.points, this.is_easter_egg).subscribe((site: Site) => {
                if (site){
                    this.currentSite = site;
                    this.allSites.push(this.currentSite);
                    this.changesSaved = true;
                    this.messageType = true;
                    this.newSite = false;
                    this.alertMessage = "El sitio ha sido creado.";
                } else {
                    this.messageType = false;
                    this.alertMessage = "No se pudo crear el sitio.";
                }
            });
        } else {
            this.siteService.editSite(this.currentSite.id, this.name, this.qr_url, this.details, this.description,
                this.latitude, this.longitude, this.district_id, this.points, this.is_easter_egg).subscribe((site: Site) => {
                this.changesSaved = true;
                if (site){
                    this.currentSite = site;
                    this.allSites[this.currentSiteIndex] = this.currentSite;
                    this.messageType = true;
                    this.alertMessage = "Se han guardado los cambios.";
                } else {
                    this.alertMessage = "No se pudo guardar los cambios.";
                    this.messageType = false;

                }
            });
        }
    }

    editSiteChange(){
        if (!this.currentSite){
            this.name = "";
            this.qr_url = "";
            this.details = "";
            this.description = "";
            this.latitude = "";
            this.longitude = "";
            this.district_id = "1";
            this.points = "0";
            this.is_easter_egg = "0";
        } else {
            this.name = this.currentSite.name;
            this.qr_url = this.currentSite.qr_url;
            this.details = this.currentSite.details;
            this.description = this.currentSite.description;
            this.latitude = this.currentSite.latitude.toString();
            this.longitude = this.currentSite.longitude.toString();
            this.district_id = this.currentSite.district_id;
            this.points = this.currentSite.points.toString();
            this.is_easter_egg = this.currentSite.is_easter_egg;
        }
        this.readyToShow = true;
    }

    edit(i: number){
        this.readyToShow = false;
        this.activeTab = 0;
        this.siteSelected = true;
        this.changesSaved = false;
        this.deleted = false;
        if (i == -1){
            this.newSite = true;
            this.currentSite = null;
        } else {
            this.currentSite = this.showedSites[i];
            this.currentSiteIndex = ((this.currentPageSite - 1) * this.pageSize) + i;
        }
        this.editSiteChange();
    }

    changeTab(i: number){
        this.activeTab = i;
        this.changesSaved = false;
        this.deleted = false;
        if (i == 1){
            this.updateRallies();
        }
    }

    goBack(){
        this.siteSelected = false;
        this.currentSite = null;
        this.reloadSites(this.allSites);
    }

    deleteSite(id: number, i: number){
        this.deleted = false;
        this.changesSaved = false;
        this.siteService.deleteSite(id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.currentSite = null;
                this.allSites.splice(((this.currentPageSite - 1) * this.pageSize) + i, 1);
                this.messageType = true;
                this.alertMessage = "Se ha eliminado la competencia.";
                this.reloadSites(this.allSites);
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar la competencia.";
            }
        });
    }

    /**
     * Loads all sites'information
     */
    updateRallies(){
        this.allRallies = [];
        this.rallyService.getOtherRallies(this.currentSite.id).subscribe((otherRallies: Rally[]) => {
            this.otherRallies = otherRallies;
            this.rallyService.getAssociatedRallies(this.currentSite.id).subscribe((currentRallies: Rally[]) => {
                this.currentRallies = currentRallies;
                for(let rally of this.otherRallies){
                    this.allRallies.push(rally);
                }
                for(let rally of this.currentRallies){
                    this.allRallies.push(rally);
                }
                this.reloadRallies(this.allRallies);
            });
        });
    }

    /**
     * Returns if the specified site is actually part of the current rally
     *
     * @param {Rally} rally
     * @returns {boolean}
     */
    belongsTo(id: number): boolean{
        for(let currentRally of this.currentRallies){
            if (id == currentRally.id){
                return true;
            }
        }
        return false;
    }

    /**
     * Adds a rallySite relation between the current rally and the site on the specified position
     *
     * @param {number} i
     */
    addRallySite(i : number){
        this.changesSaved = false;
        this.rallyService.addRallySite(i, this.currentSite.id).subscribe((site: Site) =>{
            this.changesSaved = true;
            if(site){
                this.updateRallies();
                this.reloadRallies(this.allRallies);
                this.messageType = true;
                this.alertMessage = "Se ha agregado el sitio al rally seleccionado."
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo agregar el sitio al rally seleccionado."
            }
        });
    }

    /**
     * Deletes the rallySite relation between the current rally and the site on the specified position
     *
     * @param {number} i
     */
    deleteRallySite(i: number){
        this.changesSaved = false;
        this.rallyService.getRallySite(i, this.currentSite.id).subscribe((id: number) => {
            this.rallyService.deleteRallySite(id).subscribe((deleted: boolean) => {
                this.changesSaved = true;
                if (deleted) {
                    this.updateRallies();
                    this.reloadRallies(this.allRallies);
                    this.messageType = true;
                    this.alertMessage = "Se ha eliminado el sitio del rally seleccionado."
                } else {
                    this.messageType = false;
                    this.alertMessage = "No se pudo eliminal el sitio del rally seleccionado."
                }
            });
        });
    }

}
