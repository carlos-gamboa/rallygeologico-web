import {Component, OnInit} from '@angular/core';
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {Router} from "@angular/router";
import {Multimedia} from "../../model/multimedia";
import {MultimediaService} from "../../services/multimedia.service";
import {TermService} from "../../services/term.service";
import {Term} from "../../model/term";
import {Activity} from "../../model/activity";
import {ActivityService} from "../../services/activity.service";

@Component({
  selector: 'app-edit-multimedia',
  templateUrl: './edit-multimedia.component.html',
  styleUrls: ['./edit-multimedia.component.css']
})
export class EditMultimediaComponent implements OnInit {

    user: User;

    readyToShow: boolean;
    activeTab: number;

    currentMultimedia: Multimedia;
    multimediaSelected: boolean;
    multimediaCreated: boolean;
    newMultimedia: boolean;
    changesSaved: boolean;
    multimediaDeleted: boolean;
    messageType: boolean;
    alertMessage: string;

    searchQuery: string;
    multimedia: Multimedia[];
    allMultimedia: Multimedia[];
    showedMultimedia: Multimedia[];
    totalMultimedia: number;
    currentPageMultimedia: number;
    pageSize: number;
    currentMultimediaIndex: number;

    otherTerms: Term[];
    currentTerms: Term[];

    searchTermQuery: string;
    terms: Term[];
    allTerms: Term[];
    showedTerms: Term[];
    totalTerms: number;
    currentPageTerm: number;
    pageTermSize: number;
    currentTermIndex: number;

    otherActivities: Activity[];
    currentActivities: Activity[];
    searchActivityQuery = "";
    activities: Activity[];
    allActivities: Activity[];
    showedActivities: Activity[];
    totalActivities: number;
    currentPageActivity: number;
    pageActivitySize: number;
    currentActivityIndex: number;

    name: string;
    media_type: number;
    media_url: string;

    /**
     * Creates a EditMultimediaComponent
     *
     * @param {MultimediaService} multimediaService
     * @param {TermsService} termsService
     * @param {ActivityService} activityService
     * @param {UserService} userService
     * @param {DataService} dataService
     * @param {Router} router
     */
    constructor(private multimediaService: MultimediaService, private termsService: TermService, private activityService: ActivityService, private userService: UserService,
                private dataService: DataService, private router: Router) {
        this.readyToShow = false;
        this.activeTab = -1;

        this.currentMultimedia = null;
        this.multimediaSelected = false;
        this.multimediaCreated = false;
        this.newMultimedia = false;
        this.changesSaved = false;
        this.multimediaDeleted = false;
        this.messageType = false;
        this.alertMessage = "";

        this.searchQuery = "";
        this.multimedia = [];
        this.allMultimedia = [];
        this.showedMultimedia = [];
        this.totalMultimedia = 0;
        this.currentPageMultimedia = 0;
        this.pageSize = 10;
        this.currentMultimediaIndex = 0;

        this.otherTerms = [];
        this.currentTerms = [];
        this.searchTermQuery = "";
        this.terms = [];
        this.allTerms = [];
        this.showedTerms = [];
        this.totalTerms = 0;
        this.currentPageTerm = 0;
        this.pageTermSize = 10;
        this.currentTermIndex = 0;

        this.otherActivities = [];
        this.currentActivities = [];
        this.searchActivityQuery = "";
        this.activities = [];
        this.allActivities = [];
        this.showedActivities = [];
        this.totalActivities = 0;
        this.currentPageActivity = 0;
        this.pageActivitySize = 10;
        this.currentActivityIndex = 0;

        this.user = this.dataService.getUser();
        if (!this.user) {
            this.userService.isLoggedIn().subscribe((users: User) => {
                if (users[0] && users[0].is_admin == 1) {
                    this.dataService.updateUser(users[0]);
                    this.user = users[0];
                    this.setupData();
                } else {
                    this.router.navigate(['/landing']);
                }
            });
        } else {
            this.setupData();
        }
    }

