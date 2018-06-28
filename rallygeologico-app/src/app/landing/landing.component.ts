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

    async ngAfterViewInit() {
        await this.loadScript(this.assetsUrl+"assets/js/jquery-2.2.4.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/superfish.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.magnific-popup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.counterup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/main.js");
    }

    private loadScript(scriptUrl: string) {
        return new Promise((resolve, reject) => {
            const scriptElement = document.createElement('script');
            scriptElement.src = scriptUrl;
            scriptElement.type = "text/javascript";
            scriptElement.onload = resolve;
            document.body.appendChild(scriptElement);
        })
    }

}
