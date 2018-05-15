import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-search-rallies',
  templateUrl: './search-rallies.component.html',
  styleUrls: ['./search-rallies.component.css']
})
export class SearchRalliesComponent implements OnInit {

    searchQuery : string = "";

  constructor() { }

  ngOnInit() {
  }

  searchCompetition(){

  }

}
