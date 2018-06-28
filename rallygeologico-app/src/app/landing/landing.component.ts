import { Component, OnInit } from '@angular/core';
import {Rally} from "../model/rally";
import {RallyService} from "../services/rally.service";
import {environment} from "../../environments/environment";

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.css']
})
export class LandingComponent implements OnInit {

  newestRallies: Rally[] = [];
  assetsUrl: string;

  constructor(private rallyService: RallyService) {
      this.assetsUrl = environment.assetsUrl;
      this.rallyService.getNewestRallies().subscribe((rallies: Rally[])=>{
        for (let i: number = 0; i < 2; ++i){
            this.newestRallies.push(rallies[i]);
        }
        console.log(this.newestRallies);
      });
  }

  ngOnInit() {
  }

}
