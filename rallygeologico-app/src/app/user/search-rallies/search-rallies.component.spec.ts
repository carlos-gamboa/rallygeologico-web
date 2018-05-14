import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SearchRalliesComponent } from './search-rallies.component';

describe('SearchRalliesComponent', () => {
  let component: SearchRalliesComponent;
  let fixture: ComponentFixture<SearchRalliesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SearchRalliesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SearchRalliesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
