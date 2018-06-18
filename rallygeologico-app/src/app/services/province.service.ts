import { Injectable } from '@angular/core';
import {Observable} from "rxjs/Observable";
import {District} from "../model/district";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Configuration} from "./data/constants";
import {Province} from "../model/province";

@Injectable()
export class ProvinceService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    /**
     * Creates a District Service
     * @param {HttpClient} http
     * @param {Configuration} _configuration
     */
    constructor(private http: HttpClient, private _configuration: Configuration) {
        this.baseUrl = this._configuration.ServerWithApiUrl;
        this.headers.append('Content-Type', 'application/json');
    }

    getAllProvinces(): Observable<Province[]>{
        return this.http.get<Province[]>(this.baseUrl + "province.json",{ headers: this.headers, withCredentials: true });
    }
}
