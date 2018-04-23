import {Injectable} from "@angular/core";
import {HttpClient, HttpEvent, HttpHandler, HttpInterceptor, HttpRequest} from "@angular/common/http";
import {User} from "../model/user";
import {Configuration} from "./data/constants";
import {Observable} from "rxjs/Observable";

@Injectable()
export class UserService {

    baseUrl: string;

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
    }

    login(){
        this.http.get<User[]>(this.baseUrl + "users.json").subscribe(
            data => {
                console.log("User Login: " + data[0].FacebookId);
                console.log("Bio: " + data[0].FirstName);
                console.log("Company: " + data[0].LastName);
            },
            err => {
                console.log("Error occured.")
            }
        );
    }
}