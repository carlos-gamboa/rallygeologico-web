import { Component, OnInit } from '@angular/core';
import {Rally} from "../model/rally";
import {RallyService} from "../services/rally.service";

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.css']
})
export class LandingComponent implements OnInit {

  newestRallies: Rally[] = [];

  constructor(private rallyService: RallyService) {
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
