import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Site} from "../model/site";
import {Invitation} from "../model/invitation";
import {User} from "../model/user";
import {Term} from "../model/term";
import {Multimedia} from "../model/multimedia";

@Injectable()
export class MultimediaService {

  baseUrl: string;
  headers: HttpHeaders = new HttpHeaders();

  constructor(private http : HttpClient, private _configuration: Configuration){
    this.baseUrl = this._configuration.ServerWithApiUrl;
    this.headers.append('Content-Type', 'application/json');
  }

  addMultimedia(name : string, media_type : number, media_url : string) : Observable<Multimedia[]>{
    return this.http.post<Multimedia[]>(this.baseUrl + "multimedia/add.json", {
      'name':name,
      'media_type':media_type,
      'media_url':media_url
    },{ headers: this.headers, withCredentials: true });
  }

  editMultimedia(id: number, name : string, media_type : number, media_url : string): Observable<Multimedia>{
    return this.http.post<Multimedia>(this.baseUrl + "multimedia/edit/"+id+".json",{
      'name' : name,
      'media_type':media_type,
      'media_url':media_url
    },{ headers: this.headers, withCredentials: true });
  }

  deleteMultimedia(id: number) : Observable<Multimedia[]>{
    return this.http.post<Multimedia[]>(this.baseUrl + "multimedia/delete"+id+".json", {
    },{ headers: this.headers, withCredentials: true });
  }

  getMultimedia() : Observable<Multimedia[]>{
    return this.http.get<Multimedia[]>(this.baseUrl + "multimedia.json");
  }

}
