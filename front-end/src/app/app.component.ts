import { Component } from '@angular/core';
import { ItemsServiceService } from './items-service/items-service.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'front-end';


  cartVisible = false;
  searchVisible = true;
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

  changeStatus() {
    if(this.searchVisible == true) {
      this.searchVisible = false;
    } else {
      this.searchVisible = true;
    }
    if(this.cartVisible == true) {
      this.cartVisible = false;
    } else {
      this.cartVisible = true;
    }
  }

  addToCart(item) {
    this.cart.push(item);
  }

  getItems() {
    this.itemsService.getItems(this.basicSearch).subscribe(
      (res: String[]) => {
        this.result = res;
        return this.result;
      }
    )
  }

  removeItem(x) {
    this.cart.splice(x,1);
    console.log('this cart:'  ,this.cart);
  }

}
