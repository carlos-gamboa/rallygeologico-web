import {Component, Input, OnInit} from '@angular/core';
import {environment} from "../../environments/environment";

@Component({
  selector: 'app-public-header',
  templateUrl: './public-header.component.html',
  styleUrls: ['./public-header.component.css']
})
export class PublicHeaderComponent implements OnInit {

    @Input() activeTab: number;
    assetsUrl: string;

    constructor() {
        this.assetsUrl = environment.assetsUrl;
    }

    ngOnInit() {

    }

    isActive(active){
        return (this.activeTab === active);
    }

    changeActive(active){
        this.activeTab = active;
    }

}
