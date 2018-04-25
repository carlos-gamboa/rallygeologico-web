import {Injectable} from "@angular/core";
import {HttpClient, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from "@angular/common/http";
import {RequestOptions} from "@angular/http"
import {User} from "../model/user";
import {Configuration} from "./data/constants";
import {Observable} from "rxjs/Observable";
import {Headers} from "@angular/http";
import "rxjs";

@Injectable()
export class UserService {

    baseUrl: string;


    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    login(FacebookId : String) : Observable<User[]>{
        const body = 'FacebookId=${FacebookId}';
        return this.http.post<User[]>(this.baseUrl + "users/login.json", body);
    }

    register(FacebookId : string, Username : string, FirstName : string, LastName : string, Email : string, PhotoUrl : string) : Observable<User[]>{
      console.log("Se registro4");
      console.log("FB id:" + FacebookId);
      return this.http.post<User[]>(this.baseUrl + "users/add", {
        'FacebookId':FacebookId,
        'Username':Username,
        'FirstName':FirstName,
        'LastName':LastName,
        'Email':Email,
        'PhotoURL':PhotoUrl
      });
    }

    getUsers() : Observable<User[]>{
        return this.http.get<User[]>(this.baseUrl + "users.json");
    }

    sendInvitation( FacebookIdSend : string, FacebookIdReceive: string, CompetitionId: number) {
        const body = `FacebookIdSend=${FacebookIdSend}&FacebookIdReceive=${FacebookIdReceive}&CompetitionId=${CompetitionId}`;
        return this.http.post<User[]>(this.baseUrl + "invitation/add.json", body);
    }
}
