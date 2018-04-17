import { Component, OnInit } from '@angular/core';
require("../../assets/js/jquery-2.2.4.min.js");
require("../../assets/js/superfish.min.js");
require("../../assets/js/jquery.magnific-popup.min.js");
require("../../assets/js/jquery.counterup.min.js");
require("../../assets/js/main.js");

@Component({
  selector: 'app-public-header',
  templateUrl: './public-header.component.html',
  styleUrls: ['./public-header.component.css']
})
export class PublicHeaderComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

    async ngAfterViewInit() {
        await this.loadScript("../../assets/js/jquery-2.2.4.min.js");
        await this.loadScript("../../assets/js/superfish.min.js");
        await this.loadScript("../../assets/js/jquery.magnific-popup.min.js");
        await this.loadScript("../../assets/js/jquery.counterup.min.js");
        await this.loadScript("../../assets/js/main.js");
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
