import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {UserComponent} from "./user.component";
import {NgbModule, NgbPaginationModule} from "@ng-bootstrap/ng-bootstrap";
import {FormsModule} from "@angular/forms";
import {UserRoutingModule} from "./user-routing.module";
import {MatDatepickerModule, MatGridListModule, MatNativeDateModule} from "@angular/material";
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { ProfileComponent } from './profile/profile.component';
import { CompetitionComponent } from './competition/competition.component';
import { CreateCompetitionComponent} from "./create-competition/create-competition.component";
import {AgmSnazzyInfoWindowModule} from "@agm/snazzy-info-window";
import {AgmCoreModule} from "@agm/core";
import {environment} from "../../environments/environment";
import { SearchRalliesComponent } from './search-rallies/search-rallies.component';

@NgModule({
  imports: [
      UserRoutingModule,
      MatGridListModule,
      CommonModule,
      NgbPaginationModule,
      FormsModule,
      NgbModule,
      MatDatepickerModule,
      MatNativeDateModule,
      AgmCoreModule.forRoot({
          apiKey: environment.googleMapsKey
      }),
      AgmSnazzyInfoWindowModule
  ],
  declarations: [
      UserComponent,
      HeaderComponent,
      FooterComponent,
      DashboardComponent,
      ProfileComponent,
      CompetitionComponent,
      CreateCompetitionComponent,
      SearchRalliesComponent
  ],
    exports: [
        HeaderComponent,
        FooterComponent,
        CreateCompetitionComponent
    ]
})
export class UserModule { }
