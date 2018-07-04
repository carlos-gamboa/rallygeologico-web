import { Component, OnInit } from '@angular/core';
import {Rally} from "../../model/rally";
import {DataService} from "../../services/data/data.service";
import {UserService} from "../../services/user.service";
import {RallyService} from "../../services/rally.service";
import {Router} from "@angular/router";
import {User} from "../../model/user";
import {Site} from "../../model/site";
import {SiteService} from "../../services/site.service";
import {NgForm} from "@angular/forms";

@Component({
  selector: 'app-edit-rally',
  templateUrl: './edit-rally.component.html',
  styleUrls: ['./edit-rally.component.css']
})
export class EditRallyComponent implements OnInit {

    user: User;

    readyToShow: boolean;
    activeTab: number;

    currentRally: Rally;
    rallySelected: boolean;
    rallyCreated: boolean;
    newRally: boolean;
    changesSaved: boolean;
    rallyDeleted: boolean;
    messageType: boolean;
    alertMessage: string;

    searchRallyQuery: string;
    rallies: Rally[];
    allRallies: Rally[];
    showedRallies: Rally[];
    totalRallies: number;
    currentPageRally: number;
    pageSize: number;
    currentRallyIndex: number;

    otherSites: Site[];
    currentSites: Site[];

    searchSiteQuery: string;
    sites: Site[];
    allSites: Site[];
    showedSites: Site[];
    totalSites: number;
    currentPageSite: number;
    pageSiteSize: number;
    currentSiteIndex: number;

    name: string;
    points: number;
    imageUrl: string;
    description: string;
    latitude: number;
    longitude: number;

