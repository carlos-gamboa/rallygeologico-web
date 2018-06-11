import {Component, Input, OnInit} from '@angular/core';
import {User} from "../../model/user";
import {UserService} from "../../services/user.service";
import {Router} from "@angular/router";
import {DataService} from "../../services/data/data.service";
import {environment} from "../../../environments/environment";

@Component({
    selector: 'app-admin-header',
    templateUrl: './admin-header.component.html',
    styleUrls: ['./admin-header.component.css']
})
export class AdminHeaderComponent implements OnInit {

    @Input() activeTab: number;
    assetsUrl: string;
    user: User;

    constructor(private userService: UserService,private router: Router,  private dataService: DataService) {
        this.assetsUrl = environment.assetsUrl;
        this.user = this.dataService.getUser();
        if (!this.user){
            this.userService.isLoggedIn().subscribe((users: User) => {
                if(users[0] && users[0].is_admin == 1){
                    this.dataService.updateUser(users[0]);
                    this.user = users[0];
                } else {
                    this.router.navigate(['/landing']);
                }
            });
        } else if (this.user.is_admin == 0){
            this.router.navigate(['/landing']);
        }
    }

    ngOnInit() {

    }

    isActive(active){
        return (this.activeTab === active);
    }

    changeActive(active){
        this.activeTab = active;
    }

    logout() {
        this.userService.logout().subscribe((user: User)=>{
            console.log(user);
            this.dataService.updateUser(null);
            setTimeout(() => {
                    this.router.navigate(['/landing']);
                },
                1000);
        } );
    }

}
