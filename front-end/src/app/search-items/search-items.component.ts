import { Component, OnInit } from '@angular/core';
import { ItemsServiceService } from '../items-service/items-service.service';

@Component({
  selector: 'app-search-items',
  templateUrl: './search-items.component.html',
  styleUrls: ['./search-items.component.scss']
})
export class SearchItemsComponent implements OnInit {


  searchItem: String;
  result: String[]

  constructor(
    private itemsService: ItemsServiceService;
  ) { 
    this.searchItem = '';
    this.result = [];
  }

  ngOnInit() {
  }

  getItems() {
    this.itemsService.getItems(this.searchItem).subscribe(
      (res) => {
        
      }
    )
  }

}
