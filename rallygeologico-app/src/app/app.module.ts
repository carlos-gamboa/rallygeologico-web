import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {FormsModule} from '@angular/forms';
import {HttpModule} from '@angular/http';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {AppComponent} from './app.component';
import {AppRoutingModule} from "./app-routing.module";
import {RegisterComponent} from './register/register.component';
import {LandingComponent} from './landing/landing.component';
import {LoginComponent} from "./login/login.component";
import {CommonModule} from "@angular/common";
import {UserModule} from "./user/user.module";
import {AboutUsComponent} from "./about-us/about-us.component";
import {DefinitionComponent} from "./definition/definition.component";
import {GlossaryComponent} from "./glossary/glossary.component";
import {InstructionsComponent} from "./instructions/instructions.component";
import {RalliesComponent} from "./rallies/rallies.component";
import {RallyComponent} from "./rally/rally.component";
import {PublicHeaderComponent} from "./public-header/public-header.component";
import {PublicFooterComponent} from "./admin/public-footer/public-footer.component";
import {FacebookModule} from 'ngx-facebook';
import {DataService} from "./services/data/data.service";
import {UserService} from "./services/user.service";
import {Configuration} from "./services/data/constants";
import {HttpClient, HttpClientModule, HttpHandler} from "@angular/common/http";
import {RallyService} from "./services/rally.service";
import {InvitationService} from "./services/invitation.service";
import {CompetitionService} from "./services/competition.service";
import {AgmCoreModule} from '@agm/core';
import {AgmSnazzyInfoWindowModule} from '@agm/snazzy-info-window';
import {SiteComponent} from './site/site.component';
import {SiteService} from "./services/site.service";
import {environment} from "../environments/environment";
import {CompetitionStatisticsService} from "./services/competition.statistics.service";
import {AdminModule} from "./admin/admin.module";
import {TermService} from "./services/term.service";
import {MultimediaService} from "./services/multimedia.service";
import {DistrictService} from "./services/district.service";
import {CantonService} from "./services/canton.service";
import {ProvinceService} from "./services/province.service";
import {ActivityService} from "./services/activity.service";

import { ForgotPasswordComponent } from './forgot-password/forgot-password.component';
import { TokenLandingComponent } from './token-landing/token-landing.component';
import 'hammerjs'
import 'mousetrap'
import {ModalGalleryModule} from "angular-modal-gallery";

@NgModule({
  declarations: [
      AppComponent,
      LoginComponent,
      RegisterComponent,
      LandingComponent,
      AboutUsComponent,
      DefinitionComponent,
      GlossaryComponent,
      InstructionsComponent,
      RalliesComponent,
      RallyComponent,
      PublicHeaderComponent,
      SiteComponent,
      ForgotPasswordComponent,
      TokenLandingComponent,
  ],
  imports: [
      BrowserModule,
      FormsModule,
      HttpModule,
      AppRoutingModule,
      CommonModule,
      NgbModule.forRoot(),
      NgbModule,
      UserModule,
      AdminModule,
      FacebookModule.forRoot(),
      HttpClientModule,
      AgmCoreModule.forRoot({
          apiKey: environment.googleMapsKey
      }),
      AgmSnazzyInfoWindowModule,
      ModalGalleryModule.forRoot()
  ],
  providers: [DataService, UserService, Configuration, RallyService, InvitationService, CompetitionService, SiteService, CompetitionStatisticsService, TermService, MultimediaService, DistrictService, CantonService, ProvinceService, ActivityService],
  bootstrap: [AppComponent]
})
export class AppModule {
}
