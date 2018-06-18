import {Component, OnInit} from '@angular/core';
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {Router} from "@angular/router";
import {Multimedia} from "../../model/multimedia";
import {MultimediaService} from "../../services/multimedia.service";
import {TermService} from "../../services/term.service";
import {Term} from "../../model/term";

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

    name: string;
    media_type: number;
    media_url: string;

    /**
     * Creates a EditMultimediaComponent
     *
     * @param {MultimediaService} multimediaService
     * @param {UserService} userService
     * @param {DataService} dataService
     * @param {Router} router
     */
    constructor(private multimediaService: MultimediaService, private termsService: TermService, private userService: UserService,
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
            this.multimediaService.addMultimedia(this.name, this.media_type, this.media_url).subscribe((multimedia: Multimedia[]) => {
                if (multimedia){
                    this.currentMultimedia = multimedia[0];
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
     *
     * @param {number} i
     */
    deleteMultimedia(i: number){
        this.multimediaDeleted = false;
        this.changesSaved = false;
        this.multimediaService.getMultimedia(this.showedMultimedia[i].id).subscribe((multimedia: Multimedia) => {
            this.currentMultimedia = multimedia;
            this.currentMultimediaIndex = ((this.currentPageMultimedia - 1) * this.pageSize) + i;
            this.multimediaService.deleteMultimedia(this.currentMultimedia.id).subscribe((deleted: boolean) => {
                this.multimediaDeleted = deleted;
                if (deleted){
                    this.currentMultimedia = null;
                    this.allMultimedia.splice(this.currentMultimediaIndex, 1);
                    this.reloadMultimedia(this.allMultimedia);
                    this.messageType = true;
                    this.alertMessage = "Multimedia se ha eliminado.";
                } else {
                    this.messageType = false;
                    this.alertMessage = "Multimedia no se pudo eliminar.";
                }
            });
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
    }

    /**
     * Loads all terms'information
     */
    updateTerms(){
        this.allTerms = [];
        this.termsService.getOtherTerms(this.currentMultimedia.id).subscribe((otherTerms: Term[]) => {
            this.otherTerms = otherTerms;
            console.log(this.otherTerms);
            this.termsService.getAssociatedTerms(this.currentMultimedia.id).subscribe((currentTerms: Term[]) => {
                this.currentTerms = currentTerms;
                console.log(this.currentTerms);
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
        this.termsService.addTermMultimedia(this.currentMultimedia.id, this.showedTerms[i].id).subscribe((term: Term) =>{
            if(term){
                this.updateTerms();
                this.reloadTerms(this.allTerms);
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
        this.termsService.getTermMultimedia(this.currentMultimedia.id, this.showedTerms[i].id).subscribe((id: number) => {
            this.termsService.deleteTermMultimedia(id).subscribe((deleted: boolean) => {
                if (deleted) {
                    this.updateTerms();
                    this.reloadTerms(this.allTerms);
                }
            });
        });
    }

}
