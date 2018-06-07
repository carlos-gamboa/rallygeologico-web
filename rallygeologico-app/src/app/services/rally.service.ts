import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Rally} from "../model/rally";
import {Observable} from "rxjs/Observable";
import {Site} from "../model/site";

@Injectable()
export class RallyService {

    baseUrl: string;
    headers: HttpHeaders = new HttpHeaders();

    constructor(private http : HttpClient, private _configuration: Configuration){
        this.baseUrl = this._configuration.ServerWithApiUrl;
        this.headers.append('Content-Type', 'application/json');
    }

    /**
     * Service for getting all the rallies in descendant order.
     * @returns {Observable<Rally[]>}
     */
    getNewestRallies(): Observable<Rally[]>{
        return this.http.get<Rally[]>(this.baseUrl + "rally/newestRallies.json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for getting a specific rally from database, creates a get request with the id as a parameter
     * @param {number} id
     * @returns {Observable<Rally>}
     */
    getRally(id: number): Observable<Rally>{
        return this.http.get<Rally>(this.baseUrl + "rally/view/"+id+".json",{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for getting all the rallies
     * @returns {Observable<Rally[]>}
     */
    getAllRallies(): Observable<Rally[]>{
        return this.http.get<Rally[]>(this.baseUrl + "rally.json",{ headers: this.headers, withCredentials: true });
    }

    /**

     * Service for creating a Rally
     * @param {string} name
     * @param {number} points
     * @param {number} latitude
     * @param {number} longitude
     * @param {string} imageUrl
     * @param {string} description
     * @returns {Observable<Rally>}
     */
    addRally(name: string, points: number, latitude: number, longitude: number, imageUrl: string, description: string): Observable<Rally>{
        return this.http.post<Rally>(this.baseUrl + "rally/add.json", {
            'name': name,
            'points_awarded': points,
            'image_url': imageUrl,
            'description': description,
            'latitude': latitude,
            'longitude': longitude,
        },{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for editing a Rally
     *
     * @param {number} id
     * @param {string} name
     * @param {number} points
     * @param {number} latitude
     * @param {number} longitude
     * @param {string} imageUrl
     * @param {string} description
     * @returns {Observable<Rally>}
     */
    editRally(id: number, name: string, points: number, latitude: number, longitude: number, imageUrl: string, description: string): Observable<Rally>{
        return this.http.post<Rally>(this.baseUrl + "rally/edit/" + id + ".json", {
            'name': name,
            'points_awarded': points,
            'image_url': imageUrl,
            'description': description,
            'latitude': latitude,
            'longitude': longitude,
        },{ headers: this.headers, withCredentials: true })
    }

    /**
     * Service for deleting a Rally
     *
     * @param {number} id
     * @returns {Observable<boolean>}
     */
    deleteRally(id: number): Observable<boolean>{
        return this.http.delete<boolean>(this.baseUrl + "rally/delete/"+id+".json");
    }

    /**
     * Service for obtaining the rallySiteId
     *
     * @param {number} rallyId
     * @param {number} siteId
     * @returns {Observable<number>}
     */
    getRallySite(rallyId: number, siteId: number): Observable<number>{
        return this.http.get<number>(this.baseUrl + "rallySite/getRallySite/"+rallyId+"/"+siteId+".json");
    }

    /**
     * Service for adding a rallySite relation
     * @param {number} rallyId
     * @param {number} siteId
     * @returns {Observable<Site>}
     */
    addRallySite(rallyId: number, siteId: number): Observable<Site>{
        return this.http.post<Site>(this.baseUrl + "rallySite/add.json", {
            'rally_id': rallyId,
            'site_id': siteId
        },{ headers: this.headers, withCredentials: true });
    }

    /**
     * Service for deleting the rallySite relation
     * @param {number} id
     * @returns {Observable<boolean>}
     */
    deleteRallySite(id: number): Observable<boolean>{
        return this.http.delete<boolean>(this.baseUrl + "rallySite/delete/"+id+".json");
    }

    /**
     * Service for getting all the rallies those aren't part of the specified site
     * @param {number} siteId
     * @returns {Observable<Rally[]>}
     */
    getOtherRallies(siteId: number):Observable<Rally[]>{
        return this.http.get<Rally[]>(this.baseUrl + "rally/getOtherRallies/"+siteId+".json");
    }

    /**
     * Service for getting all the rallies those are part of the specified site
     * @param {number} siteId
     * @returns {Observable<Rally[]>}
     */
    getAssociatedRallies(siteId: number): Observable<Rally[]>{
        return this.http.get<Rally[]>(this.baseUrl + "rally/getAssociatedRallies/"+siteId+".json");
    }
}