import {Component, OnInit, ViewChild} from '@angular/core';
import {Rally} from "../../model/rally";
import {RallyService} from "../../services/rally.service";
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {CompetitionService} from "../../services/competition.service";
import {InvitationService} from "../../services/invitation.service";
import {Invitation} from "../../model/invitation";
import {Competition} from "../../model/competition";
import {CompetitionStatisticsService} from "../../services/competition.statistics.service";
import {CompetitionStatistics} from "../../model/competition.statistics";
import {Router} from "@angular/router";
import {NgForm} from "@angular/forms";

@Component({
  selector: 'app-create-competition',
  templateUrl: './create-competition.component.html',
  styleUrls: ['./create-competition.component.css']
})
export class CreateCompetitionComponent implements OnInit {

    ralliesList: Rally[] = [];

    user: User;
    users : User[];
    allUsers: User[];
    showedUsers: User[];

    pageSize : number = 10;
    currentPage : number = 0;
    totalUsers : number = 0;

    searchQuery : string = "";

    currentCompetition: Competition;

    name: string = "";
    is_public: string = "1";
    rally_id: string = "1";
    description: string = "";

    competitionCreated: boolean;

    invitedUsers: number[] = [];

    invalidForm: boolean;

    /**
     * Creates a CreateCompetitionComponent, initialize the components
     * @param {RallyService} rallyService
     * @param {UserService} userService
     * @param {DataService} dataService
     * @param {CompetitionService} competitionService
     * @param {InvitationService} invitationService
     * @param {CompetitionStatisticsService} competitionStatisticsService
     * @param {Router} router
     */
  constructor(private rallyService: RallyService, private userService: UserService,
              private dataService: DataService, private competitionService: CompetitionService,
              private invitationService: InvitationService,
              private competitionStatisticsService: CompetitionStatisticsService,  private router: Router) {
        this.competitionCreated = false;
        this.invalidForm = false;
        this.user = this.dataService.getUser();
        if (!this.user) {
            this.userService.isLoggedIn().subscribe((users: User) => {
                if (users[0]) {
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

  setupData(){
      this.rallyService.getNewestRallies().subscribe((rallies: Rally[]) => {
          for (let i: number = 0; i < rallies.length; ++i) {
              this.ralliesList.push(rallies[i]);
          }
          console.log(this.ralliesList);
      });
      this.allUsers = [];
      this.userService.getUsers().subscribe((users: User[]) => {
          for (let user of users){
              if (user.id != this.user.id){
                  this.allUsers.push(user);
              }
          }
          this.reloadUsers(this.allUsers);
          //console.log(this.allUsers);
      });
  }

    /**
     * Reloads the corresponding users in the table
     * @param {User[]} users
     */
  reloadUsers(users : User[]) : void{
      this.users = users;
      this.totalUsers = users.length;
      this.showedUsers = users.slice(0, this.pageSize);
      this.currentPage = 0;
  }

    /**
     * Selects the number of users' pages
     */
  pageChange() : void{
      if(this.users) {
          this.showedUsers = this.users.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
      }
  }

    /**
     * Searches a specified user
     */
  searchUser(){
      let usersToShow = [];
      if(this.searchQuery.length >= 1) {
         for (let user of this.allUsers) {
             if (user.username.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                 usersToShow.push(user);
             }
         }
         this.reloadUsers(usersToShow);
      }else{
         this.reloadUsers(this.allUsers);
      }
  }

    /**
     * Creates a competition calling the corresponding service
     */
  createCompetition(){
      if(this.name.length < 1 || this.is_public.length < 1 || this.rally_id.length < 1){
          this.invalidForm = true;
      } else {
          this.competitionService.createCompetition(this.is_public, this.user.id, this.description, this.name, this.rally_id).subscribe((competition: Competition) => {
              if (competition) {
                  this.currentCompetition = competition;
                  this.competitionStatisticsService.createCompetitionStatistics(this.user.id, this.currentCompetition.id).subscribe((statistics: CompetitionStatistics) => {
                      if (statistics) {
                          this.competitionCreated = true;
                      } else {
                          console.log("Couldn't create competition");
                      }
                  });
              } else {
                  console.log("Couldn't create competition");
              }
          });
      }
  }

  addOtherCompetition(competitionForm: NgForm){
      this.competitionCreated = false;
      this.searchQuery = "";
      this.invitedUsers = [];
      competitionForm.reset();
  }

    /**
     * Creates an invitation calling the corresponding service, using the current competition_Id as a parameter
     * @param {number} index
     */
  invite (index: number){
      if(this.competitionCreated){
          this.invitationService.sendInvitation( this.user.id, this.showedUsers[index].id, this.currentCompetition.id,).subscribe((invitation: Invitation) => {
              if (invitation){
                  this.invitedUsers.push(invitation.user_id_receive);
                  console.log("Invitation sent");
              } else {
                  console.log("Couldn't send invitation");
              }
          });
      }
  }

}
