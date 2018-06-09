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

    /**
     * Service for checking if an email exists.
     * @param {string} Email User's email.
     * @returns {Observable<boolean>}
     */
    emailExists(Email : string) : Observable<boolean>{
        return this.http.get<boolean>(this.baseUrl + "users/emailExists/"+Email+".json");
    }

    /**
     * Service for checking if an username exists.
     * @param {string} Username User's username.
     * @returns {Observable<boolean>}
     */
    usernameExists(Username : string) : Observable<boolean>{
      return this.http.get<boolean>(this.baseUrl + "users/usernameExists/"+Username+".json");
    }

    /**
     * Service for searching an user based on the api id and type.
     * @param {string} ApiId User's API Id.
     * @param {number} LoginApi User's Login API.
     * @returns {Observable<User[]>}
     */
    apiId(ApiId : string, LoginApi: number) : Observable<User[]>{
      return this.http.post<User[]>(this.baseUrl + "users/findApiId.json",{
          'api_id':ApiId,
          'login_api':LoginApi
      });
    }

    /**
     * Service for inserting a user into the database
     * @param {string} ApiId API id.
     * @param {string} Username User's username.
     * @param {string} FirstName User's first name.
     * @param {string} LastName User's last name.
     * @param {string} Email User's email.
     * @param {string} PhotoUrl User's photo url.
     * @param {number} LoginApi User's login API.
     * @returns {Observable<User[]>}
     */
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

    /**
     * Service to get the user based on the active session cookie.
     * @returns {Observable<User>}
     */
    isLoggedIn() : Observable<User>{
        return this.http.get<User>(this.baseUrl + "login/activeSession.json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service to check if an user exists based on the API Id and Login API.
     * @param {string} ApiId User's API Id.
     * @param {number} LoginApi User's LoginAPI.
     * @returns {Observable<User[]>}
     */
    auth(ApiId : string, LoginApi: number) : Observable<User[]>{
        return this.http.post<User[]>(this.baseUrl + "login.json", {
            'api_id':ApiId,
            'login_api':LoginApi
        },{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service to logout a User
     * @returns {Observable<User>}
     */
    logout() : Observable<User> {
        return this.http.get<User>(this.baseUrl + "login/logout.json" ,{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service to get all users.
     * @returns {Observable<User[]>}
     */
    getUsers() : Observable<User[]>{
        return this.http.get<User[]>(this.baseUrl + "users.json");
    }

    /**
     * Service to get which users to invite to a competition.
     * @param {number} id Id of the competition.
     * @returns {Observable<User[]>}
     */
    getUsersToInvite(id: number) : Observable<User[]>{
        return this.http.post<User[]>(this.baseUrl + "users/usersToInvite.json",{
            'competition_id':id
        },{ headers: this.headers, withCredentials: true });
    }

  /**
   * Service for searching an administrator based on the api id and type.
   * @param {string} ApiId User's API Id.
   * @param {number} LoginApi User's Login API.
   * @returns {Observable<User[]>}
   */
    adminApiId(ApiId : string, LoginApi: number) : Observable<User[]>{
      return this.http.post<User[]>(this.baseUrl + "users/findApiIdAdmin.json",{
        'api_id':ApiId,
        'login_api':LoginApi
      });
    }



}
