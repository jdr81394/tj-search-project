import { Component, OnInit } from '@angular/core';
import { ItemsServiceService } from '../items-service/items-service.service';

@Component({
  selector: 'app-search-items',
  templateUrl: './search-items.component.html',
  styleUrls: ['./search-items.component.scss']
})
export class SearchItemsComponent implements OnInit {

  basicSearch: String;
  result: String[]

  constructor(
    private itemsService: ItemsServiceService
  ) { 
    this.basicSearch = '';
    this.result = [];
  }

  ngOnInit() {
  }

  getItems() {
    this.itemsService.getItems(this.basicSearch).subscribe(
      (res: String[]) => {
        this.result = res;
        console.log("this result:   "  ,this.result);
        return this.result;

      }
    )
  }

}
