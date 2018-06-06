import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { EditCompetitionComponent } from './edit-competition/edit-competition.component';
import {PublicFooterComponent} from "./public-footer/public-footer.component";
import {AdminRoutingModule} from "./admin-routing.module";
import {AdminComponent} from "./admin.component";
import {FormsModule} from "@angular/forms";
import {MatDatepickerModule, MatGridListModule, MatNativeDateModule} from "@angular/material";
import {NgbModule, NgbPaginationModule} from "@ng-bootstrap/ng-bootstrap";
import {EditTermComponent} from "./edit-term/edit-term.component";

@NgModule({
    imports: [
        CommonModule,
        AdminRoutingModule,
        MatGridListModule,
        NgbPaginationModule,
        FormsModule,
        NgbModule,
        MatDatepickerModule,
        MatNativeDateModule,
    ],
    declarations: [
        LoginComponent,
        EditCompetitionComponent,
        EditTermComponent,
        PublicFooterComponent,
        AdminComponent],
    exports: [
        PublicFooterComponent
    ]
})
export class AdminModule { }
