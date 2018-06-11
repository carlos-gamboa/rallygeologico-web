import { Component } from '@angular/core';
import {environment} from "../../environments/environment";

@Component({
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent{

    assetsUrl: string;

    constructor(){
        this.assetsUrl = environment.assetsUrl;
    }

    async ngAfterViewInit() {
        await this.loadScript(this.assetsUrl + "../assets/js/jquery-2.2.4.min.js");
        await this.loadScript(this.assetsUrl + "../assets/js/superfish.min.js");
        await this.loadScript(this.assetsUrl + "../assets/js/jquery.magnific-popup.min.js");
        await this.loadScript(this.assetsUrl + "../assets/js/jquery.counterup.min.js");
        await this.loadScript(this.assetsUrl + "../assets/js/main.js");
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
