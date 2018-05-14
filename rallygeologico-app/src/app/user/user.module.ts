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

@NgModule({
  imports: [
      UserRoutingModule,
      MatGridListModule,
      CommonModule,
      NgbPaginationModule,
      FormsModule,
      NgbModule,
      MatDatepickerModule,
      MatNativeDateModule
  ],
  declarations: [
      UserComponent,
      HeaderComponent,
      FooterComponent,
      DashboardComponent,
      ProfileComponent,
      CompetitionComponent,
      CreateCompetitionComponent
  ],
    exports: [
        HeaderComponent,
        FooterComponent,
        CreateCompetitionComponent
    ]
})
export class UserModule { }
