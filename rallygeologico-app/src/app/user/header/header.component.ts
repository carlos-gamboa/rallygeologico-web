import {Component, Input, OnInit} from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

    @Input() activeTab: number;

  constructor() {
  }

  ngOnInit() {
  }

    async ngAfterViewInit() {
        await this.loadScript("../../../assets/js/jquery-2.2.4.min.js");
        await this.loadScript("../../../assets/js/superfish.min.js");
        await this.loadScript("../../../assets/js/jquery.magnific-popup.min.js");
        await this.loadScript("../../../assets/js/jquery.counterup.min.js");
        await this.loadScript("../../../assets/js/main.js");
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

    isActive(active){
        return (this.activeTab === active);
    }

    changeActive(active){
      this.activeTab = active;
    }

}