    ngOnInit() {

    }

    /**
     * Loads multimedia's information
     */
    setupData(){
        this.multimediaService.getAllMultimedia().subscribe((multimedia: Multimedia[]) => {
            this.allMultimedia = multimedia;
            this.reloadMultimedia(this.allMultimedia);
        });
    }

    /**
     * Reloads multimedia's information for the search table
     *
     * @param {Multimedia[]} multimedia
     */
    reloadMultimedia(multimedia: Multimedia[]){
        this.readyToShow = false;
        this.multimedia = multimedia;
        this.totalMultimedia = multimedia.length;
        this.showedMultimedia = multimedia.slice(0, this.pageSize);
        this.currentPageMultimedia = 0;
        this.readyToShow = true;
    }

    /**
     * Manage page changing on the search table
     */
    multimediaPageChange(){
        if(this.multimedia) {
            this.showedMultimedia = this.multimedia.slice((this.currentPageMultimedia - 1) * this.pageSize, ((this.currentPageMultimedia) * this.pageSize));
        }
    }

    /**
     * Searches multimedia by name
     */
    searchMultimedia(){
        let multimediaToShow = [];
        if(this.searchQuery.length >= 1) {
            for (let rally of this.allMultimedia) {
                if (rally.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                    multimediaToShow.push(rally);
                }
            }
            this.reloadMultimedia(multimediaToShow);
        }else{
            this.reloadMultimedia(this.allMultimedia);
        }
    }

    /**
     * Sets the multimedia in the position i of the multimedia array or sets flags for a new one if i = -1
     *
     * @param {number} i
     */
    edit(i: number){
        this.readyToShow = false;
        this.activeTab = 0;
        this.multimediaSelected = true;
        this.changesSaved = false;
        if (i == -1){
            this.newMultimedia = true;
            this.currentMultimedia = null;
        } else {
            this.currentMultimedia = this.showedMultimedia[i];
            this.currentMultimediaIndex = ((this.currentPageMultimedia - 1) * this.pageSize) + i;
            this.editMultimediaChange();
        }
        this.readyToShow = true;
    }

    /**
     * Sets the known information about a chosen multimedia to edit it
     */
    editMultimediaChange(){
        if (this.currentMultimedia) {
            this.name = this.currentMultimedia.name;
            this.media_type = this.currentMultimedia.media_type;
            this.media_url = this.currentMultimedia.media_url;
        }
    }

    /**
     * Saves the changes of an existent multimedia or adds a new one if it doesn't exist
     */
    saveChanges(){
        this.changesSaved = false;
        if (this.currentMultimedia) {
            this.multimediaService.editMultimedia(this.currentMultimedia.id, this.name, this.media_type, this.media_url).subscribe((multimedia: Multimedia) => {
                if (multimedia) {
                    this.currentMultimedia = multimedia;
                    this.allMultimedia[this.currentMultimediaIndex] = this.currentMultimedia;
                    this.changesSaved = true;
                    this.messageType = true;
                    this.alertMessage = "Se han guardado los cambios.";
                } else {
                    this.alertMessage = "No se pudo guardar los cambios.";
                    this.messageType = false;

                }
            });
        }
        else {
            this.multimediaService.addMultimedia(this.name, this.media_type, this.media_url).subscribe((multimedia: Multimedia) => {
                if (multimedia){
                    this.currentMultimedia = multimedia;
                    this.allMultimedia.push(this.currentMultimedia);
                    this.multimediaCreated = true;
                    this.changesSaved = true;
                    this.newMultimedia = false;
                    this.messageType = true;
                    this.alertMessage = "Multimedia creada.";
                } else {
                    this.messageType = false;
                    this.alertMessage = "No se pudo crear multimedia.";
                }
            });
        }
    }