    /**
     * Creates a EditRallyComponent
     *
     * @param {RallyService} rallyService
     * @param {SiteService} siteService
     * @param {UserService} userService
     * @param {DataService} dataService
     * @param {Router} router
     */
    constructor(private rallyService: RallyService, private siteService: SiteService, private userService: UserService,
              private dataService: DataService, private router: Router) {
        this.readyToShow = false;
        this.activeTab = -1;

        this.currentRally = null;
        this.rallySelected = false;
        this.rallyCreated = false;
        this.newRally = false;
        this.changesSaved = false;
        this.rallyDeleted = false;
        this.messageType = false;
        this.alertMessage = "";

        this.searchRallyQuery = "";
        this.rallies = [];
        this.allRallies = [];
        this.showedRallies = [];
        this.totalRallies = 0;
        this.currentPageRally = 0;
        this.pageSize = 10;
        this.currentRallyIndex = 0;

        this.otherSites = [];
        this.currentSites = [];

        this.searchSiteQuery = "";
        this.sites = [];
        this.allSites = [];
        this.showedSites = [];
        this.totalSites = 0;
        this.currentPageSite = 0;
        this.pageSiteSize = 10;
        this.currentSiteIndex = 0;

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
     * Loads rallies' information
     */
    setupData(){
        this.rallyService.getAllRallies().subscribe((rallies: Rally[]) => {
            this.allRallies = rallies;
            this.reloadRallies(this.allRallies);
        });
    }

    /**
     * Reloads rallies' information for the search table
     *
     * @param {Rally[]} rallies
     */
    reloadRallies(rallies: Rally[]){
        this.readyToShow = false;
        this.rallies = rallies;
        this.totalRallies = rallies.length;
        this.showedRallies = rallies.slice(0, this.pageSize);
        this.currentPageRally = 0;
        this.readyToShow = true;
    }

    /**
     * Manage page changing on the search table
     */
    rallyPageChange(){
        if(this.rallies) {
            this.showedRallies = this.rallies.slice((this.currentPageRally - 1) * this.pageSize, ((this.currentPageRally) * this.pageSize));
        }
    }

    /**
     * Searches a rally by name
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
     * Sets the rally in the position i of the rallies array or sets flags for a new one if i = -1
     *
     * @param {number} i
     */
    edit(i: number){
        this.readyToShow = false;
        this.activeTab = 0;
        this.rallySelected = true;
        this.changesSaved = false;
        if (i == -1){
            this.newRally = true;
            this.currentRally = null;
        } else {
            this.currentRally = this.showedRallies[i];
            this.currentRallyIndex = ((this.currentPageRally - 1) * this.pageSize) + i;
            this.editRallyChange();
        }
        this.readyToShow = true;
    }

    /**
     * Sets the known information about a chosen rally to edit it
     */
    editRallyChange(){
        if (this.currentRally) {
            this.name = this.currentRally.name;
            this.points = this.currentRally.points_awarded;
            this.latitude = this.currentRally.latitude;
            this.longitude = this.currentRally.longitude;
            this.imageUrl = this.currentRally.image_url;
            this.description = this.currentRally.description;
        }
    }

    /**
     * Saves the changes of an existent rally or adds a new one if it doesn't exist
     */
    saveChanges(form: NgForm) {
        if (!form.valid) {
            this.changesSaved = true;
            this.alertMessage = "No se pueden guardar los cambios.";
            this.messageType = false;
        } else {
            this.changesSaved = false;
            if (this.currentRally) {
                this.rallyService.editRally(this.currentRally.id, this.name, this.points, this.latitude, this.longitude, this.imageUrl, this.description).subscribe((rally: Rally) => {
                    if (rally) {
                        this.currentRally = rally;
                        this.allRallies[this.currentRallyIndex] = this.currentRally;
                        this.changesSaved = true;
                        this.messageType = true;
                        this.alertMessage = "Se han guardado los cambios.";
                    } else {
                        this.alertMessage = "No se pudo guardar los cambios.";
                        this.messageType = false;

                    }
                });
            }
            else {
                this.rallyService.addRally(this.name, this.points, this.latitude, this.longitude, this.imageUrl, this.description).subscribe((rally: Rally) => {
                    if (rally){
                        this.currentRally = rally;
                        this.allRallies.push(this.currentRally);
                        this.rallyCreated = true;
                        this.changesSaved = true;
                        this.newRally = false;
                        this.messageType = true;
                        this.alertMessage = "El rally ha sido creado.";
                    } else {
                        this.messageType = false;
                        this.alertMessage = "No se pudo crear el rally.";
                    }
                });
            }
        }
    }

    /**
     * Deletes the rally on the specified position of the rallies array
     *
     * @param {number} i
     */
    deleteRally(i: number){
        this.rallyDeleted = false;
        this.changesSaved = false;
        this.rallyService.getRally(this.showedRallies[i].id).subscribe((rally: Rally) => {
            this.currentRally = rally;
            this.currentRallyIndex = ((this.currentPageRally - 1) * this.pageSize) + i;
            this.rallyService.deleteRally(this.currentRally.id).subscribe((deleted: boolean) => {
                this.rallyDeleted = deleted;
                if (deleted){
                    this.currentRally = null;
                    this.allRallies.splice(this.currentRallyIndex, 1);
                    this.reloadRallies(this.allRallies);
                    this.messageType = true;
                    this.alertMessage = "Se ha eliminado el rally.";
                } else {
                    this.messageType = false;
                    this.alertMessage = "No se pudo eliminar el rally.";
                }
            });
        });
    }

    /**
     * Reloads flags and rallies information
     */
    goBack(){
        this.currentRally = null;
        this.rallySelected = false;
        this.rallyCreated = false;
        this.changesSaved = false;
        this.rallyDeleted = false;
        this.reloadRallies(this.allRallies);
        this.name = "";
        this.points = 0;
        this.latitude = 0;
        this.longitude = 0;
        this.imageUrl = "";
        this.description = "";
    }

    /**
     * Changes the information on screen depending on the selected tab
     * @param {number} i
     */
    changeTab(i: number){
        this.activeTab = i;
        this.changesSaved = false;
        if (i == 1){
            this.totalSites = 0;
            this.currentPageSite = 0;
            this.pageSiteSize = 10;
            this.currentSiteIndex = 0;
            this.updateSites();
      }
    }

    /**
     * Loads all sites'information
     */
    updateSites(){
        this.allSites = [];
        this.siteService.getOtherSites(this.currentRally.id).subscribe((otherSites: Site[]) => {
            this.otherSites = otherSites;
            console.log(this.otherSites);
            this.siteService.getAssociatedSites(this.currentRally.id).subscribe((currentSites: Site[]) => {
                this.currentSites = currentSites;
                console.log(this.currentSites);
                for(let site of this.otherSites){
                    this.allSites.push(site);
                }
                for(let site of this.currentSites){
                    this.allSites.push(site);
                }
                this.reloadSites(this.allSites);
            });
        });
    }

    /**
     * Reloads sites'information for the search table
     * @param {Site[]} sites
     */
    reloadSites(sites: Site[]){
        this.readyToShow = false;
        this.sites = sites;
        this.totalSites =  sites.length;
        this.showedSites = sites.slice(0, this.pageSiteSize);
        this.currentPageSite = 0;
        this.readyToShow = true;
    }

    /**
     * Manage page changing on the search table
     */
    sitePageChange(){
        if(this.sites) {
            this.showedSites = this.sites.slice((this.currentPageSite - 1) * this.pageSiteSize, ((this.currentPageSite) * this.pageSiteSize));
        }
    }

    /**
     * Searches a site by name
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

    /**
     * Returns if the specified site is actually part of the current rally
     *
     * @param {Site} site
     * @returns {boolean}
     */
    belongsTo(id: number): boolean{
        for(let currentSite of this.currentSites){
            if (id == currentSite.id){
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
        this.currentSiteIndex = ((this.currentPageSite - 1) * this.pageSiteSize) + i;
        this.rallyService.addRallySite(this.currentRally.id, this.showedSites[i].id).subscribe((site: Site) =>{
            if(site){
                this.updateSites();
                this.reloadSites(this.allSites);
            }
        });
    }

    /**
     * Deletes the rallySite relation between the current rally and the site on the specified position
     *
     * @param {number} i
     */
    deleteRallySite(i: number){
        this.currentSiteIndex = ((this.currentPageSite - 1) * this.pageSiteSize) + i;
        this.rallyService.getRallySite(this.currentRally.id, this.showedSites[i].id).subscribe((id: number) => {
            this.rallyService.deleteRallySite(id).subscribe((deleted: boolean) => {
                if (deleted) {
                    this.updateSites();
                    this.reloadSites(this.allSites);
                }
            });
        });
    }
}
