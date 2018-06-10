import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Site} from "../model/site";
import {Term} from "../model/term";
import {District} from "../model/district";

@Injectable()
export class SiteService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
        this.headers.append('Content-Type', 'application/json');
    }

    /**
     * Service for getting a specific site from database, creates a get request with the id as a parameter
     * @param {number} id
     * @returns {Observable<Site>}
     */
    getSite(id: number): Observable<Site>{
        return this.http.get<Site>(this.baseUrl + "site/view/"+id+".json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for getting all the sites
     *
     * @returns {Observable<Site[]>}
     */
    getAllSites(): Observable<Site[]>{
        return this.http.get<Site[]>(this.baseUrl + "site.json",{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for adding a site
     *
     * @param {string} name
     * @param {string} qrUrl
     * @param {string} details
     * @param {string} description
     * @param {string} latitude
     * @param {string} longitude
     * @param {string} districtId
     * @param {string} points
     * @param {string} isEasterEgg
     * @returns {Observable<Site>}
     */
    addSite(name: string, qrUrl: string, details: string, description: string, latitude: string, longitude: string, districtId: string, points: string, isEasterEgg: string): Observable<Site>{
        return this.http.post<Site>(this.baseUrl + "site/add.json",{
            'name': name,
            'qr_url': qrUrl,
            'details': details,
            'description': description,
            'latitude': latitude,
            'longitude': longitude,
            'district_id': districtId,
            'points': points,
            'is_easter_egg': isEasterEgg
        },{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for editing a site
     *
     * @param {number} id
     * @param {string} name
     * @param {string} qrUrl
     * @param {string} details
     * @param {string} description
     * @param {string} latitude
     * @param {string} longitude
     * @param {string} districtId
     * @param {string} points
     * @param {string} isEasterEgg
     * @returns {Observable<Site>}
     */
    editSite(id: number, name: string, qrUrl: string, details: string, description: string, latitude: string, longitude: string, districtId: string, points: string, isEasterEgg: string): Observable<Site>{
        return this.http.post<Site>(this.baseUrl + "site/edit/" + id + ".json", {
            'name': name,
            'qr_url': qrUrl,
            'details': details,
            'description': description,
            'latitude': latitude,
            'longitude': longitude,
            'district_id': districtId,
            'points': points,
            'is_easter_egg': isEasterEgg
        },{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for deleting a site
     *
     * @param {number} id
     * @returns {Observable<boolean>}
     */
    deleteSite(id: number): Observable<boolean>{
        return this.http.delete<boolean>(this.baseUrl + "site/delete/"+id+".json");
    }

    /**
     * Service for getting all the sites those aren't part of the specified rally
     * @param {number} rallyId
     * @returns {Observable<Site>}
     */
    getOtherSites(rallyId: number):Observable<Site[]>{
        return this.http.get<Site[]>(this.baseUrl + "site/getOtherSites/"+rallyId+".json");
    }

    /**
     * Service for getting all the sites those are part of the specified rally
     * @param {number} rallyId
     * @returns {Observable<Site[]>}
     */
    getAssociatedSites(rallyId: number): Observable<Site[]>{
        return this.http.get<Site[]>(this.baseUrl + "site/getAssociatedSites/"+rallyId+".json");
    }

    /**
     * Service for getting all the sites those aren't part of the specified term
     * @param {number} termId
     * @returns {Observable<Site>}
     */
    getOtherSitesFromTerm(termId: number):Observable<Site[]>{
        return this.http.get<Site[]>(this.baseUrl + "site/getOtherSitesFromTerm/"+termId+".json");
    }

    /**
     * Service for getting all the sites those are part of the specified term
     * @param {number} termId
     * @returns {Observable<Site[]>}
     */
    getAssociatedSitesFromTerm(termId: number): Observable<Site[]>{
        return this.http.get<Site[]>(this.baseUrl + "site/getAssociatedSitesFromTerm/"+termId+".json");
    }

    /**
     * Gets all the sites
     * @returns {Observable<Object>}
     */
    getSites() : Observable<Site[]>{
      return this.http.get<Site[]>(this.baseUrl + "site.json");
    }

}
