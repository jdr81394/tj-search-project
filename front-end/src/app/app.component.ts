import { Component } from '@angular/core';
import { ItemsServiceService } from './items-service/items-service.service';
import { Item } from './classes/item';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'Surge';


  searchVisible = true;
  cart: Item[];
  cartPageOfItems: Item[];
  cartVisible = false;
  basicSearch: String;
  result: String[];
  pageOfItems: String[];
  
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

  onChangePageCart(cartPageOfItems: Item[]) {
    this.cartPageOfItems = cartPageOfItems;
  }

  onChangePage(pageOfItems: Array<any>) {
    // update current page of items
    this.pageOfItems = pageOfItems;
}

  addToCart(event, name) {  
    let quantity = event.srcElement.elements[0].valueAsNumber;
    if(quantity > 0) {
      let item = new Item(name, quantity);
      this.cart.push(item);
      window.alert("Your cart was updated!");
    } else {
      window.alert("Please select a quantity!");
    }
   
  }

  getItems() {
    if(this.basicSearch.length > 0) {
      this.itemsService.getItems(this.basicSearch).subscribe(
        (res: String[]) => {
          this.result = res;
          return this.result;
        }
      )
    } 
  }

  removeItem(x) {
    this.cartPageOfItems.splice(x,1);
    this.cart.splice(x,1);
  }

  checkout(event) {
    let name = event.srcElement.elements[0].value;
    let senderEmail = event.srcElement.elements[1].value;
    let message = event.srcElement.elements[2].value;
   
    this.itemsService.sendEmail(this.cart, name, senderEmail, message).subscribe(
      (res: any) => {}
    );
    window.alert('Your request was successfully sent!');
    window.location.reload();
  }

}
