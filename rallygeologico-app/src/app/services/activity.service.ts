import {Configuration} from "./data/constants";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {Activity} from "../model/activity";
import {Options} from "../model/options";

@Injectable()
export class ActivityService {

  baseUrl: string;
  headers: HttpHeaders = new HttpHeaders();

  constructor(private http : HttpClient, private _configuration: Configuration){
    this.baseUrl = this._configuration.ServerWithApiUrl;
    this.headers.append('Content-Type', 'application/json');
  }

  /**
   * Adds an activity
   * @param {number} site_id
   * @param {string} activity_type
   * @param {string} points_awarded
   * @param {string} description
   * @param {string} name
   * @returns {Observable<Activity>}
   */
  addActivity(site_id : number, activity_type : number, points_awarded : number, description : string, name : string) : Observable<Activity>{
    return this.http.post<Activity>(this.baseUrl + "activity/add.json", {
      'site_id':site_id,
      'activity_type':activity_type,
      'points_awarded':points_awarded,
      'description':description,
      'name':name
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Edits an activity
   * @param {number} id
   * @param {string} site_id
   * @param {string} activity_type
   * @param {string} points_awarded
   * @param {string} description
   * @param {string} name
   * @returns {Observable<Activity>}
   */
  editActivity(id : number, site_id : number, activity_type : number, points_awarded : number, description : string, name : string): Observable<Activity>{
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
    return this.http.get<Activity[]>(this.baseUrl + "activity/getAllActivities/"+activityId+".json");
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

  addOption(activity_id : number, is_correct : number, option_text : string) : Observable<Options>{
    return this.http.post<Options>(this.baseUrl + "options/add.json", {
      'activity_id':activity_id,
      'is_correct':is_correct,
      'option_text':option_text
    },{ headers: this.headers, withCredentials: true });
  }

  editOption(id : number, activity_id : number, is_correct : number, option_text : string): Observable<Options>{
    return this.http.post<Options>(this.baseUrl + "options/edit/"+id+".json",{
      'activity_id':activity_id,
      'is_correct':is_correct,
      'option_text':option_text
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Deletes the specified option
   * @param id
   * @returns {Observable<Object>}
   */
  deleteOption(id: number) : Observable<boolean>{
    return this.http.post<boolean>(this.baseUrl + "options/delete/"+id+".json", {
    },{ headers: this.headers, withCredentials: true });
  }

  /**
   * Service for obtaining the activityId
   *
   * @param {number} activity_id
   * @returns {Observable<number>}
   */
  getOption(activity_id: number, option_text: string): Observable<number>{
    return this.http.get<number>(this.baseUrl + "options/getOption/"+activity_id+"/"+option_text+".json");
  }

  getAssociatedOptionsFromActivity(id: number): Observable<Options []>{
    return this.http.get<Options[]>(this.baseUrl + "options/getAssociatedOptionsFromActivity/"+id+".json");
  }

}
