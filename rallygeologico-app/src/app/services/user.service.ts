import {Injectable} from "@angular/core";
import {HttpClient, HttpEvent, HttpHandler, HttpHeaders, HttpInterceptor, HttpRequest} from "@angular/common/http";
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

    email(Email : string) : Observable<User[]>{
        return this.http.get<User[]>(this.baseUrl + "users/email/"+Email+".json");
    }

    username(Username : string) : Observable<User[]>{
      return this.http.get<User[]>(this.baseUrl + "users/username/"+Username+".json");
    }

    facebookid(facebookid : string) : Observable<User[]>{
      return this.http.get<User[]>(this.baseUrl + "users/facebook_id/"+facebookid+".json");
    }

    register(FacebookId : string, Username : string, FirstName : string, LastName : string, Email : string, PhotoUrl : string) : Observable<User[]>{
        return this.http.post<User[]>(this.baseUrl + "users/add.json", {
        'facebook_id':FacebookId,
        'username':Username,
        'first_name':FirstName,
        'last_name':LastName,
        'email':Email,
        'photo_url':PhotoUrl
      });
    }

    isLoggedIn() : Observable<User>{
        return this.http.get<User>(this.baseUrl + "login/activeSession.json");
    }

    auth(FacebookId : string) : Observable<User[]>{
        return this.http.post<User[]>(this.baseUrl + "login.json", {
            'facebook_id':FacebookId,
        });
    }

    getUsers() : Observable<User[]>{
        return this.http.get<User[]>(this.baseUrl + "users.json");
    }

}
