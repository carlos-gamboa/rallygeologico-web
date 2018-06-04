import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Site} from "../model/site";
import {Invitation} from "../model/invitation";
import {User} from "../model/user";

@Injectable()
export class TermService {

  baseUrl: string;
  headers: HttpHeaders = new HttpHeaders();

  constructor(private http : HttpClient, private _configuration: Configuration){
    this.baseUrl = this._configuration.ServerWithApiUrl;
    this.headers.append('Content-Type', 'application/json');
  }

  addTerm(name : string, description : string) : Observable<User[]>{
    return this.http.post<User[]>(this.baseUrl + "term/add.json", {
      'name':name,
      'description':description,
    },{ headers: this.headers, withCredentials: true });
  }

  editTerm(id: number, name: string, description: string): Observable<Invitation>{
    return this.http.post<Invitation>(this.baseUrl + "term/edit/"+id+".json",{
      'name' : name,
      'description' : description
    },{ headers: this.headers, withCredentials: true });
  }

  deleteTerm(id: number) : Observable<User[]>{
    return this.http.post<User[]>(this.baseUrl + "term/add.json", {
    },{ headers: this.headers, withCredentials: true });
  }

  getTerms() : Observable<User[]>{
    return this.http.get<User[]>(this.baseUrl + "term.json");
  }

}
