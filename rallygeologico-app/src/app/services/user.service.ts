import {Injectable} from "@angular/core";
import {HttpClient, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from "@angular/common/http";
import {User} from "../model/user";
import {Configuration} from "./data/constants";
import {Observable} from "rxjs/Observable";
import {User} from "../model/user";
import {Rally} from "../model/rally";

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

    register(FacebookId : String, Username : String, FirstName : String, LastName : String, Email : String, IsAdmin : Boolean) : Observable<User[]>{
      const body = `FacebookId=${FacebookId}&Username=${Username}&FirstName=${FirstName}&LastName=${LastName}&Email=${Email}&IsAdmin=${IsAdmin}`;
      return this.http.post<User[]>(this.baseUrl + "users/add.json", body); //no sé
    }
}
