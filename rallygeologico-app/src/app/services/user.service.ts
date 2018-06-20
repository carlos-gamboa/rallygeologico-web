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
        return this.http.get<boolean>(this.baseUrl + "users/emailExists/"+Email+".json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for checking if an username exists.
     * @param {string} Username User's username.
     * @returns {Observable<boolean>}
     */
    usernameExists(Username : string) : Observable<boolean>{
      return this.http.get<boolean>(this.baseUrl + "users/usernameExists/"+Username+".json",{ headers: this.headers, withCredentials: true });
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
      },{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for inserting a user into the database
     * @param {string} apiId API id.
     * @param {string} username User's username.
     * @param {string} firstName User's first name.
     * @param {string} lastName User's last name.
     * @param {string} email User's email.
     * @param {string} photoUrl User's photo url.
     * @param {number} loginApi User's login API.
     * @param {string} password User's password.
     * @param {string} passwordNeedsChange User's password.
     * @param {number} isActive If the user is confirmed.
     * @returns {Observable<User[]>}
     */
    register(apiId : string, username : string, firstName : string, lastName : string, email : string, photoUrl : string, loginApi: number, password: string, passwordNeedsChange: number, isActive: number) : Observable<User[]>{
        if (password){
            return this.http.post<User[]>(this.baseUrl + "users/add.json", {
                'api_id':apiId,
                'username':username,
                'first_name':firstName,
                'last_name':lastName,
                'email':email,
                'photo_url':photoUrl,
                'login_api':loginApi,
                'is_active':isActive,
                'password':password,
                'password_needs_change':passwordNeedsChange
            },{ headers: this.headers, withCredentials: true });
        } else {
            return this.http.post<User[]>(this.baseUrl + "users/add.json", {
                'api_id':apiId,
                'username':username,
                'first_name':firstName,
                'last_name':lastName,
                'email':email,
                'photo_url':photoUrl,
                'login_api':loginApi,
                'is_active':isActive,
                'password_needs_change':passwordNeedsChange
            },{ headers: this.headers, withCredentials: true });
        }
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
        return this.http.get<User[]>(this.baseUrl + "users.json",{ headers: this.headers, withCredentials: true });
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

    findById(id: number) : Observable<User> {
        return this.http.get<User>(this.baseUrl + "users/view/"+ id + ".json", { headers: this.headers, withCredentials: true });
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
      },{ headers: this.headers, withCredentials: true });
    }

    /**
     * Logs in with password
     * @param {string} username
     * @param {string} password
     * @returns {Observable<User>}
     */
    loginWithPassword(username: string, password: string): Observable<User>{
        return this.http.post<User>(this.baseUrl + "login.json", {
            'username':username,
            'password':password,
            'login_api':3
        },{ headers: this.headers, withCredentials: true });
    }

    editUser(id: number, apiId : string, username : string, firstName : string, lastName : string, email : string, photoUrl : string, loginApi: number, password: string, passwordNeedsChange:number, isActive: number) : Observable<User>{
        if (password){
            return this.http.post<User>(this.baseUrl + "users/edit/" + id +".json", {
                'api_id':apiId,
                'username':username,
                'first_name':firstName,
                'last_name':lastName,
                'email':email,
                'photo_url':photoUrl,
                'login_api':loginApi,
                'is_active':isActive,
                'password':password,
                'password_needs_change':passwordNeedsChange
            },{ headers: this.headers, withCredentials: true });
        } else {
            return this.http.post<User>(this.baseUrl + "users/edit/" + id +".json", {
                'api_id':apiId,
                'username':username,
                'first_name':firstName,
                'last_name':lastName,
                'email':email,
                'photo_url':photoUrl,
                'login_api':loginApi,
                'is_active':isActive,
                'password_needs_change':passwordNeedsChange
            },{ headers: this.headers, withCredentials: true });
        }
    }

    /**
     * Deletes the specified user
     * @param id
     * @returns {Observable<Object>}
     */
    deleteUser(id: number) : Observable<boolean>{
        return this.http.post<boolean>(this.baseUrl + "users/delete/"+id+".json", {
        },{ headers: this.headers, withCredentials: true });
    }

    editProfile(id: number, firstName : string, lastName : string, photoUrl : string) : Observable<User>{
        return this.http.post<User>(this.baseUrl + "users/edit/" + id +".json", {
            'first_name':firstName,
            'last_name':lastName,
            'photo_url':photoUrl
        },{ headers: this.headers, withCredentials: true });
    }

    updatePassword(id: number, currentPassword: string, newPassword: string) : Observable<boolean>{
        return this.http.post<boolean>(this.baseUrl + "users/changePassword.json", {
            'id':id,
            'password':currentPassword,
            'new_password':newPassword
        },{ headers: this.headers, withCredentials: true });
    }
}
