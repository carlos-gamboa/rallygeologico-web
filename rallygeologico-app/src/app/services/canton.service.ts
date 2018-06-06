import { Injectable } from '@angular/core';
import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";

@Injectable()
export class CantonService {
    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();
    
  constructor(private http : HttpClient, private _configuration: Configuration) {
      this.baseUrl = this._configuration.ServerWithApiUrl;
      this.headers.append('Content-Type', 'application/json');
  }


    selectallCantons(){

    }

    editCanton(){

    }

    createCanton() {

    }

    removeCanton() {

    }
    
}
