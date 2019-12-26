import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';

import { SearchItemsModule } from './search-items/search-items.module';
import { CartModule } from './cart/cart.module';

import { HttpModule } from '@angular/http';
// import { HttpClientModule, HttpClient } from '@angular/common/http';

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    HttpModule,
    // HttpClientModule,
    // HttpClient,
    BrowserModule,
    CartModule,
    SearchItemsModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
