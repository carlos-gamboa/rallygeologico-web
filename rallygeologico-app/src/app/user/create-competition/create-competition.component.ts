import {Component, OnInit} from '@angular/core';
import {Rally} from "../../model/rally";
import {RallyService} from "../../services/rally.service";
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {DataService} from "../../services/data/data.service";
import {CompetitionService} from "../../services/competition.service";
import {InvitationService} from "../../services/invitation.service";
import {Invitation} from "../../model/invitation";
import {Competition} from "../../model/competition";

@Component({
  selector: 'app-create-competition',
  templateUrl: './create-competition.component.html',
  styleUrls: ['./create-competition.component.css']
})
export class CreateCompetitionComponent implements OnInit {

  ralliesList: Rally[] = [];

  minDate = new Date(2000, 0, 1);
  maxDate = new Date(2020, 0, 1);

  user: User;
  users : User[];
  allUsers: User[];
  showedUsers: User[];

  currentCompetition: Competition;

  pageSize : number = 10;
  currentPage : number = 0;
  totalUsers : number = 0;

  searchQuery : string = "";

  name: string;
  is_public: string;
  is_active: string;
  rally_id: string;
  description: string;

  competitionCreated: boolean;

  constructor(private rallyService: RallyService, private userService: UserService, private dataService: DataService, private competitionService: CompetitionService, private invitationService: InvitationService) {
      this.rallyService.getNewestRallies().subscribe((rallies: Rally[])=>{
          for (let i: number = 0; i < rallies.length; ++i){
              this.ralliesList.push(rallies[i]);
          }
          console.log(this.ralliesList);
      });
      this.user = this.dataService.getUser();
      this.userService.getUsers().subscribe((users: User[]) => {
          this.allUsers = users;
          this.reloadUsers(users);
          //console.log(this.allUsers);
      });
      this.competitionCreated = false;
  }

  ngOnInit() {
  }

  reloadUsers(users : User[]) : void{
      this.users = users;
      this.totalUsers = users.length;
      this.showedUsers = users.slice(0, this.pageSize);
      this.currentPage = 0;
  }

  pageChange() : void{
      if(this.users) {
          this.showedUsers = this.users.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
      }
  }

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

  createCompetition(){

      this.competitionService.createCompetition(this.is_public, this.user.id, this.description, this.name, this.rally_id).subscribe((competition: Competition) => {
          if (competition){
              this.currentCompetition = competition;
              this.competitionCreated = true;
              console.log("Competition created");
              console.log(this.currentCompetition);
          } else {
              console.log("Couldn't create competition");
          }
      });
  }

  invite (index: number){
      if(this.competitionCreated){
          this.invitationService.sendInvitation(this.currentCompetition.id, this.showedUsers[index].id, this.user.id).subscribe((invitation: Invitation[]) => {
              if(invitation){
                  console.log("Invitation sent");
              } else {
                  console.log("Couldn't send invitation");
              }
          });
      }
  }

}
