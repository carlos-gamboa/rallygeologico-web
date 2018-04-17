import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { AppComponent } from './app.component';
import { AppRoutingModule } from "./app-routing.module";

import { RegisterComponent } from './register/register.component';
import { LandingComponent } from './landing/landing.component';
import { LoginComponent } from "./login/login.component";
import {CommonModule} from "@angular/common";
import {UserModule} from "./user/user.module";
import {AboutUsComponent} from "./about-us/about-us.component";
import {DefinitionComponent} from "./definition/definition.component";
import {GlossaryComponent} from "./glossary/glossary.component";
import {InstructionsComponent} from "./instructions/instructions.component";
import {RalliesComponent} from "./rallies/rallies.component";
import {RallyComponent} from "./rally/rally.component";
import {PublicHeaderComponent} from "./public-header/public-header.component";
import {PublicFooterComponent} from "./public-footer/public-footer.component";


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
      PublicFooterComponent
  ],
  imports: [
      BrowserModule,
      FormsModule,
      HttpModule,
      AppRoutingModule,
      CommonModule,
      NgbModule.forRoot(),
      NgbModule,
      UserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule {
    /*constructor(private backendWs : BackendEndpointsService){
        this.backendWs.updatePrefix('http://localhost:7070');
    }*/
}
