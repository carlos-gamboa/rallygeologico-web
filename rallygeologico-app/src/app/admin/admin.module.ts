import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { EditCompetitionComponent } from './edit-competition/edit-competition.component';
import {PublicFooterComponent} from "./public-footer/public-footer.component";
import {AdminRoutingModule} from "./admin-routing.module";
import {AdminComponent} from "./admin.component";

@NgModule({
  imports: [
      CommonModule,
      AdminRoutingModule
  ],
  declarations: [LoginComponent,
      EditCompetitionComponent,
      PublicFooterComponent,
      AdminComponent],
  exports: [PublicFooterComponent]
})
export class AdminModule { }
