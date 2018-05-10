import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-rally',
  templateUrl: './rally.component.html',
  styleUrls: ['./rally.component.css']
})
export class RallyComponent implements OnInit {

  initialLatitude: number;
  initialLongitude: number;
  zoom: number;

  constructor() {
    this.initialLatitude = 10.4958;
    this.initialLongitude = -85.355;
    this.zoom = 9;
  }

  ngOnInit() {
  }

}
