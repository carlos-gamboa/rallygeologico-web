import { Component, OnInit } from '@angular/core';
import {environment} from "../../../environments/environment";

@Component({
  selector: 'app-public-footer',
  templateUrl: './public-footer.component.html',
  styleUrls: ['./public-footer.component.css']
})
export class PublicFooterComponent implements OnInit {

    assetsUrl: string;

  constructor() {
      this.assetsUrl = environment.assetsUrl;
  }

  ngOnInit() {
  }

}
