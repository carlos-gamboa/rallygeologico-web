import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {UserComponent} from "./user.component";
import {NgbModule, NgbPaginationModule} from "@ng-bootstrap/ng-bootstrap";
import {FormsModule} from "@angular/forms";
import {UserRoutingModule} from "./user-routing.module";
import {MatGridListModule} from "@angular/material";
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { ProfileComponent } from './profile/profile.component';
import { GlossaryComponent } from './glossary/glossary.component';

@NgModule({
  imports: [
      UserRoutingModule,
      MatGridListModule,
      CommonModule,
      NgbPaginationModule,
      FormsModule,
      NgbModule,
  ],
  declarations: [
      UserComponent,
      HeaderComponent,
      FooterComponent,
      DashboardComponent,
      ProfileComponent,
      GlossaryComponent,
  ]
})
export class UserModule { }
