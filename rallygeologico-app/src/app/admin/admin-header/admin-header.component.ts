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

    constructor(private userService: UserService,private router: Router,  private dataService: DataService) {
        this.assetsUrl = environment.assetsUrl;
    }

    ngOnInit() {

    }

    async ngAfterViewInit() {
        await this.loadScript(this.assetsUrl+"assets/js/jquery-2.2.4.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/superfish.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.magnific-popup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/jquery.counterup.min.js");
        await this.loadScript(this.assetsUrl+"assets/js/main.js");
    }

    private loadScript(scriptUrl: string) {
        return new Promise((resolve, reject) => {
            const scriptElement = document.createElement('script');
            scriptElement.src = scriptUrl;
            scriptElement.type = "text/javascript";
            scriptElement.onload = resolve;
            document.body.appendChild(scriptElement);
        })
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
