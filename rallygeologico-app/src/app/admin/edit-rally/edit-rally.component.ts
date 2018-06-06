import { Component, OnInit } from '@angular/core';
import {Rally} from "../../model/rally";
import {DataService} from "../../services/data/data.service";
import {UserService} from "../../services/user.service";
import {RallyService} from "../../services/rally.service";
import {Router} from "@angular/router";
import {User} from "../../model/user";
import {Site} from "../../model/site";
import {SiteService} from "../../services/site.service";

@Component({
  selector: 'app-edit-rally',
  templateUrl: './edit-rally.component.html',
  styleUrls: ['./edit-rally.component.css']
})
export class EditRallyComponent implements OnInit {

  readyToShow: boolean;
  user: User;
  activeTab: number;
  rallySelected: boolean;
  rallyCreated: boolean;

  searchRallyQuery: string;
  ralliesList: Rally[];
  allRallies: Rally[];
  showedRallies: Rally[];

  totalRallies: number;
  currentPageRally: number;
  pageSize: number;
  currentRallyIndex: number;

  otherSites: Site[];
  currentSites: Site[];
  allSites: Site[];
  searchSiteQuery: string;
  searchedSites: Site[];
  showedSites: Site[];

  totalSites: number;
  currentPageSite: number;
  pageSiteSize: number;

  name: string;
  points: number;
  imageUrl: string;
  description: string;
  latitude: number;
  longitude: number;

  currentRally: Rally;
  newRally: boolean;
  changesSaved: boolean;
  messageType: boolean;
  alertMessage: string;
  rallyDeleted: boolean;

  constructor(private rallyService: RallyService, private siteService: SiteService, private userService: UserService,
              private dataService: DataService, private router: Router) {
    this.readyToShow = false;
    this.rallySelected = false;
    this.activeTab = -1;
    this.totalRallies = 0;
    this.currentPageRally = 0;
    this.pageSize = 10;
    this.totalSites = 0;
    this.currentPageSite = 0;
    this.pageSiteSize = 10;
    this.newRally = false;
    this.changesSaved = false;
    this.messageType = false;
    this.rallyDeleted = false;
    this.allSites = [];
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
          this.allRallies = rallies;
          this.reloadRallies(this.allRallies);
          this.readyToShow = true;
          this.rallySelected = false;
      });
  }

  reloadRallies(rallies: Rally[]){
      this.ralliesList = rallies;
      this.totalRallies = rallies.length;
      this.showedRallies = rallies.slice(0, this.pageSize);
      this.currentPageRally = 0;
  }

  rallyPageChange(){
      if(this.ralliesList) {
          this.showedRallies = this.ralliesList.slice((this.currentPageRally - 1) * this.pageSize, ((this.currentPageRally) * this.pageSize));
      }
  }

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

  goBack(){
      this.rallySelected = false;
      this.currentRally = null;
      this.reloadRallies(this.allRallies);
      this.name = "";
      this.points = 0;
      this.latitude = 0;
      this.longitude = 0;
      this.imageUrl = "";
      this.description = "";
  }

  changeTab(i: number){
      this.activeTab = i;
      this.changesSaved = false;
      this.rallyDeleted = false;
      if (i == 1){
          this.siteService.getOtherSites(this.currentRally.id).subscribe((sites: Site[]) => {
              this.otherSites = sites;
              this.siteService.getAssociatedSites(this.currentRally.id).subscribe((sites: Site[]) => {
                  this.currentSites = sites;
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
  }

  edit(i: number){
      this.readyToShow = false;
      this.activeTab = 0;
      this.rallySelected = true;
      this.changesSaved = false;
      this.rallyDeleted = false;
      if (i == -1){
          this.newRally = true;
          this.currentRally = null;
      } else {
          this.rallyService.getRally(this.showedRallies[i].id).subscribe((rally: Rally) => {
              this.currentRally = rally;
              this.currentRallyIndex = ((this.currentPageRally - 1) * this.pageSize) + i;
              this.editRallyChange();
          });
          //this.updateStatistics();
      }
      this.readyToShow = true;
  }

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

  saveChanges(){
      this.changesSaved = false;
      this.rallyDeleted = false;
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
                  this.messageType = true;
                  this.alertMessage = "Se ha eliminado el rally.";
              } else {
                  this.messageType = false;
                  this.alertMessage = "No se pudo eliminar el rally.";
              }
          });
      });
  }

    reloadSites(sites: Site[]){
        this.searchedSites = sites;
        this.totalSites =  sites.length;
        this.showedSites = sites.slice(0, this.pageSiteSize);
        this.currentPageSite = 0;
    }

    sitePageChange(){
        if(this.searchedSites) {
            this.showedSites = this.searchedSites.slice((this.currentPageSite - 1) * this.pageSiteSize, ((this.currentPageSite) * this.pageSiteSize));
        }
    }

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

  addRallySite(site: Site){
      this.rallyService.addRallySite(this.currentRally.id, site.id).subscribe((site: Site) =>{
         if(site){
             this.messageType = true;
             this.alertMessage = "Se ha agregado el sitio al rally.";
         }
         else {
             this.messageType = false;
             this.alertMessage = "No se pudo eliminar el sitio del rally.";
         }
      });
  }

  deleteRallySite(site: Site){
      this.rallyService.getRallySite(this.currentRally.id, site.id).subscribe((id: number) => {
          this.rallyService.deleteRallySite(id).subscribe((deleted: boolean) => {
              if (deleted){
                  this.messageType = true;
                  this.alertMessage = "Se ha eliminado el sitio.";
              } else {
                  this.messageType = false;
                  this.alertMessage = "No se pudo eliminar el sitio.";
              }
          });
      });
  }
}
