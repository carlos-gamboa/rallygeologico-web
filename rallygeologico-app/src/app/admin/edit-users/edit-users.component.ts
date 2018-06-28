import { Component, OnInit } from '@angular/core';
import {DataService} from "../../services/data/data.service";
import {UserService} from "../../services/user.service";
import {User} from "../../model/user";
import {Router} from "@angular/router";

@Component({
  selector: 'app-edit-users',
  templateUrl: './edit-users.component.html',
  styleUrls: ['./edit-users.component.css']
})
export class EditUsersComponent implements OnInit {

    users: User[];
    allUsers: User[];
    showedUsers: User[];

    user: User;

    pageSize : number = 10;
    totalUsers : number = 0;
    currentPage: number = 0;
    clickedUser: number = -1;

    searchQuery : string = "";

    currentUser: User;
    currentUserIndex: number;

    username: string;
    api_id: string;
    password: string;
    first_name: string;
    last_name: string;
    email: string;
    photo_url: string;
    is_admin: string;
    login_api: string;
    password_needs_change: string;
    is_active: string;

    changesSaved: boolean;
    deleted: boolean;
    alertMessage: string;
    messageType: boolean;

    newUser: boolean;
    userSelected: boolean;
    readyToShow: boolean;
    activeTab: number;

    constructor(private userService: UserService,
                private dataService: DataService,
                private router: Router) {
        this.readyToShow = false;
        this.user = this.dataService.getUser();
        if (!this.user) {
            this.userService.isLoggedIn().subscribe((users: User) => {
                if (users[0] && users[0].is_admin == 1) {
                    this.dataService.updateUser(users[0]);
                    this.user = users[0];
                    console.log(users[0]);
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
        this.userService.getUsers().subscribe((users: User[]) => {
            this.allUsers = users;
            this.reloadUsers(this.allUsers);
            this.readyToShow = true;
        });
    }

    /**
     * Reloads the corresponding users in the table
     * @param {User[]} user
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
    userPageChange() : void{
        if(this.users) {
            this.showedUsers = this.users.slice((this.currentPage - 1) * this.pageSize, ((this.currentPage) * this.pageSize));
        }
    }

    /**
     * Searches a specified competition
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

    saveChanges(){
        this.changesSaved = false;
        this.deleted = false;
        if (!this.currentUser){
            this.userService.emailExists(this.email).subscribe((emailUsed: boolean) => {
                if (!emailUsed) {
                    this.userService.usernameExists(this.username).subscribe((usernameTaken: boolean) => {
                        if (!usernameTaken) {
                            this.userService.register(this.api_id, this.username, this.first_name, this.last_name, this.email, this.photo_url, +this.login_api, this.password, +this.password_needs_change, +this.is_active, +this.is_admin).subscribe((user: User[]) => {
                                if (user[0]) {
                                    this.currentUser = user[0];
                                    this.allUsers.push(this.currentUser);
                                    this.changesSaved = true;
                                    this.messageType = true;
                                    this.newUser = false;
                                    this.changesSaved = true;
                                    this.alertMessage = "El usuario ha sido creado.";
                                    this.updateUsers();
                                } else {
                                    this.changesSaved = true;
                                    this.messageType = false;
                                    this.alertMessage = "No se pudo crear el usuario.";
                                }
                            });
                        } else {
                            this.changesSaved = true;
                            this.messageType = false;
                            this.alertMessage = "El nombre de usuario ya está siendo utilizado.";
                        }
                    });
                } else {
                    this.changesSaved = true;
                    this.messageType = false;
                    this.alertMessage = "El email ya está siendo utilizado.";
                }
            });
        } else {
            this.userService.emailExists(this.email).subscribe((emailUsed: boolean) => {
                if (!emailUsed || this.email == this.currentUser.email) {
                    this.userService.usernameExists(this.username).subscribe((usernameTaken: boolean) => {
                        if (!usernameTaken || this.username == this.currentUser.username) {
                            this.userService.editUser(this.currentUser.id, this.api_id,this.username,this.first_name,this.last_name,this.email,this.photo_url, +this.login_api,this.password, +this.password_needs_change, +this.is_active, +this.is_admin).subscribe((user: User) => {
                                if (user){
                                    this.currentUser = user;
                                    this.allUsers[this.currentUserIndex] = this.currentUser;
                                    this.messageType = true;
                                    this.alertMessage = "Se han guardado los cambios.";
                                    this.changesSaved = true;
                                    this.updateUsers();
                                } else {
                                    this.alertMessage = "No se pudo guardar los cambios.";
                                    this.changesSaved = true;
                                    this.messageType = false;
                                }
                            });
                        } else {
                            this.changesSaved = true;
                            this.messageType = false;
                            this.alertMessage = "El nombre de usuario ya está siendo utilizado.";
                        }
                    });
                } else {
                    this.changesSaved = true;
                    this.messageType = false;
                    this.alertMessage = "El email ya está siendo utilizado.";
                }
            });
        }
    }

    editUserChange(){
        this.changesSaved = false;
        if (!this.currentUser){
            this.username = "";
            this.api_id = "0";
            this.password = "";
            this.first_name = "";
            this.last_name = "";
            this.email = "";
            this.photo_url = "";
            this.is_admin = "0";
            this.login_api = "0";
            this.password_needs_change = "0";
            this.is_active = "0";
        } else {
            this.username = this.currentUser.username;
            this.api_id = this.currentUser.api_id;
            this.password = "";
            this.first_name = this.currentUser.first_name;
            this.last_name = this.currentUser.last_name;
            this.email = this.currentUser.email;
            this.photo_url = this.currentUser.photo_url;
            this.is_admin = String(this.currentUser.is_admin);
            this.login_api = String(this.currentUser.login_api);
            this.password_needs_change = this.currentUser.password_needs_change;
            this.is_active = this.currentUser.is_active;
        }
    }

    edit(i: number){
        this.activeTab = 0;
        this.userSelected = true;
        this.changesSaved = false;
        this.deleted = false;
        if (i == -1){
            this.newUser = true;
            this.currentUser = null;
            this.readyToShow = true;
        } else {
            this.currentUser = this.showedUsers[i];
            this.currentUserIndex = ((this.currentPage - 1) * this.pageSize) + i;
        }
        this.editUserChange();
    }

    changeTab(i: number){
        this.activeTab = i;
        this.changesSaved = false;
        this.deleted = false;
    }

    goBack(){
        this.userSelected =  false;
        this.currentUser = null;
        this.reloadUsers(this.allUsers);
    }

    /**
     * Loads all users' information
     */
    updateUsers(){
        this.allUsers = [];
        this.userService.getUsers().subscribe((users: User[]) => {
            this.allUsers = users;
            this.reloadUsers(this.allUsers);
        });
    }

    deleteUser(id: number){
        this.deleted = false;
        this.changesSaved = false;
        this.userService.deleteUser(id).subscribe((deleted: boolean) => {
            this.deleted = true;
            if (deleted){
                this.updateUsers();
                this.messageType = true;
                this.alertMessage = "Se ha eliminado el usuario.";
                this.reloadUsers(this.allUsers);
            } else {
                this.messageType = false;
                this.alertMessage = "No se pudo eliminar el usuario.";
            }
        });
    }

    isPasswordLogin(){
        return (this.login_api == "3");
    }

}
