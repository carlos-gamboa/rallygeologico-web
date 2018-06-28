import { Component, OnInit } from '@angular/core';
import {environment} from "../../environments/environment";
import {User} from "../model/user";
import {UserService} from "../services/user.service";
import {DataService} from "../services/data/data.service";

@Component({
  selector: 'app-instructions',
  templateUrl: './instructions.component.html',
  styleUrls: ['./instructions.component.css']
})
export class InstructionsComponent implements OnInit {

  assetsUrl: string;
  user: User;

  constructor(private userService: UserService, private dataService: DataService,) {
    this.assetsUrl = environment.assetsUrl;
    this.user = this.dataService.getUser();
    if (!this.user){
       this.userService.isLoggedIn().subscribe((users: User) => {
           if(users[0]){
              this.dataService.updateUser(users[0]);
              this.user = users[0];
           }
       });
    }
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

}