    /**
     * Deletes the multimedia on the specified position of the multimedia array
     * @param {number} id
     * @param {number} i
     */
    deleteMultimedia(id: number, i: number){
        this.multimediaDeleted = false;
        this.changesSaved = false;
        this.multimediaService.deleteMultimedia(id).subscribe((deleted: boolean) => {
            this.multimediaDeleted = deleted;
            if (deleted){
               this.currentMultimedia = null;
               this.allMultimedia.splice(((this.currentPageMultimedia - 1) * this.pageSize) + i, 1);
               this.messageType = true;
               this.alertMessage = "Multimedia se ha eliminado.";
               this.reloadMultimedia(this.allMultimedia);
            } else {
               this.messageType = false;
               this.alertMessage = "Multimedia no se pudo eliminar.";
            }
        });
    }

    /**
     * Reloads flags and multimedia information
     */
    goBack(){
        this.currentMultimedia = null;
        this.multimediaSelected = false;
        this.multimediaCreated = false;
        this.changesSaved = false;
        this.multimediaDeleted = false;
        this.reloadMultimedia(this.allMultimedia);
        this.name = "";
        this.media_type = 0;
        this.media_url = "";
    }

    /**
     * Changes the information on screen depending on the selected tab
     * @param {number} i
     */
    changeTab(i: number){
        this.activeTab = i;
        this.changesSaved = false;
        if (i == 1){
            this.totalTerms = 0;
            this.currentPageTerm = 0;
            this.pageTermSize = 10;
            this.currentTermIndex = 0;
            this.updateTerms();
        }
        if (i == 2){
            this.totalActivities = 0;
            this.currentPageActivity = 0;
            this.pageActivitySize = 10;
            this.currentActivityIndex = 0;
            this.updateActivities();
        }
    }

    /**
     * Loads all terms'information
     */
    updateTerms(){
        this.allTerms = [];
        this.termsService.getOtherTerms(this.currentMultimedia.id).subscribe((otherTerms: Term[]) => {
            this.otherTerms = otherTerms;
            //console.log(this.otherTerms);
            this.termsService.getAssociatedTerms(this.currentMultimedia.id).subscribe((currentTerms: Term[]) => {
                this.currentTerms = currentTerms;
                //console.log(this.currentTerms);
                for(let term of this.otherTerms){
                    this.allTerms.push(term);
                }
                for(let term of this.currentTerms){
                    this.allTerms.push(term);
                }
                this.reloadTerms(this.allTerms);
            });
        });
    }

    /**
     * Reloads terms' information for the search table
     * @param {Term[]} terms
     */
    reloadTerms(terms: Term[]){
        this.readyToShow = false;
        this.terms = terms;
        this.totalTerms =  terms.length;
        this.showedTerms = terms.slice(0, this.pageTermSize);
        this.currentPageTerm = 0;
        this.readyToShow = true;
    }

    /**
     * Manage page changing on the search table
     */
    termPageChange(){
        if(this.terms) {
            this.showedTerms = this.terms.slice((this.currentPageTerm - 1) * this.pageTermSize, ((this.currentPageTerm) * this.pageTermSize));
        }
    }

    /**
     * Searches a term by name
     */
    searchTerm(){
        let termsToShow = [];
        if(this.searchTermQuery.length >= 1) {
            for (let site of this.allTerms) {
                if (site.name.toLowerCase().startsWith(this.searchTermQuery.toLowerCase())) {
                    termsToShow.push(site);
                }
            }
            this.reloadTerms(termsToShow);
        }else{
            this.reloadTerms(this.allTerms);
        }
    }

    /**
     * Returns if the specified term is actually part of the current multimedia
     *
     * @param {number} id
     * @returns {boolean}
     */
    belongsTo(id: number): boolean{
        for(let currentTerm of this.currentTerms){
            if (id == currentTerm.id){
                return true;
            }
        }
        return false;
    }

    /**
     * Adds a termMultimedia relation between the current multimedia and the term on the specified position
     *
     * @param {number} i
     */
    addTermMultimedia(i : number){
        this.currentTermIndex = ((this.currentPageTerm - 1) * this.pageTermSize) + i;
        this.termsService.addTermMultimedia(this.showedTerms[i].id, this.currentMultimedia.id).subscribe((term: Term) =>{
            if(term){
                this.updateTerms();
            }
        });
    }

