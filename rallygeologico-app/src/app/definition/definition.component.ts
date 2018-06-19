import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Params, Router} from "@angular/router";
import {TermService} from "../services/term.service";
import {Term} from "../model/term";

@Component({
  selector: 'app-definition',
  templateUrl: './definition.component.html',
  styleUrls: ['./definition.component.css']
})
export class DefinitionComponent implements OnInit {

  termId:number;
  term:Term = null;
  readyToshow:boolean = false;

  constructor(private termService: TermService,
              private route: ActivatedRoute,
              private router: Router) {
    this.setData();

  }

  ngOnInit() {
  }

  setData(){
      this.route.params
          .subscribe(
              (params: Params) => {
                  this.termId = this.route.snapshot.params['definitionId'];
                  console.log(this.termId);
                  this.termService.getATerm(this.termId).subscribe((term:Term) =>{
                      this.term = term;
                      console.log(term);
                      this.readyToshow = true;
                  })
              });
  }

}
