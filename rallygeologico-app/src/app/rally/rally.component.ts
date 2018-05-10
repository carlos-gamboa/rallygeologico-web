import {Component, OnInit } from '@angular/core';
import {RallyService} from "../services/rally.service";
import {Rally} from "../model/rally";
import {Competition} from "../model/competition";
import {ActivatedRoute, Params, Router} from "@angular/router";
import {Site} from "../model/site";

@Component({
  selector: 'app-rally',
  templateUrl: './rally.component.html',
  styleUrls: ['./rally.component.css']
})
export class RallyComponent implements OnInit {

  zoom: number;

  rally: Rally;
  rallyId: number;
  paths: Array<any>;

  constructor(private rallyService: RallyService, private route: ActivatedRoute, private router: Router){
    this.zoom = 9;
  }

  ngOnInit() {
    this.route.params
        .subscribe(
            (params: Params) => {
              this.rallyId = this.route.snapshot.params['rallyId'];
              console.log("Rally Id = " + this.rallyId);
              this.rallyService.getRally(this.rallyId).subscribe((rally: Rally)=>{
                if (rally){
                   this.rally = rally;
                   //console.log("Rally "+JSON.stringify(this.rally));
                    for(let site of this.rally.site)
                    {
                        this.paths.push([{latitude: site.latitude, longitude: site.longitude}]);
                        //this.paths.push(site.latitude, site.longitude);
                    }
                } else {
                   this.router.navigate(['/dashboard']);
                }
              });
            }
            );
  }

}
