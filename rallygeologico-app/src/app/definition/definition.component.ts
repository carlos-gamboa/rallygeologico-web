import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Params, Router} from "@angular/router";
import {TermService} from "../services/term.service";
import {Term} from "../model/term";
import {Multimedia} from "../model/multimedia";

import {environment} from "../../environments/environment";
@Component({
  selector: 'app-definition',
  templateUrl: './definition.component.html',
  styleUrls: ['./definition.component.css']
})
export class DefinitionComponent implements OnInit {

  termId:number;
  term:Term = null;
  readyToshow:boolean = false;
  imagesMultimedia:Multimedia[]=[];
  videosMultimedia:Multimedia[]=[];
  assetsUrl: string;

  constructor(private termService: TermService,
              private route: ActivatedRoute,
              private router: Router) {

    this.setData();

  }

  ngOnInit() {
  }

  setData(){
      this.assetsUrl = environment.assetsUrl;
      this.route.params
          .subscribe(
              (params: Params) => {
                  this.termId = this.route.snapshot.params['definitionId'];
                  console.log(this.termId);
                  this.termService.getATerm(this.termId).subscribe((term:Term) =>{
                      this.term = term;
                      this.setMultimedia();
                      console.log(term);
                      this.readyToshow = true;
                  })
              });
  }

  setMultimedia(){
      for(let media of this.term.multimedia){
          if(media.media_type == 0){
              this.imagesMultimedia.push(media);
          }
          // if(media.media_type == 1){
          //     this.videosMultimedia.push(media);
          // }
      }
  }

}
