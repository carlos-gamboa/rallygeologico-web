import {Term} from "./term";

export class Multimedia {
  id : number;
  name : string;
  media_type: number;
  media_url : string;
  terms: Term[];
  constructor(multimedia: any){
    this.id = multimedia.id;
    this.name = multimedia.name;
    this.media_type = multimedia.media_type;
    this.media_url = multimedia.media_url;
  }
}
