import { Component, OnInit } from '@angular/core';
import {TermService} from "../services/term.service";
import {Router} from "@angular/router";
import {Term} from "../model/term";

import {environment} from "../../environments/environment";

@Component({
  selector: 'app-glossary',
  templateUrl: './glossary.component.html',
  styleUrls: ['./glossary.component.css']
})
export class GlossaryComponent implements OnInit {

    allTerms : Map<string, Term[]> = new Map();
    termKeys:string[];

    readyToShow:boolean = false;
    MAX_TEXT_SIZE : number = 300;
    assetsUrl: string;

    constructor(private termService:TermService,
                private router : Router) {
        this.setData();
    }

    ngOnInit() {
    }

    private setData() {
        this.assetsUrl = environment.assetsUrl;
        this.termService.getAllTermsOrdered().subscribe((terms: Term[]) =>{
            this.setTermsOrdered( this.cutDefinitions(terms));
            this.readyToShow = true;
        });
    }

    private setTermsOrdered(terms: Term[]) {
        let letter:string = "A";
        let letterTerms:Term[] = [];
        let index:number = 0;
        for(let term of terms){
            let first_letterTerm =  term.name.substr(0,1).trim().toUpperCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "");
            if(letter.match(first_letterTerm) === null) {
                this.allTerms.set(letter, letterTerms);
                letter = first_letterTerm;
                letterTerms = [];
            }
            letterTerms.push(terms[index]);
            index++;
        }
        this.termKeys = Array.from(this.allTerms.keys());
    }


    private cutDefinitions(allterms:Term[]): Term[] {
        let newTerms: Term[] = allterms;
        for(let term of newTerms){
            if(term.description.length > this.MAX_TEXT_SIZE){
                term.description = term.description.substring(0,this.MAX_TEXT_SIZE) + "...";
            }
        }
        return newTerms;
    }
}
