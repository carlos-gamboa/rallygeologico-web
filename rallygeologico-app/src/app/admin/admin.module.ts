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
import { EditRallyComponent } from './edit-rally/edit-rally.component';
import {EditSiteComponent} from "./edit-site/edit-site.component";
import { EditCantonComponent } from './edit-canton/edit-canton.component';
import { EditDistrictComponent } from './edit-district/edit-district.component';
import { AdminHeaderComponent } from './admin-header/admin-header.component';

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
        AdminComponent,
        EditRallyComponent,
        EditSiteComponent,
        EditCantonComponent,
        EditDistrictComponent,
        AdminHeaderComponent
    ],
    exports: [
        PublicFooterComponent
    ]
})
export class AdminModule { }
