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

  searchQuery : string = "";

  user: User;
  pageSize : number = 10;

  terms : Term[];
  allTerms : Term[];
  showedTerms : Term[];
  totalTerms : number;
  currentPageTerm : number;

  media : Multimedia[];
  allMedia : Multimedia[];
  totalMedia : number;

  sites : Site[];
  allSites : Site[];
  totalSites : number;

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
      this.allMedia = [];
      this.multimediaService.getMultimedia().subscribe((multimedia: Multimedia[]) => {
        this.allMedia = multimedia;
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


}
