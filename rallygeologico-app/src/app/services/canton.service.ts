import { Injectable } from '@angular/core';
import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs/Observable";
import {Canton} from "../model/canton";

@Injectable()
export class CantonService {
    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();
    
  constructor(private http : HttpClient, private _configuration: Configuration) {
      this.baseUrl = this._configuration.ServerWithApiUrl;
      this.headers.append('Content-Type', 'application/json');
  }


    selectallCantons(): Observable<Canton[]>{
        return this.http.get<Canton[]>(this.baseUrl + "canton.json",{ headers: this.headers, withCredentials: true })
    }

    editCanton(id:number, name:string, province_id:number):Observable<Canton>{
        return this.http.post<Canton>(this.baseUrl + "competition/edit/" + id + ".json", {
            'name': name,
            'province_id': province_id
        },{ headers: this.headers, withCredentials: true });
    }

    addCanton(name:string , province_id:number): Observable<Canton> {
        return this.http.post<Canton>(this.baseUrl + "canton/add.json", {
            'name': name,
            'province_id': province_id
        },{ headers: this.headers, withCredentials: true });
    }

    deleteCanton(id : number):Observable<boolean> {
        return this.http.delete<boolean>(this.baseUrl + "canton/delete/"+id+".json");
    }
    
}
