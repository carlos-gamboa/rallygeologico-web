import { Component, OnInit } from '@angular/core';
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {Router} from "@angular/router";
import {UserService} from "../../services/user.service";
import {Term} from "../../model/term";
import {TermService} from "../../services/term.service";
import {MultimediaService} from "../../services/multimedia.service";
import {Multimedia} from "../../model/multimedia";
import {Site} from "../../model/site";
import {SiteService} from "../../services/site.service";

@Component({
  selector: 'app-edit-term',
  templateUrl: './edit-term.component.html',
  styleUrls: ['./edit-term.component.css']
})
export class EditTermComponent implements OnInit {

  readyToShow : boolean;
  termSelected : boolean;
  changesSaved: boolean;
  deleted: boolean;
  newTerm: boolean;
  messageType : boolean;

  searchQuery : string = "";
  searchSiteQuery : string = "";
  alertMessage : string = "";
  searchMultimediaQuery = "";

  user: User;
  pageSize : number = 10;
  activeTab : number;

  terms : Term[];
  allTerms : Term[];
  showedTerms : Term[];
  totalTerms : number;
  currentPageTerm : number;
  currentPageSite : number;
  currentPageMultimedia : number;

  multimedia : Multimedia[];
  allMultimedia : Multimedia[];
  totalMultimedia : number = 0;
  otherMultimedia: Multimedia[];
  currentMultimedia : Multimedia[];
  showedMultimedia : Multimedia[];


  currentTerm : Term;
  currentTermIndex: number;

  name: string;
  description: string;



  sites : Site[];
  allSites : Site[];
  showedSites : Site[];
  totalSites : number = 0;
  otherSites : Site[];
  currentSites : Site[];

  constructor(private dataService: DataService,
              private termService: TermService,
              private router: Router,
              private userService : UserService,
              private multimediaService : MultimediaService,
              private siteService : SiteService) {
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
    this.termService.getAllTerms(1).subscribe((terms: Term[]) => {
      console.log(terms);
      this.allTerms = terms;
      this.reloadTerms(this.allTerms);
      this.allMultimedia = [];
      this.multimediaService.getAllMultimedia().subscribe((multimedia: Multimedia[]) => {
        this.allMultimedia = multimedia;
        this.siteService.getSites().subscribe((sites: Site[]) => {
          this.allSites = sites;
          this.termSelected = false;
          this.readyToShow = true;
        });
      });
    });
  }


  reloadTerms(terms : Term[]) : void{
    this.terms = terms;
    this.totalTerms = terms.length;
    this.showedTerms = terms.slice(0, this.pageSize);
    this.currentPageTerm = 0;
  }

  reloadSites(sites : Site[]) : void{
    this.sites = sites;
    this.totalSites = sites.length;
    this.showedSites = sites.slice(0, this.pageSize);
    this.currentPageSite = 0;
  }

  reloadMultimedia(multimedia : Multimedia[]) : void{
    this.multimedia = multimedia;
    this.totalMultimedia = multimedia.length;
    this.showedMultimedia = multimedia.slice(0, this.pageSize);
    this.currentPageMultimedia = 0;
  }

  searchTerm(){
    let termsToShow = [];
    if(this.searchQuery.length >= 1) {
      for (let term of this.allTerms) {
        if (term.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
          termsToShow.push(term);
        }
      }
      this.reloadTerms(termsToShow);
    }else{
      this.reloadTerms(this.allTerms);
    }
  }

  termPageChange() : void{
    if(this.terms) {
      this.showedTerms = this.terms.slice((this.currentPageTerm - 1) * this.pageSize, ((this.currentPageTerm) * this.pageSize));
    }
  }

  sitePageChange() : void{
    if(this.sites) {
        this.showedSites = this.sites.slice((this.currentPageSite - 1) * this.pageSize, ((this.currentPageSite) * this.pageSize));
    }
  }

