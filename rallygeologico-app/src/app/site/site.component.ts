import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params, Router} from "@angular/router";
import {Site} from "../model/site";
import {SiteService} from "../services/site.service";

@Component({
  selector: 'app-site',
  templateUrl: './site.component.html',
  styleUrls: ['./site.component.css']
})
export class SiteComponent implements OnInit {

  site: Site;
  siteId: number;

  constructor(private siteService: SiteService, private route: ActivatedRoute, private router: Router) { }

  ngOnInit() {
      this.route.params
          .subscribe(
              (params: Params) => {
                  this.siteId = this.route.snapshot.params['siteId'];
                  console.log("Site Id = " + this.siteId);
                  this.siteService.getSite(this.siteId).subscribe((site: Site)=>{
                      if (site){
                          this.site = site;
                          console.log("Site "+JSON.stringify(this.site));
                      } else {
                          this.router.navigate(['/dashboard']);
                      }
                  });
              }
          );
  }

}
