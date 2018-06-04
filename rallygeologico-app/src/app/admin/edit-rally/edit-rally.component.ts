import { Component, OnInit } from '@angular/core';
import {Rally} from "../../model/rally";
import {DataService} from "../../services/data/data.service";
import {UserService} from "../../services/user.service";
import {RallyService} from "../../services/rally.service";
import {Router} from "@angular/router";
import {User} from "../../model/user";

@Component({
  selector: 'app-edit-rally',
  templateUrl: './edit-rally.component.html',
  styleUrls: ['./edit-rally.component.css']
})
export class EditRallyComponent implements OnInit {

  readyToShow: boolean;
  user: User;
  rallySelected: boolean;
  rallyCreated: boolean;

  searchQuery: string;
  ralliesList: Rally[];
  allRallies: Rally[];
  showedRallies: Rally[];

  totalRallies: number;
  currentPageRally: number;
  pageSize: number;
  currentRallyIndex: number;

  name: string;
  points: number;
  imageUrl: string;
  description: string;
  latitude: number;
  longitude: number;

  currentRally: Rally;
  newRally: boolean;
  changesSaved: boolean;
  messageType: boolean;
  alertMessage: string;
  rallyDeleted: boolean;

  constructor(private rallyService: RallyService, private userService: UserService,
              private dataService: DataService, private router: Router) {
    this.readyToShow = false;
    this.rallySelected = false;
    this.totalRallies = 0;
    this.currentPageRally = 0;
    this.pageSize = 10;
    this.newRally = false;
    this.changesSaved = false;
    this.messageType = false;
    this.rallyDeleted = false;
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

  setupData(){
      this.rallyService.getAllRallies().subscribe((rallies: Rally[]) => {
          console.log(rallies);
          this.allRallies = rallies;
          this.reloadRallies(this.allRallies);
          this.readyToShow = true;
      });
  }

  reloadRallies(rallies: Rally[]){
      this.ralliesList = rallies;
      this.totalRallies = rallies.length;
      this.showedRallies = rallies.slice(0, this.pageSize);
      this.currentPageRally = 0;
  }

  rallyPageChange(){
      if(this.ralliesList) {
          this.showedRallies = this.ralliesList.slice((this.currentPageRally - 1) * this.pageSize, ((this.currentPageRally) * this.pageSize));
      }
  }

  searchRally(){
      let ralliesToShow = [];
      if(this.searchQuery.length >= 1) {
          for (let rally of this.allRallies) {
              if (rally.name.toLowerCase().startsWith(this.searchQuery.toLowerCase())) {
                  ralliesToShow.push(rally);
              }
          }
          this.reloadRallies(ralliesToShow);
      }else{
          this.reloadRallies(this.allRallies);
      }
  }

  edit(i: number){
      this.readyToShow = true;
      this.rallySelected = true;
      this.changesSaved = false;
      this.rallyDeleted = false;
      if (i == -1){
          this.newRally = true;
          this.currentRally = null;
      } else {
          this.currentRally = this.showedRallies[i];
          this.currentRallyIndex = ((this.currentPageRally - 1) * this.pageSize) + i;
          //this.updateStatistics();
      }
      this.editRallyChange();
  }

  editRallyChange(){
      if (this.currentRally) {
          this.name = this.currentRally.name;
          this.points = this.currentRally.points_awarded;
          this.latitude = this.currentRally.latitude;
          this.longitude = this.currentRally.longitude;
          this.imageUrl = this.currentRally.image_url;
          this.description = this.currentRally.description;
      }
  }

  saveChanges(){
      this.changesSaved = false;
      this.rallyDeleted = false;
      if (!this.currentRally){
          this.rallyService.adminAddRally(this.name, this.points, this.latitude, this.longitude, this.imageUrl, this.description).subscribe((rally: Rally) => {
              if (rally){
                  this.currentRally = rally;
                  this.allRallies.push(this.currentRally);
                  this.rallyCreated = true;
                  this.changesSaved = true;
                  this.messageType = true;
                  this.newRally = false;
                  this.alertMessage = "El rally ha sido creado.";
              } else {
                  this.messageType = false;
                  this.alertMessage = "No se pudo crear el rally.";
              }
          });
      } else {
          this.rallyService.editRally(this.currentRally.id, this.name, this.points, this.latitude, this.longitude, this.imageUrl, this.description).subscribe((rally: Rally) => {
              this.changesSaved = true;
              if (rally){
                  this.currentRally = rally;
                  this.allRallies[this.currentRallyIndex] = this.currentRally;
                  this.messageType = true;
                  this.alertMessage = "Se han guardado los cambios.";
              } else {
                  this.alertMessage = "No se pudo guardar los cambios.";
                  this.messageType = false;

              }
          });
      }
  }

  deleteRally(){
      this.rallyDeleted = false;
      this.changesSaved = false;
      this.rallyService.deleteRally(this.currentRally.id).subscribe((deleted: boolean) => {
          this.rallyDeleted = true;
          if (deleted){
              this.currentRally = null;
              this.allRallies.splice(this.currentRallyIndex, 1);
              this.messageType = true;
              this.alertMessage = "Se ha eliminado el rally.";
          } else {
              this.messageType = false;
              this.alertMessage = "No se pudo eliminar el rally.";
          }
      });
  }
}
