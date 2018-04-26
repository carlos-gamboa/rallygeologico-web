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

    email(Email : string) : Observable<User[]>{
        const body = 'Email=${Email}';
        return this.http.post<User[]>(this.baseUrl + "users/email/"+Email+".json", body);
    }

    username(Username : string) : Observable<User[]>{
      return this.http.post<User[]>(this.baseUrl + "users/username/"+Username+".json", {
        'Username':Username,
      });
    }

    register(FacebookId : string, Username : string, FirstName : string, LastName : string, Email : string, PhotoUrl : string) : Observable<string>{
      return this.http.post<User[]>(this.baseUrl + "users/add", {
        'FacebookId':FacebookId,
        'Username':Username,
        'FirstName':FirstName,
        'LastName':LastName,
        'Email':Email,
        'PhotoURL':PhotoUrl
      },{ responseType: 'text'});
    }

    getUsers() : Observable<User[]>{
        return this.http.get<User[]>(this.baseUrl + "users.json");
    }

}