  multimediaPageChange() : void{
    if(this.multimedia) {
        this.showedMultimedia = this.multimedia.slice((this.currentPageMultimedia - 1) * this.pageSize, ((this.currentPageMultimedia) * this.pageSize));
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

  searchMultimedia(){
    let multimediaToShow = [];
    if(this.searchMultimediaQuery.length >= 1) {
        for (let multimedia of this.allMultimedia) {
            if (multimedia.name.toLowerCase().startsWith(this.searchMultimediaQuery.toLowerCase())) {
                multimediaToShow.push(multimedia);
            }
        }
        this.reloadMultimedia(multimediaToShow);
    }else{
        this.reloadMultimedia(this.allMultimedia);
    }
}


  deleteTerm(id: number, i: number){
    this.deleted = false;
    this.changesSaved = false;
    this.termService.deleteTerm(id).subscribe((deleted: boolean) => {
      this.deleted = true;
      if (deleted){
        this.currentTerm = null;
        this.allTerms.splice(((this.currentPageTerm - 1) * this.pageSize) + i, 1);
        this.messageType = true;
        this.alertMessage = "Se ha eliminado el término.";
        this.reloadTerms(this.allTerms);
      } else {
        this.messageType = false;
        this.alertMessage = "No se pudo eliminar el término.";
      }
    });
  }


  edit(i: number){
    this.readyToShow = false;
    this.activeTab = 0;
    this.termSelected = true;
    this.changesSaved = false;
    this.deleted = false;
    if (i == -1){
      this.newTerm = true;
      this.currentTerm = null;
    } else {
      this.currentTerm = this.showedTerms[i];
      this.currentTermIndex = ((this.currentPageTerm - 1) * this.pageSize) + i;
    }
    this.editTermChange();
  }

  editTermChange(){
    if (!this.currentTerm){
      this.name = "";
      this.description = "";
    } else {
      this.name = this.currentTerm.name;
      this.description = this.currentTerm.description;
    }
    this.readyToShow = true;
  }

  goBack(){
    this.termSelected = false;
    this.currentTerm = null;
    this.reloadTerms(this.allTerms);
  }

  changeTab(i: number){
    this.activeTab = i;
    this.changesSaved = false;
    this.deleted = false;
    if (i == 1){
      this.updateSites();
    }
    else if (i == 2){
      this.updateMultimedia();
    }
  }

  updateSites(){
    this.allSites = [];
    this.siteService.getOtherSitesFromTerm(this.currentTerm.id).subscribe((otherSites: Site[]) => {
      this.otherSites = otherSites;
      this.siteService.getAssociatedSitesFromTerm(this.currentTerm.id).subscribe((currentSites: Site[]) => {
        this.currentSites = currentSites;
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

  updateMultimedia(){
    this.allMultimedia = [];
    this.multimediaService.getOtherMultimedia(this.currentTerm.id).subscribe((otherMultimedia: Multimedia[]) => {
      this.otherMultimedia = otherMultimedia;
      this.multimediaService.getAssociatedMultimedia(this.currentTerm.id).subscribe((currentMultimedia: Multimedia[]) => {
        this.currentMultimedia = currentMultimedia;
        for(let multimedia of this.otherMultimedia){
          this.allMultimedia.push(multimedia);
        }
        for(let multimedia of this.currentMultimedia){
          this.allMultimedia.push(multimedia);
        }
        this.reloadMultimedia(this.allMultimedia);

      });
    });
  }

  saveChanges(){
    this.changesSaved = false;
    this.deleted = false;
    if (!this.currentTerm){
      this.termService.addTerm(this.name, this.description).subscribe((term: Term) => {
        if (term){
          this.currentTerm = term;
          this.allTerms.push(this.currentTerm);
          this.changesSaved = true;
          this.messageType = true;
          this.newTerm = false;
          this.alertMessage = "El término ha sido creado.";
        } else {
          this.messageType = false;
          this.alertMessage = "No se pudo eliminar el término.";
        }
      });
    } else {
      this.termService.editTerm(this.currentTerm.id, this.name, this.description).subscribe((term: Term) => {
        this.changesSaved = true;
        if (term){
          this.currentTerm = term;
          this.allTerms[this.currentTermIndex] = this.currentTerm;
          this.messageType = true;
          this.alertMessage = "Se han guardado los cambios.";
        } else {
          this.alertMessage = "No se pudo guardar los cambios.";
          this.messageType = false;
        }
      });
    }
  }

  /**
   * Returns if the specified site is actually part of the current term
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
   * Adds a termSite relation between the current term and the site on the specified position
   *
   * @param {number} i
   */
  addTermSite(i : number){
    this.changesSaved = false;
    this.termService.addTermSite(this.currentTerm.id,i).subscribe((term: Term) =>{
      this.changesSaved = true;
      if(term){
        this.updateSites();
        this.reloadSites(this.allSites);
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
  deleteTermSite(i: number){
    this.changesSaved = false;
    this.termService.getTermSite(this.currentTerm.id, i).subscribe((id: number) => {
      this.termService.deleteTermSite(id).subscribe((deleted: boolean) => {
        this.changesSaved = true;
        if (deleted) {
          this.updateSites();
          this.reloadSites(this.allSites);
          this.messageType = true;
          this.alertMessage = "Se ha eliminado el sitio del rally seleccionado."
        } else {
          this.messageType = false;
          this.alertMessage = "No se pudo eliminal el sitio del rally seleccionado."
        }
      });
    });
  }

    /**
     * Returns if the specified site is actually part of the current term
     *
     * @param {Multimedia} multimedia
     * @returns {boolean}
     */
    multimediaBelongsTo(id: number): boolean{
        for(let currentMultimedia of this.currentMultimedia){
            if (id == currentMultimedia.id){
                return true;
            }
        }
        return false;
    }

    /**
     * Adds a termMultimedia relation between the current term and the site on the specified position
     *
     * @param {number} i
     */
    addTermMultimedia(i : number){
        this.changesSaved = false;
        this.termService.addTermMultimedia(this.currentTerm.id, i).subscribe((term: Term) =>{
            this.changesSaved = true;
            if(term){
                this.updateMultimedia();
                this.reloadMultimedia(this.allMultimedia);
                this.messageType = true;
                this.alertMessage = "Se ha agregado el sitio al rally seleccionado."
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo agregar el sitio al rally seleccionado."
            }
        });
    }

    /**
     * Deletes the termMultimedia relation between the current rally and the site on the specified position
     *
     * @param {number} i
     */
    deleteTermMultimedia(i: number){
      this.changesSaved = false;
      this.termService.getTermMultimedia(this.currentTerm.id, i).subscribe((id: number) => {
        this.termService.deleteTermMultimedia(id).subscribe((deleted: boolean) => {
          this.changesSaved = true;
          if (deleted) {
            this.updateMultimedia();
            this.reloadMultimedia(this.allMultimedia);
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
