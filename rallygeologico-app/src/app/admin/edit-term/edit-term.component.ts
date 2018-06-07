import { Component, OnInit } from '@angular/core';
import {User} from "../../model/user";
import {Rally} from "../../model/rally";
import {Competition} from "../../model/competition";
import {DataService} from "../../services/data/data.service";
import {CompetitionService} from "../../services/competition.service";
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

  searchQuery : string = "";

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
  totalMultimedia : number;
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
  totalSites : number;
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
    this.termService.getTerms().subscribe((terms: Term[]) => {
      this.allTerms = terms;
      this.reloadTerms(this.allTerms);
      this.allMultimedia = [];
      this.multimediaService.getMultimedia().subscribe((multimedia: Multimedia[]) => {
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
    this.totalSites = Site.length;
    this.showedSites = sites.slice(0, this.pageSize);
    this.currentPageSite = 0;
  }

  reloadMultimedia(multimedia : Multimedia[]) : void{
    this.multimedia = multimedia;
    this.totalMultimedia = Site.length;
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
    this.siteService.getOtherSites(this.currentTerm.id).subscribe((otherSites: Site[]) => { //TODO Change this services because the use rallyId, not termId
      this.otherSites = otherSites;
      this.siteService.getAssociatedSites(this.currentTerm.id).subscribe((currentSites: Site[]) => { //TODO Change this services because the use rallyId, not termId
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




}
