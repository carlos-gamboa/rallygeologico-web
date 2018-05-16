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
    headers: HttpHeaders = new HttpHeaders();

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
        this.headers.append('Content-Type', 'application/json');
    }

    email(Email : string) : Observable<User[]>{
        return this.http.get<User[]>(this.baseUrl + "users/email/"+Email+".json");
    }

    username(Username : string) : Observable<User[]>{
      return this.http.get<User[]>(this.baseUrl + "users/username/"+Username+".json");
    }

    apiId(ApiId : string, LoginApi: number) : Observable<User[]>{
      return this.http.post<User[]>(this.baseUrl + "users/findApiId.json",{
          'api_id':ApiId,
          'login_api':LoginApi
      });
    }

    register(ApiId : string, Username : string, FirstName : string, LastName : string, Email : string, PhotoUrl : string, LoginApi: number) : Observable<User[]>{
        return this.http.post<User[]>(this.baseUrl + "users/add.json", {
            'api_id':ApiId,
            'username':Username,
            'first_name':FirstName,
            'last_name':LastName,
            'email':Email,
            'photo_url':PhotoUrl,
            'login_api':LoginApi
      });
    }

    isLoggedIn() : Observable<User>{
        return this.http.get<User>(this.baseUrl + "login/activeSession.json",{ headers: this.headers, withCredentials: true });
    }

    auth(ApiId : string, LoginApi: number) : Observable<User[]>{
        return this.http.post<User[]>(this.baseUrl + "login.json", {
            'api_id':ApiId,
            'login_api':LoginApi
        },{ headers: this.headers, withCredentials: true });
    }

    logout() : Observable<User> {
        return this.http.get<User>(this.baseUrl + "login/logout.json" ,{ headers: this.headers, withCredentials: true });
    }

    getUsers() : Observable<User[]>{
        return this.http.get<User[]>(this.baseUrl + "users.json");
    }

    getUsersToInvite(id: number) : Observable<User[]>{
        return this.http.post<User[]>(this.baseUrl + "users/usersToInvite.json",{
            'competition_id':id
        },{ headers: this.headers, withCredentials: true });
    }

}
