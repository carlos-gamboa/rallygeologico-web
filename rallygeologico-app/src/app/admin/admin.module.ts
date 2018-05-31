import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { CompetitionComponent } from './competition/competition.component';
import { EditCompetitionComponent } from './edit-competition/edit-competition.component';

@NgModule({
  imports: [
    CommonModule
  ],
  declarations: [LoginComponent, CompetitionComponent, EditCompetitionComponent]
})
export class AdminModule { }
