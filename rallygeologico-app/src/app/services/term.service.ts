import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Site} from "../model/site";
import {Invitation} from "../model/invitation";
import {User} from "../model/user";
import {Term} from "../model/term";

@Injectable()
export class TermService {

  baseUrl: string;
  headers: HttpHeaders = new HttpHeaders();

  constructor(private http : HttpClient, private _configuration: Configuration){
    this.baseUrl = this._configuration.ServerWithApiUrl;
    this.headers.append('Content-Type', 'application/json');
  }

  /**
   * Adds a new term
   * @param name
   * @param description
   * @returns {Observable<Object>}
   */
  addTerm(name : string, description : string) : Observable<Term>{
    return this.http.post<Term>(this.baseUrl + "term/add.json", {
      'name':name,
      'description':description,
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Edits the existing term with new information
   * @param id
   * @param name
   * @param description
   * @returns {Observable<Object>}
   */
  editTerm(id: number, name: string, description: string): Observable<Term>{
    return this.http.post<Term>(this.baseUrl + "term/edit/"+id+".json",{
      'name' : name,
      'description' : description
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Deletes the specified term
   * @param id
   * @returns {Observable<Object>}
   */
  deleteTerm(id: number) : Observable<boolean>{
    return this.http.post<boolean>(this.baseUrl + "term/delete/"+id+".json", {
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Gets first twenty terms
   * @returns {Observable<Object>}
   */
  getTerms() : Observable<Term[]>{
    return this.http.get<Term[]>(this.baseUrl + "term.json", { headers: this.headers, withCredentials: true })
  }

  /**
   * Gets all the terms
   * @param termId
   * @returns {Observable<Object>}
   */
  getAllTerms(termId: number):Observable<Term[]>{
    return this.http.get<Term[]>(this.baseUrl + "term/getAllTerms/"+termId+".json");
  }

  /**
   * Service for obtaining the termSiteId
   *
   * @param {number} termId
   * @param {number} siteId
   * @returns {Observable<number>}
   */
  getTermSite(termId: number, siteId: number): Observable<number>{
    return this.http.get<number>(this.baseUrl + "termSite/getTermSite/"+termId+"/"+siteId+".json");
  }

  /**
   * Service for adding a termSite relation
   * @param {number} termId
   * @param {number} siteId
   * @returns {Observable<Site>}
   */
  addTermSite(termId: number, siteId: number): Observable<Term>{
    return this.http.post<Term>(this.baseUrl + "termSite/add.json", {
      'term_id': termId,
      'site_id': siteId
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Service for deleting the termSite relation
   * @param {number} id
   * @returns {Observable<boolean>}
   */
  deleteTermSite(id: number): Observable<boolean>{
    return this.http.delete<boolean>(this.baseUrl + "termSite/delete/"+id+".json");
  }

  /**
   * Service for obtaining the termSiteId
   *
   * @param {number} termId
   * @param {number} multimediaId
   * @returns {Observable<number>}
   */
  getTermMultimedia(termId: number, multimediaId: number): Observable<number>{
    return this.http.get<number>(this.baseUrl + "termMultimedia/getTermMultimedia/"+termId+"/"+multimediaId+".json");
  }

  /**
   * Service for adding a termSite relation
   * @param {number} termId
   * @param {number} multimediaId
   * @returns {Observable<Site>}
   */
  addTermMultimedia(termId: number, multimediaId: number): Observable<Term>{
    return this.http.post<Term>(this.baseUrl + "termMultimedia/add.json", {
      'term_id': termId,
      'multimedia_id': multimediaId
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Service for deleting the termSite relation
   * @param {number} id
   * @returns {Observable<boolean>}
   */
  deleteTermMultimedia(id: number): Observable<boolean>{
    return this.http.delete<boolean>(this.baseUrl + "termMultimedia/delete/"+id+".json");
  }

  getAllTermsOrdered() : Observable<Term[]>{
    return this.http.get<Term[]>(this.baseUrl + "term/getAllTermsOrdered.json");
  }

  getATerm(id:number) : Observable<Term>{
    return this.http.get<Term>(this.baseUrl + "term/getATerm/" + id +".json");
  }

}
