import { Component, OnInit } from '@angular/core';
import {environment} from "../../../environments/environment";
import {Multimedia} from "../../model/multimedia";
import {MultimediaService} from "../../services/multimedia.service";

@Component({
  selector: 'app-public-footer',
  templateUrl: './public-footer.component.html',
  styleUrls: ['./public-footer.component.css']
})
export class PublicFooterComponent implements OnInit {

    assetsUrl: string;
    qr: Multimedia;

  constructor(private multimediaService: MultimediaService) {
      this.assetsUrl = environment.assetsUrl;
      this.multimediaService.getQrMultimedia().subscribe((multimedia: Multimedia[]) => {
          if(multimedia[0]){
              this.qr = multimedia[0];
          }
      });
  }

  ngOnInit() {
  }

}
