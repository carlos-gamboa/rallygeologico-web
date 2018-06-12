import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params, Router} from "@angular/router";
import {Site} from "../model/site";
import {SiteService} from "../services/site.service";
import {User} from "../model/user";
import {UserService} from "../services/user.service";
import {DataService} from "../services/data/data.service";

@Component({
  selector: 'app-site',
  templateUrl: './site.component.html',
  styleUrls: ['./site.component.css']
})
export class SiteComponent implements OnInit {

  site: Site;
  siteId: number;

  user: User;

  constructor(private dataService: DataService, private userService: UserService, private siteService: SiteService, private route: ActivatedRoute, private router: Router) { }

  ngOnInit() {
      this.user = this.dataService.getUser();
      if (!this.user) {
          this.userService.isLoggedIn().subscribe((users: User) => {
              if (users[0]) {
                  this.dataService.updateUser(users[0]);
                  this.user = users[0];
                  this.setupData();
              }
          });
      } else {
          this.setupData();
      }
  }

  setupData(){
      this.route.params.subscribe((params: Params) => {
          this.siteId = this.route.snapshot.params['siteId'];
          console.log("Site Id = " + this.siteId);
          this.siteService.getSite(this.siteId).subscribe((site: Site)=>{
              if (site){
                  this.site = site;
                  //console.log("Site "+JSON.stringify(this.site));
              } else {
                  if (this.user){
                      this.router.navigate(['/dashboard']);
                  } else {
                      this.router.navigate(['/landing']);
                  }
              }
          });
      });
  }

}
