import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {FormsModule} from '@angular/forms';
import {HttpModule} from '@angular/http';
import {AppComponent} from './app.component';
import {AppRoutingModule} from "./app-routing.module";
import {LoginComponent} from "./login/login.component";
import {CommonModule} from "@angular/common";
import {FacebookModule} from 'ngx-facebook';
import {DataService} from "./services/data/data.service";
import {UserService} from "./services/user.service";
import {Configuration} from "./services/data/constants";
import {HttpClient, HttpClientModule, HttpHandler} from "@angular/common/http";
import {RallyService} from "./services/rally.service";
import {InvitationService} from "./services/invitation.service";
import {CompetitionService} from "./services/competition.service";
import {SiteService} from "./services/site.service";
import {environment} from "../environments/environment";
import {PublicHeaderComponent} from "./public-header/public-header.component";
import {PublicFooterComponent} from "./public-footer/public-footer.component";


@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    PublicFooterComponent,
    PublicHeaderComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    AppRoutingModule,
    CommonModule,
    FacebookModule.forRoot(),
    HttpClientModule
  ],
  providers: [DataService, UserService, Configuration, RallyService, InvitationService, CompetitionService, SiteService],
  bootstrap: [AppComponent]
})
export class AppModule {
  /*constructor(private backendWs : BackendEndpointsService){
      this.backendWs.updatePrefix('http://localhost:7070');
  }*/
}
