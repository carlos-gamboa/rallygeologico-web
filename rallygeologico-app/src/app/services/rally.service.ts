import {Configuration} from "./data/constants";
import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Rally} from "../model/rally";
import {Observable} from "rxjs/Observable";

@Injectable()
export class RallyService {

    baseUrl: string;

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    getNewestRallies(): Observable<Rally[]>{
        return this.http.get<Rally[]>(this.baseUrl + "rally/newestRallies.json");
    }

    getRally(id: number): Observable<Rally>{
        console.log("response:"+this.http.get<Rally>(this.baseUrl + "rally/view/"+id+".json"));
        return this.http.get<Rally>(this.baseUrl + "rally/view/"+id+".json");
    }
}