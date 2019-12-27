import { Component, OnInit } from '@angular/core';
import { ItemsServiceService } from '../items-service/items-service.service';

@Component({
  selector: 'app-search-items',
  templateUrl: './search-items.component.html',
  styleUrls: ['./search-items.component.scss']
})
export class SearchItemsComponent implements OnInit {

  cart: String[];
  basicSearch: String;
  result: String[]

  constructor(
    private itemsService: ItemsServiceService
  ) { 
    this.cart = [];
    this.basicSearch = '';
    this.result = [];
  }

  ngOnInit() {
  }

  addToCart(item) {
    console.log('item is in cart:  ' ,item);
    this.cart.push(item);
    console.log("cart:: "  ,this.cart);
  }

  getItems() {
    console.log("basic search:  "  ,this.basicSearch);
    this.itemsService.getItems(this.basicSearch).subscribe(
      (res: String[]) => {
        this.result = res;
        console.log("this result:   "  ,this.result);
        return this.result;

      }
    )
  }

}
