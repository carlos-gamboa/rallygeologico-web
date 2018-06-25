import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Activity} from "../model/activity";

@Injectable()
export class ActivityService {

  baseUrl: string;
  headers: HttpHeaders = new HttpHeaders();

  constructor(private http : HttpClient, private _configuration: Configuration){
    this.baseUrl = this._configuration.ServerWithApiUrl;
    this.headers.append('Content-Type', 'application/json');
  }

  /**
   * Adds a new activity
   * @param name
   * @param description
   * @returns {Observable<Object>}
   */
  addActivity(site_id : string, activity_type : string, points_awarded : string, description : string, name : string) : Observable<Activity>{
    return this.http.post<Activity>(this.baseUrl + "activity/add.json", {
      'site_id':site_id,
      'activity_type':activity_type,
      'points_awarded':points_awarded,
      'description':description,
      'name':name
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Edits the existing activity with new information
   * @param id
   * @param name
   * @param description
   * @returns {Observable<Object>}
   */
  editActivity(id : string, site_id : string, activity_type : string, points_awarded : string, description : string, name : string): Observable<Activity>{
    return this.http.post<Activity>(this.baseUrl + "activity/edit/"+id+".json",{
      'site_id':site_id,
      'activity_type':activity_type,
      'points_awarded':points_awarded,
      'description':description,
      'name':name,
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Deletes the specified activity
   * @param id
   * @returns {Observable<Object>}
   */
  deleteActivity(id: number) : Observable<boolean>{
    return this.http.post<boolean>(this.baseUrl + "activity/delete/"+id+".json", {
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Service for obtaining the activityId
   *
   * @param {number} activity_id
   * @returns {Observable<number>}
   */
  getActivity(activity_id: number): Observable<number>{
    return this.http.get<number>(this.baseUrl + "activity/getActivity/"+activity_id+".json");
  }


  /**
   * Gets all the terms
   * @param activityId
   * @returns {Observable<Object>}
   */
  getAllActivities(activityId: number):Observable<Activity[]>{ //DOESNT ACTUALLY RECEIVE A PARAMETER
    return this.http.get<Activity[]>(this.baseUrl + "term/getAllActivities/"+activityId+".json");
  }


  /**
   * Service for obtaining the termSiteId
   *
   * @param {number} activityId
   * @param {number} multimediaId
   * @returns {Observable<number>}
   */
  getActivityMultimedia(activityId: number, multimediaId: number): Observable<number>{
    return this.http.get<number>(this.baseUrl + "activityMultimedia/getActivityMultimedia/"+activityId+"/"+multimediaId+".json");
  }

  /**
   * Service for adding a termSite relation
   * @param {number} activityId
   * @param {number} multimediaId
   * @returns {Observable<Activity>}
   */
  addActivityMultimedia(activityId: number, multimediaId: number): Observable<Activity>{
    return this.http.post<Activity>(this.baseUrl + "activityMultimedia/add.json", {
      'activity_id': activityId,
      'multimedia_id': multimediaId
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Service for deleting the termSite relation
   * @param {number} id
   * @returns {Observable<boolean>}
   */
  deleteActivityMultimedia(id: number): Observable<boolean>{
    return this.http.delete<boolean>(this.baseUrl + "activityMultimedia/delete/"+id+".json");
  }

  /**
   * Service for getting all the terms those aren't part of the specified multimedia
   * @param {number} id
   * @returns {Observable<Activity[]>}
   */
  getOtherActivitiesFromMultimedia(id: number): Observable<Activity []>{
    return this.http.get<Activity[]>(this.baseUrl + "activity/getOtherActivitiesFromMultimedia/"+id+".json");
  }

  /**
   * Service for getting all the activities that are part of the specified multimedia
   * @param {number} id
   * @returns {Observable<Activity[]>}
   */
  getAssociatedActivitiesFromMultimedia(id: number): Observable<Activity []>{
    return this.http.get<Activity[]>(this.baseUrl + "activity/getAssociatedActivitiesFromMultimedia/"+id+".json");
  }
}
