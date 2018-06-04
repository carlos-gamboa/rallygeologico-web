import {Media} from "./multimedia";
import {Site} from "./site";

export class Term {
  id : number;
  name : string;
  description: string;
  media : Media[];
  sites : Site[];

  constructor(term: any){
    this.id = term.id;
    this.name = term.name;
    this.description = term.description;
  }
}
