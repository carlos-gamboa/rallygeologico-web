import {Multimedia} from "./multimedia";
import {Site} from "./site";

export class Term {
  id : number;
  name : string;
  description: string;
  multimedia : Multimedia[];
  site : Site[];

  constructor(term: any){
    this.id = term.id;
    this.name = term.name;
    this.description = term.description;
    this.multimedia = term.multimedia;
    this.site = term.site;
  }
}