    /**
     * Deletes the termMultimedia relation between the current multimedia and the term on the specified position
     *
     * @param {number} i
     */
    deleteTermMultimedia(i: number){
        this.currentTermIndex = ((this.currentPageTerm - 1) * this.pageTermSize) + i;
        this.termsService.getTermMultimedia(this.showedTerms[i].id, this.currentMultimedia.id).subscribe((id: number) => {
            this.termsService.deleteTermMultimedia(id).subscribe((deleted: boolean) => {
                if (deleted) {
                    this.updateTerms();
                }
            });
        });
    }

  /**
   * Loads all activities'information
   */
  updateActivities(){
    this.allActivities = [];
    this.activityService.getOtherActivitiesFromMultimedia(this.currentMultimedia.id).subscribe((otherActivities: Activity[]) => {
      this.otherActivities = otherActivities;
      //console.log(this.otherActivities);
      this.activityService.getAssociatedActivitiesFromMultimedia(this.currentMultimedia.id).subscribe((currentActivities: Activity[]) => {
        this.currentActivities = currentActivities;
        //console.log(this.currentActivities);
        for(let activity of this.otherActivities){
          this.allActivities.push(activity);
        }
        for(let activity of this.currentActivities){
          this.allActivities.push(activity);
        }
        this.reloadActivities(this.allActivities);
      });
    });
  }

  /**
   * Reloads activities' information for the search table
   * @param {Activity[]} activities
   */
  reloadActivities(activities: Activity[]){
    this.readyToShow = false;
    this.activities = activities;
    this.totalActivities =  activities.length;
    this.showedActivities = activities.slice(0, this.pageTermSize);
    this.currentPageActivity = 0;
    this.readyToShow = true;
  }

  /**
   * Manage page changing on the search table
   */
  activityPageChange(){
    if(this.activities) {
      this.showedActivities = this.activities.slice((this.currentPageActivity - 1) * this.pageActivitySize, ((this.currentPageActivity) * this.pageActivitySize));
    }
  }

  /**
   * Searches an activity by name
   */
  searchActivity(){
    let activitiesToShow = [];
    if(this.searchActivityQuery.length >= 1) {
      for (let activity of this.allActivities) {
        if (activity.name.toLowerCase().startsWith(this.searchTermQuery.toLowerCase())) {
          activitiesToShow.push(activity);
        }
      }
      this.reloadActivities(activitiesToShow);
    }else{
      this.reloadActivities(this.allActivities);
    }
  }

  /**
   * Returns if the specified activity is actually part of the current multimedia
   *
   * @param {number} id
   * @returns {boolean}
   */
  activityBelongsTo(id: number): boolean{
    for(let currentActivity of this.currentActivities){
      if (id == currentActivity.id){
        return true;
      }
    }
    return false;
  }

  /**
   * Adds an activityMultimedia relation between the current multimedia and the activity on the specified position
   *
   * @param {number} i
   */
  addActivityMultimedia(i : number){
    this.currentTermIndex = ((this.currentPageTerm - 1) * this.pageTermSize) + i;
    this.activityService.addActivityMultimedia(this.showedActivities[i].id, this.currentMultimedia.id).subscribe((activity: Activity) =>{
      if(activity){
        this.updateActivities();
      }
    });
  }

  /**
   * Deletes the activityMultimedia relation between the current multimedia and the activity on the specified position
   *
   * @param {number} i
   */
  deleteActivityMultimedia(i: number){
    this.currentActivityIndex = ((this.currentPageActivity - 1) * this.pageActivitySize) + i;
    this.activityService.getActivityMultimedia(this.showedActivities[i].id, this.currentMultimedia.id).subscribe((id: number) => {
      this.activityService.deleteActivityMultimedia(id).subscribe((deleted: boolean) => {
        if (deleted) {
          this.updateActivities();
        }
      });
    });
  }

}
