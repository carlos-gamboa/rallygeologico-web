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


@NgModule({
  declarations: [
      AppComponent,
      LoginComponent,
      RegisterComponent,
      LandingComponent,
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
